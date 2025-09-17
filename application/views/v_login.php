<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href='<?php echo base_url() ?>vic_image/system/logo.png'>
  <link rel="stylesheet" type="text/css" href="assets/css/main.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
  <title>Login - Wisuda</title>
</head>

<body>
  <section class="material-half-bg">
    <div class="cover"></div>
  </section>
  <section class="login-content">
    <?php show_alert(); ?>
    <div class="logo" align="center">
      <h1 align="center" style="font-family: times new roman; font-size: 26pt;">Pendaftaran Wisuda Universitas Malikussaleh</h1> <label class="alert-success" style="text-align:center"><?php echo $this->session->flashdata('msgoke'); ?></label> <label class="alert-danger" style="text-align:center;font-family: times new roman; "><?php echo $this->session->flashdata('msgsesi'); ?></label>
    </div>
    <table width="50%">
      <tr>
        <td width="70%">
          <div class="login-box">
            <form class="login-form" action="<?php echo base_url() . 'login/cek' ?>" method="post" style="padding-top: 5px;">
              <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>LOGIN</h3>
              <label class="alert-danger"><?php echo $this->session->flashdata('msg'); ?></label>
              <div class="form-group">
                <label class="control-label">USERNAME</label>
                <input class="form-control" type="text" placeholder="username" name="username" autofocus autocomplete="off">
              </div>
              <div class="form-group">
                <label class="control-label">PASSWORD</label>
                <input class="form-control" type="password" placeholder="Password" name="password">
              </div>
              <div class="form-group">
                <?php echo $captcha['image']; ?>
                <?php if (form_error('userCaptcha') != "") {
                  echo "<div class='alert alert-error'>" . form_error('userCaptcha') . "</div>";
                } ?>
              </div>
              <div class="form-group">
                <input class="form-control" type="number" autocomplete="off" name="userCaptcha" placeholder="Masukkan angka diatas .." value="<?php if (!empty($userCaptcha)) {
                                                                                                                                                echo $userCaptcha;
                                                                                                                                              } ?>" />
              </div>
              <div class="form-group btn-container">
                <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
              </div>
            </form>
          </div>
        </td>
        <td width="30%" valign="top" style="padding-top: 5px;" class="alert alert-danger">
          <table>
            <tr>
              <td>
                Username dan Password Pendaftaran Wisuda<br>
                sama dengan <br>
                Username dan Password Pengurusan Ijazah<br>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

  </section>

  <script src="assets/js/jquery-3.2.1.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/main.js"></script>

  <script src="assets/js/plugins/pace.min.js"></script>
  <script type="text/javascript">
    $('.login-content [data-toggle="flip"]').click(function() {
      $('.login-box').toggleClass('flipped');
      return false;
    });
  </script>
</body>

</html>