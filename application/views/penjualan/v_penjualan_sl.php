<?php 
	$this->load->view('template/headerfull');
    $this->load->view('template/bodyfull');    	  
?>	

<link href="<?php echo base_url()?>assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/clockface/css/clockface.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/bootstrap-datepicker/css/datepicker.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/bootstrap-select/bootstrap-select.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/select2/select2-metronic.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/jquery-multi-select/css/multi-select.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<link href="<?php echo base_url()?>assets/plugins/data-tables/DT_bootstrap.css" rel="stylesheet" />
<link href="<?php echo base_url()?>assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/css/custom.css" rel="stylesheet" type="text/css"/>
			
<style>	
	div.tableContainer {
		clear: both;
		border: 0px solid #963;
		height: 100px;
		overflow: auto;
		width: 100%
	}

	html>body div.tableContainer {
		overflow: hidden;
		width: 100%
	}


	div.tableContainer table {
		float: left;	
	}


	html>body div.tableContainer table {

	}


	thead.fixedHeader tr {
		position: relative;
	}

	thead.fixedHeader th {
		background: #C96;
		border-left: 1px solid #EB8;
		border-right: 1px solid #B74;
		border-top: 1px solid #EB8;	
		padding: 4px 3px;
		text-align: left
	}

	html>body tbody.scrollContent {
		display: block;
		height: 100px;
		overflow: auto;
		width: 100%
	}

	html>body thead.fixedHeader {
		display: table;
		overflow: auto;
		width: 100%
	}


	tbody.scrollContent td, tbody.scrollContent tr.normalRow td {
		background: #FFF;
		border-bottom: 0px solid #CCC;
		border-left: 0px solid #CCC;
		border-right: 0px solid #CCC;
		border-top: 0px solid #DDD;
		padding: 2px 3px 3px 4px
	}


	tbody.scrollContent tr.alternateRow td {
		background: #EEE;
		border-bottom: none;
		border-left: none;
		border-right: 1px solid #CCC;
		border-top: 1px solid #DDD;
		padding: 2px 3px 3px 4px
	}

	</style>	
	
			<div class="row profiles">
				<div class="col-md-12">
					<!--div class="tabbable tabbable-custom tabbable-full-width"-->
						
						<div class="tab-content">
							<div class="tab-pane active" id="tab1">
								<div>
									<div class="portlet box blue">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-reorder"></i>Penjualan
										</div>
										<div class="tools">											
											<a href="<?php echo base_url();?>dashboard" class="remove">
											</a>
										</div>
									</div>
									
									<div class="portlet-body form">
										<form id="frmentry0" action="#" class="form-horizontal" method="post">
											<div class="form-body">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
                                                            <label class="col-md-3 control-label">SI No.</label>
													        <div class="col-md-6">
														        <input type="text" class="form-control input-small" value="<?php echo $nosi;?>" name="nosi" readonly>
													        </div>

														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
                                                         <div class="form-group">
                                                            <label class="col-md-3 control-label">Tanggal</label>
													        <div class="col-md-6">
														       <div class="input-icon">
															    <i class="fa fa-calendar"></i>
															    <input id="tanggal" name="tanggal" class="form-control date-picker input-small" type="text" value="<?php echo date('d-m-Y')?>" data-date="" data-date-format="dd-mm-yyyy" data-date-viewmode="years" placeholder="" onkeypress="return tabE(this,event)"/>
													    	   </div>
													        </div>
													        


														</div>
													</div>
												</div>
												
												<div class="row">												
													<div class="col-md-6">
                                                         <div class="form-group">
                                                            <label class="col-md-3 control-label">Kode Cust</label>
													        <div class="col-md-6">
															  <div class="input-group">														        
                                                              <select name="cust" class="form-control input-large select2me"  onchange="getcustomer(this.value)">            											
															  <option value="">-- Pilih ---</option>
                                                              <?php 
									                            foreach($cust  as $row){?>
            													<option value="<?php echo $row->kode;?>"><?php echo $row->kode.' - '.$row->nama;?></option>
                                                            <?php } ?>
            												</select>
																<span class="input-group-btn">
																	<!--a class="btn green" id="0" data-toggle="modal" href="#form_customer" ><i class="fa fa-plus"></i>   Add Cust</a-->
																	<button type="button" class="btn btn-primary" onclick="add_customer()" id="btnSave2">Add Cust</button>
																	
																</span>
																
														   										                
														      </div> 
                                                              
													        </div>

														</div>
													</div>
												</div>
	   											<div class="row">
													<div class="col-md-6">
                                                         <div class="form-group">
                                                            <label class="col-md-3 control-label">Nama</label>
													        <div class="col-md-9">
														        <input type="text" class="form-control"  name="namacust" disabled>
																<input type="hidden"  name="tipecust">
													        </div>
														</div>
													</div>													
												</div>
												<div class="row">
													<div class="col-md-6">
                                                         <div class="form-group">
                                                            <label class="col-md-3 control-label">Alamat 1</label>
													        <div class="col-md-9">
														        <input type="text" class="form-control"  name="alamat1"  disabled>
													        </div>

														</div>
													</div>													
												</div>
												<div class="row">
													<div class="col-md-6">
                                                         <div class="form-group">
                                                            <label class="col-md-3 control-label">Alamat 2</label>
													        <div class="col-md-9">
														        <input type="text" class="form-control"  name="alamat2" disabled>
													        </div>

														</div>
													</div>													
												</div>
												<div class="row">
													<div class="col-md-6">
                                                         <div class="form-group">
                                                            <label class="col-md-3 control-label">HP</label>
													        <div class="col-md-9">
														        <input type="text" class="form-control"  name="hpcust" disabled>
													        </div>

														</div>
													</div>													
												</div>
												
												
												
                    						<div class="form-actions">
	                                            <div class="col-md-6">
												<div class="form-group">
												<label class="col-md-3 control-label"></label>
												
												<a href="#tab2" onclick="NextPage()" data-toggle="tab" class="btn green button-next">
														 Next
												</a>												
											</div>
											    </div>
												</div>
											
										</form>
									</div>
								</div>
		</div>
								</div>
							</div>
							<div class="tab-pane" id="tab2">
									<div class="portlet box blue">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-reorder"></i>Penjualan
										</div>
										<div class="tools">											
											<a href="#" onclick="location.reload()" class="remove">
											</a>
										</div>
										
									</div>
									<div class="portlet-body form">
										<form id="frmentry" action="#" class="form-horizontal" method="post">
											<div class="form-body">
											<div id="tableContainer" class="tableContainers">
											  <table border="0" class="table" cellspacing="0" >
											   <tr>											    
											    <th width="10%">SI No.</th>
												<th width="1%">:</th>
												<th width="20%"><span class="form-controls input-small" name="nosi2"></span></th>
												<input type="hidden" name="kodesi" value=<?php echo $nosi;?>>
												<th width="10%"></th>
												<th width="10%">Jumlah</th>
												<th width="1%">:</th>
												<th width="10%" style="text-align:right"><span class="form-controls input-small" name="kjumlah" id="kjumlah"></span></th>
												<th></th>
											   </tr>	
											   <tr>
											    <td>Tanggal</td>
												<td>:</td>
												<td><span class="form-controls input-small" name="tanggal2"></span></td>
												<input type="hidden" name="tanggal2e">
												<td></td>
												<td>Disc</td>
												<td>:</td>
												<td><input type="text" class="form-controls input-small" id="disctot" name="disctot" value="0" onclick="totalsi()" onchange="totalsi()"></td>
											    <td></td>
											   </tr>
												<tr>
											    <td>Kode Cust</td>
												<td>:</td>
												<td><span class="form-controls" name="cust2"></span></td>
												<input type="hidden" name="cust2e">
												<td></td>
												<td>Ongkir</td>
												<td>:</td>
												<td><input type="text" class="form-controls input-small" id="ongkir" name="ongkir" value="0" onchange="totalsi()" onclick="totalsi()"></td>
												<td></td>
											   </tr>
											   <tr>
											    <td>Nama</td>
												<td>:</td>
												<td><label name="nama2"></label></td>
												<td></td>
												<td style="font-size:16px;"><b><i>Total</b></i></td>
												<td>:</td>
												<td style="font-size:16px;text-align:right"><b><span id="ktotal" name="ktotal"></span></b></td>
												<td></td>
											   </tr>
											  </table>
											</div>
												
												
                    						
										 </div>	
										 
										 <div class="row">
												 <div class="col-md-12">
                                                   
							                    	<table class="table table-bordereds">
								                      <tr>                    								
                    									<th width="10%" style="text-align: center">Kode Item</th>														
                    									<th width="20%" style="text-align: center">Jenis Barang</th>
                    									<th width="6%" style="text-align: center">Sat</th>
                    									<th width="6%" style="text-align: center">Qty</th>
														<th width="10%" style="text-align: center">Harga</th>
														<th width="6%" style="text-align: center">Disc</th>
														<th width="10%" style="text-align: center">Harga</th>
														<th width="2%" style="text-align: center">Sj</th>
														<th width="2%" style="text-align: center">Action</th>
														<th width="32%" style="text-align: center"></th>
                    								</tr>
                    								</table>
													<div id="_entry"></div>

													<table class="table table-bordereds">
													  <tr>
													
														<td width="10%">
														    <select name="kodeitem" class="form-control select2me"  onchange="getproduk(this.value)">            											
															  <option value="">-- Item ---</option>
                                                              <?php 
									                            foreach($item  as $row){?>
            													<option value="<?php echo $row->kodeitem;?>"><?php echo $row->kodeitem.' - '.$row->namabarang;?></option>
                                                              <?php } ?>
            												</select>								                
														
														</td>
																									                                                       
                                                        <td width="19%" >
														    <input name="namabarang" type="text" class="form-control" readonly>															
														</td>
                                                        <td width="6%" ><input name="sat"   type="text" class="form-control rightJustified" readonly></td>
                                                        <td width="6%" ><input name="qty"  id="qty" type="text" class="form-control rightJustified"  value="1" onkeypress="totalline()" onchange="totalline();;next_item(2)"></td>
														<td width="10%" ><input name="harga"  type="text" class="form-control rightJustified" value="0" onchange="totalline()" onkeypress="return tabE(this,event);totalline()" readonly></td>
														<td width="6%" ><input name="disc"  type="text" class="form-control rightJustified"  value="0" onchange="totalline()" onkeypress="return tabE(this,event);totalline()"></td>
														<td width="10%" ><input name="total"  type="text" class="form-control rightJustified" readonly></td>
														<td width="2%" ><input name="sj"  type="checkbox" class="form-controls"></td>
														<td width="2%" ><a class="btn btn-sm btn-success" onclick="save();"><i class="glyphicon glyphicon-plus"></i></a></td>
														<td width="32%" ></td>
														<input type="hidden" name="hpp">
								                      </tr>
													</table>
													</div>
								                   </div>
												   <div class="form-actions">
												    <p align="center"> 
													<button type="button" class="btn btn-primary" onclick="simpanhdr()" id="btnSave2">Simpan</button>
                                                    <button type="button" class="btn btn-danger"  onclick="batalsi()">Batal</button>											
													</p>
													
											       </div>
												
											   
												</div>
												
										</form>
									</div>
								</div>
		</div>
									

										
								</div>
							<!--/div-->
						</div>
					</div>
				</div>
			</div>
		</div>

