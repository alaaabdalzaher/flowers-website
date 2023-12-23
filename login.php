<?PHP
    session_start();

    if(isset($_POST['login']))
    {
        
            if(isset($_POST['email'])){
                $email=$_POST['email'];
            }
            if(isset($_POST['password'])){
                $password=$_POST['password'];
            } 
           

        $host="localhost";
        $user="root";
        $pass="";
        $db="flower_site";
       $connect= mysqli_connect($host,$user,$pass,$db); 
       $insert= "select * from user where email='$email' AND password='$password'";
        $p=mysqli_query($connect,$insert);

        $row = mysqli_fetch_assoc($p);
        if($row){
            $_SESSION['userId'] = $row['id'];
            $_SESSION['login']=true;
            header("location:index.php");
        }
        else {
            header("location:login.php?error=invalid email or password");
            exit();

        }

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
        <link rel="stylesheet" href="login.css"> 
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
        <form class="head" ><h3>User Login</h3></form>
        <form  method="POST">
        <?php
                if($_GET)
                {
                  echo '<p class="error">'.$_GET['error'].'</p>';
       }
        ?>    
            <br>
            <label>email : </label>
            <br>
            <input type="text" name="email" id="email" required="" style="border-radius: 5px;">
            <br>
            <label>Password : </label>
            <br>
            <input type="password" name="password" minlength="5" maxlength="8" required="" style="border-radius: 5px;">
            <p><input type="submit" id="login" name="login" value="login" class="btn" style="font-size: 1.3rem; font-weight: bold;"></p>
            <a class="reg" href="regestration.php">I Don't Have Account</a>
        </form>
        <!--login section end-->
    </body>
</html>