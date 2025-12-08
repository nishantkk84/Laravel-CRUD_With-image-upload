<x-app-layout>
    <div class="p-6 space-y-6">

        <!-- Title -->
        <h1 class="text-2xl font-bold">📊 Dashboard</h1>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white shadow-lg rounded p-6">
                <h2 class="text-lg font-semibold">Total Products</h2>
                <p class="text-4xl font-bold text-blue-600">{{ $totalProducts }}</p>
            </div>

            <div class="bg-white shadow-lg rounded p-6">
                <h2 class="text-lg font-semibold">Highest Price</h2>
                <p class="text-4xl font-bold text-green-600">
                    Rs. {{ \App\Models\Product::max('price') ?? 0 }}
                </p>
            </div>

            <div class="bg-white shadow-lg rounded p-6">
                <h2 class="text-lg font-semibold">Lowest Price</h2>
                <p class="text-4xl font-bold text-red-600">
                    Rs. {{ \App\Models\Product::min('price') ?? 0 }}
                </p>
            </div>

        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Monthly Chart -->
            <div class="bg-white shadow-lg rounded p-6">
                <h2 class="text-lg font-semibold mb-2">Products by Month</h2>
                <canvas id="monthlyChart"></canvas>
            </div>

            <!-- Price Range Chart -->
            <div class="bg-white shadow-lg rounded p-6">
                <h2 class="text-lg font-semibold mb-2">Price Range Distribution</h2>
                <canvas id="priceChart"></canvas>
            </div>

        </div>

        <!-- Latest Products Table -->
        <div class="bg-white shadow-lg rounded p-6">
            <h2 class="text-lg font-semibold mb-4">Latest Products</h2>

            <table class="w-full border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-2">ID</th>
                        <th class="border p-2">Name</th>
                        <th class="border p-2">Price</th>
                        <th class="border p-2">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($latestProducts as $product)
                        <tr>
                            <td class="border p-2 text-center">{{ $product->id }}</td>
                            <td class="border p-2">{{ $product->name }}</td>
                            <td class="border p-2">Rs. {{ $product->price }}</td>
                            <td class="border p-2">{{ $product->created_at->format('d-M-Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <!-- ChartJS Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    

</x-app-layout>
