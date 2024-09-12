<?php
   $status=$this->input->get('status');
   if(!empty($status)){
    switch($status){
        case 'succ':
            $statusMsgClass = 'alert-success';
            $statusMsg = 'Data berhasil ditambahkan.';
            break;
        case 'err':
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Terjadi kesalahan, silahkan coba lagi.';
            break;
        case 'invalid_file':
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'File yang diupload harus file CSV.';
            break;
        default:
            $statusMsgClass = '';
            $statusMsg = '';
    }
}
?>
<?php 
	$this->load->view('template/header');
    $this->load->view('template/body');    	  
?>	

<style type="text/css">
    .panel-heading a{float: right;}
    #importFrm{margin-bottom: 20px;display: none;}
    #importFrm input[type=file] {display: inline;}
</style>
			<div class="row">
				<div class="col-md-12">
					<h3 class="page-title">
					Buku Besar <small>Import Data Akun</small>
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url();?>dashboard">
                               Awal
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="">
                              Buku Besar
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="">
                              Import Data Akun
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
				<div class="note note-success">
						<p>
                             Modul ini berfungsi untuk import data Akun dari file CSV.<br>  
							 Urutan Kolom : <br> 
							 Kode Akun, Nama Akun
						</p>
					</div>
					<!--h2>Import Data Pendapatan Pasar</h2-->
				<?php if(!empty($statusMsg)){
					echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
				} ?>
				<div class="panel panel-default">
					<div class="panel-heading">
						Data Akun
						<a href="javascript:void(0);" onclick="$('#importFrm').slideToggle();">Import Data</a>
					</div>
					<div class="panel-body">
						<form action="<?php echo base_url();?>akuntansi_import_akun/import_akun_csv" method="post" enctype="multipart/form-data" id="importFrm">
							<input type="file" name="file">
							
							
							
							<input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
						</form>
						<table class="table table-bordered">
							<thead>
								<tr>
								  <th style="text-align: center">#id</th>
								  <th style="text-align: center">Kode</th>
								  <th style="text-align: center">Nama Akun</th>
								  
								</tr>
							</thead>
							<tbody>
								<?php	
								$qh ="SELECT * FROM ms_akun_import";
                                $akun  = $this->db->query($qh)->result();
                                $jumdata = $this->db->query($qh)->num_rows();								
							    if($jumdata > 0){ 
								    $tot=0;
									foreach($akun as $row){
										
										
									?>
								<tr>
								  <td align="center"><?php echo $row->id; ?></td>
								  <td align="center"><?php echo $row->kode; ?></td>
								  <td align="center"><?php echo $row->nama; ?></td>
								  
								</tr>
							    <?php
								} } else{ ?>
								<tr><td colspan="3">Tidak ada data.....</td></tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				</div>
			</div>
		</div>
</div>
<?php  
   $this->load->view('template/footer');
?>
