<!-- Essential javascripts for application to work-->
<script>
    CKEDITOR.replace('editor1' ,{
      filebrowserImageBrowseUrl : '<?php echo base_url('assets/plugin/kcfinder'); ?>',
      filebrowserUploadUrl : '<?php echo base_url('assets/plugin/kcfinder'); ?>',
      filebrowserBrowseUrl : '<?php echo base_url('assets/plugin/kcfinder'); ?>'
    });
  </script>
  
  
      <script src="<?php echo base_url() ?>assets/js/jquery-3.2.1.min.js"></script>
      <script src="<?php echo base_url() ?>assets/js/popper.min.js"></script>
      <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
      <script src="<?php echo base_url() ?>assets/js/main.js"></script>
       <script type="text/javascript">
			$(document).ready(function(){
				$('#fakultas').change(function(){
					var id=$(this).val();
					$.ajax({
						url : "<?php echo base_url();?>biro/prodi",
						method : "POST",
						data : {id: id},
						async : false,
				        dataType : 'json',
						success: function(data){
							var html = '';
				            var i;
				            for(i=0; i<data.length; i++){
				                html += '<option value="'+data[i].prodi_kode+'">'+data[i].prodi_nama+'</option>';
				            }
				            $('.prodi').html(html);
							
						}
					});
				});
			});
		</script>
      <!-- Data table plugin-->
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
      <!-- The javascript plugin to display page loading on top-->
      <script src="<?php echo base_url() ?>assets/js/plugins/pace.min.js"></script>
      <!-- Page specific javascripts-->
      <script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/select2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/bootstrap-datepicker.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/chart.js"></script>

      <script>
      // window.setTimeout(function() {
      //   $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); });
      //   $(".alert-danger").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); });
      // }, 3000);

      window.picker = $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 100, // Creates a dropdown of 15 years to control year
        //format: 'dd/mm/yyyy'
        format: 'yyyy-mm-dd'
    });

    </script>
	  
	  <script type="text/javascript">
		$(document).ready(function(){
			// sidebar menu admin
			$(".tanggal").datepicker({dateFormat:'yy-mm-dd'});

			$(".admin-sidebar-menu > li > a.tutup").click(function(e){
				e.preventDefault();
				if($(this).hasClass("buka")){
					$(this).removeClass("buka");
					$(this).parent().children("ul").stop(true,true).slideUp("normal");
				}else{
					$(".admin-sidebar-menu a.tutup.buka").removeClass("buka");
					$(this).addClass("buka");
					$(".sub").filter(":visible").slideUp("normal");
					$(this).parent().children("ul").stop(true,true).slideDown("normal");
				}
			});
			// akhir sidebar menu admin

			$('.sidebar-toggle').click(function(){
				$('.admin-sidebar').toggle();
				$('.navbar-top-admin').toggleClass('col-md-offset-2 col-md-10 col-md-12');
				$('.admin-navbar-footer').toggleClass('col-md-offset-2 col-md-10');
				$('.admin-content').toggleClass('col-md-10 col-md-12');
			});

			// disable submit form dengan enter
			$("input[type='text'],input[type='password'],input[type='email']").on('keypress', function(e) {
				return e.which !== 13;
			});
			// end

			// disable double insert record double click
			$('input[type="submit"]').on("click",function(){
				$(this).addClass('disabled');
			});

			$('body').on("click",".btn-hide-alert",function(){
				var alert = $(this).parent();
				$(alert).slideUp();
			});

			$('body').on("click",".btn-delete",function(){
				var link = $(this).attr('id');
				$('.modal-delete').modal();
				$('.btn-delete-oke').click(function(){
					location.replace(link);
				});
			});

			$('body').on("click",".btn-mahasiswa",function(){
				var link = $(this).attr('id');
				$('.modal-mahasiswa').modal();
				$('.btn-mahasiswa-oke').click(function(){
					location.replace(link);
				});
			});

		    $('.btn-setting').click(function (e) {
		        e.preventDefault();
		        $('#myModal').modal('show');
		    });

			$('#table-datatable').dataTable();

			$('input[type="text"]').attr("autocomplete","off");

			$('body').on("change", ".btn-image-cover", function() {
            var file = this.files[0];
            var jumlah = this.files.length;
            for (i = 0; i < jumlah; i++) {
            	if (this.files && this.files[i]) {
	            		var filerdr = new FileReader();
	            		filerdr.onload = function(e) {
	            			$('.tampil-image-cover').append("<img class='gambar-cover-sementara' src='" + e.target.result + "'>");
	            			$('.btn-hapus-cover').show();
	            			$('.btn-image-cover').hide();
            			}
            			filerdr.readAsDataURL(this.files[i]);
            		}
	            }
	        });

	        $('body').on("click", ".btn-hapus-cover", function() {
            	$(this).hide();
         		$('.btn-image-cover').val("");
         		$('.tampil-image-cover img').hide();
         		$('.btn-image-cover').show();
	        });

	        $('body').on("click",".hapus-cover-image",function(){
	        	var id = $(this).attr('id');
	        	var data = "id="+id;
	        	if(confirm("Apakah anda yakin ingin menghapus gambar cover ini ?")){
	        		$.ajax({
	        			type: 'POST',
	        			url: "<?php echo base_url() ?>" + "admin/hapus_cover_page",
	        			data: data,
	        			success: function() {
	        				location.reload();
	        			}
	        		});
	        	}
	        });

	        $('body').on("click",".hapus-cover-image-post",function(){
	        	var id = $(this).attr('id');
	        	var data = "id="+id;
	        	if(confirm("Apakah anda yakin ingin menghapus gambar cover ini ?")){
	        		$.ajax({
	        			type: 'POST',
	        			url: "<?php echo base_url() ?>" + "admin/hapus_cover_post",
	        			data: data,
	        			success: function() {
	        				location.reload();
	        			}
	        		});
	        	}
	        });

	         $('body').on("click",".tambah-widget",function(){
	        	var location = $(this).attr('id');
	        	$('.muncul_lokasi').html(location);
	        	$('#modalwidget').modal();
	        });


	         $('body').on("click",".btn-tambah-widget",function(){
	        	var widget = $(this).attr('id');
	        	var location = $(".muncul_lokasi").html();
	        	var data = "widget="+widget+"&location="+location;
        		$.ajax({
        			type: 'POST',
        			url: "<?php echo base_url() ?>" + "admin/tambah_widget",
        			data: data,
        			success: function() {
        				window.location.reload();
        			}
        		});
	        });

	         // $('.widget').sortable();


			$('body').on("change",".update-option",function(){
				var option = $(this).attr('id');
				var value = $(this).val();

				var data = "option="+option+"&value="+value;
				$.ajax({
					type: 'POST',
					url: "<?php echo base_url() ?>" + "admin/update_option",
					data: data,
					success: function() {
						$('.xxx').hide();
					},
					beforeSend: function(){
						$(".ajax-save").after().hide();
						$("#"+option).after("<img class='xxx' src='<?php echo base_url()?>dah_image/system/123_ajax_loader.gif'></img>");
					},
					complete: function(){
						$("#"+option).after('<span class="ajax-save">saved</span>');
					},
					error: function() {
						alert("Failed !");
					}
				});
			});

			$("ul.sort-widget").sortable({
				cursor: 'move',
				update: function () {
					var posisi = $(this).attr('id');
					var widget = $(this).sortable("serialize");
					var data = widget+"&posisi="+posisi;
					$.ajax({
						type:'POST',
						url:"<?php echo base_url() ?>"+"admin/update_sort_widget",
						data:data,
						success:function(){
							alert("widget-saved!!");
						}
					});
				}
	        });



			$("ul.sort-menu").sortable({
				cursor: 'move',
				connectWith: $('ul'),
				placeholder: 'tujuan',
				items: 'li',
				update: function (event,ui) { // syarat mengambil atribut id li yang di pilih
					var selected = ui.item.attr('ini');
					var parent = ui.item.parent().attr('parent'); //ui.item untuk berarti list yang di seret
					var mother_tujuan = ui.item.parent().attr('id');
					var mother = $(this).attr('id');
					var menu = $(this).sortable("serialize");
					var data = menu+"&mother="+mother+"&selected="+selected+"&parent="+parent+"&mother_tujuan="+mother_tujuan;
					$.ajax({
						type:'POST',
						url:"<?php echo base_url() ?>"+"admin/update_sort_menu",
						data:data,
						success:function(){

						},
						beforeSend: function(){
							$('.tampil-loader').html("<img class='xxx pull-right' src='<?php echo base_url()?>dah_image/system/123_ajax_loader.gif'></img>");
						},
						complete: function(){
							$('.tampil-loader').html('');
						}
					});

				}

	        });

			$(".slider-sort").sortable({
				cursor:'move',
				update:function(){
					var xx = $(".slider-sort").sortable('serialize');
					$.ajax({
						type:'POST',
						data: xx,
						url:"<?php echo base_url().'admin/slider_sort' ?>",
						success:function(){
							alert("Slider berhasil di urutkan !");
						}
					});
				}
			});

	        $( "ul.sort-menu" ).disableSelection();

        	//$(".datetimepicker").datetimepicker();
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

		function tampilkota1(prov)
		{
		    var prov = prov.value;
		    if (!prov) return;
			xmlhttp.open('get', '<?php echo base_url('admin/kota_perpov?prov=') ?>'+prov, true);
		    xmlhttp.onreadystatechange = function() {
		        if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
		        {
		             document.getElementById("divkota1").innerHTML = xmlhttp.responseText;
					 document.getElementById("pilihan").style.display = "none";
		        }
		        return false;
		    }
		    xmlhttp.send(null);
		}

		function tampilkota2(kab)
		{
		    var kab = kab.value;
		    var prov = $('#provinsi').val();
		    if (!kab) return;
			xmlhttp.open('get', '<?php echo base_url('admin/kota_perkab?kab=') ?>'+kab+'&prov='+prov, true);
		    xmlhttp.onreadystatechange = function() {
		        if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
		        {
		             document.getElementById("divkota2").innerHTML = xmlhttp.responseText;
					 document.getElementById("pilihan2").style.display = "none";
		        }
		        return false;
		    }
		    xmlhttp.send(null);
		}

		function cek(cekbox){
		    for(i=0; i < cekbox.length; i++){
		        cekbox[i].checked = true;
		    }
		}
		function uncek(cekbox){
		    for(i=0; i < cekbox.length; i++){
		        cekbox[i].checked = false;
		    }
		}

        function namamhs(kode)
        {
            var kode = kode.value;
            if (!kode) return;
            xmlhttp.open('get', '<?php echo base_url('vicpanggil/panggil_nama_mhs?kode=') ?>'+kode, true);
            xmlhttp.onreadystatechange = function() {
                if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
                {
                     document.getElementById("divnama").innerHTML = xmlhttp.responseText;
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

      $('#demoDate4').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true,
        orientation: "bottom auto"
      });

      $('#demoDate5').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true,
        orientation: "bottom auto"
      });
      
      $('#demoSelect').select2();
    </script>
      <script type="text/javascript">
        var data = {
        	labels: ["January", "February", "March", "April", "May"],
        	datasets: [
        		{
        			label: "My First dataset",
        			fillColor: "rgba(220,220,220,0.2)",
        			strokeColor: "rgba(220,220,220,1)",
        			pointColor: "rgba(220,220,220,1)",
        			pointStrokeColor: "#fff",
        			pointHighlightFill: "#fff",
        			pointHighlightStroke: "rgba(220,220,220,1)",
        			data: [65, 59, 80, 81, 56]
        		},
        		{
        			label: "My Second dataset",
        			fillColor: "rgba(151,187,205,0.2)",
        			strokeColor: "rgba(151,187,205,1)",
        			pointColor: "rgba(151,187,205,1)",
        			pointStrokeColor: "#fff",
        			pointHighlightFill: "#fff",
        			pointHighlightStroke: "rgba(151,187,205,1)",
        			data: [28, 48, 40, 19, 86]
        		}
        	]
        };
        var pdata = [
        	{
        		value: 300,
        		color: "#46BFBD",
        		highlight: "#5AD3D1",
        		label: "Complete"
        	},
        	{
        		value: 50,
        		color:"#F7464A",
        		highlight: "#FF5A5E",
        		label: "In-Progress"
        	}
        ]
        
        var ctxl = $("#lineChartDemo").get(0).getContext("2d");
        var lineChart = new Chart(ctxl).Line(data);
        
        var ctxp = $("#pieChartDemo").get(0).getContext("2d");
        var pieChart = new Chart(ctxp).Pie(pdata);
      </script>
      <!-- Google analytics script-->
      <script type="text/javascript">
        if(document.location.hostname == 'pratikborsadiya.in') {
        	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        	ga('create', 'UA-72504830-1', 'auto');
        	ga('send', 'pageview');
        }
      </script>

	  

<!-- modal hapus -->
<div class="modal fade modal-delete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Peringatan</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda yakin Ingin Menghapus Data Ini ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-delete-oke">Delete</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade modal-mahasiswa">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Data Mahasiswa</h4>
      </div>
      <div class="modal-body">
        <p>Data Mahasiswa Baru</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- akhir modal hapus -->


	  
    </body>
  </html>