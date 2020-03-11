@extends('admin.layout.admin_layout')
@section('title')
    Manage Statistical
@endsection

@section("script-link")
    <script src="{{asset('js/admin/manageStatistical.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css"></script>
@endsection

@section('content')
    <main role="main" class="mt-2 col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Manage Statistical</h1>
        </div>
        <div class="text-center mt-3 mb-2"  id="loading" style="display: none">
            <img src="{{asset("images/ajax-loader.gif")}}" alt="loading...">
        </div>
        <div>
        </div>
        <div class="text-center" style="margin-left:150px;width:70%; height: 70%">
            <canvas id="chartTag"></canvas>
        </div>
        <div class="text-center"  style="margin-left:150px;width:70%; height: 70%">
            <canvas id="chartPost"></canvas>
        </div>
        </div>
    </main>
    <script>
        $('#loading').show();
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
        axios.get(location.origin+'/admin/test').then(result => {
            $('#loading').removeAttr("style").hide();
            console.log(result);
            let listTagsName = [];
            let listTagsData = [];
            for (key in result.data.countListTags) {
                listTagsName.push(key);
                listTagsData.push(result.data.countListTags[key]);
            }
            let listTagsColor= [];
            for( tag of listTagsName ){
                listTagsColor.push( getRandomColor());
            }
            var configChartTag = {
                type: 'bar',
                data: {
                    datasets: [{
                        data: listTagsData,
                        backgroundColor: listTagsColor,
                        label: 'Today'
                    }],
                    labels: listTagsName
                },
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Percents of tags existing in posts'
                    },
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            },

                        }]
                    }
                }
            };
            var ctx = document.getElementById('chartTag').getContext('2d');
            window.myDoughnut = new Chart(ctx, configChartTag);
            let  newPublicPostsToday = result.data.newPublicPostsToday;
            let  newPrivatePostsToday = result.data.newPrivatePostsToday;
            let  newPublicPostsYesterday = result.data.newPublicPostsYesterday;
            let  newPrivatePostsYesterday = result.data.newPrivatePostsYesterday;
            let  listPostsColor = [getRandomColor(), getRandomColor()];
            var configChartPost = {
                type: 'bar',
                data: {
                    datasets:
                        [
                        {
                        data: [newPublicPostsToday, newPrivatePostsToday],
                        backgroundColor:  listPostsColor,
                        label: 'Today'
                        },
                        {
                            data: [newPublicPostsYesterday, newPrivatePostsYesterday],
                            backgroundColor:  listPostsColor,
                            label: 'Yesterday'
                        }
                        ],
                    labels: ["Public Posts", "Private Posts"]
                },
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Number of new posts today and yesterday'
                    },
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            };
            var ctxx = document.getElementById('chartPost').getContext('2d');
            window.myDoughnut = new Chart(ctxx, configChartPost);
        });
    </script>
@endsection