<?php
  //$this->load->view('template/footero');
?>

<script src="<?php echo base_url()?>assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/bootstrap/js/bootstrap2-typeahead.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/clockface/js/clockface.js"></script>
<script src="<?php echo base_url()?>assets/scripts/custom/components-dropdowns.js"></script>
<script src="<?php echo base_url()?>assets/scripts/custom/components-pickers.js"></script>
<script src="<?php echo base_url()?>assets/scripts/custom/form-wizard.js"></script>
<script src="<?php echo base_url()?>assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/scripts/core/app.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/scripts/custom/jam.js" type="text/javascript"></script>
<script>

var subtotal;

function next_item(no){
	if (no==1){
	  $('[name="qty"]').focus();
	} if (no==2){
	  $('[name="disc"]').focus();
	} 
} 


function getcustomer(str) { 
  var xhttp;      
	$.ajax({
        url : "<?php echo base_url();?>penjualan_sl/getcustomer/"+str,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {					
            $('[name="namacust"]').val(data.nama);						
			$('[name="alamat1"]').val(data.alamat1);						
			$('[name="alamat2"]').val(data.alamat2);						
			$('[name="hpcust"]').val(data.hp);	
			$('[name="tipecust"]').val(data.tipe);							
		}
	});	    
}

function getproduk(str) { 
  var tipecust = $('[name="tipecust"]').val();
  var xhttp;      
	$.ajax({
        url : "<?php echo base_url();?>penjualan_sl/getproduk/"+str,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {					
		    $('[name="namabarang"]').val(data.namabarang);						
			$('[name="sat"]').val(data.satuan);						
			$('[name="hpp"]').val(data.hpp);						
			if (tipecust==1){
			   $('[name="harga"]').val(data.hargajual1);							
			} else 
			if (tipecust==2){
			   $('[name="harga"]').val(data.hargajual2);							
			} else 
			if (tipecust==3){
			   $('[name="harga"]').val(data.hargajual3);							
			}
			totalline();	
			getpromo(str);
		}
	});	    
}

