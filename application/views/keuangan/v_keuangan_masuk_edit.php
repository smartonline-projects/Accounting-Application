<?php 
	$this->load->view('template/header');
    $this->load->view('template/body');    	  	
?>	

<link href="<?php echo base_url()?>assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/clockface/css/clockface.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/bootstrap-datepicker/css/datepicker.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/bootstrap-select/bootstrap-select.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/select2/select2-metronic.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/jquery-multi-select/css/multi-select.css"/>
<link href="<?php echo base_url()?>assets/plugins/data-tables/DT_bootstrap.css" rel="stylesheet" />
<link href="<?php echo base_url()?>assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/css/custom.css" rel="stylesheet" type="text/css"/>


<style>
 
#myInput {
     background-image: url('<?php echo base_url()?>assets/img/search-icon-blue.png'); 
    background-position: 10px 12px; 
    background-repeat: no-repeat; 
    width: 100%; 
    font-size: 14px; 
    padding: 12px 20px 12px 40px;
    border: 1px solid #ddd; 
    margin-bottom: 12px; 
}

#myTable {
    border-collapse: collapse; 
    width: 100%; 
    border: 1px solid #ddd; 
    font-size: 14px;
}

#myTable th, #myTable td {
    text-align: left;
    padding: 5px; 
}

#myTable tr {
    border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
   
    background-color: #f1f1f1;
}

input[type=text]:focus {
    width: 100%;
}


   .rightJustified {
        text-align: right;
    }
    
    .total{
        font-size: 14px;
        font-weight: bold;
        color: blue;
   }
   
.bodycontainer { max-height: 150px; width: 100%; margin: 0; overflow-y: auto; }
.table-scrollable { margin: 0; padding: 0; }

