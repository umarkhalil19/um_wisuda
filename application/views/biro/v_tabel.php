<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Data Peserta</h1>
    </div>
    <a href="<?php echo base_url().'biro/import_form' ?>" class="btn btn-primary"><span class="fa fa-upload"></span>Import Data Peserta</a>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th>No</th>
                <th>Jurusan/Prodi</th>
                <th>Fakultas</th>
                <th>Jumlah</th>
                <th>Detail</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $no=1;
              foreach ($jurusan as $j) {
                ?>
                <tr>
                  <td><?php echo $no++ ?></td>
                  <td><a href="<?php echo base_url().'biro/prodi/'.$j->j_id; ?>"><?php echo $j->j_nama ?></a></td>
                  <td><?php echo $j->j_fakultas ?></td>
                  <td align="center"><a href="<?php echo base_url().'biro/detail_peserta/'.$j->j_id; ?>""><?php echo $jumlah.' Orang' ?></a></td>
                  <td></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>