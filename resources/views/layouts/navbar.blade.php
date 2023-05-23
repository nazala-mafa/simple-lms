  <div style="height: 90px;"></div>
  <nav
    class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
    <div class="container">
      <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="{{ url('/') }}">
        {{ isset($title) ? $title : config('app.name', 'Laravel') }}
      </a>
      <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation"
        aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon mt-2">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </span>
      </button>
      <div class="collapse navbar-collapse" id="navigation">
        <ul class="navbar-nav ms-auto">
          @guest
            @if (Route::has('login'))
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="{{ route('login') }}">
                  <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                  {{ __('Login') }}
                </a>
              </li>
            @endif

            @if (Route::has('register'))
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page"
                  href="{{ route('register') }}">
                  <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                  {{ __('Register') }}
                </a>
              </li>
            @endif
          @else
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="{{ url('home') }}">
                <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                {{ __('Dashboard') }}
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                {{ __('Logout') }}

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </a>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>
