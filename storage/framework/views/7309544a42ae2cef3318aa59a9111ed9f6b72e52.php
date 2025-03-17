

<?php $__env->startSection('title', 'Ajouter un Entretien pour ' . $ame->nom . ' ' . $ame->prenom); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0"><i class="fas fa-comments"></i> Ajouter un Entretien</h3>
            
            <!-- Affichage des erreurs -->
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <!--
            <a href="<?php echo e(route('entretiens.index', $ame->id)); ?>" class="btn btn-dark btn-sm">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
            -->
            <!-- Bouton Retour vers la page précédente -->
            <a href="<?php echo e(url()->previous()); ?>" class="btn btn-dark btn-sm">
                <i class="fas fa-arrow-left"></i> Retour
            </a>

        </div>

        <div class="card-body">
            <form action="<?php echo e(route('entretiens.store', $ame->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-calendar-alt"></i> Date de l'Entretien</label>
                    <input type="date" name="date_entretien" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-exclamation-triangle"></i> Défis rencontrés</label>
                    <textarea name="defis" class="form-control" rows="2"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-sticky-note"></i> Résumé/Recommandation</label>
                    <textarea name="resume" class="form-control" rows="2"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-chart-line"></i> Niveau d'Engagement</label>
                    <select name="evaluation" class="form-select">
                        <option value="faible">Faible Engagement</option>
                        <option value="moyen">Moyen Engagement</option>
                        <option value="engagé">Engagé</option>
                        <option value="très engagé">Très Engagé</option>
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\barrol\OneDrive - World Health Organization\Documents\TRAININGS\LARAVEL APPS\GestionAmes\resources\views/entretiens/create.blade.php ENDPATH**/ ?>