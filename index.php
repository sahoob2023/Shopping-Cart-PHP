<?php
include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id))
    header('location:login.php');

//logout page
if (isset($_GET['logout'])) {
    unset($user_id);
    session_destroy();
    header('location:login.php');
}

//add to cart

if (isset($_POST['add-cart'])) {
    $productname = $_POST['product-name'];
    $productprice = $_POST['product-price'];
    $productquantiy = $_POST['product-quantity'];
    $productimage = $_POST['product-image'];

    $selectcart = mysqli_query($conn, "select * from cart where name='$productname' and user_id='$user_id'") or die('query failed');

    if (mysqli_num_rows($selectcart) > 0) {
        $message[] = "Product already add to cart";
    } else {
        mysqli_query($conn, "INSERT INTO cart(user_id,name,price,image,quantity) VALUES('$user_id','$productname','$productprice','$productimage','$productquantiy')") or die('Query failed');
        $message[] = "Product add to cart";
    }
}

//update btn
if (isset($_POST['updatecart'])) {
    $updatequan = $_POST['cartquan'];
    $updateid = $_POST['cartid'];
    mysqli_query($conn, "update cart set quantity = '$updatequan' where id='$updateid'") or die("query failed");
    $message[] = "Update cart successfully";
}
//delete cart
if (isset($_GET['removeid'])) {
    $removeid1 = $_GET['removeid'];

    mysqli_query($conn, "DELETE FROM cart WHERE id = '$removeid1'") or die("query failed");
    header("Location:index.php");
}

//deleteall cart
if (isset($_GET['delete_all'])) {
    mysqli_query($conn, "DELETE FROM cart WHERE user_id = '$user_id'") or die("query failed");
    $message[] = "Delete all cart";
    header("Location:index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>

    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '<div class="newmessage" onclick="this.remove();">' . $message . '</div>';
            // header('location:login.php');
        }
    }
    ?>
    <!-- //Starting page// -->
    <div class="container">
        <div class="user-profile">
            <?php
            
            $selectuser = mysqli_query($conn, "SELECT * FROM user_form WHERE id='$user_id'");
            $fetch = mysqli_fetch_assoc($selectuser);
            if (mysqli_num_rows($selectuser)>0) {
                $fetch = mysqli_fetch_assoc($selectuser);
            };
            ?>
            <!-- usernmae:<p><?php echo $fetch['name'];?></p> -->
                <!-- <p>Username: <span><b><?php echo $fetch['password'];?></b></span></p>
                <p>Email: <span><b><?php echo $fetch['email'];?></b></span></p> -->
             
            <div class="flex">
                <a href="login.php" class="btn">Login</a>
                <a href="register.php" class="option-btn">Register</a>
                <a href="index.php?logout=<?php echo $user_id; ?> " onclick="return confirm('Are you want to sure logout');" class="delete-btn">Logout</a>

            </div>
        </div>

        <!-- //Product Details// -->
        <div class="products">
            <h1 class="heading">...Latest New Products...</h1>
            <div class="box-container">

                <?php
                $selectproduct = mysqli_query($conn, "select * from products") or die("Query failed");
                if (mysqli_num_rows($selectproduct) > 0) {
                    while ($fetchproduct = mysqli_fetch_assoc($selectproduct)) {
                ?>
                        <form action="" method="post" class="box">
                            <img src="image/<?php echo $fetchproduct['image']; ?>" alt="">
                            <div class="name"><?php echo ' Product Name is : ' . $fetchproduct['name']; ?></div>&nbsp;
                            <div class="price"><?php echo $fetchproduct['price']; ?>/-</div>

                            <input type="number" min="" name="product-quantity" value="1">
                            <input type="hidden" name="product-image" value="<?php echo $fetchproduct['image']; ?>">
                            <input type="hidden" name="product-name" value="<?php echo $fetchproduct['name']; ?>">
                            <input type="hidden" name="product-price" value="<?php echo $fetchproduct['price']; ?>">
                            <input type="submit" name="add-cart" value="Add to cart" class="btn">

                        </form>
                <?php
                    };
                };
                ?>

            </div>
        </div>

        <!-- //Shoping cart added// -->
        <div class="shopingcart">
            <h1 class="heading">ADD TO SHOPPING CART</h1>
            <table>
                <thead>
                    <th>image</th>
                    <th>name</th>
                    <th>price</th>
                    <th>quantity</th>
                    <th>totalprice</th>
                    <th>action</th>

                </thead>
                <tbody>
                    <?php
                    $grand_total = 0;
                    $cartquery = mysqli_query($conn, "select * from cart where user_id='$user_id'") or die("Query failed");
                    if (mysqli_num_rows($cartquery) > 0) {
                        while ($fetchcart = mysqli_fetch_assoc($cartquery)) {

                    ?>
                            <tr>
                                <td><img src="image/<?php echo $fetchcart['image']; ?>" height="120px" width="120px" alt=""></td>
                                <td><?php echo $fetchcart['name'] ?></td>
                                <td><?php echo $fetchcart['price'] ?></td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="cartid" value="<?php echo $fetchcart['id']; ?>">
                                        <input type="number" min="1" name="cartquan" value="<?php echo $fetchcart['quantity']; ?>">
                                        <input type="submit" name="updatecart" value="update" class="btn">
                                    </form>
                                </td>

                                <td>$<?php echo $subtotal = number_format($fetchcart['price'] * $fetchcart['quantity']); ?>/-</td>
                                <td><a href="index.php?removeid=<?php echo $fetchcart['id']; ?>" class="delete-btn" onclick="return confirm('remove item to cart');">Remove</a></td>

                            </tr>


                    <?php
                            $grand_total = $grand_total + ($fetchcart['price'] * $fetchcart['quantity']);
                            // if (is_numeric($subtotal)) {
                            //     $grand_total += $subtotal;

                            // } 
                        };
                    };
                    ?>
                    <tr class="tablebottom">
                        <td colspan="4">GrandTotal : </td>
                        <td>$<?php echo $grand_total; ?>/- </td>
                        <td><a href="index.php?delete_all" onclick="return confirm('delete all record');" class="delete-btn">Delete all</a></td>
                    </tr>
                </tbody>
            </table>

            <!-- check in -->
            <div class="cartbtn">
                <a href="#" class="btn">Checkout</a>
            </div>
        </div>


    </div>
</body>

</html>