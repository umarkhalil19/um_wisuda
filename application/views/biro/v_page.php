<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa"></i> Setting Halaman Cetak Buku Wisuda</h1>
    </div>
    <?php /*
		<table>
			<tr>
				<td><a href="<?php echo base_url(); ?>biro/page_add" class="btn btn-primary pull-right">Tambah Data</a></td>
				<td><a href="<?php echo base_url(); ?>biro/page_cetak" class="btn btn-primary pull-right">Cetak</a></td>
			</tr>
    </table>
    */ ?>
  </div>
  <?php show_alert(); ?>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
								<td>No</td>
								<td>Halaman</td>
								<td>Aksi</td>
              </tr>
            </thead>
            <tbody>
						<?php 
						$no = 1;
						foreach ($pages as $page) { ?>
							<tr>
							
								<td><?php echo $no++; ?></td>
								<td><?php echo $page->page_tittle; ?></td>
								<td>
									<a class="btn btn-primary" href="<?php echo base_url(); ?>biro/page_edit/<?php echo $page->page_id; ?>">Edit</a>
									<a class="btn btn-danger btn-delete" id="<?php echo base_url().'biro/page_delete/'.$page->page_id ?>" title="Hapus Data">Hapus</a>
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

