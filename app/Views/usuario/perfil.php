<?= $header ?>

<div class="container mt-5">
  <div class="formularioAmo shadow">
    <h2 class="tituloFormulario mb-4">Mi Perfil</h2>

    <?php if (session()->getFlashdata('mensaje')): ?>
      <div class="alert alert-success">
        <?= session()->getFlashdata('mensaje') ?>
      </div>
    <?php endif; ?>

    <?= form_open(base_url('actualizar_perfil')) ?>
    
      <!-- NOMBRE -->
      <div class="mb-3">
        <?= form_label('Nombre', 'u_nombre', ['class' => 'form-label']) ?>
        <?= form_input([
          'name' => 'u_nombre',
          'value' => esc($usuario['u_nombre']),
          'class' => 'form-control inputFormulario',
          'required' => true
        ]) ?>
      </div>

      <!-- APELLIDO -->
      <div class="mb-3">
        <?= form_label('Apellido', 'u_apellido', ['class' => 'form-label']) ?>
        <?= form_input([
          'name' => 'u_apellido',
          'value' => esc($usuario['u_apellido']),
          'class' => 'form-control inputFormulario',
          'required' => true
        ]) ?>
      </div>

      <!-- USUARIO (SOLO LECTURA) -->
<div class="mb-3">
  <?= form_label('Usuario', 'u_user', ['class' => 'form-label']) ?>
  <?= form_input([
    'type' => 'text',
    'name' => 'u_user',
    'value' => esc($usuario['u_user']),
    'class' => 'form-control campo-no-editable',
    'readonly' => true
  ]) ?>
</div>

<!-- EMAIL (SOLO LECTURA) -->
<div class="mb-3">
  <?= form_label('Email', 'u_email', ['class' => 'form-label']) ?>
  <?= form_input([
    'type' => 'email',
    'name' => 'u_email',
    'value' => esc($usuario['u_email']),
    'class' => 'form-control campo-no-editable',
    'readonly' => true
  ]) ?>
</div>

<!-- CONTRASEÑA (NO EDITABLE) -->
<div class="mb-3">
  <?= form_label('Contraseña', 'u_pwd', ['class' => 'form-label']) ?>
  <?= form_password([
    'name' => 'u_pwd_fake',
    'value' => '********',
    'class' => 'form-control campo-no-editable',
    'readonly' => true
  ]) ?>
  <small class="text-muted">La contraseña no puede editarse desde aquí.</small>
</div>


      <?= form_submit('guardar', 'Guardar Cambios', ['class' => 'btn botonFormulario w-100']) ?>
    <?= form_close() ?>
  </div>
</div>

<?= $footer ?>
