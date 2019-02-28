<?php  
	include "koneksi/koneksi.php";
	$kategori="";
	if (isset($_POST["simpan"])) {
		$sql = mysqli_query($con,"INSERT INTO tb_kategori VALUES('','".$_POST["kategori"]."')") or die ("your database is lol");
		if($sql){
			echo "<script>alert('berhasil');document.location.href = 'kategori.php'</script>";
		}else{
			echo "<script>alert('Gagal!');document.location.href = 'kategori.php'</script>";
		}
	}
	else if (isset($_POST["btn-edit"])){
		$sql = mysqli_query($con,"UPDATE tb_menu SET kategori='".$_POST["kategori"]."' WHERE");
	}
	if (isset($_GET["delete"])) {
		$sql = mysqli_query($con,"DELETE FROM tb_kategori WHERE kategori='".$_GET["delete"]."'");
		if($sql) {
			echo "<script>alert('berhasil');document.location.href = 'kategori.php'</script>";
		}else{
			echo "<script>alert('Gagal');document.location.href = 'kategori.php'</script>";
		}
	}
	else if (isset($_GET["edit"])) {
		$sql = mysqli_query($con,"SELECT * FROM tb_kategori WHERE kategori='".$_GET["edit"]."'");
		while($row=mysqli_fetch_array($sql,MYSQLI_ASSOC)){
			$kategori=$row["kategori"];
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Kategori</title>
</head>
<body>
	<p><a href="dasbord.php" style="margin-left: 80rem;position: absolute;">Kembali</a></p>
	<form method="post">
	<table>
		<tr><td>Kategori</td><td><input type="text" name="kategori" value="<?php echo $kategori; ?>"></tr>
		<tr><td colspan="2"><input type="submit" name="simpan" value="simpan"/><input type="submit" name="btn-edit" value="edit"/></td></tr>
	</table>
	</form>
<form action="kategori.php" method="get">
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
	<tr>
		<th>No</th>
		<th>Kategori</th>
	</tr>
	<?php 
	if(isset($_GET['cari'])){
		$cari = $_GET['cari'];
		$data = mysqli_query($con,"SELECT * FROM tb_kategori where kategori like '%".$cari."%'");				
	}else{
		$data = mysqli_query($con,"SELECT *FROM tb_kategori");		
	}
	$no = 1;
	while($d = mysqli_fetch_array($data)){
	?>
	<tr>
		<td><?php echo $no++; ?></td>
		<td><?php echo $d['kategori']; ?></td>
	</tr>
	<?php } ?>
</table>
</body>
</html>