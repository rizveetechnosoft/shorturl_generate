<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all URLs for display
        $urls = Url::all();
        return view('home', compact('urls'));
    }

    public function store(Request $request)
    {
        // Validate the long URL
        $validated = $request->validate([
            'long_url' => 'required|url'
        ]);

        // Get the long URL from the form input
        $longUrl = $validated['long_url'];

        $existingUrl = Url::where('long_url', $longUrl)->first();
        
        if ($existingUrl) {
            // If it exists, return a message saying the URL already exists
            return redirect()->route('home')->with('error', 'This URL already exists.');
        }

        // Generate a unique short URL (6 characters)
        $shortUrl = Str::random(6); // You can implement a better algorithm here, but this works for simplicity

        // Ensure the short URL is unique (retry if duplicate)
        while (Url::where('short_url', $shortUrl)->exists()) {
            $shortUrl = Str::random(6);
        }

        // Store the long URL and the short URL in the database
        Url::create([
            'long_url' => $longUrl,
            'short_url' => $shortUrl
        ]);

        // Redirect to home with a success message
        return redirect()->route('home')->with('success', 'Short URL created successfully!');
    }

    public function redirectToLongUrl($shortUrl)
    {
        // Find the URL by the short URL
        $url = Url::where('short_url', $shortUrl)->first();

        // If the short URL is found, redirect to the long URL
        if ($url) {
            return redirect()->away($url->long_url);
        }

        // If not found, show an error message
        return redirect()->route('home')->with('error', 'URL not found.');
    }
    
}
