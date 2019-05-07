<?php $__env->startSection('content'); ?>
<section class="hero">
        <figure class="image">
            <img src="<?php echo e(asset('img/font.jpg')); ?>">
        </figure>
</section>
</section class="section">
    <div class="container has-text-centered">
            <h2 class="title">Sistema de Banca en linea</h2>
            <p>Sistema bancario en linea, la manera mas sencilla para la gestion bancaria de toda una organización.</p>
    </div>
    <?php if(auth()->guard()->guest()): ?>
    <div class="hero-body">
        <div class="container has-text-centered">
            <div class="column is-6 is-offset-3">
                <h1 class="title">
                    SCB
                </h1>
                <h2 class="subtitle">
                   La mejor plataforma de banca en line
                </h2>
                <div class="box">
                    <div class="field is-grouped">
                        <p class="control">
                            
                            <div class="buttons">
                                <a class="button is-light is-large is-fullwidth" href="<?php echo e(route('login')); ?>">
                                        <?php echo e(__('Iniciar sesion')); ?>

                                </a>
                            </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php else: ?>
        <div id="app">
            <?php if(Auth::user()->hasRole('cliente')): ?>
                <div><clientes user="<?php echo e(Auth::user()->id); ?>"></clientes></div>
            <?php elseif(Auth::user()->hasRole('atm')): ?>
                <div><atms user="<?php echo e(Auth::user()->id); ?>"></atms></div>
            <?php elseif(Auth::user()->hasRole('cajero')): ?>
                <div><cajeros user="<?php echo e(Auth::user()->id); ?>"></cajeros></div>
            <?php elseif(Auth::user()->hasRole('admin')): ?>
                <div>
                    <nav-adm></nav-adm>
                    <admins></admins>
                    <workers></workers>
                    <clients></clients>
                    <cuentas></cuentas>
                    <reportes-view></reportes-view>
                </div>
            <?php elseif(Auth::user()->hasRole('auditor')): ?>
                <div><auditores user="<?php echo e(Auth::user()->id); ?>"></auditores></div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>