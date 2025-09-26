<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\SearchService;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index', [
            'user' => Auth::user()
        ]);
    }

    public function products()
    {
        return view('home.products.index', [
            'user' => Auth::user()
        ]);
    }

    public function contact()
    {
        return view('home.contact', [
            'user' => Auth::user()
        ]);
    }

    public function about()
    {
        return view('home.about', [
            'user' => Auth::user()
        ]);
    }

    public function sendContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // Here you would typically send an email or store the contact form data
        // For now, we'll just redirect back with a success message

        return redirect()->back()->with('success', 'Thank you for your message. We will get back to you soon!');
    }

    public function teamIndex()
    {
        return view('home.team.index', [
            'user' => Auth::user()
        ]);
    }

    public function teamProfile($slug)
    {
        return view('home.team.profile', [
            'user' => Auth::user(),
            'slug' => $slug
        ]);
    }

    public function search(Request $request, SearchService $searchService)
    {
        $query = $request->get('q', '');
        $category = $request->get('category', '');
        
        $filters = [];
        if (!empty($category)) {
            $filters['category'] = $category;
        }
        
        // Get search results using the new service
        $results = $searchService->search($query, $filters);
        
        // Get search suggestions and quick links
        $suggestions = $searchService->getSearchSuggestions();
        $quickLinks = $searchService->getQuickLinks();
        
        return view('home.search', [
            'user' => Auth::user(),
            'query' => $query,
            'category' => $category,
            'results' => $results,
            'suggestions' => $suggestions,
            'quickLinks' => $quickLinks,
            'totalResults' => count($results)
        ]);
    }

    public function searchSuggestions(Request $request, SearchService $searchService)
    {
        $query = $request->get('q', '');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }
        
        // Get quick suggestions based on query
        $results = $searchService->search($query);
        
        // Limit to top 5 suggestions
        $suggestions = array_slice($results, 0, 5);
        
        $formattedSuggestions = array_map(function($result) {
            return [
                'title' => strip_tags($result['title']),
                'description' => strip_tags($result['highlighted_description'] ?? $result['description'] ?? ''),
                'url' => $result['url'],
                'type' => $result['type']
            ];
        }, $suggestions);
        
        return response()->json($formattedSuggestions);
    }
}
