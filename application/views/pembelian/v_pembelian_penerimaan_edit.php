<?php 
	$this->load->view('template/header');
    $this->load->view('template/body');    	  
	foreach($header as $rowh){}
?>	




			<div class="row">
				<div class="col-md-12">
					<h3 class="page-title">
					  Pembelian <small>Penerimaan Barang</small>
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
							<a href="<?php echo base_url();?>pembelian_penerimaan">
                               Daftar Penerimaan Barang
                              							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>							
							<a href="">
                               Edit Penerimaan Barang
							</a>
						</li>
					</ul>
				</div>
			</div>
            <div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-reorder"></i>*Edit Data
					</div>
					
					
				</div>
				
				<div class="portlet-body form">									
				  <form id="frmpembelian" class="form-horizontal" method="post">
					<div class="form-body">
					  <div class="tabbable tabbable-custom tabbable-full-width">
					    <ul class="nav nav-tabs">
							<li class="active">
								<a href="#tab1" data-toggle="tab">
                                   <i class="fa fa-file"></i> 
								</a>
							</li>
							<li class="">
								<a href="#tab2" data-toggle="tab">                                   
								   <i class="fa fa-info-circle"></i>
								</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab1">		
												<div class="row">
												    <div class="col-md-6">
                                                         <div class="form-group">	
                                                           <label class="col-md-3 control-label">Terima Dari</label>
													        <div class="col-md-6">
															  <div class="input-group">
                                                              <select id="supp" name="supp" class="form-control input-medium select2me" data-placeholder="Pilih..." onkeypress="return tabE(this,event)">
            												 
                                                            <?php
                                                              foreach($supp as $row) { ?>
            													<option value="<?php echo $row->kode;?>" <?php if($row->kode==$rowh->kodesup){ echo "selected=true";}?>><?php echo $row->nama;?></option>
                                                            <?php } ?>
            												</select>																														    													            
													        </div>
															</div>
                                                           </div>
													</div>
														
													<div class="col-md-6">
														<div class="form-group">
                                                            <label class="col-md-3 control-label">Nomor #</label>
													        <div class="col-md-4">
															    <input type="text" class="form-control input-medium" name="nomorbukti"  id="nomorbukti" value="<?php echo $rowh->nolpb;?>" readonly>																																															
																
													        </div>

														</div>
													</div>
												</div>	
												<div class="row">
												  <div class="col-md-6">
                                                         <div class="form-group">	
                                                           <label class="col-md-3 control-label">Gudang</label>
													        <div class="col-md-6">
															  <div class="input-group">
                                                              <select id="gudang" name="gudang" class="form-control input-medium select2me" data-placeholder="Pilih..." onkeypress="return tabE(this,event)">
            												 
                                                            <?php
                                                              foreach($gudang as $row) { ?>
            													<option value="<?php echo $row->kode;?>" <?php if($row->kode==$rowh->gudang){ echo "selected=true";}?>><?php echo $row->nama;?></option>
                                                            <?php } ?>
            												</select>																														    
													            
													        </div>
															</div>
                                                           </div>
													</div>
												  <div class="col-md-6">
                                                         <div class="form-group">	
                                                           <label class="col-md-3 control-label">No. Pesanan</label>
													        <div class="col-md-6">
															  <div class="input-group">
                                                                  <input type="text" class="form-control input-medium" name="kodepo"  id="kodepo" value="<?php echo $rowh->kodepo;?>">																														    													            
													          </div>
															</div>
                                                           </div>
													</div>
												</div>
												
												<div class="row">												    												
													<div class="col-md-6">
                                                         <div class="form-group">
                                                            <label class="col-md-3 control-label">Tanggal</label>
													        <div class="col-md-4">
														        <input id="tanggal" name="tanggal" class="form-control input-medium" type="date" value="<?php echo date('Y-m-d',strtotime($rowh->tgllpb));?>" />
													    	  
													        </div>



														</div>
													</div>
													
													<div class="col-md-6">
														<div class="form-group">
                                                            <label class="col-md-3 control-label">No. Terima</label>
													        <div class="col-md-4">
														        <input type="text" class="form-control input-medium" placeholder="" name="noterima" id="noterima" value="<?php echo $rowh->noterima;?>">
													        </div>

														</div>
													</div>
												
													
												</div>
												
												
												
												

												<div class="row">
												 <div class="col-md-12">
                                                   	
													<table id="datatable" class="table table-hoverx table-stripedx table-borderedx table-condensed table-scrollable">
													<thead>
                                                      <tr>
                    									<th width="50%" style="text-align: center">Kode/Nama Barang</th>
                    									<th width="20%" style="text-align: center">Kuantitas</th>
														<th width="30%" style="text-align: center">Satuan</th>
														
                    								</tr>
                    								<thead>
													
                    								<tbody>
													<?php
													$no=1;
													foreach($detil as $row){?>
													<tr>													   
                                                        <td width="50%">
															<select name="kode[]" id="kode<?=$no;?>" class="select2_el_barang form-control input-xlarge" onchange="showbarangname(this.value, 1)">
															  <option value="<?= $row->kodeitem;?>"><?= $row->namabarang;?></option>
															</select>												
														</td>	
                                                       
                                                        <td width="30%" ><input name="qty[]"    value="<?php echo $row->qtyterima;?>" id="qty<?php echo $no;?>" type="text" class="form-control rightJustified"  ></td>
														<td width="20%" ><input name="sat[]"    value="<?php echo $row->satuan;?>"id="sat<?php echo $no;?>" type="text" class="form-control "  onkeypress="return tabE(this,event)"></td>
														
								                      </tr>
                    								<?php $no++; } ?>
								                    </tbody>
													</table>
													
													<div class="row">
														<div class="col-xs-9">
															<div class="wells">
																<button type="button" onclick="tambah()" class="btn green"><i class="fa fa-plus"></i> </button>
												                <button type="button" onclick="hapus()" class="btn red"><i class="fa fa-trash-o"></i></button>
															</div>															
														</div>
														
																										
													

								                    </div>
								                   </div>
												</div>
												

											
							</div>
							<!-- tab1-->
							
							<div class="tab-pane" id="tab2">	
							   <div class="row">
							       <div class="col-md-12">
							            <div class="row">												    												
											<div class="col-md-6">
												 <div class="form-group">
													<label class="col-md-3 control-label">Tgl Kirim</label>
													<div class="col-md-4">
													   <div class="input-icon">
														<i class="fa fa-calendar"></i>
														<input id="tanggalkirim" name="tanggalkirim" class="form-control date-picker input-medium" type="text" value="<?php echo date('d-m-Y',strtotime($rowh->tglkirim));?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years" placeholder="" onkeypress="return tabE(this,event)"/>
													   </div>
													</div>
												</div>
											</div>
											
											<div class="col-md-6">
												<div class="form-group">
													<label class="col-md-3 control-label">Keterangan</label>
													<div class="col-md-4">
														<input type="text" class="form-control input-large" placeholder="" name="keterangan" id="keterangan" value="<?php echo $rowh->keterangan;?>">
													</div>

												</div>
											</div>																									
									    </div>
										<div class="row">
										   <div class="col-md-6">
												<div class="form-group">
													<label class="col-md-3 control-label">Alamat</label>
													<div class="col-md-9">
														<textarea class="form-control" name="alamat" id="alamat" ><?php echo $rowh->alamat?></textarea>
													</div>
												</div>
											</div>																									
										</div>									
								   </div> 
								</div>
                                
							</div>
							<!-- tab2-->
							
						</div><!--tab-->	
						
						<div class="row">
							<div class="col-xs-12">
								<div class="well">		
								   
                                   
									<button type="button" onclick="save()" class="btn blue"><i class="fa fa-save"></i> Simpan</button>
									<a class="btn yellow print_laporan" onclick="javascript:window.open(_urlcetak(),'_blank');" ><i class="fa fa-print"></i> Cetak</a>
                                       
									<div class="btn-group">
										<a href="<?php echo base_url()?>pembelian_penerimaan/entri" class="btn btn-success">
										<i class="fa fa-plus"></i>
										Data Baru
										</a>
									</div>
									<h4><span id="error" style="display:none; color:#F00">Terjadi Kesalahan... </span> <span id="success" style="display:none; color:#0C0">Data sudah disimpan...</span></h4>								
								</div>															
							</div>
							
																		
						</div>
													
													
					  </div>	
					</div>  
					
					
				   </form>
				</div>
            </div>
		</div>
	</div>
