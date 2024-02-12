<!-- DataTables -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
        <small>CRM System Control Panel</small>
      </h1>
    </section>
    
    <section class="content">
        <div class="row">
        <?php foreach ($caleg as $key => $value) { ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="box box-primary small-box" style="height:150px">
                <div class="inner">
                  <h3 style="color: black;"><?= $value->total ?></h3>
                  <div style="width: 150px;"><h6 style="color: black;"><?= $value->partai ?></h6></div>
                </div>
                <div class="icon">
                  <img height="50" width="50" src="<?php echo base_url() ?>assets/partai/<?= $value->image_partai ?>" alt="Page Not Found Image" />
                </div>
              </div>
            </div><!-- ./col -->
          <?php }?>
          </div>

          <div class="box box-primary"  style="padding: 20px;">
				<div class="card">
            
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Partai</th>
                  <th>Caleg</th>
                  <th>Total Suara</th>
                </tr>
                </thead>
                <tbody>
				        <?php
                    if(!empty($allCaleg))
                    { $i=1;
                        foreach($allCaleg as $record)
                        {
                    ?>
					
                <tr>
                  <td><?php echo $i;?>.</td>
                  <td><?php echo $record->partai; ?></td>
                  <td><?php echo $record->name; ?></td>
                  <td><?php echo $record->total; ?></td>
                </tr>
				        <?php
                        $i++; }
                    }
                    ?>
                
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          </div>

          <div class="box box-primary"  style="padding: 20px;">
				<div class="card">
            
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center"></th>
                  <th class="text-center"></th>
                  <th class="text-center"></th>
                  <th class="text-center" colspan="7">Perolehan Kursi</th>
				          <!-- <th>User Name</th>
                  <th>Action</th> -->
                </tr>
                <tr>
                  <th>No</th>
                  <th>Partai</th>
                  <th>Suara Total</th>
                  <th class="text-center">Kursi 1</th>
                  <th class="text-center">Kursi 2</th>
                  <th class="text-center">Kursi 3</th>
                  <th class="text-center">Kursi 4</th>
                  <th class="text-center">Kursi 5</th>
                  <th class="text-center">Kursi 6</th>
                  <th class="text-center">Kursi 7</th>
                </tr>
                </thead>
                <tbody>
				
				      <?php
                    if(!empty($perolehan_kursi))
                    { $i=1;
                        foreach($perolehan_kursi as $record)
                        {
                    ?>
					
                <tr>
                  <td><?php echo $i;?>.</td>
                  <td><?php echo $record->partai; ?></td>
                  <td><?php echo $record->total; ?></td>
                  <td><?php echo $record->total; ?></td>
                  <td><?php echo round($record->total/3); ?></td>
                  <td><?php echo round($record->total/3); ?></td>
                  <td><?php echo round($record->total/3); ?></td>
                  <td><?php echo round($record->total/3); ?></td>
                  <td><?php echo round($record->total/3); ?></td>
                  <td><?php echo round($record->total/3); ?></td>
                </tr>
				<?php
                        $i++; }
                    }
                    ?>
                
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          </div>

          <div class="box box-primary"  style="padding: 20px;">
				<div class="card">
          
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Pemenang Kursi</th>
                  <th>Saint League</th>
                  <th>Nama Caleg</th>
                </tr>
                </thead>
                <tbody>
				
				 <?php 
                    if(!empty($saint))
                    { $i=1;
                        foreach($saint as $record)
                        {
                    ?>
					
                <tr>
                  <td><?php echo $i;?>.</td>
                  <td><?php echo $record->partai; ?></td>
                  <td><?php echo $record->total; ?></td>
                  <td><?php echo $record->name; ?></td>
                </tr>
				<?php
                        $i++; }
                    }
                    ?>
                
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          </div>
              
    </section>
</div>