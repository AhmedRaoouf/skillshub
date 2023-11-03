@extends('web.layout')

@section('styles')
    <link rel="stylesheet" href="{{asset('web/css/TimeCircles.css')}}">
@endsection

@section('main')
    <!-- Hero-area -->
    <div class="hero-area section">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay"
            style="background-image:url({{ asset('web/img/blog-post-background.jpg') }})"></div>
        <!-- /Backgound Image -->

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <ul class="hero-area-tree">
                        <li><a href="{{url('/')}}">{{__('web.home')}}</a></li>
                        <li><a href="{{url('categories/show'.$exam->skill->category->id)}}">{{$exam->skill->category->name()}}</a></li>
                        <li><a href="{{url('skills/show/'.$exam->skill->id)}}">{{$exam->skill->name()}}</a></li>
                        <li>{{$exam->name()}}</li>
                    </ul>
                    <h1 class="white-text">{{$exam->name()}}</h1>
                    <ul class="blog-post-meta">
                        <li>{{Carbon\Carbon::parse($exam->created_at)->format('d M, Y')}}</li>
                        <li class="blog-meta-comments"><a href="#"><i class="fa fa-users"></i> {{$exam->users->count()}}</a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <!-- /Hero-area -->

    <!-- Blog -->
    <div id="blog" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- main blog -->
                <div id="main" class="col-md-9">

                    <!-- blog post -->
                    <div class="blog-post mb-5">
                        @include('web.inc.messages')

                            <form action="{{"/exams/submit/{$exam->id}"}}" method="POST" id='submit-form'>
                                @csrf
                                @foreach ($exam->questions as $index => $ques)
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">{{$index+1 ."- " . $ques->title}}</h3>
                                        </div>
                                        <div class="panel-body">
                                            @for ($i = 1; $i <= 4; $i++)
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="answers[{{$ques->id }}]" value="{{$i}}">
                                                    {{ $ques->{'option_' . $i} }}
                                                </label>
                                            </div>
                                            @endfor
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- /blog post -->

                            <div>
                                <button type="submit" class="main-button icon-button pull-left">{{__('web.submitBtn')}} </button>
                                <button class="main-button icon-button btn-danger pull-left ml-sm">{{__('web.cancelBtn')}} </button>
                            </div>
                        </form>
                </div>
                <!-- /main blog -->

                <!-- aside blog -->
                <div id="aside" class="col-md-3">

                    <!-- exam details widget -->
                    <ul class="list-group">
                        <li class="list-group-item">{{__('web.skill')}} :{{$exam->skill->name()}} </li>
                        <li class="list-group-item">{{__('web.questions')}} :{{$exam->questions_no}} </li>
                        <li class="list-group-item">{{__('web.duration')}} : {{$exam->duration_mins}} mins</li>
                        <li class="list-group-item">{{__('web.difficulty')}} :
                            @for ($i = 0; $i < $exam->difficulty; $i++)
                                <i class="fa fa-star"></i>
                            @endfor
                            @for ($i = 0; $i < (5 - $exam->difficulty); $i++)
                                <i class="fa fa-star-o"></i>
                            @endfor

                        </li>
                    </ul>
                    <!-- /exam details widget -->

                    <div class="duration-countdown" data-timer="{{$exam->duration_mins * 60 }}"></div>
                </div>
                <!-- /aside blog -->

            </div>
            <!-- row -->

        </div>
        <!-- container -->

    </div>
    <!-- /Blog -->
@endsection


@section('script')
    <script type="text/javascript" src="{{asset('web/js/TimeCircles.js')}}"></script>

    <script>
        $(".duration-countdown").TimeCircles({
            time:{
                Days:{show:false}
            },
            count_past_zero : false,
        }).addListener(countdownComplete);

    function countdownComplete(unit, value, total){
        if(total <= 0){
            $('#submit-form').submit();
        }
    };
    </script>
@endsection