function getpromo(str) {   
  var tipecust = $('[name="tipecust"]').val();
  var namabarang= $('[name="namabarang"]').val(); 
  var xhttp;      
	$.ajax({	
        url : "<?php echo base_url();?>penjualan_sl/getpromo/"+str,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {	
		    $('#formpromo')[0].reset(); 
            $('[name="kodeitem_promo"]').val(data.kodeitem);						
            $('[name="namabarang_promo"]').val(namabarang);						
			$('[name="sat_promo"]').val(data.satuan);						
			$('[name="qty_promo"]').val(data.qty);						
			$('[name="kodeitem_bonus"]').val(data.bnsitem);						
			$('[name="sat_bonus"]').val(data.bnssat);						
			$('[name="qty_bonus"]').val(data.bnsqty);						
			$('[name="namabarang_bonus"]').val(data.namabarang);						
			
			if (tipecust==1){
			   $('[name="harga_promo"]').val(data.hrg1);							
			   $('[name="harga_bonus"]').val(data.bnshrg1);							
			} else 
			if (tipecust==2){
			   $('[name="harga_promo"]').val(data.hrg2);							
			   $('[name="harga_bonus"]').val(data.bnshrg2);							
			} else 
			if (tipecust==3){
			   $('[name="harga_promo"]').val(data.hrg3);
               $('[name="harga_bonus"]').val(data.bnshrg3);										   
			}
			
			
			
			if (data.kodeitem!=''){
				$('#form_promo').modal('show'); 
				$('.modal-title').text('Promo'); 
			};
			

			
		}
	});
}



