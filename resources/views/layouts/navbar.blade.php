<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Bouton menu latéral -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <!-- Menu utilisateur à droite -->
    <ul class="navbar-nav ml-auto">
    @if(Auth::check())
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user"></i> {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <li><a href="{{route('profile')}}" class="dropdown-item"><i class="fas fa-user-circle mr-2"></i> Profil</a></li>
                <li><div class="dropdown-divider"></div></li>
                <li>
                    <a href="#" class="dropdown-item"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    @endif
    </ul>
</nav>
