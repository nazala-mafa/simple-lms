@if (false)
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
        {{ config('app.name', 'Laravel') }}
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav me-auto">
          @auth
            @role('Super Admin')
              <li class="nav-item dropdown">
                <a id="master-drop-down" class="nav-link dropdown-toggle" href="#" role="button"
                  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  Master
                </a>

                <div class="dropdown-menu m-0" aria-labelledby="master-drop-down">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                      <a href="{{ route('master.user.index') }}" class="nav-link">Users</a>
                    </li>
                    <li class="list-group-item">
                      <a href="{{ route('master.school.index') }}" class="nav-link">Schools</a>
                    </li>
                  </ul>
                </div>
              </li>
            @endrole

            <li class="nav-item dropdown">
              <a id="master-drop-down" class="nav-link dropdown-toggle" href="#" role="button"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                LMS
              </a>

              <div class="dropdown-menu m-0" aria-labelledby="master-drop-down">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">
                    <a href="{{ route('lms.course.index') }}" class="nav-link">Courses</a>
                  </li>
                  <li class="list-group-item">
                    <a href="{{ route('lms.quiz.index') }}" class="nav-link">Quizzes</a>
                  </li>
                  <li class="list-group-item">
                    <a href="{{ route('lms.question.index') }}" class="nav-link">Questions</a>
                  </li>
                  <li class="list-group-item">
                    <a href="{{ route('lms.module.index') }}" class="nav-link">Modules</a>
                  </li>
                  <li class="list-group-item">
                    <a href="{{ route('lms.my.course.index') }}" class="nav-link">My Course</a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a href="{{ route('product.index') }}" class="nav-link">Product</a>
            </li>
          @endauth
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ms-auto">
          <!-- Authentication Links -->
          @guest
            @if (Route::has('login'))
              <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
            @endif

            @if (Route::has('register'))
              <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
            @endif
          @else
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
              </a>

              <div class="dropdown-menu dropdown-menu-end m-0" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </div>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>
@endif

@guest
  <div style="height: 90px;"></div>
  <nav
    class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
    <div class="container">
      <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="{{ url('/') }}">
        {{ isset($title) ? $title : config('app.name', 'Laravel') }}
      </a>
      <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
        data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
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
                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page"
                  href="{{ route('login') }}">
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
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
              </a>

              <div class="dropdown-menu dropdown-menu-end m-0" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </div>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>
@endguest
