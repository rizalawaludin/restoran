<?php  
	include "koneksi/koneksi.php";
	$ntransaksi="";
	$harga="";
	$stotal="";
	$jumlah="";
	$hasil="";
	if (isset($_POST["simpan"])) {
		$sql = mysqli_query($con,"INSERT INTO tb_transaksi VALUES('','".$_POST["ntransaksi"]."','".$_POST["menu"]."','".$_POST["harga"]."','".$_POST["jumlah"]."','".$_POST["stotal"]."')") or die ("your database is lol");
		if($sql){
			echo "<script>alert('berhasil');document.location.href = 'transaksi.php'</script>";
		}else{
			echo "<script>alert('berhasil');document.location.href = 'transaksi.php'</script>";
		}
	}
	else if (isset($_POST["btn-edit"])){
		$sql = mysqli_query($con,"UPDATE tb_user SET no_hp='".$_POST["nohp"]."', username='".$_POST["username"]."', password='".$_POST["password"]."', level='".$_POST["level"]."' WHERE nama='".$_POST["nama"]."'");
	}
	if (isset($_GET["delete"])) {
		$sql = mysqli_query($con,"DELETE FROM tb_transaksi WHERE kd_transaksi='".$_GET["delete"]."'");
		if($sql) {
			echo "<script>alert('berhasil');document.location.href = 'transaksi.php'</script>";
		}else{
			echo "<script>alert('berhasil');document.location.href = 'transaksi.php'</script>";
		}
	}
	else if (isset($_GET["edit"])) {
		$sql = mysqli_query($con,"SELECT * FROM tb_transaksi WHERE kd_transaksi='".$_GET["edit"]."'");
		while($row=mysqli_fetch_array($sql,MYSQLI_ASSOC)){
			$ntransaksi=$row["kd_transaksi"];
			$jumlah=$row["jumlah"];
			$stotal=$row["stotal"];
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Transaksi</title>
</head>
<body>
	<p><a href="dasbord.php" style="margin-left: 80rem;position: absolute;">Kembali</a></p>
	<form method="post">
	<table>
		<tr><td>No Transaksi</td><td><input type="text" name="ntransaksi" value="<?php echo $ntransaksi; ?>"></td></tr>
		<tr><td>Menu</td><td>
			<select name="menu"  id="menu" onchange="price()">
			<?php  
				$hasil = mysqli_query($con,"SELECT * FROM tb_menu");
				while ($r = mysqli_fetch_array($hasil))
				{?>

					<option value="<?php echo $r['kd_menu']?>"><?php echo $r['jenis'];?></option>
				
				<?php }?>
			</select></td></tr>
		<tr><td>Harga</td><td><input type="number" name="harga" id="harga"></td></tr>
		<tr><td>Jumlah</td><td><input type="number" name="jumlah" value="<?php echo $jumlah;?>"></td></tr>
		<tr><td>Tanggal</td><td><input type="date" name="stotal" value="<?php echo $stotal;?>"></td></tr>
		<tr><td colspan="2"><input type="submit" name="simpan" value="simpan"/><input type="submit" name="btn-edit" value="edit"/></td></tr>
		<tr><td>Total</td><td><input type="text" name="total"></td></tr>
		<tr><td>Bayar</td><td><input type="text" name="bayar"></td></tr>
	</table>
	</form>
	<table border="1">
		<tr><th>No Transaksi</th><th>Menu</th><th>Jumlah</th><th>Sub Total</th><th>Action</th></tr>
		<?php 
		$sql = mysqli_query($con,"SELECT * FROM tb_transaksi");
		while($row = mysqli_fetch_array($sql,MYSQL_ASSOC)){
			echo '<tr><td>'.$row["kd_transaksi"].'</td>';
			echo '<td>'.$row["kd_menu"].'</td>';
			echo '<td>'.$row["jumlah"].'</td>';
			echo '<td>'.$row["subtotal"].'</td>';
			echo '<td> <a href="?edit='.$row["kd_transaksi"].'">Edit</a> | <a href=?delete='.$row["kd_transaksi"].'>Delete </td></tr>';
		}
		?>
	</table>
</body>
</html>