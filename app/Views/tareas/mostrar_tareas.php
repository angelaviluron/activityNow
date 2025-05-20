<?= $header; ?>

<div class="container mt-4 listadoTareas">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="tituloFormulario m-0">Listado de Tareas</h4>

    <div class="d-flex gap-2">
      <a class="btn btn-outline-secondary" href="<?= base_url('mostrar_archivadas') ?>">Tareas archivadas</a>
      <!-- Botón agregar tarea -->
      <a class="btn botonFormulario" href="<?= base_url('cargar_tarea') ?>">+ Nueva tarea</a>

      <!-- Dropdown de orden -->
      <div class="dropdown">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          Ordenar por
        </button>
        <ul class="dropdown-menu">
  <li><a class="dropdown-item" href="<?= base_url('tareas?orden=vencimiento_asc') ?>">Fecha de Vencimiento (Ascendente)</a></li>
  <li><a class="dropdown-item" href="<?= base_url('tareas?orden=vencimiento_desc') ?>">Fecha de Vencimiento (Descendente)</a></li>
  <li><a class="dropdown-item" href="<?= base_url('tareas?orden=asunto_asc') ?>">Asunto (A-Z)</a></li>
  <li><a class="dropdown-item" href="<?= base_url('tareas?orden=asunto_desc') ?>">Asunto (Z-A)</a></li>
  <li><a class="dropdown-item" href="<?= base_url('tareas?orden=prioridad') ?>">Prioridad</a></li>
</ul>


      </div>
    </div>
  </div>

  <?php if (!empty($tareas)): ?>
    <?php foreach ($tareas as $tarea): ?>
  <?php
    $currentDate = new DateTime();
    $reminderDate = new DateTime($tarea['t_fechaRec']);
    $diff = $currentDate->diff($reminderDate);

    // Si el recordatorio es en 1 día o menos
    $isNearReminder = ($diff->days <= 1 && $diff->invert == 0);
  ?>

<?php
  $prioridadClase = '';
  switch ($tarea['t_prioridad']) {
    case '1': $prioridadClase = 'borde-verde'; break;
    case '2': $prioridadClase = 'borde-amarillo'; break;
    case '3': $prioridadClase = 'borde-rojo'; break;
  }

  $recordatorioClase = $isNearReminder ? 'borde-alerta' : '';
?>
<div class="card mb-3 shadow-sm  border-4 <?= $prioridadClase ?> <?= $recordatorioClase ?> " style="background-color: <?= esc($tarea['t_color']) ?>;">

    <div class="card-body">
      <h5 class="card-title mb-3"><?= esc($tarea['t_asunto']) ?></h5>
      <div class="row">
        <div class="col-md-12 mb-2">
          <strong>Descripción:</strong> <?= esc($tarea['t_descripcion']) ?>
        </div>
        <div class="col-md-6 mb-2">
          <strong>Fecha de Vencimiento:</strong> <?= esc($tarea['t_fechaVenc']) ?>
        </div>
        <?php if (!empty($tarea['t_fechaRec'])): ?>
          <div class="col-md-6 mb-2">
            <strong>Fecha de Recordatorio:</strong> <?= esc($tarea['t_fechaRec']) ?>
          </div>
        <?php endif; ?>
        <div class="col-md-6 mb-2">
  <strong>Prioridad:</strong> 
  <?php 
    // Mapeo directo de los valores numéricos a las palabras
    switch ($tarea['t_prioridad']) {
      case '1':
        echo 'Baja';
        break;
      case '2':
        echo 'Normal';
        break;
      case '3':
        echo 'Alta';
        break;
      default:
        echo 'Desconocida';
    }
  ?>
</div>
      </div>

      <div class="d-flex justify-content-between mt-3">
        <a class="btn btn-outline-primary btn-sm me-2" href="<?= base_url('ver_tarea/'.$tarea['t_id']) ?>">Ver más</a>

      </div>
    </div>
  </div>
<?php endforeach; ?>

  <?php else: ?>
    <div class="alert alert-info">No hay tareas registradas actualmente.</div>
  <?php endif; ?>
</div>

<?= $footer; ?>
