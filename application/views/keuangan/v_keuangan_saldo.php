  <?php 
	  $this->load->view('template/header');
      $this->load->view('template/body');    	  
	?>	

	
	<link href="<?php echo base_url('css/font_css.css')?>" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url('assets/plugins/uniform/css/uniform.default.css')?>" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url('assets/plugins/select2/select2.css')?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('assets/plugins/select2/select2-metronic.css')?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('assets/plugins/data-tables/DT_bootstrap.css')?>" rel="stylesheet" />
	<link href="<?php echo base_url('assets/css/custom.css')?>" rel="stylesheet" type="text/css"/>
	
			<div class="row">
				<div class="col-md-12">
					<h3 class="page-title">
					  Keuangan <small>Saldo Awal Kas/Bank</small>
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
							<a href="#">
                               Keuangan
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">
                               Saldo Awal Kas/Bank
							</a>
						</li>
					</ul>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="portlet">
						<div class="portlet-title">
							<div class="caption">
                                Daftar Saldo Kas/Bank
                                <span class="label label-sm label-warning">
                                <?php 
								  $bulan  = $this->m_global->_periodebulan();
								  $nbulan = $this->m_global->_namabulan($bulan);
								echo 'Periode '.$nbulan.'-'.$this->m_global->_periodetahun();?>
                                </span>
							</div>

						</div>
						<div class="portlet-body">
							<div class="table-toolbar">
								<div class="btn-group">
                                    <br />
								</div>
							<div class="btn-group pull-right">
									<button class="btn dropdown-toggle" data-toggle="dropdown">Data<i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu pull-right">
										<li>
											<a href="keuangan_tutupsaldo.php">
                                                 Tutup Saldo
											</a>
										</li>

									</ul>
								</div>
								</div>
							</div>
							<table class="table table-striped table-hover table-bordered" id="keuangan-saldo">
                            <thead>
                                     <tr>
                                         <th style="text-align: center">Kode</th>
                                         <th style="text-align: center">Nama</th>
                                         <th style="text-align: center">No. Rekening</th>
                                         <th style="text-align: center">Saldo Awal</th>
                                         <th>&nbsp</th>
                                         <th>&nbsp</th>                                      

                                     </tr>
                                     </thead>
                                     <tbody>
                                   
									<?php 
									foreach($keu->result_array() as $db){?>
                                    <tr class="show1" id="row_<?php echo $db['bank_kode'];?>" >
                                         <td align="center"><?php echo $db['bank_kode'];?></td>
                                         <td><?php echo $db['bank_nama'];?></td>
                                         <td><?php echo $db['bank_norek'];?></td>
                                         <td align="right"><?php echo number_format($db['saldo_awal'],2,'.',',');?></td>
                                         <td><a class="edit" href="javascript:;">Edit</a></td>
                                         <td><a class="edit" href="javascript:;">&nbsp</a></td>
                                     </tr>
                                     <?php } ?>


                                     </tbody>
                                     <tfoot>
                                       <td colspan="3" style="text-align:right">Total:</td>
                                       <td style="text-align:right"></td>
                                       <td colspan="2"></td>
                                     </tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


<?php
  $this->load->view('template/footero');
?>
	

<script src="<?php echo base_url('assets/plugins/jquery-migrate-1.2.1.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/jquery.blockui.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/jquery.cokie.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/uniform/jquery.uniform.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/select2/select2.min.js')?>" type="text/javascript" ></script>
<script src="<?php echo base_url('assets/plugins/data-tables/jquery.dataTables.js')?>" type="text/javascript" > </script>
<script src="<?php echo base_url('assets/plugins/data-tables/DT_bootstrap.js')?>" type="text/javascript" ></script>
<script src="<?php echo base_url('assets/scripts/core/app.js')?>"></script>

<script>

