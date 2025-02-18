****Profiling & Payroll Management System
****
**Overview**

This project is a Profiling & Payroll Management System that helps manage employee records, attendance, and payroll processing. It includes features such as employee registration, attendance tracking, salary calculations, and payroll generation.

**Features**

Employee Management: Add, update, and remove employee records.

Attendance Tracking: Time-in and time-out recording with Vue.js and jQuery.

Payroll Calculation: Automated payroll generation, including deductions and cash advances.

PDF Payroll Report: Generates a PDF payroll report using TCPDF.

User Authentication: Secure login and session management.

**Technologies Used**
Frontend: HTML, CSS, Bootstrap, jQuery, Vue.js

Backend: PHP, MySQL

Libraries: TCPDF for PDF generation, Moment.js for date/time handling

**Installation**

**Clone the repository:**

git clone https://github.com/srijanbea/nid.git

Move the project to your local server directory (e.g., htdocs for XAMPP).

**Import the database:
**
Locate the database.sql file.

Import it into MySQL using phpMyAdmin or CLI.

Update database credentials in includes/conn.php:

$conn = new mysqli('localhost', 'root', '', 'apsyste_db');

Start your local server (Apache & MySQL) and access the system via:

http://localhost/NID-MAIN/

**Usage**

Login as an administrator to manage employees and generate payroll reports.

Employees can view their profile and attendance records.

Admin can export payroll reports as PDFs.

**Troubleshooting**

TCPDF Error: Array and string offset access syntax with curly braces is no longer supported

Solution: If using PHP 7.4+, update tcpdf.php and replace {} with [] in string/array offsets.

**Database Connection Issues**

Solution: Check conn.php for correct database credentials and ensure MySQL is running.

License

This project is open-source. Modify and use it as needed.

**Author**

Developed by Srijan Adikari & Team.
