<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Akuntansi_jurnal extends CI_Controller {

	
	
	public function __construct()
	{
		
		parent::__construct();
		$this->load->library('form_validation'); 
        $this->load->database(); 
		$this->load->helper('simkeu_nota');
		$this->load->model('M_akuntansi_jurnal','M_akuntansi_jurnal');
		$this->load->model('M_akuntansi_jurnall','M_akuntansi_jurnall');
		$this->session->set_userdata('menuapp', '200');
		$this->session->set_userdata('submenuapp', '204');		
	}
	
	
	public function index()
	{
		$cek = $this->session->userdata('level');		
		if(!empty($cek))
		{	
			$unit = $this->session->userdata('unit');	
			if(!empty($unit)){
			  $qp ="select kode, nama from ms_unit where kode = '$unit'"; 
			} else {
			  $qp ="select kode, nama from ms_unit order by kode"; 		
			}
						
			$this->load->helper('url');		
			$d['unit']  = $this->db->query($qp);		
			$d['jenis'] = $this->db->get_where('ms_jurnal',array('jurnal_kode' => 'JU'));
			$d['nojurnal'] = $this->M_global->_Autonomor('JU');
			$d['coa']   = $this->db->get_where('ms_akun',array('akuninduk != ' => ''))->result();
			$d['akuninduk']  = $this->db->get_where('ms_akun',array('akuninduk' => ''));
			$d['akundetil']  = $this->db->get_where('ms_akun',array('akuninduk != ' => ''));
			$this->load->view('akuntansi/v_akuntansi_jurnal',$d);
			} else
		{
			header('location:'.base_url());
		}	
	}
	
	public function edit($nojurnal)
	{
		$cek = $this->session->userdata('level');		
		if(!empty($cek))
		{	
			$unit = $this->session->userdata('unit');	
			if(!empty($unit)){
			  $qp ="select kode, nama from ms_unit where kode = '$unit'"; 
			} else {
			  $qp ="select kode, nama from ms_unit order by kode"; 		
			}
			
			$qj ="select jurnal_kode, jurnal_nama from ms_jurnal order by jurnal_kode"; 		
			$qjurnal ="select * from tr_jurnal inner join ms_akun on tr_jurnal.kodeakun=ms_akun.kodeakun where novoucher = '$nojurnal' order by tr_jurnal.nourut"; 					
			$d['unit']  = $this->db->query($qp);		
			$d['jenis'] = $this->db->query($qj);			
			$d['jurnald'] = $this->db->query($qjurnal);
			$d['nojurnal'] = $nojurnal;
			$d['jumdata'] = $this->db->query($qjurnal)->num_rows();	

            $data=$this->db->query($qjurnal);
			foreach($data->result() as $row){
			$d['tanggal']=$row->tanggal;
			$d['nobukti']=$row->novoucher;
		    $d['ket']=$row->ket;
			$d['jenis_jurnal']=$row->jenis;			
			$d['noref']=$row->noref;	
            }			
			
			$this->load->view('akuntansi/v_akuntansi_jurnal_edit',$d);
			} else
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
		  
		    $queryh = "select * from  tr_jurnal inner join ms_jurnal on tr_jurnal.jenis=ms_jurnal.jurnal_kode where novoucher = '$param'";
			$queryd = "select tr_jurnal.*, ms_akun.namaakun from tr_jurnal inner join ms_akun on tr_jurnal.kodeakun=ms_akun.kodeakun where novoucher = '$param'";
			 
		    $header = $this->db->query($queryh)->row();
			$detil  = $this->db->query($queryd)->result();
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
			$judul=array('','','Jurnal Umum');
			$fc     = array('0','0','0');
			$hc     = array('20','20','20');
			$pdf->FancyRow2(10,$judul, $fc,  $border, $align, $style, $size, $max);
			$pdf->ln(1);
			$pdf->setfont('Arial','B',10);
			$pdf->SetWidths(array(70,30,30,5,55));
			$border = array('','','','','');
			$fc     = array('0','0','0','0','0');
			$pdf->SetFillColor(230,230,230);
			//$pdf->settextcolor(10,20,200);
			$pdf->setfont('Arial','',9);
		
			$pdf->FancyRow(array('','','Nomor',':',$header->novoucher), $fc, $border);
			$pdf->FancyRow(array('','','Tanggal',':',date('d-m-Y',strtotime($header->tanggal))), $fc, $border);
			$pdf->FancyRow(array('','','Tipe Transaksi',':',$header->jurnal_nama), $fc, $border);
			$pdf->FancyRow(array('','','Nomor Ref.',':',$header->noref), $fc, $border);
			$fc     = array('1','0','0','0','0');			
			$pdf->ln(3);
			
			$pdf->SetWidths(array(30,90,35,35));
			$border = array('TB','TB','TB','TB');
			$align  = array('L','L','R','R');
			$pdf->setfont('Arial','B',10);
			//$pdf->SetFillColor(0,0,139);
			//$pdf->settextcolor(255,255,255);
			$fc = array('0','0','0','0');
			$judul=array('Kode Akun','Uraian','Debet','Kredit');
			$pdf->FancyRow2(8,$judul,$fc, $border,$align);
			$border = array('','','');
			$pdf->setfont('Arial','',10);
			$tot = 0;
			$subtot = 0;
			$tdisc  = 0;
			$border = array('','','','');
			$align  = array('L','L','R','R');
			$fc = array('0','0','0','0');
			$pdf->SetFillColor(0,0,139);
			$pdf->settextcolor(0);
			$totd = 0;
			$totk = 0;
			foreach($detil as $db)
			{
			  $totd = $totd + $db->debet;
			  $totk = $totk + $db->kredit;
			  $pdf->FancyRow(array(
			  $db->kodeakun, 
			  $db->keterangan,
			  number_format($db->debet,2,'.',','),
			  number_format($db->kredit,2,'.',',')),$fc, $border, $align);			  
			}
			
					
			$pdf->SetFillColor(230);
			$border = array('B','B','B','B');
			$pdf->FancyRow(array('', '', '',''),0,$border);
			$pdf->ln(2);
			$pdf->SetWidths(array(100,20,35,35));
			$border = array('','','TB','TB');
			$align  = array('L','C','R','R');
			$pdf->SetFillColor(230,230,230);
			$pdf->settextcolor(0);
			$fc = array('0','0','0','0');
			$pdf->setfont('Arial','B',10);
			$pdf->FancyRow(array('', 'Total', number_format($totd,2,'.',','), number_format($totk,2,'.',',')),$fc, $border, $align,0);
			$border = array('','','','');
			$pdf->FancyRow(array('','', '', ''),$fc, $border, $align);
			$fc = array('0','0','0','0');
			$pdf->FancyRow(array('','', '', ''),$fc, $border, $align);
			$pdf->FancyRow(array('','', '', ''),$fc, $border, $align);
			
			$style = array('','','','');
			$size  = array('','','','');
			$border = array('','','','');
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
	
	public function cetak2($param)
	{
		$cek = $this->session->userdata('level');		
		$unit= $this->session->userdata('unit');		
		if(!empty($cek))
		{				  		 
          $d['master_bank'] = $this->db->get("ms_bank");
          $d['nama_usaha']=$this->config->item('nama_perusahaan');
		  $d['alamat']=$this->config->item('alamat_perusahaan');
		  $d['motto']=$this->config->item('motto');
		  $d['nojurnal']=$param;
		  $d['unit'] = $this->session->userdata('unit');
		  
		  $profile = $this->M_global->_LoadProfileLap();
		  $nama_usaha=$profile->nama_usaha;
          $namaunit = $this->M_global->_namaunit($unit);  
		  $qjurnalh = $this->db->get_where('tr_jurnal', 'novoucher = "'.$param.'"')->row();
		  $tanggal  = $qjurnalh->tanggal;
		  $rjurnal  = 
		  
		  $this->db->select('tr_jurnal.*, ms_akun.namaakun');
		  $this->db->join('ms_akun','tr_jurnal.kodeakun=ms_akun.kodeakun','left');
		  $this->db->order_by('tr_jurnal.nourut');
		  $rjurnal = $this->db->get_where('tr_jurnal', array('novoucher' => $param))->result();
		  	  
		    $pdf=new simkeu_vou();
			$pdf->addpage("P","A4");   
			$pdf->setsize("P","A4");
			
			$pdf->SetFont('Times','I',10);
            $pdf->cell(0,3,$nama_usaha);   
		    $pdf->ln(2);
		    $pdf->SetFont('Times','BI',9);
			$pdf->SetTextColor(128);  
		    if($namaunit!='')
		    {
			 $pdf->cell(0,5,strtoupper($namaunit),0,1,'L');
		    }
		    $pdf->ln(5);
		    $pdf->SetTextColor(0);
		    $pdf->SetFont('Times','B',12);
		   
		 		 
		    $pdf->cell(0,5,'MEMO JURNAL',0,1,'C');
		   
		   
		   $pdf->ln();
		   $pdf->SetFont('Times','B',10);
		   $pdf->SetWidths(array(95,95));
		   $pdf->SetAligns(array('L','R'));
		   $pdf->Row(array('NOMOR BUKTI : '.$param,'TANGGAL : '.date('d-m-Y',strtotime($tanggal))),5);
		   $pdf->ln(1);

		   $pdf->SetWidths(array(10,25,50,55,25,25));
		   $pdf->SetAligns(array('C','C','C','C','C','C'));

		  
		   $judul=array('NO','KODE AKUN','NAMA AKUN','URAIAN','DEBET','KREDIT');
		  
		   $pdf->RowL($judul,7);
		   $pdf->SetWidths(array(10,25,50,55,25,25));
		   $pdf->SetAligns(array('C','C','L','L','R','R'));
   
			
				
			$nourut = 1;
            $tot1=0;
			$tot2=0;
			$pdf->setfont('Times','',10);
			foreach($rjurnal as $rowd)
			{
			  $tot1=$tot1+$rowd->debet;
			  $tot2=$tot2+$rowd->kredit;

			  $pdf->RowL(array(
			  $nourut,
			  $rowd->kodeakun,
			  $rowd->namaakun,
			  $rowd->keterangan,
			  number_format($rowd->debet,2,'.',','),
			  number_format($rowd->kredit,2,'.',',')),5);
			  
			  $nourut++;
			}
              $pdf->SetWidths(array(140,25,25));
			  $pdf->SetAligns(array('R','R','R'));
			 
			  $pdf->setfont('Times','B',10);
			  $pdf->RowL(array(
			  'JUMLAH  ',
			  number_format($tot1,2,'.',','),
			  number_format($tot2,2,'.',',')),7);
			  $pdf->ln();
			  
			  
			  $pdf->setfont('Times','',10);
			  $pdf->SetWidths(array(50,90,50 ));
			  $pdf->SetAligns(array('C','C','C'));
			  $pdf->Row(array('Menyetujui','','Bagian Akuntansi'),5);
			  $pdf->ln(20);
			  $pdf->setfont('Times','BU',8);
			  $border = array('B','','B');
			  $pdf->FancyRow(array('','',''), $border); 
			  

			$pdf->AliasNbPages();
			$pdf->output('memo_jurnal.PDF','I');
		  				  
		  
		  				
		}
		else
		{
			
			header('location:'.base_url());
			
		}
	}
	
	public function jurnal_add()
	{
		$cek = $this->session->userdata('level');
		if(!empty($cek))
		{			
            $ketglobal= $this->input->post('keterangan');
			$kodeakun = $this->input->post('akun');
			$ket      = $this->input->post('ket');
		    $debet    = $this->input->post('debet');
		    $kredit   = $this->input->post('kredit');
            $tanggal  = $this->input->post('tanggal');
			$noref    = $this->input->post('noref');
			$nobukti  = $this->input->post('nomorbukti');
			$jenis    = $this->input->post('jenis');
			$cabang   = $this->input->post('cabang');
			$jumdata  = count($kodeakun);
			$_tanggal = date('Y-m-d',strtotime($tanggal));
			
			$nourut = 1;
			for($i=0;$i<=$jumdata;$i++)
			{
			    $_akun   = $kodeakun[$i];
				$_ket    = $ket[$i];
				$_debet  =  str_replace(',','',$debet[$i]);
				$_kredit =  str_replace(',','',$kredit[$i]);
				
				if($_akun!=""){
					$this->M_global->_rekamjurnal($tanggal, $nobukti, $jenis, $noref, $nourut, $_akun, $ketglobal, $_ket, $_debet, $_kredit);
					
					$nourut++;
				}
			    
			}
			$this->M_global->_updatecounter1('JU');
						
			
		}
		else
		{
			header('location:'.base_url());
		}
	}
	
	public function jurnal_edit($nojurnal)
	{
		$cek = $this->session->userdata('level');
		if(!empty($cek))
		{				        
	        $this->db->delete('tr_jurnal',array('novoucher' => $nojurnal));
			
			$kodeakun = $this->input->post('akun');
			$ketglobal= $this->input->post('keterangan');
			$ket      = $this->input->post('ket');
		    $debet    = $this->input->post('debet');
		    $kredit   = $this->input->post('kredit');
            $tanggal  = $this->input->post('tanggal');
			$noref    = $this->input->post('noref');
			$nobukti  = $this->input->post('nomorbukti');
			$jenis    = $this->input->post('jenis');
			$jumdata  = count($kodeakun);
			$_tanggal = date('Y-m-d',strtotime($tanggal));
			
			$nourut = 1;
			for($i=0;$i<=$jumdata;$i++)
			{
			    $_akun   = $kodeakun[$i];
				$_ket    = $ket[$i];
				$_debet  =  str_replace(',','',$debet[$i]);
				$_kredit =  str_replace(',','',$kredit[$i]);
				
				if($_akun!=""){
					$this->M_global->_rekamjurnal($tanggal, $nobukti, $jenis, $noref, $nourut, $_akun, $ketglobal, $_ket, $_debet, $_kredit);					
					$nourut++;
				}
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