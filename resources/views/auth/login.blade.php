
@extends('web.layout')

@section('main')<!-- Hero-area -->
    <div class="hero-area section">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay" style="background-image:url({{asset('web/img/home-background.jpg')}})"></div>
        <!-- /Backgound Image -->

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <ul class="hero-area-tree">
                        <li><a href="#">{{__('web.home')}} </a></li>
                        <li>{{__('web.signin')}} </li>
                    </ul>
                    <h1 class="white-text">{{__('web.signinDesc')}}</h1>

                </div>
            </div>
        </div>

    </div>
    <!-- /Hero-area -->

    <!-- Contact -->
    <div id="contact" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- login form -->
                <div class="col-md-6 col-md-offset-3">
                    <div class="contact-form">
                        <h4>{{ __('web.signin') }}</h4>
                        @include('web.inc.messages')
                        <form method="POST" action="{{ url('login') }}">
                            @csrf
                            <div class="form-group">
                                <input class="form-control" type="email" name="email" id="email" placeholder="{{ __('web.email') }}">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="password" id="password" placeholder="{{ __('web.password') }}">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">{{ __('web.remember') }}</label>
                            </div>
                            <button type="submit" class="main-button icon-button pull-right">{{ __('web.signin') }}</button>
                            <br>
                            <a href="{{ url('/forgot-password') }}">{{ __('web.forgetPassword') }}</a>
                        </form>
                    </div>
                </div>

                <!-- /login form -->

            </div>
            <!-- /row -->

        </div>
        <!-- /container -->

    </div>
    <!-- /Contact -->

@endsection
