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
$result2 = $conecta->query($lap);
$numero2 = $result2->num_rows;
?>
<div class="container py-4">
     <div class="row">
          <div class="col-sm">
            <div class="card mb-3" style="max-width: 540px;">
               <div class="row no-gutters">
                  <div class="col-md-4">
                     <h1 class="text text-center"><?php echo $numero1 ;?></h1>
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
                    <h1 class="text text-center"><?php echo $numero ;?></h1>
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
                       <h1 class="text text-center"><?php echo $numero2; ?></h1>
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
                      </div>
                      <div class="col-md-8">
                      <div class="card-body">
                         <h5 class="card-title"><span class="icon-font-awesome"></span> Equipos Activos</h5>
                         <p class="card-text">10.</p>
                         <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                      </div>
                   </div>
              </div>
            </div>
            </div>
            <div class="col-sm">
              <div class="card mb-3" style="max-width: 540px;">
                  <div class="row no-gutters">
                     <div class="col-md-4">

                     </div>
                     <div class="col-md-8">
                     <div class="card-body">
                         <h5 class="card-title"><span class="icon-wrench"></span> En Reparación</h5>
                         <p class="card-text">clic.</p>
                         <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                     </div>
                 </div>
             </div>
           </div>
          </div>
              <div class="col-sm">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                       <div class="col-md-4">

                       </div>
                       <div class="col-md-8">
                       <div class="card-body">
                          <h5 class="card-title"><span class="icon-unlink"></span> Por Asignar</h5>
                             <p class="card-text">Usuarios.</p>
                             <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                       </div>
                    </div>
                 </div>
                </div>
              </div>
           </div>
        </div>
       <!-- termina dashboard -->
