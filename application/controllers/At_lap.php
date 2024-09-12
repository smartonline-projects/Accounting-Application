<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class At_lap extends CI_Controller {

	/**
	 * @author : Enjang RK
	 * @web : http://e-soft.comli.com
	 * @keterangan : Controller untuk modul laporan anggaran
	 **/
	
	
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_global');		
		$this->session->set_userdata('menuapp', '600');
		$this->session->set_userdata('submenuapp', '630');
		$this->load->helper('simkeu_rpt');
		
	}

	public function index()
	{
		$cek = $this->session->userdata('level');		
		if(!empty($cek))
		{		
			$unit = $this->session->userdata('unit');							
			$d['unit']  = $this->db->get('ms_unit')->result();	
			$d['tahun'] = date('Y');
			$d['bulan'] = date('n');
			
			$this->load->view('at/v_at_lap',$d);
		} else
		{
			header('location:'.base_url());
		}			
	}
	
	
	
	public function cetak($x)
	{
		$cek = $this->session->userdata('level');		
		if(!empty($cek))
		{				  		            
          $d['nama_usaha']=$this->config->item('nama_perusahaan');
		  $d['alamat']=$this->config->item('alamat_perusahaan');
		  $d['motto']=$this->config->item('motto');
		  
		  $data  = explode("~",$x);
		  $jns   = $data[0];		  
		  if($jns==1)
		  {			  			 			 
			 $d['jenisat']=$this->db->get('ms_atjenis')->result();
			 $d['unit']=$this->session->userdata('unit');
			 $d['namaunit']=$this->M_global->_namaunit($this->session->userdata('unit'));
		     $this->load->view('at/v_at_lap1',$d);				 
		  } else
		  if($jns==2)
		  {
			 $d['unit']=$data[1];
		     $d['bulan']=$data[2];
			 $d['tahun']=$data[3];			 
			 $d['namaunit']=$this->M_global->_namaunit($data[1]);
			 $this->load->view('at/v_at_lap2',$d);				 
		  } 
		  
		}
		else
		{
			
			header('location:'.base_url());
			
		}
	}
	
	public function export($x)
	{
		$cek = $this->session->userdata('level');		
		if(!empty($cek))
		{				  		            
          $d['nama_usaha']=$this->config->item('nama_perusahaan');
		  $d['alamat']=$this->config->item('alamat_perusahaan');
		  $d['motto']=$this->config->item('motto');
		  
		  $data  = explode("~",$x);
		  $jns   = $data[0];
		  $qpagu = "  select a.kodeakun, b.namaakun, a.pagu, b.jenis from ms_anggaran_pagu a, ms_akun b
					  where a.kodeakun=b.kodeakun  and b.status='A' and a.tahun = '$data[1]'
					  order by a.kodeakun";		
		  if($jns==1)
		  {			  			 
			 $d['tahun']=$data[1];
			 $d['pagu']=$this->db->query($qpagu)->result();
			 $d['unit']=$this->session->userdata('unit');
		     $this->load->view('anggaran/v_anggaran_exp1',$d);				 
		  } else
		  if($jns==2)
		  {
			 $d['unit']=$data[1];
		     $d['tahun']=$data[2];			 
			 $this->load->view('anggaran/v_anggaran_exp2',$d);				 
		  } 
		  
		}
		else
		{
			
			header('location:'.base_url());
			
		}
	}
	
	
	
	
	
	
	
}

/* End of file akuntansi_jurnal.php */
/* Location: ./application/controllers/akuntansi_jurnal.php */