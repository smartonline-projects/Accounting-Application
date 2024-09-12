<?php 
	$this->load->view('template/header');
    $this->load->view('template/body');    	  
	foreach($header as $rowh){};
?>	

			<div class="row">
				<div class="col-md-12">
					<h3 class="page-title">
					  Penjualan <small>Retur</small>
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
							<a href="<?php echo base_url();?>penjualan_retur">
                               Daftar Retur Penjualan
                              							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>							
							<a href="">
                               Edit Retur
							</a>
						</li>
					</ul>
				</div>
			</div>
            <div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-reorder"></i>Edit Data
					</div>
					<!--div class="tools">
						 <span class="label label-sm label-danger">										
						  REGISTER : 
						</span>

					</div-->
					
				</div>
				
				<div class="portlet-body form">									
				  <form id="frmPenjualan" class="form-horizontal" method="post">
					<div class="form-body">
					  <div class="tabbable tabbable-custom tabbable-full-width">
					    <ul class="nav nav-tabs">
							<li class="active">
								<a href="#tab1" data-toggle="tab">
                                   Retur
								</a>
							</li>
							<li class="">
								<a href="#tab2" data-toggle="tab">
                                   Info
								</a>
							</li>
							
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab1">		
												<div class="row">
												    <div class="col-md-6">
                                                         <div class="form-group">
                                                           <label class="col-md-3 control-label">Pelanggan</label>
													        <div class="col-md-6">
															 <div class="input-group">
                                                              <select id="cust" name="cust" class="form-control input-medium select2me" data-placeholder="Pilih..." onkeypress="return tabE(this,event)">
            												 
                                                            <?php
                                                              foreach($cust as $row) { ?>
            													<option value="<?php echo $row->kode;?>" <?php if($rowh->kodecust==$row->kode){ echo "selected=true"; } ?>><?php echo $row->nama;?></option>
                                                            <?php } ?>
            												</select>
															
															 </div>	 
													        </div>
													        </div>

													</div>
														
													<div class="col-md-6">
														<div class="form-group">
                                                            <label class="col-md-3 control-label">No. Retur #</label>
													        <div class="col-md-4">
															    <input type="text" class="form-control input-medium" name="nomorbukti"  id="nomorbukti" value="<?php echo $rowh->koderetur;?>" readonly>																																															
																
													        </div>

														</div>
													</div>
												</div>	
												
												
												<div class="row">												    												
													<div class="col-md-6">
                                                         <div class="form-group">
                                                            <label class="col-md-3 control-label">Tanggal</label>
													        <div class="col-md-4">
														       <input id="tanggal" name="tanggal" class="form-control input-medium" type="date" value="<?php echo date('Y-m-d');?>" />
													    	 
													        </div>



														</div>
													</div>
													
													<div class="col-md-6">
														<div class="form-group">
                                                            <label class="col-md-3 control-label">No. Faktur</label>
													        <div class="col-md-6">
														        <div class="input-group"> 
																  <input type="text" name="kodesi" class="form-control input-medium" value="<?php echo $rowh->kodesi;?>" readonly />
                                                                </div> 																														    													            
													          
													        </div>

														</div>
													</div>
												
													
												</div>
												
												
												<div class="row">
												 <div class="col-md-12">
                                                   
													<table id="datatable" class="table table-hoverx table-stripedx table-borderedx table-condensed table-scrollable">
													  <thead>
                    									<th width="35%" style="text-align: center">Nama Barang</th>
														<th width="10%" style="text-align: center">Kuantitas</th>
														<th width="10%" style="text-align: center">Satuan</th>
														<th width="15%" style="text-align: center">Harga</th>
														<th width="5%" style="text-align: center"></th>
														<th width="10%" style="text-align: center">Diskon</th>
														<th width="15%" style="text-align: center">Total Harga</th>                    									
                    									
                    								</thead>
													
                    								<tbody>
													<?php
													$no=1;
													foreach($detil as $row){?>
													<tr>													   
                                                        <td width="35%">
														    <select name="kode[]" id="kode<?= $no;?>" class="select2_el_barang form-control input-largex" onchange="showbarangname(this.value, <?= $no; ?>)">
															  <option value="<?= $row->kodeitem;?>"><?= $row->namabarang;?></option>
															</select>												
														</td>
                                                       
                                                       <td width="10%" ><input name="qty[]"   value="<?php echo $row->qtyretur;?>"  onchange="totalline(<?php echo $no;?>);total()" value="1" id="qty<?php echo $no;?>" type="text" class="form-control rightJustified"  ></td>
														<td width="10%" ><input name="sat[]"   value="<?php echo $row->satuan;?>"  id="sat<?php echo $no;?>" type="text" class="form-control "  onkeypress="return tabE(this,event)"></td>
														<td width="15%" ><input name="harga[]"  value="<?php echo $row->hargajual;?>" onchange="totalline(<?php echo $no;?>)"  id="harga<?php echo $no;?>" type="text" class="form-control rightJustified"  ></td>
														<td><a class="btn default" id="lupharga<?php echo $no;?>" data-toggle="modal" href="#lupharga" onclick="getidharga(this.id)"><i class="fa fa-search"></i></a></td>
														<td width="5%"  ><input name="disc[]"   value="<?php echo $row->disc;?>" onchange="totalline(<?php echo $no;?>)"  id="disc<?php echo $no;?>" type="text" class="form-control rightJustified "  ></td>
                                                        <td width="15%" ><input name="jumlah[]"  id="jumlah<?php echo $no;?>"; type="text" class="form-control rightJustified" size="40%" onchange="total()"></td>
                                                       
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
													<label class="col-md-3 control-label">PPN</label>
													<div class="col-md-4">
														<select name="sppn" id="sppn" class="form-control select2me input-small" onchange="total()">
														  <option value="Y" <?php if($rowh->sppn=="Y"){ echo "selected=true"; } ?>>Ya</option>
														  <option value="T" <?php if($rowh->sppn=="T"){ echo "selected=true"; } ?>>Tidak</option>
													
														</select>
													</div>

												</div>
											</div>
										</div>
										<div class="row">												    												
											<div class="col-md-6">
												<div class="form-group">
													<label class="col-md-3 control-label">Keterangan</label>
													<div class="col-md-4">
														<textarea row="3" class="form-control input-xlarge" placeholder="" name="keterangan" id="keterangan" maxlength="100"><?php echo $rowh->keterangan;?></textarea>
													</div>

												</div>
											</div>																									
									    </div>
										
										
								   </div> 
								</div>
                                
							</div> <!--tab2-->
							
							
							
						</div><!--tab-->	
						
						<div class="row">
							<div class="col-xs-8">
								<div class="wells">		
								   
                                   
									<button type="button" onclick="save()" class="btn blue"><i class="fa fa-save"></i> Simpan</button>
									<a class="btn yellow print_laporan" onclick="javascript:window.open(_urlcetak(),'_blank');" ><i class="fa fa-print"></i> Cetak</a>   
                                       
									<div class="btn-group">
										<a href="<?php echo base_url()?>penjualan_retur/entri" class="btn btn-success">
										<i class="fa fa-plus"></i>
										Data Baru
										</a>
									</div>	
									<h4><span id="error" style="display:none; color:#F00">Terjadi Kesalahan... </span> <span id="success" style="display:none; color:#0C0">Data sudah disimpan...</span></h4>								
								</div>															
							</div>
							
							<div class="col-xs-4 invoice-block">
							  <div class="well">
								<table>
								  <tr>
									<td width="40%"><strong>SUB TOTAL</strong></td>
									<td width="1%"><strong>:</strong></td>
									<td width="59" align="right"><strong><span id="_vsubtotal"></span></strong></td>
								  </tr>
								  <tr>
									<td width="40%"><strong>DISKON</strong></td>
									<td width="1%"><strong>:</strong></td>
									<td width="59" align="right"><strong><span id="_vdiskon"></span></strong></td>
								  </tr>
								  <tr>
									<td width="40%"><strong>PPN</strong></td>
									<td width="1%"><strong>:</strong></td>
									<td width="59" align="right"><strong><span id="_vppn"></span></strong></td>
								  </tr>
								
								  <tr>
									<td width="40%"><strong>TOTAL</strong></td>
									<td width="1%"><strong>:</strong></td>
									<td width="59" align="right"><strong><span id="_vtotal"></span></strong></td>
								  </tr>
								  
								</table>
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
?>

<script>



var idrow  = <?php echo $jumdata1+1;?>;

function tambah(){
   var x=document.getElementById('datatable').insertRow(idrow);
    var td1=x.insertCell(0);
    var td2=x.insertCell(1);
    var td3=x.insertCell(2);
	var td4=x.insertCell(3);
	var td5=x.insertCell(4);
	var td6=x.insertCell(5);
	var td7=x.insertCell(6);
    var akun="<select name='kode[]' id=kode"+idrow+" onchange='showbarangname(this.value,"+idrow+")' class='select2_el_barang form-control' ><option value=''>--- Pilih Barang ---</option></select>";
	td1.innerHTML=akun;
	td2.innerHTML="<input name='qty[]'    id=qty"+idrow+" onchange='totalline("+idrow+")' value='1'  type='text' class='form-control rightJustified'  >";
	td3.innerHTML="<input name='sat[]'    id=sat"+idrow+" type='text' class='form-control' >";
	td4.innerHTML="<input name='harga[]'  id=harga"+idrow+" onchange='totalline("+idrow+") value='0'  type='text' class='form-control rightJustified'>";
	td5.innerHTML="<a class='btn default' id=lupharga"+idrow+" data-toggle='modal' href='#lupharga' onclick='getidharga(this.id)'><i class='fa fa-search'></i></a>";													
	td6.innerHTML="<input name='disc[]'   id=disc"+idrow+" onchange='totalline("+idrow+")' value='0'  type='text' class='form-control rightJustified'  >";
	td7.innerHTML="<input name='jumlah[]' id=jumlah"+idrow+" type='text' class='form-control rightJustified' size='40%'>";
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
  xhttp.open("GET", "<?php echo base_url(); ?>penjualan_retur/getbarang/"+str, true);  
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
  xhttp.open("GET", "<?php echo base_url(); ?>penjualan_retur/getharga/"+str, true);  
  xhttp.send();
}

function showbarangname1(str,id) {
  var xhttp;
  if (str == "") {
    document.getElementById("nama"+id).value = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("nama"+id).value = this.responseText;
    }
  };
  xhttp.open("GET", "<?php echo base_url(); ?>penjualan_retur/getbarangname/"+str, true);  
  xhttp.send();
}

