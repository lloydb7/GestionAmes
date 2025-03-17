

<?php $__env->startSection('title', 'Historique des Suivis'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <h3 class="card-title"><i class="fas fa-history"></i> Historique des Suivis - <?php echo e($ame->nom); ?> <?php echo e($ame->prenom); ?></h3>
            <a href="<?php echo e(route('suivis.index')); ?>" class="btn btn-dark btn-sm">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center">
                    <thead class="bg-light">
                        <tr>
                            <th>Date d'Appel</th>
                            <th>Venu à l'Église</th>
                            <th>Formation Initiale</th>
                            <th>Famille Impact</th>
                            <th>Niveau d'Engagement</th>

                            <?php if(Auth::user()->role !== 'star'): ?>
                                <th>Évangéliste</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $suivis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suivi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(\Carbon\Carbon::parse($suivi->date_appel)->format('d/m/Y')); ?></td>
                            <td>
                                <span class="badge <?php echo e($suivi->venu_eglise ? 'bg-success' : 'bg-danger'); ?>">
                                    <?php echo e($suivi->venu_eglise ? 'Oui ('.\Carbon\Carbon::parse($suivi->date_venu_eglise)->format('d/m/Y').')' : 'Non'); ?>

                                </span>
                            </td>
                            <td>
                                <?php if($suivi->formation_initiale): ?>
                                    <span class="badge bg-info">Commencé : <?php echo e(\Carbon\Carbon::parse($suivi->date_debut_formation)->format('d/m/Y')); ?> (<?php echo e(ucfirst($suivi->etat_formation)); ?>)</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Non inscrit</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($suivi->assiste_famille_impact): ?>
                                    <span class="badge bg-info">Présent : <?php echo e(\Carbon\Carbon::parse($suivi->date_famille_impact)->format('d/m/Y')); ?></span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Non assisté</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="badge 
                                    <?php echo e($suivi->niveau_engagement == 'faible' ? 'bg-danger' :
                                       ($suivi->niveau_engagement == 'moyen' ? 'bg-warning' :
                                       ($suivi->niveau_engagement == 'engagé' ? 'bg-info' : 'bg-success'))); ?>">
                                    <?php echo e(ucfirst($suivi->niveau_engagement)); ?>

                                </span>
                            </td>

                            <?php if(Auth::user()->role !== 'star'): ?>
                                <td><span class="badge bg-success"><?php echo e($suivi->user->name); ?></span></td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <!-- Pagination stylisée -->
            <div class="d-flex justify-content-center mt-4">
                <nav>
                    <ul class="pagination pagination-lg">
                        <!-- Bouton Précédent -->
                        <?php if($suivis->onFirstPage()): ?>
                            <li class="page-item disabled">
                                <span class="page-link rounded-circle"><i class="fas fa-angle-double-left"></i></span>
                            </li>
                        <?php else: ?>
                            <li class="page-item">
                                <a class="page-link rounded-circle" href="<?php echo e($suivis->previousPageUrl()); ?>">
                                    <i class="fas fa-angle-double-left"></i>
                                </a>
                            </li>
                        <?php endif; ?>

                        <!-- Numéros de Pages -->
                        <?php $__currentLoopData = $suivis->getUrlRange(1, $suivis->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="page-item <?php echo e($suivis->currentPage() == $page ? 'active' : ''); ?>">
                                <a class="page-link" href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <!-- Bouton Suivant -->
                        <?php if($suivis->hasMorePages()): ?>
                            <li class="page-item">
                                <a class="page-link rounded-circle" href="<?php echo e($suivis->nextPageUrl()); ?>">
                                    <i class="fas fa-angle-double-right"></i>
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="page-item disabled">
                                <span class="page-link rounded-circle"><i class="fas fa-angle-double-right"></i></span>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>

            <!-- Tableau des Entretiens -->
            <h4 class="text-center text-primary mt-5"><i class="fas fa-comments"></i> Entretiens de l'Âme</h4>
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center">
                    <thead class="bg-light">
                        <tr>
                            <th>Date d'Entretien</th>
                            <th>Défis</th>
                            <th>Résumé</th>
                            <th>Évaluation</th>
                            <?php if(Auth::user()->role !== 'star'): ?>
                                <th>Évangéliste</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $entretiens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entretien): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(\Carbon\Carbon::parse($entretien->date_entretien)->format('d/m/Y')); ?></td>
                            <td><?php echo e($entretien->defis ?? 'Aucun'); ?></td>
                            <td><?php echo e($entretien->resume ?? 'Non spécifié'); ?></td>
                            <td>
                            <span class="badge 
                                <?php echo e($entretien->evaluation == 'faible' ? 'bg-danger' :
                                ($entretien->evaluation == 'moyen' ? 'bg-warning' :
                                ($entretien->evaluation == 'engagé' ? 'bg-info' :
                                ($entretien->evaluation == 'très engagé' ? 'bg-success' : 'bg-secondary')))); ?>">
                                <?php echo e(ucfirst($entretien->evaluation)); ?>

                            </span>
                            </td>
                            <?php if(Auth::user()->role !== 'star'): ?>
                                <td><span class="badge bg-success"><?php echo e($entretien->user->name); ?></span></td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination stylisée entretiens-->
            <div class="d-flex justify-content-center mt-4">
                <nav>
                    <ul class="pagination pagination-lg">
                        <!-- Bouton Précédent -->
                        <?php if($suivis->onFirstPage()): ?>
                            <li class="page-item disabled">
                                <span class="page-link rounded-circle"><i class="fas fa-angle-double-left"></i></span>
                            </li>
                        <?php else: ?>
                            <li class="page-item">
                                <a class="page-link rounded-circle" href="<?php echo e($suivis->previousPageUrl()); ?>">
                                    <i class="fas fa-angle-double-left"></i>
                                </a>
                            </li>
                        <?php endif; ?>

                        <!-- Numéros de Pages -->
                        <?php $__currentLoopData = $suivis->getUrlRange(1, $suivis->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="page-item <?php echo e($suivis->currentPage() == $page ? 'active' : ''); ?>">
                                <a class="page-link" href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <!-- Bouton Suivant -->
                        <?php if($suivis->hasMorePages()): ?>
                            <li class="page-item">
                                <a class="page-link rounded-circle" href="<?php echo e($suivis->nextPageUrl()); ?>">
                                    <i class="fas fa-angle-double-right"></i>
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="page-item disabled">
                                <span class="page-link rounded-circle"><i class="fas fa-angle-double-right"></i></span>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\barrol\OneDrive - World Health Organization\Documents\TRAININGS\LARAVEL APPS\GestionAmes\resources\views/suivis/historique.blade.php ENDPATH**/ ?>