</div>

<?php
  $this->load->view('template/footer');
  $this->load->view('template/v_report');
?>


<script>

var idrow  = <?php echo $jumdata1+1;?>;

function tambah(){
    var x=document.getElementById('datatable').insertRow(idrow);
    var td1=x.insertCell(0);
    var td2=x.insertCell(1);
    var td3=x.insertCell(2);
	
	var akun="<select name='kode[]' id=kode"+idrow+" onchange='showbarangname(this.value,"+idrow+")' class='select2_el_barang form-control' ><option value=''>--- Pilih Barang ---</option></select>";
	td1.innerHTML=akun;
	td2.innerHTML="<input name='qty[]'    id=qty"+idrow+" onchange='totalline("+idrow+")' value='1'  type='text' class='form-control rightJustified'  >";
	td3.innerHTML="<input name='sat[]'    id=sat"+idrow+" type='text' class='form-control' >";
	initailizeSelect2_barang();
    idrow++;
}


function showbarang(str) {
  var xhttp;
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "<?php echo base_url(); ?>pembelian_pesanan/getbarang/"+str, true);  
  xhttp.send();
}



function showharga(str) {
  var xhttp;
  if (str == "") {
    document.getElementById("dafhargabeli").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("dafhargabeli").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "<?php echo base_url(); ?>pembelian_pesanan/getharga/"+str, true);  
  xhttp.send();
}