function status_promo() {   
  var kodeitem = $('[name="kodeitem"]').val();
  var xhttp;
  var hasil;
  if (kodeitem == "") {
    return 0;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    hasil =  this.responseText;
	
    }
  };
  xhttp.open("GET", "<?php echo base_url(); ?>penjualan_sl/statuspromo/"+kodeitem, true);  
  xhttp.send();
  
  return hasil;
  
}


function resetentry(){
	$('[name="kodeitem"]').val('');						
	$('[name="namabarang"]').val('');						
	$('[name="qty"]').val(1);
    $('[name="harga"]').val(0);							
	$('[name="disc"]').val(0);						
	$('[name="total"]').val(0);						
	$('[name="kodeitem"]').focus();
	
}

function showentry() {
  var nosi = $('[name="nosi"]').val();
  
  if(nosi==''){
	alert('nomor SI kosong ...');  
  } else {
  var str = nosi;  
  var xhttp;
  if (str == "") {
    document.getElementById("_entry").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("_entry").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "<?php echo base_url(); ?>penjualan_sl/getentry/"+str, true);  
  xhttp.send();
  }
  totalsi();
}

function formatCurrency(num) {
	num = num.toString().replace(/\$|\,/g,'');
	if(isNaN(num))
	num = "0";
	sign = (num == (num = Math.abs(num)));
	num = Math.floor(num*100+0.50000000001);
	cents = num%100;
	num = Math.floor(num/100).toString();
	if(cents<10)
	cents = "0" + cents;
	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
	num = num.substring(0,num.length-(4*i+3))+'.'+
	num.substring(num.length-(4*i+3));
	//return (((sign)?'':'-') + '' + num + '.' + cents);
	return (((sign)?'':'-') + '' + num);
}
	
