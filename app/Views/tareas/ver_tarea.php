<?= $header; ?>

<div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">Detalles de la Tarea</h3>
    <a href="<?= base_url('mostrar_tareas') ?>" class="btn btn-outline-secondary">Volver al listado</a>
  </div>

  <?php
  $prioridadClase = '';
  switch ($tarea['t_prioridad']) {
    case '1': $prioridadClase = 'borde-verde'; break;    // Baja
    case '2': $prioridadClase = 'borde-amarillo'; break; // Normal
    case '3': $prioridadClase = 'borde-rojo'; break;     // Alta
  }
?>
<div class="card shadow border-start border-4 <?= $prioridadClase ?> border-0">

     <div class="card-header d-flex justify-content-between align-items-center bg-light border-bottom">
  <h5 class="mb-0 text-dark fw-semibold"><?= esc($tarea['t_asunto']) ?></h5>

  <?php if ($es_dueno): ?>
    <a href="<?= base_url('archivar_tarea/' . $tarea['t_id']) ?>"
       class="btn btn-sm btn-outline-secondary"
       onclick="return confirm('¿Archivar esta tarea?')">
      <i class="bi bi-archive me-1"></i> Archivar
    </a>
  <?php endif; ?>
</div>

    <div class="card-body">
      <div class="row">
        <!-- Primera columna -->
        <div class="col-md-6 mb-4">
          
          <p><strong>Descripción:</strong> <?= esc($tarea['t_descripcion']) ?></p>
          
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
        </div>

        <!-- Segunda columna -->
        <div class="col-md-6 mb-4">
          <p><strong>Vence en:</strong> <?= esc($tarea['t_fechaVenc']) ?></p>
          
          <p><strong>Color:</strong> 
            <span style="display: inline-block; width: 30px; height: 20px; background-color: <?= esc($tarea['t_color']) ?>; border: 1px solid #ccc; border-radius: 5px;"></span>
          </p>
        </div>
      </div>
<?php if (session()->getFlashdata('mensaje')): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?= session()->getFlashdata('mensaje') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
  </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?= session()->getFlashdata('error') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
  </div>
<?php endif; ?>


      <hr>


      <!-- Mostar subtarea -->
<?php if (!empty($subtareas)): ?>
  <div class="mt-5">
    <h4>Subtareas</h4>
    <ul class="list-group">
      <?php foreach ($subtareas as $sub): ?>
        <li class="list-group-item p-3 mb-3 rounded shadow-sm border-start border-3 <?= ($sub['st_prioridad'] == 'Alta') ? 'border-danger' : (($sub['st_prioridad'] == 'Normal') ? 'border-warning' : 'border-success') ?>">
  <div class="d-flex justify-content-between align-items-start">
    <div class="me-auto">
      <h6 class="fw-bold text-primary mb-1"><?= esc($sub['st_asunto']) ?></h6>
      <p class="mb-1"><?= esc($sub['st_descripcion']) ?></p>
      <small class="text-muted">
        <strong>Estado:</strong> <?= esc($sub['st_estado']) ?> |
        <strong>Prioridad:</strong> <?= esc($sub['st_prioridad']) ?> |
        <strong>Responsable:</strong> <?= isset($sub['responsable']) ? esc($sub['responsable']) : 'Sin asignar' ?> |
        <strong>Vence:</strong> <?= esc($sub['st_fechaVenc']) ?: 'No asignada' ?>
      </small>
      <?php if (!empty($sub['st_comentario'])): ?>
        <br><small class="text-info fst-italic">Comentario: <?= esc($sub['st_comentario']) ?></small>
      <?php endif; ?>
    </div>


          <!-- Dropdown de acciones -->
          <div class="dropdown ms-3">
  <button class="btn btn-sm btn-acciones dropdown-toggle" type="button" id="accionesDropdown<?= $sub['st_id'] ?>" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="bi bi-three-dots"></i> Acciones
  </button>
  <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="accionesDropdown<?= $sub['st_id'] ?>">

    <?php if ($sub['puede_completar']): ?>
      <li>
        <a class="dropdown-item completar-subtarea" href="<?= base_url('completar_subtarea/' . $sub['st_id'] . '/' . $tarea['t_id']) ?>">
          <i class="bi bi-check2-circle me-1"></i>Completar
        </a>
      </li>
    <?php endif; ?>

    <?php if ($sub['es_dueno'] || $sub['permiso_edicion']): ?>
      <li>
        <button class="dropdown-item editar-subtarea" data-bs-toggle="modal" data-bs-target="#editarSubtareaModal<?= $sub['st_id'] ?>">
          <i class="bi bi-pencil-square me-1"></i>Editar
        </button>
      </li>
    <?php endif; ?>

    <?php if ($sub['es_dueno']): ?>
      <li>
        <button class="dropdown-item asignar-responsable" data-bs-toggle="modal" data-bs-target="#asignarResponsableModal<?= $sub['st_id'] ?>">
          <i class="bi bi-person-circle me-1"></i>Asignar Responsable
        </button>
      </li>
      <li>
        <a class="dropdown-item eliminar-subtarea" href="<?= base_url('borrar_subtarea/' . $sub['st_id'] . '/' . $tarea['t_id']) ?>" onclick="return confirm('¿Eliminar esta subtarea?')">
          <i class="bi bi-trash3 me-1"></i>Eliminar
        </a>
      </li>
    <?php endif; ?>

  </ul>
