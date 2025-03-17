

<?php $__env->startSection('title', 'Détails de la Famille Impact'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0"><i class="fas fa-users"></i> Détails de la Famille Impact</h3>
        </div>

        <div class="card-body">
            <h4>Nom de la Famille : <?php echo e($famille->nom); ?></h4>
            <p><strong>Pilote 1 :</strong> <?php echo e($famille->pilote1_nom); ?> (<?php echo e($famille->pilote1_tel); ?>)</p>
            <?php if($famille->pilote2_nom): ?>
                <p><strong>Pilote 2 :</strong> <?php echo e($famille->pilote2_nom); ?> (<?php echo e($famille->pilote2_tel); ?>)</p>
            <?php endif; ?>

            <h4 class="mt-4">Liste des Âmes Affectées</h4>
            <?php if($ames->count() > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered text-center">
                        <thead class="bg-light">
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>A accepté le Seigneur</th>
                                <th>Invitation à l'Église</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $ames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ame): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><strong><?php echo e($ame->nom); ?></strong></td>
                                <td><?php echo e($ame->prenom); ?></td>
                                <td>
                                    <span class="badge <?php echo e($ame->priere_du_salut ? 'bg-success' : 'bg-danger'); ?>">
                                        <?php echo e($ame->priere_du_salut ? 'Oui' : 'Non'); ?>

                                    </span>
                                </td>
                                <td>
                                    <span class="badge <?php echo e($ame->invitation_temple ? 'bg-success' : 'bg-danger'); ?>">
                                        <?php echo e($ame->invitation_temple ? 'Oui' : 'Non'); ?>

                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-center text-muted">Aucune âme n'est rattachée à cette famille.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Bouton Retour -->
    <div class="text-center mt-3">
        <a href="<?php echo e(route('familles.index')); ?>" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Retour à la liste
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\barrol\OneDrive - World Health Organization\Documents\TRAININGS\LARAVEL APPS\GestionAmes\resources\views/familles/show.blade.php ENDPATH**/ ?>