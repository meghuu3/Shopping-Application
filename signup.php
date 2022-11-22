<?php
  include ('config.php');
  
  error_reporting(E_ERROR | E_PARSE);
//   if (isset($_SESSION['username'])) {
//     header("Location: website.php");
// }

  if(isset($_POST['submit']))
  {
    $username = $_POST['username'];
    $usermail = $_POST['email'];
    $password = $_POST['password'];
    $cnfpassword = $_POST['cnfpwd'];
    $phonenumber = $_POST['phno'];

    if($password == $cnfpassword)
    {
      $query = "SELECT * FROM users where username = '$username'";
      $query2 = "SELECT * FROM users where mail = '$usermail'";
      $query3 = "SELECT * FROM users where phone = '$phonenumber'";
      $result = mysqli_query($conn,$query);
      $result2 = mysqli_query($conn,$query2);
      $result3 = mysqli_query($conn,$query3);
      $emailpattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
      $phonepattern = "/^[0-9]{10}+$/";
      if(preg_match($emailpattern,$usermail) == 0)
      {
        echo "<script>alert('Please Enter The Mail in Correcct Format')</script>";
      }
  
      else if(preg_match($phonepattern,$phonenumber) == 0)
      {
        echo "<script>alert('Please Enter the Valid Phone Number')</script>";
      }

      else if(mysqli_num_rows($result)>0)
      {
        echo "<script> alert('Username is already taken!! Please Choose another username') </script>";

      }

      else if(mysqli_num_rows($result2)>0)
      {
        echo "<script> alert('Email is already registered !!')</script>";
      }

      else
      {
        $insertquery = "INSERT INTO users (username,mail,passwd,phone) 
        VALUES ('$username','$usermail','$password','$phonenumber')";
        $res = mysqli_query($conn,$insertquery);

        if($res)
        {
          echo "<script> alert('Wow! User Registration Completed.') </script>";
          $username = "";
          $useremail = "";
          $_POST['password'] = "";
          $_POST['cnfpwd'] = "";
          $_POST['phno'] = "";
        }

        else 
        {
          echo "<script> alert('OOPS!! Something Went Wrong') </script>";

        }

      }
    }

    else
    {
      echo "<script> alert('Password is not matching') </script>";
    }

  }
?>

<?php
// include('config.php');
// if(isset($_GET["code"]))
//    {
//     $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

//     if(!isset($token['error']))
//     {
//       $google_client->setAccessToken('access_token');
//       $_SESSION['access_token'] = $token['access_token'];
      
//       $google_service = new Google\Service\Oauth2($google_client);
//       $data = $google_service->userInfo->get();
//       print_r($data);
//       $_SESSION['user_email_address'] = $data['email'];
//       $_SESSION['username'] = $data['given_name'];
//       $_SESSION['user_image'] = $data['picture'];
      
//     }
//    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Page</title> 
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
  <link rel="stylesheet" href="signupp.css">
</head>
<body>
  <div class = "container">
    <div class="form">
      <span class="title"> Register</span>
      <form action="" method="POST">
        <div class="input-field">
          <input type="text" name="username" placeholder="Enter Username"  />
          <i class="uil uil-user"></i>
        </div>
        <div class="input-field">
          <input type="text" name="email" placeholder="Enter Mail Id"  />
          <i class="uil uil-at"></i>
        </div>
        <div class="input-field">
          <input type="password" name="password" placeholder="Enter Password"  />
          <ion-icon name="key-outline"></ion-icon>
        </div>
        <div class="input-field">
          <input type="password" name="cnfpwd" placeholder="Confirm Password"  />
          <i class="uil uil-check"></i>
        </div>
        <div class="input-field">
          <input type="text" name="phno" placeholder="Enter Phone Number With Country Code"  />
          <i class="uil uil-phone"></i>
        </div>
        
        <div class="input-field btsignup">
          <button name="submit">Register</button>
        </div>
        <p>Have an Account? <a href="signin.php">Login Here</a></p>
      </div>
      <div class="input-field btsignup">
                <button name="google-signup"><ion-icon name="logo-google"></ion-icon>Signup with Google</button>
                </div>
      </form>
    </div>
  </div>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>