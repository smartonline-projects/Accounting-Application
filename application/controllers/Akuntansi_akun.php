<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Akuntansi_akun extends CI_Controller {

	/**
	 * @author : Enjang RK
	 * @web : http://e-soft.comli.com
	 * @keterangan : Controller untuk manajemen coa (CRUD master coa)
	 **/
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_akun','M_akun');
		$this->load->helper('simkeu_rpt');		
		$this->session->set_userdata('menuapp', '200');
		$this->session->set_userdata('submenuapp', '211');
	}

	public function index()
	{
		$cek = $this->session->userdata('level');		
		if(!empty($cek))
		{
		  $level=$this->session->userdata('level');		
		  $akses= $this->M_global->cek_menu_akses($level, 211);
		  $data['akses']= $akses;	
		  $this->load->helper('url');		  
		  $data['tipeakun']= $this->db->order_by('nomor')->get('ms_akun_kelompok')->result_array();	
		  $data['kodeakun']= $this->db->order_by('kodeakun')->get('ms_akun')->result_array();	
		  $this->load->view('akuntansi/v_master_akun',$data);
		} else
		{
			header('location:'.base_url());
		}			
	}

	public function ajax_list()
	{
		$level=$this->session->userdata('level');		
		$akses= $this->M_global->cek_menu_akses($level, 211);	
		$list = $this->M_akun->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $rd) {
			$no++;
			$row = array();
			$tipe  = ($rd->kelompok?$this->M_global->_tipeakun($rd->kelompok):'');	
			
			$row[] = $rd->kodeakun;
			$row[] = $rd->namaakun;
			$row[] = $tipe;
			$row[] = $rd->tx;
			
			//add html for action
			
			if($akses->uedit==1 && $akses->udel==1){
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_data('."'".$rd->kodeakun."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$rd->kodeakun."'".')"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';
		    } else 
			if($akses->uedit==1 && $akses->udel==0){
				$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_data('."'".$rd->kodeakun."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>';				  
		    } else 
			if($akses->uedit==0 && $akses->udel==1){
				$row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$rd->kodeakun."'".')"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';
			} else {
				$row[] = '';
			}	  
				
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->M_akun->count_all(),
						"recordsFiltered" => $this->M_akun->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->M_akun->get_by_id($id);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'kodeakun' => $this->input->post('kodeakun'),
				'namaakun' => $this->input->post('namaakun'),
				'kelompok' => $this->input->post('jenis'),
				'akuninduk' => $this->input->post('akuninduk'),
				'kodem' => $this->input->post('kodem'),
				'kodek' => $this->input->post('kodek'),
				'tx' => $this->input->post('akuntx'),
				);
		$insert = $this->M_akun->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'kodeakun' => $this->input->post('kodeakun'),
				'namaakun' => $this->input->post('namaakun'),
				'kelompok' => $this->input->post('jenis'),
				'akuninduk' => $this->input->post('akuninduk'),
				'kodem' => $this->input->post('kodem'),
				'kodek' => $this->input->post('kodek'),
				'tx' => $this->input->post('akuntx'),
			);
		$this->M_akun->update(array('kodeakun' => $this->input->post('kodeakun')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->M_akun->delete_by_id($id);
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

		if($this->input->post('namaakun') == '')
		{
			$data['inputerror'][] = 'namaakun';
			$data['error_string'][] = 'nama  masih kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('jenis') == '')
		{
			$data['inputerror'][] = 'jenis';
			$data['error_string'][] = 'Silahkan pilih jenis';
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
		  $d['unit'] = '';  
          $d['master_akun'] = $this->db->select('ms_akun.*,ms_akun_kelompok.nama as kel')->join('ms_akun_kelompok','ms_akun_kelompok.kode=ms_akun.kelompok','left')->get("ms_akun");
		  $d['master'] = $this->db->get("ms_unit")->result();
          $d['nama_usaha']=$this->config->item('nama_perusahaan');
		  $d['alamat']=$this->config->item('alamat_perusahaan');
		  $d['motto']=$this->config->item('motto');
		  
		  $this->load->view('akuntansi/v_master_akun_prn',$d);				
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
		  $page=$this->uri->segment(3);
		  $limit=$this->config->item('limit_data');	
          $d['master_akun'] = $this->db->select('ms_akun.*,ms_akun_kelompok.nama as kel')->join('ms_akun_kelompok','ms_akun_kelompok.kode=ms_akun.kelompok','left')->get("ms_akun");
		  $d['nama_usaha']=$this->config->item('nama_perusahaan');
		  $d['alamat']=$this->config->item('alamat_perusahaan');
		  $d['motto']=$this->config->item('motto');
		  $this->load->view('akuntansi/v_master_akun_exp',$d);				
		}
		else
		{
			
			header('location:'.base_url());
			
		}
	}
	
	
}

/* End of file master_bank.php */
/* Location: ./application/controllers/master_akun.php */