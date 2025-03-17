

<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex align-items-center">
            <h3 class="mb-0 flex-grow-1"><i class="fas fa-user"></i> Détails de l'Âme</h3>
            <!-- Bouton Retour vers la page précédente -->
            <a href="<?php echo e(url()->previous()); ?>" class="btn btn-dark btn-sm shadow">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>

        <div class="card-body">
            <h4 class="text-center text-uppercase fw-bold"><?php echo e($ame->nom); ?> <?php echo e($ame->prenom); ?></h4>

            <div class="row mt-4">
                <!-- Colonne 1 -->
                <div class="col-md-6">
                    <p><i class="fas fa-venus-mars"></i> <strong>Sexe :</strong> <?php echo e($ame->sexe); ?></p>
                    <p><i class="fas fa-birthday-cake"></i> <strong>Âge :</strong> <?php echo e($ame->age); ?> ans</p>
                    <p><i class="fas fa-map-marker-alt"></i> <strong>Adresse :</strong> <?php echo e($ame->adresse ?? 'Non renseigné'); ?></p>
                    <p><i class="fas fa-phone"></i> <strong>Téléphone :</strong> <?php echo e($ame->telephone ?? 'Non renseigné'); ?></p>
                    <p><i class="fas fa-user-tie"></i> <strong>Évangéliste en charge :</strong> <?php echo e($ame->user->name ?? 'Non assigné'); ?></p>
                </div>

                <!-- Colonne 2 -->
                <div class="col-md-6">
                    <p><i class="fas fa-users"></i> <strong>Famille Impact :</strong> <?php echo e($ame->familleImpact->nom ?? 'Non assigné'); ?></p>
                    <p><i class="fas fa-calendar-alt"></i> <strong>Date de Premier Contact :</strong> 
                        <?php echo e(\Carbon\Carbon::parse($ame->date_premier_contact)->format('d/m/Y') ?? 'Non renseigné'); ?>

                    </p>
                    <p><i class="fas fa-praying-hands"></i> <strong>Prière du Salut :</strong> 
                        <span class="badge <?php echo e($ame->priere_du_salut ? 'bg-success' : 'bg-danger'); ?>">
                            <?php echo e($ame->priere_du_salut ? 'Oui' : 'Non'); ?>

                        </span>
                    </p>
                    <p><i class="fas fa-church"></i> <strong>Invitation au Temple :</strong> 
                        <span class="badge <?php echo e($ame->invitation_temple ? 'bg-success' : 'bg-danger'); ?>">
                            <?php echo e($ame->invitation_temple ? 'Oui' : 'Non'); ?>

                        </span>
                    </p>
                    <p><i class="fas fa-book"></i> <strong>Formation Initiale :</strong> 
                        <span class="badge <?php echo e($ame->invitation_fi ? 'bg-success' : 'bg-danger'); ?>">
                            <?php echo e($ame->invitation_fi ? 'Oui' : 'Non'); ?>

                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Historique des Suivis -->
    <?php if($suivis->count() > 0): ?>
    <div class="card shadow-lg mt-4">
        <div class="card-header bg-secondary text-white">
            <h3 class="mb-0"><i class="fas fa-history"></i> Historique des Suivis</h3>
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
                <nav aria-label="Pagination">
                    <ul class="pagination pagination-lg shadow-lg">
                        <!-- Bouton "Précédent" -->
                        <?php if($suivis->onFirstPage()): ?>
                            <li class="page-item disabled">
                                <span class="page-link bg-light text-muted"><i class="fas fa-angle-double-left"></i></span>
                            </li>
                        <?php else: ?>
                            <li class="page-item">
                                <a class="page-link text-primary border-primary" href="<?php echo e($suivis->previousPageUrl()); ?>">
                                    <i class="fas fa-angle-double-left"></i>
                                </a>
                            </li>
                        <?php endif; ?>

                        <!-- Numéros de page stylisés -->
                        <?php $__currentLoopData = $suivis->getUrlRange(1, $suivis->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="page-item <?php echo e($suivis->currentPage() == $page ? 'active' : ''); ?>">
                                <a class="page-link <?php echo e($suivis->currentPage() == $page ? 'bg-primary text-white border-primary' : 'text-primary border-primary'); ?>" href="<?php echo e($url); ?>">
                                    <?php echo e($page); ?>

                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <!-- Bouton "Suivant" -->
                        <?php if($suivis->hasMorePages()): ?>
                            <li class="page-item">
                                <a class="page-link text-primary border-primary" href="<?php echo e($suivis->nextPageUrl()); ?>">
                                    <i class="fas fa-angle-double-right"></i>
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="page-item disabled">
                                <span class="page-link bg-light text-muted"><i class="fas fa-angle-double-right"></i></span>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
    <?php endif; ?>

    <!-- Historique des Entretiens -->
    <?php if($entretiens->count() > 0): ?>
    <div class="card shadow-lg mt-4">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0"><i class="fas fa-comments"></i> Historique des Entretiens</h3>
        </div>

        <div class="card-body">
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
                            <td><strong><?php echo e(\Carbon\Carbon::parse($entretien->date_entretien)->format('d/m/Y')); ?></strong></td>
                            <td>
                                <span class="badge <?php echo e($entretien->defis ? 'bg-warning text-dark' : 'bg-secondary'); ?>">
                                    <?php echo e($entretien->defis ?? 'Aucun'); ?>

                                </span>
                            </td>
                            <td><?php echo e($entretien->resume ?? 'Non spécifié'); ?></td>
                            <td>
                                <span class="badge 
                                    <?php echo e($entretien->evaluation == 'faible engagement' ? 'bg-danger' :
                                    ($entretien->evaluation == 'moyen engagement' ? 'bg-warning text-dark' :
                                    ($entretien->evaluation == 'fort engagement' ? 'bg-info' : 'bg-success'))); ?>">
                                    <?php echo e(ucfirst($entretien->evaluation)); ?>

                                </span>
                            </td>
                            <?php if(Auth::user()->role !== 'star'): ?>
                                <td><span class="badge bg-primary"><?php echo e($entretien->user->name); ?></span></td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination Stylisée -->
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Pagination">
                    <ul class="pagination pagination-lg shadow-lg">
                        <!-- Bouton "Précédent" -->
                        <?php if($entretiens->onFirstPage()): ?>
                            <li class="page-item disabled">
                                <span class="page-link bg-light text-muted"><i class="fas fa-angle-double-left"></i></span>
                            </li>
                        <?php else: ?>
                            <li class="page-item">
                                <a class="page-link text-primary border-primary" href="<?php echo e($entretiens->previousPageUrl()); ?>">
                                    <i class="fas fa-angle-double-left"></i>
                                </a>
                            </li>
                        <?php endif; ?>

                        <!-- Numéros de page stylisés -->
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
                                <a class="page-link text-primary border-primary" href="<?php echo e($entretiens->nextPageUrl()); ?>">
                                    <i class="fas fa-angle-double-right"></i>
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="page-item disabled">
                                <span class="page-link bg-light text-muted"><i class="fas fa-angle-double-right"></i></span>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\barrol\OneDrive - World Health Organization\Documents\TRAININGS\LARAVEL APPS\GestionAmes\resources\views/ames/show.blade.php ENDPATH**/ ?>