<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-3 sm:pt-6">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 border-b border-gray-200 dark:border-gray-700">
                <div class="flex justify-between">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Dashboard</h2>
                </div>
                <div class="flex justify-center">
                    <canvas id="myChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"
            integrity="sha512-ZwR1/gSZM3ai6vCdI+LVF1zSq/5HznD3ZSTk7kajkaj4D292NLuduDCO1c/NT8Id+jE58KYLKT7hXnbtryGmMg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                // Function to initialize the chart
                function initializeChart(data) {
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: 'Todos Status',
                                data: data.values,
                                backgroundColor: data.backgroundColor,
                                hoverOffset: 4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                        }
                    });
                }

                // AJAX request to get data
                $.ajax({
                    url: '/dashboard/status',
                    method: 'GET',
                    success: function(response) {
                        // Assuming response is an object containing labels, values, and backgroundColor arrays
                        var data = {
                            labels: response.labels,
                            values: response.values,
                            backgroundColor: response.backgroundColor
                        };
                        initializeChart(data);
                    },
                    error: function(error) {
                        console.log('Error fetching data:', error);
                    }
                });
            });
        </script>
    @endpush


</x-app-layout>
