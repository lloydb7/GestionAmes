<?php if(Auth::check()): ?> <!-- Vérifie que l'utilisateur est connecté -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Logo -->
    <a href="<?php echo e(route('dashboard')); ?>" class="brand-link">
        <span class="brand-text font-weight-light">Bon Berger ICC Gabon</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Utilisateur Connecté -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <i class="fas fa-user-circle fa-2x text-white"></i>
            </div>
            <div class="info">
                <?php if(Auth::check()): ?> 
                    <a href="#" class="d-block"><?php echo e(Auth::user()->name); ?></a>
                    <span class="badge badge-info"><?php echo e(ucfirst(Auth::user()->role)); ?></span>
                <?php else: ?>
                    <a href="#" class="d-block">Invité</a>
                    <span class="badge badge-secondary">Non connecté</span>
                <?php endif; ?>
            </div>
        </div>

        <!-- Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                <!-- Tableau de bord -->
                <li class="nav-item">
                    <a href="<?php echo e(route('dashboard')); ?>" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Tableau de Bord</p>
                    </a>
                </li>

              

                    <!-- Gestion des Utilisateurs (Super Admin et Admin Général) -->
                    <?php if(Auth::user()->role === 'super_admin' || Auth::user()->role === 'admin_general'): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('users.index')); ?>" class="nav-link">
                                <i class="nav-icon fas fa-user-shield"></i>
                                <p>Gestion des Stars</p>
                            </a>
                        </li>

                        <!-- Gestion des Familles Impact -->
                        <li class="nav-item">
                            <a href="<?php echo e(route('familles.index')); ?>" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Familles Impact</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo e(route('rapport.tableau')); ?>" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>Tableau Suivi des Âmes</p>
                            </a>
                        </li>
                    <?php endif; ?>

                    <!-- Gestion des Âmes évangélisées -->
                    <li class="nav-item">
                        <a href="<?php echo e(route('ames.index')); ?>" class="nav-link">
                            <i class="nav-icon fas fa-cross"></i>
                            <p>Âmes évangélisées</p>
                        </a>
                    </li>

                    <!-- Gestion du Suivi des Âmes -->
                    <li class="nav-item">
                        <a href="<?php echo e(route('suivis.index')); ?>" class="nav-link">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>Suivi des Âmes</p>
                        </a>
                    </li>

                    <!-- Gestion des Entretiens -->
                    <li class="nav-item">
                        <a href="<?php echo e(route('entretiens.liste_entretiens')); ?>" class="nav-link">
                            <i class="nav-icon fas fa-comments"></i>
                            <p>Entretiens</p>
                        </a>
                    </li>

                    <!-- Bouton Déconnexion -->
                    <li class="nav-item">
                        <a href="#" class="nav-link"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Déconnexion</p>
                        </a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                            <?php echo csrf_field(); ?>
                        </form>
                    </li>

            </ul>
        </nav>
    </div>

</aside>
<?php endif; ?> <!-- Fin de Auth::check() -->
<?php /**PATH C:\Users\barrol\OneDrive - World Health Organization\Documents\TRAININGS\LARAVEL APPS\GestionAmes\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>