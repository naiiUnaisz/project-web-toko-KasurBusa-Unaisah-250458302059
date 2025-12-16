<div>

    <div class="container mx-auto mt-8 mb-9">

        @if(auth()->user()->role == 'admin')
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-4"><i class="fa-solid fa-user "></i> Total Pengguna</h3>
                    <p class="text-3xl">{{$totalUsers}}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-4"><i class="fa-solid fa-box-archive"></i> Total Produk</h3>
                    <p class="text-3xl">{{$totalProducts}}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-4"><i class="fa-solid fa-coins"></i>  Total Penghasilan</h3>
                    <p class="text-3xl">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
                </div>
            </div>
        @else
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <h3 class="text-lg font-semibold">Selamat datang, {{ auth()->user()->name }}!</h3>
                <p class="mt-2 text-gray-600">Anda login sebagai user biasa.</p>
            </div>
        @endif

    </div>

    {{-- Chart pesanan perbulan --}}
<div class="bg-white p-6 rounded-xl shadow  ">
    <h2 class="text-xl font-bold mb-4">
        Jumlah Pesanan per Bulan
    </h2>

    <div id="chart"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    let orderChart = null;

    document.addEventListener('livewire:navigated', () => {

        const data = @json($ordersPerMonth);

        // mapping data
        const monthNames = [
            'Jan','Feb','Mar','Apr','Mei','Jun',
            'Jul','Agu','Sep','Okt','Nov','Des'
        ];

        let seriesData = Array(12).fill(0);

        data.forEach(item => {
            seriesData[item.month - 1] = item.total;
        });

        //  HAPUS chart lama
        if (orderChart) {
            orderChart.destroy();
        }

        const options = {
            series: [{
                name: 'Jumlah Pesanan',
                data: seriesData
            }],
            chart: {
                height: 350,
                type: 'bar'
            },
            plotOptions: {
                bar: {
                    columnWidth: '45%',
                    distributed: true
                }
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: false
            },
            xaxis: {
                categories: monthNames
            }
        };

        orderChart = new ApexCharts(
            document.querySelector("#chart"),
            options
        );
        orderChart.render();
    });
</script>

</div>