</div>




        </li>



        <!-- Modal para asignar responsable -->
        <div class="modal fade" id="asignarResponsableModal<?= $sub['st_id'] ?>" tabindex="-1" aria-labelledby="asignarResponsableModalLabel<?= $sub['st_id'] ?>" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <?= form_open(base_url('asignar_responsable')) ?>
              <div class="modal-header">
                <h5 class="modal-title" id="asignarResponsableModalLabel<?= $sub['st_id'] ?>">Asignar Responsable</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
              </div>
              <div class="modal-body">
                <?= form_hidden('subtarea_id', $sub['st_id']) ?>
                <?= form_hidden('tarea_id', $tarea['t_id']) ?>

                <div class="mb-3">
                  <?= form_label('Selecciona un colaborador', 'responsable_id', ['class' => 'form-label']) ?>
                  <select name="responsable_id" class="form-select" required>
                    <option value="">-- Elegir --</option>
                    <?php foreach ($colaboradores as $col): ?>
                      <option value="<?= $col['u_id'] ?>"><?= esc($col['u_user']) ?> (<?= esc($col['u_email']) ?>)</option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Asignar</button>
              </div>
              <?= form_close() ?>
            </div>
          </div>
        </div>

        <!-- Modal Editar Subtarea -->
        <div class="modal fade" id="editarSubtareaModal<?= $sub['st_id'] ?>" tabindex="-1" aria-labelledby="editarSubtareaModalLabel<?= $sub['st_id'] ?>" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <?= form_open(base_url('actualizar_subtarea')) ?>
              <div class="modal-header">
                <h5 class="modal-title" id="editarSubtareaModalLabel<?= $sub['st_id'] ?>">Editar Subtarea</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
              </div>
              <div class="modal-body">
                <?= form_hidden('st_id', $sub['st_id']) ?>
                <?= form_hidden('st_tarea_id', $tarea['t_id']) ?>

                <div class="mb-3">
                  <?= form_label('Asunto', 'st_asunto', ['class' => 'form-label']) ?>
                  <?= form_input([
                    'name' => 'st_asunto',
                    'class' => 'form-control',
                    'value' => esc($sub['st_asunto']),
                    'required' => true
                  ]) ?>
                </div>

                <div class="mb-3">
                  <?= form_label('Descripción', 'st_descripcion', ['class' => 'form-label']) ?>
                  <?= form_textarea([
                    'name' => 'st_descripcion',
                    'class' => 'form-control',
                    'rows' => 3,
                    'required' => true,
                    'value' => esc($sub['st_descripcion'])
                  ]) ?>
                </div>

                <div class="mb-3">
                  <?= form_label('Prioridad', 'st_prioridad', ['class' => 'form-label']) ?>
                  <?= form_dropdown('st_prioridad', [
                    'Baja' => 'Baja',
                    'Normal' => 'Normal',
                    'Alta' => 'Alta'
                  ], esc($sub['st_prioridad']), ['class' => 'form-select']) ?>
                </div>

                <div class="mb-3">
                  <?= form_label('Fecha de Vencimiento', 'st_fechaVenc', ['class' => 'form-label']) ?>
                  <?= form_input([
                    'type' => 'date',
                    'name' => 'st_fechaVenc',
                    'class' => 'form-control',
                    'value' => esc($sub['st_fechaVenc'])
                  ]) ?>
                </div>

                <div class="mb-3">
                  <?= form_label('Comentario', 'st_comentario', ['class' => 'form-label']) ?>
                  <?= form_textarea([
                    'name' => 'st_comentario',
                    'class' => 'form-control',
                    'rows' => 3,
                    'value' => esc($sub['st_comentario'])
                  ]) ?>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Guardar Cambios</button>
              </div>
              <?= form_close() ?>
            </div>
          </div>
        </div>

      <?php endforeach; ?>
    </ul>
  </div>
