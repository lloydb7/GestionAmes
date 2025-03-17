

<?php $__env->startSection('title', 'Liste des Familles Impact'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title"><i class="fas fa-users"></i> Liste des Familles Impact</h3>
                    <a href="<?php echo e(route('familles.create')); ?>" class="btn btn-dark text-white">
                        <i class="fas fa-plus-circle"></i> Ajouter une Famille
                    </a>
                </div>

                <div class="card-body">
                    <!-- Champ de recherche swag -->
                    <div class="mb-4">
                        <form method="GET" action="<?php echo e(route('familles.index')); ?>" class="d-flex align-items-center justify-content-center">
                            <div class="input-group shadow-sm" style="max-width: 400px;">
                                <span class="input-group-text bg-primary text-white"><i class="fas fa-search"></i></span>
                                <input type="text" id="searchInput" name="search" class="form-control border-primary" 
                                       placeholder="Rechercher une famille..." value="<?php echo e(request('search')); ?>">
                            </div>

                            <button class="btn btn-primary ms-3 shadow" type="submit">
                                <i class="fas fa-search"></i> Rechercher
                            </button>

                            <?php if(request('search')): ?>
                                <a href="<?php echo e(route('familles.index')); ?>" class="btn btn-danger ms-3 shadow">
                                    <i class="fas fa-times-circle"></i> Réinitialiser
                                </a>
                            <?php endif; ?>
                        </form>
                    </div>

                    <!-- Tableau responsive -->
                    <div class="table-responsive">
                        <table class="table table-hover table-striped text-center" id="familleTable">
                            <thead class="bg-light">
                                <tr>
                                    <th>Nom</th>
                                    <th>Pilote 1</th>
                                    <th>Pilote 2</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $familles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $famille): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><strong><?php echo e($famille->nom); ?></strong></td>
                                    <td><?php echo e($famille->pilote1_nom); ?></td>
                                    <td><?php echo e($famille->pilote2_nom ?? 'N/A'); ?></td>
                                    <td class="d-flex justify-content-center">
                                        <a href="<?php echo e(route('familles.show', $famille->id)); ?>" class="btn btn-info btn-sm mx-1 shadow">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?php echo e(route('familles.edit', $famille->id)); ?>" class="btn btn-warning btn-sm mx-1 shadow">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="<?php echo e(route('familles.destroy', $famille->id)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger btn-sm mx-1 shadow"
                                                    onclick="return confirm('Voulez-vous vraiment supprimer cette Famille Impact ?');">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Message si aucune famille trouvée -->
                    <?php if($familles->isEmpty()): ?>
                        <p class="text-center text-muted mt-3">Aucune Famille Impact enregistrée.</p>
                    <?php endif; ?>

                    <!-- Pagination stylisée -->
                    <div class="pagination-container mt-4">
                        <?php echo e($familles->links('pagination::bootstrap-4')); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script de recherche dynamique -->
<script>
    function filterTable() {
        let input = document.getElementById("searchInput").value.toLowerCase();
        let rows = document.querySelectorAll("#familleTable tbody tr");

        rows.forEach(row => {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(input) ? "" : "none";
        });
    }
</script>

<!-- CSS pour styliser la pagination et la recherche -->
<style>
    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff;
        color: white;
        border-radius: 8px;
        font-weight: bold;
    }

    .pagination .page-link {
        background-color: #f8f9fa;
        color: #007bff;
        border: 1px solid #007bff;
        border-radius: 8px;
        padding: 10px 15px;
        transition: all 0.3s;
    }

    .pagination .page-link:hover {
        background-color: #007bff;
        color: white;
        transform: scale(1.1);
    }

    .input-group-text {
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
    }

    .btn-primary, .btn-danger {
        border-radius: 8px;
        padding: 10px 15px;
        font-weight: bold;
        transition: all 0.3s ease-in-out;
    }

    .btn-primary:hover, .btn-danger:hover {
        transform: scale(1.1);
    }
</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\barrol\OneDrive - World Health Organization\Documents\TRAININGS\LARAVEL APPS\GestionAmes\resources\views/familles/index.blade.php ENDPATH**/ ?>