<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login System</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/front/images/icons/favicon.ico"/>   

<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/front/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/front/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/front/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/front/vendor/animate/animate.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/front/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/front/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/front/vendor/select2/select2.min.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/front/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/front/css/util.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/front/css/main.css">
<!--===============================================================================================-->
</head>
<body>
  
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100 p-t-50 p-b-90">
         <?php echo form_open('login/verify_login', array('class' => 'login100-form validate-form flex-sb flex-w')); ?>
        <form class="login100-form validate-form flex-sb flex-w">
          <span class="login100-form-title p-b-51">
            Login
          </span>
           <?php if ($this->session->flashdata('success')) { ?>
                            <div class="alert alert-success">
                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                                <strong>Sukses!</strong> <?php echo $this->session->flashdata('success');?>
                            </div>
                    <?php };?>
                    <?php 
                      if ($this->session->flashdata('error')) {?>
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                                <strong>Maaf!</strong> <?php echo $this->session->flashdata('error');?>
                            </div>
                  <?php };?>
          
          <div class="wrap-input100 validate-input m-b-16" data-validate = "Username is required">
            <input class="input100" type="text" name="username" placeholder="Username" value="<?=set_value('username');?>" required autofocus>
            <span class="focus-input100"></span>
          </div>
          
          
          <div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
            <input class="input100" type="password" name="password" placeholder="Password" value="<?=set_value('password'); ?>" required>
            <span class="focus-input100"></span>
          </div>
          
          <div class="flex-sb-m w-full p-t-3 p-b-24">
            <div class="contact100-form-checkbox">
              <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
              <label class="label-checkbox100" for="ckb1">
                Remember me
              </label>
            </div>

            <div>
              <a href="#" class="txt1">
                Forgot?
              </a>
            </div>
          </div>

          <div class="container-login100-form-btn m-t-17">
            <button class="login100-form-btn">
              Login
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>
  

  <div id="dropDownSelect1"></div>
  
<!--===============================================================================================-->
  <script href="<?php echo base_url();?>assets/front/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script href="<?php echo base_url();?>assets/front/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
  <script href="<?php echo base_url();?>assets/front/vendor/bootstrap/js/popper.js"></script>
  <script href="<?php echo base_url();?>assets/front/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script href="<?php echo base_url();?>assets/front/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script href="<?php echo base_url();?>assets/front/vendor/daterangepicker/moment.min.js"></script>
  <script href="<?php echo base_url();?>assets/front/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
  <script href="<?php echo base_url();?>assets/front/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
  <script href="<?php echo base_url();?>assets/front/js/main.js"></script>

</body>
</html>