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
        $monthlyProducts = Product::selectRaw("strftime('%m', created_at) as month, COUNT(*) as count")
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        // Convert to separate arrays for Chart.js
        $monthlyLabels = $monthlyProducts->keys();
        $monthlyValues = $monthlyProducts->values();

        // Last 5 added products
        $latestProducts = Product::latest()->take(5)->get();

        // Price range chart
        $priceChart = [
            'Below 500'     => Product::where('price', '<', 500)->count(),
            '500 - 1000'    => Product::whereBetween('price', [500, 1000])->count(),
            'Above 1000'    => Product::where('price', '>', 1000)->count(),
        ];

        $priceLabels = array_keys($priceChart);
        $priceValues = array_values($priceChart);

        // Product categories for Pie Chart
        $categories = Product::select('category')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('category')
            ->pluck('total', 'category');

        // Pass all data to view
        return view('dashboard', [
            'totalProducts' => $totalProducts,
            'monthlyLabels' => $monthlyLabels,
            'monthlyValues' => $monthlyValues,
            'latestProducts' => $latestProducts,
            'priceLabels' => $priceLabels,
            'priceValues' => $priceValues,
            'categories' => $categories, // new addition
        ]);
    }
}
