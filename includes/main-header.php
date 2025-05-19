<?php 

 if(isset($_Get['action'])){
		if(!empty($_SESSION['cart'])){
		foreach($_POST['quantity'] as $key => $val){
			if($val==0){
				unset($_SESSION['cart'][$key]);
			}else{
				$_SESSION['cart'][$key]['quantity']=$val;
			}
		}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/red.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css">
    <link href="assets/css/lightbox.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/rateit.css">
    <link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

    <link rel="stylesheet" href="assets/css/config.css">

    <link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
    <link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
    <link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
    <link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
    <link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>

    <link rel="shortcut icon" href="assets/img/Neang-logo.png" type="image/x-icon">
</head>


</html>
<div class="main-header">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                <div class="logo">
                    <a href="index.php">

                        <img src="img/Neang-logo.png" width="100" alt=" LOGO">

                    </a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 top-search-holder">
                <div class="search-area">
                    <form name="search" method="post" action="search-result.php">
                        <div class="control-group">

                            <input class="search-field" placeholder="Search here..." name="product"
                                required="required" />

                            <button class="search-button" type="submit" name="search"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>

                        </div>
                    </form>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-3 animate-dropdown top-cart-row">
                <?php
if(!empty($_SESSION['cart'])){
	?>
                <div class="dropdown dropdown-cart">
                    <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                        <div class="items-cart-inner">
                            <div class="total-price-basket">
                                <span class="lbl">cart -</span>
                                <span class="total-price">
                                    <span class="sign">Rs.</span>
                                    <span class="value"><?php echo $_SESSION['tp']; ?></span>
                                </span>
                            </div>
                            <div class="basket">
                                <i class="glyphicon glyphicon-shopping-cart"></i>
                            </div>
                            <div class="basket-item-count"><span class="count"><?php echo $_SESSION['qnty'];?></span>
                            </div>

                        </div>
                    </a>
                    <ul class="dropdown-menu">

                        <?php
    $sql = "SELECT * FROM products WHERE id IN(";
			foreach($_SESSION['cart'] as $id => $value){
			$sql .=$id. ",";
			}
			$sql=substr($sql,0,-1) . ") ORDER BY id ASC";
			$query = mysqli_query($con,$sql);
			$totalprice=0;
			$totalqunty=0;
			if(!empty($query)){
			while($row = mysqli_fetch_array($query)){
				$quantity=$_SESSION['cart'][$row['id']]['quantity'];
				$subtotal= $_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge'];
				$totalprice += $subtotal;
				$_SESSION['qnty']=$totalqunty+=$quantity;

	?>


                        <li>
                            <div class="cart-item product-summary">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="image">
                                            <a href="product-details.php?pid=<?php echo $row['id'];?>"><img
                                                    src="admin/productimages/<?php echo $row['id'];?>/<?php echo $row['productImage1'];?>"
                                                    width="35" height="50" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">

                                        <h3 class="name"><a
                                                href="product-details.php?pid=<?php echo $row['id'];?>"><?php echo $row['productName']; ?></a>
                                        </h3>
                                        <div class="price">
                                            Rs.<?php echo ($row['productPrice']+$row['shippingCharge']); ?>*<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <?php } }?>
                            <div class="clearfix"></div>
                            <hr>

                            <div class="clearfix cart-total">
                                <div class="pull-right">

                                    <span class="text">Total :</span><span
                                        class='price'>Rs.<?php echo $_SESSION['tp']="$totalprice". ".00"; ?></span>

                                </div>

                                <div class="clearfix"></div>

                                <a href="my-cart.php" class="btn btn-upper btn-primary btn-block m-t-20">My Cart</a>
                            </div>


                        </li>
                    </ul>
                    <?php } else { ?>
                    <div class="dropdown dropdown-cart">
                        <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                            <div class="items-cart-inner">
                                <div class="total-price-basket">
                                    <span class="lbl">cart -</span>
                                    <span class="total-price">
                                        <span class="sign">Rs.</span>
                                        <span class="value">00.00</span>
                                    </span>
                                </div>
                                <div class="basket">
                                    <i class="glyphicon glyphicon-shopping-cart"></i>
                                </div>
                                <div class="basket-item-count"><span class="count">0</span></div>

                            </div>
                        </a>
                        <ul class="dropdown-menu">




                            <li>
                                <div class="cart-item product-summary">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            Your Shopping Cart is Empty.
                                        </div>


                                    </div>
                                </div>


                                <hr>

                                <div class="clearfix cart-total">

                                    <div class="clearfix"></div>

                                    <a href="index.php" class="btn btn-upper btn-primary btn-block m-t-20">Continue
                                        Shooping</a>
                                </div>
                            </li>
                        </ul>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>