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
    <?php if(Auth::check()): ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user"></i> <?php echo e(Auth::user()->name); ?>

            </a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <li><a href="<?php echo e(route('profile')); ?>" class="dropdown-item"><i class="fas fa-user-circle mr-2"></i> Profil</a></li>
                <li><div class="dropdown-divider"></div></li>
                <li>
                    <a href="#" class="dropdown-item"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
                    </a>
                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                        <?php echo csrf_field(); ?>
                    </form>
                </li>
            </ul>
        </li>
    <?php endif; ?>
    </ul>
</nav>
<?php /**PATH C:\Users\barrol\OneDrive - World Health Organization\Documents\TRAININGS\LARAVEL APPS\GestionAmes\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>