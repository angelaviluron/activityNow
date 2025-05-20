<?=$header?>

<div class="container mt-5">
  <div class="formularioAmo">
    <h2 class="tituloFormulario">Crear Cuenta</h2>

    <?php echo form_open(base_url('guardarRegistro')); ?>

    <div class="form-group mb-3">
      <label class="formCarga" for="u_nombre">Nombre</label>
      <?php echo form_input([
        'name' => 'u_nombre',
        'id' => 'u_nombre',
        'class' => 'form-control inputFormulario',
        'required' => 'required',
        'value' => set_value('u_nombre'),
        'minlength' => '2',
        'pattern' => '[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+',
        'title' => 'Debe tener al menos 2 letras y solo usar letras y espacios'
      ]); ?>
    </div>

    <div class="form-group mb-3">
      <label class="formCarga" for="u_apellido">Apellido</label>
      <?php echo form_input([
        'name' => 'u_apellido',
        'id' => 'u_apellido',
        'class' => 'form-control inputFormulario',
        'required' => 'required',
        'value' => set_value('u_apellido'),
        'minlength' => '2',
        'pattern' => '[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+',
        'title' => 'Debe tener al menos 2 letras y solo usar letras y espacios'
      ]); ?>
    </div>

    <div class="form-group mb-3">
      <label class="formCarga" for="u_user">Nombre de Usuario</label>
      <?php echo form_input([
        'name' => 'u_user',
        'id' => 'u_user',
        'class' => 'form-control inputFormulario',
        'required' => 'required',
        'value' => set_value('u_user'),
        'minlength' => '3',
        'title' => 'Debe tener al menos 3 caracteres'
      ]); ?>
    </div>

    <div class="form-group mb-3">
      <label class="formCarga" for="u_email">Correo Electrónico</label>
      <?php echo form_input([
        'name' => 'u_email',
        'id' => 'u_email',
        'type' => 'email',
        'class' => 'form-control inputFormulario',
        'required' => 'required',
        'value' => set_value('u_email'),
        'title' => 'Debe ser un correo electrónico válido'
      ]); ?>
    </div>

    <div class="form-group mb-4">
      <label class="formCarga" for="u_pwd">Contraseña</label>
      <?php echo form_password([
        'name' => 'u_pwd',
        'id' => 'u_pwd',
        'class' => 'form-control inputFormulario',
        'required' => 'required',
        'minlength' => '8',
        'autocomplete' => 'off',
        'title' => 'Debe tener al menos 8 caracteres'
      ]); ?>
    </div>

    <?php echo form_submit('guardarRegistro', 'Registrarse', 'class="btn botonFormulario w-100 mb-3"'); ?>

    <?php echo form_close(); ?>

    <p class="text-center mt-3">
      ¿Ya tienes una cuenta? 
      <a href="<?= base_url('mostrarFormularioLogin') ?>" class="text-decoration-none" style="color: #F39C12;">
        Inicia sesión aquí
      </a>
    </p>
  </div>
</div>

<?=$footer?>
