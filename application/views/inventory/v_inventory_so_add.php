<?php 
	$this->load->view('template/header');
    $this->load->view('template/body');    	  
?>	


			<div class="row">
				<div class="col-md-12">
					<h3 class="page-title">
					  Inventory <small>Stok Opname</small>
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
							<a href="<?php echo base_url();?>inventory_tso">
                               Daftar Stok Opname
                              							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>							
							<a href="">
                               Entri Stok Opname
							</a>
						</li>
					</ul>
				</div>
			</div>
            <div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-reorder"></i>*Data Baru
					</div>
					
					
				</div>
				
				<div class="portlet-body form">									
				  <form id="frmpenjualan" class="form-horizontal" method="post">
					<div class="form-body">
					  <div class="tabbable tabbable-custom tabbable-full-width">
					    <ul class="nav nav-tabs">
							<li class="active">
								<a href="#tab1" data-toggle="tab">
                                   <i class="fa fa-file"></i> 
								   Stok Opname
								</a>
							</li>
							<!--li class="">
								<a href="#tab2" data-toggle="tab">                                   
								   <i class="fa fa-info-circle"></i>
								   Info
								</a>
							</li-->
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab1">		
												
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
                                                           <label class="col-md-3 control-label">Petugas</label>
													        <div class="col-md-6">
															  <div class="input-group">
                                                                 <input type="text" name="pic" class="form-control" value="<?= $pic;?>">
															</div>
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
													<tr>													   
                                                       <td width="50%">
														    <select name="kode[]" id="kode1" class="select2_el_barang form-control" onchange="showbarangname(this.value, 1)">															  
															 <option value="">--- Pilih Barang ---</option>
															</select>
														</td>
                                                       
                                                        <td width="20%" ><input name="qty[]"    value="1" id="qty1" type="text" class="form-control rightJustified"  ></td>
														<td width="30%" ><input name="sat[]"    id="sat1" type="text" class="form-control "  onkeypress="return tabE(this,event)"></td>
														
								                      </tr>
                    								
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
							       
								</div>
                                
							</div>
							<!-- tab2-->
							
						</div><!--tab-->	
						
						<div class="row">
							<div class="col-xs-12">
								<div class="well">		
								   
                                   
									<button type="button" onclick="save()" class="btn blue"><i class="fa fa-save"></i> Simpan</button>
									   
									<div class="btn-group">
									  <button type="button" class="btn green" onclick="this.form.reset();location.reload();"><i class="fa fa-pencil-square-o"></i> Data Baru</button>                																							
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
?>

<script>

var idrow  = 2;

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

function showbarangname(str, id) {   
  var xhttp; 
  var vid = id;
   $.ajax({
        url : "<?php echo base_url();?>penjualan_pengiriman/getinfobarang/"+str,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {						
			$('#sat'+vid).val(data.satuan);			
		}
	});	
  
  
}


function save()
{	      
    var noform   = $('[name="pic"]').val(); 
	var tanggal  = $('[name="tanggal"]').val(); 
	if(noform==""){
		swal('STOK OPNAME','Petugas belum diisi ...',''); 
	} else {      
	$.ajax({				
		url:'<?php echo site_url('inventory_tso/save/1')?>',				
		data:$('#frmpenjualan').serialize(),				
		type:'POST',
		success:function(data){        		
		swal({
					  title: "STOK OPNAME",
					  html: "<p> No. SO   : <b>"+noform+"</b> </p>"+ 
					  "Tanggal :  " + tanggal,
					  type: "info",
					  confirmButtonText: "OK" 
					 }).then((value) => {
							location.href = "<?php echo base_url()?>inventory_tso";
		         });								
	
		},
		error:function(data){
			swal('STOK OPNAME','Data gagal disimpan ...',''); 
		}
		});
	}		
}	
   
	function hapus(){
		if(idrow>2){
			var x=document.getElementById('datatable').deleteRow(idrow-1);
			idrow--;
		}
	}

  
  
   
function showpo() {
  var xhttp;
  var str = $('[name="cust"]').val(); 
  
  if (str == "") {
    document.getElementById("kodeso").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("kodeso").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "<?php echo base_url(); ?>penjualan_pengiriman/getlistpo/"+str, true);  
  xhttp.send();
}

function getpo() { 
  var xhttp;      
  var str = $('[name=kodeso]').val();
  if(str==""){
	hapus();
	$('[id=kode1]').val('');
	$('[id=qty1]').val('');
	$('[id=sat1]').val('');
  }  else  {
	$.ajax({
        url : "<?php echo base_url();?>penjualan_pengiriman/getpo/"+str,
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
			  
			  x = i+1;
			  
			  var option = $("<option selected></option>").val(data[i].kodeitem).text(data[i].namabarang);
              $('#kode'+x).append(option).trigger('change');
			  
			  document.getElementById("qty"+x).value=data[i].sisa;		    
			  document.getElementById("sat"+x).value=data[i].satuan;		    
			}
			
			
			
			
		}
	});	    
  }	
}

window.onload = function(){
        document.getElementById('nomorbukti').focus();
};


</script>


							
</body>
</html>

