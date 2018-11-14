<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>"> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>SCB</title>

    <!-- Scripts -->
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="<?php echo e(elixir('css/app.css')); ?>" rel="stylesheet">
</head>
<body >
    <div id="app">
            <nav class="navbar" role="navigation" aria-label="main navigation">
                    <div class="navbar-brand">
                      <a class="navbar-item" href="/">
                        <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
                      </a>
                  
                      <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                        <span aria-hidden="true"></span>
                        <span aria-hidden="true"></span>
                        <span aria-hidden="true"></span>
                      </a>
                    </div>
                  
                    <div id="navbarBasicExample" class="navbar-menu">
                      <div class="navbar-start">

                      </div>
                  
                      <div class="navbar-end">
                        <div class="navbar-item">
                            <?php if(auth()->guard()->guest()): ?>
                                <div class="buttons">
                                    <a class="button is-light" href="<?php echo e(route('login')); ?>">
                                            <?php echo e(__('Iniciar sesion')); ?>

                                    </a>
                                </div>
                            <?php else: ?>
                                <div class="buttons">
                                    <?php if(Auth::user()->hasRole('admin')): ?>
                                        <?php if(Route::has('register')): ?>
                                            <a class="button is-primary" href="<?php echo e(route('register')); ?>">
                                                <?php echo e(__('Registrar usuario')); ?>

                                            </a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="navbar-item has-dropdown is-hoverable">
                                        <a class="navbar-link">
                                                <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                                        </a>
                                
                                        <div class="navbar-dropdown">
                                                <div>
                                                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                                            onclick="event.preventDefault();
                                                                            document.getElementById('logout-form').submit();">
                                                            <?php echo e(__('Logout')); ?>

                                                    </a>
                        
                                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                                        <?php echo csrf_field(); ?>
                                                    </form>
                                                </div>
                                        </div>
                                </div>
                            <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </nav>
       

        <main class="py-4">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
    <footer class="footer">
            <div class="container">
                <div class="content has-text-centered">
                    <p>
                        <a href="">
                            <i class="fab fa-facebook-square fa-2x">PROYECTO DE SISTEMAS GESTORES DE BASES DE DATOS</i>
                        </a>
                    </p>
                    <p>
                        <a href="">
                            <i class="fab fa-twitter-square fa-2x">RICARDO MANUEL PEREZ PLATA</i>
                        </a>
                    </p>

                    <p>
                        <a href="https://bulma.io">
                            <img src="<?php echo e(asset('img/myAvatar.png')); ?>" alt="Developer " width="128" height="24">
                        </a>
                    </p>
                </div>
            </div>
    </footer>
    <script src="<?php echo e(elixir('js/app.js')); ?>"></script> 
</body>
</html>
