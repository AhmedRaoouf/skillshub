@extends('web.layout')

@section('main')
    <!-- Hero-area -->
    <div class="hero-area section">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay" style="background-image:url({{ asset('web/img/home-background.jpg') }})">
        </div>
        <!-- /Backgound Image -->

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <ul class="hero-area-tree">
                        <li><a href="#">{{ __('web.home') }} </a></li>
                        <li>{{ __('web.profile') }} </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <!-- /Hero-area -->

    <!-- Contact -->
    <div id="contact" class="section">

        <!-- container -->
        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Exam Name</th>
                        <th scope="col">Score</th>
                        <th scope="col">Time (mins.)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($exams as $exam)
                        <tr>
                            <th scope="row">1</th>
                            <td>{{$exam->name()}}</td>
                            <td>{{$exam->pivot->score ?? 'Null'}}</td>
                            <td>{{$exam->pivot->time_mins ?? 'Null'}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /container -->

    </div>
    <!-- /Contact -->
@endsection
