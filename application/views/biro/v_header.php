<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="<?php echo $this->M_vic->get_option('blog_name') . ' ' . $this->M_vic->get_option('blog_description'); ?>">
  <link rel="shortcut icon" href='<?php echo base_url() ?>vic_image/system/logo.png'>
  <title><?php echo $this->M_vic->get_option('blog_name'); ?></title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/main.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/drago19.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="text/javascript" src="<?php echo base_url() . 'assets/plugin/ckeditor/ckeditor.js' ?>"></script>
  <!-- Matomo -->
  <script>
    var _paq = window._paq = window._paq || [];
    /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function() {
      var u = "https://analytics.unimal.ac.id/";
      _paq.push(['setTrackerUrl', u + 'matomo.php']);
      _paq.push(['setSiteId', '14']);
      var d = document,
        g = d.createElement('script'),
        s = d.getElementsByTagName('script')[0];
      g.async = true;
      g.src = u + 'matomo.js';
      s.parentNode.insertBefore(g, s);
    })();
  </script>
  <!-- End Matomo Code -->
</head>

<body class="app sidebar-mini rtl">
  <header class="app-header"><a class="app-header__logo" href="<?php echo base_url() . 'biro' ?>" style="font-family: times new roman">BAAKPSI</a>
    <ul class="app-nav">
      <li title="Pesan"><a class="app-nav__item" href="<?php echo base_url('biro/pesan') ?>" data-toggle="" aria-label="Show notifications"><i class="fa fa-envelope fa-lg"></i></a>
      </li>
      <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i> &nbsp; <?php echo $this->session->userdata('unama') ?></a>
        <ul class="dropdown-menu settings-menu dropdown-menu-right">
          <li><a class="dropdown-item" href="<?php echo base_url('biro/ganti_password') ?>"><i class="fa fa-key fa-lg"></i> Ganti Password</a></li>
          <li><a class="dropdown-item" href="<?php echo base_url('login/logout') ?>"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
        </ul>
      </li>
    </ul>
  </header>
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" width="20%" src="<?php echo base_url() ?>assets/Logo_Unimal.png" alt="User Image">
      <div>
        <p class="app-sidebar__user-name">BAAKPSI</p>
        <p class="app-sidebar__user-designation" style="font-size: 8pt;"><?php echo $this->M_vic->get_option('blog_description'); ?></p>
      </div>
    </div>
    <ul class="app-menu">
      <li><a class="app-menu__item" href="<?php echo base_url() . 'biro' ?>"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
      <li><a class="app-menu__item" href="<?php echo base_url('biro/pegawai') ?>"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Pegawai</span></a></li>
      <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-folder-open"></i><span class="app-menu__label">Program Studi</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a class="treeview-item" href="<?php echo base_url('biro/fakultas') ?>"><i class="icon fa fa-circle-o"></i>Fakultas</a></li>
          <li><a class="treeview-item" href="<?php echo base_url('biro/jurusan') ?>"><i class="icon fa fa-circle-o"></i>Jurusan</a></li>
        </ul>
      </li>
      <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Mahasiswa</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a class="treeview-item" href="<?php echo base_url('biro/peserta/0') ?>"><i class="icon fa fa-circle-o"></i> Mahasiswa</a></li>
          <li><a class="treeview-item" href="<?php echo base_url('biro/peserta_pesan_ver') ?>"><i class="icon fa fa-circle-o"></i> Verifikasi</a></li>
          <li><a class="treeview-item" href="<?php echo base_url('biro/peserta_cek_list') ?>"><i class="icon fa fa-circle-o"></i> Check List</a></li>
          <li><a class="treeview-item" href="<?php echo base_url('biro/aktivasi_akun') ?>"><i class="icon fa fa-circle-o"></i> Aktivasi Akun</a></li>
          <li><a class="treeview-item" href="<?php echo base_url('biro/peserta_ijazah') ?>"><i class="icon fa fa-circle-o"></i> Nomor Ijazah</a></li>
        </ul>
      </li>
      <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-graduation-cap"></i><span class="app-menu__label">WISUDA</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a class="treeview-item" href="<?php echo base_url('biro/page') ?>"><i class="icon fa fa-circle-o"></i> Setting Halaman</a></li>
          <li><a class="treeview-item" href="<?php echo base_url('biro/jadwalwisuda') ?>"><i class="icon fa fa-circle-o"></i> Jadwal</a></li>
          <li><a class="treeview-item" href="<?php echo base_url('biro/jadwalwisuda_set_edit') ?>"><i class="icon fa fa-circle-o"></i> Sesi Pendaftaran</a></li>
          <li><a class="treeview-item" href="<?php echo base_url('biro/wisuda_calon') ?>"><i class="icon fa fa-circle-o"></i> Calon Peserta</a></li>
          <li><a class="treeview-item" href="<?php echo base_url('biro/wisuda_peserta') ?>"><i class="icon fa fa-circle-o"></i> Peserta Wisuda</a></li>
          <li><a class="treeview-item" href="<?php echo base_url('biro/wisuda_ver') ?>"><i class="icon fa fa-circle-o"></i> Verifikasi</a></li>
        </ul>
      </li>
      <li><a class="app-menu__item" href="<?php echo base_url('biro/laporan') ?>"><i class="app-menu__icon fa fa-info"></i><span class="app-menu__label">Laporan</span></a></li>
    </ul>
  </aside>