@extends('Backend.layout.master')

@section('content-title')

@endsection

@section('content')
    <div class="br-section-wrapper">
        @include('Backend.partials.alerts')
        <div class="row">
            <div class="col-md-6 tx-left">
                <h1 class="tx-gray-800 tx-bold mg-b-10">
                    <i class="icon ion-ios-home-outline" aria-hidden="true"></i>
                    <span class="menu-item-label">{{ __('left-panel.dashboard') }}</span>
                </h1>
            </div>
            <div class="col-md-6 tx-right">
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="bd pd-t-30 pd-b-20 pd-x-20"><canvas id="chartBar1" height="200"></canvas></div>
            </div><!-- col-6 -->
            <div class="col-xl-6 mg-t-20 mg-xl-t-0">
                <div class="bd pd-t-30 pd-b-20 pd-x-20"><canvas id="chartBar2" height="200"></canvas></div>
            </div><!-- col-6 -->
        </div><!-- row -->
        <div class="row">
            <div class="col-xl-6">
                <div class="bd pd-t-30 pd-b-20 pd-x-20"><canvas id="chartBar3" height="200"></canvas></div>
            </div><!-- col-6 -->
            <div class="col-xl-6 mg-t-20 mg-xl-t-0">
                <div class="bd pd-t-30 pd-b-20 pd-x-20"><canvas id="chartBar4" height="200"></canvas></div>
            </div><!-- col-6 -->
        </div><!-- row -->
        <div class="row">
            <div class="col-xl-6">
                <div class="bd pd-t-30 pd-b-20 pd-x-20"><canvas id="chartBar5" height="200"></canvas></div>
            </div><!-- col-6 -->
            <div class="col-xl-6 mg-t-20 mg-xl-t-0">
                <div class="bd pd-t-30 pd-b-20 pd-x-20"><canvas id="chartBar6" height="200"></canvas></div>
            </div><!-- col-6 -->
        </div><!-- row -->         
    </div><!-- br-section-wrapper -->
@endsection
@section('script')
    <script src="{{ asset('/assets/lib/chart.js/Chart.js') }}"></script>
    <script>
        $(document).ready (function(){
            var ctx1 = document.getElementById('chartBar1').getContext('2d');
            var myChart1 = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 39, 20, 10, 25, 18],
                        backgroundColor: '#27AAC8'
                    }]
                },
                options: {
                    legend: {
                        display: false,
                        labels: {
                            display: false
                        }
                    },
                    scales: {
                        yAxes: [{
                        ticks: {
                            beginAtZero:true,
                            fontSize: 10,
                            max: 80
                        }
                        }],
                        xAxes: [{
                        ticks: {
                            beginAtZero:true,
                            fontSize: 11
                        }
                        }]
                    }
                }
            });

            var ctx2 = document.getElementById('chartBar2').getContext('2d');
            var myChart2 = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 39, 20, 10, 25, 18],
                        backgroundColor: [
                        '#29B0D0',
                        '#2A516E',
                        '#F07124',
                        '#CBE0E3',
                        '#979193'
                        ]
                    }]
                },
                options: {
                    legend: {
                        display: false,
                        labels: {
                            display: false
                        }
                    },
                    scales: {
                        yAxes: [{
                        ticks: {
                            beginAtZero:true,
                            fontSize: 10,
                            max: 80
                        }
                        }],
                        xAxes: [{
                        ticks: {
                            beginAtZero:true,
                            fontSize: 11
                        }
                        }]
                    }
                }
            });
            
            var ctx2 = document.getElementById('chartBar3').getContext('2d');
            var myChart2 = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 39, 20, 10, 25, 18],
                        backgroundColor: [
                        '#29B0D0',
                        '#2A516E',
                        '#F07124',
                        '#CBE0E3',
                        '#979193'
                        ]
                    }]
                },
                options: {
                    legend: {
                        display: false,
                        labels: {
                            display: false
                        }
                    },
                    scales: {
                        yAxes: [{
                        ticks: {
                            beginAtZero:true,
                            fontSize: 10,
                            max: 80
                        }
                        }],
                        xAxes: [{
                        ticks: {
                            beginAtZero:true,
                            fontSize: 11
                        }
                        }]
                    }
                }
            });
            
            var ctx2 = document.getElementById('chartBar4').getContext('2d');
            var myChart2 = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 39, 20, 10, 25, 18],
                        backgroundColor: [
                        '#29B0D0',
                        '#2A516E',
                        '#F07124',
                        '#CBE0E3',
                        '#979193'
                        ]
                    }]
                },
                options: {
                    legend: {
                        display: false,
                        labels: {
                            display: false
                        }
                    },
                    scales: {
                        yAxes: [{
                        ticks: {
                            beginAtZero:true,
                            fontSize: 10,
                            max: 80
                        }
                        }],
                        xAxes: [{
                        ticks: {
                            beginAtZero:true,
                            fontSize: 11
                        }
                        }]
                    }
                }
            });  

            var ctx2 = document.getElementById('chartBar5').getContext('2d');
            var myChart2 = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 39, 20, 10, 25, 18],
                        backgroundColor: [
                        '#29B0D0',
                        '#2A516E',
                        '#F07124',
                        '#CBE0E3',
                        '#979193'
                        ]
                    }]
                },
                options: {
                    legend: {
                        display: false,
                        labels: {
                            display: false
                        }
                    },
                    scales: {
                        yAxes: [{
                        ticks: {
                            beginAtZero:true,
                            fontSize: 10,
                            max: 80
                        }
                        }],
                        xAxes: [{
                        ticks: {
                            beginAtZero:true,
                            fontSize: 11
                        }
                        }]
                    }
                }
            }); 

            var ctx2 = document.getElementById('chartBar6').getContext('2d');
            var myChart2 = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 39, 20, 10, 25, 18],
                        backgroundColor: [
                        '#29B0D0',
                        '#2A516E',
                        '#F07124',
                        '#CBE0E3',
                        '#979193'
                        ]
                    }]
                },
                options: {
                    legend: {
                        display: false,
                        labels: {
                            display: false
                        }
                    },
                    scales: {
                        yAxes: [{
                        ticks: {
                            beginAtZero:true,
                            fontSize: 10,
                            max: 80
                        }
                        }],
                        xAxes: [{
                        ticks: {
                            beginAtZero:true,
                            fontSize: 11
                        }
                        }]
                    }
                }
            });                         
        });
   </script>        
@endsection        