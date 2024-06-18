<?php
include 'config.php';
if (isset($_POST['sbt'])) {
    $name = $_POST['name1'];
    $email = $_POST['email1'];
    $password = $_POST['password1'];
    $conpassword = $_POST['conpass1'];
    
    $query = "select * from user_form where email='$email' and password='$password'";
    $result = mysqli_query($conn, $query) or die("connection failed");
    if($password == $conpassword){

    if (mysqli_num_rows($result) > 0) {
        $message[] = 'user alerady exists';
    } else {
        mysqli_query($conn, "insert into user_form(name,email,password)values('$name','$email','$password')") or die("query failed");
        $message[] = 'register successfully';
    }
}else{
    echo  "<script>alert('not found');</script>";;
}
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CSS Only</title>
    <link rel="stylesheet" href="style.css">
</head>

<body> 

    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '<div class="message" onclick="this.remove();">' . $message . '</div>';
            header('location:login.php');
        }
    }
    ?>

    <section>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>

        <div class="signin">
            <div class="content">
                <form action="" method="post">
                    <h2>REGISTER NOW</h2>
                    <div class="form">
                        <div class="inputBox">
                            <input type="text" name="name1" required> <i>Username</i>
                        </div>
                        <div class="inputBox">
                            <input type="email" name="email1" required> <i>Email</i>
                        </div>
                        <div class="inputBox">
                            <input type="password" name="password1" required> <i>Password</i>
                        </div>
                        <div class="inputBox">
                            <input type="password" name="conpass1" required> <i>Confirn Password</i>
                        </div>
                        <div class="links">
                            <p>Already Account</p> <a href="#">LoginNow</a>
                        </div>
                        <div class="inputBox">
                            <input type="submit" name="sbt" value="RegisterIn!">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>  
</body>
</html>