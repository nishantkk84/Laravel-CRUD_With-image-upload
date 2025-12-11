<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-6 px-6 space-y-6">

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white shadow rounded p-6">
                <h2 class="text-lg font-semibold">Total Products</h2>
                <p class="text-4xl font-bold text-blue-600">{{ $totalProducts }}</p>
            </div>

            <div class="bg-white shadow rounded p-6">
                <h2 class="text-lg font-semibold">Highest Price</h2>
                <p class="text-4xl font-bold text-green-600">
                    Rs. {{ \App\Models\Product::max('price') ?? 0 }}
                </p>
            </div>

            <div class="bg-white shadow rounded p-6">
                <h2 class="text-lg font-semibold">Lowest Price</h2>
                <p class="text-4xl font-bold text-red-600">
                    Rs. {{ \App\Models\Product::min('price') ?? 0 }}
                </p>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Monthly Chart -->
            <div class="bg-white shadow rounded p-6">
                <h2 class="text-lg font-semibold mb-2">Products by Month</h2>
                <canvas id="monthlyChart"></canvas>
            </div>

            <!-- Price Chart -->
            <div class="bg-white shadow rounded p-6">
                <h2 class="text-lg font-semibold mb-2">Price Range Distribution</h2>
                <canvas id="priceChart"></canvas>
            </div>

            <!-- Pie Chart -->
            <div class="bg-white shadow rounded p-6">
                <h2 class="text-lg font-semibold mb-2">Product Categories</h2>
                <canvas id="pieChart"></canvas>
            </div>

        </div>

        <!-- Latest Products -->
        <div class="bg-white shadow rounded p-6">
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

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Chart Script -->
    <script>
        // Monthly Chart
        const monthlyLabels = @json($monthlyLabels);
        const monthlyValues = @json($monthlyValues);

        new Chart(document.getElementById('monthlyChart'), {
            type: 'line',
            data: {
                labels: monthlyLabels,
                datasets: [{
                    label: "Products Added",
                    data: monthlyValues,
                    borderWidth: 3,
                    borderColor: 'blue',
                    fill: false,
                    tension: 0.3
                }]
            }
        });

        // Price Chart
        const priceLabels = @json($priceLabels);
        const priceValues = @json($priceValues);

        new Chart(document.getElementById('priceChart'), {
            type: 'bar',
            data: {
                labels: priceLabels,
                datasets: [{
                    label: "Products",
                    data: priceValues,
                    borderWidth: 3,
                    backgroundColor: ['#60a5fa', '#34d399', '#f87171']
                }]
            }
        });

        // Function to generate dynamic pastel colors
        function generateColors(num) {
            const colors = [];
            for (let i = 0; i < num; i++) {
                const r = Math.floor(Math.random() * 156) + 100;
                const g = Math.floor(Math.random() * 156) + 100;
                const b = Math.floor(Math.random() * 156) + 100;
                colors.push(`rgba(${r}, ${g}, ${b}, 0.7)`);
            }
            return colors;
        }

        // Pie Chart
        const pieLabels = @json(array_keys($categories));
        const pieValues = @json(array_values($categories));

        new Chart(document.getElementById('pieChart'), {
            type: 'pie',
            data: {
                labels: pieLabels,
                datasets: [{
                    label: 'Product Categories',
                    data: pieValues,
                    backgroundColor: generateColors(pieLabels.length)
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>

</x-app-layout>