<?php else: ?>
  <div class="mt-5">
    <h4>Subtareas</h4>
    <p class="text-muted">No hay subtareas asociadas a esta tarea.</p>
  </div>
<?php endif; ?>

<!-- fin Mostar subtarea -->



<hr>


  
<!-- footer de la tarea con opciones -->
   <!-- Bloque de acciones estilizado con paleta armoniosa -->
<div class="d-flex flex-wrap gap-2 mt-4">

  <?php if ($es_dueno || $permiso_edicion): ?>
    <button class="btn btn-subtarea" data-bs-toggle="modal" data-bs-target="#modalAgregarSubtarea">
      <i class="bi bi-plus-circle me-1"></i>Subtarea
    </button>
  <?php endif; ?>

  <?php if ($es_dueno): ?>
    <button class="btn btn-colaborador" data-bs-toggle="modal" data-bs-target="#modalAgregarColaborador">
      <i class="bi bi-people me-1"></i>Colaborador
    </button>
  <?php endif; ?>

  <?php if ($es_dueno || $permiso_edicion): ?>
    <a href="<?= base_url('editar_tarea/'.$tarea['t_id']) ?>" class="btn btn-editar">
      <i class="bi bi-pencil me-1"></i>Editar
    </a>
    <a href="<?= base_url('completar_tarea/'.$tarea['t_id']) ?>" class="btn btn-completar" onclick="return confirm('¿Marcar como completada?')">
      <i class="bi bi-check2-circle me-1"></i>Completar
    </a>
  <?php endif; ?>

  <?php if ($es_dueno): ?>
    <a href="<?= base_url('borrar_tarea/'.$tarea['t_id']) ?>" class="btn btn-eliminar" onclick="return confirm('¿Eliminar esta tarea?')">
      <i class="bi bi-trash me-1"></i>Eliminar
    </a>
  <?php endif; ?>

</div>




