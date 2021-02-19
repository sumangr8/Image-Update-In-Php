<?php
include("db.php");
// echo "<pre>";
// print_r($_SERVER);
// die();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style1.css">
	<script src="jquery.js"></script>
	<script src="js1.js"></script>
	<script src="js2.js"></script>
</head>
<body>
<div class="container">
	<div style="float: left; width: 40%;">
			<form method="post" action="" enctype="multipart/form-data">
				<div class="form-group">
					<label>Name : </label>
					<input type="text" name="name" class="form-control">
				</div>
				<!-- <div class="form-group">
					<label>Email : </label>
					<input type="text" name="email" class="form-control">
				</div>
				<div class="form-group">
					<label>Password : </label>
					<input type="text" name="password" class="form-control">
				</div>
				<div class="form-group">
					<label>Gender : </label>
					<input type="radio" name="gender" class="form-control-inline" value="Male">Male
					<input type="radio" name="gender" class="form-control-inline" value="Female">Female
				</div>
				<div class="form-group">
					<label>Qualification : </label>
					<input type="checkbox" name="qualification[]" class="form-control-inline" value="MCA">MCA
					<input type="checkbox" name="qualification[]" class="form-control-inline" value="BCA">BCA
					<input type="checkbox" name="qualification[]" class="form-control-inline" value="B.Tech">B.Tech
				</div> -->
				<div class="form-group">
					<label>Image : </label>
					<input type="file" name="pic" class="form-control">
				</div>
				<input type="submit" name="insert" value="Insert" class="btn btn-success">
			</form>
	</div>
<?php
if(isset($_POST["insert"]))
{
	$name=$_POST["name"];
	$pic=$_FILES["pic"]["tmp_name"];
	$destination="img/".$_FILES["pic"]["name"];
	$size=$_FILES["pic"]["size"];
	if(move_uploaded_file($pic, $destination))
	{
		$pic=$_FILES["pic"]["name"];
	}
	$pic_name=$_FILES["pic"]["name"];//demo.jpg
	$p_array=explode(".", $pic_name);//array
	$p_ext=$p_array[1];
	$ext=array("jpg","jpeg","png","PNG");
	if(in_array($p_ext, $ext))
	{
		if($size <= 8024)
		{
			$qry=mysqli_query($con,"insert into login (name,pic,path,size) value ('$name','$pic','$destination','$size')");
			header("location:index.php");
		}
		else
		{
			echo "Not Valid Size";
		}
	}
	else
	{
		echo "Not Image Valid";
	}

	
}
?>









	<!-- Login Form-->
	<div style="float: right; width: 40%;">
			<form method="post" action="">
				<div class="form-group">
					<label>Email : </label>
					<input type="text" name="email" class="form-control">
				</div>
				<div class="form-group">
					<label>Password : </label>
					<input type="text" name="password" class="form-control">
				</div>
				<input type="submit" name="login" value="Login" class="btn btn-success">
			</form>
	</div>
</div>	
<?php
if(isset($_POST["login"]))
{
	extract($_POST);
	$qry=mysqli_query($con,"select * from login where email='$email' and password='$password'");
	$row=mysqli_fetch_array($qry);
	if($row)
	{
		session_start();
		$_SESSION["email"]=$email;
		header("location:profile.php");
	}
}
?>	
</body>
</html>