.modal-body {
    max-height:200px; 
    overflow-y: auto;
}
</style>


			<div class="row">
				<div class="col-md-12">
					<h3 class="page-title">
					  Keuangan<small>Entri Penerimaan Kas/Bank </small>
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
							<a href="<?php echo base_url();?>keuangan_masuk">
                               Daftar Penerimaan Kas/Bank
                              							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>							
							<a href="<?php echo base_url();?>keuangan_masuk/entri">
                               Entri Penerimaan Kas/Bank
							</a>
						</li>
					</ul>
				</div>
			</div>
            <div class="portlet box blue">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-reorder"></i>Form Entri Penerimaan
										</div>
										<div class="tools">
											<span class="label label-sm label-danger">										
											  REGISTER : <?php echo $register;?>
											</span>
											 <span class="label label-sm label-warning">										
											  DIBUAT OLEH : <?php echo $userentry;?>
											</span>

										</div>

										
									</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										<form id="frmkeuangan" class="form-horizontal" method="post">
											<div class="form-body">
												
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
                                                            <label class="col-md-3 control-label">Nomor Bukti</label>
													        <div class="col-md-6">
														        
																<div class="input-group">														        
                                                                <input type="text" class="form-control" placeholder="" name="nomorbukti" id="nomorbukti" value="<?php echo $nomor;?>" onkeypress="return tabE(this,event)" readonly>																																															
																															
														   										               
															    </div>
													        </div>

														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
                                                         <div class="form-group">
                                                            <label class="col-md-3 control-label">Tanggal</label>
													        <div class="col-md-6">
														       <div class="input-icon">
															    <i class="fa fa-calendar"></i>
															    <input id="tanggal" name="tanggal" class="form-control date-picker input-medium" type="text" value="<?php echo date('d-m-Y',strtotime($tanggal));?>" data-date="" data-date-format="dd-mm-yyyy" data-date-viewmode="years" placeholder="" onkeypress="return tabE(this,event)"/>
													    	   </div>
													        </div>
													        


														</div>
													</div>
												</div>
												
												<div class="row">
													<!--/span-->
													<div class="col-md-6">
                                                         <div class="form-group">
                                                            <label class="col-md-3 control-label">Kas/Bank</label>
													        <div class="col-md-9">
                                                              <select id="kasbank" name="kasbank" class="form-control input-medium select2me" data-placeholder="Pilih..." onkeypress="return tabE(this,event)">
            												 
                                                            <?php
                                                              foreach($bank as $row)
            												  { ?>
            													<option value="<?php echo $row->kodeakun;?>" <?php if($row->kodeakun==$kasbank) echo 'selected=true'?>><?php echo $row->namaakun;?></option>
                                                            <?php } ?>
            												</select>
													        </div>

														</div>
													</div>
													
													<div class="col-md-6">
                                                         <div class="form-group">
                                                            <label class="col-md-3 control-label">Cabang</label>
													        <div class="col-md-6">
                                                              <select id="unit" name="unit" class="form-control input-medium select2me" data-placeholder="Pilih..." onkeypress="return tabE(this,event)">
            												 
                                                            <?php
                                                              foreach($unit as $row)
            												  { ?>
            													<option value="<?php echo $row->kode;?>" <?php if($row->kode==$unit) echo 'selected=true'?>><?php echo $row->nama;?></option>
                                                            <?php } ?>
            												</select>
													        </div>

														</div>
													</div>
													


												</div>
												
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
                                                            <label class="col-md-3 control-label">Diterima dari</label>
													        <div class="col-md-6">
														        <input type="text" class="form-control input-medium" placeholder="" name="penerima" id="penerima" value="<?php echo $penerima;?>" onkeypress="return tabE(this,event)">
													        </div>

														</div>
													</div>
													
													<div class="col-md-6">
                                                         <div class="form-group">
                                                            <label class="col-md-3 control-label">Keterangan</label>
													        <div class="col-md-9">
														      
																<input type="text" class="form-control input-large" placeholder="" name="keterangan" id="keterangan" value="<?php echo $uraian;?>" onkeypress="return tabE(this,event)">
													        </div>

														</div>
													</div>

												</div>


												
												<div class="row">
												 <div class="col-md-12">
                                                   	<div class="table-responsive" >
							                    	<table class="table table-bordered- table-condensed">
								                    <theads>
                                                      <tr>                    									
                    									<th width="20%" style="text-align: center">Kode Akun</th>
                    									<th width="60%" style="text-align: center">Uraian</th>
                    									<th width="20%" style="text-align: center">Jumlah</th>                    									
                    								  </tr>
                    								</theads>
													</table>
													

													<div class="bodycontainer scrollable">
													<table id="datatable" class="table table-hoverx table-stripedx table-borderedx table-condensed table-scrollable">
																										
                    								<tbody>
													<?php 
													$no=0;
													foreach($detil as $row){?>
													<tr>
													   <td width="20%">
														  <div class="input-group">														        
                                                                <input name="akun[]"  id="akun<?php echo $no;?>" value="<?php echo $row->terimad_akun;?>"  maxlength="20" onfocus='showakunname(this.value, this.id)' onkeyup="showakunname(this.value, this.id)" style="color:blue;"  type="text" class="form-control input-medium" size="100%" onkeypress="return tabE(this,event)">																																																
																<span class="input-group-btn">
																	<a class="btn default" id="<?php echo $no;?>" data-toggle="modal" href="#lupakun" onclick="getid(this.id)"><i class="fa fa-search"></i></a>
																</span>
																
														   										                
															</div>
															<p class="help-block"><span style='color:green;' id="namaakun<?php echo $no;?>"></span></p>	
														</td>
                                                       
                                                        
                                                        <td width="60%" ><input name="ket[]"    value="<?php echo $row->terimad_uraian;?>" type="text" class="form-control " size="100%" onkeypress="return tabE(this,event)"></td>
                                                        <td width="20%" ><input name="jumlah[]" value="<?php echo $row->terimad_jumlah;?>"   type="text" class="form-control rightJustified" size="40%"  onChange="total();formatCurrency(this)" onkeypress="return tabE(this,event);formatCurrency(this)"></td>
                                                       
								                      </tr>
                    								<?php $no++; } ?>
								                    </tbody>
													</table>
													</div>
													<table class="table table-condensed">
								                    <tfoot>
                                                      <tr>
													    <td width="20%"><button type="button" onclick="tambah()" class="btn green"><i class="fa fa-plus"></i> </button>
												        <button type="button" onclick="hapus()" class="btn red"><i class="fa fa-trash-o"></i></button></td>
                                                        <td width="60%" align="right">TOTAL</td>
                                                        <td width="20%"  align="right"><font color="red"><b><span id="_jumlah"></b></font></span></td>
														
														                                                        
														
                                                      </tr>
                                                     </tfoot>
								                    </table>
								                    </div>
								                   </div>
												</div>
												

											<div class="form-actions">
												
												<button type="button" onclick="save()" class="btn blue"><i class="fa fa-save"></i> Simpan</button>
												
												<div class="btn-group">
                                                <div class="btn-group">
													<a href="<?php echo base_url()?>keuangan_masuk/entri" class="btn btn-success">
													<i class="fa fa-plus"></i>
													Data Baru
													</a>
												</div>

											</div>
											<h2><span id="error" style="display:none; color:#F00">Terjadi Kesalahan... </span> <span id="success" style="display:none; color:#0C0">Data sudah disimpan...</span></h2>
                                            <input type="hidden" name="register" id="register" value="<?php echo $register;?>" />
											 
										</form>
									</div>
								</div>
		</div>
	</div>
</div>

						

<?php
  $this->load->view('template/footer');
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

<script>

jQuery(document).ready(function() {
   ComponentsPickers.init();
}); 

var idrow = <?php echo $jumdata;?>;

