@extends('web.layout')


@section('main')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success">
                    A new verification link has been sent to the email address you provided during registration.
                </div>
            @endif
            <div class="contact-form ">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="main-button icon-button ">
                        {{__('web.verifyEmail')}}
                    </button>
                </form>
            </div>
        </div>

    </div>
@endsection
