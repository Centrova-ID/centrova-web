<?php

namespace App\Http\Controllers;

use App\Models\UiCategory;
use App\Models\UiComponent;
use Illuminate\Http\Request;

class WebUIController extends Controller
{
    /**
     * Display the Web UI blocks index page
     */
    public function index()
    {
        $uiCategories = UiCategory::active()
            ->ordered()
            ->withCount(['activeComponents'])
            ->get();

        return view('web-ui.index', compact('uiCategories'));
    }

    /**
     * Display specific UI block category
     */
    public function category($categorySlug)
    {
        $category = UiCategory::where('slug', $categorySlug)
            ->where('is_active', true)
            ->firstOrFail();

        $components = UiComponent::where('ui_category_id', $category->id)
            ->active()
            ->ordered()
            ->with(['creator', 'updater'])
            ->get();

        return view('web-ui.category', [
            'category' => $category,
            'components' => $components,
            'categoryTitle' => $category->title
        ]);
    }
}
