<?= $header; ?>

<div class="container mt-4">
  <h4 class="mb-3 tituloFormulario">Tareas Archivadas</h4>

  <?php if (!empty($tareas)): ?>
    <?php foreach ($tareas as $tarea): ?>
      <div class="card mb-3 shadow-sm border-start border-secondary" style="background-color: <?= esc($tarea['t_color']) ?>;">
        <div class="card-body">
          <h5 class="card-title"><?= esc($tarea['t_asunto']) ?></h5>
          <p><strong>Descripción:</strong> <?= esc($tarea['t_descripcion']) ?></p>
          <p><strong>Fecha de vencimiento:</strong> <?= esc($tarea['t_fechaVenc']) ?></p>
          <p><strong>Recordatorio:</strong> <?= esc($tarea['t_fechaRec']) ?: 'No asignado' ?></p>
          <p><strong>Prioridad:</strong> 
            <?php
              switch ($tarea['t_prioridad']) {
                case '1': echo 'Baja'; break;
                case '2': echo 'Normal'; break;
                case '3': echo 'Alta'; break;
                default: echo 'Desconocida';
              }
            ?>
          </p>
          <p><strong>Color:</strong> 
            <span style="display: inline-block; width: 30px; height: 20px; background-color: <?= esc($tarea['t_color']) ?>; border: 1px solid #ccc; border-radius: 5px;"></span>
          </p>

          <!-- Mostrar acciones solo si el usuario es el dueño -->
          <?php if ($usuarioId == $tarea['u_id']): ?>
            <div class="d-flex gap-2 mt-3">
              <a href="<?= base_url('editar_tarea/' . $tarea['t_id']) ?>" class="btn btn-sm btn-outline-warning">Editar</a>
              <a href="<?= base_url('borrar_tarea/' . $tarea['t_id']) ?>" class="btn btn-sm btn-outline-danger"
                 onclick="return confirm('¿Estás seguro que quieres eliminar esta tarea?')">
                Eliminar
              </a>
            </div>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <div class="alert alert-info">No hay tareas archivadas.</div>
  <?php endif; ?>
</div>

<?= $footer; ?>
