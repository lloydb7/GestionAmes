

<?php $__env->startSection('title', 'Tableau de Suivi des Âmes'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h3 class="text-center mb-4">Tableau de Suivi des Âmes</h3>

    <!-- Bouton d'exportation CSV -->
    <a href="<?php echo e(route('rapport.exportCSV')); ?>" class="btn btn-success mb-3">
         <i class="fas fa-file-csv"></i> Exporter en CSV
    </a>

    <!-- Tableau des données -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center">
            <thead class="bg-light">
                <tr>
                    <th>Date Premier Contact</th>
                    <th>Évangéliste (Star)</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Téléphone</th>
                    <th>Dernier Appel</th>
                    <th>Venu à l'Église</th>
                    <th>Famille d'Impact</th>
                    <th>Formation Initiale</th>
                    <th>Numéro Entretien</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e(\Carbon\Carbon::parse($row->date_premier_contact)->format('d/m/Y')); ?></td>
                    <td><?php echo e($row->star_name); ?></td>
                    <td><?php echo e($row->nom); ?></td>
                    <td><?php echo e($row->prenom); ?></td>
                    <td><?php echo e($row->telephone); ?></td>
                    <td><?php echo e($row->dernier_suivi ? \Carbon\Carbon::parse($row->dernier_suivi)->format('d/m/Y') : 'N/A'); ?></td>
                    <td><?php echo e($row->venu_eglise); ?></td>
                    <td><?php echo e($row->famille_impact); ?></td>
                    <td><?php echo e($row->formation_initiale); ?></td>
                    <td><?php echo e($row->numero_entretien); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="10" class="text-center text-muted">Aucune donnée disponible.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

    
    </div>
</div>
<?php $__env->stopSection(); ?>

<!-- Swag Pagination Style -->
<style>
.pagination .page-item.active .page-link {
    background-color: #6610f2;
    color: white;
    border-radius: 50%;
    border: none;
}

.pagination .page-link {
    color: #6610f2;
    margin: 0 4px;
    border-radius: 50%;
    border: 1px solid #6610f2;
}

.pagination .page-link:hover {
    background-color: #6610f2;
    color: white;
}
</style>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\barrol\OneDrive - World Health Organization\Documents\TRAININGS\LARAVEL APPS\GestionAmes\resources\views/rapports/tableau.blade.php ENDPATH**/ ?>