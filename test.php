<?php  
include "koneksi/koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
</head>
<body>
	<h1>CETAK PRINT DATA DARI DATABASE DENGAN PHP</h1>
	<table border="1">
			<tr>
				<th>No</th>
				<th>Tanggal</th>
			</tr>
			<?php 
			$no = 1;
			$sql = mysqli_query($con,"select * from tb_transaksi");
			while($data = mysqli_fetch_array($sql)){
			?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $data['tgl_transaksi']; ?></td>
			</tr>
			<?php 
			}
			?>
		</table>
 
		<br/>
 
		<a href="cetak.php" target="_blank">CETAK</a>
 
 
	</center>
</body>
</html>