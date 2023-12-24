<?PHP
    session_start();

    if(isset($_POST['sign_in']))
    {
        echo"arwa";
            if(isset($_POST['name'])){
                $name=$_POST['name'];
            }
            if(isset($_POST['email'])){
                $email=$_POST['email'];
            }
            if(isset($_POST['phone'])){
                $phone=$_POST['phone'];
            }
            if(isset($_POST['country'])){
                $country=$_POST['country'];
            }
            if(isset($_POST['city'])){
                $city=$_POST['city'];
            }
            if(isset($_POST['password'])){
                $password=$_POST['password'];
            } 
            if(isset($_POST['copassword'])){
                $copassword=$_POST['copassword'];
            } 
            if($password!=$copassword)
            {
                header("location:regestration.php?passworderror=password does not match");
                exit();
            }

        $host="localhost";
        $user="root";
        $pass="";
        $db="flower_site";
       $connect= mysqli_connect($host,$user,$pass,$db); 
       $insert= "insert into user (name,email,phone,country,city,password,confirmation_password) values ('$name','$email','$phone','$country','$city','$password','$copassword')";
        $p=mysqli_query($connect,$insert);
        header("location:login.php");

    }
      
    ?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viwport" content="with=device-width, initial-scale=1.0">
        <title>login</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="./login.css"> 
        <style>
            .error{
                color: #842029;
                background-color: #f5c2c7;
                 padding: 5px;
                 font-size: 13px;
}
        </style>
    </head>
    <body>
        <!--header section start-->
        <header>
            <a href="#" class="logo">flower<span>.</span></a>
            <nav class="navbar">
                <a href="index.php">home</a>
                <a href="index.php #about">about</a>
                <a href="index.php #produts">produts</a>
                <a href="index.php #review">review</a>
                <a href="index.php #contact">contact</a>
            </nav>
            <div class="icons">
            <?php
                  if(empty($_SESSION["login"])){
                   echo '<a href="login.php" class="fas fa-user"></a>';
                  }
                  else{
                    echo '<a href="logout.php" >logout</a>';

                  }
                  ?>
            </div>
        </header>
        <!--header section end-->
        <!--login section start-->
        <form class="head" action="account.php" method="POST"><h3>Regestration</h3></form>
        <form  method="POST">
            <br>
            <label>Name : </label>
            <br>
            <input type="text" name="name" required="" style="border-radius: 5px;">
            <br>
            <label>Email : </label>
            <br>
            <input type="email" name="email" required="" style="border-radius: 5px;">

            <br>
            <label>Phone : </label>
            <br>
            <input type="text" name="phone" required="" style="border-radius: 5px;">
            <br>
            <label>Country : </label>
            <br>
            <input type="text" name="country" required="" style="border-radius: 5px;">
            <br>
            <label>City : </label>
            <br>
            <input type="text" name="city" required="" style="border-radius: 5px;">
            <br>

            <label>Password : </label>
            <br>
            <input type="password" name="password" minlength="5" maxlength="8" required="" style="border-radius: 5px;">
            <br>
            <label>Confirm Password : </label>
            <br>
            <input type="password" name="copassword" minlength="5" maxlength="8" required="" style="border-radius: 5px;">
            <br>
            <?php
                if($_GET)
                {
                  echo '<p class="error">'.$_GET['passworderror'].'</p>';
       }
        ?>
            <p><input type="submit" name ="sign_in" value="sign in" class="btn" style="font-size: 1.3rem; font-weight: bold;"></p>
        </form>
        <!--login section end-->
    </body>
</html>