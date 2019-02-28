<?php
include "koneksi/koneksi.php";

if(isset($_POST['simpan'])){
	$sql = mysqli_query($con, "INSERT INTO tb_user VALUES('','$_POST[nama]','$_POST[nohp]','$_POST[username]','$_POST[password]','$_POST[level]')");
	if($sql){
			echo "<script>alert('Berhasil');document.location.href='kelola_user.php'</script>";
	}else{
			echo "<script>alert('Gagal');document.location.href='kelola_user.php'</script>";
	}
}

	if (isset($_GET['hapus'])) {
		$sql = "DELETE FROM tb_user WHERE kd_user = '$_GET[id]' ";
		$query = mysqli_query($con,$sql);
		if($query){
			echo "<script>alert('Berhasil');document.location.href='kelola_user.php'</script>";
		}
		else{
			echo "<script>alert('Gagal');document.location.href='kelola_user.php'</script>";
		}
	}

	if (isset($_GET['edit'])) {
		$sql = "SELECT * FROM tb_user WHERE kd_user = '$_GET[id]'";
		$query = mysqli_query($con,$sql);
		$edit = mysqli_fetch_array($query);
	}
	
	if (isset($_POST['update'])) {
		$sql = "UPDATE tb_user SET nama='$_POST[nama]', nohp='$_POST[nohp]',username='$_POST[username]',password='$_POST[password]',level='$_POST[level]' WHERE kd_user = '$_GET[id]'";
		$query = mysqli_query($con,$sql);
		if($query){
			echo "<script>alert('Berhasil');document.location.href='kelola_user.php'</script>";
		}
		else{
			echo "<script>alert('Gagal');document.location.href='kelola_user.php'</script>";
		}
	}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Form User</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<div id="lol">
		<td><button style="margin-top: 1rem;background: white;float: right;margin-right:5rem;"><a href="dasbord.php">Kembali</a></button></td>
	</div>
	<h4 align="center" style="margin-top: 6rem;">Form User</h4>
</head>
<body>
	<div style="margin-top: 2rem;margin-left: 33rem;">
	<form method="post">
	<table align="center">
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td><input type="text" name="nama" value="<?= @$edit['nama'] ?>"></td>
		</tr>
		<tr>
			<td>No HP</td>
			<td>:</td>
			<td><input type="text" name="nohp" value="<?= @$edit['nohp'] ?>"></td>
		</tr>
		<tr>
			<td>Username</td>
			<td>:</td>
			<td><input type="text" name="username" value="<?= @$edit['username'] ?>"></td>
		</tr>
		<tr>
			<td>Password</td>
			<td>:</td>
			<td><input type="text" name="password" value="<?= @$edit['password'] ?>"></td>
		</tr>
		<tr>
			<td>Level</td>
			<td>:</td>
			<td><select name="level">
				<option value="<?= @$edit['level'] ?>"><?= @$edit['level'] ?></option>
				<option value="admin">admin</option>
				<option value="manajer">manajer</option>
				<option value="kasir">kasir</option>
			</td>
		</tr>
		<tr>
			<td>
			<?php 
				if (@$_GET['id']) { ?>
					<input type="submit" name="update" value="update">	
			<?php } else{ ?>
					<input type="submit" name="simpan" value="simpan">
			<?php }	?>
				
				
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>
				<input type="text" name="tcari" value="<?php echo @$_POST['tcari'];  ?>"><input type="submit" name="cari" value="cari">
			</td>
		</tr>
		</table>
		<br>
		<table border="1" cellpadding="10" cellspacing="0" align="center" style="margin-left: -5rem;">
			<tr>
				<td>Kd_user</td>
				<td>Nama</td>
				<td>NO HP</td>
				<td>Username</td>
				<td>Password</td>
				<td>Level</td>
				<td colspan="2">Aksi</td>
			</tr>
			<?php
				$no=1;
				$sql= "SELECT * FROM tb_user";
				if (isset($_POST['cari'])) {
				$sql ="SELECT * FROM tb_user WHERE menu LIKE '%$_POST[tcari]%'";
				}else{
				$sql = "SELECT * FROM tb_user";
				}
				$query= mysqli_query($con,$sql);
				while($r= mysqli_fetch_array($query)) :  ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $r[1] ?></td>
						<td><?= $r[2] ?></td>
						<td><?= $r[3] ?></td>
						<td><?= $r[4] ?></td>
						<td><?= $r[5] ?></td>
						<td>
							<a href="?edit&id=<?= $r[0] ?>">Edit |</a>
							<a href="?hapus&id=<?= $r[0] ?>" onclick="return confirm('Yakin ingin menghapus??')">Hapus</a>
						</td>
					</tr>

			<?php endwhile; ?>
		</table>
</body>
</html>