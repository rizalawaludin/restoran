<?php  
	include "koneksi/koneksi.php";
	$menu="";
	$jenis="";
	$harga="";
	$status="";
	$kategori="";
	if (isset($_POST["simpan"])) {
		$sql = mysqli_query($con,"INSERT INTO tb_menu VALUES('','".$_POST["menu"]."','".$_POST["jenis"]."','".$_POST["harga"]."','".$_POST["status"]."','".$_FILES["foto"]["name"]."','".$_POST["kategori"]."')") or die ("your database is lol");
		if($sql){
			$target_file =$_FILES["foto"]["name"];
			$target_apa = $_FILES["foto"]["tmp_name"];
			if(move_uploaded_file($target_apa,"images/".$target_file)){
				echo "<script>alert('berhasil');document.location.href = 'menu.php'</script>";
			}else{
				echo "<script>alert('gagal');document.location.href = 'menu.php'</script>";
			}
		}
	}
	else if (isset($_POST["btn-edit"])){
		$sql = mysqli_query($con,"UPDATE tb_menu SET jenis='".$_POST["jenis"]."', harga='".$_POST["harga"]."', status='".$_POST["status"]."', kd_kategori='".$_POST["kategori"]."' WHERE menu='".$_POST["menu"]."'");
	}
	if (isset($_GET["delete"])) {
		$sql = mysqli_query($con,"DELETE FROM tb_menu WHERE Menu='".$_GET["delete"]."'");
		if($sql) {
			echo "<script>alert('berhasil');document.location.href = 'menu.php'</script>";
		}else{
			echo "<script>alert('Gagal');document.location.href = 'menu.php'</script>";
		}
	}
	else if (isset($_GET["edit"])) {
		$sql = mysqli_query($con,"SELECT * FROM tb_menu WHERE menu='".$_GET["edit"]."'");
		while($row=mysqli_fetch_array($sql,MYSQLI_ASSOC)){
			$menu=$row["menu"];
			$jenis=$row["jenis"];
			$harga=$row["harga"];
			$status=$row["status"];
			$kategori=$row["kd_kategori"];
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
	<form method="post" action='<?php echo $_SERVER["PHP_SELF"];?>' enctype="multipart/form-data">
	<table>
		<tr><td>Menu</td><td><input type="text" name="menu" value="<?php echo $menu; ?>"></td></tr>
		<tr><td>Jenis</td><td><select name="jenis" value="<?php echo $jenis; ?>"><option>Makanan</option><option>Minuman</option></tr>
		<tr><td>Harga</td><td><input type="text" name="harga" value="<?php echo $harga; ?>"></td></tr>
		<tr><td>Status</td><td><input type="text" name="status" value="<?php echo $status; ?>"></td></tr>
		<tr><td>Foto</td><td><input type="file" name="foto" value="<?php echo $foto ; ?>"></td></tr>
		<tr><td>Kategori</td><td>
			<select name="kategori">
			<?php  
				$hasil = mysqli_query($con,"SELECT * FROM tb_kategori");
				while ($r = mysqli_fetch_array($hasil))
				{?>

					<option value="<?php echo $r['kd_kategori']?>"><?php echo $r['kategori'];?></option>
				
				<?php }?>
			</select></td></tr>
		<tr><td colspan="2"><input type="submit" name="simpan" value="simpan"/><input type="submit" name="btn-edit" value="edit"/></td></tr>
	</table>
	</form>
	<br>
	<form action="menu.php" method="get">
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
		<tr><th>Menu</th><th>Jenis</th><th>Harga</th><th>Status</th><th>Foto</th><th>Kategori</th><th>Action</th></tr>
		<?php 
		if(isset($_GET['cari'])){
		$cari = $_GET['cari'];
		$data = mysqli_query($con,"SELECT * FROM tb_menu where jenis like '%".$cari."%'");				
		}else{
			$data = mysqli_query($con,"SELECT *FROM tb_menu");		
		}
		while($row = mysqli_fetch_array($data,MYSQL_ASSOC)){
			echo '<tr><td>'.$row["menu"].'</td>';
			echo '<td>'.$row["jenis"].'</td>';
			echo '<td>'.$row["harga"].'</td>';
			echo '<td>'.$row["status"].'</td>';
			echo '<td><img src="images/'.$row["foto"].'" style="width:50px;height:50px;"/></td>';
			echo '<td>'.$row["kd_kategori"].'</td>';
			echo '<td> <a href="?edit='.$row["menu"].'">Edit</a> | <a href=?delete='.$row["menu"].'>Delete </td></tr>';
		}
		?>
	</table>
</body>
</html>