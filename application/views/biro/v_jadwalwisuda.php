<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list" style=""></i> Jadwal Wisuda</h1>
    </div>
    <a href="<?php echo base_url('biro/jadwalwisuda_add') ?>" class="btn btn-sm btn-primary pull-right"><span class="fa fa-plus"></span>Tambah Jadwal</a>
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
                <th>Angkatan</th>
                <th>Tahun</th>
                <th>Kuota</th>
                <th>Tanggal Pelaksanaan</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach($jadwal as $d){
               ?>
               <tr>
                 <td><?php echo $no++;; ?></td>
                 <td><?php echo $d->jadwal_nama; ?></td>
                 <td><?php echo $d->jadwal_tahun; ?></td>
                 <td><?php echo $d->jadwal_kuota; ?></td>
                 <td><?php echo $d->jadwal_tanggal; ?></td>
                 <td>
                  <div class="btn-group">
                    <a class="btn btn-outline-success" href="<?php echo base_url().'biro/jadwalwisuda_edit/'.$d->jadwal_id ?>" title="Edit Data"><span class="glyphicon glyphicon-wrench">Edit</span>
                    </a>
                    
                    <a class="btn btn-outline-danger btn-delete" id="<?php echo base_url().'biro/jadwalwisuda_delete/'.$d->jadwal_id ?>" title="Hapus Data"><span class="glyphicon glyphicon-trash">Hapus</span>
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