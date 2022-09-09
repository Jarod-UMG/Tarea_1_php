<!doctype html>
<html lang="en">
  <head>
    <title>Estudiantes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  </head>

  <body style="background-color:Silver">
  <body>
  <nav class="navbar navbar-dark bg-dark navbar-expand-lg bg-opacity-150">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">Jarod Mejía</a>
        <!--<div class="container-fluid">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="/Tipos_Sangre">Tipos Sangre</a>
            </li>
          </ul>
       </div>-->
    </div>
  </nav>
</br>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_estudiantes">Nuevo registro</button>
</br>
      <div class="modal fade" id="modal_estudiantes" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="Modalts" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="Modalts">Formulario Estudiantes</h5>
            </div>
            <div class="modal-body">
              <form action="crud_estudiante.php" method="post" id="miformulario">

              <div class="mb-3">
                <label for="lbl_id" class="form-label"><b>ID</b></label>
                <input type="text" name="txt_id" id="txt_id" class="form-control" value="0"  readonly>
              </div>
              <div class="mb-3">
                <label for="lbl_carne" class="form-label"><b>carne</b></label>
                <input type="text" name="txt_carne" id="txt_carne" class="form-control" placeholder="Carne: E001" required pattern="[E][0-9]{3}">
              </div>
              <div class="mb-3">
                <label for="lbl_nombres" class="form-label"><b>Nombres</b></label>
                <input type="text" name="txt_nombres" id="txt_nombres" class="form-control" placeholder="Nombres: Nombre1 Nombres2" required>
              </div>
              <div class="mb-3">
                <label for="lbl_apellidos" class="form-label"><b>Apellidos</b></label>
                <input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control" placeholder="Apellidos: Apellido1 Apellido2" required>
              </div>
              <div class="mb-3">
                <label for="lbl_direccion" class="form-label"><b>Direccion</b></label>
                <input type="text" name="txt_direccion" id="txt_direccion" class="form-control" placeholder="Direccion: #casa calle avenida lugar" required>
              </div>
              <div class="mb-3">
                <label for="lbl_telefono" class="form-label"><b>Telefono</b></label>
                <input type="number" name="txt_telefono" id="txt_telefono" class="form-control" placeholder="Telefono: 55552222" required>
              </div>
              <div class="mb-3">
                <label for="lbl_ce" class="form-label"><b>Correo electronico</b></label>
                <input type="text" name="txt_ce" id="txt_ce" class="form-control" placeholder="Correo electronico: hola@gmail.com" required>
              </div>
              <div class="mb-3">
                <label for="lbl_ts" class="form-label"><b>Tipo de sangre</b></label>
                <select class="form-select" name="drop_ts" id="drop_ts">
                  <option value=0> ---- Elija ---- </option>
                  <?php 
                   include("datos_conexion.php");
                   $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);
                   $db_conexion -> real_query ("SELECT id_tipo_sangre as id, sangre FROM tipos_sangre;");
                  $resultado = $db_conexion -> use_result();
                  while ($fila = $resultado ->fetch_assoc()){
                    echo "<option value=". $fila['id'].">". $fila['sangre']."</option>";

                  }
                  $db_conexion ->close();

                  ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="lbl_fn" class="form-label"><b>Fecha Nacimiento</b></label>
                <input type="date" name="txt_fn" id="txt_fn" class="form-control" placeholder="aaaa-mm-dd" required>
              </div>

              <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_agregar" name="btn_agregar" value="Agregar">Agregar</button>
                    <button type="submit" class="btn btn-warning" id="btn_modificar" name="btn_modificar" value="Modificar">Modificar</button>
                    <button type="submit" class="btn btn-danger" id="btn_eliminar" name="btn_eliminar" value="Eliminar" onclick="borrar()">Eliminar</button>
                  </div>

              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="limpiar()">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

    </br>
    <table class="table table-striped table-dark table-responsive table-hover table-bordered">
      <thead>
        <tr>
          <th>Carne</th>
          <th>Nombres</th>
          <th>Apellidos</th>
          <th>Direccion</th>
          <th>Telefono</th>
          <th>Correo Electronico</th>
          <th>Tipo de Sangre</th>
          <th>Fecha de Nacimiento</th>
        </tr>
        </thead>
        <tbody id="tbl_estudiantes">
         <?php 
         include("datos_conexion.php");
         $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);
         $db_conexion -> real_query ("SELECT e.id_estudiante as id,e.carne,e.nombres,e.apellidos,e.dirección,e.telefono,e.correo_electronico,ts.sangre,e.fecha_nacimiento,ts.id_tipo_sangre FROM estudiantes as e inner join tipos_sangre as ts on e.id_tipo_sangre = ts.id_tipo_sangre;");
        $resultado = $db_conexion -> use_result();
        while ($fila = $resultado ->fetch_assoc()){
          echo "<tr data-id=". $fila['id']." data-idts=". $fila['id_tipo_sangre'].">";
          echo "<td>". $fila['carne']."</td>";
          echo "<td>". $fila['nombres']."</td>";
          echo "<td>". $fila['apellidos']."</td>";
          echo "<td>". $fila['dirección']."</td>";
          echo "<td>". $fila['telefono']."</td>";
          echo "<td>". $fila['correo_electronico']."</td>";
          echo "<td>". $fila['sangre']."</td>";
          echo "<td>". $fila['fecha_nacimiento']."</td>";
          echo "</tr>";

        }
        $db_conexion ->close();
         ?>
        </tbody>
    </table> 
</div>

    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script type="text/javascript">
    function limpiar(){
        $("#txt_id").val(0);
        $("#txt_carne").val('');
        $("#txt_nombres").val('');
        $("#txt_apellidos").val('');
        $("#txt_direccion").val('');
        $("#txt_telefono").val('');
        $("#txt_ce").val('');
        $("#txt_fn").val('');
        $("#drop_ts").val(0);
        
    }
    $('#tbl_estudiantes').on('click','tr td',function(evt){
        var target,id,idts,carne,nombres,apellidos,direccion,telefono,electronico,nacimiento;
        target = $(event.target);
        id = target.parent().data('id');
        idts = target.parent().data('idts');
        carne = target.parent("tr").find("td").eq(0).html();
        nombres = target.parent("tr").find("td").eq(1).html();
        apellidos =  target.parent("tr").find("td").eq(2).html();
        direccion = target.parent("tr").find("td").eq(3).html();
        telefono = target.parent("tr").find("td").eq(4).html();
        electronico = target.parent("tr").find("td").eq(5).html();
        nacimiento  = target.parent("tr").find("td").eq(7).html();
        $("#txt_id").val(id);
        $("#txt_carne").val(carne);
        $("#txt_nombres").val(nombres);
        $("#txt_apellidos").val(apellidos);
        $("#txt_direccion").val(direccion);
        $("#txt_telefono").val(telefono);
        $("#txt_ce").val(electronico);
        $("#txt_fn").val(nacimiento);
        $("#drop_ts").val(idts);
        $("#modal_estudiantes").modal('show');
    });

    function borrar() {
           var form = document.getElementById('miformulario');
           form.addEventListener('submit', function(event) {
             if (!confirm('Realmente desea eliminar el registro?')) {
               event.preventDefault();
             }
           }, false);
         };
</script>
  </body>
</html>