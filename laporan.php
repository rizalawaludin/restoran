<?php  
include "koneksi/koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Laporan</title>
</head>
<body>
	<p><a href="dasbord.php" style="margin-left: 80rem;position: absolute;">Kembali</a></p>
	<h1>Laporan</h1>
	<form method="post">
		<table>
			<tr>
				<td>Dari Tanggal</td>
				<td><input type="date" name="tawal"></td>
				<td>Sampai</td>
				<td><input type="date" name="takhir"></td>
			</tr>
			<tr>
				<td><input type="button" name="cari" value="cari"></td>
			</tr>
		</table>
	</form>
</body>
</html>