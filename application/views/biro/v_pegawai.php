<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Data Pegawai</h1>
    </div>
    <a href="<?php echo base_url('biro/pegawai_add') ?>" class="btn btn-sm btn-primary pull-right"><span class="fa fa-plus"></span>Tambah Pegawai</a>
  </div>
  <?php show_alert(); ?>
  <div class="row">
    <div class="col-lg-12">
      <div class="tile">
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama</th>        
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
               <?php 
                    $no=1;
                    foreach ($pegawai as $pg) {
                 ?>
              <tr>
                 <td><?php echo $no++ ?></td>
                 <td><?php echo $pg->peg_nip ?></td>
                 <td><?php echo $pg->peg_nama ?></td>
                 <td><?php echo $pg->peg_email ?></td>
                 <td><?php echo $pg->peg_status ?></td>
                 <td>
                  <div class="btn-group">
                    <a class="btn btn-md btn-outline-success" href="<?php echo base_url('biro/pegawai_edit/'.$pg->peg_id) ?>" title="Edit Data">Edit</a>
                    <a class="btn btn-md btn-outline-danger btn-delete" id="<?php echo base_url('biro/pegawai_delete/'.$pg->peg_id) ?>" title="Hapus Data">Hapus</a>
                    <a href="<?php echo base_url('biro/pegawai_reset_pass/'.$pg->peg_id) ?>" class="btn btn-md btn-outline-info" title="Reset Password">Reset Password</a>
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