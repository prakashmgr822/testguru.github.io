<html>
<head>
    <title>{{$title}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{asset('exam/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('libs/cute-alert/style.css')}}" />

    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">--}}
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.15.2/dist/katex.min.css" integrity="sha384-MlJdn/WNKDGXveldHDdyRP1R4CTHr3FeuDNfhsLPYrq2t0UBkUdK2jyTnXPEK1NQ" crossorigin="anonymous">
    {{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.15.2/dist/katex.css" integrity="sha384-NFGicHNcq1l2DafLerXQeI3h3jJY3dCcDQF+29rtRBHW7P7ti+/XIRY7ALbJOaeh" crossorigin="anonymous">--}}

</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<script src="{{asset('libs/cute-alert/cute-alert.js')}}"></script>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="https://cdn.jsdelivr.net/npm/katex@0.10.1/dist/katex.min.js"
        integrity="sha384-2BKqo+exmr9su6dir+qCw08N2ZKRucY4PrGQPPWU1A7FtlCGjmEGFqXCv5nyM5Ij"
        crossorigin="anonymous"></script>
<!-- development version, includes helpful console warnings -->
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
@include('admins.tests.partials.navbar')

<div class="container">
    <div class="row mt-3">
        <div class="col">
            <p id="questionNumber"></p>
        </div>
        <div class="col-auto time-remaining">
            <b id="countdownTimer">Time
                Remaining: --:--</b>
        </div>
    </div>

    <div class="card" style="margin-top: 0.5rem">
        <div class="card-header" id="qn">
            <div class="row">
                <div class="col mt-1">
                    <p id="question"></p>
                </div>
            </div>

        </div>
        <ul class="list-group list-group-flush optionBox " id="opn">
            <li class="list-group-item opt" id="option1Row">A. <span id="option1Text"></span></li>
            <li class="list-group-item opt" id="option2Row">B. <span id="option2Text"></span></li>
            <li class="list-group-item opt" id="option3Row">C. <span id="option3Text"></span></li>
            <li class="list-group-item opt" id="option4Row">D. <span id="option4Text"></span></li>
        </ul>
        <div class="card-footer py-3">
            <div class="row">
                <div class="col">
                    <a href="#" id="prevButton"><button class="btn btn-primary">Prev</button></a>
                </div>
                <div class="col-auto">
                    <a href="#" id="skip"><button class="btn btn-danger">Skip</button></a>
                </div>
                <div class="col" style="text-align: justify; text-align-last: right;">
                    <a href="#" id="nextButton"><button class="btn btn-primary">Next</button></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-7">
            <p class="pt-2">Best of luck</p>
        </div>
        <div class="col-5">
            <div class="submit-button">
                <button class="btn btn-success "  type="button" onclick="showConfirm()">
                    {{--                        <i class="material-icons pmd-sm">check</i>--}}
                    <i class="fa fa-check"></i>
                </button>
            </div>
        </div>
        {{--            <div class="col-5">--}}
        {{--                <p id="hint" class="mt-3 watch"></p>--}}
        {{--            </div>--}}
    </div>
</div>

<div class="modal hide fade in" data-keyboard="false" data-backdrop="static" id="examWelcomeModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Welcome</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
{{--                    @if($test->getImage())--}}
{{--                        <img class='mx-auto d-block' width='240' src="{{$test->getImage()?? ''}}" alt="image"/>--}}
{{--                    @endif--}}
                </div>
                <div class="form-group" id="welcomeMessage">

                    <pre style="font-family: Sans-serif">{!! $test['description'] !!}</pre>
                </div>
            </div>
            <div class="modal-footer">
                <button id="examWelcomeModalButton" type="button" class="btn btn-primary btn-block" style="width: 100%">Start</button>
            </div>
        </div>
    </div>
</div>

<div class="modal hide fade in" data-keyboard="false" data-backdrop="static" id="timeupModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Time's Up</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">You're time's up. Click on the button below to view results.</div>
            </div>
            <div class="modal-footer">
                <button id="timeupModalButton" onclick="hideFunction()" type="button"
                        class="btn btn-primary btn-block">View Results
                </button>
            </div>
        </div>
    </div>
</div>

<form method="post" id="answersForm" action="{{ route("exam.results") }}">
    @method('POST')
    {{csrf_field()}}
    <input id="answerTestId" name="test_id" type="hidden">
    <input id="answers" name="answers" type="hidden">
    <input id="user_id" name="user_id" type="hidden" value="{{\auth('web')->user()->id ?? ''}}">
</form>

<section>
    <script>

        $('#hint').hide();

        function showConfirm() {
            cuteAlert({
                type: "question",
                img: "question",
                title: "Confirm Title",
                message: "Confirm Message",
                confirmText: "Okay",
                cancelText: "Cancel"
            }).then((result) => {
                if (answers.length > 0) {
                    if (result = "confirmed") {
                        cuteAlert({
                            type: "success",
                            title: "Success Title",
                            message: "Success Message",
                            buttonText: "Okay"
                        }).then((result) => {
                            if (result = "confirmed") {
                                $('#answerTestId').val( {{$test['id']}});
                                $('#answers').val(JSON.stringify(answers));
                                $('#answersForm').submit();
                            }
                        })
                    }
                }
            })

        }

        $(document).ready(function () {
            //declarations
            var timeAlertShwon = false;
            var examTotalTime = $("#input-exam-time").val();//minutes
            // alert(examTotalTime)
            var examDate = '{{$test['target_date']}}';

            var examDateTime = new Date(examDate);
            var currentDateTime = new Date();

            var diffMs = (examDateTime - currentDateTime); // milliseconds between now & exam
            var minutes = Math.floor((diffMs / 1000) / 60);
            var seconds = Math.floor((diffMs / 1000) - minutes * 60);



            checkExamTime();

            function checkExamTime() {
                if (minutes > 0) {
                    // Exam Not Started yet
                    $(document).ready(function () {
                        $('#qn').css("display", "none");
                        $('#opn').css("display", "none");
                        $('#examWelcomeModal').modal('show',{backdrop: 'static', keyboard: false});
                        // let remainingSeconds = examTotalTime * 60 - Math.abs(seconds);
                        let timer2 = "" + minutes + ":" + seconds;

                        let interval = setInterval(function () {

                            let timer = timer2.split(':');
                            //by parsing integer, I avoid all extra string processing
                            let minutes = parseInt(timer[0], 10);
                            let seconds = parseInt(timer[1], 10);
                            --seconds;
                            minutes = (seconds < 0) ? --minutes : minutes;
                            if (minutes < 1) {
                                clearInterval(interval);
                                $('#examWelcomeModal').modal('hide');
                                // registerModal();
                            }
                            if (minutes === 2 && seconds === 0) timeRemainingAlert();
                            seconds = (seconds < 0) ? 59 : seconds;
                            seconds = (seconds < 10) ? '0' + seconds : seconds;
                            minutes = (minutes < 10) ? minutes : minutes;
                            $('#welcomeMessage').html("Exam starting in " + minutes + " minutes : " + seconds + " seconds");
                            timer2 = minutes + ':' + seconds;
                        }, 1000);

                        //when modal opens
                        $('#examWelcomeModal').on('shown.bs.modal', function (e) {
                            $("#bodyContent").css({opacity: 0.0});
                        });

                        //when modal closes
                        $('#examWelcomeModal').on('hidden.bs.modal', function (e) {
                            $("#bodyContent").css({opacity: 1.0});
                        });
                    });
                } else {
                    //Exam started

                    if (minutes > -examTotalTime) {
                        $('#qn').css("display", "");
                        $('#opn').css("display", "");
                        //Exam started but not ended
                        let remaining = examTotalTime - Math.abs(minutes);
                        let timer2 = "" + remaining + ":" + seconds;

                        let interval = setInterval(function () {
                            let timer = timer2.split(':');
                            //by parsing integer, I avoid all extra string processing
                            let minutes = parseInt(timer[0], 10);
                            let seconds = parseInt(timer[1], 10);
                            --seconds;
                            minutes = (seconds < 0) ? --minutes : minutes;
                            if (minutes < 0) {
                                clearInterval(interval);
                                timeUp();
                            }
                            if (minutes === 2 && seconds === 0) timeRemainingAlert();
                            seconds = (seconds < 0) ? 59 : seconds;
                            seconds = (seconds < 10) ? '0' + seconds : seconds;
                            $('#countdownTimer').html('<strong>Time Remaining: ' + minutes + ':' + seconds + '</strong>');
                            // }
                            timer2 = minutes + ':' + seconds;
                        }, 1000);
                    } else {
                        //Exam started & ended already
                        $(document).ready(function () {
                            //no need registration for this
                            $('#examWelcomeModal').modal('show');
                            {{--$('#welcomeMessage').innerHTML("{{$test['description']}}");--}}
                            $('#examWelcomeModalButton').click(function () {
                                $('#examWelcomeModal').modal('hide');
                                // let remainingSeconds = examTotalTime * 60 - Math.abs(seconds);

                                let timer2 = examTotalTime + ":00";
                                let interval = setInterval(function () {

                                    let timer = timer2.split(':');
                                    //by parsing integer, I avoid all extra string processing
                                    let minutes = parseInt(timer[0], 10);
                                    let seconds = parseInt(timer[1], 10);
                                    --seconds;
                                    minutes = (seconds < 0) ? --minutes : minutes;
                                    if (minutes < 0) {
                                        clearInterval(interval);
                                        timeUp();

                                    }

                                    if (minutes === 2 && seconds === 0) timeRemainingAlert();
                                    seconds = (seconds < 0) ? 59 : seconds;
                                    seconds = (seconds < 10) ? '0' + seconds : seconds;
                                    //minutes = (minutes < 10) ?  minutes : minutes;
                                    $('#countdownTimer').html('<strong>Time Remaining: ' + minutes + ':' + seconds + '</strong>');
                                    timer2 = minutes + ':' + seconds;
                                }, 1000);
                            });
                        });
                    }
                }
            }

            {{--function welcomeModalOnline() {--}}
            {{--    $(document).ready(function () {--}}
            {{--        $('#examWelcomeModal').modal('show');--}}
            {{--        $('#welcomeMessage').html("{{$test['description']}}");--}}
            {{--        //when modal opens--}}
            {{--        $('#examWelcomeModal').on('shown.bs.modal', function (e) {--}}
            {{--            $("#bodyContent").css({opacity: 0.0});--}}
            {{--        });--}}

            {{--        //when modal closes--}}
            {{--        $('#examWelcomeModal').on('hidden.bs.modal', function (e) {--}}
            {{--            $("#bodyContent").css({opacity: 1.0});--}}
            {{--        });--}}
            {{--    });--}}
            {{--}--}}

            function timeRemainingAlert() {
                if (!timeAlertShwon) {
                    var audio = new Audio('{{asset("sounds/alert.mp3")}}');
                    audio.volume = 0.2;
                    audio.play();
                    audio.onended = function () {
                        alert("Only 2 minutes Remaining!");
                        timeAlertShwon = true;
                    };

                }
            }

            function timeUp() {
                $('#timeupModal').modal('show');
                $('#timeupModalButton').click(function () {
                    $('#answerTestId').val( {{$test['id']}});
                    $('#answers').val(JSON.stringify(answers));
                    $('#answersForm').submit();
                });
            }
        });



        var currentQuestionIndex = 0;

        function selectRow(option) {
            highlightQuestionBox(currentQuestionIndex);
            $("#option" + option + "Row").addClass("bg-info");
        }

        function highlightQuestionBox(index) {
            $("#questionBox" + index).addClass("bg-info");
        }

        function dehighlightQuestionBox(index) {
            $("#questionBox" + index).removeClass("bg-info");
        }

        //get initial data from laravel
        var test = {!! json_encode($test)!!};

        var questions = {!! json_encode($questions) !!};
        var answers = new Array(questions.length);

        for (let i = 0; i < answers.length; i++) {
            answers[i] = "";
        }
        updateContent();

        // JSON.stringify(questions

        $('#nextButton').click(
            function () {
                if (currentQuestionIndex < questions.length - 1) {
                    if (answers[currentQuestionIndex] === "") {
                        // alert("Please select an option");
                        cuteAlert({
                            type: "warning",
                            title: "Warning Title",
                            message: "Warning Message",
                            buttonText: "Okay"
                        })
                    } else {
                        currentQuestionIndex++;
                        updateContent();
                        if($('.opt').hasClass("bg-info")) {
                            $('#hint').html(hintData);
                            $('#hint').show();
                        }else
                        {
                            $('#hint').hide();
                        }
                    }
                } else {
                    cuteAlert({
                        type: "warning",
                        title: "Warning",
                        message: "Are you sure?",
                        buttonText: "Okay"
                    }).then((result) => {
                        if (answers.length > 0) {
                            if (result.isConfirmed) {
                                Swal.fire(
                                    'Submitted!',
                                    'Your answers has been submitted.',
                                    'success',
                                ).then((result) => {
                                    if (result.isConfirmed) {
                                        $('#answerTestId').val( {{$test['id']}});
                                        $('#answers').val(JSON.stringify(answers));
                                        $('#answersForm').submit();
                                    }
                                })
                            }
                        }
                    })
                }
            }
        );


        $('#prevButton').click(
            function () {
                if (currentQuestionIndex > 0) {
                    currentQuestionIndex--;
                    updateContent();
                    $('#hint').html(hintData)
                }
            }
        );

        //options 1 to 4
        for (let i = 1; i <= 4; i++) {
            let rowId = '#option' + i + 'Row';
            let selectedClass = "bg-info";

            $(rowId).click(
                function () {
                    if ($(rowId).hasClass(selectedClass)) {
                        removeSelected();
                        $(rowId).removeClass(selectedClass);
                        answers[currentQuestionIndex] = undefined;
                        dehighlightQuestionBox(currentQuestionIndex);
                    } else {
                        removeSelected();
                        selectRow(i.toString());
                        answers[currentQuestionIndex] = i.toString();
                    }
                }
            );
        }

        function removeSelected() {
            for (let i = 1; i <= 4; i++) {

                let rowId = '#option' + i + 'Row';
                let selectedClass = "bg-info";

                $(rowId).removeClass(selectedClass);
            }
        }

        $(document).ready(function () {
            $('.opt').click(function () {
                $('#hint').html(hintData);
                $('#hint').show();
            });
        });

        $('#skip').click(
            function () {
                if (currentQuestionIndex < questions.length - 1) {
                    answers[currentQuestionIndex] = ""
                    currentQuestionIndex++;
                    updateContent();
                }
            });
        var hintData;
        function updateContent() {
            updateAnswer();
            var questionNumber = "Question <strong>" + (currentQuestionIndex + 1) + " of " + questions.length + "</strong>";
            for (let i = 0; i < questions.length; i++) {
                $("#questionBox" + i).removeClass("questionBoxbg-info");
            }
            $("#questionBox" + currentQuestionIndex).addClass("questionBoxbg-info");

            $('#questionNumber').html(questionNumber);
            $('#question').html(questions[currentQuestionIndex]['question']);
            hintData = (questions[currentQuestionIndex]['hint']);

            for (let i = 1; i <= 4; i++) {
                let optionTextId = '#option' + i + 'Text';
                let optionValue = questions[currentQuestionIndex]['option_' + i];
                optionValue = optionValue.replaceAll("<p>", "");
                optionValue = optionValue.replaceAll("</p>", "");
                $(optionTextId).html(optionValue);
            }
        }

        function updateAnswer() {
            removeSelected();

            var answer = answers[currentQuestionIndex];
            if (answer === "1") {
                selectRow("1");
            } else if (answer === "2") {
                selectRow("2");
            } else if (answer === "3") {
                selectRow("3");
            } else if (answer === "4") {
                selectRow("4");
            }
        }



    </script>
    <input type="hidden" id="input-exam-time" value="{{$test->exam_duration??60}}">
</section>
</body>
</html>
