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
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a href="{{ route('quiz.index') }}" class="nav-link">Quiz</a>
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
