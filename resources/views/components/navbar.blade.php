<nav id="nav">
    <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none">
        @csrf
    </form>
    <ul class="main-menu nav navbar-nav navbar-right">
        <li><a href="{{ url('') }}">{{ __('web.home') }}</a></li>
        <li class="dropdown">
            <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                aria-expanded="false">
                {{ __('web.cats') }}<span class="caret"></span></a>
            <ul class="dropdown-menu">

                @foreach ($cats as $cat)
                    <li><a href="{{ url("categories/show/$cat->id") }}">
                            {{ $cat->name() }}
                            {{-- {{json_decode($cat->name,true)[App()->getLocale()]}} --}}
                        </a>
                    </li>
                @endforeach

            </ul>
        </li>
        <li><a href="{{ url('contact') }}">{{ __('web.contact') }}</a></li>
        @guest
            <li><a href="{{ url('login') }}">{{ __('web.signin') }}</a></li>
            <li><a href="{{ url('register') }}">{{ __('web.signup') }}</a></li>
        @endguest

        @auth
            @if (auth()->user()->role->name == 'student')
                <li><a href="{{ url('/profile') }}">{{ __('web.profile') }}</a></li>
            @else
                <li><a href="{{ url('/dashboard') }}">{{ __('web.dashboard') }}</a></li>
            @endif
            <li><a id="logout-link" href="#">{{ __('web.signout') }}</a></li>
        @endauth

        @if (App()->getLocale() == 'en')
            <li><a href="{{ url('lang/set/ar') }}">ع</a></li>
        @else
            <li><a href="{{ url('lang/set/en') }}">EN </a></li>
        @endif
    </ul>
</nav>
