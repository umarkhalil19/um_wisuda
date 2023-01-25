<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Lampiran</h1>
    </div>
    <a href="<?php echo base_url('mahasiswa/lampiran_add') ?>" class="btn btn-sm btn-primary pull-right"><span class="fa fa-plus"></span>Tambah Lampiran</a>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="bs-component" style="margin-bottom: 15px;">
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
          <label class="btn btn-md btn-primary">
            <a id="option1" type="radio" name="options" autocomplete="off" checked="true"><i class="fa fa-user"></i></a>
          </label>
          <label class="btn btn-primary active" aria-pressed="true">
            <a id="option1" type="radio" name="options" autocomplete="off" checked="true"><i class="fa fa-file"></i></a>
          </label>
        </div>
      </div>
      <div class="tile">
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th>No</th>
                <th>NIM Peserta</th>
                <th>Prodi/Jurusan</th>
                <th>Kode Lampiran</th>
                <th>Nama Lampiran</th>
                <th>Format Lampiran</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                <?php 
                    $no = 1;
                    foreach ($lampiran as $l) {
                      echo '<tr>';
                      echo '<td>'.$no++.'</td>';
                      echo '<td>'.$l->peserta_kode.'</td>';
                      echo '<td>'.$l->peserta_prodi.'</td>';
                      echo '<td>'.$l->peserta_lamp_kode.'</td>';
                      echo '<td>'.$l->peserta_lamp_nama.'</td>';
                      echo '<td>'.$l->peserta_lamp_format.'</td>';
                 ?>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-sm btn-default btn-outline-success" href="<?php echo base_url().'assets/upload_file/'.$l->peserta_lamp_kode ?>" title="Edit Data"><span class="glyphicon glyphicon-wrench">Edit</span>
                        </a>
                        <a class="btn btn-sm btn-default btn-delete btn-outline-danger" id="<?php echo base_url().'biro/jurusan_delete/'.$l->peserta_id ?>" title="Hapus Data"><span class="glyphicon glyphicon-trash">Hapus</span>
                        </a>
                      </div>
                    </td>
                    </tr>
              <?php } ?>
            </tbody>
          </table>
          <a href="<?php echo base_url('mahasiswa/biodata') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
      </div>
    </div>
  </div>
</main>