<!-- fin footer de la tarea con opciones -->


    </div>
  </div>
  






  <!-- Modal Agregar Subtarea -->
  <div class="modal fade" id="modalAgregarSubtarea" tabindex="-1" aria-labelledby="modalAgregarSubtareaLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalAgregarSubtareaLabel">Agregar Subtarea</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <?= form_open(base_url('guardar_subtarea')) ?>
          <div class="modal-body">

            <?php if (session()->get('errors')): ?>
              <div class="alert alert-danger">
                <ul class="mb-0">
                  <?php foreach (session()->get('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php endif; ?>

            <!-- ID tarea oculto -->
            <?= form_hidden('st_tarea_id', esc($tarea['t_id'])) ?>

            <!-- Asunto -->
            <div class="mb-3">
              <?= form_label('Asunto de la Subtarea', 'st_asunto', ['class' => 'form-label']) ?>
              <?= form_input([
                'type' => 'text',
                'name' => 'st_asunto',
                'id' => 'st_asunto',
                'class' => 'form-control',
                'required' => true,
                'value' => old('st_asunto')
              ]) ?>
            </div>

            <!-- Descripción -->
            <div class="mb-3">
              <?= form_label('Descripción de la Subtarea', 'st_descripcion', ['class' => 'form-label']) ?>
              <?= form_textarea([
                'name' => 'st_descripcion',
                'id' => 'st_descripcion',
                'class' => 'form-control',
                'rows' => 3,
                'required' => true,
                'value' => old('st_descripcion')
              ]) ?>
            </div>

            <!-- Prioridad -->
            <div class="mb-3">
              <?= form_label('Prioridad', 'st_prioridad', ['class' => 'form-label']) ?>
              <?= form_dropdown('st_prioridad', [
                'Baja' => 'Baja',
                'Normal' => 'Normal',
                'Alta' => 'Alta'
              ], old('st_prioridad', '2'), ['class' => 'form-select', 'id' => 'st_prioridad']) ?>
            </div>

            <!-- Fecha de Vencimiento -->
            <div class="mb-3">
              <?= form_label('Fecha de Vencimiento', 'st_fechaVenc', ['class' => 'form-label']) ?>
              <?= form_input([
                'type' => 'date',
                'name' => 'st_fechaVenc',
                'id' => 'st_fechaVenc',
                'class' => 'form-control',
                'value' => old('st_fechaVenc')
              ]) ?>
            </div>

            <!-- Comentario -->
            <div class="mb-3">
              <?= form_label('Comentario', 'st_comentario', ['class' => 'form-label']) ?>
              <?= form_textarea([
                'name' => 'st_comentario',
                'id' => 'st_comentario',
                'class' => 'form-control',
                'rows' => 3,
                'value' => old('st_comentario')
              ]) ?>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success">Guardar Subtarea</button>
          </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
  <!-- Fin modal agregar subtarea -->



<!-- Modal Agregar Colaborador -->
<div class="modal fade" id="modalAgregarColaborador" tabindex="-1" aria-labelledby="modalAgregarColaboradorLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Encabezado del modal -->
      <div class="modal-header">
        <h5 class="modal-title" id="modalAgregarColaboradorLabel">Agregar Colaborador</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <!-- Cuerpo del modal -->
      <div class="modal-body">

<?php if (session()->getFlashdata('mensaje')): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?= session()->getFlashdata('mensaje') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
  </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?= session()->getFlashdata('error') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
  </div>
<?php endif; ?>

<?php if (session()->getFlashdata('errors')): ?>
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <ul class="mb-0">
      <?php foreach (session()->getFlashdata('errors') as $error): ?>
        <li><?= esc($error) ?></li>
      <?php endforeach; ?>
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
  </div>
<?php endif; ?>

        <?= form_open(base_url('agregar_colaborador')) ?>
       
 <?= form_hidden('t_id', esc($tarea['t_id'])) ?>
          <div class="mb-3">
            <?= form_label('Correo Electrónico', 'correo', ['class' => 'form-label']) ?>
            <?= form_input([
              'type' => 'email',
              'name' => 'correo',
              'id' => 'correo',
              'class' => 'form-control',
              'required' => true,
              'placeholder' => 'ejemplo@correo.com'
            ]) ?>
          </div>

          <div class="mb-3">
            <?= form_label('Tipo de Colaboración', 'tipo_colaboracion', ['class' => 'form-label']) ?>
            <?= form_dropdown('tipo_colaboracion', [
              'lectura' => 'Lectura',
              'edicion' => 'Edición'
            ], 'lectura', [
              'class' => 'form-select',
              'id' => 'tipo_colaboracion',
              'required' => true
            ]) ?>
          </div>

          <div class="d-flex justify-content-end">
            <?= form_submit('submit', 'Agregar', ['class' => 'btn btn-primary']) ?>
          </div>

        <?= form_close() ?>
      </div>

    </div>
  </div>
</div>

<!-- fin Modal Agregar Colaborador -->





  <?php if (session()->get('abrirModal')): ?>
    <script>
      window.addEventListener('DOMContentLoaded', () => {
        const modal = new bootstrap.Modal(document.getElementById('modalAgregarSubtarea'));
        modal.show();
      });
    </script>
  <?php endif; ?>

</div>


<?= $footer; ?>
