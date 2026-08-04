@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="container-fluid">


    {{-- Project Status Chart --}}
    <div class="row justify-content-center mb-5">

        <div class="col-lg-6 col-md-8">

            <div class="card shadow">

                <div class="card-header bg-primary text-white text-center">
                    <h5 class="mb-0">
                        Project Status Overview
                    </h5>
                </div>


                <div class="card-body d-flex justify-content-center">

                    {{-- Portrait Bar Chart --}}
                    <div style="height:450px; width:450px;">
                        <canvas id="projectChart"></canvas>
                    </div>

                </div>


            </div>

        </div>

    </div>



    {{-- Dashboard Summary Cards --}}
    <div class="row g-4 mt-3">


        {{-- Total Projects --}}
        <div class="col-xl-3 col-md-6">

            <div class="small-box text-bg-primary shadow">

                <div class="inner">

                    <h3>{{ $total ?? 0 }}</h3>

                    <p>
                        Total Projects
                    </p>

                </div>

                <div class="icon">
                    <i class="bi bi-folder-fill"></i>
                </div>

            </div>

        </div>



        {{-- Ongoing --}}
        <div class="col-xl-3 col-md-6">

            <div class="small-box text-bg-warning shadow">

                <div class="inner">

                    <h3>{{ $ongoing ?? 0 }}</h3>

                    <p>
                        Ongoing
                    </p>

                </div>

                <div class="icon">
                    <i class="bi bi-clock-fill"></i>
                </div>

            </div>

        </div>



        {{-- Completed --}}
        <div class="col-xl-3 col-md-6">

            <div class="small-box text-bg-success shadow">

                <div class="inner">

                    <h3>{{ $completed ?? 0 }}</h3>

                    <p>
                        Completed
                    </p>

                </div>

                <div class="icon">
                    <i class="bi bi-check-circle-fill"></i>
                </div>

            </div>

        </div>



        {{-- Suspended --}}
        <div class="col-xl-3 col-md-6">

            <div class="small-box text-bg-danger shadow">

                <div class="inner">

                    <h3>{{ $suspended ?? 0 }}</h3>

                    <p>
                        Suspended
                    </p>

                </div>

                <div class="icon">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>

            </div>

        </div>


    </div>


</div>



{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>

const ctx = document.getElementById('projectChart');


new Chart(ctx, {

    type: 'bar',


    data: {

        labels: [

            'Ongoing',
            'Completed',
            'Suspended'

        ],


        datasets: [{

            label: 'Number of Projects',


            data: [

                {{ $ongoing ?? 0 }},
                {{ $completed ?? 0 }},
                {{ $suspended ?? 0 }}

            ],


            backgroundColor: [

                '#ffc107',
                '#198754',
                '#dc3545'

            ],


            borderColor: [

                '#d39e00',
                '#146c43',
                '#b02a37'

            ],


            borderWidth: 1,

            borderRadius: 8

        }]

    },


    options: {


        responsive: true,


        maintainAspectRatio: false,


        scales: {


            y: {

                beginAtZero: true,


                ticks: {

                    precision: 0

                },


                title: {

                    display: true,

                    text: 'Number of Projects'

                }

            },


            x: {

                title: {

                    display: true,

                    text: 'Project Status'

                }

            }


        },


        plugins: {


            legend: {

                display: false

            },


            tooltip: {

                enabled: true

            }


        }


    }


});


</script>


@endsection