<?php
include('config.php');

error_reporting(E_ERROR | E_PARSE);

// if (isset($_SESSION['username'])) {
//     header("Location: website.php");
// }

if(isset($_POST['submit']))
{
    $username = $_POST['username'];
    $passwd = $_POST['passwd'];

    $query = "SELECT username from users where username = '$username'";
    $res1 = mysqli_query($conn,$query);
    if(!mysqli_num_rows($res1)>0)
    {
        echo "<script> alert('User is not registered') </script>";
    }
    else
    {
        $query = "SELECT * FROM USERS where username = '$username' and passwd = '$passwd'";
        $res2 = mysqli_query($conn,$query);
        if(mysqli_num_rows($res2)>0)
        {
            $row = mysqli_fetch_assoc($res2);
            $_SESSION['username'] = $row['username'];
            header("Location: website.php");
        }
        else
        {
            echo "<script> alert('Wrong Password!!') </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="signin.css">
</head>
<body>
    <div class="container">
        <div class="form">
            <span class="title">Login</span>
            <form action="" method="POST">
                <div class="input-field">
                    <input type="text" name="username" placeholder="Enter Your Username" required>
                    <i class="uil uil-user"></i>
                </div>
                <div class="input-field">
                    <input type="password" name="passwd" placeholder="Enter Your Password" required>
                    <ion-icon name="key-outline"></ion-icon>
                    <!-- <i class="uil uil-eye-slash eye"></i> -->
                </div>
                <div class="input-field btlogin">
                    <button type="submit" name="submit">Login</button>
                </div>
                <div class="last-section">
                    <div class="newuser">
                        <p>Not A User? <a href="signup.php">Register Here</a></p>
                    </div>
                    <div class="link-pwd">
                        <a href="forgotpassword.php">Forgot Password</button>
                    </div>
                </div>
                <div>
                <div class = "line"></div> 
                <div class="input-field btlogin">
                <button name="google-login"><ion-icon name="logo-google"></ion-icon>Signup with Google</button>
                </div>
                </div>
            </form>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
