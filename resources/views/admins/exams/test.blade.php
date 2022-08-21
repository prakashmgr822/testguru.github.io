<html>
<head>
    <title>{{$title}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="/exam/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/exam/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/exam/favicon/favicon-16x16.png">
    <link rel="manifest" href="/exam/favicon/site.webmanifest">
    <link rel="stylesheet" href="{{asset('exam/css/style.css')}}">
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.15.2/dist/katex.min.css" integrity="sha384-MlJdn/WNKDGXveldHDdyRP1R4CTHr3FeuDNfhsLPYrq2t0UBkUdK2jyTnXPEK1NQ" crossorigin="anonymous">
    {{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.15.2/dist/katex.css" integrity="sha384-NFGicHNcq1l2DafLerXQeI3h3jJY3dCcDQF+29rtRBHW7P7ti+/XIRY7ALbJOaeh" crossorigin="anonymous">--}}

</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
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
            <img src="{{asset('exam/img/reminder.png')}}" width="25" height="25"> <b id="countdownTimer">Time
                Remaining: --:--</b>
        </div>
    </div>

    <div class="card" style="margin-top: 0.5rem">
        <div class="card-header">
            <div class="row">
                <div class="col mt-1">
                    <p id="question"></p>
                </div>
            </div>

        </div>
        <ul class="list-group list-group-flush optionBox">
            <li class="list-group-item opt" id="option1Row">A. <span id="option1Text"></span></li>
            <li class="list-group-item opt" id="option2Row">B. <span id="option2Text"></span></li>
            <li class="list-group-item opt" id="option3Row">C. <span id="option3Text"></span></li>
            <li class="list-group-item opt" id="option4Row">D. <span id="option4Text"></span></li>
        </ul>
        <div class="card-footer py-3">
            <div class="row">
                <div class="col">
                    <a href="#" id="prevButton"><img src="{{asset('exam/img/left.png')}}" width="25" height="25">
                        <b
                            style="color: #007BFF;">Prev</b></a>
                </div>
                <div class="col-auto">
                    <a href="#" id="skip"><b style="color: #007BFF;">Skip</b></a>
                </div>
                <div class="col" style="text-align: justify; text-align-last: right;">
                    <a href="#" id="nextButton"><b style="color: #007BFF;">Next</b><img
                            src="{{asset('exam/img/right.png')}}"
                            width="25" height="25"></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-7"></div>
    <div class="col-5">
        <i class=""></i>
        <div class="submit-button">
            <button class="btn pmd-btn-fab pmd-ripple-effect btn-success" type="button" onclick="showConfirm()">
                {{--                        <i class="material-icons pmd-sm">check</i>--}}
                <i class="fa fa-check"></i>
            </button>
        </div>
    </div>
    </div>
</div>
</body>
</html>
