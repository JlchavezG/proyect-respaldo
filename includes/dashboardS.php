<?php
// consulta para saber numero de usuarios registrados
$usu = "SELECT * FROM Usuarios";
$result = $conecta->query($usu);
$numero = $result->num_rows;
// consulta para saber numero de equipos registrados
$lap = "SELECT * FROM Laptop";
$result1 = $conecta->query($lap);
$numero1 = $result1->num_rows;
// consulta para saber numero de asignaciones
$asig = "SELECT * FROM Asignaciones";
$result2 = $conecta->query($asig);
$numero2 = $result2->num_rows;
// consulta para saber numero de equipos Activos
$act = "SELECT * FROM Laptop WHERE Identificador = 0";
$result3 = $conecta->query($act);
$numero3 = $result3->num_rows;
// consulta para saber numero de equipos en mantenimiento
$manto = "SELECT * FROM Laptop WHERE Identificador = 1";
$result4 = $conecta->query($manto);
$numero4 = $result4->num_rows;
// consulta para tomar equipos no asignados
$noasig = "SELECT * FROM Laptop WHERE Estatus = 2";
$result5 = $conecta->query($noasig);
$numero5 = $result5->num_rows;
?>
<div class="container py-4">
     <div class="row">
          <div class="col-sm">
            <div class="card mb-3" style="max-width: 540px;">
               <div class="row no-gutters">
                  <div class="col-md-4">
                     <h1 class="text text-center text-success"><?php echo $numero1 ;?></h1>
                  </div>
                  <div class="col-md-8">
                  <div class="card-body">
                     <h5 class="card-title"><span class="icon-monitor"></span> Equipos</h5>
                     <p class="card-text"><small class="text-muted">Registrados</small></p>
                  </div>
               </div>
          </div>
        </div>
        </div>
        <div class="col-sm">
          <div class="card mb-3" style="max-width: 540px;">
              <div class="row no-gutters">
                 <div class="col-md-4">
                    <h1 class="text text-center text-success"><?php echo $numero ;?></h1>
                 </div>
                 <div class="col-md-8">
                 <div class="card-body">
                     <h5 class="card-title"><span class="icon-user-1"></span> Usuarios</h5>
                     <p class="card-text"><small class="text-muted">Registrados</small></p>
                 </div>
             </div>
         </div>
       </div>
      </div>
          <div class="col-sm">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                   <div class="col-md-4">
                       <h1 class="text text-center text-success"><?php echo $numero2; ?></h1>
                   </div>
                   <div class="col-md-8">
                   <div class="card-body">
                      <h5 class="card-title"><span class="icon-link"></span> Asignaciones</h5>
                         <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                   </div>
                </div>
             </div>
            </div>
          </div>
       </div>
    </div>
    <!-- segunda fila del dashboard -->
    <div class="container py-4">
         <div class="row">
              <div class="col-sm">
                <div class="card mb-3" style="max-width: 540px;">
                   <div class="row no-gutters">
                      <div class="col-md-4">
                        <h1 class="text text-center text-success"><?php echo $numero3; ?></h1>
                      </div>
                      <div class="col-md-8">
                      <div class="card-body">
                         <h5 class="card-title"><span class="icon-font-awesome"></span> Equipos Activos</h5>
                         <p class="card-text"><small class="text-muted">Dentro de el Sistema</small></p>
                      </div>
                   </div>
              </div>
            </div>
            </div>
            <div class="col-sm">
              <div class="card mb-3" style="max-width: 540px;">
                  <div class="row no-gutters">
                     <div class="col-md-4">
                       <h1 class="text text-center text-success"><?php echo $numero4; ?></h1>
                     </div>
                     <div class="col-md-8">
                     <div class="card-body">
                         <h5 class="card-title"><span class="icon-wrench"></span> En Reparación</h5>
                         <p class="card-text"><small class="text-muted">Dentro de el Sistema</small></p>
                     </div>
                 </div>
             </div>
           </div>
          </div>
              <div class="col-sm">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                       <div class="col-md-4">
                            <h1 class="text text-center text-success"><?php echo $numero5; ?></h1>
                       </div>
                       <div class="col-md-8">
                       <div class="card-body">
                          <h5 class="card-title"><span class="icon-unlink"></span> Por Asignar</h5>
                             <p class="card-text"><small class="text-muted">En el sistema</small></p>
                       </div>
                    </div>
                 </div>
                </div>
              </div>
           </div>
        </div>
       <!-- termina dashboard -->
