<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_user extends CI_Controller {

	/**
	 * @author : Enjang RK
	 * @web : http://e-soft.comli.com
	 * @keterangan : Controller untuk manajemen bank (CRUD master bank)
	 **/
	
	
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_user','M_user');
	}

	public function index()
	{
		$cek = $this->session->userdata('level');		
		if(!empty($cek))
		{
			$this->load->helper('url');
			$d['grup']     = $this->db->get("ms_modul_grup");
			$d['uid']      = $this->db->get("ms_unit");
			$this->load->view('master/user/v_master_user',$d);
		} else
		{
			header('location:'.base_url());
		}			
	}

	public function ajax_list()
	{
		$list = $this->M_user->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $userapp) {
			$no++;
			$row = array();
			$row[] = $userapp->uidlogin;
			$row[] = $userapp->username;
			$row[] = $this->M_global->_namaunit($userapp->cabang);
		
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_data('."'".$userapp->uidlogin."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$userapp->uidlogin."'".')"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';
				  
				 
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->M_user->count_all(),
						"recordsFiltered" => $this->M_user->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->M_user->get_by_id($id);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}
	
	public function ajax_edit_menu($id)
	{
		$data = $this->M_user->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'uidlogin' => $this->input->post('uidlogin'),
				'username' => $this->input->post('karyawan'),
				'pwdlogin' =>  md5($this->input->post('password')),
				'cabang' => $this->input->post('unit'),
				'level' => $this->input->post('grup'),
				'pegawai_id' => $this->input->post('karyawan'),
			
			);
		$insert = $this->M_user->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		if(empty($this->input->post('password')))
		{
		  $data = array(
				'uidlogin' => $this->input->post('uidlogin'),
				'username' => $this->input->post('karyawan'),
				'cabang' => $this->input->post('unit'),
				'level' => $this->input->post('grup'),
				'pegawai_id' => $this->input->post('karyawan'),
			
			);	
		} else {
			$data = array(
				'uidlogin' => $this->input->post('uidlogin'),
				'username' => $this->input->post('karyawan'),
				'pwdlogin' => md5($this->input->post('password')),
				'cabang' => $this->input->post('unit'),
				'level' => $this->input->post('grup'),
				'pegawai_id' => $this->input->post('karyawan'),
			
			);
		}
		
		$this->M_user->update(array('uidlogin' => $this->input->post('uidlogin')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->M_user->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		

		if($this->input->post('uidlogin') == '')
		{
			$data['inputerror'][] = 'uidlogin';
			$data['error_string'][] = 'ID User masih kosong';
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
          $d['master_bank'] = $this->db->get("ms_bank");
          $d['nama_usaha']=$this->config->item('nama_perusahaan');
		  $d['alamat']=$this->config->item('alamat_perusahaan');
		  $d['motto']=$this->config->item('motto');
		  
		  $this->load->view('master/bank/v_master_bank_prn',$d);				
		}
		else
		{
			
			header('location:'.base_url());
			
		}
	}
	
	public function menu($x)
	{
		$cek = $this->session->userdata('level');		
		if(!empty($cek))
		{				  
		   $qmodul = "select a.nomor, a.nomor_modul, b.nama, a.uadd, a.uedit, a.udel from
					 ms_modul_grupd a inner join ms_modul b on b.kode=a.nomor_modul
					 where a.nomor_grup = '$x' order by a.nomor_modul";
					 
		   $qmodulapp = "select kode, nama  from ms_modul
					 where
					 kode not in (select nomor_modul from  ms_modul_grupd where nomor_grup='$x')";			 
		   $qgrup = "select nmgrup from  ms_modul_grup where nomor = '$x'";
		   $grup=$this->db->query($qgrup)->result();
		   foreach($grup as $row)
		   {
			  $d['namagrup']=$row->nmgrup; 
		   }
		   
		  $d['modul'] = $this->db->query($qmodul)->result();
		  $d['modulapp'] = $this->db->query($qmodulapp)->result();
		  $d['idgrup'] = $x;
          
		  $this->load->view('master/user/v_master_user_menu',$d);				
		}
		else
		{
			
			header('location:'.base_url());
			
		}
	}
	
	public function hapus_menu($id)
	{
		$cek = $this->session->userdata('level');		
		if(!empty($cek))
		{				  
		  	$this->M_user_grup->delete_menu($id);	
		}
		else
		{
			
			header('location:'.base_url());
			
		}
	}
	
	public function tambah_item()
	{
		$cek = $this->session->userdata('level');		
		if(!empty($cek))
		{				  
	        $grup=$this->input->post('nomor');
			$jumdata=$this->input->post('jumdata');
			
		  	    for($i = 0; $i <= $jumdata; $i++)
				{
				   $notrans= $this->input->post('notrans'.$i);

				   if (!empty($notrans))
				   {
					   
					   $datad = array(
						'nomor_grup' => $grup,
						'nomor_modul' => $notrans
						);
						
						$this->M_user_grup->input_data($datad,'ms_modul_grupd');	
						
					
				   }
				}	
		}
		else
		{
			
			header('location:'.base_url());
			
		}
	}
	
	public function update_item()
	{
		$cek = $this->session->userdata('level');		
		if(!empty($cek))
		{				  
				$nomor=$this->input->post('nomorG');
				$jumdata=$this->input->post('jumdataG');
			
		  	    for($i = 0; $i <= $jumdata; $i++)
				{
					
				   $notrans= $this->input->post('notransG'.$i);
				   $uadd   = $this->input->post('uadd'.$i);
				   $uedit  = $this->input->post('uedit'.$i);
				   $udel   = $this->input->post('udel'.$i);
				   
				   $vadd = 0;
				   $vedit= 0;
				   $vdel = 0;
				   
				   if (!empty($uadd))
				   {
					 $vadd = 1;
				   }
				   
				   if (!empty($uedit))
				   {
					 $vedit = 1;
				   }
				   
				   if (!empty($udel))
				   {
					 $vdel = 1;
				   }
				   
				   if (!empty($notrans))
				   {
					$query = "update ms_modul_grupd set uadd = '$vadd', uedit = '$vedit', udel = '$vdel'
							 where nomor_grup = '$nomor' and nomor_modul = '$notrans'";
					$this->M_user_grup->manualquery($query);
					
					
				   }
	   
				    	
					
				   
				}	
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
          $d['master_bank'] = $this->db->get("ms_bank");
          $d['nama_usaha']=$this->config->item('nama_perusahaan');
		  $d['alamat']=$this->config->item('alamat_perusahaan');
		  $d['motto']=$this->config->item('motto');
		  
		  $this->load->view('master/bank/v_master_bank_exp',$d);				
		}
		else
		{
			
			header('location:'.base_url());
			
		}
	}
	
	
}

/* End of file master_bank.php */
/* Location: ./application/controllers/master_bank.php */