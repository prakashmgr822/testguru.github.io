
@section('content')
    <div class="p-4 body" id="bodyContent">
        <div class="text-center" style="margin-top: -36px">
        </div>
        <div class="row">
            <div class="container">
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="col-sm-auto text-center" id="questionNumber">{{$test}} Results</h4>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="progress">
                                <div id="progressBar" class="progress-bar w-40" role="progressbar"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="row">
                                <h2 class="text-center col m-2">
                                    <span class="badge badge-pill badge-primary">{{$percentage}}%</span>

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
                            <div class="text-center col">
                                <h5>
                                    Join Our Facebook Group for Merit List of Online Exam and Answers.
                                    <br>
                                    Facebook Group Link - <a href="https://www.facebook.com/groups/230563904229370/">https://www.facebook.com/groups/230563904229370/</a>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-4 body row">
            <div class="container">
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="col-sm-auto text-center" id="questionNumber">Answers</h4>
                    </div>
                    <div class="card-body">
                        <div class="kt-portlet__body">
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
@endsection
