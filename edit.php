<?php
session_start();
if(!isset($_SESSION["email"]))
{
	header("location:index.php");
}
// $email=$_SESSION["email"];
$id=$_REQUEST["id"];
include("db.php");
$qry=mysqli_query($con,"select * from login where id='$id'");
$row=mysqli_fetch_array($qry);
extract($row);
// $b=explode(",", string)
?>
<!DOCTYPE html>
<html>
<head>
	<title>User | Edit</title>
	<link rel="stylesheet" type="text/css" href="style1.css">
	<script src="jquery.js"></script>
	<script src="js1.js"></script>
	<script src="js2.js"></script>
</head>
<body>
<div class="container">
	<div class="col-xl-6">
		<form method="post" action="" enctype="multipart/form-data">
			<div class="form-group">
				<label>Name : </label>
				<input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
			</div>
			<div class="form-group">
				<label>Image : </label>
				<input type="file" name="new_pic" class="form-control" >
				<img src="img/<?php echo $pic; ?>" style="width: 150px; height: 150px;">
				<input type="hidden" name="old_pic" value="<?php echo $pic; ?>">
			</div>
			<input type="submit" name="update" value="Update" class="btn btn-success">
		</form>
	</div>
</div>
<?php
if(isset($_POST["update"]))
{
	$name=$_POST["name"];
	//agar file choose nahi karne par
	if(empty($_FILES["new_pic"]["name"]))
	{
		$old_pic=$_POST["old_pic"];
		$qry=mysqli_query($con,"update login set name='$name',pic='$old_pic' where id='$id'");
		header("location:profile.php");
	}
	else //file choose karene ke bad
	{
		$new_pic=$_FILES["new_pic"]["tmp_name"];
		$destination="img/".$_FILES["new_pic"]["name"];
		if(move_uploaded_file($new_pic, $destination))
		{
			$new_pic=$_FILES["new_pic"]["name"];
		}
		$qry1=mysqli_query($con,"update login set name='$name', pic='$new_pic' where id='$id'");
		header("location:profile.php");
	}
}
?>
</body>
</html>