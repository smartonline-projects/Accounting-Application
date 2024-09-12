<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Keuangan_transfer extends CI_Controller {

	/**
	 * @author : Enjang RK
	 * @web : http://e-soft.comli.com
	 * @keterangan : Controller untuk modul saldo awal keuangan
	 **/
	
	
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_keuangan_transfer','M_keuangan_transfer');
		$this->load->helper('simkeu_nota');
		$this->session->set_userdata('menuapp', '100');
		$this->session->set_userdata('submenuapp', '120');
	}

	public function index()
	{
		$unit = $this->session->userdata('unit');	
		//if(!empty($unit))
		{
		  $q1 = 
				 "select nomor, tanggal,  bank_sumber, bank_tujuan, uraian, jumlah
					from
					   tr_transfer
					where
					   year(tanggal)= (select periode_tahun from ms_identity) and
					   month(tanggal)= (select periode_bulan from ms_identity)
					order by
					   nomor desc";

		  $level=$this->session->userdata('level');		
		  $akses= $this->M_global->cek_menu_akses($level, 123);
		  $d['akses']= $akses;				   
	      $d['keu'] = $this->db->query($q1)->result();		
		  $this->load->view('keuangan/v_keuangan_transfer',$d);			   
		}
	}
	
	public function filter($param)
	{
		$cek = $this->session->userdata('level');		
		$unit= $this->session->userdata('unit');	
        		
		if(!empty($cek))
		{	
         $data  = explode("~",$param);
		 $jns   = $data[0];		
		 $tgl1  = $data[1];
		 $tgl2  = $data[2];
		 $_tgl1 = date('Y-m-d',strtotime($tgl1));
		 $_tgl2 = date('Y-m-d',strtotime($tgl2));
		 
		 if(!empty($jns))
		 {
		   $q1 = 
				    "select nomor, tanggal,  bank_sumber, bank_tujuan, uraian, jumlah
					from
					   tr_transfer
					where
					   tanggal between '$_tgl1' and '$_tgl2'
					order by
					   nomor desc";

		  $level=$this->session->userdata('level');		
		  $akses= $this->M_global->cek_menu_akses($level, 123);
		  $d['akses']= $akses;				   
	      $d['keu'] = $this->db->query($q1)->result();		
		  $periode= 'Periode '.date('d-m-Y',strtotime($tgl1)).' s/d '.date('d-m-Y',strtotime($tgl2));	   
	      $d['periode'] = $periode;		  
		  $this->load->view('keuangan/v_keuangan_transfer',$d);		
		}
		} else
		{
			
			header('location:'.base_url());
			
		}
			
		
	}
		
	
    /*	
	public function cetak($param)
	{
		$cek = $this->session->userdata('level');		
		$unit= $this->session->userdata('unit');		
		if(!empty($cek))
		{				  		 
          
		    $query = "select * from tr_transfer where nomor = '$param'";
			$data  = $this->db->query($query)->result();
			foreach($data as $row){
				$tanggal = date('d-m-Y',strtotime($row->tanggal));
				$ket     = $row->uraian;
				$sumber  = $row->bank_sumber;
				$tujuan  = $row->bank_tujuan;
				$jumlah  = $row->jumlah;
			}
			
			$sumbernm = $this->M_global->_namaakun($sumber);
			$tujuannm = $this->M_global->_namaakun($tujuan);
			
			$d['master_bank'] = $this->db->get("ms_bank");
			$d['nama_usaha']=$this->config->item('nama_perusahaan');
			$d['alamat']=$this->config->item('alamat_perusahaan');
			$d['motto']=$this->config->item('motto');
			$d['unit'] = $this->session->userdata('unit');
		  
			
			$d['ketditerimadari'] = 'Sumber/Tujuan';
			$d['diterimadari'] = $sumbernm." ke ".$tujuannm;

			$d['judul']='BUKTI TRANSFER';
	
		    $d['ket']=$ket;
			$d['jumlah']=$jumlah;
			$d['terbilang']=ucwords($this->M_global->terbilang($jumlah)).' Rupiah';
			
		    $this->load->view('keuangan/v_keuangan_transfer_voucher',$d);				
		}
		else
		{
			
			header('location:'.base_url());
			
		}
	}
	*/
	
	public function cetak($param)
	{
		$cek = $this->session->userdata('level');		
		$unit= $this->session->userdata('unit');		
		if(!empty($cek))
		{				  		 
            $profile = $this->M_global->_LoadProfileLap();	
		    $unit= $this->session->userdata('unit');	 
		    $nama_usaha=$profile->nama_usaha;
			$alamat1  = $profile->alamat1;
			$alamat2  = $profile->alamat2;
		  
		    $queryh = "select * from  tr_transfer where nomor = '$param'";
			 
		    $header = $this->db->query($queryh)->row();
			$pdf=new simkeu_nota();
			$pdf->setID($nama_usaha,$alamat1,$alamat2);
			$pdf->setjudul('');
			$pdf->setsubjudul('');
			$pdf->addpage("P","A4");   
			$pdf->setsize("P","A4");
			$pdf->SetWidths(array(70,30,90));
			$border = array('','','BT');
			$size   = array('','','');
			$pdf->setfont('Arial','B',18);
			$pdf->SetAligns(array('C','C','C'));
			$align = array('L','C','L');
			$style = array('','','B');
			$size  = array('12','','18');
			$max   = array(5,5,20);
			$judul=array('','','Transfer Bank');
			$fc     = array('0','0','0');
			$hc     = array('20','20','20');
			$pdf->FancyRow2(10,$judul, $fc,  $border, $align, $style, $size, $max);
			$pdf->ln(1);
			$pdf->setfont('Arial','B',10);
			$pdf->SetWidths(array(70,30,30,5,55));
			$border = array('','','','','');
			$fc     = array('0','0','1','1','1');
			$pdf->SetFillColor(230,230,230);
			//$pdf->settextcolor(10,20,200);
			$pdf->setfont('Arial','',10);
		
			$pdf->FancyRow(array('','','Nomor',':',$header->nomor), $fc, $border);
			$pdf->FancyRow(array('','','Tanggal',':',date('d-m-Y',strtotime($header->tanggal))), $fc, $border);			
			$fc     = array('1','0','0','0','0');			
			$pdf->ln(3);
			$border = array('T','T','T','T','T');
			$fc     = array('0','0','0','0','0');
			$pdf->SetLineWidth(1);
			$pdf->FancyRow(array('','','','',''), $fc, $border);			
			$pdf->SetLineWidth(0);
			
			$pdf->SetWidths(array(90,10,90));
			$border = array('TB','','TB');
			$fc     = array('0','0','0');
			$pdf->FancyRow(array('Dari Kas/Bank','','Ke Kas/Bank'), $fc, $border);
			//$pdf->ln(3);
			$pdf->SetWidths(array(30,60,10,30,60));
			$align  = array('L','L','','L','L');
			$border = array('','','','','');
			$fc     = array('1','1','0','1','1');
			$pdf->SetFillColor(230,230,230);
			$terbilang = ucwords($this->M_global->terbilang($header->jumlah)).' Rupiah';
			$banks     = $this->M_global->_namaakun($header->bank_sumber);
			$bankt     = $this->M_global->_namaakun($header->bank_tujuan);
			$pdf->FancyRow(array('Kas/Bank',$banks,'','Kas/Bank',$bankt), $fc, $border);
			$pdf->FancyRow(array('Nilai Transfer',number_format($header->jumlah,0,'.',','),'','Nilai Transfer',number_format($header->jumlah,0,'.',',')), $fc, $border);
			$pdf->FancyRow(array('Terbilang',$terbilang,'','Terbilang',$terbilang), $fc, $border);
			$pdf->FancyRow(array('','','','',''), $fc, $border);
			
			$pdf->ln(5);			
			$pdf->SetWidths(array(90,10,30,60));
			$border = array('TB','','TB','TB');
			$fc     = array('0','0','1','1');
			$align  = array('L','','L','R');
			$pdf->SetFillColor(230,230,230);
			$pdf->settextcolor(0);
			
			$pdf->FancyRow(array('Keterangan', '', 'Biaya Transfer',number_format(0,0,'.',',')),$fc, $border, $align,0);			
			$border = array('','','','');
			$pdf->FancyRow(array($header->uraian,'', '', ''),$fc, $border, $align);
			$fc = array('0','0','0','0');
			$pdf->FancyRow(array('','', '', ''),$fc, $border, $align);
			$pdf->FancyRow(array('','', '', ''),$fc, $border, $align);
			
			$style = array('','','B','B');
			$size  = array('','','','');
			$border = array('T','','','');
			$pdf->SetFillColor(0,0,139);
			$pdf->settextcolor(255,255,255);
			$fc = array('0','0','0','0');
			$pdf->FancyRow(array('','', '', ''),$fc, $border, $align, $style, $size);
			$pdf->settextcolor(0);
			$pdf->AliasNbPages();
			$pdf->output($param.'.PDF','I');			
		}
		else
		{
			
			header('location:'.base_url());
			
		}
	}
	
	
	
	public function entri()
	{
		$cek = $this->session->userdata('level');		
		$uid = $this->session->userdata('unit');		
		
		if(!empty($cek))
		{				  
          $d['bank'] = $this->db->get_where('ms_akun',array('kelompok' => 'BANK','akuninduk != ' => ''))->result();
          $d['nomor']= $this->M_global->_Autonomor('KT');		  
		  $this->load->view('keuangan/v_keuangan_transfer_add',$d);				
		}
		else
		{
			header('location:'.base_url());
		}
	}
	
	public function hapus($nomor)
	{
		$cek = $this->session->userdata('level');		
		if(!empty($cek))
		{				  
		   $this->M_keuangan_transfer->hapus_transfer($nomor);	
		   $this->db->delete('tr_jurnal',array('noref' => $nomor,'jenis' => 'KT', 'wbs' => 'KT'));	           
		}
		else
		{
			
			header('location:'.base_url());
			
		}
	}
	
	public function transfer_save()
	{
		$cek = $this->session->userdata('level');
		if(!empty($cek))
		{			
           
			$nobukti  = $this->input->post('nomorbukti');
			$userid   = $this->session->userdata('username');
			$uid      = $this->session->userdata('unit');
			$data = array(
				'nomor' => $nobukti,
				'tanggal' => date('Y-m-d',strtotime($this->input->post('tanggal'))),
				'bank_sumber' => $this->input->post('sumber'),
				'bank_tujuan' => $this->input->post('tujuan'),
				'uraian' => $this->input->post('keterangan'),
				'jumlah' => str_replace(',','',$this->input->post('jumlah')),
				'cabang' => $uid,
				'userid' => $userid,			
			);
			
			$where = array(
		    'nomor' => $nobukti
	        );
			
	        $query = "select * from tr_transfer where nomor = '$nobukti'";
			if($this->db->query($query)->num_rows()==0)
			{
			  $this->M_keuangan_transfer->input_data($data,"tr_transfer");	
			  $this->M_keuangan_transfer->update();
			} else {
			  $this->M_keuangan_transfer->update_data($where,$data,'tr_transfer');				  
			}
			
		    
			$this->db->delete('tr_jurnal',array('noref' => $nobukti,'jenis' => 'KT', 'wbs' => 'KT'));	
			$data_jurnal = array (
			   'novoucher' => $this->M_global->_Autonomor('JU'),
			   'noref' => $nobukti,
			   'tanggal' => date('Y-m-d',strtotime($this->input->post('tanggal'))),
			   'keterangan' => $this->input->post('keterangan'),
			   'nourut' => 1,
			   'jenis' => 'KT',
			   'kodeakun' => $this->input->post('tujuan'),
			   'debet' => str_replace(',','',$this->input->post('jumlah')),
			   'kredit' => 0,
			   'userid' => $userid,			
			);
			$this->db->insert('tr_jurnal',$data_jurnal);
			
			$data_jurnal = array (
			   'novoucher' => $this->M_global->_Autonomor('JU'),
			   'noref' => $nobukti,
			   'tanggal' => date('Y-m-d',strtotime($this->input->post('tanggal'))),
			   'keterangan' => $this->input->post('keterangan'),
			   'nourut' => 2,
			   'jenis' => 'KT',
			   'kodeakun' => $this->input->post('sumber'),
			   'kredit' => str_replace(',','',$this->input->post('jumlah')),
			   'debet' => 0,
			   'userid' => $userid,			
			);
			$this->db->insert('tr_jurnal',$data_jurnal);
			$this->M_global->_updatecounter1('JU');
			
								
			
		}
		else
		{
			header('location:'.base_url());
		}
	}
	
	public function edit($nomor)
	{
		$cek = $this->session->userdata('level');		
		if(!empty($cek))
		{	
			$unit = $this->session->userdata('unit');	
					
			$qheader ="select * from tr_transfer where nomor = '$nomor'"; 		
			
			$d['header'] = $this->db->query($qheader);
            $data=$this->db->query($qheader);
			foreach($data->result() as $row){
			$d['tanggal']=$row->tanggal;
			$d['sumber']=$row->bank_sumber;
		    $d['tujuan']=$row->bank_tujuan;
			$d['uraian']=$row->uraian;
			$d['jumlah']=$row->jumlah;
			
			
            }

          
			$d['bank'] = $this->db->get_where('ms_akun',array('kelompok' => 'BANK','akuninduk != ' => ''))->result();
			$d['nomor']=$nomor;
			
			$this->load->view('keuangan/v_keuangan_transfer_edit',$d);
			} else
		{
			header('location:'.base_url());
		}	
	}
}
/* End of file keuangan_saldo.php */
/* Location: ./application/controllers/keuangan_saldo.php */