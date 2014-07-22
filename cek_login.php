<?php
session_start();
// koneksi database -------------------------------------------->
$db = new mysqli ( "localhost" , "root" , "" , "test" );
echo $db->connect_errno?'Koneksi gagal : '.$db->connect_error:'';
//<--------------------------------------------------------------

if(isset($_POST['username']) && ($_POST['password'])){
	 $username = $db->real_escape_string($_POST['username']);
	 $password = $db->real_escape_string(md5($_POST['password']));
	 $sql = "select * from usesr where username = '$username' AND password = '$password'";
	 $result = $db->query($sql) or die('Terjadi Kesalahan : '.$db->error);
 
	if ($result->num_rows == 1){
		  $row = $result->fetch_assoc();
		  $_SESSION['username'] = $row['username'];
		  $_SESSION['nama'] = $row['nama'];
		  $_SESSION['level'] = $row['level'];
		  $_SESSION['lengkap'] = $row['lengkap'];
		  header("location:index.php");
		  $_SESSION['pesan'] = '<p><div class="alert alert-success">Selamat datang <b>'.$_SESSION['lengkap'].'</b> Anda login dengan level : <b>'.$_SESSION['level'].'</b></div></p>';
  
	}else{
		$_SESSION['error']="Username atau Password salah";
		header("location:index.php?app=login");
	}
}else{
	//jika tidak menggunakan html5 ( 'required' pada form login )
	//pesan ini akan muncul
	$_SESSION['error']="Username atau password tidak boleh kosong"; 
	header("location:index.php?app=login");
}
?>
