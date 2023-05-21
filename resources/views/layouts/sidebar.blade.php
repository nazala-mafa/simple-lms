@auth
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
        aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="{{ url('/') }}">
        <img src="/assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">{{ config('app.name', 'Laravel') }}</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">

        @role('Super Admin')
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#dashboardsExamples" class="nav-link active"
              aria-controls="dashboardsExamples" role="button" aria-expanded="false">
              <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text mt-2 ms-2">Master</span>
            </a>
            <div class="collapse" id="dashboardsExamples">
              <ul class="nav ms-4">
                <li class="nav-item">
                  <a class="nav-link " href="{{ route('master.user.index') }}">
                    <span class="sidenav-mini-icon"> U </span>
                    <span class="sidenav-normal"> Users </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " href="{{ route('master.school.index') }}">
                    <span class="sidenav-mini-icon"> S </span>
                    <span class="sidenav-normal"> Schools </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        @endrole

        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#_menu-2" class="nav-link active" aria-controls="_menu-2" role="button"
            aria-expanded="false">
            <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
              <i class="ni ni-hat-3 text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text mt-2 ms-2">LMS</span>
          </a>
          <div class="collapse" id="_menu-2">
            <ul class="nav ms-4">

              <li class="nav-item">
                <a class="nav-link " href="{{ route('lms.course.index') }}">
                  <span class="sidenav-mini-icon"> C </span>
                  <span class="sidenav-normal">Courses</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="{{ route('lms.quiz.index') }}">
                  <span class="sidenav-mini-icon"> Qz </span>
                  <span class="sidenav-normal">Quizzes</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="{{ route('lms.question.index') }}">
                  <span class="sidenav-mini-icon"> Q </span>
                  <span class="sidenav-normal">Questions</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="{{ route('lms.module.index') }}">
                  <span class="sidenav-mini-icon"> M </span>
                  <span class="sidenav-normal">Modules</span>
                </a>
              </li>

            </ul>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link active" href="{{ route('lms.my.course.index') }}">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-hat-3 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">My Course</span>
          </a>
        </li>


      </ul>
    </div>
    <div class="sidenav-footer mx-3 ">
      <a href="{{ route('logout') }}" class="btn btn-dark btn-sm w-100 mb-3">Signout</a>
    </div>
  </aside>
@endauth
