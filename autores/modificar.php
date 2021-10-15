<?php
include('../conexion.php');
include('../head.php');
include('socicio.php');
$idSocio = $_GET["idSocio"];
$query = "SELECT * FROM socios WHERE idSocio='".$idSocio."'";

$resultado = realizarQuery($query);

$socio = mysqli_fetch_assoc($resultado);

?>


<div class="container-fluid mt-3">
  <div class="row">
    <div class="col-12 justify-content-center">
      <form method="post" action="socios2.php" class="w-50 m-auto">
        
        <h3>DNI</h3>
        <input type="text" name="DNI" value="<?= $socio["DNI"] ?>">
        <h3>Nombre</h3>
        <input type="text" name="nombre" value="<?= $socio["nombre"] ?>">
        <h3>Apellidos</h3>
        <input type="text" name="apellidos" value="<?= $socio["apellidos"] ?>">
        <h3>Fecha de nacimiento</h3>
        <input type="date" name="fechaNacimiento"  value="<?= $socio["fechaNacimiento"] ?>">
        <h3>Dirección</h3>
        <input type="text" name="direccion"  value="<?= $socio["direccion"] ?>">
        <h3>Teléfono</h3>
        <input type="number" name="telefono"  value="<?= $socio["telefono"] ?>">
        <h3>E-mail</h3>
        <input type="text" name="email"  value="<?= $socio["email"] ?>">
        <h3>Fecha de alta</h3>
        <input type="date" name="fechaAlta"  value="<?= $socio["fechaAlta"] ?>">

        <div class="mb-3">
          <h3>Estado</h3>
          <select class="form-select" aria-label="Estado" name="estado"  value="<?= $socio["estado"] ?>">
            <option selected>Seleciona un estado</option>
            <option value="0"><?= $estadosSocio[0] ?></option>
            <option value="1"><?php echo $estadosSocio[1] ?></option>
            <option value="2"><?= $estadosSocio[2] ?></option>
            <option value="3"><?= $estadosSocio[3] ?></option>
            <option value="4"><?= $estadosSocio[4] ?></option>
          </select>
        </div>
        <input type="submit" class="btn btn-danger" value="Guardar">
      </form>
    </div>
  </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>