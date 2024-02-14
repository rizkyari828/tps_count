<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css" />
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-cab"></i> Suara
        <small>Input Suara</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
						<div class="row"> <div class="col-md-6"><h3 class="box-title">Masukan Suara untuk <?= $tps->name?></h3></div>
                            <!-- <div class="col-md-6">
                                <a class="btn btn-sm btn-primary" href="<?php echo base_url().'vehicleListing' ?>" title="Back to Vehicles List">
                            <i class="fa fa-backward"></i></a>
                            </div> -->
                        </div>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                  
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addVehicle" action="<?php echo base_url() ?>addSuara" method="post">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="vehiclemodel">Partai</label>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="vehiclemadeyear">Nama</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="vehiclemadeyear">Suara</label>
                                    </div>
                                </div>
                            </div>
                            <?php foreach ($caleg as $key => $value) { ?>
                            <div class="row">
                                <div class="col-md-1">
                                    <img style="border-radius: 50%;" height="35" width="35" src="<?php echo base_url() ?>assets/partai/<?= $value->image_partai ?>" alt="Page Not Found Image" />
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h6><?= $value->partai?></h6>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <h6><?= $value->name?></h6>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        
										<input type="number" class="form-control" placeholder="12345" name="total[]" maxlength="100" value="<?php echo $tps->status_submit == 0 ? 0 : $value->total_suara?>" <?= $status_submit == 0 ? '' : 'disabled'?>/>
                                        <input type="hidden" class="form-control" placeholder="12345" name="id_caleg[]" value="<?=$value->id?>">
                                        <input type="hidden" class="form-control" name="id_input[]" value="<?=$tps->status_submit == 0 ? '' : $value->id_input?>">
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <!-- <?php foreach ($partai as $key => $value) { ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h6><?= $value->partai?></h6>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <h6><?= $value->name?></h6>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
										<input type="number" class="form-control" placeholder="12345" name="total[]" maxlength="100" value="<?php echo $tps->status_submit == 0 ? 0 : $value->total_suara?>" <?= $status_submit == 0 ? '' : 'disabled'?>/>
                                        <input type="hidden" class="form-control" placeholder="12345" name="id_caleg[]" value="<?=$value->id?>">
                                        <input type="hidden" class="form-control" name="id_input[]" value="<?= $tps->status_submit == 0 ? 0 : $value->id_input?>">
                                    </div>
                                </div>
                            </div>
                           
                            <?php } ?> -->
                            <input type="hidden" name="tps_id" value="<?= $tpsId?>"/>
							<div class="row"><div class="col-md-12">
                                        <div class="text-left">
                                <span aria-hidden="true" class="error">*</span>&nbsp;Required field
                            </div></div>
						</div>
                        <input type="hidden" class="form-control" name="type" value="submit">
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />&nbsp;&nbsp;
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>    
    </section>
    
</div>
<script src="<?php echo base_url(); ?>assets/js/addVehicle.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){

        jQuery('.datepicker').datepicker({
          autoclose: true,
          format : "yyyy-mm-dd"
        });
        
    });
</script>