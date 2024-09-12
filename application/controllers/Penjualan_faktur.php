<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penjualan_faktur extends CI_Controller {

	/**
	 * @author : Enjang RK
	 * @web : http://e-soft.comli.com
	 * @keterangan : Controller untuk modul saldo awal keuangan
	 **/
	
	
	
	
	public function __construct()
	{
		parent::__construct();
		$this->session->set_userdata('menuapp', '400');
		$this->session->set_userdata('submenuapp', '423');
		$this->load->helper('simkeu_nota1');		
		$this->load->helper('simkeu_nota');		
	}

	public function index()
	{
		$cek = $this->session->userdata('level');		
		$unit= $this->session->userdata('unit');	
        		
		if(!empty($cek))
		{	
		  	 
		  $q1 = 
				"select a.kodesi, a.tglsi, b.nama, a.ket, a.statusid, a.tgljthtempo, a.totalsi as total
				from
				   ar_sifile a,
				   ar_customer b
				where
				   a.kodecust=b.kode and
				   year(a.tglsi)= (select periode_tahun from ms_identity) and
				   month(a.tglsi)= (select periode_bulan from ms_identity) and
				   a.kodecbg = '$unit'
				order by
				   a.tglsi, a.kodesi desc";

		  $bulan  = $this->M_global->_periodebulan();
          $nbulan = $this->M_global->_namabulan($bulan);
		  $periode= 'Periode '.$nbulan.'-'.$this->M_global->_periodetahun();	   
	      $d['keu'] = $this->db->query($q1)->result();
		  $level=$this->session->userdata('level');		
		  $akses= $this->M_global->cek_menu_akses($level, 423);
		  $d['akses']= $akses;
          $d['periode'] = $periode;		  
		  $this->load->view('penjualan/v_penjualan_faktur',$d);			   
		
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
				"select a.kodesi, a.tglsi, b.nama, a.ket, a.statusid, a.tgljthtempo, a.totalsi as total
				from
				   ar_sifile a,
				   ar_customer b
				where
				   a.kodecust=b.kode and
				   a.tglsi between '$_tgl1' and '$_tgl2' and 				 
				   a.kodecbg = '$unit'
				order by
				   a.tglsi, a.kodesi desc";
		  
		  $periode= 'Periode '.date('d-m-Y',strtotime($tgl1)).' s/d '.date('d-m-Y',strtotime($tgl2));	   
	      $d['keu'] = $this->db->query($q1)->result();
		  $level=$this->session->userdata('level');		
		  $akses= $this->M_global->cek_menu_akses($level, 423);
		  $d['akses']= $akses;
          $d['periode'] = $periode;		  
		  $this->load->view('penjualan/v_penjualan_faktur',$d);			   
		}
		} else
		{
			
			header('location:'.base_url());
			
		}
			
		
	}
		
	public function cetak2($param)
	{
		$cek = $this->session->userdata('level');		
		$unit= $this->session->userdata('unit');
        $userid   = $this->session->userdata('username');		
		if(!empty($cek))
		{				  		 
            $profile = $this->M_global->_LoadProfileLap();	
		    $unit= $this->session->userdata('unit');	 
		    $nama_usaha=$profile->nama_usaha;
			$alamat1  = $profile->alamat1;
			$alamat2  = $profile->alamat2;
		  
		    $queryh = "select * from ar_sifile inner join ar_customer on ar_sifile.kodecust=ar_customer.kode where kodesi = '$param'";
			$queryd = "select * from ar_sidetail inner join inv_barang on ar_sidetail.kodeitem=inv_barang.kodeitem where ar_sidetail.kodesi = '$param'";
			$queryb = "select sum(jumlah) as total from ar_sibiaya  where ar_sibiaya.kodesi = '$param'";
			 
		    $detil  = $this->db->query($queryd)->result();
			$header = $this->db->query($queryh)->row();
			$biaya  = $this->db->query($queryb)->row();
		    $pdf=new simkeu_nota1();
			$pdf->setID($nama_usaha,$alamat1,$alamat2);
			$pdf->setjudul('');
			$pdf->setsubjudul('');
			$pdf->addpage("P","A4");   
			$pdf->setsize("P","A4");
			$pdf->SetWidths(array(70,30,90));
			$border = array('T','','BT');
			$size   = array('','','');
			$pdf->setfont('Arial','B',10);
			$pdf->SetAligns(array('C','C','C'));
			$align = array('L','C','L');
			$style = array('','','B');
			$size  = array('12','','18');
			$max   = array(5,5,20);
			$judul=array('Kepada :','','Faktur Penjualan');
			$fc     = array('0','0','0');
			$hc     = array('20','20','20');
			//$pdf->FancyRow2(10,$judul, $fc,  $border, $align, $style, $size, $max);
			$pdf->ln(1);
			$pdf->setfont('Arial','B',10);
			$pdf->SetWidths(array(70,30,90));
			$border = array('','','');
			$fc     = array('0','0','0');
			$pdf->SetFillColor(230,230,230);			
			$pdf->setfont('Arial','',9);
			$pdf->SetAligns(array('L','L','L'));
			$pdf->FancyRow(array($nama_usaha,'',$profile->kota.','.date('d-m-Y',strtotime($header->tglsi))), $fc, $border);
			$pdf->FancyRow(array($alamat1,'','Kepada Yth.,'), $fc, $border);
			$pdf->FancyRow(array($alamat2,'',$header->nama), $fc, $border);
			$pdf->SetWidths(array(90,60,40));
			$border = array('','','');
			$fc     = array('0','0','0');
			$pdf->SetFillColor(230,230,230);			
			$pdf->setfont('Arial','',9);
			$pdf->SetAligns(array('L','L','L'));
			$pdf->ln(5);
			$pdf->FancyRow(array('No. Faktur : '.$header->kodesi,'Tgl. Jatuh Tempo : '.date('d-m-Y',strtotime($header->tgljthtempo)),'Sales : '), $fc, $border);
			$pdf->ln(2);
			
			$pdf->SetWidths(array(20,45,20,20,20,20,20,25));
			$border = array('TB','TB','TB','TB','TB','TB','TB','TB');
			$align  = array('L','L','L','L','R','R','R','R');
			$pdf->setfont('Arial','B',8);
			$pdf->SetAligns(array('L','C','R'));
			//$pdf->SetFillColor(0,0,139);
			//$pdf->settextcolor(255,255,255);
			$fc = array('1','1','1','1','1','1','1','1');
			$judul=array('Qty','Nama Barang','Type','Merk','Harga','Disc','Netto','Sub Total');
			$pdf->FancyRow2(8,$judul,$fc, $border,$align);
			$border = array('','','');
			$pdf->setfont('Arial','',8);
			$tot = 0;
			$subtot = 0;
			$tdisc  = 0;
			$border = array('','','','','','','','');
			$align  = array('L','L','L','L','R','R','R','R');
			$fc = array('0','0','0','0','0','0','0','0');
			//$pdf->SetFillColor(0,0,0);
			//$pdf->settextcolor(0);
			foreach($detil as $db)
			{
			  $discsat = ($db->disc/100)*$db->hargajual;
			  
			  $data_barang = $this->db->get_where('inv_barang', array('kodeitem' => $db->kodeitem))->row();
			  $id_merk = $data_barang->kdmerk;
			  $id_kateg= $data_barang->kdkategori;
			  
			  $data_merk = $this->db->get_where('inv_merk', array('kode' => $id_merk))->row();
			  if($data_merk){
				  $merk = $data_merk->nama;
			  } else {
				  $merk = '';
				  
			  }
			  
			  $data_kateg = $this->db->get_where('inv_kategori', array('kode' => $id_kateg))->row();
			  if($data_kateg){
				  $type = $data_kateg->nama;
			  } else {
				  $type = '';
				  
			  }
			  
			  
			  $dpp = $db->qtysi*$db->hargajual;	
			  $dis = ($db->disc/100)*$dpp;
			  $net = $db->hargajual-$discsat;
			  $jum = $dpp-$dis;
			  $tot = $tot + $jum; 	
			  
			  
			  $subtot = $subtot + $dpp; 	
			  $tdisc  = $tdisc + $dis; 	
			  
			  $pdf->FancyRow(array(
			  $db->qtysi.' '.$db->satuan,
			  $db->namabarang,
			  $type,
			  $merk,
			  number_format($db->hargajual,0,'.',','),
			  number_format($discsat,0,'.',','),
			  number_format($net,0,'.',','),
			  number_format($jum,0,'.',',')),$fc, $border, $align);
			  
			}
			
			
			if($header->sppn=="Y"){
			    $ppn = $subtot * 0.1;
			} else {
				$ppn = 0;
			}
			$biayalain = $biaya->total;
			$tot = $tot + $ppn + $biayalain;
			$pdf->SetFillColor(230);
			$border = array('B','B','B','B','B','B','B','B');
			$pdf->FancyRow(array('', '', '','','','','',''),0,$border);
			$pdf->ln(2);
			$pdf->SetWidths(array(100,20,30,40));
			$border = array('','','','');
			$align  = array('L','','L','R');
			$pdf->SetFillColor(230,230,230);
			$pdf->settextcolor(0);
			$fc = array('0','0','0','0');
			$pdf->FancyRow(array('Pembayaran Giro/Cek dianggap sah apabila telah diuangkan', '', 'TOTAL',number_format($subtot,0,'.',',')),$fc, $border, $align,0);
			
			$pdf->SetWidths(array(190));
			$border = array('B');
			$pdf->FancyRow(array(''),0,$border);
			
			
			$pdf->settextcolor(0);
			$pdf->SetWidths(array(80,40,20,40));
			$pdf->SetFont('Arial','',9);
			$pdf->SetAligns(array('L','C','C','C'));
			$pdf->ln(5);
			
			$border = array('','','','');
			$align  = array('L','C','C','C');
			$pdf->FancyRow(array($userid.' : '.date('d-m-Y H:i:s'),'Penerima','','Hormat Kami'),0,$border, $align);
			$pdf->ln(1);
			$pdf->ln(15);
			$pdf->SetWidths(array(80,40,20,40));
			$pdf->SetFont('Arial','',8);
			$pdf->SetAligns(array('L','C','C','C'));
			$border = array('','B','','B');	
			$pdf->FancyRow(array('','','',''),0,$border,$align);
		
		

			$pdf->AliasNbPages();
			$pdf->output($param.'.PDF','I');			
		}
		else
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
		  
		    $queryh = "select * from ar_sifile inner join ar_customer on ar_sifile.kodecust=ar_customer.kode where kodesi = '$param'";
			$queryd = "select ar_sidetail.*, inv_barang.namabarang from ar_sidetail inner join inv_barang on ar_sidetail.kodeitem=inv_barang.kodeitem where ar_sidetail.kodesi = '$param'";
			$queryb = "select sum(jumlah) as total from ar_sibiaya  where ar_sibiaya.kodesi = '$param'";
			 
		    $detil  = $this->db->query($queryd)->result();
			$header = $this->db->query($queryh)->row();
			$biaya  = $this->db->query($queryb)->row();
		    $pdf=new simkeu_nota();
			$pdf->setID($nama_usaha,$alamat1,$alamat2);
			$pdf->setjudul('');
			$pdf->setsubjudul('');
			$pdf->addpage("P","A4");   
			$pdf->setsize("P","A4");
			$pdf->SetWidths(array(70,30,90));
			$border = array('T','','BT');
			$size   = array('','','');
			$pdf->setfont('Arial','B',18);
			$pdf->SetAligns(array('C','C','C'));
			$align = array('L','C','L');
			$style = array('','','B');
			$size  = array('12','','18');
			$max   = array(5,5,20);
			$judul=array('Kepada :','','Faktur Penjualan');
			$fc     = array('0','0','0');
			$hc     = array('20','20','20');
			$pdf->FancyRow2(10,$judul, $fc,  $border, $align, $style, $size, $max);
			$pdf->ln(1);
			$pdf->setfont('Arial','B',10);
			$pdf->SetWidths(array(70,30,30,5,55));
			$border = array('','','','','');
			$fc     = array('0','0','0','0','0');
			$pdf->SetFillColor(230,230,230);			
			$pdf->setfont('Arial','',9);
			$pdf->FancyRow(array($header->nama,'','Nomor',':',$header->kodesi), $fc, $border);
			$pdf->FancyRow(array($header->alamat1,'','Tanggal',':',date('d M Y',strtotime($header->tglsi))), $fc, $border);
			$pdf->FancyRow(array($header->alamat2,'','Tgl. Kirim',':',date('d M Y',strtotime($header->tglkirim))), $fc, $border);
			$pdf->FancyRow(array($header->telp,'','Jatuh Tempo',':',date('d M Y',strtotime($header->tgljthtempo))), $fc, $border);
			$pdf->FancyRow(array('','','Mata Uang',':',$header->matauang), $fc, $border);
			$pdf->FancyRow(array('','','Kurs',':',number_format($header->kurs,0,'.',',')), $fc, $border);
			
			$pdf->ln(2);
			
			$pdf->SetWidths(array(30,60,20,25,25,30));
			$border = array('TB','TB','TB','TB','TB','TB');
			$align  = array('L','L','R','R','R','R');
			$pdf->setfont('Arial','B',10);
			$pdf->SetAligns(array('L','C','R'));
			//$pdf->SetFillColor(0,0,139);
			//$pdf->settextcolor(255,255,255);
			$fc = array('0','0','0','0','0','0');
			$judul=array('Kode Barang','Nama Barang','Qty','Harga','Diskon','Total Harga');
			$pdf->FancyRow2(8,$judul,$fc, $border,$align);
			$border = array('','','');
			$pdf->setfont('Arial','',10);
			$tot = 0;
			$subtot = 0;
			$tdisc  = 0;
			$border = array('','','','','','');
			$align  = array('L','L','R','R','R','R');
			$fc = array('0','0','0','0','0','0');
			$pdf->SetFillColor(0,0,139);
			$pdf->settextcolor(0);
			foreach($detil as $db)
			{
			  $dpp = $db->qtysi*$db->hargajual;	
			  $dis = ($db->disc/100)*$dpp;
			  $jum = $dpp-$dis;
			  $tot = $tot + $jum; 	
			  
			  $subtot = $subtot + $dpp; 	
			  $tdisc  = $tdisc + $dis; 	
			  
			  $pdf->FancyRow(array(
			  $db->kodeitem, 
			  $db->namabarang,
			  $db->qtysi,
			  number_format($db->hargajual,0,'.',','),
			  $db->disc, 
			  number_format($jum,0,'.',',')),$fc, $border, $align);
			  
			}
			
			
			if($header->sppn=="Y"){
			    $ppn = $subtot * 0.1;
			} else {
				$ppn = 0;
			}
			$biayalain = $biaya->total;
			$tot = $tot + $ppn + $biayalain;
			$pdf->SetFillColor(230);
			$border = array('B','B','B','B','B','B');
			$pdf->FancyRow(array('', '', '','','',''),$fc,$border);
			$pdf->ln(2);
			$pdf->SetWidths(array(100,20,30,40));
			$border = array('TB','','T','T');
			$align  = array('L','','L','R');
			//$pdf->SetFillColor(230,230,230);
			//$pdf->settextcolor(0);
			$fc = array('0','0','0','0');
			$pdf->FancyRow(array('Keterangan', '', 'Sub Total',number_format($subtot,0,'.',',')),$fc, $border, $align,0);
			$border = array('','','','');
			$pdf->FancyRow(array($header->ket,'', 'Diskon', number_format($tdisc,0,'.',',')),$fc, $border, $align);
			$pdf->FancyRow(array('','', 'PPN (10%)', number_format($ppn,0,'.',',')),$fc, $border, $align);
			$pdf->FancyRow(array('','', 'Biaya Lain-lain', number_format($biayalain,0,'.',',')),$fc, $border, $align);
			$style = array('','','B','B');
			$size  = array('','','','');
			$border = array('T','','BT','BT');
			//$pdf->SetFillColor(0,0,139);
			//$pdf->settextcolor(255,255,255);
			$fc = array('0','0','0','0');
			$pdf->FancyRow(array('','', 'Total', number_format($tot,0,'.',',')),$fc, $border, $align, $style, $size);
			$pdf->settextcolor(0);
			$pdf->SetWidths(array(50,50));
			$pdf->SetFont('Arial','',9);
			$pdf->SetAligns(array('C','C'));
			$pdf->ln(5);
			
			$border = array('','');
			$align  = array('C','C');
			$pdf->FancyRow(array('Disiapkan Oleh','Disetujui Oleh'),$fc,$border, $align);
			$pdf->ln(1);
			$pdf->ln(15);
			$pdf->SetWidths(array(49,2,49));
			$pdf->SetFont('Arial','',8);
			$pdf->SetAligns(array('C','C','C'));
			$border = array('B','','B');	
			$pdf->FancyRow(array('','',''),$fc,$border,$align);
			$border = array('','','');	
			$align  = array('L','C','L');
			$pdf->FancyRow(array('Tgl.','','Tgl.'),$fc,$border,$align);
	
		

			$pdf->AliasNbPages();
			$pdf->output($param.'.PDF','I');			
		}
		else
		{
			
			header('location:'.base_url());
			
		}
	}
	
	public function email($param)
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
			$email_usaha=$profile->email;
		  
		    $queryh = "select * from ar_sifile inner join ar_customer on ar_sifile.kodecust=ar_customer.kode where kodesi = '$param'";
			$queryd = "select ar_sidetail.*, inv_barang.namabarang from ar_sidetail inner join inv_barang on ar_sidetail.kodeitem=inv_barang.kodeitem where ar_sidetail.kodesi = '$param'";
			$queryb = "select sum(jumlah) as total from ar_sibiaya  where ar_sibiaya.kodesi = '$param'";
			 
		    $detil  = $this->db->query($queryd)->result();
			$header = $this->db->query($queryh)->row();
			$biaya  = $this->db->query($queryb)->row();
		    $pdf=new simkeu_nota();
			$pdf->setID($nama_usaha,$alamat1,$alamat2);
			$pdf->setjudul('');
			$pdf->setsubjudul('');
			$pdf->addpage("P","A4");   
			$pdf->setsize("P","A4");
			$pdf->SetWidths(array(70,30,90));
			$border = array('T','','BT');
			$size   = array('','','');
			$pdf->setfont('Arial','B',18);
			$pdf->SetAligns(array('C','C','C'));
			$align = array('L','C','L');
			$style = array('','','B');
			$size  = array('12','','18');
			$max   = array(5,5,20);
			$judul=array('Kepada :','','Faktur Penjualan');
			$fc     = array('0','0','0');
			$hc     = array('20','20','20');
			$pdf->FancyRow2(10,$judul, $fc,  $border, $align, $style, $size, $max);
			$pdf->ln(1);
			$pdf->setfont('Arial','B',10);
			$pdf->SetWidths(array(70,30,30,5,55));
			$border = array('','','','','');
			$fc     = array('0','0','0','0','0');
			$pdf->SetFillColor(230,230,230);			
			$pdf->setfont('Arial','',9);
			$pdf->FancyRow(array($header->nama,'','Nomor',':',$header->kodesi), $fc, $border);
			$pdf->FancyRow(array($header->alamat1,'','Tanggal',':',date('d M Y',strtotime($header->tglsi))), $fc, $border);
			$pdf->FancyRow(array($header->alamat2,'','Tgl. Kirim',':',date('d M Y',strtotime($header->tglkirim))), $fc, $border);
			$pdf->FancyRow(array($header->telp,'','Jatuh Tempo',':',date('d M Y',strtotime($header->tgljthtempo))), $fc, $border);
			
			$pdf->ln(2);
			
			$pdf->SetWidths(array(30,60,20,25,25,30));
			$border = array('TB','TB','TB','TB','TB','TB');
			$align  = array('L','L','R','R','R','R');
			$pdf->setfont('Arial','B',10);
			$pdf->SetAligns(array('L','C','R'));
			//$pdf->SetFillColor(0,0,139);
			//$pdf->settextcolor(255,255,255);
			$fc = array('0','0','0','0','0','0');
			$judul=array('Kode Barang','Nama Barang','Qty','Harga','Diskon','Total Harga');
			$pdf->FancyRow2(8,$judul,$fc, $border,$align);
			$border = array('','','');
			$pdf->setfont('Arial','',10);
			$tot = 0;
			$subtot = 0;
			$tdisc  = 0;
			$border = array('','','','','','');
			$align  = array('L','L','R','R','R','R');
			$fc = array('0','0','0','0','0','0');
			$pdf->SetFillColor(0,0,139);
			$pdf->settextcolor(0);
			foreach($detil as $db)
			{
			  $dpp = $db->qtysi*$db->hargajual;	
			  $dis = ($db->disc/100)*$dpp;
			  $jum = $dpp-$dis;
			  $tot = $tot + $jum; 	
			  
			  $subtot = $subtot + $dpp; 	
			  $tdisc  = $tdisc + $dis; 	
			  
			  $pdf->FancyRow(array(
			  $db->kodeitem, 
			  $db->namabarang,
			  $db->qtysi,
			  number_format($db->hargajual,0,'.',','),
			  $db->disc, 
			  number_format($jum,0,'.',',')),$fc, $border, $align);
			  
			}
			
			
			if($header->sppn=="Y"){
			    $ppn = $subtot * 0.1;
			} else {
				$ppn = 0;
			}
			$biayalain = $biaya->total;
			$tot = $tot + $ppn + $biayalain;
			$pdf->SetFillColor(230);
			$border = array('B','B','B','B','B','B');
			$pdf->FancyRow(array('', '', '','','',''),0,$border);
			$pdf->ln(2);
			$pdf->SetWidths(array(100,20,30,40));
			$border = array('TB','','T','T');
			$align  = array('L','','L','R');
			//$pdf->SetFillColor(230,230,230);
			//$pdf->settextcolor(0);
			$fc = array('0','0','0','0');
			$pdf->FancyRow(array('Keterangan', '', 'Sub Total',number_format($subtot,0,'.',',')),$fc, $border, $align,0);
			$border = array('','','','');
			$pdf->FancyRow(array($header->ket,'', 'Diskon', number_format($tdisc,0,'.',',')),$fc, $border, $align);
			$pdf->FancyRow(array('','', 'PPN (10%)', number_format($ppn,0,'.',',')),$fc, $border, $align);
			$pdf->FancyRow(array('','', 'Biaya Lain-lain', number_format($biayalain,0,'.',',')),$fc, $border, $align);
			$style = array('','','B','B');
			$size  = array('','','','');
			$border = array('T','','BT','BT');
			//$pdf->SetFillColor(0,0,139);
			//$pdf->settextcolor(255,255,255);
			$fc = array('0','0','0','0');
			$pdf->FancyRow(array('','', 'Total', number_format($tot,0,'.',',')),$fc, $border, $align, $style, $size);
			$pdf->settextcolor(0);
			$pdf->SetWidths(array(50,50));
			$pdf->SetFont('Arial','',9);
			$pdf->SetAligns(array('C','C'));
			$pdf->ln(5);
			
			$border = array('','');
			$align  = array('C','C');
			$pdf->FancyRow(array('Disiapkan Oleh','Disetujui Oleh'),0,$border, $align);
			$pdf->ln(1);
			$pdf->ln(15);
			$pdf->SetWidths(array(49,2,49));
			$pdf->SetFont('Arial','',8);
			$pdf->SetAligns(array('C','C','C'));
			$border = array('B','','B');	
			$pdf->FancyRow(array('','',''),0,$border,$align);
			$border = array('','','');	
			$align  = array('L','C','L');
			$pdf->FancyRow(array('Tgl.','','Tgl.'),0,$border,$align);
	
		

			$pdf->AliasNbPages();
			
			$pdf->output('./uploads/si/'.$param.'.PDF','F');	
			
			//send email
			
			$email_tujuan = trim($header->email);
			$nama_tujuan  = $header->nama;
						
			$server_subject = "Faktur Penjualan ";
			$ready_message="
				Kepada Yth ".$nama_tujuan.",
				Berikut ini kami lampirkan File Faktur Penjualan ";

			$attched_file='./uploads/si/'.$param.'.PDF';			
			$this->load->library('email');
			
			$config['protocol'] = "smtp";
			$config['smtp_host'] = $profile->smtp_host;
			$config['smtp_port'] = $profile->smtp_port;
			$config['smtp_user'] = $profile->email; 
			$config['smtp_pass'] = $profile->pwdemail;
			$config['smtp_crypto'] = 'tls';
			$config['charset'] = "utf-8";
			$config['mailtype'] = "html";
			$config['newline'] = "\r\n";      
			//$this->email->initialize($config);
			
			$this->email->from($email_usaha, $nama_usaha);
			$this->email->to($email_tujuan);
			$this->email->subject($server_subject);
			$this->email->message($ready_message);
			$this->email->attach($attched_file);

			if($this->email->send()){
				echo "success";
		
			}
			else{
				echo "failed";
			}
			
			
		}
		else
		{
			
			header('location:'.base_url());
			
		}
	}
	
		
	public function getpo($po)
	{   	    
        $data = $this->db->select('ar_sodetail.*, inv_barang.namabarang')->join('inv_barang','inv_barang.kodeitem=ar_sodetail.kodeitem','left')->get_where('ar_sodetail',array('kodeso' => $po))->result();
		echo json_encode($data);
	}
	
	public function getsd($po)
	{   	    	    
        $data = $this->db->select('ar_kirimdetil.*, inv_barang.namabarang')->join('inv_barang','inv_barang.kodeitem=ar_kirimdetil.kodeitem','left')->get_where('ar_kirimdetil',array('kodekirim' => $po))->result();
		echo json_encode($data);
	}
	
	public function getbiaya($po)
	{   	    
        $data = $this->db->select('ar_sobiaya.*, ms_akun.namaakun')->join('ms_akun','ms_akun.kodeakun=ar_sobiaya.kodeakun','left')->get_where('ar_sobiaya',array('kodeso' => $po))->result();
		echo json_encode($data);
	}
	
	public function getlistpo( $supp )
	{
		if(!empty($supp))
		{
		    $po  = $this->db->get_where('ar_sofile',array('kodecust' => $supp, 'statusid' => 1))->result();	
			?>						
			<select name="kodeso" id="kodeso" class="form-control  input-medium select2me"  >            											
			  <option value="">-- Tanpa SO ---</option>
			  <?php 			    
				foreach($po  as $row){	
				?>
				<option value="<?php echo $row->kodeso;?>"><?php echo $row->kodeso;?></option>
				
			  <?php } ?>
			</select>
				
			
			<?php											  
			
		} else
        {
		  echo "";	
		}			
	}
	
	public function getlistsd( $supp )
	{
		if(!empty($supp))
		{
		    $po  = $this->db->query("select * from ar_kirim where kodekirim not in(select kodesd from ar_sifile)")->result();	
			?>						
			<select name="kodesd" id="kodesd" class="form-control  input-medium select2me"  >            											
			  <option value="">-- Tanpa SD ---</option>
			  <?php 			    
				foreach($po  as $row){	
				?>
				<option value="<?php echo $row->kodekirim;?>"><?php echo $row->kodekirim;?></option>
				
			  <?php } ?>
			</select>
				
			
			<?php											  
			
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
		  $page=$this->uri->segment(3);
		  $limit=$this->config->item('limit_data');	
          $d['cust'] = $this->db->order_by('nama')->get_where('ar_customer',array('nama !=' => ''))->result();
		  $d['unit'] = $this->db->get('ms_unit')->result();
		  $d['nomor']= $this->M_global->_Autonomor('SI');
		  $d['curr'] = $this->db->order_by('nama')->get('ms_currency')->result();
		  $this->load->view('penjualan/v_penjualan_faktur_add',$d);				
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
	       
	       $this->M_global->_hapusjurnal($nomor, 'JJ');	
		   $this->db->delete('ar_sifile',array('kodesi' => $nomor));
		   $this->db->delete('ar_sidetail',array('kodesi' => $nomor));
		   $this->db->delete('ar_sibiaya',array('kodesi' => $nomor));
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
			$query = "select * from ms_akun where (kodeakun like '%$q%' or namaakun like '%$q%') and kodeakun like '6%' and akuninduk<>''";
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
					<a href="#" onclick="post_akun('<?php echo $row['kodeakun'];?>','<?php echo $row['namaakun'];?>')">
					
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
	
	public function getbarang($kode)
	{
		if(!empty($kode))
		{
		    $data  = explode("~",$kode);
		    $q = $data[0];
			
			$cust = $data[1];
			$jenis= $this->db->get_where('ar_customer', array('kode' => $cust))->row()->tipe;
			
			$query = "select * from inv_barang where kodeitem like '%$q%' or namabarang like '%$q%' order by namabarang";
			$data  = $this->db->query($query);
			?>
			
			<table id="myTable">
			  <tr class="header">
				<th style="width:20%;">Kode</th>
				<th style="width:60%;">Nama</th>	
				<th style="width:10%;">Stok</th>	
				<th style="width:10%;">Satuan</th>	
			  </tr> 
			  
			<?php							
			foreach($data->result_array() as $row)
			{ 
			   if($jenis==1){
				   $harga = $row['hargajual1'];
			   } else 
			   if($jenis==2){
				   $harga = $row['hargajual2'];
			   } else 
			   if($jenis==3){
				   $harga = $row['hargajual3'];
			   }	   
			   ?>
			   <tr>
				 <td width="50" align="center">
					<a href="#" onclick="post_value('<?php echo $row['kodeitem'];?>','<?php echo $row['namabarang'];?>','<?php echo $row['satuan'];?>','<?php echo $harga;?>')">
					
					<?php echo $row['kodeitem'];?></a>
				 </td>	     
				 <td><?php echo $row['namabarang'];?></td>
				 <td><?php echo $row['qty'];?></td>
				 <td><?php echo $row['satuan'];?></td>
			   </tr>
			   
			   <?php
			}
			echo "</table>";
		} else
        {
		  echo "";	
		}			
	}
	
	public function getharga($kode)
	{
		if(!empty($kode))
		{
		    $data  = explode("~",$kode);
		    $supp  = $data[0];		
		    $item  = $data[1];
			
			$query = "select * from ar_sidetail inner join ar_sifile on ar_sifile.kodesi=ar_sidetail.kodesi where ar_sifile.kodecust = '$supp' and ar_sidetail.kodeitem = '$item' order by ar_sifile.tglsi desc";
	   	    $data  = $this->db->query($query)->result();
			?>
			
			<table class="table" id="myTable">
			  <tr class="headerx">
				<th style="width:20%;">No. Faktur</th>
				<th style="width:20%;">Tanggal</th>
				<th style="width:20%;">Harga</th>	
				<th style="width:10%;">Disc</th>	
				<th style="width:10%;">Satuan</th>		
			  </tr> 
			  
			<?php							
			foreach($data  as $row)
			{ ?>
			   <tr>
				 <td width="50" align="centerx">
					<a href="#" onclick="post_harga('<?php echo $row->hargajual;?>','<?php echo $row->satuan;?>')">
					
					<?php echo $row->kodesi;?></a>
				 </td>	     
				 <td><?php echo date('d-m-Y',strtotime($row->tglsi));?></td>
				 <td><?php echo $row->hargajual;?></td>
				 <td><?php echo $row->disc;?></td>
				 <td><?php echo $row->satuan;?></td>
			   </tr>
			   
			   <?php
			}
			echo "</table>";
		} else
        {
		  echo "";	
		}			
	}
	
	public function getinfobarang( $kode )
	{
		$data = $this->M_global->_data_barang( $kode );
		echo json_encode($data);
	}
	
	public function getinfoakun( $kode )
	{
		$data = $this->M_global->_data_akun( $kode );
		echo json_encode($data);
	}
	
	public function getpoheader( $kodepo )
	{
		$sj = $this->db->get_where('ar_kirim',array('kodekirim' => $kodepo))->row();
		$data = $this->db->get_where('ar_sofile',array('kodeso' => $sj->kodeso))->row();
		echo json_encode($data);
	}
	
	public function getbarangname($kode)
	{
		if(!empty($kode))
		{			
	        $query = "select namabarang from inv_barang where kodeitem = '$kode'";
			$data  = $this->db->query($query);
			foreach($data->result_array() as $row)
			{
              echo $row['namabarang'];				
			}
		} else
		{
		  echo "";	
		}
	}
	
	
	public function save($param)
	{
		$hasil = 0;
		$cek = $this->session->userdata('level');
		if(!empty($cek))
		{			            
			$nobukti  = $this->input->post('nomorbukti');			
			$userid   = $this->session->userdata('username');
			
			//$jumdata = $this->db->get_where('ap_pufile', array('kodepu' => $nobukti))->num_rows();
			//if($jumdata<1){			
			
			/*
			if($param==2){
				   $datasi = $this->db->get_where('ar_sidetail', array('kodesi' => $nobukti))->result();
				   foreach($datasi as $row){					 
					 $this->db->query('update inv_barang set qty = qty + '.$row->qtysi.' where kodeitem = "'.$row->kodeitem.'"');	
					 $this->db->delete('inv_transaksi',array('nobukti' => $nobukti, 'kodeitem' => $row->kodeitem));
				   }				   				   				   		  
				} 
			*/
			
			$this->db->delete('ar_sidetail',array('kodesi' => $nobukti));
			$kode  = $this->input->post('kode');
			$qty   = $this->input->post('qty');
		    $sat   = $this->input->post('sat');
			$harga = $this->input->post('harga');
			$disc  = $this->input->post('disc');
		   
			$jumdata  = count($kode);
			
			
			$nourut = 1;
			$tot = 0;
			$tdisc = 0;
			
			$tothpp = 0;
			for($i=0;$i<=$jumdata;$i++)
			{
			    $_kode   = $kode[$i];
				//$tot = $tot + str_replace(',','',$jumlah[$i]);
				
				$vjum  = $qty[$i] * $harga[$i];
				$vdisc = $vjum * ($disc[$i]/100);
				$tot   = $tot + $vjum;
				$tdisc = $tdisc + $vdisc;
				
				$hpp   = $this->M_global->_hpp($_kode);
				$tothpp = $tothpp + ($hpp*$qty[$i]);
				
			    $datad = array(
				'kodesi'   => $nobukti,
				'kodeitem' => $_kode,
				'qtysi' => $qty[$i],
				'satuan' => $sat[$i],
				'hpp' => $hpp,
				'hargajual' => $harga[$i],
				'disc' => $disc[$i],
			    );
				
				$data_inv = array(
				'tanggal'   => date('Y-m-d'),
				'kodeitem' => $_kode,
				'penerimaan' => 0,
				'pengeluaran' => $qty[$i],
				'satuan' => $sat[$i],
				'jenis' => 'Penjualan',
				'nobukti' => $nobukti,
				'tglrekam'   => date('Y-m-d H:i:s'),
				'hpp'   => $hpp,
				'hargajual'   => 0,
			    );
				
				if($_kode!=""){
			      $this->db->insert('ar_sidetail', $datad);	
				  //$this->db->insert('inv_transaksi', $data_inv);
				  //$this->db->query('update inv_barang set qty = qty - '.$qty[$i].' where kodeitem = "'.$_kode.'"');	
				}
			}
			
			if($this->input->post('sppn')=="Y"){
				$tppn = ($tot - $tdisc) * 0.1;
			} else {
				$tppn = 0;
			}
			//rincian biaya lain-lain
			$kode  = $this->input->post('lkode');
			$jumlah= $this->input->post('ljumlah');
		    $ket   = $this->input->post('lket');
			$jumdata  = count($kode);
			
			$this->db->delete('ar_sibiaya',array('kodesi' => $nobukti));
			$this->M_global->_hapusjurnal($this->input->post('nomorbukti'), 'JJ');	
			$totbiaya = 0;
			$itembiaya = 2;
			for($i=0;$i<=$jumdata;$i++)
			{
				$totbiaya = $totbiaya + $jumlah[$i];
			    $datad = array(
				'kodesi'   => $nobukti,
				'kodeakun' => $kode[$i],
				'jumlah' => $jumlah[$i],
				'keterangan' => $ket[$i],
							
			    );
				if ($kode[$i]!=""){
			    $this->db->insert('ar_sibiaya', $datad);
				
				$this->M_global->_rekamjurnal(
				date('Y-m-d',strtotime($this->input->post('tanggal'))),
				$this->input->post('nomorbukti'),
				'JJ',
				$this->input->post('kodesi'),
				2,
				$kode[$i],
				'Penjualan',
				$ket[$i],
				$jumlah[$i],
				0
				);	
				$itembiaya++;
			
				}
			}
			
			
			if($param==1){
			if($this->input->post('pembayaran')=='T'){
              $tgljthtempo = date('Y-m-d',strtotime($this->input->post('tanggal')));
			  $status = 2;
			} else {
			  $top  = $this->db->get_where('ar_customer',array('kode' => $this->input->post('cust')))->row()->top;			  
			  $tgljthtempo = date('Y-m-d',strtotime($this->input->post('tanggal').' + '.$top.' days'));
			  $status = 1;
			}
			} else {
			  if($this->input->post('pembayaran')=='T'){
                $tgljthtempo = date('Y-m-d',strtotime($this->input->post('tanggal')));
				$status = 2;
			  } else {	
			    $tgljthtempo = date('Y-m-d',strtotime($this->input->post('tanggaljt')));	
				$status = 1;
			  }	
			}
			
			$dataso = $this->db->get_where('ar_kirim', array('kodekirim' => $this->input->post('kodesd')))->row();
			if($dataso){
				$nomorso = $dataso->kodeso;
			} else {
				$nomorso = '';
			}
			$datacustomer = $this->M_global->_data_customer($this->input->post('cust'));
			
			
			$data = array(
			    'kodecbg' => $this->session->userdata('unit'),
				'kodecust' => $this->input->post('cust'),
				'kodesi'  => $this->input->post('nomorbukti'),
				'pembayaran'  => $this->input->post('pembayaran'),
				'kodeso'  => $nomorso,
				'kodesd'  => $this->input->post('kodesd'),
				'tglsi'   => date('Y-m-d',strtotime($this->input->post('tanggal'))),
				'tglkirim'=> date('Y-m-d',strtotime($this->input->post('tanggalkirim'))),
				'tgljthtempo'=> $tgljthtempo,
				'kodeuser'=> $userid,
				'ket'     => $this->input->post('keterangan'),
				'alamat'  => $this->input->post('alamat'),
				'dpp'     => $tot,
				'ppn'     => $tppn,
				'diskon'  => $tdisc,
				'totalsi' => $tot+$tppn-$tdisc+$totbiaya,
				'biayalain'=> $totbiaya,
				'sppn'    => $this->input->post('sppn'),
				'statusid'=> $status,			
                'alamat1' => $datacustomer->alamat1,
				'alamat2' => $datacustomer->alamat2,
				'namakirim' => $datacustomer->contactname,
				'matauang'  => $this->input->post('curr'),
				'kurs'  => $this->input->post('kurs'),	
				
			);
						
			
			$profile = $this->M_global->_LoadProfileLap();			
			$akun_penjualan = $profile->akun_penjualan;
			$akun_kas       = $profile->akun_kas;
			$akun_piutang   = $profile->akun_piutang;
			$akun_ppn       = $profile->akun_ppn;
			$akun_hpp       = $profile->akun_hpp;
			$akun_persediaan= $profile->akun_persediaan;
			$akun_diskon    = $profile->akun_diskonjual;
				
			if($this->input->post('pembayaran')=='T')	{
				$akun_debet = $akun_kas;
			} else {
				$akun_debet = $akun_piutang;
			}
			
		
			
			$this->M_global->_rekamjurnal(
			date('Y-m-d',strtotime($this->input->post('tanggal'))),
			$this->input->post('nomorbukti'),
			'JJ',
			$this->input->post('kodesd'),
			1,
			$akun_debet,
			'Penjualan',
			'Penjualan',
			($tot+$tppn-$tdisc+$totbiaya)*$this->input->post('kurs'),
			0
			);
			
			
			if($tdisc>0){
			$this->M_global->_rekamjurnal(
			date('Y-m-d',strtotime($this->input->post('tanggal'))),
			$this->input->post('nomorbukti'),
			'JJ',
			$this->input->post('kodesd'),
			$itembiaya++,
			$akun_diskon,
			'Penjualan',
			'Diskon Penjualan',
			$tdisc*$this->input->post('kurs'),
			0
			);	
			}
			
			if($tppn>0){
			$this->M_global->_rekamjurnal(
			date('Y-m-d',strtotime($this->input->post('tanggal'))),
			$this->input->post('nomorbukti'),
			'JJ',
			$this->input->post('kodesd'),
			$itembiaya++,
			$akun_ppn,
			'Penjualan',
			'PPN Penjualan',
			0,
			$tppn*$this->input->post('kurs')			
			);	
			}
						
			$this->M_global->_rekamjurnal(
			date('Y-m-d',strtotime($this->input->post('tanggal'))),
			$this->input->post('nomorbukti'),
			'JJ',
			$this->input->post('kodesd'),
			$itembiaya++,
			$akun_penjualan,
			'Penjualan',
			'Penjualan',
			0,
			($tot+$totbiaya)*$this->input->post('kurs')			
			);
			
			
			//jurnal persediaan
			
			$this->M_global->_rekamjurnal(
			date('Y-m-d',strtotime($this->input->post('tanggal'))),
			$this->input->post('nomorbukti'),
			'JJ',
			$this->input->post('kodesd'),
			$itembiaya++,
			$akun_hpp,
			'Penjualan',
			'HPP Penjualan',
			$tothpp*$this->input->post('kurs'),
			0			
			);
			
			$this->M_global->_rekamjurnal(
			date('Y-m-d',strtotime($this->input->post('tanggal'))),
			$this->input->post('nomorbukti'),
			'JJ',
			$this->input->post('kodesd'),
			$itembiaya++,
			$akun_persediaan,
			'Penjualan',
			'HPP Penjualan',
			0,
			$tothpp*$this->input->post('kurs')			
			);
			
			
			
			if($param==1)
			{
			  $this->db->delete('ar_sifile', ['kodesi' => $nobukti]);	
			  $this->db->insert('ar_sifile',$data);	
			  $this->M_global->_updatecounter1('SI');		  
			} else {
			  $this->db->update('ar_sifile',$data, array('kodesi' => $nobukti));				 
			}

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
					
			$header = $this->db->get_where('ar_sifile', array('kodesi' => $nomor));
			$detil  = $this->db->select('ar_sidetail.*, inv_barang.namabarang')->join('inv_barang','inv_barang.kodeitem=ar_sidetail.kodeitem')->get_where('ar_sidetail', array('kodesi' => $nomor));
			$biaya  = $this->db->join('ms_akun','ms_akun.kodeakun=ar_sibiaya.kodeakun')->get_where('ar_sibiaya', array('kodesi' => $nomor));
		
			$d['header']  = $header->result();
			$d['detil']   = $detil->result();
			$d['biaya']   = $biaya->result();
			$d['jumdata1']= $detil->num_rows();	
			$d['jumdata2']= $biaya->num_rows();	
			$d['curr'] = $this->db->order_by('nama')->get('ms_currency')->result();
			$d['cust'] = $this->db->order_by('nama')->get_where('ar_customer',array('nama !=' => ''))->result();
		    $d['unit'] = $this->db->get('ms_unit')->result();
			$this->load->view('penjualan/v_penjualan_faktur_edit',$d);
			} else
		{
			header('location:'.base_url());
		}	
	}
}
/* End of file keuangan_saldo.php */
/* Location: ./application/controllers/keuangan_saldo.php */