{{--<!-- Image and text -->--}}
{{--<nav class="navbar navbar-light bg-light">--}}
{{--    <a class="navbar-brand" href="{{url('/')}}">--}}
{{--        <img src="/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">--}}
{{--        <b style="padding-left: 2rem; color: #007BFF;">Help for Entrance Exam</b>--}}
{{--    </a>--}}

{{--    <div class="pull-right mx-5">--}}
{{--        @if (Auth::check())--}}
{{--            <a href="javascript:void" onclick="$('#logout-form').submit();">--}}
{{--                Logout--}}
{{--            </a>--}}
{{--        @endif--}}
{{--    </div>--}}


{{--    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
{{--        @csrf--}}
{{--    </form>--}}
{{--</nav>--}}

<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand"><b style="color: #007BFF; ">{{$title}}</b></a>

{{--        <form class="d-flex" action="{{route('logout')}}" method="POST">--}}
{{--            @csrf--}}
{{--            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">--}}
{{--            <button class="btn btn-outline-primary" style="border: none"  type="submit">Logout</button>--}}
{{--        </form>--}}
    </div>
</nav>
