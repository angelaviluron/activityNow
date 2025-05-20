<?= $header ?>

<div class="container mt-5 mb-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="formularioAmo shadow p-4">
        <h2 class="tituloFormulario mb-4">Editar Actividad</h2>

        <?= form_open_multipart(base_url('actualizar_tarea')) ?>

        <div class="mb-3">
          <?= form_label('Asunto o Tema', 'titulo', ['class' => 'form-label']) ?>
          <?= form_input([
            'name' => 'titulo',
            'id' => 'titulo',
            'class' => 'form-control inputFormulario',
            'placeholder' => 'Ej: Estudiar para el examen',
            'value' => esc($tarea['t_asunto']),
            'required' => true
          ]) ?>
        </div>

        <div class="mb-3">
          <?= form_label('Descripción', 'descripcion', ['class' => 'form-label']) ?>
          <?= form_textarea([
            'name' => 'descripcion',
            'id' => 'descripcion',
            'class' => 'form-control inputFormulario',
            'rows' => 4,
            'placeholder' => 'Detalles de la actividad',
            'value' => esc($tarea['t_descripcion']),
            'required' => true
          ]) ?>
        </div>

        <div class="mb-3">
          <?= form_label('Prioridad', 'prioridad', ['class' => 'form-label']) ?>
          <?= form_dropdown('prioridad', [
            '1' => 'Baja',
            '2' => 'Normal',
            '3' => 'Alta'
          ], $tarea['t_prioridad'], ['class' => 'form-control inputFormulario', 'id' => 'prioridad']) ?>
        </div>

        <div class="mb-3">
          <?= form_label('Fecha de Vencimiento', 'fecha_vencimiento', ['class' => 'form-label']) ?>
          <?= form_input([
            'type' => 'date',
            'name' => 'fecha_vencimiento',
            'id' => 'fecha_vencimiento',
            'class' => 'form-control inputFormulario',
            'value' => esc($tarea['t_fechaVenc']),
            'required' => true
          ]) ?>
        </div>

         <input type="hidden" name="t_id" value="<?= esc($tarea['t_id']) ?>">
        <div class="mb-3">
          <?= form_label('Fecha de Recordatorio (opcional)', 'fecha_recordatorio', ['class' => 'form-label']) ?>
          <?= form_input([
            'type' => 'date',
            'name' => 'fecha_recordatorio',
            'id' => 'fecha_recordatorio',
            'class' => 'form-control inputFormulario',
            'value' => esc($tarea['t_fechaRec']) // Si hay fecha de recordatorio, la muestra
          ]) ?>
        </div>

        

        <?= form_submit('submit', 'Actualizar Actividad', ['class' => 'btn botonFormulario w-100']) ?>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>

<?= $footer ?>
