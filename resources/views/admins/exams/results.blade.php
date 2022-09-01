<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('exam/css/result.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Result</title>
</head>
<body>

{{--<nav class="navbar navbar-light bg-light">--}}
{{--    <div class="container-fluid">--}}
{{--        <a class="navbar-brand"><b style="color: black; width: 100%">{{$title}}</b></a>--}}

{{--        --}}{{--        <form class="d-flex" action="{{route('logout')}}" method="POST">--}}
{{--        --}}{{--            @csrf--}}
{{--        --}}{{--            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">--}}
{{--        --}}{{--            <button class="btn btn-outline-primary" style="border: none"  type="submit">Logout</button>--}}
{{--        --}}{{--        </form>--}}
{{--    </div>--}}
{{--</nav>--}}

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h4 class="col-sm-auto text-center" id="questionNumber">{{$test}} Results</h4>

            <a href="{{route('test.index')}}"
               class="btn btn-dark float-right">
                <span>Home</span>
            </a>

        </div>

        <div class="card-body">
            <div class="container">
                <div class="row">
                    <h2 class="text-center col m-2">
                        <span class="text-black">{{$percentage}}%</span>

                    </h2>
                </div>

                <div class="row m-3">
                    <h3 class="text-center col m-2">
                        Obtained <strong>{{$score}}</strong> out of <strong>{{$total_questions}}</strong>
                    </h3>
                </div>

                <div class="row m-3">
                    <h4 class="text-center col">
                        @if($percentage>=50)
                            <div style="color: #45ca65">
                                Congratulations! You passed the online exam
                            </div>
                        @else
                            <div style="color: #ca4234">
                                Sorry! You failed, please try again
                            </div>
                        @endif
                    </h4>
                </div>
                <div class="kt-portlet__body mt-3">
                    <table class="table table-hover" id="kt_table_1">
                        <thead class="kt-datatable__head">
                        <tr>
                            <th scope="col">S.N</th>
                            <th scope="col">Question</th>
                            <th scope="col">Answer</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($questions as $k => $question)
                            <tr>
                                <td>
                                    {{   ++$k }}
                                </td>
                                <td>
                                    {!! $question->question !!}
                                </td>
                                <td>
                                    {!! $question->answer==1?$question->option_1:"" !!}
                                    {!! $question->answer==2?$question->option_2:"" !!}
                                    {!! $question->answer==3?$question->option_3:"" !!}
                                    {!! $question->answer==4?$question->option_4:"" !!}
                                </td>

                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

</div>

<script>
    $(function () {
        var current_progress = 0;

        current_progress = {{$percentage}};
        $("#progressBar")
            .css("width", current_progress + "%")
            .attr("aria-valuenow", current_progress);
    });
</script>

</body>
</html>




