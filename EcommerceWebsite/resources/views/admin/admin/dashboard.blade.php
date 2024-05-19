<x-app-layout>

    <style>
        a {
            text-decoration: none;
        }

    </style>
    <div class="">
        <div class="max-w-7xl ">
            <div class="container-fluid ">
                <div class="row">
                    <x-admin.sidenavbar/>
                    <div class="col-10">
                        <canvas id="categorieschart" width="400" height="200"></canvas>
                        <canvas id="userschart" width="400" height="200" style="margin-top: 100px"></canvas>
                        <canvas id="productschart" width="400" height="200" style="margin-top: 100px"></canvas>

                        <script>

                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        var userschart = document.getElementById('userschart');
        var userschart = new Chart(userschart, {
            type: 'line',
            data: {
                labels: [
                    @foreach($users as $user)
                        '{{$user->created_at2}}',
                    @endforeach
                ],
                datasets: [{
                    label: '# of Votes',
                    data: [
                        @foreach($users as $user)
                            {{$user->nb}},
                        @endforeach],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',

                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            // forces step size to be 50 units
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Nombre d\'utilisateur par moi',
                        fontSize: 16
                    }
                }
            }
        });


        var categorieschart = document.getElementById('categorieschart');
        var myChart = new Chart(categorieschart, {
            type: 'bar',
            data: {
                labels: [
                    @foreach($categories as $category)
                        '{{$category->name}}',
                    @endforeach
                ],
                datasets: [{
                    label: '# of Votes',
                    data: [
                        @foreach($categories as $category)
                            @if($category->statics==null)
                            0,
                        @else
                            {{$category->statics->nb}},
                        @endif
                        @endforeach],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            // forces step size to be 50 units
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'sou categorie click',
                        fontSize: 16
                    }
                }
            }
        });


        var productschart = document.getElementById('productschart');
        var myChart = new Chart(productschart, {
            type: 'bar',
            data: {
                labels: [
                    @foreach($products as $product)
                        '{{$product->product->title}}',
                    @endforeach
                ],
                datasets: [{
                    label: '# of Votes',
                    data: [
                        @foreach($products as $product)
                            '{{$product->nb}}',
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            // forces step size to be 50 units
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Produits populaires',
                        fontSize: 16
                    }
                }
            }
        });

    </script>
</x-app-layout>