function showbarangname(str, id) {   
  var xhttp; 
  var vid = id;
   $.ajax({
        url : "<?php echo base_url();?>penjualan_retur/getinfobarang/"+str,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {			
			$('#sat'+vid).val(data.satuan);
			$('#harga'+vid).val(data.hargajual);
			totalline(vid);
		}
	});	
  
  
}

 function post_harga(v1, v2)
  {	
	 id=document.getElementById("nopilihharga").value;
	 document.getElementById("sat"+id).value = v2;	 
	 document.getElementById("harga"+id).value = v1;	      
	 totalline(id);
  } 
  
function getidharga(id)
{
	var vid = id.substring(8);
	document.getElementById("nopilihharga").value = vid;
	var supp = document.getElementById("cust").value;
	var item = document.getElementById("kode"+vid).value;
	var param= supp+'~'+item;
	showharga(param);
}

function save()
{	        
    var tanggal   = $('[name="tanggal"]').val(); 
    var nomor     = $('[name="nomorbukti"]').val(); 	
	var total     = $('#_vtotal').text(); 	
	
	if(nomor=="" || total=="0.00" || total==""){
	  swal('RETUR PENJUALAN','Data Belum Lengkap/Belum ada transaksi ...','');   	
	}  else {
	$.ajax({				
		url:'<?php echo site_url('penjualan_retur/save/2')?>',				
		data:$('#frmPenjualan').serialize(),				
		type:'POST',
		
		success:function(data){ 
		 swal({
					  title: "RETUR PENJUALAN",
					  html: "<p> No. Bukti   : <b>"+nomor+"</b> </p>"+ 
					  "Tanggal :  " + tanggal,
					  type: "info",
					  confirmButtonText: "OK" 
					 }).then((value) => {
							location.href = "<?php echo base_url()?>penjualan_retur";
		         });					
	
		},
		error:function(data){
			swal('RETUR PENJUALAN','Data gagal disimpan ...',''); 
								
					
		}
		});
	}	
}	


	function hapus(){
		if(idrow>2){
			var x=document.getElementById('datatable').deleteRow(idrow-1);
			idrow--;
			total();
		}
	}

	
  function total()
  {
    
   var table = document.getElementById('datatable');
   var rowCount = table.rows.length;

   tjumlah = 0;
   tdiskon = 0; 
   
   for(var i=1; i<rowCount; i++) 
   {
    var row = table.rows[i];
    
	jumlah      = row.cells[1].children[0].value;
	harga       = row.cells[3].children[0].value;    
	diskon      = row.cells[5].children[0].value;    
    var jumlah1 = Number(jumlah.replace(/[^0-9\.]+/g,""));
	var harga1  = Number(harga.replace(/[^0-9\.]+/g,""));
	var diskon1 = Number(diskon.replace(/[^0-9\.]+/g,""));

   	tjumlah  = tjumlah  + eval(jumlah1*harga1);
	
	diskon      = eval((diskon1/100)*jumlah1*harga1);
	
   	tdiskon  = tdiskon + diskon;
		  
    
   } 
   
   var cppn =  document.getElementById("sppn").value;
   if(cppn=="Y"){
	  tppn = (tjumlah-tdiskon)*0.1; 
   } else {
	  tppn = 0; 
   }
      
   
   document.getElementById("_vsubtotal").innerHTML=formatCurrency1(tjumlah);
   document.getElementById("_vdiskon").innerHTML=formatCurrency1(tdiskon);
   document.getElementById("_vppn").innerHTML=formatCurrency1(tppn);
   document.getElementById("_vtotal").innerHTML=formatCurrency1(tjumlah-tdiskon+tppn);


  }
  
  function totalline(id)
  {
   	  
   var table = document.getElementById('datatable');
   var row = table.rows[id];       
   jumlah      = row.cells[1].children[0].value*row.cells[3].children[0].value;    
   diskon      = (row.cells[5].children[0].value/100)* jumlah;
   tot         = jumlah - diskon;
   row.cells[6].children[0].value= tot;   
   total();
   
  }
 
	

function _urlcetak()
{
	var baseurl = "<?php echo base_url()?>";
	var param= $('[name="nomorbukti"]').val();				
    return baseurl+'penjualan_retur/cetak/'+param;
}
	
window.onload = function(){
        document.getElementById('nomorbukti').focus();
		var jumdata = <?php echo $jumdata1+1;?>;
		for(i=1;i<jumdata;i++){
			totalline(i);
		}
};

</script>

<div class="modal fade" id="lupharga" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<span id="nopilihharga">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Daftar Harga Penjualan</h4>
				<h5><strong><span id="namabarangharga"></span></strong></h5>
			</div>
			<div class="modal-body">										 
			  <div id="dafhargabeli"></div>
			</div>   
			<div class="modal-footer">	                                        
				<button type="button" id="btntutup" class="btn red" data-dismiss="modal">Tutup</button>																			
			</div>											
		</div>									
	</div>								
</div>

			
	
</body>
</html> 