function totalsi(){
  var nosi = $('[name="nosi"]').val();
  var ongkir = $('[name="ongkir"]').val();
  var diskon = $('[name="disctot"]').val();
  var str = nosi;  
  var xhttp;
  if (str == "") {
    document.getElementById("kjumlah").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("kjumlah").innerHTML = formatCurrency(this.responseText);
	document.getElementById("ktotal").innerHTML = formatCurrency(parseInt(this.responseText)+parseInt(ongkir)-parseInt(diskon));
    }
  };
  xhttp.open("GET", "<?php echo base_url(); ?>penjualan_sl/gettotalsi/"+str, true);  
  xhttp.send();    
}

function totalline(){
  var stot = $('[name="qty"]').val()*$('[name="harga"]').val();
  var disk = ($('[name="disc"]').val()/100)*stot;
  var gtot = stot - disk;
  $('[name="total"]').val(gtot);  
  totalsi();  
  $('[name="disctot"]').change();
}

function save()
{
 
    var url;

    url = "<?php echo site_url('penjualan_sl/ajax_add')?>";
    
    $.ajax({
        url : url,
        type: "POST",
        data: $('#frmentry').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                showentry();
				resetentry();
            }
            else
            {               
				
            }
          


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
           

        }
    });
}


function ambilpromo()
{
 
    var url;

    url = "<?php echo site_url('penjualan_sl/ajax_add_promo')?>";
    
    $.ajax({
        url : url,
        type: "POST",
        data: $('#formpromo').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) {
				$('#form_promo').modal('hide');				
                showentry();				
            }
            else {               				
            }          
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');           
        }
    });
}

function simpanhdr()
{
	
    $('#btnSave2').text('Simpan...'); //change button text
    $('#btnSave2').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('penjualan_sl/ajax_add_header')?>";
    
    $.ajax({
        url : url,
        type: "POST",
        data: $('#frmentry').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) 
            {
                showentry();
				resetentry();
				$('[name="disctot"]').change();
				location.reload();
            }
            else
            {               
				
            }
            $('#btnSave2').text('Simpan'); //change button text
            $('#btnSave2').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave2').text('Simpan'); //change button text
            $('#btnSave2').attr('disabled',false); //set button enable 

        }
    });
	
}

