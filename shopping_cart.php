<?php
session_start();
if (empty($_SESSION["userId"])) {
    header("Location: login.php");
    exit();

}
$data = [];
if (isset($_COOKIE['carts'])) {
    $data = json_decode($_COOKIE['carts'], true);
}
if (isset($_POST['delete_cart'])) {

    $index = $_POST['index'];
    if (isset($_COOKIE['carts'])) {
        $data = json_decode($_COOKIE['carts'], true);
        array_splice($data, $index, 1);

        setcookie('carts', json_encode($data), time() + 3600);

    }

}



$host = "localhost";
$user = "root";
$pass = "";
$db = "flower_site";
$connect = mysqli_connect($host, $user, $pass, $db);
if (isset($_POST['add'])) {
    if (isset($_COOKIE['carts'])) {
        $data = json_decode($_COOKIE['carts'], true);
        setcookie('carts', json_encode($data), time() - 3600);
        $user_id = $_SESSION['userId'];
        foreach ($data as $row) {
            $flower_id = $row['id'];
            $insert = "insert into cart (user_id,flower_id) values ($user_id,$flower_id )";
            $p = mysqli_query($connect, $insert);
            header("location:index.php");

        }
    }

}
if (isset($_POST['cancel'])) {
    if (isset($_COOKIE['carts'])) {
        $data = json_decode($_COOKIE['carts'], true);
        setcookie('carts', json_encode($data), time() - 3600);
        header("location:index.php");

    }

}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viwport" content="with=device-width, initial-scale=1.0">
    <title>online flower shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!--header section start-->
    <header>
        <input type="checkbox" name="" id="toggler">
        <label for="toggler" class="fas fa-bars"></label>

        <a href="#" class="logo">flower<span>.</span></a>
        <nav class="navbar">
            <a href="index.php ">home</a>
            <a href="index.php #about">about</a>
            <a href="index.php #produts">produts</a>
            <a href="index.php #review">review</a>
            <a href="index.php #contact">contact</a>
        </nav>
        <div class="icons">

            <a href="#" class="fas fa-shopping-cart"></a>
            <?php
            if (empty($_SESSION["login"])) {
                echo '<a href="login.php" class="fas fa-user"></a>';
            } else {
                echo '<a href="logout.php" >logout</a>';

            }
            ?>
        </div>
    </header>
    <!--header section end-->
    <section class="cart" id="cart">
        <h1 class="heading" style="padding: 5.0rem;">Shopping Cart Data</span></h1>
        <div class="box-container" style=' display: flex; flex-wrap: wrap; gap:1.5rem;'>
            <?php
            for ($i = 0; $i < count($data); $i++) 
            {
                echo "
                    <div class='box' style='flex:1 1 40rem ;
                        box-shadow: 0 .5rem 1.5rem rgba(0, 0, 0, .1);
                        border-radius: 0.5rem;
                        border: .1rem solid rgba(0, 0, 0, 0.1);
                        position: relative;'>
                    
                    <div class='image' style='position: relative; text-align: center; padding-top: 2rem; overflow: hidden;'>

                        <img src='" . $data[$i]['image'] . "' alt='' style =' height:25rem;'>
                        <form class='icons' method='POST' >

                        <input type='text' name='flower' hidden value='" . $data[$i]['id'] . "'  >
                        <input type='text' name='type' hidden value='" . $data[$i]['type'] . "' >
                        <input type='text' name='image' hidden value='" . $data[$i]['image'] . "' >
                        <input type='text' name='cost' hidden value='" . $data[$i]['cost'] . "' >
                        <input type='text' name='index' hidden value='" . $i . "' >
                            <input type='submit' name='delete_cart' class='btn cart-btn btn-block' value='delete from cart'> 
                        </form>
                     </div>
                    
                    <div class='content' style='font-size: 2.5rem;
                    color: #333;
                    text-align: center;>
                    </div>

                    <div>
                        <h3 style ='font-size: 2.5rem;
                        color: #333;'>" . $data[$i]['type'] . "</h3>
                        <div class='price' style='font-size: 2.5rem;
                        color: var(--pink);
                        font-weight: bolder;
                        padding-top: 1rem;'>$" . $data[$i]['cost'] . "
                    </div>
                    
                    </div> ";
            }
            ?>

            <div class ='button' style='padding: text-align; text-align:center;  flex:1 1 40rem ;
                        box-shadow: 0 .5rem 1.5rem rgba(0, 0, 0, .1);
                        border-radius: 0.5rem;
                        border: .1rem solid rgba(0, 0, 0, 0.1);
                        position: relative;'>
                <form method="POST">
                    <input type='submit' name='add' class='btn cart-btn btn-block' value='submit'>
                </form>
                <form method="POST">
                    <input type='submit' name='cancel' class='btn cart-btn btn-block' value='delete all'>
                </form>
            </div>
        
        </div>
        
    </section>
</body>
</html>