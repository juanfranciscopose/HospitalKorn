@guest
  <nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <a class="navbar-brand text-white font-weight-bold" href="{{ route('show-index') }}">@yield('title_nav')</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link text-white" href="{{ route('show-institution') }}">Instituciones</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link text-white" href="{{ route('show-login') }}">Iniciar sesión</a>
          </li>
      </ul>
    </div>
  </nav>
@else
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
      <a class="navbar-brand text-white font-weight-bold" href="{{ route('show-index') }}">@yield('title_nav')</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          @can('patient_index')
            <li class="nav-item active">
              <a class="nav-link text-white" href="{{ route('show-patients') }}">Pacientes</a>
            </li>
          @endcan
          @can('attention_index')
            <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('show-attentions') }}">Atención</a>
            </li>
          @endcan
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Administración
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              @can('user_index')
                <a class="dropdown-item" href="{{ route('show-users') }}">Usuarios</a>
              @endcan
              @hasrole('Admin')
                <a class="dropdown-item" href="{{ route('show-config') }}">Configuración</a>
              @endhasrole
              <a class="dropdown-item" href="#">Reportes</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{$email}}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="{{ route('show-pass') }}">Cambiar Contraseña</a>
              <a class="dropdown-item" href="{{ route('logout') }}">Cerrar Sesión</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
@endguest

