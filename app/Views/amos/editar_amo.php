<?=$header?>

<div class="card formularioAmo shadow-lg">
  <div class="card-body">
    <h5 class="card-title mb-4 tituloFormulario">Editar Amo</h5>

    <?php 
    echo form_open_multipart(base_url('actualizar'));

    // ID oculto
    echo form_input([
      'name' => 'a_id',
      'id' => 'a_id',
      'type' => 'hidden',
      'value' => $amo['a_id']
    ]);

    // Nombre
    echo '<div class="mb-3">';
    echo form_label('Nombre', 'a_nombre', ['class' => 'form-label']);
    echo form_input([
      'name' => 'a_nombre',
      'id' => 'a_nombre',
      'class' => 'form-control inputFormulario',
      'value' => $amo['a_nombre']
    ]);
    echo '</div>';

    // Apellido
    echo '<div class="mb-3">';
    echo form_label('Apellido', 'a_apellido', ['class' => 'form-label']);
    echo form_input([
      'name' => 'a_apellido',
      'id' => 'a_apellido',
      'class' => 'form-control inputFormulario',
      'value' => $amo['a_apellido']
    ]);
    echo '</div>';

    // Dirección
    echo '<div class="mb-3">';
    echo form_label('Dirección', 'a_dir', ['class' => 'form-label']);
    echo form_input([
      'name' => 'a_dir',
      'id' => 'a_dir',
      'class' => 'form-control inputFormulario',
      'value' => $amo['a_dir']
    ]);
    echo '</div>';

    // Teléfono
    echo '<div class="mb-3">';
    echo form_label('Teléfono', 'a_tel', ['class' => 'form-label']);
    echo form_input([
      'name' => 'a_tel',
      'id' => 'a_tel',
      'type' => 'tel',
      'class' => 'form-control inputFormulario',
      'value' => $amo['a_tel']
    ]);
    echo '</div>';

    // Botón
    echo '<div class="mb-3">';
    echo form_submit('enviar', 'Actualizar', ['class' => 'btn botonFormulario w-100']);
    echo '</div>';

    echo form_close();
    ?>
  </div>
</div>

<?=$footer?>
