<?php empty( $app ) ? header('location:../index.php') : '' ; if(isset($_SESSION['level'])){?>

<?php if($_SESSION['level']=='admin'){ ?>
<script type="text/javascript">
	$(document).ready(function() {
		$(".delbutton").click(function(){
		 var element = $(this);
		 var del_id = element.attr("id");
		 var info = 'id=' + del_id;
		 if(confirm("Anda yakin akan menghapus?"))
		 {
			 $.ajax({
			 type: "POST",
			 url : "hapus.php",
			 data: info,
			 success: function(){
			location.reload(); }
		
			 });
		 
 			}
			 
		 return false;
		 });
	})
	</script>
<p>
	<a href="#" class="btn btn-mini"><i class="icon-plus"></i> Add New</a>
</p>
<?php } ?>

<div class="tab-content">
<table class="table table-bordered table-condensed table-hover" style="table-layout:fixed">
	<thead>
		<tr class="nowrap">
			<th align="center" width="2%">No</th>
			<th align="center" width="15%">Nama</th>
			<th align="center" width="10%">Tempat Lahir</th>
			<th align="center" width="10%">Tanggal Lahir</th>
			<th align="center" width="3%">L/P</th>
			<th align="center">Alamat</th>
			<th align="center" width="10%">Ponsel</th>
			<?php if($_SESSION['level']=='admin'){?>
			<th colspan = "2" align="center" width="10%">Action</th>
			<?php } ?>
		</tr>
	</thead>
	<tbody>

	<?php
$db = new mysqli("localhost","root","","windan");
echo $db->connect_errno?'Koneksi gagal :'.$db->connect_error:'';
$sql = "select * from windan";
$result = $db->query($sql);
$no = 1 ;
while($row = $result->fetch_object()){
?>
<tr>
<td><?php echo $no++; ?></td>
<td><?php echo $row->lengkap; ?></td>
<td><?php echo $row->tempat; ?></td>
<td><?php echo $row->tgl; ?></td>
<td><?php echo $row->jenis; ?></td>
<td><?php echo $row->alamat; ?></td>
<td><?php echo $row->hp; ?></td>
<?php if($_SESSION['level']=='admin'){?>
			<td><a href="edit.php?id=<?php echo $row->id; ?>" class="btn btn-mini"><i class="icon-edit"></i> Edit</a>
			<td><a  href="#" class="delbutton btn btn-mini" onClick="return confirm('Delete mahasiswa dengan Nama : <?php 
			echo $row->lengkap;?>');"><i class="icon-trash"></i> Delete</a></td>
			<?php } ?>
</tr><?php }?>
	</tbody>
	
</table>

</div>
<?php 
}else{
echo '<div class="alert alert-error"> Maaf Anda Harus Login terlebih dahulu untuk mengakses halaman ini </div>';
}
