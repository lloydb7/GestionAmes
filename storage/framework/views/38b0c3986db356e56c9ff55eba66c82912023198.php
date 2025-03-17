

<?php $__env->startSection('title', 'Ajouter une Âme'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0"><i class="fas fa-user-plus"></i> Nouvelle Âme</h3>

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
        </div>

        <div class="card-body">
            <form action="<?php echo e(route('ames.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                
                <div class="row">
                    <!-- Nom -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-user"></i> Nom</label>
                        <input type="text" name="nom" class="form-control <?php $__errorArgs = ['nom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('nom')); ?>" placeholder="Entrez le nom" required>
                        <?php $__errorArgs = ['nom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Prénom -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-user"></i> Prénom</label>
                        <input type="text" name="prenom" class="form-control <?php $__errorArgs = ['prenom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('prenom')); ?>" placeholder="Entrez le prénom" required>
                        <?php $__errorArgs = ['prenom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="row">
                    <!-- Sexe -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-venus-mars"></i> Sexe</label>
                        <select name="sexe" class="form-select <?php $__errorArgs = ['sexe'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <option value="Masculin" <?php echo e(old('sexe') == 'Masculin' ? 'selected' : ''); ?>>Masculin</option>
                            <option value="Féminin" <?php echo e(old('sexe') == 'Féminin' ? 'selected' : ''); ?>>Féminin</option>
                        </select>
                        <?php $__errorArgs = ['sexe'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Âge -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-calendar"></i> Âge</label>
                        <input type="number" name="age" class="form-control <?php $__errorArgs = ['age'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('age')); ?>" placeholder="Entrez l'âge" required>
                        <?php $__errorArgs = ['age'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="row">
                    <!-- Adresse -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-map-marker-alt"></i> Adresse</label>
                        <input type="text" name="adresse" class="form-control <?php $__errorArgs = ['adresse'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('adresse')); ?>" placeholder="Entrez l'adresse">
                        <?php $__errorArgs = ['adresse'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Téléphone -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-phone"></i> Téléphone</label>
                        <input type="text" name="telephone" class="form-control <?php $__errorArgs = ['telephone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('telephone')); ?>" placeholder="Entrez le téléphone">
                        <?php $__errorArgs = ['telephone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="row">
                    <!-- Date de Premier Contact -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-calendar-alt"></i> Date de Premier Contact</label>
                        <input type="date" name="date_premier_contact" class="form-control <?php $__errorArgs = ['date_premier_contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('date_premier_contact')); ?>" required>
                        <?php $__errorArgs = ['date_premier_contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Utilisateur Connecté -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-star"></i> Star</label>
                        <input type="text" class="form-control input-solid" value="<?php echo e(Auth::user()->name); ?>" disabled>
                        <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
                    </div>
                </div>

                <div class="row">
                    <!-- Famille Impact -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-users"></i> Famille Impact</label>
                        <select name="famille_impact_id" class="form-select <?php $__errorArgs = ['famille_impact_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <option value="">Non affecté</option>
                            <?php $__currentLoopData = $familles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $famille): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($famille->id); ?>" <?php echo e(old('famille_impact_id') == $famille->id ? 'selected' : ''); ?>>
                                    <?php echo e($famille->nom); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['famille_impact_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Prière du Salut -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-praying-hands"></i> Prière du Salut</label>
                        <select name="priere_du_salut" class="form-select">
                            <option value="0">Non</option>
                            <option value="1">Oui</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <!-- Invitation au Temple -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-church"></i> Invitation au Temple</label>
                        <select name="invitation_temple" class="form-select">
                            <option value="0">Non</option>
                            <option value="1">Oui</option>  
                        </select>
                    </div>

                    <!-- Invitation à la FI -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-book"></i> Invitation à la FI</label>
                        <select name="invitation_fi" class="form-select">
                            <option value="0">Non</option>
                            <option value="1">Oui</option> 
                        </select>
                    </div>
                </div>
                
                <!-- Boutons -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                    <a href="<?php echo e(route('ames.index')); ?>" class="btn btn-secondary btn-lg">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\barrol\OneDrive - World Health Organization\Documents\TRAININGS\LARAVEL APPS\GestionAmes\resources\views/ames/create.blade.php ENDPATH**/ ?>