function tambah(){
    var x=document.getElementById('datatable').insertRow(idrow);
    var td1=x.insertCell(0);
    var td2=x.insertCell(1);
    var td3=x.insertCell(2);
  
	 var akun0="<div class='input-group'>";														        
	 var akun1="<input name='akun[]' style='color:blue;' onfocus='showakunname(this.value, this.id)' onkeyup='showakunname(this.value, this.id)' maxlength='20' type='text' class='form-control' onkeypress='return tabE(this,event)' id=akun"+idrow+">";
	 var akun2="<span class='input-group-btn'>";
	 var akun3="<a class='btn default' data-toggle='modal' href='#lupakun' onClick='getid(this.id)' "+"id="+idrow+"><i class='fa fa-search'></i></a>";	
	 var akun4="</span></div>";
	 var akun5="<p class='help-block'> <span style='color:green;' id=namaakun"+idrow+"></p>";	 
	 var akun=akun0+akun1+akun2+akun3+akun4+akun5;
	
	td1.innerHTML=akun; 
	td2.innerHTML="<input name=ket[]'    type='text' class='form-control'>";
	td3.innerHTML="<input name='jumlah[]'  type='text' class='form-control rightJustified' size='40%' value='0' onChange='total();formatCurrency(this)'>";
    idrow++;
}

function showakun(str) {
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
  xhttp.open("GET", "<?php echo base_url(); ?>keuangan_masuk/getakun/"+str, true);  
  xhttp.send();
}

function showakunname(str,id) {
  var xhttp;
  if (str == "") {
    document.getElementById("nama"+id).innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("nama"+id).innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "<?php echo base_url(); ?>keuangan_masuk/getakunname/"+str, true);  
  xhttp.send();
}

function post_value(v1, v2)
  {	
	 id=document.getElementById("nopilih").value;
	 document.getElementById("akun"+id).value = v1;
	 document.getElementById("namaakun"+id).innerHTML = v2;	 
     document.getElementById("akun"+id).focus();
  }
  

function getid(id)
{
	document.getElementById("nopilih").value = id;
}

function getnobukti(str) {
  var xhttp;
  if (str == "") {
    document.getElementById("nomorbukti").value = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("nomorbukti").value = this.responseText;
    }
  };
 
  xhttp.open("GET", "<?php echo base_url(); ?>keuangan_masuk/getnobukti/"+str, true); 
  xhttp.send();
}

function save()
{	         
            var tanggal   = $('[name="tanggal"]').val();   
        	$.ajax({				
        		
               url:'<?php echo site_url('keuangan_masuk/penerimaan_save/2')?>',					
        		data:$('#frmkeuangan').serialize(),				
        		type:'POST',
        		success:function(data){        		
				swal({
					  title: "PENERIMAAN KAS/BANK",
					  html: "<p> No. Bukti   : <b>"+data+"</b> </p>"+ 
					  "Tanggal :  " + tanggal,
					  type: "info",
					  confirmButtonText: "OK" 
					 }).then((value) => {
							location.href = "<?php echo base_url()?>keuangan_masuk";
		         });							
        	
        		},
        		error:function(data){
        			$("#error").show().fadeOut(5000);
        		}
        		});
        
}	
        
function formatCurrency1(num) {
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
	num = num.substring(0,num.length-(4*i+3))+','+
	num.substring(num.length-(4*i+3));
	return (((sign)?'':'-') + '' + num + '.' + cents);
	//return (((sign)?'':'-') + '' + num);
	}

  function formatCurrency(fieldObj)
    {

        if (isNaN(fieldObj.value)) { return false; }
        fieldObj.value =formatCurrency1(fieldObj.value);
        return true;

    }

   
	function hapus(){
		if(idrow>1){
			var x=document.getElementById('datatable').deleteRow(idrow-1);
			idrow--;
			total();
		}
	}

  function total()
  {
    
   var table = document.getElementById('datatable');
   var rowCount = table.rows.length;

   tjumlah=0;
  
   
   for(var i=0; i<rowCount; i++) 
   {
    var row = table.rows[i];
    
	jumlah      = row.cells[2].children[0].value;
    var jumlah1 = Number(jumlah.replace(/[^0-9\.]+/g,""));

   	tjumlah  = tjumlah  + eval(jumlah1);
		  
    
   }
   document.getElementById("_jumlah").innerHTML=formatCurrency1(tjumlah);


  }
  
  
  
  
function tabE(obj,e){
      var e=(typeof event!='undefined')?window.event:e;// IE : Moz

      if(e.keyCode==13){
         var ele = document.forms[0].elements;

      for(var i=0;i<ele.length;i++){
          var q=(i==ele.length-1)?0:i+1;// if last element : if any other
      if(obj==ele[i]){ele[q].focus();break}
    }
    return false;
    }
    }


window.onload = function(){
        document.getElementById('nomorbukti').focus();
};



</script>

<div class="modal fade" id="lupakun" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<span id="nopilih">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Daftar Perkiraan</h4>
				<input type="text" id="myInput" onkeyup="showakun(this.value)" placeholder="Masukan Kode/ Nama ...">
			</div>
			<div class="modal-body">										 
			  <div id="txtHint"></div>
			</div>   
			<div class="modal-footer">	                                        
				<button type="button" id="btntutup" class="btn red" data-dismiss="modal">Tutup</button>																			
			</div>											
		</div>									
	</div>								
</div>

</body>
</html>