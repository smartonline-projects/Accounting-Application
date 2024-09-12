<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inventory_tso extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_stockopname');
		$this->load->model('M_barang');
		$this->load->model('M_param');		
		$this->load->helper('simkeu_rpt');
		$this->session->set_userdata('menuapp', '500');
		$this->session->set_userdata('submenuapp', '525');
	}

	public function index()
	{
		$cek = $this->session->userdata('level');		
		if(!empty($cek))
		{
			$data['merk']= $this->db->get('inv_merk')->result_array();			
			$data['rak']= $this->db->get('inv_rak')->result_array();			
			$this->load->view('inventory/v_inventory_stockopname',$data);
		} else
		{
			header('location:'.base_url());
		}			
	}

	public function ajax_list()
	{
		$list = $this->M_stockopname->get_datatables();
		
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $item) {
			$no++;
			$row = array();
			$row[] = date('d-m-Y',strtotime($item->tglentry));			
			$kode  = $item->kodeitem;
			if($this->M_global->_data_barang($item->kodeitem)){
			$nama  = $this->M_global->_data_barang($item->kodeitem)->namabarang;
		} else {
			$nama = ""; 
		}
		
		$nama = "";
			//$merk  = $this->M_global->_data_merk($item->kodemerk)->nama;
			
			//$row[] = $item->koderak;
			$row[] = $item->kodeitem;
			$row[] = $nama;
			$row[] = $item->sat;
			$row[] = number_format($item->qty_opname,0,',','.');						
			$row[] = 
			     ' <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$item->id."'".')"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->M_stockopname->count_all(),
						"recordsFiltered" => $this->M_stockopname->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->M_stockopname->get_by_id($id);		
		echo json_encode($data);
	}

	public function save($param)
	{
		$cek = $this->session->userdata('level');
		if(!empty($cek))
		{			            
			$userid   = $this->session->userdata('username');
			$pic      = $this->input->post('pic');
			$tanggal  = $this->input->post('tanggal');		
			$kode  = $this->input->post('kode');
			$qty   = $this->input->post('qty');
		    $sat   = $this->input->post('sat');
			
			$jumdata  = count($kode);
				
			$nourut = 1;			
			for($i=0;$i<=$jumdata-1;$i++)
			{
			    $_kode   = $kode[$i];
				
				$barang = $this->db->get_where('inv_barang', array('kodeitem' => $_kode))->row();
				
			    $datad = array(
				'tgl' => date('Y-m-d',strtotime($tanggal)),
				'kodeitem' => $_kode,
				'qty_opname' => $qty[$i],
				'sat' => $sat[$i],
				'hpp' => $barang->hargabeli,
				'qty' => $barang->stok,
				'selisih' =>$sat[$i]-$barang->stok,
				'kodeuser' => $userid,
				'pic' => $pic,
				'tglentry' => date('Y-m-d H:i:s'),
			    );
				
				
				if($_kode!=""){
				  if($param==1){	
			        $this->db->insert('inv_stockopname', $datad);
				  } else {
					$this->db->update('inv_stockopname',$datad, array('kodeitem' => $$_kode, 'pic' => $pic));	  
				  }
				  
				  $this->db->query('update inv_barang set stok = '.$qty[$i].' where kodeitem = "'.$_kode.'"');
				  
				}
			}
			
			
			
		}
		else
		{
			header('location:'.base_url());
		}
	}
	
	public function ajax_add()
	{
		$this->_validate();
		$tanggal  =$this->input->post('tanggal');
		$koderak  =$this->input->post('rak');
		$kdsubkat =$this->input->post('kdsubkat');
		$kodemerk =$this->input->post('merk');
		$kodeitem =$this->input->post('kodeitem');
		$satuan   =$this->input->post('satuan');
		$qtyopm   =$this->input->post('qty');
		
		$jumdata  = count($kodeitem);
		$_tanggal = date('Y-m-d',strtotime($tanggal));
						
		
		for($i=0;$i<=$jumdata-1;$i++)
		{
			$item = $kodeitem[$i];
			$qty  = $this->M_barang->get_by_id($item)->qty;
			$hpp  = $this->M_barang->get_by_id($item)->hpp;
			$sel  = $qtyopm[$i] - $qty;
			
			$data = array(
			'tgl'         => $_tanggal,
			'koderak'     => $koderak,
			'kodemerk'    => $kodemerk,
			'kdsubkat'    => $kdsubkat[$i],
			'kodeitem'    => $kodeitem[$i],
			'sat'         => $satuan[$i],	
			'hpp'         => $hpp,	
			'qty'         => $qty,				
			'qty_opname'  => $qtyopm[$i],				
			'selisih'     => $sel,
			'nilai_selisih' => $sel*$hpp,
			'kodeuser'    => $this->session->userdata('username'),
			);
			
			$insert = $this->M_stockopname->save($data);
		}
		
		echo json_encode(array("status" => TRUE));
			
		
	}

	
	public function ajax_delete($id)
	{
		$this->M_stockopname->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		
		if($this->input->post('merk') == '')
		{
			$data['inputerror'][] = 'merk';
			$data['error_string'][] = 'Merk belum dipilih';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('rak') == '')
		{
			$data['inputerror'][] = 'rak';
			$data['error_string'][] = 'Rak belum dipilih';
			$data['status'] = FALSE;
		}

	
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	public function getitem($kode)
	{
		//$this->_validate();
		if(!empty($kode))
		{
			$rak  = $kode;
			
			$data = $this->db->order_by('kodeitem')->get_where('inv_barang',array('kdrak'=>$rak))->result();			
			?>			
			<div class="modal-body form">
			<form action="#" id="form" class="form-horizontal">                    
            <div class="form-body">
			<div id="tableContainer" class="tableContainer">
             <table border="0" cellpadding="0" cellspacing="0" width="100%" class="scrollTable table table-striped table-bordered">
			 <thead class="fixedHeader">			
			  <tr>
			    <th width="20" style="text-align:center;width:120">No.</th>				
				<th width="120" style="text-align:center;width:120">Kode Item</th>				
				<th width="300" style="text-align:center">Nama Barang</th>	
				<th width="70"  style="text-align:center">Qty</th>	
				<th width="70"  style="text-align:center">Satuan</th>	
				
			  </tr> 
			  </thead>
			<tbody class="scrollContent">  
			<?php							
			$i=1;
			foreach($data as $row)
			{ ?>
			   <input type="hidden" name="kodeitem[]" value=<?php echo $row->kodeitem;?>>
			   <input type="hidden" name="satuan[]" value=<?php echo $row->satuan;?>>
			   <tr>
			     <td width="90" align="center"><?php echo $i;?></td> 
				 <td align="center" width="265">					
					<?php echo $row->kodeitem;?></a>					
				 </td>	     
				 <td width="670"><?php echo $row->namabarang;?></td>
				 
				 <td width="155"><input type="text" name="qty[]" class="form-control" value="0"></td>
				 <td width="130" align="center"><?php echo $row->satuan;?></td>
				 			 
				 <td ></td>
			   </tr>
			   
			   <?php
			  $i++;
			}
			echo "</tbody>";
			echo "</table>";
			echo "</div>";
			echo "</form>";
			echo "</div>";
			
		} else
        {
		  echo "";	
		}			
	}
	
	public function entri()
	{
		$cek = $this->session->userdata('level');		
		$uid = $this->session->userdata('unit');		
		if(!empty($cek))
		{				  
		  $d['pic'] = $this->session->userdata('username');
		  $this->load->view('inventory/v_inventory_so_add', $d);				
		}
		else
		{
			
			header('location:'.base_url());
			
		}
	}
	
	public function cetakformulir( $params )
	{		
		$cek = $this->session->userdata('level');		
		if(!empty($cek))
		{		    
			$param  = explode("~",$params);
			$rak  = $param[0];
			$tgl  = $param[1];
			
			$data = $this->db->order_by('kodeitem')->get_where('inv_barang',array('kdrak'=>$rak))->result();	
			
			$nrak  = $this->M_global->_data_rak( $rak )->nama;
			
		    $pdf=new simkeu_rpt();
			$pdf->setID('','','');
			$pdf->setunit('');
		    $pdf->setjudul('DAFTAR STOK OPNAME');
			$pdf->setsubjudul('');
			$pdf->addpage("P","A4");   
			$pdf->setsize("P","A4");
			$pdf->setfont('Times','B',10);
			$pdf->SetWidths(array(30,5,40,35,30,5,30));
			$pdf->SetAligns(array('L','C','L','C','L','C','L'));			
			$judul0=array('Kode Rak',':',$nrak,'','Tanggal',':',$tgl);
			$border= array('','','','','','','');
		    $align = array('L','C','L','C','L','C','L');		    
		    $pdf->FancyRow($judul0,$border,$align);
            
			$pdf->ln(10);
			$pdf->SetWidths(array(10,25,100,20,20));
			$pdf->SetAligns(array('C','C','C','C','C'));
			$judul=array('No.','Kode Item','Nama Item','Qty','Satuan');
			
			$pdf->row($judul);
			$pdf->SetWidths(array(10,25,100,20,20));
			$pdf->SetAligns(array('C','L','L','C','C'));
			$pdf->setfont('Times','',10);
			$pdf->SetFillColor(224,235,255);
			$pdf->SetTextColor(0);
			$pdf->SetFont('');
				
			$nourut = 1;

			foreach($data as $db)
			{
			  $pdf->row(array($nourut, $db->kodeitem, $db->namabarang, '', $db->satuan));
			  $nourut++;
			}
			
			$pdf->ln(10);
			$pdf->SetWidths(array(40,40,30,40,40));
			$border= array('','','','','');
		    $align = array('C','C','C','C','C');		    
			$foot1 = array('','PIC','','Saksi','');
			$foot2 = array('','','','','');			
			
		    $pdf->FancyRow($foot1,$border,$align);
			$pdf->ln(10);
			$border= array('','B','','B','');
            $pdf->FancyRow($foot2,$border,$align);


			$pdf->AliasNbPages();
			$pdf->output('FORMULIRSO.PDF','I');
		} else {			
			header('location:'.base_url());
			
		}
	}
	
	public function hasilso( $params )
	{		
		$cek = $this->session->userdata('level');		
		if(!empty($cek))
		{		    
			$param  = explode("~",$params);
			$rak  = $param[0];
			$tgl  = $param[1];
			
			$_tanggal= date('Y-m-d',strtotime($tgl));
			
			$this->db->select('inv_stockopname.*, inv_barang.namabarang');
			$this->db->from('inv_stockopname');
			$this->db->join('inv_barang','inv_stockopname.kodeitem=inv_barang.kodeitem','left');
			$this->db->where(array('kdrak'=>$rak,'tgl' => $_tanggal));
			$this->db->order_by('inv_stockopname.pic','asc');
			$data = $this->db->get()->result();
			
			
			
			$nrak  = $this->M_global->_data_rak( $rak )->nama;
			
		    $pdf=new simkeu_rpt();
			$pdf->setID('','','');
			$pdf->setunit('');
		    $pdf->setjudul('HASIL STOK OPNAME');
			$pdf->setsubjudul('');
			$pdf->addpage("P","A4");   
			$pdf->setsize("P","A4");
			$pdf->setfont('Times','B',10);
			$pdf->SetWidths(array(30,5,40,35,30,5,30));
			$pdf->SetAligns(array('L','C','L','C','L','C','L'));			
			$judul0=array('Kode Rak',':',$nrak,'','Tanggal',':',$tgl);
			$judul1=array('PIC',':','','','','','');			
			$border= array('','','','','','','');
		    $align = array('L','C','L','C','L','C','L');		    
		    $pdf->FancyRow($judul0,$border,$align);
            $pdf->FancyRow($judul1,$border,$align);
   
			$pdf->ln(10);
			$pdf->SetWidths(array(10,25,80,20,20,20));
			$pdf->SetAligns(array('C','C','C','C','C','C'));
			$judul=array('No.','Kode Item','Nama Item','Qty','Qty Opm','Satuan');
			
			$pdf->row($judul);
			$pdf->SetWidths(array(10,25,80,20,20,20));
			$pdf->SetAligns(array('C','L','L','R','R','C'));
			$pdf->setfont('Times','',10);
			$pdf->SetFillColor(224,235,255);
			$pdf->SetTextColor(0);
			$pdf->SetFont('');
				
			$nourut = 1;

			foreach($data as $db)
			{
			  $pdf->row(array($nourut, $db->kodeitem, $db->namabarang, $db->qty, $db->qty_opname, $db->sat));
			  $nourut++;
			}
			
			
			$pdf->AliasNbPages();
			$pdf->output('HASILSO.PDF','I');
		} else {			
			header('location:'.base_url());
			
		}
	}
	
	public function hasilsosel( $params )
	{		
		$cek = $this->session->userdata('level');		
		if(!empty($cek))
		{		    
			$param  = explode("~",$params);
			$rak  = $param[0];
			$tgl  = $param[1];
			//$pic  = $param[3];
			
			$_tanggal= date('Y-m-d',strtotime($tgl));
			
			$this->db->select('inv_stockopname.*, inv_barang.namabarang');
			$this->db->from('inv_stockopname');
			$this->db->join('inv_barang','inv_stockopname.kodeitem=inv_barang.kodeitem','left');
			$this->db->where(array('kdrak'=>$rak,'tgl' => $_tanggal));
			$this->db->where('selisih<>0');
			
			$this->db->order_by('inv_stockopname.pic','asc');
			$data = $this->db->get()->result();
			
			
			
			$nrak  = $this->M_global->_data_rak( $rak )->nama;
			
		    $pdf=new simkeu_rpt();
			$pdf->setID('','','');
			$pdf->setunit('');
		    $pdf->setjudul('HASIL STOCK OPNAME SELISIH');
			$pdf->setsubjudul('');
			$pdf->addpage("P","A4");   
			$pdf->setsize("P","A4");
			$pdf->setfont('Times','B',10);
			$pdf->SetWidths(array(30,5,40,35,30,5,30));
			$pdf->SetAligns(array('L','C','L','C','L','C','L'));			
			$judul0=array('Kode Rak',':',$nrak,'','Tanggal',':',$tgl);
			$judul1=array('PIC',':','','','','','');			
			$border= array('','','','','','','');
		    $align = array('L','C','L','C','L','C','L');		    
		    $pdf->FancyRow($judul0,$border,$align);
            $pdf->FancyRow($judul1,$border,$align);
   
			$pdf->ln(10);
			$pdf->SetWidths(array(10,25,80,20,20,20));
			$pdf->SetAligns(array('C','C','C','C','C','C'));
			$judul=array('No.','Kode Item','Nama Item','Qty','Qty Opm','Satuan');
			
			$pdf->row($judul);
			$pdf->SetWidths(array(10,25,80,20,20,20));
			$pdf->SetAligns(array('C','L','L','R','R','C'));
			$pdf->setfont('Times','',10);
			$pdf->SetFillColor(224,235,255);
			$pdf->SetTextColor(0);
			$pdf->SetFont('');
				
			$nourut = 1;

			foreach($data as $db)
			{
			  $pdf->row(array($nourut, $db->kodeitem, $db->namabarang, $db->qty, $db->qty_opname, $db->sat));
			  $nourut++;
			}
			
			
			$pdf->AliasNbPages();
			$pdf->output('HASILSO_SELISIH.PDF','I');
		} else {			
			header('location:'.base_url());
			
		}
	}
	
	
	
			
}
