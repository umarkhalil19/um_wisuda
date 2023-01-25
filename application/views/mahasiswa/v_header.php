<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="description" content="<?php echo $this->M_vic->get_option('blog_name').' '.$this->M_vic->get_option('blog_description'); ?>">
  <link rel="shortcut icon" href='<?php echo base_url()?>vic_image/system/logo.png'>
  <title><?php echo $this->M_vic->get_option('blog_name'); ?></title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/main.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/drago19.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="text/javascript" src="<?php echo base_url().'assets/plugin/ckeditor/ckeditor.js' ?>"></script>
</head>
<body class="app sidebar-mini rtl">
<?php
  $db = $this->M_vic->panggil_db();
  $id = $this->session->userdata('uid');
  $pes = mysqli_query($db, "SELECT * FROM tbl_pesan WHERE tp_mahasiswa = '$id' AND (tp_status_baca = '' OR tp_status_baca = 'Belum Dibaca') AND h_pengguna !='$id'");
  $jml = mysqli_num_rows($pes);
  $tgl = date_create('Y-m-d');
  $fa = 'fa fa-bell-o fa-lg';
  if($jml > 0){ $fa = 'fa fa-bell fa-lg';
  }else{ $fa = 'fa fa-bell-o fa-lg'; }
?>

  <!-- Navbar-->
  <header class="app-header"><a class="app-header__logo" href="<?php echo base_url().'mahasiswa' ?>" style="font-family: times new roman">UNIMAL</a>
    <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <ul class="app-nav">
      <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="<?php echo $fa; ?>"></i></a>
        <ul class="app-notification dropdown-menu dropdown-menu-right">
          <?php 
          echo '<li class="app-notification__title">Anda memiliki '.$jml.' Pesan baru.</li>';
          echo '<div class="app-notification__content">';
          while ($p = mysqli_fetch_array($pes)) {
          echo '<li><a class="app-notification__item" href="'.base_url('mahasiswa/pesan_tampil/'.$p['tp_kode']).'"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>';
          echo '<div>';
            echo '<p class="app-notification__message">'.$p['tp_admin'].' mengirim pesan</p>';
            echo '<p class="app-notification__meta">Pada '.$p['h_tanggal'].' Jam '.$p['h_waktu'].'</p>';
          }
          echo '</div></a>';
          echo '</li>';
          echo '</div>';
          echo '<li class="app-notification__footer"><a href="'.base_url().'mahasiswa/pesan">Lihat semua.</a></li>'; 
          ?>
        </ul>
        
      </li>
      <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i> &nbsp;  <?php echo $this->session->userdata('unama') ?></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="<?php echo base_url('login/logout') ?>"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      <!-- User Menu-->
    </ul>
  </header>
  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" width="20%" src="<?php echo base_url() ?>assets/Logo_Unimal.png" alt="User Image">
      <div>
        <p class="app-sidebar__user-name">UNIVERSITAS</p>
        <p class="app-sidebar__user-designation">MALIKUSSALEH</p>
      </div>
    </div>
    <ul class="app-menu">
      <li><a class="app-menu__item" href="<?php echo base_url().'mahasiswa' ?>"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
      <?php if ($psw == 'oke') { ?>
      <li><a class="app-menu__item" href="<?php echo base_url().'mahasiswa/biodata' ?>"><i class="app-menu__icon fa fa-pencil"></i><span class="app-menu__label">Data Diri</span></a></li>
      <li><a class="app-menu__item" href="<?php echo base_url().'mahasiswa/alur' ?>"><i class="app-menu__icon fa fa fa-check"></i><span class="app-menu__label">Proses Pengurusan</span></a></li>
      <li><a class="app-menu__item" href="<?php echo base_url().'mahasiswa/pesan' ?>"><i class="app-menu__icon fa fa-envelope"></i><span class="app-menu__label">Pesan</span></a></li>
      <?php } ?>
    </ul>
  </aside>