<?=$header;?>

<div class="container mt-4 listadoAmo">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="tituloFormulario m-0">Mascotas del amo</h4>
  </div>

  <div class="table-responsive shadow-sm border rounded">
    <table class="table table-striped table-hover mb-0">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Nro Registro</th>
          <th scope="col">Nombre</th>
          <th scope="col">Especie</th>
          <th scope="col">Raza</th>
          <th scope="col">Fecha de Alta</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($mascotas as $mascota): ?>  
          <tr>
            <th scope="row"><?= $mascota['m_nroRegistro'] ?></th>
            <td><?= $mascota['m_nombre'] ?></td>
            <td><?= $mascota['m_especie'] ?></td>
            <td><?= $mascota['m_raza'] ?></td>
            <td><?= $mascota['m_fechaAlta'] ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?=$footer;?>
