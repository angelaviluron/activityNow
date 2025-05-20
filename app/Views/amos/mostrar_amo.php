<?=$header;?>

<div class="container mt-4 listadoAmo">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="tituloFormulario m-0">Listado de Amos</h4>
    <a class="btn botonFormulario" href="<?=base_url('cargar_amo')?>">+ Nuevo amo</a>
  </div>

  <div class="table-responsive shadow-sm border rounded">
    <table class="table table-striped table-hover mb-0">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Nº Cliente</th>
          <th scope="col">Apellido y Nombre</th>
          <th scope="col">Dirección</th>
          <th scope="col">Teléfono</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($amos as $amo): ?>  
          <tr>
            <th scope="row"><?= $amo['a_id']?></th>
            <td><?= $amo['a_apellido'];?>, <?= $amo['a_nombre'];?></td>
            <td><?= $amo['a_dir']?></td>
            <td><?= $amo['a_tel']?></td>
            <td>
              <a class="btn btn-sm btn-outline-info me-2" href="<?=base_url('mascota_de_amo/'.$amo['a_id'])?>">Ver mascotas</a>
            </td>
            <td>
              <a class="btn btn-sm btn-outline-info me-2" href="<?=base_url('editar/'.$amo['a_id'])?>">Editar</a>
              <a class="btn btn-sm btn-outline-danger" href="<?=base_url('borrar/'.$amo['a_id'])?>">Borrar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?=$footer;?>
