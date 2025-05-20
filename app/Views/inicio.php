<?= $header ?>
<section class="hero-section d-flex align-items-center justify-content-center text-center">
  <div class="hero-content">
    <h1 class="hero-title">Organizá tus tareas de forma clara y colaborativa</h1>
    <p class="hero-subtitle">Gestión de tareas eficiente, colaborativa y visualmente clara. ¡Todo desde un solo lugar!</p>
    <div class="hero-buttons mt-4 d-flex justify-content-center gap-3 flex-wrap">
      <?php if (session()->get('isLoggedIn')): ?>
        <a href="<?= base_url('formCrearTarea') ?>" class="btn btn-outline-light btn-lg">Nueva Actividad</a>
      <?php else: ?>
        <a href="<?= base_url('mostrarFormularioLogin') ?>" class="btn btn-light btn-lg">Iniciar Sesión</a>
        <a href="<?= base_url('formCrearTarea') ?>" class="btn btn-outline-light btn-lg">Nueva Actividad</a>
      <?php endif; ?>
    </div>
  </div> 
</section>
<?= $footer ?>
