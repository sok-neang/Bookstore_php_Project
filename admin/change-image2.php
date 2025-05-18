<?php
session_start();
include_once('includes/config.php');

if (strlen($_SESSION["aid"]) == 0) {
    header('location:logout.php');
} else {
    // For Updating Product Image 2
    if (isset($_POST['submit'])) {
        $currentimage = $_POST['currentimage'];
        $imagepath = "productimages/" . $currentimage;

        $productimage2 = $_FILES["productimage2"]["name"];
        $extension = substr($productimage2, strlen($productimage2) - 4);

        // Renaming the image file
        $imgnewfile = md5($productimage2 . time()) . $extension;
        move_uploaded_file($_FILES["productimage2"]["tmp_name"], "productimages/" . $imgnewfile);

        $updatedby = $_SESSION['aid'];
        $pid = intval($_GET['id']);

        $sql = mysqli_query($con, "UPDATE products SET productImage2='$imgnewfile', lastUpdatedBy='$updatedby' WHERE id='$pid'");

        unlink($imagepath);

        echo "<script>alert('Product image updated successfully');</script>";
        echo "<script>window.location.href='manage-products.php'</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Update Image</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="js/all.min.js" crossorigin="anonymous"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
</head>

<body>
    <?php include_once('includes/header.php'); ?>
    <div id="layoutSidenav">
        <?php include_once('includes/sidebar.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Update Image</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Update Image</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                            <?php
                            $pid = intval($_GET['id']);
                            $query = mysqli_query($con, "SELECT productImage2, productName FROM products WHERE id='$pid'");
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                            <form method="post" enctype="multipart/form-data">
                                <input type="hidden" name="currentimage"
                                    value="<?php echo htmlentities($row['productImage2']); ?>">

                                <div class="row mb-3">
                                    <div class="col-2">Product Name</div>
                                    <div class="col-4">
                                        <input type="text" name="productName"
                                            value="<?php echo htmlentities($row['productName']); ?>"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-2">Current Image</div>
                                    <div class="col-4">
                                        <img src="productimages/<?php echo htmlentities($row['productImage2']); ?>"
                                            width="250" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-2">New Image</div>
                                    <div class="col-4">
                                        <input type="file" name="productimage2" id="productimage2" class="form-control"
                                            accept="image/*" title="Accept images only" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-2">
                                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </main>
            <?php include_once('includes/footer.php'); ?>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>
<?php } ?>