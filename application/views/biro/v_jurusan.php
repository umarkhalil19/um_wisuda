<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Jurusan</h1>
    </div>
    <a href="<?php echo base_url('biro/jurusan_add') ?>" class="btn btn-sm btn-primary pull-right"><span class="fa fa-plus"></span>Tambah Jurusan</a>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
  <?php show_alert(); ?>
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Jurusan</th>
                <th>Nama Jurusan</th>
                <th>Fakultas</th>
                <th>Jenjang Jurusan</th>
                <th>Kode Internal</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
        			$no = 1;
        			foreach($jurusan as $d){
					$db = $this->M_vic->panggil_db();
					$fak = mysqli_query($db, "SELECT fakultas_nama FROM tbl_fakultas WHERE fakultas_id = '$d->prodi_fakultas'");
					$f = mysqli_fetch_array ($fak);
        				?>
        				<tr>
        					<td><?php echo $no++;; ?></td>
        					<td><?php echo $d->prodi_kode; ?></td>
        					<td><?php echo $d->prodi_nama; ?></td>
                  <td><?php echo $f[0] ?></td>
        					<td><?php echo $d->prodi_tingkat; ?></td>
                  <td><?php echo $d->prodi_kode_internal; ?></td>
					<td>
						<div class="btn-group">
							<a class="btn btn-sm btn-default btn-outline-success" href="<?php echo base_url().'biro/jurusan_edit/'.$d->prodi_id ?>" title="Edit Data"><span class="glyphicon glyphicon-wrench">Edit</span>
							</a>
							<a class="btn btn-sm btn-default btn-delete btn-outline-danger" id="<?php echo base_url().'biro/jurusan_delete/'.$d->prodi_id ?>" title="Hapus Data"><span class="glyphicon glyphicon-trash">Hapus</span>
							</a>
						</div>
					</td>
				</tr>
				<?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>