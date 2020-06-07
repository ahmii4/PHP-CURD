<?php
session_start();
if(isset($_SESSION['username'])===false){
  header("location: index.php");
  exit();
  die();
}
else{
require("../required/connectdb.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title>ahmad's Web</title>
  <link rel="stylesheet" type="text/css" href="../assets/css/index.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../assets/fontawesome/css/all.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

<header>
  


    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-fixed-top">
  <a class="navbar-brand" href="index.php"><img src="../assets/images/logo.png" style="height: 30px; width: 30px"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="../index.php">Home</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="../about.php">About Us</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="../product.php">Product</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="../product_detail.php">Product_detail </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="../contact_us.php">Contact Us </a>
      </li>

    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
  
</header>






<div id="dashboard" style="text-align: center;">
  <h2>Welcome Admin: <?php echo $_SESSION['username']; ?></h2>
  <br>
  <ul class="adminlist">
  	<li><a href="welcome.php">Add Page</a></li>
  	<li><a href="view.php">View Page</a></li>
    <form action="logout.php" method="post">
      <button type="submit" class="btn btn-success btn-lg" 
      style="display:block; position: absolute; margin-left: 20%; margin-top: 1%;" name="logout">Logout</button>
    </form>
  </ul>
<br><br><br>

<div id="Viewpages">
<?php
require("../required/connectdb.php");


if($_GET){

  $id = $_GET['Updateid'];


$query = "SELECT * FROM tblporducts WHERE productId='$id' ";
$result = mysqli_query($connect,$query);

$total = mysqli_num_rows($result);

if($total>0){

  while($row = mysqli_fetch_assoc($result)){
    $id = $row['productId'];
    $name = $row['productName'];
    $price = $row['productPrice'];
    $code = $row['productCode'];
    $stock = $row['productInStock'];
    $discount = $row['productDiscount'];
    $size = $row['productSizes'];
    $detail = $row['productDetails'];
    $image = $row['pimage'];
    

?>

<form action="update.php?Uid=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
            <input type="text" class="designInput inputSpecial" name="pname" placeholder="Enter product name" value="<?php echo $name; ?>" required><br><br>
            <input type="text" class="designInput inputSpecial" name="pprice" placeholder="Enter product price" value="<?php echo $price; ?>"><br><br>
            <input type="text" class="designInput inputSpecial" name="pCode" placeholder="Enter product code" value="<?php echo $code; ?>"><br><br>
            <input type="text" class="designInput inputSpecial" name="pdiscount" placeholder="Enter product Discount" value="<?php echo $discount; ?>"><br><br>
            <input type="text" class="designInput inputSpecial" name="pdetail" placeholder="Enter product Detail" value="<?php echo $detail; ?>"><br><br>
            <input type="text" class="designInput inputSpecial" name="psize" placeholder="Enter product Size" value="<?php echo $size; ?>"><br><br>
            <input type="text" class="designInput inputSpecial" name="pstock" placeholder="Enter product Stock" value="<?php echo $stock; ?>"><br><br>
            <input type="file" name="pimage" ><br><br>
            <input type="submit" class="btn btn-success" name="submit" value="Update">

<?php }}} ?>
        </form>
</div><!--end of viewpage-->
</div><!--end of dashboard-->
<?php
if(isset($_POST['submit'])){

  $pname = $_POST['pname'];
  $pprice = $_POST['pprice'];
  $pcode = $_POST['pCode'];
  $stock = $_POST['pstock'];
  $pdiscount = $_POST['pdiscount'];
  $size = $_POST['psize'];
  $pdetail = $_POST['pdetail'];
  $pimage = $_FILES['pimage']['name'];
  $updatei = $_GET['Uid'];
  $query = "UPDATE tblporducts SET productName='$pname',productPrice='$pprice', productCode='$pcode',
  productDiscount='$pdiscount', productSizes='$size', productDetails='$pdetail', pimage='$pimage'
  WHERE productId='$updatei' ";

  if(mysqli_query($connect,$query)){
    header("location: view.php");

  }
  else{
    echo "Not Updated";
  }


}



?>


<?php

include("../includes/footer.php");
}

?>