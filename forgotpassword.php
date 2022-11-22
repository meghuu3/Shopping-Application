<?php
    include ('config.php');
    include('smsapi.php');
     
	$sender = 'TXTLCL';
    $otp = mt_rand(10000,1000000);
    $temp = $otp;
    if(isset($_POST['getotp']))
    {
        $username = $_POST['username'];
        $query = "SELECT phone FROM USERS WHERE username = '$username'";
        $result = mysqli_query($conn,$query);
        foreach($result as $row)
        {
            $phnumber = $row['phone'];
        }
        if(mysqli_num_rows($result)>0)
        {
            echo "<script> alert('OTP will be sent to $phnumber') </script>";
            $message = "Hi there, thank you for sending your first test message from Textlocal. Get 20% off today with our code: .";
            $response = $Textlocal->sendSms(array($phnumber), $message, $sender);
        }
        else
        {
            echo "<script> alert('USER is not registered Please Register')</script>";
            $_POST['username'] = $username;
         }
    }

    if(isset($_POST['verotp']))
    {
        $enteredotp = $_POST['otp'];
        if($enteredotp == $otp)
        {
            echo "<script>alert('OTP is validated Please Enter your new password')</script>";
        }
        else
        {
            echo "<script> alert('OTP Mismatch') </script>";
        }
    }

    if(isset($_POST['submit']))
    {
        $pwd = $_POST['newpwd'];
        $cnfpwd = $_POST['cnfnewpwd'];
         if($pwd == $cnfpwd)
         {
            $query="";
            echo "<script> alert('Password Has Successully Changed') </script>";
         }
         else
         {
            echo "<script> alert('Password Mismatch') </script>";
         }
    }

    if(isset($_POST['reg']))
    {
        header('location: signup.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="forgotpassword.css">
    <title>Reset Password</title>
</head>
<body>
    <div class="container">
        <div class="form">
            <form method="POST" class="">
                <div class = 'title'>
                    <span>Forgot Password</span>
                </div>
                <div class = 'input-field'>
                    <input type="text" name="username" placeholder="Enter The Username">
                    <i class="uil uil-user"></i>
                </div>
                <div class='input-field button'>
                    <button type="submit" name="getotp">Get OTP </button>
                </div>
                <div class='input-field'>
                    <input type="text"  name="otp" placeholder="Enter The OTP">
                    <i class="uil uil-message"></i>
                </div>
                <div class='input-field button'>
                    <button type="submit" name="verotp">Verify OTP </button>
                </div>
                <div class = 'input-field'>
                    <input type="password" name="newpwd" placeholder = "Enter New Password">
                    <i class="uil uil-key-skeleton"></i>
                </div>
                <div class='input-field'>
                    <input type="password" name="cnfnewpwd" placeholder="Confirm New Password">
                    <i class="uil uil-check"></i>
                </div>
                <div class='input-field button'>
                    <button type="submit" name="submit">Submit</button>
                </div>
                <div class='input-field button'>
                    <button type="submit" name="reg">Register</button>
                </div>

            </form>
        </div>
    </div>
</body>
</html>