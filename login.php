<?php
    include "koneksi.php";
    session_start();


    if(isset($_POST['submit'])){
        $user = mysqli_escape_string($conn,$_POST['user']);
        $password = mysqli_escape_string($conn,$_POST['password']);

        $cek = mysqli_query($conn,"SELECT * FROM tb_admin WHERE username='".$user."' AND password ='".MD5($password)."'");
        if(mysqli_num_rows($cek) > 0){
            $d = mysqli_fetch_object($cek);
            $_SESSION['status_login'] = true;
            $_SESSION['a_global'] = $d;
            $_SESSION['a_id'] = $d->admin_id;
            echo '<script>window.location="dashboard.php"</script>';
        }else {
            echo '<script>alert("Username atau password anda salah!")</script>';
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Warungradu</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
</head>
<body id="bg-login">
    <div class="box-login">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <input type="text" name="user" placeholder="Username" class="input-control">
            <input type="password" name="password" placeholder="Password" class="input-control">
            <input type="submit" name="submit" value="Login" class="btn"> <br>
        </form>
    </div>
</body>
</html>