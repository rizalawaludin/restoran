<?php  
	include "koneksi/koneksi.php";
	include "library/controllers.php";
$perintah = new oop();
@$table = "tb_user";

@$username = $_POST['username'];
@$password = $_POST['password'];

@$redirect = "dasbord.php";
if (isset($_POST['login'])) {
    $perintah->login($con, $table, $username, $password, $redirect);
}
if (isset($_POST['batal'])) {
    echo "<script>document.location.href='login.php'</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<form method="post">
		<div style="width: 16.5rem;height: 25px;background-color: blue;position: absolute;margin-top: -0.5rem;margin-left: 39rem;text-align: center;">Login</div>
		<div style="margin-top: 16rem;">
		<table align="center">
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td><input type="text" name="username"></td>
			</tr>
		</br>
			<tr>
				<td>Password</td>
				<td>:</td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td><input type="submit" name="login"></td>
			</tr>
		</table>
		</div>
	</form>
</body>
</html>