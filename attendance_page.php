<?php
session_start();
include 'conn.php';

if (!isset($_SESSION['emp_id'])) {
    header('Location: employee_login.php');
    exit();
}

$employee_id = $_SESSION['emp_id'];

// Fetch employee details
$sql = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
$query = $conn->query($sql);
if ($query->num_rows < 1) {
    echo 'Employee not found';
    exit();
}
$employee = $query->fetch_assoc();

// Fetch attendance history
$sql = "SELECT * FROM attendance WHERE employee_id = '$employee_id' ORDER BY date DESC";
$history_query = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Attendance</title>
    <?php include 'header.php'; ?>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <p id="date"></p>
            <p id="time" class="bold"></p>
        </div>

        <div class="login-box-body">
            <h4 class="login-box-msg">Welcome, <?php echo $employee['firstname'] . ' ' . $employee['lastname']; ?> (ID: <?php echo $employee_id; ?>)</h4>

            <!-- Logout Button -->
            <div style="text-align: right;">
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>

            <!-- Attendance Form -->
            <form id="attendanceForm">
                <div class="form-group">
                    <select class="form-control" name="status">
                        <option value="in">Time In</option>
                        <option value="out">Time Out</option>
                    </select>
                </div>
                <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">

                <div class="row">
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-sign-in"></i> Submit</button>
                    </div>
                </div>
            </form>

            <div id="responseMessage"></div>

            <!-- Attendance History -->
            <h4 class="text-center mt-4">Attendance History</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Time In</th>
                        <th>Time Out</th>
                        <th>Hours Worked</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $history_query->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['date']; ?></td>
                            <td><?php echo $row['time_in'] ?? 'N/A'; ?></td>
                            <td><?php echo $row['time_out'] ?? 'N/A'; ?></td>
                            <td><?php echo $row['num_hr'] ?? 'N/A'; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include 'scripts.php'; ?>

    <script type="text/javascript">
    $(function() {
        var interval = setInterval(function() {
            var momentNow = moment();
            $('#date').html(momentNow.format('dddd').substring(0,3).toUpperCase() + ' - ' + momentNow.format('MMMM DD, YYYY'));
            $('#time').html(momentNow.format('hh:mm:ss A'));
        }, 100);

        $('#attendanceForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'attendance.php',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if(response.error) {
                        $('#responseMessage').html('<p style="color:red">' + response.message + '</p>');
                    } else {
                        $('#responseMessage').html('<p style="color:green">' + response.message + '</p>');
                        location.reload(); // Refresh page to update history
                    }
                }
            });
        });
    });
    </script>
</body>
</html>