function showbarangname(str, id) {   
  var xhttp; 
  var vid = id;
   $.ajax({
        url : "<?php echo base_url();?>pembelian_pesanan/getinfobarang/"+str,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {			
			$('#sat'+vid).val(data.satuan);			
		}
	});	
  
  
}

function getnobukti() {
  var xhttp;
  
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("nomorbukti").value = this.responseText;
    }
  };
 
  xhttp.open("GET", "<?php echo base_url(); ?>pembelian_pesanan/getnobukti", true); 
  xhttp.send();
}

function save()
{	        
    var noform   = $('[name="noterima"]').val(); 
    var tanggal  = $('[name="tanggal"]').val(); 	
	if(noform==""){
		swal('PEMBELIAN','Nomor surat jalan / penerimaan belum diisi ...',''); 
	} else {
	$.ajax({				
		url:'<?php echo site_url('pembelian_penerimaan/save/2')?>',				
		data:$('#frmpembelian').serialize(),				
		type:'POST',
		
		success:function(data){ 
		  swal({
					  title: "PEMBELIAN",
					  html: "<p> No. Surat Jalan   : <b>"+noform+"</b> </p>"+ 
					  "Tanggal :  " + tanggal,
					  type: "info",
					  confirmButtonText: "OK" 
					 }).then((value) => {
							location.href = "<?php echo base_url()?>pembelian_penerimaan";
		         });				
	
		},
		error:function(data){
			$("#error").show().fadeOut(5000);
			
			swal('PEMBELIAN','Data gagal disimpan ...',''); 
								
					
		}
		});
	}	
}	


   
	function hapus(){
		if(idrow>1){
			var x=document.getElementById('datatable').deleteRow(idrow-1);
			idrow--;
		}
	}

  
  
	
function showpo() {
  var xhttp;
  var str = $('[name="supp"]').val(); 
  
  if (str == "") {
    document.getElementById("listpo").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("listpo").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "<?php echo base_url(); ?>pembelian_penerimaan/getlistpo/"+str, true);  
  xhttp.send();
}

function getpo() { 
  var xhttp;      
  var str = $('[name=kodepo]').val();
  if(str==""){
	hapus();
	$('[id=kode0]').val('');
	$('[id=namabarang0]').val('');
	$('[id=qty0]').val('');
	$('[id=sat0]').val('');
  }  else  {
	$.ajax({
        url : "<?php echo base_url();?>pembelian_penerimaan/getpo/"+str,
        type: "GET",
        dataType: "JSON",
		
        success: function(data)
        {		            
		    for(i=0; i <= data.length-1; i++){	
			hapus();
			}
			
            for(i=0; i <= data.length-1; i++){		
			  if(i>0){
		       tambah();
			  }
			  document.getElementById("kode"+i).value=data[i].kodeitem;
			  document.getElementById("namabarang"+i).value=data[i].namabarang;		    
              document.getElementById("qty"+i).value=data[i].qtyorder;		    
			  document.getElementById("sat"+i).value=data[i].satuan;		    
			}
			
			
			
			
		}
	});	    
  }	
}

window.onload = function(){
        document.getElementById('nomorbukti').focus();
};

function _urlcetak()
{
	var baseurl = "<?php echo base_url()?>";
	var param= $('[name="nomorbukti"]').val();				
    return baseurl+'pembelian_penerimaan/cetak/'+param;
}

</script>



							
</body>
</html>

