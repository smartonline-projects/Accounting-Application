<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Keuangan_keluar extends CI_Controller {

	/**
	 * @author : Enjang RK
	 * @web : http://e-soft.comli.com
	 * @keterangan : Controller untuk modul saldo awal keuangan
	 **/
	
	
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_keuangan_keluar','M_keuangan_keluar');
		$this->load->helper('simkeu_nota');
		$this->session->set_userdata('menuapp', '100');
		$this->session->set_userdata('submenuapp', '120');
		
	}

	public function index()
	{
		$cek = $this->session->userdata('level');		
		$unit= $this->session->userdata('unit');	
        		
		if(!empty($cek))
		{	
		  	 
		  $q1 = 
				"select a.keluar_register, a.keluar_nomor, a.keluar_tanggal,  a.keluar_uraian, sum(b.keluard_jumlah) as jumlah, a.keluar_status, a.keluar_cekgirotanggal
				from
				   tr_pengeluaran a,
				   tr_pengeluarand b
				where
				   a.keluar_register=b.keluard_register and
				   year(a.keluar_tanggal)= (select periode_tahun from ms_identity) and
				   month(a.keluar_tanggal)= (select periode_bulan from ms_identity) 
				group by
				   a.keluar_tanggal, a.keluar_nomor, a.keluar_uraian, a.keluar_status
				order by
				   a.keluar_tanggal, a.keluar_nomor desc";

		  $level=$this->session->userdata('level');		
		  $akses= $this->M_global->cek_menu_akses($level, 122);
		  $d['akses']= $akses;		   
		  $bulan  = $this->M_global->_periodebulan();
          $nbulan = $this->M_global->_namabulan($bulan);
		  $periode= 'Periode '.$nbulan.'-'.$this->M_global->_periodetahun();	   
	      $d['keu'] = $this->db->query($q1)->result();
          $d['periode'] = $periode;		  
		  $this->load->view('keuangan/v_keuangan_keluar',$d);			   
		
		} else
		{
			
			header('location:'.base_url());
			
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
				"select a.keluar_register, a.keluar_nomor, a.keluar_tanggal,  a.keluar_uraian, sum(b.keluard_jumlah) as jumlah, a.keluar_status, a.keluar_cekgirotanggal
				from
				   tr_pengeluaran a,
				   tr_pengeluarand b
				where
				   a.keluar_register=b.keluard_register and
				   a.keluar_tanggal between '$_tgl1' and '$_tgl2' 
				group by
				   a.keluar_tanggal, a.keluar_nomor, a.keluar_uraian, a.keluar_status
				order by
				   a.keluar_tanggal, a.keluar_nomor desc";

		  $level=$this->session->userdata('level');		
		  $akses= $this->M_global->cek_menu_akses($level, 122);
		  $d['akses']= $akses;
		  $periode= 'Periode '.date('d-m-Y',strtotime($tgl1)).' s/d '.date('d-m-Y',strtotime($tgl2));	   
	      $d['keu'] = $this->db->query($q1)->result();
          $d['periode'] = $periode;		  
		  $this->load->view('keuangan/v_keuangan_keluar',$d);			   
		}
		} else
		{
			
			header('location:'.base_url());
			
		}
			
		
	}
		
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
		  
		    $queryh = "select * from tr_pengeluaran where keluar_register = '$param'";
			$queryd = "select * from tr_pengeluarand inner join ms_akun on tr_pengeluarand.keluard_akun=ms_akun.kodeakun where keluard_register = '$param'";
			 
		    $header = $this->db->query($queryh)->row();
			$detil  = $this->db->query($queryd)->result();
		    $pdf=new simkeu_nota();
			$pdf->setID($nama_usaha,$alamat1,$alamat2);
			$pdf->setjudul('');
			$pdf->setsubjudul('');
			$pdf->addpage("P","A4");   
			$pdf->setsize("P","A4");
			$pdf->SetWidths(array(70,30,90));
			$border = array('B','','BT');
			$size   = array('','','');
			$pdf->setfont('Arial','B',18);
			$pdf->SetAligns(array('C','C','C'));
			$align = array('L','C','L');
			$style = array('','','B');
			$size  = array('12','','18');
			$max   = array(5,5,20);
			$judul=array('Penerima','','Pembayaran');
			$fc     = array('0','0','0');
			$hc     = array('20','20','20');
			$pdf->FancyRow2(10,$judul, $fc,  $border, $align, $style, $size, $max);
			$pdf->ln(1);
			$pdf->setfont('Arial','B',10);
			$pdf->SetWidths(array(70,30,30,5,55));
			$border = array('','','','','');
			$fc     = array('0','0','0','0','0');
			//$pdf->SetFillColor(230,230,230);
			//$pdf->settextcolor(10,20,200);
			$pdf->setfont('Arial','',9);
		
			$pdf->FancyRow(array($header->keluar_penerima,'','Nomor',':',$header->keluar_nomor), $fc, $border);
			$pdf->FancyRow(array('','','Tanggal',':',date('d M Y',strtotime($header->keluar_tanggal))), $fc, $border);
			$pdf->FancyRow(array('','','No. Cek',':',$header->keluar_cekgironomor), $fc, $border);			
			$fc     = array('1','0','0','0','0');			
			$pdf->ln(3);
			
			$pdf->SetWidths(array(70,80,5,35));
			$border = array('TB','TB','TB','TB');
			$align  = array('L','L','L','R');
			$pdf->setfont('Arial','B',10);
			//$pdf->SetFillColor(0,0,139);
			//$pdf->settextcolor(255,255,255);
			$fc = array('0','0','0','0');
			$judul=array('Nama Beban / Biaya','Uraian','','Nilai');
			$pdf->FancyRow2(8,$judul,$fc, $border,$align);
			$border = array('','','','');
			$pdf->setfont('Arial','',10);
			$tot = 0;
			$subtot = 0;
			$tdisc  = 0;
			$border = array('','','','');
			$align  = array('L','L','L','R');
			$fc = array('0','0','0','0');
			//$pdf->SetFillColor(0,0,139);
			//$pdf->settextcolor(0);
			$tot = 0;			
			foreach($detil as $db)
			{
			  $tot = $tot + $db->keluard_jumlah; 	
			  $pdf->FancyRow(array($db->namaakun, $db->keluard_uraian,'', number_format($db->keluard_jumlah,0,'.',',')),$fc, $border, $align);
			  
			}
			
					
			$pdf->SetFillColor(230);
			$border = array('B','B','B','B');
			$pdf->FancyRow(array('', '', '',''),0,$border);
			$pdf->ln(2);
			$pdf->SetWidths(array(100,20,35,35));
			$border = array('','','TB','TB');
			$align  = array('L','C','L','R');
			//$pdf->SetFillColor(0,0,139);
			//$pdf->settextcolor(255,255,255);
			$fc = array('0','0','0','0');
			$pdf->FancyRow2(7, array('', '','Total', number_format($tot,0,'.',',')),$fc, $border, $align,0);
			$pdf->settextcolor(0);
			$fc = array('0','0','0','0');
			$border = array('','','','');
			$border = array('','','','');
			$pdf->FancyRow(array('', '','', ''),$fc, $border, $align,0);
			$border = array('','','','','','');
			$pdf->SetWidths(array(50,10,50,10,60,10));
			$border = array('','','','','','');
			$align  = array('C','C','C','C','C','C');
			$fc = array('0','0','0','0','0','0');
			$pdf->FancyRow(array('Dibuat Oleh,','','Diterima Oleh,', '','Disetujui Oleh, ',''),$fc, $border, $align);
			$fc = array('0','0','0','0','0','0');
			$pdf->FancyRow(array('','', '','','',''),$fc, $border, $align);
			$pdf->FancyRow(array('','', '','','',''),$fc, $border, $align);
			
			$style = array('','','','','','');
			$size  = array('','','','','','');
			$border = array('T','','B','','','');
			$pdf->SetFillColor(0,0,139);
			$pdf->settextcolor(255,255,255);
			$pdf->settextcolor(0);
			$fc = array('0','0','0','0','0','0');
			$align  = array('C','C','C','C','C','C');
			$pdf->setfont('Arial','',10);
			$pdf->SetWidths(array(50,10,50,10,60,10));
			$pdf->ln(5);
			$border = array('','','','','','');
			$pdf->FancyRow(array('','', '','','',''),$fc, $border, $align, $style, $size);
			$border = array('B','','B','','B','');
			$pdf->FancyRow(array('','', '','','',''),$fc, $border, $align, $style, $size);
			$border = array('','','','','','');
			$align  = array('L','C','L','C','L','C');
			$pdf->FancyRow(array('Tgl.','','Tgl.','', 'Tgl.',''),$fc, $border, $align, $style, $size);
			$pdf->settextcolor(0);
			$pdf->AliasNbPages();
			$pdf->output($param.'.PDF','I');			
		}
		else
		{
			
			header('location:'.base_url());
			
		}
	}
	
	
	public function cetaks($param)
	{
	        $profile = $this->M_global->_LoadProfileLap();	
		    $unit= $this->session->userdata('unit');	 
		    $nama_usaha=$profile->nama_usaha;
			$motto = '';
			$alamat= $profile->alamat1;
			$namaunit = $this->M_global->_namaunit($unit);
		  
		    $queryh = "select * from tr_pengeluaran where keluar_register = '$param'";
			$queryd = "select * from tr_pengeluarand inner join ms_akun on tr_pengeluarand.keluard_akun=ms_akun.kodeakun where keluard_register = '$param'";
			 
		    $detil  = $this->db->query($queryd)->result();
			$header = $this->db->query($queryh)->row();
		    $pdf=new simkeu_nota();
			$pdf->setID($nama_usaha,$motto,$alamat);
			$pdf->setunit($namaunit);
			$pdf->setjudul('');
			$pdf->setsubjudul('');
			$pdf->addpage("P","A4");   
			$pdf->setsize("P","A4");
			$pdf->SetWidths(array(70,30,90));
			$border = array('','','BT');
			$pdf->setfont('Times','B',18);
			$pdf->SetAligns(array('C','C','C'));
			$judul=array('','','Pembayaran');
			$pdf->FancyRow2(10,$judul, $border);
			$pdf->setfont('Times','B',10);
			$pdf->SetWidths(array(70,30,30,5,60));
			$border = array('','','','','');
			$pdf->SetFillColor(10,10,10);
			//$pdf->settextcolor(10,20,200);
			$pdf->FancyRow(array('','','Nomor',':',$header->keluar_nomor), $border);
			$pdf->FancyRow(array('','','Tanggal',':',date('d-m-Y',strtotime($header->keluar_tanggal))), $border);
			$pdf->FancyRow(array('','','No. Cek',':',$header->keluar_cekgironomor), $border);
			
			$pdf->SetWidths(array(100,20,70));
			$border = array('TB','TB','TB');
			$align  = array('L','','R');
			$pdf->setfont('Times','B',10);
			$pdf->SetAligns(array('L','C','R'));
			$judul=array('Nama Beban/Biaya','','Nilai');
			$pdf->FancyRow2(6,$judul, $border,$align);
			$border = array('','','');
			$pdf->setfont('Times','',10);
			$tot = 0;
			foreach($detil as $db)
			{
			  $tot = $tot + $db->keluard_jumlah; 	
			  $pdf->FancyRow(array($db->namaakun, '', number_format($db->keluard_jumlah,0,'.',',')),$border, $align);
			  
			}
			$border = array('B','B','B');
			$pdf->FancyRow(array('', '', ''),$border);
			$pdf->ln(2);
			$pdf->SetWidths(array(100,20,20,50));
			$border = array('TB','','TB','TB');
			$align  = array('L','','L','R');
			$pdf->FancyRow(array('Keterangan', '', 'Total',number_format($tot,0,'.',',')),$border, $align);
			$border = array('','','','');
			$pdf->FancyRow(array($header->keluar_uraian, '', ''),$border, $align);
			$pdf->SetWidths(array(140,50));
			$pdf->SetFont('Times','',9);
			$pdf->SetAligns(array('C','C'));
			$pdf->ln(5);
			$border = array('','',);
			$align  = array('L','C');
			$pdf->SetAligns(array('C','C','C'));
			$pdf->FancyRow(array('','Disetujui Oleh, '),$border, $align);
			$pdf->ln(1);
			$pdf->ln(15);
			$pdf->SetWidths(array(140,50));
			$pdf->SetFont('Times','',8);
			$pdf->SetAligns(array('C','L'));
			$border = array('','B');	
			$pdf->FancyRow(array('',''),$border,$align);
			$border = array('','');	
			$align  = array('L','L');
			$pdf->FancyRow(array('','Tgl.'),$border,$align);
	
			$pdf->SetWidths(array(10,30,20,90,35));
			$pdf->SetAligns(array('C','C','C','L','R'));
			$pdf->setfont('Times','',9);
			$pdf->SetFillColor(224,235,255);
			$pdf->SetTextColor(0);
			$pdf->SetFont('');
				
			$nourut = 1;
            


			$pdf->AliasNbPages();
			$pdf->output($param.'.PDF','I');
		
	}
	/*
	public function cetak($param)
	{
		$cek = $this->session->userdata('level');		
		$unit= $this->session->userdata('unit');		
		if(!empty($cek))
		{				  		 
          $d['master_bank'] = $this->db->get("ms_bank");
          $d['nama_usaha']=$this->config->item('nama_perusahaan');
		  $d['alamat']=$this->config->item('alamat_perusahaan');
		  $d['motto']=$this->config->item('motto');
		  $d['nomor']=$param;
		  $d['jenis']=1;
		  
		  $d['unit'] = $this->session->userdata('unit');
            
		 
		  $qheader = "select * from tr_pengeluaran inner join ms_akun on tr_pengeluaran.keluar_kasbank=ms_akun.kodeakun where keluar_register = '$param'";
		  $header=$this->db->query($qheader)->result();
		  
		  $query = "select sum(keluard_jumlah) as jumlah from tr_pengeluarand where keluard_register = '$param'";
		  $data = $this->db->query($query)->result();
		  foreach($data as $row){
		   $jumlah=$row->jumlah;	  
		  }
		  $d['jumlah']=$jumlah;
		  $d['terbilang']=ucwords($this->M_global->terbilang($jumlah)).' Rupiah';
		  $kasbank = '';
		  $namabank = '';
		  foreach($header as $row)
			{
			$d['kasbank'] = $row->keluar_kasbank;
			$kasbank = $row->keluar_kasbank;
			$d['ket']= $row->keluar_uraian;
			$d['tanggal']= date('d-m-Y',strtotime($row->keluar_tanggal));
			$d['penerima']= $row->keluar_penerima;
			$d['pasar']= $row->keluar_kodecbg;
			$d['nond']= $row->keluar_nd;
			$d['nobukti']= $row->keluar_nomor;
			if($row->keluar_cekgiro=='T')
			{ $pembayaran = 'Tunai'; } else
			if($row->keluar_cekgiro=='C')	
			{ $pembayaran = 'Cek'; } else
			if($row->keluar_cekgiro=='G')	
			{ $pembayaran = 'Giro'; };

		    $d['pembayaran']=$pembayaran;
			$d['nogiro']= $row->keluar_cekgironomor;
			$tglgiro= $row->keluar_cekgirotanggal;
			}
			
			if($tglgiro=='1970-01-01')
			{
				$tglgiro='';
			} else
			{
				$tglgiro=date('d-m-Y',strtotime($tglgiro));
			}
			$d['tglgiro']=$tglgiro;

			
			$query="select bank_nama from ms_bank where bank_kode = '$kasbank'";
			$data = $this->db->query($query);
			foreach($data->result() as $row){
			$namabank=$row->bank_nama;
			}
			$d['namabank']=$namabank;

		  
		 
		  
		  $qdetil ="select * from tr_pengeluarand where keluard_register = '$param'"; 	
		  $d['detil']=$this->db->query($qdetil)->result();
		  
		  $this->load->view('keuangan/v_keuangan_keluar_voucher',$d);				
		}
		else
		{
			
			header('location:'.base_url());
			
		}
	}
	
	*/
	
	
	
	public function entri()
	{
		$cek = $this->session->userdata('level');		
		$uid = $this->session->userdata('unit');		
		if(!empty($cek))
		{				  
		  $page=$this->uri->segment(3);
		  $limit=$this->config->item('limit_data');	
          $d['bank'] = $this->db->get_where('ms_akun',array('akuninduk !=' => '','kelompok' => 'BANK'))->result();
		  $d['unit'] = $this->db->get('ms_unit')->result();
		  $d['nomor']= $this->M_global->_Autonomor('KK');
		  $this->load->view('keuangan/v_keuangan_keluar_add',$d);				
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
		   $this->M_keuangan_keluar->hapus_pengeluaran($nomor);	
           $this->db->delete('tr_jurnal',array('novoucher' => $nomor,'jenis' => 'JK', 'wbs' => 'KK'));			   		   
		}
		else
		{
			
			header('location:'.base_url());
			
		}
	}
	
	
	public function getakun($kode)
	{
		if(!empty($kode))
		{
		  
			$q = $kode;
			$query = "select * from ms_akun where kodeakun like '%$q%' or namaakun like '%$q%' and akuninduk<>''";
			$data  = $this->db->query($query);
			?>
			
			<table id="myTable">
			  <tr class="header">
				<th style="width:20%;">Kode</th>
				<th style="width:80%;">Nama</th>	
			  </tr> 
			  
			<?php							
			foreach($data->result_array() as $row)
			{ ?>
			   <tr>
				 <td width="50" align="center">
					<a href="#" onclick="post_value('<?php echo $row['kodeakun'];?>','<?php echo $row['namaakun'];?>')">
					
					<?php echo $row['kodeakun'];?></a>
				 </td>	     
				 <td><?php echo $row['namaakun'];?></td>
			   </tr>
			   
			   <?php
			}
			echo "</table>";
		} else
        {
		  echo "";	
		}			
	}
	
	public function getakunname($kode)
	{
		if(!empty($kode))
		{			
	        $query = "select namaakun from ms_akun where kodeakun = '$kode'";
			$data  = $this->db->query($query);
			foreach($data->result_array() as $row)
			{
              echo $row['namaakun'];				
			}
		} else
		{
		  echo "";	
		}
	}
	
	public function getcoa(){

      // Search term
      $searchTerm = $this->input->post('searchTerm');

      // Get users
      $response = $this->M_keuangan_keluar->getcoa($searchTerm);

      echo json_encode($response);
   }
   
	
	
	public function getnobukti()
	{
		//if(!empty($kode))
		{	
            $tahun = $this->M_global->_periodetahun();
			$unit  = $this->session->userdata('unit');
	       
			$query = "select max(keluar_nomor) as nomor from tr_pengeluaran where  year(keluar_tanggal)='$tahun' and keluar_kodecbg='$unit'";	
			
			$data  = $this->db->query($query);
			foreach($data->result() as $row)
			{
			 
			  $no = $row->nomor;				
			}
			if($no=='')
			{
			  $nomor = 0;	
			} else
			{
			  $nomor = (int)$no;	
			}
			$nomor++;
			$nourut = str_pad($nomor, 4, "0", STR_PAD_LEFT);
			echo $nourut;
			
		} 
	}
	
	public function pengeluaran_save($kode)
	{
		$cek = $this->session->userdata('level');
		if(!empty($cek))
		{			            
			
			$tahun = date('Y',strtotime($this->input->post('tanggal')));
			$bulan = date('m',strtotime($this->input->post('tanggal')));
			$kodebukti = $this->db->get_where('ms_akun', array('kodeakun' => $this->input->post('kasbank')))->row()->kodek;
			$vbukti = $kodebukti.'%';
			$query = 'select * from tr_penerimaan where terima_nomor like "'.$vbukti.'" and year(terima_tanggal)= "'.$tahun.'" and month(terima_tanggal)="'.$bulan.'"';
			$max = $this->db->query($query)->nuM_rows();
			$nourut  = $max+1;
			$nobukti  = $kodebukti.''.$tahun.'.'.$bulan.'.'.str_pad( $nourut, 4, '0', STR_PAD_LEFT );	
			
			$userid   = $this->session->userdata('username');
			
			if($kode==2){
			  $register = $this->input->post('register');			  	
			  $nobukti  = $this->input->post('nomorbukti');	
			}
			
			$data = array(
				'keluar_nomor' => $nobukti,
				'keluar_tanggal' => date('Y-m-d',strtotime($this->input->post('tanggal'))),
				'keluar_kasbank' => $this->input->post('kasbank'),
				'keluar_cekgiro' => $this->input->post('pembayaran'),
				'keluar_cekgirotanggal' => date('Y-m-d',strtotime($this->input->post('tanggalcek'))),
				'keluar_cekgironomor' => $this->input->post('nomorcek'),
				'keluar_penerima' => $this->input->post('penerima'),
				'keluar_uraian' => $this->input->post('keterangan'),
				'keluar_kodecbg' => $this->input->post('unit'),
				'keluar_userentry' => $userid,
				'keluar_status' => 2,
				
			);
						
			$whereh = array(
		    'keluar_nomor' => $nobukti
	        );
			
			$whered = array(
		    'keluard_nomor' => $nobukti
	        );
	
	        
			
			if($kode==1)
			{
			  $this->M_keuangan_keluar->input_data($data,"tr_pengeluaran");	
			  $register = $this->db->insert_id();
			 
			} else {
			  $this->M_keuangan_keluar->update_data($whereh,$data,'tr_pengeluaran');	
              $this->M_keuangan_keluar->hapus_data($whered,'tr_pengeluarand');
              $register = $this->input->post('register');			  
			}
			
			
			$kodeakun = $this->input->post('akun');
			$ket      = $this->input->post('ket');
		    $jumlah   = $this->input->post('jumlah');
		   
			$jumdata  = count($kodeakun);
			
			
			$nourut = 1;
			$this->db->delete('tr_jurnal',array('novoucher' => $nobukti,'jenis' => 'JK', 'wbs' => 'KK'));			
			$tot = 0;
			for($i=0;$i<=$jumdata-1;$i++)
			{
			    $_akun   = $kodeakun[$i];
				$tot = $tot + str_replace(',','',$jumlah[$i]);
			    $datad = array(
				'keluard_register' => $register,
				'keluard_nomor' => $nobukti,
				'keluard_nourut' => $nourut,
				'keluard_akun' => $kodeakun[$i],
				'keluard_uraian' => $ket[$i],
				'keluard_jumlah' => str_replace(',','',$jumlah[$i])
							
			    );
				if ($_akun!="")
			    {
			        $this->M_keuangan_keluar->input_data($datad,'tr_pengeluarand');
                    
					$data_jurnal = array (
					   'novoucher' => $nobukti,
					   'noref' => $register,
					   'tanggal' => date('Y-m-d',strtotime($this->input->post('tanggal'))),
					   'keterangan' => $this->input->post('keterangan'),
					   'nourut' => $nourut,
					   'jenis' => 'JK',
					   'wbs' => 'KK',
					   'kodeakun' => $kodeakun[$i],
					   'debet' => str_replace(',','',str_replace(',','',$jumlah[$i])),
					   'kredit' => 0,
					   'userid' => $userid,			
					);
					$this->db->insert('tr_jurnal',$data_jurnal);				  
				    $nourut++;
				}  	
				
			}
			
		    $data_jurnal = array (
			   'novoucher' => $nobukti,
			   'noref' => $register,
			   'tanggal' => date('Y-m-d',strtotime($this->input->post('tanggal'))),
			   'keterangan' => $this->input->post('keterangan'),
			   'nourut' => $nourut,
			   'jenis' => 'JK',
			   'wbs' => 'KK',
			   'kodeakun' => $this->input->post('kasbank'),
			   'debet' => 0,
			   'kredit' => $tot,
			   'userid' => $userid,			
			);
			$this->db->insert('tr_jurnal',$data_jurnal);				  
			//$this->M_global->_updatecounter1('JU');
						
			echo $nobukti;
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
					
			$qheader ="select * from tr_pengeluaran where keluar_register = '$nomor'"; 		
			$qdetil ="select * from tr_pengeluarand inner join ms_akun on tr_pengeluarand.keluard_akun=ms_akun.kodeakun where keluard_register = '$nomor'"; 		
			
			$d['header'] = $this->db->query($qheader);
			$d['detil'] = $this->db->query($qdetil)->result();
			$d['jumdata'] = $this->db->query($qdetil)->num_rows();	

            $data=$this->db->query($qheader);
			foreach($data->result() as $row){
			$kasbank = $row->keluar_kasbank;
			$d['tanggal']=$row->keluar_tanggal;
			$d['register']=$row->keluar_register;
		    $d['nomor']=$row->keluar_nomor;
			$d['uraian']=$row->keluar_uraian;
			$d['unit']=$row->keluar_kodecbg;
			$d['kasbank']=$row->keluar_kasbank;
			$d['penerima']=$row->keluar_penerima;	
			$d['userentry']=$row->keluar_userentry;	
			$d['pembayaran']=$row->keluar_cekgiro;	
			$d['pembayaran_tgl']=$row->keluar_cekgirotanggal;
            $d['pembayaran_nomor']=$row->keluar_cekgironomor;
            $d['nond']=$row->keluar_nd;			
						
			
			
            }

           
			$d['bank'] = $this->db->get_where('ms_akun',array('akuninduk !=' => '','kelompok' => 'BANK'))->result();
		    $d['unit'] = $this->db->get('ms_unit')->result();
			$this->load->view('keuangan/v_keuangan_keluar_edit',$d);
			} else
		{
			header('location:'.base_url());
		}	
	}
}
/* End of file keuangan_saldo.php */
/* Location: ./application/controllers/keuangan_saldo.php */