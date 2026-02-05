<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\UiCategory;
use App\Models\UiComponent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UIComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = UiComponent::with(['category', 'creator', 'updater']);

        // Filter by category
        if ($request->filled('category')) {
            $query->where('ui_category_id', $request->category);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $components = $query->ordered()->paginate(15);
        
        // Cache categories for 1 hour (frequently accessed, rarely changed)
        $categories = Cache::remember('ui_categories_active', 3600, function() {
            return UiCategory::active()->ordered()->get();
        });

        return view('staff.ui-components.index', compact('components', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Cache categories for 1 hour
        $categories = Cache::remember('ui_categories_active', 3600, function() {
            return UiCategory::active()->ordered()->get();
        });
        return view('staff.ui-components.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ui_category_id' => 'required|exists:ui_categories,id',
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'html_code' => 'required|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $component = UiComponent::create([
            'ui_category_id' => $request->ui_category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'title' => $request->title,
            'description' => $request->description,
            'html_code' => $request->html_code,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => true,
            'created_by' => Auth::guard('staff')->id(),
        ]);

        return redirect()->route('staff.ui-components.index')
            ->with('success', 'UI Component created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(UiComponent $uiComponent)
    {
        $uiComponent->load(['category', 'creator', 'updater']);
        $component = $uiComponent; // For view consistency
        return view('staff.ui-components.show', compact('component'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UiComponent $uiComponent)
    {
        // Cache categories for 1 hour
        $categories = Cache::remember('ui_categories_active', 3600, function() {
            return UiCategory::active()->ordered()->get();
        });
        $component = $uiComponent; // For view consistency
        return view('staff.ui-components.edit', compact('component', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UiComponent $uiComponent)
    {
        $request->validate([
            'ui_category_id' => 'required|exists:ui_categories,id',
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'html_code' => 'required|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $uiComponent->update([
            'ui_category_id' => $request->ui_category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'title' => $request->title,
            'description' => $request->description,
            'html_code' => $request->html_code,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->boolean('is_active', true),
            'updated_by' => Auth::guard('staff')->id(),
        ]);

        return redirect()->route('staff.ui-components.index')
            ->with('success', 'UI Component updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UiComponent $uiComponent)
    {
        $uiComponent->delete();

        return redirect()->route('staff.ui-components.index')
            ->with('success', 'UI Component deleted successfully.');
    }

    /**
     * Preview component HTML
     */
    public function preview(UiComponent $uiComponent)
    {
        return view('staff.ui-components.preview', compact('uiComponent'));
    }
}
