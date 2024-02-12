<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css" />
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-cab"></i> Suara
        <small>Pilih TPS</small>
      </h1>
    </section>
    
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
						<div class="row"> <div class="col-md-6"><h3 class="box-title">Pilih TPS untuk input suara</h3></div>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addVehicle" action="<?php echo base_url() ?>addSuara" method="post">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <?php if($role == 1){ ?>
                                        <div class="form-group">
                                        <label for="cid">Kabupaten&nbsp;<span class="error">*</span></label>
                                        <select class="form-control required" name="cid" id="selectKecamatan" onchange="setKecamatan()">
                                            <option value="0">Pilih Kabupaten</option>
                                            <?php
                                            if(!empty($kabupaten))
                                            {
                                                foreach ($kabupaten as $cname)
                                                {
                                                    ?>
                                                    <option value="<?php echo $cname->id ?>" <?php if($cname->id == set_value('cid')) {echo "selected=selected";} ?>><?php echo $cname->name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="cid">Kecamatan&nbsp;<span class="error">*</span></label>
                                        <select class="form-control required" name="cid" id="selectKelurahan" onchange="setKelurahan()">
                                            
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="cid">Kelurahan&nbsp;<span class="error">*</span></label>
                                        <select class="form-control required" name="cid" id="selectTps" onchange="setTps()">
                                            
                                        </select>
                                    </div>
                                    <?php }else{ ?>
                                    <div class="form-group">
                                        <label for="cid">Kelurahan&nbsp;<span class="error">*</span></label>
                                        <select class="form-control required" name="cid" id="selectTps" onchange="setTps()">
                                            <option value="0">Pilih Kelurahan</option>
                                            <?php
                                            if(!empty($kelurahan))
                                            {
                                                foreach ($kelurahan as $cname)
                                                {
                                                    ?>
                                                    <option value="<?php echo $cname->id ?>" <?php if($cname->id == set_value('cid')) {echo "selected=selected";} ?>><?php echo $cname->name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <?php } ?>
                                
                                    <div class="form-group">
                                        <label for="cid">Nama TPS&nbsp;<span class="error">*</span></label>
                                        <select name="tps_id" data-plugin-selectTwo class="form-control selectCity" id="selectCity" required>
                                            <!-- <option value="0">Pilih TPS</option> -->
                                        </select>
                                    </div>
                                    <input type="hidden" class="form-control" name="type" value="select">
                                    <div class="row"><div class="col-md-12">
                                            <div class="text-left">
                                    <span aria-hidden="true" class="error">*</span>&nbsp;Required field
                                </div></div><br><br>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />&nbsp;&nbsp;
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
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

<script>
    function setTps() {
        var kelurahan = document.getElementById('selectTps').value;
        $.ajax({
            type: 'POST',
            url: '<?= base_url('listTps') ?>',
            data: 'kelurahan=' + kelurahan,
            success: function(response) {
                console.log(response);
                $('#selectCity').html(response);
                negara();
                select2();
            }
        });
    }

    function setKecamatan() {
        var kabupaten = document.getElementById('selectKecamatan').value;
        $.ajax({
            type: 'POST',
            url: '<?= base_url('selectKecamatan') ?>',
            data: 'kabupaten=' + kabupaten,
            success: function(response) {
                console.log(response);
                $('#selectKelurahan').html(response);
                negara();
                select2();
            }
        });
    }

    function setKelurahan() {
        var kecamatan = document.getElementById('selectKelurahan').value;
        $.ajax({
            type: 'POST',
            url: '<?= base_url('selectKelurahan') ?>',
            data: 'kecamatan=' + kecamatan,
            success: function(response) {
                console.log(response);
                $('#selectTps').html(response);
                negara();
                select2();
            }
        });
    }
</script>