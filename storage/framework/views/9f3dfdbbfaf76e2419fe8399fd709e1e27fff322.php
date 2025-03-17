

<?php $__env->startSection('title', 'Liste des Âmes Évangélisées'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h3 class="card-title"><i class="fas fa-cross"></i> Liste des Âmes</h3>
        <a href="<?php echo e(route('ames.create')); ?>" class="btn btn-dark">
            <i class="fas fa-plus-circle"></i> Ajouter une Âme
        </a>
    </div>

    <div class="card-body">
        <!-- Champ de recherche -->
        <div class="mb-4">
            <form method="GET" action="<?php echo e(route('ames.index')); ?>" class="d-flex align-items-center justify-content-center">
                <!-- Champ de recherche avec icône -->
                <div class="input-group shadow-sm" style="max-width: 400px;">
                    <span class="input-group-text bg-primary text-white"><i class="fas fa-search"></i></span>
                    <input type="text" name="search" class="form-control border-primary" placeholder="Rechercher une âme..." 
                        value="<?php echo e(request('search')); ?>">
                </div>

                <!-- Bouton de recherche stylé -->
                <button class="btn btn-primary ms-3 shadow" type="submit">
                    <i class="fas fa-search"></i> Rechercher
                </button>

                <!-- Bouton de réinitialisation stylé -->
                <?php if(request('search')): ?>
                    <a href="<?php echo e(route('ames.index')); ?>" class="btn btn-danger ms-3 shadow">
                        <i class="fas fa-times-circle"></i> Réinitialiser
                    </a>
                <?php endif; ?>
            </form>
        </div>

        <div class="table-responsive">
        <!-- Tableau des âmes -->
            <table class="table table-hover table-bordered text-center">
                <thead class="bg-light">
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date de Premier Contact</th>
                        <th>Prière du Salut</th>
                        <th>Invitation au Temple</th>
                        <th>Formation Initiale</th>
                        <th>STAR</th>
                        <th>Famille Impact</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $ames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ame): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><strong><?php echo e($ame->nom); ?></strong></td>
                        <td><?php echo e($ame->prenom); ?></td>
                        <td><?php echo e($ame->date_premier_contact ? \Carbon\Carbon::parse($ame->date_premier_contact)->format('d/m/Y') : 'N/A'); ?></td>
                        <td><span class="badge <?php echo e($ame->priere_du_salut ? 'bg-success' : 'bg-danger'); ?>"><?php echo e($ame->priere_du_salut ? 'Oui' : 'Non'); ?></span></td>
                        <td><span class="badge <?php echo e($ame->invitation_temple ? 'bg-success' : 'bg-danger'); ?>"><?php echo e($ame->invitation_temple ? 'Oui' : 'Non'); ?></span></td>
                        <td><span class="badge <?php echo e($ame->invitation_fi ? 'bg-success' : 'bg-danger'); ?>"><?php echo e($ame->invitation_fi ? 'Oui' : 'Non'); ?></span></td>
                        <td><span class="badge <?php echo e($ame->user ? 'bg-success' : 'bg-secondary'); ?>"><?php echo e($ame->user->name ?? 'Non assigné'); ?></span></td>
                        <td><span class="badge <?php echo e($ame->familleImpact ? 'bg-info' : 'bg-secondary'); ?>"><?php echo e($ame->familleImpact->nom ?? 'Non affecté'); ?></span></td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="fas fa-cog"></i> Actions
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo e(route('ames.show', $ame->id)); ?>" class="dropdown-item"><i class="fas fa-eye"></i> Voir</a></li>
                                    <li><a href="<?php echo e(route('ames.edit', $ame->id)); ?>" class="dropdown-item"><i class="fas fa-edit"></i> Modifier</a></li>

                                    <?php if(Auth::user()->role === 'star'): ?>
                                    <li><a href="<?php echo e(route('suivis.create', $ame->id)); ?>" class="dropdown-item"><i class="fas fa-chart-line"></i> Ajouter Suivi</a></li>
                                    <li><a href="<?php echo e(route('entretiens.create', $ame->id)); ?>" class="dropdown-item"><i class="fas fa-comments"></i> Ajouter Entretien</a></li>
                                    <?php endif; ?>

                                    <li>
                                        <form action="<?php echo e(route('ames.destroy', $ame->id)); ?>" method="POST" class="dropdown-item">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('Voulez-vous vraiment supprimer cette âme ?');">
                                                <i class="fas fa-trash"></i> Supprimer
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <!-- Pagination Swag -->
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-lg shadow-lg">
                        <!-- Bouton "Précédent" -->
                        <?php if($ames->onFirstPage()): ?>
                            <li class="page-item disabled">
                                <span class="page-link bg-light text-muted"><i class="fas fa-angle-double-left"></i></span>
                            </li>
                        <?php else: ?>
                            <li class="page-item">
                                <a class="page-link text-primary border-primary" href="<?php echo e($ames->previousPageUrl()); ?>">
                                    <i class="fas fa-angle-double-left"></i>
                                </a>
                            </li>
                        <?php endif; ?>

                        <!-- Numéros de page stylés -->
                        <?php $__currentLoopData = $ames->getUrlRange(1, $ames->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="page-item <?php echo e($ames->currentPage() == $page ? 'active' : ''); ?>">
                                <a class="page-link <?php echo e($ames->currentPage() == $page ? 'bg-primary text-white border-primary' : 'text-primary border-primary'); ?>" href="<?php echo e($url); ?>">
                                    <?php echo e($page); ?>

                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <!-- Bouton "Suivant" -->
                        <?php if($ames->hasMorePages()): ?>
                            <li class="page-item">
                                <a class="page-link text-primary border-primary" href="<?php echo e($ames->nextPageUrl()); ?>">
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
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\barrol\OneDrive - World Health Organization\Documents\TRAININGS\LARAVEL APPS\GestionAmes\resources\views/ames/index.blade.php ENDPATH**/ ?>