function currencyFormat (num) {
    //return "Rp" + num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    return "" + num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}

var TableEditable = function () {

    return {

        //main function to initiate the module
        init: function () {
            function restoreRow(oTable, nRow) {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);

                for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                    oTable.fnUpdate(aData[i], nRow, i, false);
                }

                oTable.fnDraw();
            }

            function editRow(oTable, nRow) {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
                jqTds[0].innerHTML = '<input type="text" disabled class="form-control input-auto" value="' + aData[0] + '">';
                jqTds[1].innerHTML = '<input type="text" disabled class="form-control input-auto" value="' + aData[1] + '">';
                jqTds[2].innerHTML = '<input type="text" disabled class="form-control input-auto" value="' + aData[2] + '">';
                jqTds[3].innerHTML = '<input type="text" class="form-control input-auto" value="' + aData[3] + '">';

                jqTds[4].innerHTML = '<a class="edit" href="">Simpan</a>';
                jqTds[5].innerHTML = '<a class="cancel" href="">Batal</a>';
            }

            function saveRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);

                oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 4, false);
                oTable.fnUpdate('<a class="delete" href=""></a>', nRow, 5, false);
                oTable.fnDraw();

                var row_id = nRow.id;

                var mydata = 'kode=' + jqInputs[0].value +
                    '&saldo=' +  jqInputs[3].value;
					
				var kode = 	jqInputs[0].value+'~'+jqInputs[3].value;
				
                $.ajax( {
                    dataType: 'html',					
                    type: "POST",					
					url: "<?php echo base_url(); ?>keuangan/keuangan_saldo/saldo_save/"+kode,					 
                    cache: false,
                    data: mydata,					
                    success: function () {
                    location.reload();
                    },
                    error: function() {alert('Gagal menyimpan data...');},
                    complete: function() {}
                } );
            }


            function cancelEditRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);

                oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 4, false);
                oTable.fnDraw();
            }

            var oTable = $('#keuangan-saldo').dataTable({
                "aLengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "Semua"] // change per page values here
                ],
                // set the initial value
                "iDisplayLength": 5,

                "sPaginationType": "bootstrap",
                "oLanguage": {
                    "sEmptyTable": "Tidak ada data",
                    "sInfoEmpty": "Tidak ada data",
                    "sInfoFiltered": " - Dipilih dari _MAX_ data",
                    "sSearch": "Pencarian Data:",
                    "sInfo": " Jumlah _TOTAL_ Data (_START_ - _END_)",
                    "sLengthMenu": "_MENU_ Baris",
                    "sZeroRecords": "Tida ada data",
                    "oPaginate": {
                        "sPrevious": "Sebelumnya",
                        "sNext": "Berikutnya"
                    }
                },
                "aoColumnDefs": [{
                        'bSortable': true,
                        'aTargets': [0]
                    }
                ],
                "fnFooterCallback": function ( nRow, aaData, iStart, iEnd, aiDisplay ) {

                var iTotal  = 0;
                for ( var i=0 ; i<aaData.length ; i++ )
                {
                    iTotal += aaData[i][3]*1;
                }


                var iTot  = 0;
                for ( var i=iStart ; i<iEnd ; i++ )
                {
                    var x = aaData[aiDisplay[i]][3];
                    var y = Number(x.replace(/,/g,""));
                    iTot += y;
                }

                var nCells = nRow.getElementsByTagName('td');
                nCells[1].innerHTML = currencyFormat(iTot);
                }
            });

            jQuery('#keuangan-saldo_wrapper .dataTables_filter input').addClass("form-control input-medium input-inline"); // modify table search input
            jQuery('#keuangan-saldo_wrapper .dataTables_length select').addClass("form-control input-small"); // modify table per page dropdown
            jQuery('#keuangan-saldo_wrapper .dataTables_length select').select2({
                showSearchInput : false //hide search box with special css class
            }); // initialize select2 dropdown

            var nEditing = null;

         

         
            $('#keuangan-saldo a.cancel').live('click', function (e) {
                e.preventDefault();
                if ($(this).attr("data-mode") == "new") {
                    var nRow = $(this).parents('tr')[0];
                    oTable.fnDeleteRow(nRow);
                } else {
                    restoreRow(oTable, nEditing);
                    nEditing = null;
                }
            });

            $('#keuangan-saldo a.edit').live('click', function (e) {
                e.preventDefault();

                /* Get the row as a parent of the link that was clicked on */
                var nRow = $(this).parents('tr')[0];

                if (nEditing !== null && nEditing != nRow) {
                    /* Currently editing - but not this row - restore the old before continuing to edit mode */
                    restoreRow(oTable, nEditing);
                    editRow(oTable, nRow);
                    nEditing = nRow;
                } else if (nEditing == nRow && this.innerHTML == "Simpan") {
                    /* Editing this row and want to save it */
                    saveRow(oTable, nEditing);
                    nEditing = null;
                } else {
                    /* No edit in progress - let's start one */
                    editRow(oTable, nRow);
                    nEditing = nRow;
                }
            });
        }

    };

}();

jQuery(document).ready(function() {          
   TableEditable.init();
});
</script>