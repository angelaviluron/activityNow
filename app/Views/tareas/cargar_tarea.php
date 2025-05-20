<?= $header ?>

<div class="container mt-5 mb-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="formularioAmo shadow p-4">
        <h2 class="tituloFormulario mb-4">Crear Actividad</h2>

        <?= form_open_multipart(base_url('guardarTarea')) ?>

        <div class="mb-3">
          <?= form_label('Asunto o Tema', 'titulo', ['class' => 'form-label formCarga formCarga']) ?>
          <?= form_input([
            'name' => 'titulo',
            'id' => 'titulo',
            'class' => 'form-control inputFormulario',
            'placeholder' => 'Ej: Estudiar para el examen',
            'required' => true
          ]) ?>
        </div>

        <div class="mb-3">
          <?= form_label('Descripción', 'descripcion', ['class' => 'form-label formCarga formCarga']) ?>
          <?= form_textarea([
            'name' => 'descripcion',
            'id' => 'descripcion',
            'class' => 'form-control inputFormulario',
            'rows' => 4,
            'placeholder' => 'Detalles de la actividad',
            'required' => true
          ]) ?>
        </div>

        <div class="mb-3">
  <?= form_label('Prioridad', 'prioridad', ['class' => 'form-label formCarga formCarga']) ?>
  <?= form_dropdown('prioridad', [
    '1' => 'Baja',
    '2' => 'Normal',
    '3' => 'Alta'
  ], '2', ['class' => 'form-control inputFormulario', 'id' => 'prioridad']) ?>
</div>


        

        <div class="mb-3">
          <?= form_label('Fecha de Vencimiento', 'fecha_vencimiento', ['class' => 'form-label formCarga formCarga']) ?>
          <?= form_input([
            'type' => 'date',
            'name' => 'fecha_vencimiento',
            'id' => 'fecha_vencimiento',
            'class' => 'form-control inputFormulario',
            'required' => true
          ]) ?>
        </div>

        <div class="mb-3">
          <?= form_label('Fecha de Recordatorio (opcional)', 'fecha_recordatorio', ['class' => 'form-label formCarga formCarga']) ?>
          <?= form_input([
            'type' => 'date',
            'name' => 'fecha_recordatorio',
            'id' => 'fecha_recordatorio',
            'class' => 'form-control inputFormulario'
          ]) ?>
        </div>

        <div class="mb-3">
  <?= form_label('Color de la Actividad', 'color', ['class' => 'form-label formCarga d-block mb-2']) ?>
  <div class="d-flex gap-3 flex-wrap" id="colorSelector">
    <?php
      $colores = [
        '1' => '#E6F4EA', // Verde menta
        '2' => '#FFF3CD', // Amarillo crema
        '3' => '#E8EAF6', // Azul lavanda
        '4' => '#FDE2E2', // Rosa muy claro
      ];
      foreach ($colores as $value => $hex): ?>
        <label class="color-label" data-value="<?= $value ?>">
          <input type="radio" name="color" value="<?= $value ?>" class="d-none" <?= $value === '4' ? 'checked' : '' ?>>
          <span class="color-circle" style="background-color: <?= $hex ?>"></span>
        </label>
    <?php endforeach; ?>
  </div>
</div>



        <?= form_submit('submit', 'Guardar Actividad', ['class' => 'btn botonFormulario w-100']) ?>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>
<script>
  document.querySelectorAll('input[name="color"]').forEach(radio => {
    radio.addEventListener('change', () => {
      document.querySelectorAll('.color-option').forEach(el => el.classList.remove('selected'));
      radio.nextElementSibling.classList.add('selected');
    });

    // Marcar como seleccionada si está chequeada al cargar
    if (radio.checked) {
      radio.nextElementSibling.classList.add('selected');
    }
  });
</script>


<?= $footer ?>
