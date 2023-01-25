<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Cek List</h1>
    </div>
    <a href="<?php echo base_url('biro/cek_list_add') ?>" class="btn btn-sm btn-primary pull-right"><span class="fa fa-plus"></span>Tambah Cek List</a>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Cek List</th>
                <th>Nama Cek List</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach($cek_list as $c){
               ?>
               <tr>
                 <td><?php echo $no++; ?></td>
                 <td><?php echo $c->cek_list_id; ?></td>
                 <td><?php echo $c->cek_list_nama; ?></td>
                 <td>
                  <div class="btn-group">
                    <a class="btn btn-outline-success" href="<?php echo base_url().'biro/cek_list_edit/'.$c->cek_list_id ?>" title="Edit Data"><span class="glyphicon glyphicon-wrench">Edit</span>
                    </a>
                    
                    <a class="btn btn-outline-danger btn-delete" id="<?php echo base_url().'biro/cek_list_delete/'.$c->cek_list_id ?>" title="Hapus Data"><span class="glyphicon glyphicon-trash">Hapus</span>
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