<?php session_start(); ?>
<?php include 'header.php'; ?>
<body class="hold-transition login-page" style="background: linear-gradient(45deg,rgb(212, 212, 212),rgb(255, 255, 255));">
  <div class="login-box">
    <div class="login-logo">
      <img src="images\logo.png" alt="Company Logo" style="width: 300px; border-radius: 0%;">
      <h1 class="text-white" style="font-weight: bold;">Welcome to TrackSmart Attendance Portal</h1>


      <p id="date" class="text-white"></p>
      <p id="time" class="bold text-white"></p>
    </div>

    <div class="login-box-body" style="border-radius: 10px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2); background: white;">
      <h4 class="login-box-msg"><i class="fa fa-user"></i> Enter Employee ID</h4>
      <form id="attendance">
        <div class="form-group">
          <label><i class="fa fa-clock-o"></i> Select Status</label>
          <select class="form-control" name="status">
            <option value="in">Time In</option>
            <option value="out">Time Out</option>
          </select>
        </div>
        <div class="form-group has-feedback">
          <label><i class="fa fa-id-card"></i> Employee ID</label>
          <input type="text" class="form-control input-lg" id="employee" name="employee" required>
          <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat" name="signin">
              <i class="fa fa-sign-in"></i> Sign In
            </button>
          </div>
        </div>
      </form>
    </div>
    <div class="alert alert-success alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-check"></i> <span class="message"></span></span>
    </div>
    <div class="alert alert-danger alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-warning"></i> <span class="message"></span></span>
    </div>
  </div>
  <div class="text-center mt-4">
  <div class="text-center mt-3">
        <button onclick="window.open('admin', '_blank')" class="btn btn-dark" style="padding: 10px 20px; border-radius: 5px; font-weight: bold;">
          <i class="fa fa-cog"></i> Go to Admin Panel
        </button>
      </div>
    </div>

  <?php include 'scripts.php' ?>
  <script type="text/javascript">
    $(function() {
      var interval = setInterval(function() {
        var momentNow = moment();
        $('#date').html(momentNow.format('dddd').substring(0,3).toUpperCase() + ' - ' + momentNow.format('MMMM DD, YYYY'));
        $('#time').html(momentNow.format('hh:mm:ss A'));
      }, 100);

      $('#attendance').submit(function(e){
        e.preventDefault();
        var attendance = $(this).serialize();
        $.ajax({
          type: 'POST',
          url: 'attendance.php',
          data: attendance,
          dataType: 'json',
          success: function(response){
            if(response.error){
              $('.alert').hide();
              $('.alert-danger').show();
              $('.message').html(response.message);
            }
            else{
              $('.alert').hide();
              $('.alert-success').show();
              $('.message').html(response.message);
              $('#employee').val('');
            }
          }
        });
      });
    });
  </script>
</body>
</html>
