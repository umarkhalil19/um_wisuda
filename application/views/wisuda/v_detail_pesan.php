<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-envelope"></i> Pesan</h1>
    </div>
    <a href="<?php echo base_url('wisuda/pesan') ?>" class=" btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
  </div>
  <div class="row">
    <div class="col-md-12">
            <form method="post" action="<?php echo base_url('wisuda/kirim_pesan') ?>" enctype="multipart/form-data">
            <div class="tile">
              <h3 class="tile-title">Form Pesan</h3>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label">Pesan Terkirim</label>
                  <div class="drago19 form-control" style="height: 300px; width: 450px ">
                    <p>
                      <?php 
                        $id = $this->session->userdata('uid');
                        foreach ($pesan as $p) {
                          if ($p->h_pengguna != $id) {
                            echo '<br>';
                              echo '<span class="alert-danger">'.$p->tp_pesan.'</span><br><br>';
                          }else{
                              echo '<span class="pull-right alert-primary">'.$p->tp_pesan.'</span><br><br>';
                          }
                          
                        } 
                      ?>
                      
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-group">Judul Pesan</label>
                  <input type="text" disabled name="judul" class="form-control" value="<?php echo $p->tp_judul ?>">
                  <input type="hidden" name="judul" class="form-control" value="<?php echo $p->tp_judul ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Pesan</label>
                    <input type="hidden" name="kode" value="<?php echo $p->tp_kode ?>">
                    <input type="hidden" name="admin" value="<?php echo $p->tp_admin ?>">
                    <input type="hidden" name="mahasiswa" value="<?php echo $p->tp_mahasiswa ?>">
                    <textarea class="form-control" name="pesan" style="height: 100px" required=""></textarea><br>
                    <button class="btn btn-primary" type="submit"><i class="fa fa-send"></i>Kirim</button>
                </div>
              </div>
            </div>
          </div>
          </form>
        </div>
          </div>
        </div>
    </div>
  </div>
</main>