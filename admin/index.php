<?php
  session_start();
  if(isset($_SESSION['admin'])){
    header('location:home.php');
  }
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition login-page" style="background: linear-gradient(135deg, #667eea, #764ba2);">
<div class="login-box" style="border-radius: 10px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3); background: white; padding: 20px;">
   <div class="login-logo">
   <img src="https://w7.pngwing.com/pngs/473/130/png-transparent-payroll-business-human-resource-logo-sales-business-text-service-people-thumbnail.png" style="width: 300px; border-radius: 0%;">
      <b style="color: #333; font-size: 24px;">Admin Login</b>
   </div>
  
   <div class="login-box-body">
      <p class="login-box-msg" style="font-size: 16px; color: #555;">Sign in to start your session</p>

      <form action="login.php" method="POST">
        <div class="form-group has-feedback">
          <input type="text" class="form-control input-lg" name="username" placeholder="Username" required autofocus style="border-radius: 5px;">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control input-lg" name="password" placeholder="Password" required style="border-radius: 5px;">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-12 text-center">
            <button type="submit" class="btn btn-primary btn-block btn-lg" name="login" style="border-radius: 5px; font-size: 18px; font-weight: bold; background: #4CAF50; border: none; padding: 10px;">
              <i class="fa fa-sign-in"></i> Sign In
            </button>
          </div>
        </div>
      </form>
   </div>
   <?php
      if(isset($_SESSION['error'])){
        echo "
          <div class='callout callout-danger text-center mt20' style='color: red; font-weight: bold;'>
            <p>".$_SESSION['error']."</p> 
          </div>
        ";
        unset($_SESSION['error']);
      }
   ?>
</div>
  
<?php include 'includes/scripts.php' ?>
</body>
</html>
