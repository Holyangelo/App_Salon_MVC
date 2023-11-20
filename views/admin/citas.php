 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
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
        <!-- Main row -->
        <div class="row">
          <div class="col-md-3 col-lg-3">
             <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Fecha</h3>
              </div>
              <div class="card-body">
                <form method="post">
                <!-- Date dd/mm/yyyy -->
                <div class="form-group">
                  <label>Selecciona la Fecha:</label>

                <!-- Date mm/dd/yyyy -->
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="date" class="form-control" data-inputmask-alias="datetime" 
                    data-inputmask-inputformat="yyyy/mm/dd" 
                    data-mask id="fecha" name="fecha" value="<?php echo $fecha; ?>">
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <!-- /.form group -->
                <!--<input type="submit" class="btn btn-primary" style="display: block;" value="Buscar">-->
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- Otra forma de hacerlo -->
        <?php
        /*if(count($todas_las_citas) === 0){
          echo "<h2>No hay Citas</h2>";
        }*/
        ?>
          <?php if (!empty($todas_las_citas)) { ?>
        	<div class="col-md-9 col-lg-9">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Reservas</h3>

                <div class="card-tools">
                  <!--<ul class="pagination pagination-sm float-right">
                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                  </ul>-->
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <?php $idCita = 0; ?>
                <ul class="list-group">
                <?php foreach ($todas_las_citas as $row => $value) { ?>
                  <?php if ($idCita !== $value->id) { ?>
                    <?php $total = 0; ?>
                    <li class="list-group-item">
                      <span class="badge bg-success">ID : <?php echo $value->id; ?></span>
                       <span class="badge bg-info">Cliente: <?php echo $value->cliente; ?></span>
                       <span class="badge bg-secondary">Hora: <?php echo $value->hora; ?></span>
                       <span class="badge bg-primary">Email: <?php echo $value->email; ?></span>
                    </li>
                    <?php $idCita = $value->id; ?>
                    <?php } ?>
                    <li class="list-group-item">
                      <span class="badge bg-warning"><?php echo $value->servicio; ?></span>
                      <span class="badge bg-danger">Precio: $<?php echo $value->precio; ?></span>
                    </li>
                      <?php
                      $total += intval($value->precio);
                      //elemento actual o id actual
                      $actual = $value->id;
                      //nos movemos al proximo elemento, arreglo $todas_las_citas[$columna actual + 1]
                      $proximo = $todas_las_citas[$row + 1] -> id ?? 0;
                      if(esUltimo(intval($actual), intval($proximo))){?>
                      <li class="list-group-item">
                        <span class="badge bg-dark">Total: $<?php echo $total; ?></span>
                      </li>
                      <li class="list-group-item">
                        <form method="post" action="/api/eliminar">
                          <input type="hidden" id="id" name="id" value="<?php echo $value->id; ?>">
                          <input type="submit" value="Eliminar" class="btn btn-danger btn-md">
                        </form>
                      </li>
                        <?php } ?>
                <?php }; ?>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
      <?php }else{?>
        <div class="col-md-9 col-lg-9">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Reservas</h3>

                <div class="card-tools">
                  <!--<ul class="pagination pagination-sm float-right">
                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                  </ul>-->
                </div>
              </div>
                <li class="list-group-item">
                      <span class="badge bg-danger">No Existen Reservas Para La Fecha Seleccionada</span>
                    </li>
                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
      <?php } ?>
        </div>
        <!-- ./row -->
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
  <?php echo "<script src='../build/js/buscador.js'></script>"; ?>