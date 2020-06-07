





<?php

$connect = mysqli_connect("localhost","root","","ahmad");

if(!$connect){
	echo "<script>alert('The database cannot be connected')</script>";
}
?>