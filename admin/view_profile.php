<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>Employee Profile</h1>
    </section>

    <section class="content">
      <?php
        if(isset($_GET['id'])){
          $id = $_GET['id'];
          $sql = "SELECT *, employees.id AS empid FROM employees 
                  LEFT JOIN position ON position.id = employees.position_id 
                  LEFT JOIN schedules ON schedules.id = employees.schedule_id 
                  WHERE employees.id = '$id'";
          $query = $conn->query($sql);
          if($query->num_rows > 0){
            $row = $query->fetch_assoc();
          } else {
            $_SESSION['error'] = 'Employee not found';
            header('location: employee_list.php');
            exit();
          }
        } else {
          $_SESSION['error'] = 'No Employee Selected';
          header('location: employee_list.php');
          exit();
        }
      ?>

      <div class="box box-primary">
        <div class="box-body">
          <div class="row">
            <div class="col-md-4 text-center">
              <img src="<?php echo (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg'; ?>" class="img-responsive img-circle" width="150">
              <h3><?php echo $row['firstname'].' '.$row['lastname']; ?></h3>
            </div>
            <div class="col-md-8">
              <table class="table table-bordered">
                <tr>
                  <th>Employee ID:</th>
                  <td><?php echo $row['employee_id']; ?></td>
                </tr>
                <tr>
                  <th>Full Name:</th>
                  <td><?php echo $row['firstname'].' '.$row['lastname']; ?></td>
                </tr>
                <tr>
                  <th>Position:</th>
                  <td><?php echo $row['description']; ?></td>
                </tr>
                <tr>
                  <th>Schedule:</th>
                  <td><?php echo date('h:i A', strtotime($row['time_in'])).' - '.date('h:i A', strtotime($row['time_out'])); ?></td>
                </tr>
                <tr>
                  <th>Contact Info:</th>
                  <td><?php echo $row['contact_info']; ?></td>
                </tr>
                <tr>
                  <th>Address:</th>
                  <td><?php echo $row['address']; ?></td>
                </tr>
                <tr>
                  <th>Birthdate:</th>
                  <td><?php echo date('M d, Y', strtotime($row['birthdate'])); ?></td>
                </tr>
                <tr>
                  <th>Gender:</th>
                  <td><?php echo $row['gender']; ?></td>
                </tr>
                <tr>
                  <th>Member Since:</th>
                  <td><?php echo date('M d, Y', strtotime($row['created_on'])); ?></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>

      <a href="employee_list.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</a>

    </section>
  </div>

  <?php include 'includes/footer.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
</body>
</html>
