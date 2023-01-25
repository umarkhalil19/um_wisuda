<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-pencil"></i> Buat Pesan Baru</h1>
    </div>
    <a href="<?php echo base_url('biro/pesan') ?>" class=" btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>

    

  </div>
  <?php show_alert(); ?>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <h3 class="tile-title">KIRIM PESAN</h3>
        <div class="tile-body">
          <form method="post" action="<?php echo base_url().'biro/pesan_add_act' ?>" enctype="multipart/form-data">
            <div class="form-group">
              Tujuan (nomor peserta):
              <input type="text" name="kodepeserta" class="form-control" autocomplete="off" <?php echo 'onchange="javascript:namamhs(this)"' ?> autofocus>
              <div id='divnama'></div>
              Subjeck:
              <input type="text" name="judul" class="form-control" value="">
              Pesan:
              <textarea name="pesan" class="ckeditor form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-info">KIRIM</button>
          </form>
        </div>
      </div>
    </div>
</main>