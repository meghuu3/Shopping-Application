<?php 
    session_start();
    $conn = mysqli_connect('localhost','root','','webusers');

    if(!$conn)
    {
        die("<script>alert('Connection is not established')</script>");
    }
?>