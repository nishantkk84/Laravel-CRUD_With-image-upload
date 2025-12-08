<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        // Total number of products
        $totalProducts = Product::count();

        // Monthly chart (SQLite compatible)
        // strftime('%m', created_at) extracts month as 01, 02, 03...
        $monthlyProducts = Product::selectRaw("strftime('%m', created_at) as month, COUNT(*) as count")
            ->groupBy('month')
            ->orderBy('month') // Optional: show in proper order
            ->pluck('count', 'month');

        // Show last 5 added products
        $latestProducts = Product::latest()->take(5)->get();

        // Example price range chart logic
        $priceChart = [
            'Below 500' => Product::where('price', '<', 500)->count(),
            '500 - 1000' => Product::whereBetween('price', [500, 1000])->count(),
            'Above 1000' => Product::where('price', '>', 1000)->count(),
        ];

        return view('dashboard', compact('totalProducts', 'monthlyProducts', 'latestProducts', 'priceChart'));
    }
}
