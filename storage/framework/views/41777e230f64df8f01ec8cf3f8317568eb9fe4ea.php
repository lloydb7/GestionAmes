

<?php $__env->startSection('title', 'Suivi des Âmes'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="card-title"><i class="fas fa-user-check"></i> Suivi des Âmes</h3>
        </div>

        <div class="card-body">
            <!-- Champ de recherche swag -->
            <div class="mb-4">
                <form method="GET" action="<?php echo e(route('suivis.index')); ?>" class="d-flex align-items-center justify-content-center">
                    <div class="input-group shadow-sm" style="max-width: 400px;">
                        <span class="input-group-text bg-primary text-white"><i class="fas fa-search"></i></span>
                        <input type="text" name="search" class="form-control border-primary" 
                               placeholder="Rechercher une âme suivie..." value="<?php echo e(request('search')); ?>">
                    </div>

                    <button class="btn btn-primary ms-3 shadow" type="submit">
                        <i class="fas fa-search"></i> Rechercher
                    </button>

                    <?php if(request('search')): ?>
                        <a href="<?php echo e(route('suivis.index')); ?>" class="btn btn-danger ms-3 shadow">
                            <i class="fas fa-times-circle"></i> Réinitialiser
                        </a>
                    <?php endif; ?>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center">
                    <thead class="bg-light">
                        <tr>
                            <th>Âme</th>
                            <th>Date Premier Contact</th>
                            <th>Date Dernier Appel</th>
                            <th>Venu à l'Église</th>
                            <th>Formation Initiale</th>
                            <th>Famille Impact</th>
                            <th>Star</th>
                            <?php if(Auth::user()->role === 'star'): ?>
                            <th>Star</th>
                            <?php endif; ?>
                            <th>Historique</th>
                            <th>Entretien</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $suivis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suivi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><strong><?php echo e($suivi->ame->nom); ?> <?php echo e($suivi->ame->prenom); ?></strong></td>
                            <td><?php echo e(\Carbon\Carbon::parse($suivi->ame->date_premier_contact)->format('d/m/Y')); ?></td>
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
                            <td><span class="badge bg-success"><?php echo e($suivi->user->name); ?></span></td>
                            <?php if(Auth::user()->role === 'star'): ?>
                            <td>

                                
                                    <a href="<?php echo e(route('suivis.create', $suivi->ame->id)); ?>" class="btn btn-sm btn-outline-primary shadow">
                                        <i class="fas fa-plus-circle"></i> Ajouter Suivi
                                    </a>
                            </td>
                            <?php endif; ?>
                            <td>
                                <!-- Bouton Historique -->
                                <a href="<?php echo e(route('suivis.historique', $suivi->ame->id)); ?>" class="btn btn-sm btn-outline-secondary shadow">
                                    <i class="fas fa-history"></i> Historique
                                </a>
                                

                            </td>
                            <td>
                                <!-- Ajout du bouton "Entretien" -->
                                <a href="<?php echo e(route('entretiens.index', $suivi->ame->id)); ?>" class="btn btn-outline-primary btn-sm shadow">
                                    <i class="fas fa-comments"></i> Entretiens
                                </a>
                            </td>
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

            <!-- CSS personnalisé pour la pagination -->
            <style>
                .pagination .page-item .page-link {
                    color: #007bff;
                    border: 1px solid #007bff;
                    padding: 10px 15px;
                    margin: 3px;
                    border-radius: 8px;
                    transition: all 0.3s ease-in-out;
                }

                .pagination .page-item.active .page-link {
                    background-color: #007bff;
                    color: white;
                    border-radius: 8px;
                    font-weight: bold;
                    box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
                }

                .pagination .page-item .page-link:hover {
                    background-color: #0056b3;
                    color: white;
                    transform: scale(1.1);
                }

                .pagination .page-item.disabled .page-link {
                    background-color: #e9ecef;
                    color: #6c757d;
                    border: none;
                    cursor: not-allowed;
                }

                .rounded-circle {
                    border-radius: 50px !important;
                }
            </style>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\barrol\OneDrive - World Health Organization\Documents\TRAININGS\LARAVEL APPS\GestionAmes\resources\views/suivis/index.blade.php ENDPATH**/ ?>