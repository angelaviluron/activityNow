<?=$header?>

<div class="container mt-5 mb-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="formularioAmo shadow">
        <h2 class="tituloFormulario mb-4">Iniciar Sesión</h2>
 
        <?php 

         if (isset($validation)): ?>
  <div class="alert alert-danger">
    <?= $validation->listErrors(); ?>
  </div>
<?php endif; ?>

<?php if (isset($error)): ?>
  <div class="alert alert-danger">
    <?= esc($error) ?>
  </div>
<?php endif; 
        
         if (session()->getFlashdata('mensaje')): ?>
  <div class="alert alert-warning alert fade show" role="alert">
    <?= session()->getFlashdata('mensaje') ?>
   
  </div>
<?php endif; 


       echo form_open_multipart(base_url('guardarLogin'));?>

          <div class="mb-3">
            <?php
              echo form_label('Usuario o Correo', 'usuario', ['class' => 'form-label']);
              echo form_input([
                'name' => 'usuario',
                'id' => 'usuario',
                'class' => 'form-control inputFormulario',
                'required' => true,
                'placeholder' => 'Tu usuario o correo'
              ]);
            ?>
          </div>

          <div class="mb-3">
            <?php
              echo form_label('Contraseña', 'clave', ['class' => 'form-label']);
              echo form_password([
                'name' => 'clave',
                'id' => 'clave',
                'class' => 'form-control inputFormulario',
                'required' => true,
                'placeholder' => 'Tu contraseña'
              ]);
            ?>
          </div>

          <?php
            echo form_submit('submit', 'Ingresar', ['class' => 'btn botonFormulario w-100']);?>
            <div class="mt-3 text-center">
    <p>¿No tienes una cuenta? 
        <a href="<?= base_url('mostrarFormularioRegistro') ?>" class="btn btn-link">Regístrate aquí</a>
    </p>
</div>

           <?php echo form_close();
          ?>

      </div>
    </div>
  </div>
</div>


<?=$footer?>
