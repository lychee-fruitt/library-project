<x-adminlayout>
    <div class="p-4 sm:ml-0">
        
        <!-- Tổng quan thống kê -->
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div class="flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                <p class="text-2xl font-semibold text-gray-700 dark:text-gray-300">
                    Total Categories: <span class="text-blue-600 dark:text-blue-400">{{ $totalCategories }}</span>
                </p>
            </div>
            <div class="flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                <p class="text-2xl font-semibold text-gray-700 dark:text-gray-300">
                    Total Books: <span class="text-blue-600 dark:text-blue-400">{{ $totalBooks }}</span>
                </p>
            </div>
            <div class="flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                <p class="text-2xl font-semibold text-gray-700 dark:text-gray-300">
                    Total Borrowed Books: <span class="text-blue-600 dark:text-blue-400">{{ $totalBorrowedBooks }}</span>
                </p>
            </div>
        </div>

        <!-- Biểu đồ mượn sách -->
        <div class="flex items-center justify-center mb-4 rounded bg-gray-50 dark:bg-gray-800">
            <div class="max-w-full w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4">
                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Borrowed Book Chart</h5>
                <div class="mb-3">
                    <select id="dateRange" class="border rounded p-2">
                        <option value="last_week" {{ request('date_range') == 'last_week' ? 'selected' : '' }}>This week</option>
                        <option value="last_month" {{ request('date_range') == 'last_month' ? 'selected' : '' }}>Last Month</option>
                    </select>
                </div>
                <canvas id="borrowChart" class="w-full h-64"></canvas> <!-- Thay đổi chiều cao để biểu đồ lớn hơn -->
            </div>

            <script>
                const ctx = document.getElementById('borrowChart').getContext('2d');
                const data = @json($data);

                const borrowChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: 'Quantity of Borrowed Books',
                            data: data.data,
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                document.getElementById('dateRange').addEventListener('change', function() {
                    const selectedValue = this.value;
                    window.location.href = `?date_range=${selectedValue}`;
                });
            </script>
        </div>
    </div>
</x-adminlayout>