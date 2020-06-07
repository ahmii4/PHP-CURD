
<?php

include("includes/header.php");


?>





<div id="homeBackImage">
	<div class="container">
		<h1 style="text-align: center;">Our Proudcts</h1>
		<div class="row">
<?php    
require("required/connectdb.php");



$query = "SELECT * FROM tblporducts";

$result = mysqli_query($connect,$query);

$total = mysqli_num_rows($result);

if($total>0){

  while($row = mysqli_fetch_assoc($result)){
    $id = $row['productId'];
    $name = $row['productName'];
    $detail = $row['productDetails'];
    $image = $row['pimage'];
?>

      <div  class="col-md-4" style="background: white; color: black; border-right: 3px solid grey; border-radius: 5px;">
        <a href="product_detail.php?id=<?php echo $id ?>">
          <img src="assets/upload/<?php echo $image; ?>" alt="product's image" title="Click for product detail" style="height: 200px; width: 200px; margin-left: 20%; margin-top: 5%;">
        </a>
          <h3 style="text-align: center;"><?php echo $name; ?></h3>
          <p  style="text-align: center;"><?php echo $detail; ?></p>
      </div>

<?php }} ?>
</div>
	</div>
</div>






<?php

include("includes/footer.php");


?>