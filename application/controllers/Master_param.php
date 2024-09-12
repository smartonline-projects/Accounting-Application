<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_param extends CI_Controller {

	/**
	 * @author : Enjang RK
	 * @web : http://e-soft.comli.com
	 * @keterangan : Controller untuk manajemen param
	 **/
	
	
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_param','M_param');
		$this->session->set_userdata('menuapp', '900');
		$this->session->set_userdata('submenuapp', '905');
	}

	public function index()
	{
		$cek = $this->session->userdata('level');		
		if(!empty($cek))
		{
			$this->load->helper('url');			
			$data=$this->M_global->_LoadProfile();
			foreach($data as $row){
				$d['kodecbg'] =$row->kodecbg;
				$d['nama'] =$row->nama_usaha;
				$d['alamat1'] =$row->alamat1;
				$d['alamat2'] =$row->alamat2;
				$d['website'] =$row->website;
				$d['email'] =$row->email;
				$d['pwdemail'] =$row->pwdemail;
				$d['smtp_host'] =$row->smtp_host;
				$d['smtp_port'] =$row->smtp_port;
				$d['hp'] =$row->hp;
				$d['telpon'] =$row->telpon;
				$d['kota'] =$row->kota;
				$d['kodepos'] =$row->kodepos;
				$d['fax'] =$row->fax;
				
				$d['akunlrberjalan'] =$row->akunlrberjalan;
				$d['akunlrlalu'] =$row->akunlrlalu;
				$d['akunpersediaantransit'] =$row->akun_persediaan_transit;
				$d['akunpersediaan'] =$row->akun_persediaan;
				$d['akunbiayakerugianlain'] =$row->akun_biaya_kerugian_lain;
				$d['akunpendapatanlain'] =$row->akun_pendapatan_lain;
				$d['akunpenjualan'] =$row->akun_penjualan;
				$d['akunppn'] =$row->akun_ppn;
				$d['akunongkir'] =$row->akun_ongkir;
				$d['akunuangmuka'] =$row->akun_uangmuka;
				$d['akunhpp'] =$row->akun_hpp;
				$d['akunkas'] =$row->akun_kas;	
				$d['akunhutang'] =$row->akun_hutang;	
				$d['akunuangmukajual'] =$row->akun_uangmukajual;	
				$d['akunpiutang'] =$row->akun_piutang;	
				$d['akunongkirjual'] =$row->akun_ongkirjual;
				$d['akunretjual'] =$row->akun_retjual;
				$d['akunhutangbeli'] =$row->akun_hutangbeli;
				
				
		    }
			
			$nomor=$this->db->get("nomor_auto")->result();
			foreach($nomor as $row){
			if($row->id==1){
			$d['nomor1'] =$row->nilai;
			} else
			if($row->id==2){
			$d['nomor2'] =$row->nilai;
			} else
			if($row->id==3){
			$d['nomor3'] =$row->nilai;
			} else
            if($row->id==4){
			$d['nomor4'] =$row->nilai;
			} else	
            if($row->id==5){
			$d['nomor5'] =$row->nilai;
			} else
            if($row->id==6){
			$d['nomor6'] =$row->nilai;
			} else
            if($row->id==7){
			$d['nomor7'] =$row->nilai;
			} else
            if($row->id==8){
			$d['nomor8'] =$row->nilai;
			} else
            if($row->id==9){
			$d['nomor9'] =$row->nilai;
			} 			
			}
			 
			$d['uid']=$this->db->get("ms_unit")->result();
			$d['coa']=$this->db->get("ms_akun")->result();			
			$this->load->view('master/param/v_master_param',$d);
		} else
		{
			header('location:'.base_url());
		}			
	}
	
	
    public function update($idx)
	{
		$cek = $this->session->userdata('level');		
		if(!empty($cek))
		{
		
			if($idx==1)
			{
				$data = array(
				'kodecbg' => $this->input->post('_kodecbg'),
				'nama_usaha' => $this->input->post('_nama'),
				'telpon' => $this->input->post('_telpon'),
				'fax' => $this->input->post('_fax'),
				'hp' => $this->input->post('_hp'),
				'email' => $this->input->post('_email'),
				'pwdemail' => $this->input->post('_pwdemail'),
				'smtp_host' => $this->input->post('_smtp_host'),
				'smtp_port' => $this->input->post('_smtp_port'),
				'website' => $this->input->post('_website'),
				'alamat1' => $this->input->post('_alamat1'),
				'alamat2' => $this->input->post('_alamat2'),
				'kota' => $this->input->post('_kota'),
				'kodepos' => $this->input->post('_kodepos'),
				);
																
				$this->M_param->updatedata_id($data);

				
			} else			
			if($idx==3)
			{
				$data = array(
				'periode_tahun' => $this->input->post('_tahun'),
				'periode_bulan' => $this->input->post('_bulan'));
				$this->M_param->updatedata_id($data);
			} else
			if($idx==4)
			{
				$data = array(
				'akunlrberjalan' => $this->input->post('_akunlrberjalan'),
				'akunlrlalu' => $this->input->post('_akunlrlalu'),
				'akun_persediaan_transit' => $this->input->post('_akunpersediaantransit'),
				'akun_persediaan' => $this->input->post('_akunpersediaan'),
				'akun_biaya_kerugian_lain' => $this->input->post('_akunbiayakerugianlain'),
				'akun_pendapatan_lain' => $this->input->post('_akunpendapatanlain'),
				'akun_penjualan' => $this->input->post('_akunpenjualan'),
				'akun_ppn' => $this->input->post('_akunppn'),
				'akun_ongkir' => $this->input->post('_akunongkir'),
				'akun_uangmuka' => $this->input->post('_akunuangmuka'),
				'akun_hpp' => $this->input->post('_akunhpp'),
				'akun_kas' => $this->input->post('_akunkas'),
				'akun_uangmukajual' => $this->input->post('_akunuangmukajual'),
				'akun_piutang' => $this->input->post('_akunpiutang'),
				'akun_ongkirjual' => $this->input->post('_akunongkirjual'),
				'akun_retjual' => $this->input->post('_akunretjual'),
				'akun_hutang' => $this->input->post('_akunhutang'),
				'akun_hutangbeli' => $this->input->post('_akunhutangbeli'));
				
				
				$this->M_param->updatedata_id($data);
				
							
			} else
			if($idx==5)
			{
				$data = array('nilai' => $this->input->post('_nomor1'));
				$this->M_param->updatedata_nomor($data,1);
				
				$data = array('nilai' => $this->input->post('_nomor2'));
				$this->M_param->updatedata_nomor($data,2);
				
				$data = array('nilai' => $this->input->post('_nomor3'));
				$this->M_param->updatedata_nomor($data,3);
				
				$data = array('nilai' => $this->input->post('_nomor4'));
				$this->M_param->updatedata_nomor($data,4);
				
				$data = array('nilai' => $this->input->post('_nomor5'));
				$this->M_param->updatedata_nomor($data,5);
				
				$data = array('nilai' => $this->input->post('_nomor6'));
				$this->M_param->updatedata_nomor($data,6);
				
				$data = array('nilai' => $this->input->post('_nomor7'));
				$this->M_param->updatedata_nomor($data,7);
				
				$data = array('nilai' => $this->input->post('_nomor8'));
				$this->M_param->updatedata_nomor($data,8);
				
				$data = array('nilai' => $this->input->post('_nomor9'));
				$this->M_param->updatedata_nomor($data,9);
				
				
							
			};		
			
			
			}
	    }
	
	
	
	
	
	
	
}

