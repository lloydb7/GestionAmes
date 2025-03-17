

<?php $__env->startSection('title', 'Mes Entretiens Réalisés'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="card-title"><i class="fas fa-list"></i> Mes Entretiens Réalisés</h3>
            <!--
            <a href="<?php echo e(route('entretiens.create', Auth::user()->id)); ?>" class="btn btn-success btn-sm shadow">
                <i class="fas fa-plus-circle"></i> Ajouter Entretien
            </a>
            -->
        </div>

        <div class="card-body">
            <!-- Champ de recherche swag -->
            <div class="mb-4">
                <form method="GET" action="<?php echo e(route('entretiens.liste_entretiens')); ?>" class="d-flex align-items-center justify-content-center">
                    <div class="input-group shadow-sm" style="max-width: 400px;">
                        <span class="input-group-text bg-primary text-white"><i class="fas fa-search"></i></span>
                        <input type="text" name="search" class="form-control border-primary" 
                            placeholder="Rechercher un entretien..." value="<?php echo e(request('search')); ?>">
                    </div>

                    <button class="btn btn-primary ms-3 shadow" type="submit">
                        <i class="fas fa-search"></i> Rechercher
                    </button>

                    <?php if(request('search')): ?>
                        <a href="<?php echo e(route('entretiens.liste_entretiens')); ?>" class="btn btn-danger ms-3 shadow">
                            <i class="fas fa-times-circle"></i> Réinitialiser
                        </a>
                    <?php endif; ?>
                </form>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center">
                    <thead class="bg-light">
                        <tr>
                            <th>Date</th>
                            <th>Âme</th>
                            <th># Entretien</th>
                            <th>Évaluation</th>
                            <th>Voir</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $entretiens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entretien): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(\Carbon\Carbon::parse($entretien->date_entretien)->format('d/m/Y')); ?></td>
                            <td><strong><?php echo e($entretien->ame->nom); ?> <?php echo e($entretien->ame->prenom); ?></strong></td>
                            <td><strong><?php echo e($entretien->numero_entretien); ?> </strong></td>
                            <td>
                                <span class="badge 
                                    <?php echo e($entretien->evaluation == 'faible engagement' ? 'bg-danger' :
                                       ($entretien->evaluation == 'moyen engagement' ? 'bg-warning' :
                                       ($entretien->evaluation == 'fort engagement' ? 'bg-info' : 'bg-success'))); ?>">
                                    <?php echo e(ucfirst($entretien->evaluation)); ?>

                                </span>
                            </td>
                            <td>                                
                                <a href="<?php echo e(route('entretiens.show', $entretien->id)); ?>" class="btn btn-outline-info btn-sm shadow">
                                    <i class="fas fa-eye"></i> Voir
                                </a>
                            </td>
                            <td>
                                <a href="<?php echo e(route('entretiens.edit', $entretien->id)); ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                            </td>

                            <td>
                                <form action="<?php echo e(route('entretiens.destroy', $entretien->id)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous supprimer cet entretien ?');">
                                        <i class="fas fa-trash"></i> Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination stylisée -->
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Pagination">
                    <ul class="pagination pagination-lg shadow-lg">
                        <!-- Bouton "Précédent" -->
                        <?php if($entretiens->onFirstPage()): ?>
                            <li class="page-item disabled">
                                <span class="page-link bg-light text-muted rounded-circle">
                                    <i class="fas fa-angle-double-left"></i>
                                </span>
                            </li>
                        <?php else: ?>
                            <li class="page-item">
                                <a class="page-link text-primary border-primary rounded-circle" href="<?php echo e($entretiens->previousPageUrl()); ?>">
                                    <i class="fas fa-angle-double-left"></i>
                                </a>
                            </li>
                        <?php endif; ?>

                        <!-- Numéros de Pages Stylés -->
                        <?php $__currentLoopData = $entretiens->getUrlRange(1, $entretiens->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="page-item <?php echo e($entretiens->currentPage() == $page ? 'active' : ''); ?>">
                                <a class="page-link <?php echo e($entretiens->currentPage() == $page ? 'bg-primary text-white border-primary' : 'text-primary border-primary'); ?>" href="<?php echo e($url); ?>">
                                    <?php echo e($page); ?>

                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <!-- Bouton "Suivant" -->
                        <?php if($entretiens->hasMorePages()): ?>
                            <li class="page-item">
                                <a class="page-link text-primary border-primary rounded-circle" href="<?php echo e($entretiens->nextPageUrl()); ?>">
                                    <i class="fas fa-angle-double-right"></i>
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="page-item disabled">
                                <span class="page-link bg-light text-muted rounded-circle">
                                    <i class="fas fa-angle-double-right"></i>
                                </span>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\barrol\OneDrive - World Health Organization\Documents\TRAININGS\LARAVEL APPS\GestionAmes\resources\views/entretiens/liste_entretiens.blade.php ENDPATH**/ ?>