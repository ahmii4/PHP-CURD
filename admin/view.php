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
  	<li><a href="addpage.php">Add Page</a></li>
  	<li><a href="view.php">View Page</a></li>
  	<form action="logout.php" method="post">
      <button type="submit" class="btn btn-success btn-lg" 
      style="display:block; position: absolute; margin-left: 20%; margin-top: 1%;" name="logout">Logout</button>
    </form>
  </ul>
<br><br>

<div id="Viewpages">
  <table class="table table-bordered table-striped table-dark">
    <tr>
      <th>Product Id</th>
      <th>Product Name</th>
      <th>Product Price</th>
      <th>Product Code</th>
      <th>Product In Stock</th>
      <th>Product Discount</th>
      <th>Product Size</th>
      <th>Product Detail</th>
      <th>Product Image</th>
      <th>Delete Record</th>
      <th>Edit Record</th>
    </tr>
<?php
require("../required/connectdb.php");

$query = "SELECT * FROM tblporducts";
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

<tr>
  <td><?php echo $id; ?></td>
  <td><?php echo $name; ?></td>
  <td><?php echo $price; ?></td>
  <td><?php echo $code; ?></td>
  <td><?php echo $stock; ?></td>
  <td><?php echo $discount; ?></td>
  <td><?php echo $size; ?></td>
  <td><?php echo $detail; ?></td>
  <td><img src="../assets/upload/<?php echo $image; ?>" alt="image here" width="60px" height="60px" ></td>
  <td><a href="delete.php?Deleteid=<?php echo $id; ?>">Delete</a></td>
  <td><a href="update.php?Updateid=<?php echo $id; ?>">Update</a></td>
</tr>












<?php }} ?>





  </table>
</div><!--end of viewpage-->

 
</div><!--end of dashboard-->









<?php

include("../includes/footer.php");

}
?>