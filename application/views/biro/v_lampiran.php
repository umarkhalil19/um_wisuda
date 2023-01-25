<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa"></i> Lampiran</h1>
    </div>
    <a href="<?php echo base_url('biro/lampiran_add') ?>" class="btn btn-sm btn-primary pull-right"><span class="fa fa-plus"></span>Tambah Lampiran</a>
  </div>
  <?php show_alert(); ?>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th>No</th>
                <th>Keperluan</th>
                <th>Kode</th>
                <th>Nama Lampiran</th>
                <th>Format</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach($lampiran as $l){
               ?>
               <tr>
                 <td><?php echo $no++;; ?></td>
                 <td><?php echo $l->lampiran_keperluan; ?></td>
                 <td><?php echo $l->lampiran_id; ?></td>
                 <td><?php echo $l->lampiran_nama; ?></td>
                 <td><?php echo "*.".$l->lampiran_format; ?></td>
                 <td>
                  <div class="btn-group">
                    <a class="btn btn-outline-success" href="<?php echo base_url().'biro/lampiran_edit/'.$l->lampiran_id ?>" title="Edit Data"><span class="glyphicon glyphicon-wrench">Edit</span>
                    </a>
                    
                    <a class="btn btn-outline-danger btn-delete" id="<?php echo base_url().'biro/lampiran_delete/'.$l->lampiran_id ?>" title="Hapus Data"><span class="glyphicon glyphicon-trash">Hapus</span>
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