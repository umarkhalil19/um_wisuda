<!DOCTYPE html>
<html>
  <head>
  <meta name="description" content="<?php echo $this->M_vic->get_option('blog_name').' '.$this->M_vic->get_option('blog_description'); ?>">
  <link rel="shortcut icon" href='<?php echo base_url()?>vic_image/system/logo.png'>
  <title><?php echo $this->M_vic->get_option('blog_name'); ?></title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/main.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/drago19.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="text/javascript" src="<?php echo base_url().'assets/plugin/ckeditor/ckeditor.js' ?>"></script>
  </head>
<body>
  <section class="material-half-bg">
    <div class="cover"></div>
  </section>
<section class="login-content">
  <div class="logo">
    <h1 align="center" style="font-family: times new roman; font-size: 26pt;text-decoration: underline;">REGISTRASI CALON PESERTA WISUDA</h1>
  </div>
<main class="">
      <?php show_alert(); ?>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <form method="post" action="<?php echo base_url('index/registrasi_act') ?>" enctype="multipart/form-data">
            <table width="100%" border="0">
              <tr>
                <td align="top"><label class="control-label">*NIM</label></td>
                <td align="top"><input class="form-control" type="text" name="nim" placeholder="NIM Mahasiswa" maxlength="12" autofocus required=""></td>
                <td width="2%">&nbsp;</td>
                <td align="top" width="15%"><label class="control-label">*Nama Mahasiswa</label></td>
                <td align="top" width="34%"><input class="form-control" type="text" name="nama" placeholder="Nama Mahasiswa" required=""></td>
              </tr>
              <tr>
              <td align="top" width="15%"><label class="control-label">Jenis Kelamin</label></td>
                <td align="top" width="34%">
                  <select name="jenis_kelamin" class="form-control">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
                </td>
                <td>&nbsp;</td>
                <td align="top"><label class="control-label">*Prodi/Jurusan</label></td>
                <td align="top">
                  <select class="prodi form-control" name="prodi" required="">
                    <option value="">------- Pilih Prodi/Jurusan -------</option>
                    <?php foreach ($jurusan as $f) {
                      echo '<option value="'.$f->prodi_kode.'" >'.$f->prodi_nama.'</option>';
                    } ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td align="top"><label class="control-label">Tempat Lahir</label></td>
                <td align="top"><input class="form-control" type="text" name="tempat_lahir" placeholder="Tempat Lahir"></td>
                <td>&nbsp;</td>
                <td align="top"><label class="control-label">*Tanggal Lahir</label></td>
                <td align="top"><input class="form-control" id="demoDate1" type="text" name="tanggal_lahir" placeholder="Tanggal Lahir" require=""></td>
              </tr>
              <tr>
                <td align="top" colspan="5"><small>Catatan: <br>* = Wajib di isi; <br>Password= tahun-bulan-tanggal Lahir (Contoh: 1990-09-09).</small></td>
              </tr>
            </table>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit" value="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrasi</button>&nbsp;&nbsp;&nbsp;
              <a class="btn btn-danger pull-right" href="<?php echo base_url(); ?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
</main>
</section>
<!-- Essential javascripts for application to work-->
  <script src="<?php echo base_url() ?>assets/js/jquery-3.2.1.min.js"></script> 
  <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url() ?>assets/js/main.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">$('#sampleTable').DataTable();</script>
  <script src="<?php echo base_url() ?>assets/js/plugins/pace.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/select2.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/bootstrap-datepicker.min.js"></script>
	  
	  <script type="text/javascript">
		$(document).ready(function(){
			$(".tanggal").datepicker({dateFormat:'yy-mm-dd'});
			$("input[type='text'],input[type='password'],input[type='email']").on('keypress', function(e) {
				return e.which !== 13;
			});
      
			$('input[type="submit"]').on("click",function(){
				$(this).addClass('disabled');
			});
			$('body').on("click",".btn-hide-alert",function(){
				var alert = $(this).parent();
				$(alert).slideUp();
			});
			$('#table-datatable').dataTable();
			$('input[type="text"]').attr("autocomplete","off");
        	$(".datetimepicker").datetimepicker({
        		dateFormat: 'yy-mm-dd',
        		timeFormat: 'HH:mm:ss'
        	});
        	$( ".datetimepicker" ).datetimepicker("option", "showAnim", "drop");
        	$(".datepicker").datepicker({
        		dateFormat: 'yy-mm-dd'
        	});
        	$( ".datepicker" ).datepicker("option", "showAnim", "drop");
        	$(".timepicker").timepicker({
				timeFormat: 'HH:mm:ss',
        		minTime: '08:00:00',
        		maxTime: '18:00:00',
        		minuteMax: '30'
        	});
        	$( ".timepicker" ).timepicker("option", "showAnim", "drop");
		});
	</script>

	<!-- ---------------------------------------------------------------------------- -->

	<script type='text/javascript'>
		function createRequestObject() {
		    var ro;
		    var browser = navigator.appName;
		    if(browser == "Microsoft Internet Explorer"){
		        ro = new ActiveXObject("Microsoft.XMLHTTP");
		    }else{
		        ro = new XMLHttpRequest();
		    }
		    return ro;
		}
		var xmlhttp = createRequestObject();

		function jrsn_1(fakultas)
		{
		    var kode = fakultas.value;
		    if (!kode) return;
			xmlhttp.open('get', '<?php echo base_url('admin/jur_per_fak?kode=') ?>'+kode, true);
		    xmlhttp.onreadystatechange = function() {
		        if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
		        {
		             document.getElementById("divprodi1").innerHTML = xmlhttp.responseText;
					 document.getElementById("pilihan").style.display = "none";
		        }
		        return false;
		    }
		    xmlhttp.send(null);
		}

		function fkts_1(jurusan)
		{
		    var kode = jurusan.value;
		    if (!kode) return;
			xmlhttp.open('get', '<?php echo base_url('admin/fak_per_jur?kode=') ?>'+kode, true);
		    xmlhttp.onreadystatechange = function() {
		        if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
		        {
		             document.getElementById("divfakultas1").innerHTML = xmlhttp.responseText;
					 document.getElementById("pilihanfak").style.display = "none";
		        }
		        return false;
		    }
		    xmlhttp.send(null);
		}
		</script>
	  
      <script type="text/javascript">
      $('#sl').click(function(){
        $('#tl').loadingBtn();
        $('#tb').loadingBtn({ text : "Signing In"});
      });
      
      $('#el').click(function(){
        $('#tl').loadingBtnComplete();
        $('#tb').loadingBtnComplete({ html : "Sign In"});
      });
      
      $('#demoDate1').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true,
        orientation: "bottom auto"
      });

      $('#demoDate2').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true,
        orientation: "bottom auto"
      });

			$('#demoDate3').datepicker({
				format: "yyyy-mm-dd",
				autoclose: true,
				todayHighlight: true,
				orientation: "bottom auto"
			});
      
      $('#demoSelect').select2();
    </script>
      
</body>
</html>