<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-pencil"></i> Sesi Pendaftran</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
<?php show_alert(); ?>
        <h3 class="tile-title">Form Sesi Pendaftaran</h3>
        <div class="tile-body">
          <form method="post" action="<?php echo base_url().'biro/jadwalwisuda_set_update' ?>" enctype="multipart/form-data">
				<?php echo validation_errors();
					foreach($atur as $a2){
				?>
					<table class="table tbl-form">
						<tr>
							<th colspan="3">Waktu Pendaftaran Ulang</th>
						</tr>
						<tr>
							<th width="25%">Tanggal Buka <br><small>format:: yyyy-mm-dd</small></th><th width="5%">:</th>
							<td>
								<input class="form-control" type="text" id="demoDate1" name="tanggal_buka2" value="<?php echo $a2->set_tanggal_buka; ?>" placeholder="yyyy-mm-dd" autocomplete="off">
							</td>
						</tr>
						<tr>
							<th>Tanggal Tutup <br><small>format:: yyyy-mm-dd</small></th><th>:</th>
							<td>
								<input class="form-control" type="text" id="demoDate2" name="tanggal_tutup2" value="<?php echo $a2->set_tanggal_tutup; ?>" placeholder="yyyy-mm-dd" autocomplete="off">
								<input type="hidden" class="form-control" name="jam_buka2" value="<?php echo $a2->set_jam_buka; ?>">
								<input type="hidden" class="form-control" name="jam_tutup2" value="<?php echo $a2->set_jam_tutup; ?>">
							</td>
						</tr>
						<tr>
							<th>Keterangan <br><small>Informasi Saat Sesi Input Data Tidak Aktif / Tutup</small></th><th>:</th>
							<td>
								<textarea class="form-control" name="keterangan2"><?php echo $a2->set_keterangan; ?></textarea>
							</td>
						</tr>
					</table>
					<table width="100%">
						<th>Status : </th>
						<td>
							<select name="status3" class="form-control">
								<option value="<?php echo $a2->set_status; ?>"><?php echo $a2->set_status ?></option>
								<option value="<?php echo $a2->set_status; ?>"></option>
								<option value="Aktif">Aktif</option>
								<option value="Tidak Aktif">Tidak Aktif</option>
							</select>
						</td>
						<td align="right" width="80%">
							<button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-save"> SIMPAN</i></button>
						</td>
					</table>
				<?php
				} ?>
				
				</div>

				<div class="col-md-12" align="left">
				</div>
			</form>
          </div>
        </div>
      </div>
    </main>
