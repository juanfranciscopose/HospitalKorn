@guest

  <div class="row bg-dark text-white top-navbar">
    <div class="mt-2 col-sm-6">
      <ul class="ml-2 navbar-nav navbar-expand-lg">
        <li class="nav-item">
          <span class="bold">Informes: (221) - @yield('phone_info')</span>
        </li>
        <li class="mr-2 ml-2 nav-item">
          <span class="bold">|</span>
        </li>
        <li class="nav-item">
          <span class="bold">Turnos: (221) - @yield('phone_turn')</span>
        </li>
      </ul>
    </div>
    <div class="col-sm-6">
      <ul class="mr-4 navbar-nav navbar-expand-lg justify-content-end">
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('show-login') }}">Iniciar sesión</a>
        </li>
      </ul>
    </div>
  </div>

  <nav class="shadow navbar navbar-expand-lg navbar-light second-navbar">
    <a class="navbar-brand" href="{{ route('show-index') }}">
      <img src="{{ url('img/logoTransparentBlue.png') }}" class="second-navbar-img">
    </a>
    <a class="navbar-brand text-black font-weight-bold" href="{{ route('show-index') }}">@yield('title_nav')</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav hover-nav">
          <li class="form-inline nav-item hover-item p-0">
            <a class="nav-link bold item pr-4 pl-4" href="{{ route('show-institution') }}">Otras Instituciones</a>
          </li>
      </ul>
    </div>
  </nav>

@else

    <nav class="shadow navbar navbar-expand-lg navbar-light second-navbar">
      <a class="navbar-brand" href="{{ route('show-index') }}">
        <img src="{{ url('img/logoTransparentBlue.png') }}" class="second-navbar-img">
      </a>
      <a class="navbar-brand  text-black font-weight-bold" href="{{ route('show-index') }}">@yield('title_nav')</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav hover-nav">
          @can('patient_index')
            <li class="nav-item hover-item p-0">
              <a class="nav-link text-black bold item pr-4 pl-4" href="{{ route('show-patients') }}">Pacientes</a>
            </li>
          @endcan
          @can('attention_index')
            <li class="nav-item hover-item p-0">
              <a class="nav-link text-black bold item pr-4 pl-4" href="{{ route('show-attentions') }}">Atención</a>
            </li>
          @endcan
          <li class="nav-item dropdown hover-item p-0">
            <a class="nav-link dropdown-toggle text-black bold item pr-4 pl-4" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Administración
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              @can('user_index')
                <a class="dropdown-item text-black bold item pr-4 pl-4" href="{{ route('show-users') }}">Usuarios</a>
              @endcan
              @hasrole('Admin')
                <a class="dropdown-item text-black bold item pr-4 pl-4" href="{{ route('show-config') }}">Configuración</a>
              @endhasrole
              @can('report_index')
                <a class="dropdown-item text-black bold item pr-4 pl-4" href="{{ route('show-report') }}">Reportes</a>
              @endcan
            </div>
          </li>
          <li class="nav-item dropdown hover-item p-0 ml-auto">
            <a class="nav-link dropdown-toggle  text-black bold item pr-4 pl-4" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{$email}}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item text-black bold item pr-4 pl-4" href="{{ route('show-pass') }}">Cambiar Contraseña</a>
              <a class="dropdown-item text-black bold item pr-4 pl-4" href="{{ route('logout') }}">Cerrar Sesión</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>

@endguest