function delete_data(id)
{
    if(confirm('Yakin item barang ini akan dihapus ?'))
    {
        $.ajax({
            url : "<?php echo site_url('penjualan_sl/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                
                //reload_table();
				showentry();
				
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}

function update_data(id, kirim)
{
	if(kirim){
		ket = 'akan dibawa sendiri ?';
		skirim = 'Y';
	} else {
		ket = 'batal dibawa sendiri ?';
		skirim = 'T';
	}
    if(confirm('Yakin item barang ini '+ket))
    {
		var param = id+'~'+skirim;
		
        $.ajax({
            url : "<?php echo site_url('penjualan_sl/ajax_kirim')?>/"+param,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                
				showentry();
				
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}


function batalsi()
{
	var id = $('[name="nosi"]').val();
    if(confirm('Yakin Si '+id+' ini akan dibatalkan ?'))
    {
        $.ajax({
            url : "<?php echo site_url('penjualan_sl/ajax_delete_all')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {                               
				showentry();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}

function NextPage(){	
	var nosi = $('[name="nosi"]').val();
	var tanggal= $('[name="tanggal"]').val();
	var cust= $('[name="cust"]').val();
	var nama= $('[name="namacust"]').val();
	if(cust!=''){
		
	$('[name="nosi2"]').text(nosi);						
	$('[name="tanggal2"]').text(tanggal);						
	$('[name="cust2"]').text(cust);						
	$('[name="nama2"]').text(nama);	
	$('[name="tanggal2e"]').val(tanggal);						
	$('[name="cust2e"]').val(cust);						
	showentry();	
	totalsi();
	} else {
		alert('Customer belum dipilih...');
		location.reload();
	}
}


jQuery(document).ready(function() {      
    FormWizard.init();
	ComponentsPickers.init(); 
    
   
});

function savecustomer()
{
    $('#btnSaveCustomer').text('saving...'); //change button text
    $('#btnSaveCustomer').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('penjualan_cs/ajax_add')?>";
    
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#formcustomer').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#form_customer').modal('hide');
                location.reload();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSaveCustomer').text('Simpan'); //change button text
            $('#btnSaveCustomer').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSaveCustomer').text('save'); //change button text
            $('#btnSaveCustomer').attr('disabled',false); //set button enable 

        }
    });
}

function add_promo()
{
    $('#formpromo')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string	
	$('#form_promo').modal('show'); 
    $('.modal-title').text('Promo'); 
}

function add_customer()
{
    $('#formcustomer')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
	
	$('#form_customer').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Customer'); // Set Title to Bootstrap modal title
}



</script>

<div class="modal fade" id="form_promo" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Data Promo</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="formpromo" class="form-horizontal">
                    <div class="form-body">
					<input type="hidden" name="kodesi" value=<?php echo $nosi;?>>
					 <div class="row">
					 <table class="table table-bordereds">
					      <tr>
						
							<td width="10%">
							  <input name="kodeitem_promo"  style="color:blue;"  type="text"  class="form-control" readonly>																																																
							</td>
																															   
							<td width="19%" >
								<input name="namabarang_promo" type="text" class="form-control" readonly>															
							</td>
							<td width="6%" ><input name="sat_promo"   type="text" class="form-control rightJustified" readonly></td>
							<td width="6%" ><input name="qty_promo"  id="qty" type="text" class="form-control rightJustified"  readonly></td>
							<td width="10%" ><input name="harga_promo"  type="text" class="form-control rightJustified" readonly></td>
							
						  </tr>
						  <tr><td>Bonus</td></tr>
						  <tr>
						
							<td width="10%">
							  <input name="kodeitem_bonus"  style="color:blue;"  type="text" class="form-control" readonly>																																																
							</td>
																															   
							<td width="19%" >
								<input name="namabarang_bonus" type="text" class="form-control" readonly>															
							</td>
							<td width="6%" ><input name="sat_bonus"   type="text" class="form-control rightJustified" readonly></td>
							<td width="6%" ><input name="qty_bonus"  id="qty" type="text" class="form-control rightJustified"  readonly></td>
							<td width="10%" ><input name="harga_bonus"  type="text" class="form-control rightJustified" readonly></td>
							
						  </tr>
						</table>  
					   
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="ambilpromo()" class="btn btn-primary">Ambil</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
		  </div>	
        </div>
    </div>
</div>


<div class="modal fade" id="form_customer" role="dialog">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Data customer</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="formcustomer" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
					
					  <div class="row">
					   <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">Kode</label>
                            <div class="col-md-6">
                                <input name="kode" placeholder="Kode" class="form-control input-small" maxlength="10" type="text"> 
                                <span class="help-block"></span>								
                            </div>
                        </div>
                       </div> 
					   <div class="col-md-6">
						<div class="form-group">
                            <label class="control-label col-md-3">Tipe Customer</label>
                            <div class="col-md-3">
                                <select name="tipe" class="form-control">
								  <option value="1">Perorangan</option>
								  <option value="2">Pemborong</option>
								  <option value="3">Toko</option>
								</select>
                            </div>
							<label class="control-label col-md-3">Kredit</label>
                            <div class="col-md-3">
                                <select name="kredit" class="form-control">
								  <option value="Y">Ya</option>
								  <option value="T" selected>Tidak</option>
								  
								</select>
                            </div>
                        </div>
					  </div>	
					  </div>	
					  
					  <div class="row">
					   <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama</label>
                            <div class="col-md-9">
                                <input name="nama" placeholder="Nama customer" class="form-control" type="text">
                                
                            </div>
                        </div>
					   </div>	
					   <div class="col-md-6">
						<div class="form-group">
                            <label class="control-label col-md-3">Telpon</label>
                            <div class="col-md-3">
                                <input name="telp" placeholder="Nomor Telp" class="form-control" maxlength="16" type="text">                                
                            </div>
							<label class="control-label col-md-3">Fax</label>
                            <div class="col-md-3">
                                <input name="fax" placeholder="Nomor fax" class="form-control" maxlength="16" type="text">
                                
                            </div>
							
                        </div>
					   </div>	
					  </div>	
					  
					  <div class="row">
					   <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">KTP</label>
                            <div class="col-md-3">
                                <input name="ktp" placeholder="Nomor KTP" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
							<label class="control-label col-md-3">Handphone</label>
                            <div class="col-md-3">
                                <input name="hp" placeholder="Nomor HP" class="form-control" maxlength="16" type="text">
                                
                            </div>
                        </div>
					   </div>	
					   <div class="col-md-6">
					     <div class="form-group">
						   <label class="control-label col-md-3">Kontak</label>
                            <div class="col-md-3">
                                <input name="contactname" placeholder="Nama Kontak Person" class="form-control" maxlength="40" type="text">
                                
                            </div>
							<label class="control-label col-md-3">Email</label>
                            <div class="col-md-3">
                                <input name="email" placeholder="Alamat email" class="form-control" maxlength="40" type="text">
                                
                            </div>
							
					   </div>	
					  </div>
					  </div>
					  
					  
					  <div class="row">
					   <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">Alamat 1</label>
                            <div class="col-md-9">
                                <input name="alamat1" placeholder="Alamat customer" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
					   </div>	
					   <div class="col-md-6">
						<div class="form-group">
                            <label class="control-label col-md-3">Alamat 2</label>
                            <div class="col-md-9">
                                <input name="alamat2" placeholder="Alamat customer" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
					   </div>	
					  </div>
					  
					  
					  
					  <div class="row">
					   <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">Kota</label>
                            <div class="col-md-3">
                                <input name="kota" placeholder="Nama Kota" class="form-control" type="text">
                              
                            </div>
							<label class="control-label col-md-3">Kode Pos</label>
                            <div class="col-md-3">
                                <input name="kodepos" placeholder="" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
					   </div>	
					   <div class="col-md-6">
						<div class="form-group">
                            <label class="control-label col-md-3">NPWP</label>
                            <div class="col-md-3">
                                <input name="npwp" placeholder="No. NPWP" class="form-control" type="text">                                
                            </div>
							<label class="control-label col-md-3">Sales</label>
                            <div class="col-md-3">
                                <input name="sales" placeholder="Kode Sales" class="form-control" maxlength="16" type="text">
                                
                            </div>
                        </div>
					   </div>	
					  </div>
					  
					  
					  
					  <div class="row">
					   <div class="col-md-6">
                        <div class="form-group">
						    
                            <label class="control-label col-md-3">Batas Kredit</label>
                            <div class="col-md-9">
                                <input name="bataskredit" placeholder="" class="form-control" type="text">                                
                            </div>
							
                        </div>
					   </div>	
					   <div class="col-md-6">
						<div class="form-group">
                            <label class="control-label col-md-3">T.O.P</label>
                            <div class="col-md-9">
                                <input name="top" placeholder="" class="form-control"  type="text">
                                
                            </div>
                        </div>
					   </div>	
					  </div>
                        
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSaveCustomer" onclick="savecustomer()" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->			



</body>
</html>
