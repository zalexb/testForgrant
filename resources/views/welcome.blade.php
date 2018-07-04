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
        <script
                src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
                integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
                crossorigin="anonymous"></script>

        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <!-- Styles -->
        <style>
            .container{
                padding-bottom: 20px;
            }
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
                    Goods
                </div>
                <div class="container">
                    <div class="container">
                        <form>
                            <input required id="date_range" name="date" value="{{ Request::get('date') }}">
                            <select required name="type">
                                <option value="latest" {{Request::get('type')=='latest' ? 'selected' : ''}}>Latest</option>
                                <option value="period" {{Request::get('type')=='period' ? 'selected' : ''}}>Lowest period</option>
                            </select>
                            <button type="submit">Sort</button>
                        </form>
                    </div>
                    <div class="row">
                        @foreach($goods as $good)
                        <div class="col-sm-4">
                            <a href="{{route('single_good',['id'=>$good->id])}}">
                                <h3>{{$good->name}}</h3>
                                <p>{{!empty($good->relationsToArray())&&!empty($good->discount[0]) ? $good->discount[0]->price : $good->default_price}}</p>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </body>
<script>
    $('#date_range').datepicker({
        range: 'period', // возможные значения: period, multiple
        range_multiple_max: 3, // максимальное число выбранных дат в режиме "Несколько дат"
        onSelect: function(dateText, inst, extensionRange) {
            // extensionRange - добавлен возвращаемый аргумент, содержит в себе объект расширения
        }
    });
</script>
</html>
