<?php  
	include "koneksi/koneksi.php";
	$nama="";
	$nohp="";
	$username="";
	$password="";
	$level="";
	if (isset($_POST["simpan"])) {
		$sql = mysqli_query($con,"INSERT INTO tb_user VALUES('','".$_POST["nama"]."','".$_POST["nohp"]."','".$_POST["username"]."','".$_POST["username"]."','".$_POST["level"]."')") or die ("your database is lol");
		if($sql){
			echo "<script>alert('berhasil');document.location.href = 'user.php'</script>";
		}else{
			echo "<script>alert('berhasil');document.location.href = 'user.php'</script>";
		}
	}
	else if (isset($_POST["btn-edit"])){
		$sql = mysqli_query($con,"UPDATE tb_user SET no_hp='".$_POST["nohp"]."', username='".$_POST["username"]."', password='".$_POST["password"]."', level='".$_POST["level"]."' WHERE nama='".$_POST["nama"]."'");
	}
	if (isset($_GET["delete"])) {
		$sql = mysqli_query($con,"DELETE FROM tb_user WHERE nama='".$_GET["delete"]."'");
		if($sql) {
			echo "<script>alert('berhasil');document.location.href = 'user.php'</script>";
		}else{
			echo "<script>alert('berhasil');document.location.href = 'user.php'</script>";
		}
	}
	else if (isset($_GET["edit"])) {
		$sql = mysqli_query($con,"SELECT * FROM tb_user WHERE nama='".$_GET["edit"]."'");
		while($row=mysqli_fetch_array($sql,MYSQLI_ASSOC)){
			$nama=$row["nama"];
			$nohp=$row["no_hp"];
			$username=$row["username"];
			$password=$row["password"];
			$level=$row["level"];
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Menu</title>
</head>
<body>
	<p><a href="dasbord.php" style="margin-left: 80rem;position: absolute;">Kembali</a></p>
	<form method="post">
	<table>
		<tr><td>Nama</td><td><input type="text" name="nama" value="<?php echo $nama; ?>"></td></tr>
		<tr><td>No HP</td><td><input type="text" name="nohp" value="<?php echo $nohp; ?>"></td></tr>
		<tr><td>Username</td><td><input type="text" name="username" value="<?php echo $username; ?>"></td></tr>
		<tr><td>Password</td><td><input type="text" name="password" value="<?php echo $password; ?>"></td></tr>
		<tr><td>Level</td><td><select name="level" value="<?php echo $level; ?>"><option>Admin</option><option>Manajer</option><option>Kasir</option></tr>
		<tr><td colspan="2"><input type="submit" name="simpan" value="simpan"/><input type="submit" name="btn-edit" value="edit"/></td></tr>
	</table>
	</form>
	<br>
	<form action="user.php" method="get">
		<label>Cari :</label>
		<input type="text" name="cari">
		<input type="submit" value="Cari">
	</form>

	<?php 
	if(isset($_GET['cari'])){
		$cari = $_GET['cari'];
		echo "<b>Hasil pencarian : ".$cari."</b>";
	}
	?>
	<table border="1">
		<tr><th>Nama</th><th>No HP</th><th>Username</th><th>Password</th><th>Level</th><th>Action</th></tr>
		<?php 
		if(isset($_GET['cari'])){
		$cari = $_GET['cari'];
		$data = mysqli_query($con,"SELECT * FROM tb_user where nama like '%".$cari."%'");				
		}else{
			$data = mysqli_query($con,"SELECT *FROM tb_user");		
		}
		while($row = mysqli_fetch_array($data,MYSQL_ASSOC)){
			echo '<tr><td>'.$row["nama"].'</td>';
			echo '<td>'.$row["no_hp"].'</td>';
			echo '<td>'.$row["username"].'</td>';
			echo '<td>'.$row["password"].'</td>';
			echo '<td>'.$row["level"].'</td>';
			echo '<td> <a href="?edit='.$row["nama"].'">Edit</a> | <a href=?delete='.$row["nama"].'>Delete </td></tr>';
		}
		?>
	</table>
</body>
</html>