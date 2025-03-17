<?php $__env->startSection('auth_header', 'Connexion à votre compte'); ?>

<?php $__env->startSection('auth_body'); ?>


    <form action="<?php echo e(route('login')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
            <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-envelope"></span></div>
            </div>
        </div>

        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
            <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-lock"></span></div>
            </div>
        </div>

        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember"> Se souvenir de moi </label>
                </div>
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('auth_footer'); ?>
    <p>
        <a href="<?php echo e(route('password.request')); ?>">Mot de passe oublié ?</a>
    </p>
    <p>
        <a href="<?php echo e(route('register')); ?>" class="text-center">Créer un compte</a>
    </p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::auth.auth-page', ['auth_type' => 'login'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\barrol\OneDrive - World Health Organization\Documents\TRAININGS\LARAVEL APPS\GestionAmes\resources\views/auth/login.blade.php ENDPATH**/ ?>