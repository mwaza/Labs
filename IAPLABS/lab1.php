<?php
  include_once 'DBConnector.php';
  include_once 'User.php';
  $con = new DBConnector;

  if (isset($_POST['btn-save'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $city = $_POST['city_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new User($first_name, $last_name, $city, $username, $password);
    if (!$user->validateForm()) {
        $user->createFormErrorSessions();
        header("Refresh:0");
        die();
    }

    $res = $user->save($con->conn);

    if ($res) {
      echo "Save operation successful!";
    } else {
      echo "An error occurred!";
    }
  }
?>
<html>
  <head>
    <title>New User</title>
    <script type="text/javascript" src="validate.js"></script>
    <link rel="stylesheet" type="text/css" href="validate.css">
  </head>
  <body>
    <form name="user_details" id="user_details" method="post" action=<?=$_SERVER['PHP_SELF'] ?> onsubmit="return validateForm()" >
        <table align="center">
            <tr>
                <div id="form-errors">
                    <?php
                        session_start();
                        if (!empty($_SESSION['form-errors'])) {
                            echo $_SESSION["form-errors"];
                            unset($_SESSION['form-errors']);
                        }
                    ?>
                </div>
            </tr>
            <tr>
                <td><input type="text" name="first_name" placeholder="First Name" required/></td>
            </tr>
            <tr>
                <td><input type="text" name="last_name" placeholder="Last Name" /></td>
            </tr>
            <tr>
                <td><input type="text" name="city_name" placeholder="City" /></td>
            </tr>
            <tr>
                <td><input type="text" name="username" placeholder="Username"></td>
            </tr>
            <tr>
                <td><input type="password" name="password" placeholder="Password"></td>
            </tr>
            <tr>
                <td><button type="submit" name="btn-save"><strong>SAVE</strong></button></td>
            </tr>
            <tr>
                <td><a href="login.php">Log In</a> </td>
            </tr>
    </table>
    </form>
  </body>
      <a href="all-records.php">Show All Records</a>


</html>
