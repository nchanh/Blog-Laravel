<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="https://www.flowkl.com/">Flowkl</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/">Home</a>
                </li>
            </ul>
            <ul class="navbar-nav d-flex">
                @if (!Auth::check())
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/auth/login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/auth/register">Register</a>
                </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu nav__dropdown" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/new-post">Add new post</a></li>
                            <li><a class="dropdown-item" href="/user/id/posts">My Posts</a></li>
                            <li><a class="dropdown-item" href="/user/id">My Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('signOut') }}">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
