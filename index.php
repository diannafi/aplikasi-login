<?php 
session_start();

//untuk "login_multiuser" bisa diganti dan sesuaikan dengan folder project kamu
//tujuan seperti dibuat menggunakan $_SERVER['HTTP_HOST'] agar hostname berubah sendiri secara dinamis

$base_url = 'http://'.$_SERVER['HTTP_HOST'].'/login_multiuser/'; 

isset ($_GET['app']) ? $app = $_GET['app'] : $app = 'home';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Sample Login Multiuser</title>
	<link href="asset/css/bootstrap.min.css" rel="stylesheet">
	<link href="asset/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="asset/css/style.css" rel="stylesheet">
	<link rel="shortcut icon" href="asset/img/favicon.png">
	<script type="text/javascript" src="asset/js/jquery.min.js"></script>
	<script type="text/javascript" src="asset/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="asset/js/scripts.js"></script>
</head>
<body>
<div id="container">
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="page-header"><h3>Login Multiuser <small> Iwan's code</small></h3></div>
				<ul class="nav nav-tabs">
					<li <?php echo $app=='home'?'class="active"':'';?>><a href="index.php"><i class="icon-home"></i> Home</a></li>
					<?php if(isset($_SESSION['level'])){?>
					<li <?php echo $app=='profile'?'class="active"':'';?>><a href="index.php?app=profile"><i class="icon-wrench"></i>Profile</a></li>
					<li <?php echo $app=='datamahasiswa'?'class="active"':'';?>><a href="index.php?app=datamahasiswa"><i class="icon-list-alt"></i> Data Mahasiswa</a></li>
					<?php }?>
					<li <?php echo $app=='download'?'class="active"':'';?>><a href="index.php?app=download"><i class="icon-check"></i> Download</a></li>
					<li <?php echo $app=='about'?'class="active"' :'';?>><a href="index.php?app=about"><i class="icon-thumbs-up"></i> About</a></li>
					<li class="dropdown pull-right">
						<?php if (isset($_SESSION['nama'])):?>
						<a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="icon-user"></i> <?php echo $_SESSION['nama'];?> <strong class="caret"></strong></a>
						<ul class="dropdown-menu">
							<li><a href="logout.php"><i class="icon-off"></i> Logout</a></li>
							<?php else:?>
						<a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="icon-user"></i> Account<strong class="caret"></strong></a>
						<ul class="dropdown-menu">
							<li><a href="#"><i class="icon-th-list"></i> Create Account</a></li>
							<li class="divider"></li>
							<li><a href="index.php?app=login"><i class="icon-user"></i> Login</a></li>
							<?php endif;?>							
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
<div id="content">
<?php 	

//menampilkan pesan setelah berhasil login		
if(isset($_SESSION['pesan'])){echo $_SESSION['pesan']; unset($_SESSION['pesan']);}

//cek apakah ada file yang dituju pada direktori app jika tidak ada tampilkan pesan error	
if(file_exists('app/'.$app.'.php')){
	include ('app/'.$app.'.php'); 
}else{
	echo '<div class="well">Error : Aplikasi tidak menemukan adanya file <b>'.$app.'.php </b> pada direktori <b>app/..</b></div>';
}

?>
</div>
<p class="footer">Developed By <a href="https://www.facebook.com/Iwan.stmik"><b>Iwan </b></a>Visit <a href="https://mblasak.blogspot.com"> <b>Blog</b></a> </p>
</div>
</body>
</html>
