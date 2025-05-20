<?= $header; ?>

<div class="container mt-4 listadoTareas">
    <?php if (session()->getFlashdata('notificacion')): ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-circle-fill me-2"></i>
    <?= session()->getFlashdata('notificacion') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
  </div>
<?php endif; ?>

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="tituloFormulario m-0">Tareas con recordatorio pendiente</h4>
    <a class="btn btn-outline-secondary" href="<?= base_url('mostrar_tareas') ?>">← Volver al listado</a>
  </div>

  <?php if (!empty($tareas)): ?>
    <?php foreach ($tareas as $tarea): ?>
      <div class="card mb-3 shadow-sm border-start border-warning" style="background-color: <?= esc($tarea['t_color']) ?>;">
        <div class="card-body">
          <h5 class="card-title mb-3"><?= esc($tarea['t_asunto']) ?></h5>
          <div class="row">
            <div class="col-md-12 mb-2">
              <strong>Descripción:</strong> <?= esc($tarea['t_descripcion']) ?>
            </div>
            <div class="col-md-6 mb-2">
              <strong>Fecha de Vencimiento:</strong> <?= esc($tarea['t_fechaVenc']) ?>
            </div>
            <div class="col-md-6 mb-2">
              <strong>Fecha de Recordatorio:</strong> <?= esc($tarea['t_fechaRec']) ?>
            </div>
          </div>
          <div class="mt-3 d-flex justify-content-end">
            <a href="<?= base_url('ver_tarea/'.$tarea['t_id']) ?>" class="btn btn-outline-primary btn-sm">Ver más</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <div class="alert alert-info">No hay tareas próximas a vencer.</div>
  <?php endif; ?>
</div>

<?= $footer; ?>
