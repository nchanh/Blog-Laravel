<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="https://www.flowkl.com/">Flowkl</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/">{{ __('custom.home') }}</a>
                </li>
            </ul>
            <ul class="navbar-nav d-flex">
                <li class="nav-item">
                    <a class="nav-link @if (session('website_language') == 'en') active @endif" href="{{ route('change-language', ['en']) }}">English</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (session('website_language') == 'vi') active @endif" href="{{ route('change-language', ['vi']) }}">Tiếng Việt</a>
                </li>
                <li class="nav-item">
                     <span class="nav-link">|</span>
                </li>
                @if (!Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('login') }}">{{ __('custom.login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('register.get') }}">{{ __('custom.register') }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu nav__dropdown" aria-labelledby="navbarDropdown">
                            @if (Auth::user()->can_post())
                                <li><a class="dropdown-item" href="{{ route('post.create') }}">{{ __('custom.add_new_post') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('user.posts', ['id' => Auth::user()->id ]) }}">{{ __('custom.my_posts') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('user.profile', ['id' => Auth::user()->id ]) }}">{{ __('custom.my_profile') }}</a></li>
                            @elseif(Auth::user()->is_subscriber())
                                <li><a class="dropdown-item" href="{{ route('user.profile', ['id' => Auth::user()->id ]) }}">{{ __('custom.my_profile') }}</a></li>
                            @endif
                            <li><a class="dropdown-item" href="{{ route('signOut') }}">{{ __('custom.logout') }}</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
