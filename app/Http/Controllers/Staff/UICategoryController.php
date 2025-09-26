<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\UiCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UICategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = UiCategory::withCount('components')
            ->ordered()
            ->paginate(15);

        return view('staff.ui-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.ui-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:10',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $category = UiCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'title' => $request->title,
            'description' => $request->description,
            'icon' => $request->icon ?? '📦',
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => true,
        ]);

        return redirect()->route('staff.ui-categories.index')
            ->with('success', 'UI Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(UiCategory $uiCategory)
    {
        $uiCategory->load(['components' => function($query) {
            $query->ordered()->with(['creator', 'updater']);
        }]);

        $category = $uiCategory; // For view consistency
        return view('staff.ui-categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UiCategory $uiCategory)
    {
        $category = $uiCategory; // For view consistency
        return view('staff.ui-categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UiCategory $uiCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:10',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $uiCategory->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'title' => $request->title,
            'description' => $request->description,
            'icon' => $request->icon ?? '📦',
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('staff.ui-categories.index')
            ->with('success', 'UI Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UiCategory $uiCategory)
    {
        // Check if category has components
        if ($uiCategory->components()->count() > 0) {
            return redirect()->route('staff.ui-categories.index')
                ->with('error', 'Cannot delete category with existing components.');
        }

        $uiCategory->delete();

        return redirect()->route('staff.ui-categories.index')
            ->with('success', 'UI Category deleted successfully.');
    }
}
