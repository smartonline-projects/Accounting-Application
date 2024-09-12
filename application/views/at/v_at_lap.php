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
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<link href="<?php echo base_url()?>assets/plugins/data-tables/DT_bootstrap.css" rel="stylesheet" />
<link href="<?php echo base_url()?>assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/css/custom.css" rel="stylesheet" type="text/css"/>

			<div class="row">
				<div class="col-md-12">
                    <h3 class="page-title">
					Aktiva Tetap <small>Laporan</small>
					</h3>
					<ul class="page-breadcrumb breadcrumb">

						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url()?>dashboard">
                               Awal
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="">
                              Aktiva Tetap
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="">
                              Laporan
							</a>
						</li>
						<!--li class="btn-group"">
						    <a href="#" class="btn default yellow-stripe" id="help"><i class="fa fa-info"></i></a>
						</li-->
					</ul>
					
				</div>
			</div>
			<div class="tab-pane" id="tab_1_3">
								<div class="row profile-account">
									<div class="col-md-3">
										<ul class="ver-inline-menu tabbable margin-bottom-10">
											<li class="active">
												<a data-toggle="tab" href="#tab_1-1">
													<i class="fa fa-angle-double-right"></i> Jenis Aktiva Tetap
												</a>
												<span class="after">
												</span>
											</li>
											<li>
												<a data-toggle="tab" href="#tab_2-2">
													<i class="fa fa-angle-double-right"></i> Daftar Aktiva Tetap
												</a>
											</li>
										</ul>
									</div>
									<div class="col-md-9">
										<div class="tab-content">
										  <div id="tab_1-1" class="tab-pane active">
												<form name="frmlap1" id="frmlap1" role="form" action="#">
                                                  <table class="table table-bordered1 table-striped1">                                                   
                                                   
            										


                                                 </table>
													<div class="margiv-top-10">
														<a class="btn green print_laporan" onclick="cetak_lap1()">Cetak Laporan</a> 
														<a class="btn red export_laporan" id="1" data-toggle="modal">Export Ke Excel</a> 
													</div>
												</form>
											</div>
										
											
											<div id="tab_2-2" class="tab-pane">
											    <form name="frmlap2" id="frmlap2" role="form" action="#">
                                                  <table class="table table-bordered1 table-striped1">
                                                    <tr>
                                                      <td class="success">Cabang</td>
                                                      <td class="warning">
                                                      <select id="pasar2" name="pasar2" class="form-control input-sm select2me input-medium " data-placeholder="Pilih...">
            												
                                                            <?php
            												  foreach ($unit as $row)
            												  {
            												?>
            													<option value="<?php echo $row->kode;?>"><?php echo $row->kode.' - '.$row->nama;?></option>
                                                            <?php } ?>
            												</select>
            										  </td>

            										</tr>
                                                    <tr>
                                                       <td class="success">Periode Data</td>
                                                       <td class="warning">
													   <div class="row form-group">
                                                        <div class="col-md-3">

                                                         <select id="bulan" name="bulan" class="form-control input-sm select2me input-small"  data-placeholder="Pilih...">                                                         
                                                         <?php
														   $nbln=array('','JANUARI','PEBRUARI','MARET','APRIL','MEI','JUNI','JULI','AGUSTUS','SEPTEMBER','OKTOBER','NOPEMBER','DESEMBER');	
                                                           for($i=1;$i<=12;$i++)
                                                           {
                                                             if($bulan==$i)
                                                             { ?>
                                                               <option value="<?php echo $i;?>" selected='true'><?php echo $nbln[$i];?></option>
                                                             <?php
                                                             } else
                                                             {
                                                             ?>
                                                               <option value="<?php echo $i;?>"><?php echo $nbln[$i];?></option>
                                                             <?php
                                                             }
                                                           }

                                                         ?>

            											</select>

            										</div>
            										<div class="col-md-4">
                                                          <input type="text" size="5" name="tahun" id="tahun" class="form-control input-small" value="<?php echo $tahun;?>"/>
            										</div>
													</div>
            										
            									       </td>
            										</tr>


                                                 </table>
													<div class="margiv-top-10">
														<a class="btn green print_laporan"  onclick="cetak_lap2()" id="2" >Cetak Laporan</a> 
														<a class="btn red export_laporan" id="2" data-toggle="modal">Export Ke Excel</a> 
													</div>
												</form>

											</div>
											

                                    

                                    

                               </div>
                 </div>
				</div>
		</div>
	</div>
</div>

<?php  
   $this->load->view('template/footer');
   $this->load->view('template/v_report');
  
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
    
	function cetak_lap1(){
	  window.open('<?php echo base_url();?>at_lap/cetak/1','_blank')	
	  
	}
	
	function cetak_lap2(){
	  var param = '2'+'~'+$('#pasar2').val()+'~'+$('#bulan').val()+'~'+$('#tahun').val();	
	  window.open('<?php echo base_url();?>at_lap/cetak/'+param,'_blank')	
	  
	}
	
	
	
	$(document).ready(function() {
		
		
		$('.export_laporan').on("click", function(){		
		if(this.id==1)		
		{	
		var param = this.id;
		} else
		if(this.id==2)		
		{	
		var param = this.id+'~'+$('#pasar2').val()+'~'+$('#bulan').val()+'~'+$('#tahun').val();
		}
		
		location.href="<?php echo base_url()?>at_lap/export/"+param;
		});	
		
		
	});
	
	
	
	 jQuery(document).ready(function() {
        ComponentsPickers.init();
        });
	
	
	
</script>
