<?php $__env->startSection('title', 'Tableau de Bord'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h3 class="text-center mb-4">Bienvenue, <?php echo e(Auth::user()->name); ?> 👋</h3>

    <!-- Section des Statistiques -->
    <div class="row">

        <!-- Total des Âmes évangélisées -->
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card bg-primary text-white shadow-lg">
                <div class="card-body text-center">
                    <h5><i class="fas fa-users"></i> Total des Âmes évangélisées</h5>
                    <h3><?php echo e($total_ames); ?></h3>
                </div>
            </div>
        </div>

        <!-- Accepté le Christ -->
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card bg-success text-white shadow-lg">
                <div class="card-body text-center">
                    <h5><i class="fas fa-hands-helping"></i> Âmes ayant accepté Christ</h5>
                    <h3><?php echo e($total_accept_christ); ?></h3>
                    <span class="badge bg-light text-dark"><?php echo e($pourcent_accept); ?>%</span>
                </div>
            </div>
        </div>

        <!-- Total des Suivis -->
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card bg-info text-white shadow-lg">
                <div class="card-body text-center">
                    <h5><i class="fas fa-user-check"></i> Âmes suivies</h5>
                    <h3><?php echo e($total_suivis); ?></h3>
                    <span class="badge bg-light text-dark"><?php echo e($pourcent_suivi); ?>%</span>
                </div>
            </div>
        </div>

        <!-- Venues à l'Église -->
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card bg-warning text-white shadow-lg">
                <div class="card-body text-center">
                    <h5><i class="fas fa-church"></i> Venu à l'Église</h5>
                    <h3><?php echo e($total_eglise); ?></h3>
                    <span class="badge bg-light text-dark"><?php echo e($pourcent_eglise); ?>%</span>
                </div>
            </div>
        </div>

        <!-- Famille d'Impact -->
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card bg-secondary text-white shadow-lg">
                <div class="card-body text-center">
                    <h5><i class="fas fa-users-cog"></i> Famille d'Impact</h5>
                    <h3><?php echo e($total_famille); ?></h3>
                    <span class="badge bg-light text-dark"><?php echo e($pourcent_famille); ?>%</span>
                </div>
            </div>
        </div>

        <!-- Formation Initiale -->
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card bg-dark text-white shadow-lg">
                <div class="card-body text-center">
                    <h5><i class="fas fa-book-reader"></i> Formation Initiale</h5>
                    <h3><?php echo e($total_fi); ?></h3>
                    <span class="badge bg-light text-dark"><?php echo e($pourcent_fi); ?>%</span>
                </div>
            </div>
        </div>

        <!-- Premier Entretien -->
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card bg-primary text-white shadow-lg">
                <div class="card-body text-center">
                    <h5><i class="fas fa-comment-dots"></i> Premier Entretien</h5>
                    <h3><?php echo e($total_premier_entretien); ?></h3>
                    <span class="badge bg-light text-dark"><?php echo e($pourcent_premier); ?>%</span>
                </div>
            </div>
        </div>

        <!-- Deuxième Entretien -->
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card bg-success text-white shadow-lg">
                <div class="card-body text-center">
                    <h5><i class="fas fa-comment-dots"></i> Deuxième Entretien</h5>
                    <h3><?php echo e($total_deuxieme_entretien); ?></h3>
                    <span class="badge bg-light text-dark"><?php echo e($pourcent_deuxieme); ?>%</span>
                </div>
            </div>
        </div>

        <!-- Troisième Entretien -->
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card bg-info text-white shadow-lg">
                <div class="card-body text-center">
                    <h5><i class="fas fa-comment-dots"></i> Troisième Entretien</h5>
                    <h3><?php echo e($total_troisieme_entretien); ?></h3>
                    <span class="badge bg-light text-dark"><?php echo e($pourcent_troisieme); ?>%</span>
                </div>
            </div>
        </div>

        <!-- Total des Stars uniquement pour Admin -->
        <?php if(Auth::user()->role === 'super_admin' || Auth::user()->role === 'admin_general'): ?>
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card bg-warning text-white shadow-lg">
                <div class="card-body text-center">
                    <h5><i class="fas fa-star"></i> Total des Stars</h5>
                    <h3><?php echo e($total_stars); ?></h3>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\barrol\OneDrive - World Health Organization\Documents\TRAININGS\LARAVEL APPS\GestionAmes\resources\views/dashboard.blade.php ENDPATH**/ ?>