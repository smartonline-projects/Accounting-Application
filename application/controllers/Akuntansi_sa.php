<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Akuntansi_sa extends CI_Controller {

	/**
	 * @author : Enjang RK
	 * @web : http://e-soft.comli.com
	 * @keterangan : Controller untuk manajemen coa (CRUD master coa)
	 **/
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_akuntansi_sa','M_akuntansi_sa');
		$this->load->helper('simkeu_rpt');		
		$this->session->set_userdata('menuapp', '200');
		$this->session->set_userdata('submenuapp', '212');
	}

	public function index()
	{
		$cek = $this->session->userdata('level');		
		if(!empty($cek))
		{
		  $this->load->helper('url');		  
		  $level=$this->session->userdata('level');		
		  $akses= $this->M_global->cek_menu_akses($level, 212);
		  $data['akses']= $akses;
		  $data['tipeakun']= $this->db->order_by('nomor')->get('ms_akun_kelompok')->result_array();	
		  $data['kodeakun']= $this->db->order_by('kodeakun')->get_where('ms_akun', array('kodeakun < ' => '4' ,'akuninduk != ' => ''))->result_array();	
		  $this->load->view('akuntansi/v_akuntansi_sa',$data);
		} else
		{
			header('location:'.base_url());
		}			
	}

	public function ajax_list()
	{
		$level=$this->session->userdata('level');		
		$akses= $this->M_global->cek_menu_akses($level, 212);	
		$bulan = $this->M_global->_periodebulan();
	    $tahun = $this->M_global->_periodetahun();
		$list = $this->M_akuntansi_sa->get_datatables( $bulan, $tahun );
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $rd) {
			$no++;
			$row   = array();
			$row[] = $rd->kodeakun;
			$row[] = $rd->namaakun;
			$row[] = $rd->debet;
			$row[] = $rd->kredit;
			
			//add html for action
			if($akses->uedit==1 && $akses->udel==1){
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_data('."'".$rd->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$rd->id."'".')"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';
		    } else 
			if($akses->uedit==1 && $akses->udel==0){	
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_data('."'".$rd->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>';
				 		    
			} else 
			if($akses->uedit==0 && $akses->udel==1){	
			$row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$rd->id."'".')"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';
			} else {
			$row[] = '';	
			}
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->M_akuntansi_sa->count_all(),
						"recordsFiltered" => $this->M_akuntansi_sa->count_filtered( $bulan, $tahun ),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->M_akuntansi_sa->get_by_id($id);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'kodeakun' => $this->input->post('kodeakun'),
				'debet' => $this->input->post('debet'),
				'kredit' => $this->input->post('kredit'),
				'userid' => $this->session->userdata('username'),
				'tahun' => $this->M_global->_periodetahun(),
				'bulan' => $this->M_global->_periodebulan(),
				);
		$insert = $this->M_akuntansi_sa->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'kodeakun' => $this->input->post('kodeakun'),
				'debet' => $this->input->post('debet'),
				'kredit' => $this->input->post('kredit'),
			);
		$this->M_akuntansi_sa->update(array('kodeakun' => $this->input->post('kodeakun')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->M_akuntansi_sa->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('kodeakun') == '')
		{
			$data['inputerror'][] = 'kodeakun';
			$data['error_string'][] = 'Kode  harus diisi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('debet') == '')
		{
			$data['inputerror'][] = 'debet';
			$data['error_string'][] = 'Tidak boleh kosong';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('kredit') == '')
		{
			$data['inputerror'][] = 'kredit';
			$data['error_string'][] = 'Tidak boleh kosong';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	public function cetak()
	{
		$cek = $this->session->userdata('level');		
		if(!empty($cek))
		{				  
		    $page=$this->uri->segment(3);
		    $limit=$this->config->item('limit_data');	
		  
		    $nama_usaha =  $this->config->item('nama_perusahaan');
			$motto = $this->config->item('motto');
			$alamat =$this->config->item('alamat_perusahaan');
		    $bulan = $this->M_global->_periodebulan();
	        $tahun = $this->M_global->_periodetahun();
			$unit  = '';
		
		    $this->db->select('ms_akun.kodeakun, ms_akun.namaakun, ms_akunsaldo.debet, ms_akunsaldo.kredit, ms_akunsaldo.id')->from('ms_akun');
		    $this->db->join('ms_akunsaldo','ms_akunsaldo.kodeakun=ms_akun.kodeakun','left');
		    $this->db->where(array('ms_akunsaldo.tahun' => $tahun,'ms_akunsaldo.bulan' => $bulan));
			$saldoawal = $this->db->get()->result();
		
		    $pdf=new simkeu_rpt();
			$pdf->setID($nama_usaha,$motto,$alamat);
			$pdf->setunit($unit);
			$pdf->setsubjudul('');
			$pdf->setjudul('SALDO AWAL '.$this->M_global->_namabulan($bulan).'  '.$tahun);
			$pdf->addpage("P","A4");   
			$pdf->setsize("P","A4");
			$pdf->SetWidths(array(10,25,90,30,30));
			$pdf->SetAligns(array('C','C','C','C','C'));
			$judul=array('NO','KODE PERKIRAAN','NAMA','DEBET','KREDIT');
			$pdf->setfont('Times','B',10);
			$pdf->row($judul);
			$pdf->SetWidths(array(10,25,90,30,30));
			$pdf->SetAligns(array('C','L','L','R','R'));
			$pdf->setfont('Times','',10);
			$pdf->SetFillColor(224,235,255);
			$pdf->SetTextColor(0);
			$pdf->SetFont('');
				
			$nourut = 1;
            $tdb = 0;
            $tkr = 0;			
			foreach($saldoawal as $db)
			{
			  $tdb += $db->debet;
			  $tkr += $db->kredit;
			  $pdf->row(array($nourut, $db->kodeakun, $db->namaakun, number_format($db->debet,'2',',','.'),  number_format($db->kredit,'2',',','.')));
			  $nourut++;
			}
			$pdf->setfont('Times','B',10);
			$pdf->SetWidths(array(125,30,30));
			$pdf->SetAligns(array('C','R','R'));
            $pdf->row(array('TOTAL', number_format($tdb,'2',',','.'),  number_format($tkr,'2',',','.')));

			$pdf->AliasNbPages();
			$pdf->output('saldoakun.PDF','I');


		  
		}
		else
		{
			
			header('location:'.base_url());
			
		}
	}
	
	public function export()
	{
		$cek = $this->session->userdata('level');		
		if(!empty($cek))
		{				  
		    $nama_usaha =  $this->config->item('nama_perusahaan');
			$motto = $this->config->item('motto');
			$alamat =$this->config->item('alamat_perusahaan');
		    $bulan = $this->M_global->_periodebulan();
	        $tahun = $this->M_global->_periodetahun();
			$unit  = '';
		    
		    $this->db->select('ms_akun.kodeakun, ms_akun.namaakun, ms_akunsaldo.debet, ms_akunsaldo.kredit, ms_akunsaldo.id')->from('ms_akun');
		    $this->db->join('ms_akunsaldo','ms_akunsaldo.kodeakun=ms_akun.kodeakun','left');
		    $this->db->where(array('ms_akunsaldo.tahun' => $tahun,'ms_akunsaldo.bulan' => $bulan));
			$saldoawal = $this->db->get()->result();
		  
		     header("Content-type: application/vnd-ms-excel");
			 header("Content-Disposition: attachment; filename=saldoawal.xls");
			 header("Pragma: no-cache");
			 header("Expires: 0");
			?>
			<h2><?php echo $nama_usaha;?></h2>
			<h4>SALDO AWAL  <?php echo $this->M_global->_namabulan($bulan).'  '.$tahun;?> </h4>
			<table border="1" >
				<thead>
					 <tr>
						 <th style="text-align: center">Kode Perkiraan</th>
						 <th style="text-align: center">Nama</th>
						 <th style="text-align: center">Debet</th>
						 <th style="text-align: center">Kredit</th>
					 </tr>
				 </thead>
				 <tbody>
				 <?php
				   foreach($saldoawal  as $db) { ?>
					 <tr>
						 <td><?php echo $db->kodeakun;?></td>
						 <td><?php echo $db->namaakun;?></td>
						 <td><?php echo $db->debet;?></td>
						 <td><?php echo $db->kredit;?></td>
					 </tr>
				 <?php } ?>
				 </tbody>
			</table>
           <?php
		}
		else
		{
			
			header('location:'.base_url());
			
		}
	}
	
	
}

/* End of file master_bank.php */
/* Location: ./application/controllers/master_akun.php */