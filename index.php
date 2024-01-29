<?php
include 'dbconnection.php';
$link = getDbConnection(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $subscribe = isset($_POST['subscribe']) ? 'yes' : 'no';

    $stmt = mysqli_prepare($link, "INSERT INTO userdata (name, email, gender, subscribe) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'ssss', $name, $email, $gender, $subscribe);

    if (mysqli_stmt_execute($stmt)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }
}
?>



<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>Page Title</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
  <script src='main.js'></script>
</head>
<body style="display:flex;padding-left: 5px;">
  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <h1>User Registration Form</h1>
    <hr style="opacity: 50%;">
    <label>Please fill this form and submit to add user record to the database.</label><br><br>
    <label for="name" style="font-weight: bold;">Name</label><br>
    <input type="text" id="name" name="name"><br><br>
    <label for="email" style="font-weight: bold;">Email</label><br>
    <input type="text" id="email" name="email"><br><br>
    <label style="font-weight: bold;">Gender</label><br>
    <input type="radio" id="female" name="gender" value="female">
    <label for="female" style="font-weight: bold;">Female</label><br>
    <input type="radio" id="male" name="gender" value="male">
    <label for="male" style="font-weight: bold;">Male</label><br><br>
    <input type="checkbox" id="subscribe" name="subscribe" value="yes">
    <label for="subscribe">Receive E-Mails from us.</label><br><br>
    <input type="submit" value="Submit" name="submit" style="background-color: dodgerblue;border-color: dodgerblue;">
    <input type="reset" value="Cancel" name="cancel">

  </form>
  <form action="showdata.php" method="get">
        <button type="submit">Show Data</button>
  </form>
</body>
</html>