<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Activity Now</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">


  <link rel="stylesheet" href="/activity_now/estilo.css">
</head>
<body>
<br>
<br>
<br>
<br>
<!-- Navbar para móvil -->
<nav class="navbar navbar-dark fondo px-3 d-md-none">
  <div class="container-fluid">
    <button class="btn btn-outline-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas">
      ☰ Menú
    </button>
    <span class="navbar-brand ms-auto">Activity Now</span>
  </div>
</nav>
<?php if (isset($tieneNotificaciones) && $tieneNotificaciones): ?>
  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055">
    <div id="notificacionToast" class="toast align-items-center text-bg-warning border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">
          🔔 ¡Tenés tareas próximas a vencer! Revisalas en la sección "Tareas Próximas".
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
      </div>
    </div>
  </div>
<?php endif; ?>


<!-- Sidebar como offcanvas para móviles -->
<div class="offcanvas-md offcanvas-start sidebar p-3" tabindex="-1" id="sidebarOffcanvas">
  <div class="offcanvas-header d-md-none">
    <h5 class="offcanvas-title">Menú</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <a class="nav-link d-flex align-items-center gap-2" href="<?= base_url('/') ?>">
       <h4 class="d-none d-md-block text-white ">Activity Now</h4>
    </a>
   


    <ul class="nav flex-column mt-4">
  <?php if (session()->get('isLoggedIn')): ?>
    <li class="nav-item">
      <a class="nav-link d-flex align-items-center gap-2" href="<?= base_url('formCrearTarea') ?>">
        <i class="bi bi-plus-circle"></i> Nueva Actividad
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link d-flex align-items-center gap-2" href="<?= base_url('tareas_colaborando') ?>">
        <i class="bi bi-handshake"></i> Mis Colaboraciones
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link d-flex align-items-center gap-2" href="<?= base_url('mostrar_tareas') ?>">
        <i class="bi bi-card-list"></i> Ver Actividades
      </a>
    </li>
    <li class="nav-item position-relative">
      <a class="nav-link d-flex align-items-center gap-2" href="<?= base_url('tareas_proximas') ?>">
        <i class="bi bi-clock"></i> Tareas Próximas
        <?php if (!empty($tieneNotificaciones)): ?>
        <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
          <span class="visually-hidden">Tienes tareas próximas</span>
        </span>
        <?php endif; ?>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link d-flex align-items-center gap-2" href="<?= base_url('perfil') ?>">
        <i class="bi bi-person"></i> Mi Perfil
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link d-flex align-items-center gap-2" href="<?= base_url('logout') ?>">
        <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
      </a>
    </li>
  <?php else: ?>
    <li class="nav-item">
      <a class="nav-link d-flex align-items-center gap-2" href="<?= base_url('mostrarFormularioLogin') ?>">
        <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link d-flex align-items-center gap-2" href="<?= base_url('mostrarFormularioLogin') ?>">
        <i class="bi bi-person-plus"></i> Registrarse
      </a>
    </li>
  <?php endif; ?>
</ul>


  </div>
</div>


<!-- Contenido principal -->
<div class="main-content p-3">
