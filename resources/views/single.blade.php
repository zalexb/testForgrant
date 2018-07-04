<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    {{--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">--}}
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
    <script
            src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
            integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
            crossorigin="anonymous"></script>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            {{$good->name}}
        </div>
        <div class="container">

                <div class="row">
                    <div class="col-sm-4">
                        <h3>Current discounts</h3>

                        <ul class="list-group">
                            @foreach($discounts as $discount)
                                <li class="list-group-item">
                                    <p>Start: {{$discount->start}}</p>
                                    @if($discount->end)
                                        <p>End: {{$discount->end}}</p>
                                    @endif
                                    <p>Price: {{$discount->price}}</p></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-sm-4">
                        <h3>Create new discount</h3>

                            <form action="/{{$good->id}}/create" method="POST" class="form-horizontal">
                                <div class="form-group">
                                    <label for="start">Start:</label>
                                    <input required class="date_range" name="start" >
                                </div>
                                <div class="form-group">
                                    <label for="end">End:</label>
                                    <input class="date_range" name="end">
                                </div>
                                <div class="form-group">
                                    <label for="price">Price:</label>
                                    <input required type="number" name="price" >
                                </div>
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-default">Create</button>
                            </form>

                    </div>
                </div>
            <canvas id="latest" width="400" height="400"></canvas>

            <canvas id="lowestPeriod" width="400" height="400"></canvas>

            <script>
                var latest_graph = JSON.parse('{{json_encode($latest_graph)}}');

                var latest = document.getElementById("latest").getContext('2d');
                var latestChart = new Chart(latest, {
                    type: 'line',
                    data: {
                        labels: ["Jan", "Feb", "March", "April", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"],
                        datasets: [{
                            label: 'Latest 2018',
                            data: latest_graph,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
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
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });

                var lowest_period_graph = JSON.parse('{{json_encode($lowest_period_graph)}}');

                var lowestPeriod = document.getElementById("lowestPeriod").getContext('2d');
                var lowestPeriodChart = new Chart(lowestPeriod, {
                    type: 'line',
                    data: {
                        labels: ["Jan", "Feb", "March", "April", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"],
                        datasets: [{
                            label: 'Lowest period 2018',
                            data: lowest_period_graph,
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            </script>
        </div>

    </div>
</div>
</body>
<script>
    $('.date_range').datepicker({
        range: 'period', // возможные значения: period, multiple
        range_multiple_max: 3, // максимальное число выбранных дат в режиме "Несколько дат"
        onSelect: function(dateText, inst, extensionRange) {
            // extensionRange - добавлен возвращаемый аргумент, содержит в себе объект расширения
        }
    });
</script>
</html>
