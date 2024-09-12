<?php
 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=master_akun.xls");
 header("Pragma: no-cache");
 header("Expires: 0");
?>
<table border="1" >
	<thead>
		 <tr>
			 <th style="text-align: center">Kode Perkiraan</th>
			 <th style="text-align: center">Nama</th>
			 <th style="text-align: center">Tipe Akun</th>
		 </tr>
	 </thead>
	 <tbody>
	 <?php
	   foreach($master_akun->result_array() as $db) { ?>
		 <tr>
			 <td><?php echo $db['kodeakun'];?></td>
			 <td><?php echo $db['namaakun'];?></td>
			 <td><?php echo $db['kel'];?></td>
		 </tr>
	 <?php } ?>
	 </tbody>
</table>




