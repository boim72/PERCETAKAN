
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/login-form/fonts/icomoon/style.css">

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/login-form/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/login-form/css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/login-form/css/style.css">

    <title>Percetakan OMAHAN</title>
  </head>
  <body>
  

  
  <div class="content">
    <div class="container" id="loginContainer">
      <div class="row">
        <div class="col-md-6 order-md-2">
          <img src="<?php echo base_url() ?>assets/login-form/images/undraw_file_sync_ot38.svg" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h3>Sign In to <strong>Percetakan</strong></h3>
              <p class="mb-4">Melayani Sepenuh Hati</p>
            </div>
            <form action="#" method="post">

              <div class="form-group first">
              <?php
                echo form_open('auth/login', array('style' => 'text-align:center;'));
                ?>
                <?php $error = $this->session->flashdata('message_name');
                ?>
                <p align="center" style="color:red;"><?php echo $error; ?></p>
                <label for="username">Username</label>
                <input class="form-control" name="username" id="username" type="text" autofocus>

              </div>
              <div class="form-group last mb-4">
                <label for="password">Password</label>
                
                <input name="password"  class="form-control" id="password" type="password" >
              </div>
              <button type="submit" name="submit"  class="btn text-white btn-block btn-primary">Login</button>
              <span class="d-block text-center my-4 text-muted"> Belum Punya akun ? <a href="<?= base_url(); ?>Auth/Register">Register</a></span>
              
             
            </form>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>

  
    <script src="<?php echo base_url() ?>assets/login-form/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/login-form/js/popper.min.js"></script>
    <script src="<?php echo base_url() ?>assets/login-form/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/login-form/js/main.js"></script>
  </body>
</html>