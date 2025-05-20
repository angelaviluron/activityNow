<?= $header; ?>

<div class="container mt-4 listadoTareas">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="tituloFormulario m-0">Tareas donde colaboro</h4>
  </div>

  <?php if (!empty($tareas)): ?>
    <?php foreach ($tareas as $tarea): ?>
      <?php
        $currentDate = new DateTime();
        $reminderDate = !empty($tarea['t_fechaRec']) ? new DateTime($tarea['t_fechaRec']) : null;
        $diff = $reminderDate ? $currentDate->diff($reminderDate) : null;

        
        $isNearReminder = ($diff && $diff->days <= 1 && $diff->invert == 0);
      ?>

      <div class="card mb-3 shadow-sm border-start <?= $isNearReminder ? 'border-warning' : 'border-primary' ?>" style="background-color: <?= esc($tarea['t_color']) ?>;">
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
                switch ($tarea['t_prioridad']) {
                  case '1': echo 'Baja'; break;
                  case '2': echo 'Normal'; break;
                  case '3': echo 'Alta'; break;
                  default: echo 'Desconocida'; 
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
    <div class="alert alert-info">No estás colaborando en ninguna tarea actualmente.</div>
  <?php endif; ?>
</div>

<?= $footer; ?>
