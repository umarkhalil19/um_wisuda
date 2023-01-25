<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Fakultas</h1>
    </div>
    <a href="<?php echo base_url('biro/fakultas_add') ?>" class="btn btn-sm btn-primary pull-right"><span class="fa fa-plus"></span>Tambah Fakultas</a>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
<?php show_alert(); 

// $db = $this->M_vic->panggil_dbpumaba();
// $pes = mysqli_query($db, "SELECT * FROM tbl_fakultas");
// while($p = mysqli_fetch_array ($pes)){
//   echo $p[1].'<br>';
// }
// echo "string";
// mysqli_close($db);
?>
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Fakultas</th>
                <th>Nama Fakultas</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach($fakultas as $d){
               ?>
               <tr>
                 <td><?php echo $no++;; ?></td>
                 <td><?php echo $d->fakultas_id; ?></td>
                 <td><?php echo $d->fakultas_nama; ?></td>
                 <td>
                  <div class="btn-group">
                    <a class="btn btn-outline-success" href="<?php echo base_url().'biro/fakultas_edit/'.$d->fakultas_id ?>" title="Edit Data"><span class="glyphicon glyphicon-wrench">Edit</span>
                    </a>
                    
                    <a class="btn btn-outline-danger btn-delete" id="<?php echo base_url().'biro/fakultas_delete/'.$d->fakultas_id ?>" title="Hapus Data"><span class="glyphicon glyphicon-trash">Hapus</span>
                    </a>
                  </div>
                </td>
              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</main>