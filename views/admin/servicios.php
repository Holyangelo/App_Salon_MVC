<?php require_once __DIR__.'/../templates/alertas.php'?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="mb-2 row">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Menú Principal</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Inicio</a></li>
              <li class="breadcrumb-item active">Menú Principal</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $servicios_registrados; ?></h3>

                <p>Servicios Registrados</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $citas_no_activas; ?><!--<sup style="font-size: 20px">%</sup></h3>--></h3>

                <p>Citas Procesadas</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $usuarios_activos; ?></h3>

                <p>Usuarios Activos</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $citas_activas; ?></h3>

                <p>Citas Activas</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">
        <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="mb-2 row">
          <div class="col-sm-6">
            <h1>Servicio Nuevo</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Servicios</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">General</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <form class="form-horizontal" method="POST" action="/servicios/crear">
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control">
              </div>
              <div class="form-group">
                <label for="precio">Precio</label>
                <input type="number" id="precio" name="precio" class="form-control" min="1" max="500">
              </div>
              <input type="submit" class="float-right btn btn-success" id="nuevo-servicio" value="Registrar">
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6">
          <?php 
          if(isset($alertas)){
            foreach($alertas as $key => $mensajes):?>
            <?php foreach($mensajes as $mensaje): ?>
              <div class="alert <?php echo $key == 'Error' ? 'alert-danger' : 'alert-success' ?> alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon <?php echo $key == 'Error' ? 'fas fa-ban' : 'fas fa-check' ?>"></i> <?php echo $key == 'Error' ? 'Error' : 'Exito' ?>!</h5>
                  <?php echo $mensaje;  header("Refresh:2");?>
                </div>  
                <?php
                endforeach; 
              endforeach;
              }?>
              <?php 
          if(isset($_GET['alerta'])){ $alerta = $_GET['alerta'];?>
              <div class="alert <?php echo $alerta == 1 || $alerta == 5 ? 'alert-success' : 'alert-danger' ?> alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5>
                    <i class="icon <?php echo $alerta == 1 || $alerta == 5 ? 'fas fa-check' : 'fas fa-ban' ?>"></i> 
                    <?php echo $alerta == 1 || $alerta == 5 ? 'Exito' : 'Error' ?>!</h5>
                  <?php if($alerta == 1){
                    echo "Servicio Registrado";
                  } else if($alerta == 2){
                    echo "No se ha podido registrar el servicio";
                  } else if($alerta == 3){
                    echo "Los campos no pueden estar vacios";
                  } else if($alerta == 4){
                    echo "Servicio no existe";
                  } else if($alerta == 5){
                    echo "Servicio Eliminado";
                  } else if($alerta == 6){
                    echo "Servicio no ha podido ser Eliminado";
                  };  header("Refresh:2, url=servicios");?>
                </div>  
                <?php
              }?>
        </div>
      </div>
    <!-- /.content -->
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="border-0 card-header">
                <h3 class="card-title">Servicios</h3>
                <!--<div class="card-tools">
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-bars"></i>
                  </a>
                </div>-->
              </div>
              <div class="p-0 card-body table-responsive">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th>Servicio</th>
                    <th>Precio</th>
                    <th>No Ventas</th>
                    <th>Total Ventas</th>
                    <th colspan="2">Opciones</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $total_vendido = 0 ?>
                    <?php foreach ($todos_los_servicios as $todos => $value) { ?>
                  <tr>
                    <td>
                      <?php echo $value->nombre ?>
                    </td>
                    <td>$<?php echo $value->precio ?></td>
                    <td class="text-center"><?php echo $ventas_por_servicios[$todos] ?></td>
                    <?php $total_vendido += ($ventas_por_servicios[$todos] * $value->precio); ?>
                    <td class="text-center">
                      <!--<small class="mr-1 text-success">
                        <i class="fas fa-arrow-up"></i>
                        12%
                      </small>-->
                      $<?php echo ($ventas_por_servicios[$todos] * $value->precio); ?>
                    </td>
                    <td>
                      <button class="text-white btn btn-warning btn-sm" data-toggle="modal" data-target="#actualizarModal" 
                      id="actualizar_servicio" data-id = "<?php echo $value->id; ?>">
                      <i class="fas fa-edit"></i>
                      </button>
                    </td>
                    <td>
                      <button class="text-white btn btn-danger btn-sm" data-toggle="modal" data-target="#eliminarModal"
                      id="eliminar_servicio" data-id = "<?php echo $value->id; ?>">
                        <i class="fas fa-trash"></i>
                      </button>
                    </td>
                  </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-6">
            <div class="card">
              <div class="border-0 card-header">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Sales</h3>
                  <a href="javascript:void(0);">View Report</a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-lg text-bold">$<?php echo $total_vendido; ?></span>
                    <span>Total vendido</span>
                  </p>
                  <p class="ml-auto text-right d-flex flex-column">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 33.1%
                    </span>
                    <span class="text-muted">Since last month</span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="mb-4 position-relative">
                  <canvas id="sales-chart" height="200"></canvas>
                </div>

                <div class="flex-row d-flex justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This year
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> Last year
                  </span>
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">

            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <!-- Modal -->
<div class="modal fade" id="actualizarModal" tabindex="-1" aria-labelledby="actualizarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="actualizarModalLabel">Actualizar Servicio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/servicios/actualizar" method="POST">
        <input type="hidden" name="id_servicios" id="id_servicios">
        <div class="form-group">
          <label for="nombre_servicios">Nombre</label>
          <input type="text" class="form-control" id="nombre_servicios" name="nombre_servicios">
        </div>
        <div class="form-group">
          <label for="precio_servicios">Precio</label>
          <input type="number" class="form-control" id="precio_servicios" name="precio_servicios" >
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="text-white btn btn-warning" id="actualizar_servicios_modal">Actualizar</button>
      </div>
    </form>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="eliminarModal" tabindex="-1" aria-labelledby="eliminarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="eliminarLabel">Eliminar Servicio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/servicios/eliminar" method="POST">
        <input type="hidden" name="id_servicios_eliminar" id="id_servicios_eliminar">
        <div class="form-group">
          <label for="nombre_servicios">Nombre</label>
          <input type="text" class="form-control" id="nombre_servicios_eliminar" name="nombre_servicios_eliminar" disabled >
        </div>
        <div class="form-group">
          <label for="precio_servicios">Precio</label>
          <input type="number" class="form-control" id="precio_servicios_eliminar" name="precio_servicios_eliminar" disabled>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" id="eliminar_servicios_modal">Eliminar</button>
      </div>
    </form>
    </div>
  </div>
</div>
  <?php echo "<script src=''></script>"; ?>