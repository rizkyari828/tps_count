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
     
          <div class="box box-danger"  style="padding: 20px;">
            <div class="card">
              <div class="card-body">
              <?php $total = array_shift($caleg)->total?>
              <?php foreach ($allPartaiIn as $key => $value23) { ?>
                <!-- /.card-header -->
                  <div class="row" style="padding: 5px;">
                    <div class="col-md-1">
                      <img style="border-radius: 50%;" height="35" width="35" src="<?php echo base_url() ?>assets/partai/<?= $value23->image_partai ?>" alt="Page Not Found Image" />
                    </div>
                    <div class="col-md-10" style="padding-top: 5px;">
                      <div class="progress">
                        <div class="progress-bar-danger" role="progressbar" style="width: <?php echo ($value23->total/$total*100)?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><div class="text-center text-bold"><?= $value23->total ?></div></div>
                      </div>
                    </div>
                  </div>
                <?php }?>
                <?php foreach ($allPartaiOut as $key => $value33) {?>
                <!-- /.card-header -->
                  <div class="row" style="padding: 5px;">
                    <div class="col-md-1">
                      <img style="border-radius: 50%;" height="35" width="35" src="<?php echo base_url() ?>assets/partai/<?= $value33->image_partai ?>" alt="Page Not Found Image" />
                    </div>
                    <div class="col-md-10" style="padding-top: 5px;">
                      <div class="progress">
                        <div class="progress-bar-danger" role="progressbar" style="width: <?php echo ($value33->total/$total*100)?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><div class="text-center text-bold"><?= $value33->total ?></div></div>
                      </div>
                    </div>
                  </div>
                <?php }?>
                </div>
              </div>
            </div>
        

          <div class="box box-danger"  style="padding: 20px;">
				<div class="card">
            
            <!-- /.card-header -->
            <div class="card-body">
            <?php foreach ($allCalegNot as $key => $value2) { ?>
                <!-- /.card-header -->
                  <div class="row" style="padding: 5px;">
                    <div class="col-md-1">
                      <img style="border-radius: 50%;" height="35" width="35" src="<?php echo base_url() ?>assets/partai/<?= $value2->image_partai ?>" alt="Page Not Found Image" />
                    </div>
                    <div class="col-md-10">
                      <label><?= $value2->name;?></label>
                      <div class="progress" >
                      <?php $countVar = 0;?>
                      <?php foreach ($m_caleg as $key => $value3) {
                        if($value2->partai == $value3->partai){
                          $countVar = $value3->total;
                        }
                      } ?>
                      <div class="progress-bar-danger" role="progressbar" style="width: <?php echo $countVar == 0 ? 0 : ($value2->total*100/$countVar)?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><div class="text-center text-bold"><?php echo $value2->total; ?></div></div>
                      </div>
                      <!-- <h3><?php echo $value2->total; ?>/<?= $countVar ?></h3> -->
                    </div>
                  </div>
                <?php }?>
            <?php foreach ($allCalegIn as $key => $value1) { ?>
                <!-- /.card-header -->
                  <div class="row" style="padding: 5px;">
                    <div class="col-md-1">
                      <img style="border-radius: 50%;" height="35" width="35" src="<?php echo base_url() ?>assets/partai/<?= $value1->image_partai ?>" alt="Page Not Found Image" />
                    </div>
                    <div class="col-md-10">
                      <label><?= $value1->name;?></label>
                      <?php $countVar = 0;?>
                      <?php foreach ($m_caleg as $key => $value3) {
                        if($value1->partai == $value3->partai){
                          $countVar = $value3->total;
                        }
                      } ?>
                      <div class="progress-bar-danger" role="progressbar" style="width: <?php echo $countVar == 0 ? 0 : ($value1->total*100/$countVar)?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><div class="text-center text-bold"><?php echo $value1->total; ?></div></div>
                      </div>
                    </div>
              
                <?php }?>
                </div>
              </div>
            </div>

          <div class="box box-danger"  style="padding: 20px;">
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
                    if(!empty($getStLeague))
                    { $i=1;
                        foreach($getStLeague as $record)
                        {
                    ?>
					
                <tr>
                  <td><?php echo $i;?>.</td>
                  <td><?php echo $record->partai; ?></td>
                  <td><?php echo $record->est; ?></td>
                  <td><?php echo $record->kursi_1; ?></td>
                  <td><?php echo $record->kursi_2; ?></td>
                  <td><?php echo $record->kursi_3; ?></td>
                  <td><?php echo $record->kursi_4; ?></td>
                  <td><?php echo $record->kursi_5; ?></td>
                  <td><?php echo $record->kursi_6; ?></td>
                  <td><?php echo $record->kursi_7; ?></td>
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

          <div class="box box-danger"  style="padding: 20px;">
				<div class="card">
          
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Pemenang Kursi</th>
                  <!-- <th>Saint League</th> -->
                  <th>Nama Caleg</th>
                </tr>
                </thead>
                <tbody>
				
				 <?php 
                    if(!empty($pemenangKursi))
                    { $i=1;
                        foreach($pemenangKursi as $record)
                        {
                    ?>
					
                <tr>
                  <td><?php echo $i;?>.</td>
                  <td><?php echo $record->nama_caleg; ?></td>
                  <!-- <td><?php echo $record->total; ?></td> -->
                  <td><?php echo $record->pemenang_kursi; ?></td>
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