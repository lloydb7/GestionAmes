

<?php $__env->startSection('title', 'Gestion des Utilisateurs'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <h3 class="card-title"><i class="fas fa-users"></i> Gestion des Utilisateurs</h3>
                    <a href="<?php echo e(route('users.create')); ?>" class="btn btn-dark btn-sm">
                        <i class="fas fa-user-plus"></i> Créer un Utilisateur
                    </a>
                </div>

                <!-- Messages Flash -->
                <?php if(session('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                        <?php echo e(session('error')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                        <?php echo e(session('success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <div class="card-body">
                    <!-- Champ de recherche stylisé -->
                    <div class="mb-4">
                        <form method="GET" action="<?php echo e(route('users.index')); ?>" class="d-flex align-items-center justify-content-center">
                            <div class="input-group shadow-sm" style="max-width: 400px;">
                                <span class="input-group-text bg-primary text-white"><i class="fas fa-search"></i></span>
                                <input type="text" name="search" class="form-control border-primary" 
                                       placeholder="Rechercher un utilisateur..." value="<?php echo e(request('search')); ?>">
                            </div>

                            <button class="btn btn-primary ms-3 shadow" type="submit">
                                <i class="fas fa-search"></i> Rechercher
                            </button>

                            <?php if(request('search')): ?>
                                <a href="<?php echo e(route('users.index')); ?>" class="btn btn-danger ms-3 shadow">
                                    <i class="fas fa-times-circle"></i> Réinitialiser
                                </a>
                            <?php endif; ?>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Rôle</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($user->role !== 'super_admin'): ?> <!-- Ne pas afficher les Super Admins -->
                                    <tr>
                                        <td class="fw-bold"><?php echo e($user->name); ?></td>
                                        <td><?php echo e($user->email); ?></td>
                                        <td>
                                            <span class="badge 
                                                <?php echo e($user->role == 'admin_general' ? 'bg-warning' : 'bg-success'); ?>">
                                                <?php echo e(ucfirst(str_replace('_', ' ', $user->role))); ?>

                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <!-- Bouton Voir -->
                                            <a href="<?php echo e(route('users.show', $user->id)); ?>" class="btn btn-sm btn-outline-info" title="Voir">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <!-- Bouton Modifier -->
                                            <a href="<?php echo e(route('users.edit', $user->id)); ?>" class="btn btn-sm btn-outline-warning" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- Bouton Supprimer -->
                                            <form action="<?php echo e(route('users.destroy', $user->id)); ?>" method="POST" style="display:inline;">
                                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');" title="Supprimer">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                        <!-- Pagination avec un style amélioré -->
                        <!-- Pagination stylisée -->
                        <div class="d-flex justify-content-center mt-4">
                            <ul class="pagination pagination-lg shadow-sm">
                                <!-- Bouton "Précédent" -->
                                <?php if($users->onFirstPage()): ?>
                                    <li class="page-item disabled">
                                        <span class="page-link"><i class="fas fa-angle-double-left"></i></span>
                                    </li>
                                <?php else: ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?php echo e($users->previousPageUrl()); ?>">
                                            <i class="fas fa-angle-double-left"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <!-- Liens des pages -->
                                <?php $__currentLoopData = $users->getUrlRange(1, $users->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="page-item <?php echo e($users->currentPage() == $page ? 'active' : ''); ?>">
                                        <a class="page-link" href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <!-- Bouton "Suivant" -->
                                <?php if($users->hasMorePages()): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?php echo e($users->nextPageUrl()); ?>">
                                            <i class="fas fa-angle-double-right"></i>
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li class="page-item disabled">
                                        <span class="page-link"><i class="fas fa-angle-double-right"></i></span>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .pagination {
        list-style: none;
        padding: 0;
        display: flex;
        gap: 8px;
    }

    .pagination .page-item {
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.3s ease-in-out;
    }

    .pagination .page-item a, 
    .pagination .page-item span {
        display: block;
        padding: 10px 15px;
        text-decoration: none;
        font-weight: bold;
        border-radius: 5px;
        transition: 0.3s ease-in-out;
    }

    .pagination .page-item a {
        background: #f8f9fa;
        color: #007bff;
        border: 1px solid #007bff;
    }

    .pagination .page-item a:hover {
        background: #007bff;
        color: white;
    }

    .pagination .page-item.active a {
        background: #007bff;
        color: white;
        pointer-events: none;
    }

    .pagination .page-item.disabled span {
        background: #e9ecef;
        color: #6c757d;
        pointer-events: none;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\barrol\OneDrive - World Health Organization\Documents\TRAININGS\LARAVEL APPS\GestionAmes\resources\views/users/index.blade.php ENDPATH**/ ?>