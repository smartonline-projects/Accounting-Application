<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pembelian_bayar extends CI_Controller {

	/**
	 * @author : Enjang RK
	 * @keterangan : Controller untuk modul Pembayaran Pembelian
	 **/
	
	
	
	
	public function __construct()
	{
		parent::__construct();
		$this->session->set_userdata('menuapp', '300');
		$this->session->set_userdata('submenuapp', '325');
		$this->load->helper('simkeu_nota');
	}

	public function index()
	{
		$cek = $this->session->userdata('level');		
		$unit= $this->session->userdata('unit');	
        		
		if(!empty($cek))
		{	
	       
		  $bulan =  $this->M_global->_periodebulan();
		  $tahun =  $this->M_global->_periodetahun();
         
		  $q1 = 
				"select a.kodebyr, a.tglbayar, a.nomorcek, a.tglcek, b.nama, c.namaakun as bank, a.statusid, a.jumlahbayar
				from
				   ap_bayar a,
				   ap_supplier b,
				   ms_akun c
				where
				   a.kodesup=b.kode and
				   a.kodebank=c.kodeakun and
				   year(a.tglbayar)= (select periode_tahun from ms_identity) and
				   month(a.tglbayar)= (select periode_bulan from ms_identity) and
				   a.kodecbg = '$unit'
				order by
				   a.tglbayar, a.kodebyr desc";
       
		  $nbulan = $this->M_global->_namabulan($bulan);
		  $periode= 'Periode '.$nbulan.'-'.$this->M_global->_periodetahun();	   
	      $d['keu'] = $this->db->query($q1)->result();	
          $d['periode'] = $periode;		  
		  $level=$this->session->userdata('level');		
		  $akses= $this->M_global->cek_menu_akses($level, 325);
		  $d['akses']= $akses;
		  $this->load->view('pembelian/v_pembelian_bayar',$d);			   
		
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
				$q1 = 
				"select a.kodebyr, a.tglbayar, a.nomorcek, a.tglcek, b.nama, c.namaakun as bank, a.statusid, a.jumlahbayar
				from
				   ap_bayar a,
				   ap_supplier b,
				   ms_akun c
				where
				   a.kodesup=b.kode and
				   a.kodebank=c.kodeakun and
				   a.tglbayar between '$_tgl1' and '$_tgl2' and 				   
				   a.kodecbg = '$unit'
				order by
				   a.tglbayar, a.kodebyr desc";

		  
		  $periode= 'Periode '.date('d-m-Y',strtotime($tgl1)).' s/d '.date('d-m-Y',strtotime($tgl2));	   
	      $d['keu'] = $this->db->query($q1)->result();
          $d['periode'] = $periode;		  
		  $level=$this->session->userdata('level');		
		  $akses= $this->M_global->cek_menu_akses($level, 325);
		  $d['akses']= $akses;
		  $this->load->view('pembelian/v_pembelian_bayar',$d);			   
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
		  
		    $queryh = "select * from ap_bayar inner join ap_supplier on ap_bayar.kodesup=ap_supplier.kode where kodebyr = '$param'";
			$queryd = "select * from ap_bayardetil where kodebyr = '$param'";
			 
		    $detil  = $this->db->query($queryd)->result();
			$header = $this->db->query($queryh)->row();
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
			$judul=array('Kepada :','','Pembayaran Pemasok');
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
			$pdf->FancyRow(array($header->nama,'','Nomor',':',$header->kodebyr), $fc, $border);
			$pdf->FancyRow(array($header->alamat1,'','Tanggal',':',date('d M Y',strtotime($header->tglbayar))), $fc, $border);
			$pdf->FancyRow(array($header->alamat2,'','Pembayaran',':',number_format($header->jumlahbayar,0)), $fc, $border);
			$pdf->FancyRow(array($header->telp,'','','',''), $fc, $border);
			
			$pdf->ln(2);
			
			$pdf->SetWidths(array(40,25,25,25,25,25,25));
			$border = array('TB','TB','TB','TB','TB','TB','TB');
			$align  = array('L','L','R','R','R','R','R');
			$pdf->setfont('Arial','B',10);
			$pdf->SetAligns(array('L','C','R'));
			//$pdf->SetFillColor(0,0,139);
			//$pdf->settextcolor(255,255,255);
			$fc = array('0','0','0','0','0','0','0');
			$judul=array('No. Faktur','Tgl. Faktur','Total Faktur','Diskon','PPH 23','Uang Muka','Pembayaran');
			$pdf->FancyRow2(8,$judul,$fc, $border,$align);
			$border = array('','','');
			$pdf->setfont('Arial','',10);
			$tot = 0;
			$subtot = 0;
			$tdisc  = 0;
			$border = array('','','','','','','');
			$align  = array('L','L','R','R','R','R','R');
			$fc = array('0','0','0','0','0','0','0');
			$pdf->SetFillColor(0,0,139);
			$pdf->settextcolor(0);
			foreach($detil as $db)
			{
			 
			  $tot = $tot + $db->bayar; 	
			  
			  $pdf->FancyRow(array(
			  $db->nomorfaktur, 
			  date('d-m-Y',strtotime($db->tglfaktur)),
			  number_format($db->totalfaktur,0,'.',','),
			  number_format($db->diskon,0,'.',','),
			  0,
			  number_format($db->uangmuka,0,'.',','),
			  number_format($db->bayar,0,'.',',')),$fc, $border, $align);
			  
			}
			
			
			
			$pdf->SetWidths(array(190));
			$border = array('TB');
			$align  = array('L');
			$pdf->SetFillColor(230,230,230);
			$pdf->settextcolor(0);
			$pdf->SetFillColor(230,230,230);
			$fc = array('0');
			$pdf->FancyRow(array(''),$fc,$border);
			$fc = array('0');
			$pdf->FancyRow(array(ucwords($this->M_global->terbilang($tot))),$fc, $border, $align,0);
			
			$pdf->SetFillColor(230);
			$border = array('B','B','B','B','B','B');
			//$pdf->FancyRow(array('', '', '','','',''),0,$border);
			$pdf->ln(2);
			$pdf->SetWidths(array(100,20,50,20));
			$border = array('TB','','','');
			$align  = array('L','','C','');
			$pdf->SetFillColor(230,230,230);
			$pdf->settextcolor(0);
			$fc = array('0','0','0','0');
			
			$pdf->FancyRow(array('Keterangan', '', 'Mengetahui',''),$fc, $border, $align,0);
			
			$border = array('','','','');
			$pdf->FancyRow(array($header->keterangan, '', '',''),$fc, $border, $align,0);
			
			
			$pdf->ln(1);
			$pdf->ln(15);
			$border = array('','','B','');
			$pdf->FancyRow(array('', '', '',''),$fc, $border, $align,0);
			$border = array('','','','');
			$align  = array('L','','L','');
			$pdf->FancyRow(array('', '', 'Tgl.',''),$fc, $border, $align,0);
			
			$pdf->AliasNbPages();
			$pdf->output($param.'.PDF','I');			
		}
		else
		{
			
			header('location:'.base_url());
			
		}
	}
	
	
	public function getfaktur($supp)
	{   	    
        $data = $this->db->query("select ap_pufile.*, totalpu as total, (totalpu-jumlahbayar-uangmuka) as hutang from ap_pufile where kodesup='$supp' and totalpu>jumlahbayar+uangmuka")->result();
		$vdata = array();
		foreach($data as $row){
			//
			$kodepo = $row->kodepo;
			$duangmuka = $this->db->query("select * from ap_uangmuka where kodepo = '$kodepo' and jumlahum>jumlahbayar")->row();
				if($duangmuka){
				  $uangmuka = $duangmuka->jumlahum;	
				} else {
				  $uangmuka = 0;	
			}
			
			$vdata[] = array(
			 'nomorfaktur' => $row->nomorfaktur,
			 'kodepu' => $row->kodepu,
			 'tglpu' => date('d-m-Y',strtotime($row->tglpu)),
			 'totalpu' => $row->totalpu,
			 'uangmuka' => $uangmuka,
			 'hutang' => $row->hutang,
			 'total' => $row->total,
			);
		}
		echo json_encode($vdata);
	}
	
	public function getfaktur_entry($nomor)
	{   	    
        $data = $this->db->select('ap_bayardetil.*, date_format(tglfaktur, "%d-%m-%Y") as tanggal')->get_where('ap_bayardetil',array('kodebyr' => $nomor))->result();		
		echo json_encode($data);
	}
	
	public function getbiaya($po)
	{   	    
        $data = $this->db->select('ap_pobiaya.*, ms_akun.namaakun')->join('ms_akun','ms_akun.kodeakun=ap_pobiaya.kodeakun','left')->get_where('ap_pobiaya',array('kodepo' => $po))->result();
		echo json_encode($data);
	}
	
	public function getlistfaktur( $supp )
	{
		if(!empty($supp))
		{
		    $po  = $this->db->get_where('ap_pufile',array('kodesup' => $supp))->result();	
			?>	
            <div class="input-group">
			<select name="kodepu" id="kodepu" class="form-control  input-medium select2me"  >            											
			  <option value="">-- $$ --</option>
			  <?php 			    
				foreach($po  as $row){	
				?>
				<option value="<?php echo $row->kodepu;?>"><?php echo $row->kodepu;?></option>
				
			  <?php } ?>
			</select>
			
			<span class="input-group-btn">
				<a class="btn blue" onclick="getfaktur();"><i class="fa fa-download"></i></a>
			</span>	
			</div>
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
          $d['supp'] = $this->db->order_by('nama')->get_where('ap_supplier',array('nama !=' => ''))->result();
		  $d['bank'] = $this->db->get_where('ms_akun',array('akuninduk !=' => '','kelompok' => 'BANK'))->result();
		  $d['unit'] = $this->db->get('ms_unit')->result();
		  $d['nomor']= $this->M_global->_Autonomor('PP');
		  $this->load->view('pembelian/v_pembelian_bayar_add',$d);				
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
		   
		   $bayar = $this->db->get_where('ap_bayardetil', array('kodebyr' => $nomor))->result();				  
		   foreach($bayar as $row){
			  $_bayar = $row->bayar;
			  $_uangmuka = $row->uangmuka;
			  $faktur = $row->nomorfaktur;
			  $this->db->set('jumlahbayar', 'jumlahbayar - '.$_bayar,FALSE);
			  $this->db->set('uangmuka', 'uangmuka - '.$_uangmuka,FALSE);
			  $this->db->where('kodepu', $faktur); 
			  $this->db->update('ap_pufile'); 
			  
		      $this->db->query('update ap_pufile set statusid=2 where jumlahbayar+uangmuka>=totalpu and kodepu = "'.$faktur.'"');				  
			  $this->db->query('update ap_pufile set statusid=1 where jumlahbayar+uangmuka<totalpu and kodepu = "'.$faktur.'"');				  
		   
		      if($_uangmuka>0){
				 $dfaktur =  $this->db->query("select * from ap_pufile where kodepu = '$faktur'")->row();
				 $kodepb  = $dfaktur->kodepb;
				 $dpo     = $this->db->query("select * from ap_lpb where nolpb = '$kodepb'")->row();
				 $kodepo  = $dpo->kodepo;
				 
				 $this->db->query("update ap_uangmuka set jumlahbayar=jumlahbayar-$_uangmuka
				 where kodepo = '$kodepo'");
					 
			    
			  }
		   }
		   $this->db->delete('ap_bayar',array('kodebyr' => $nomor));
		   $this->db->delete('ap_bayardetil',array('kodebyr' => $nomor));
		   $this->M_global->_hapusjurnal($nomor, 'JP');	
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
		  
			$q = $kode;
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
			{ ?>
			   <tr>
				 <td width="50" align="center">
					<a href="#" onclick="post_value('<?php echo $row['kodeitem'];?>','<?php echo $row['namabarang'];?>','<?php echo $row['satuan'];?>','<?php echo $row['hargabeliakhir'];?>')">
					
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
			
			$query = "select * from ap_pudetail inner join ap_pufile on ap_pufile.kodepu=ap_pudetail.kodepu where ap_pufile.kodesup = '$supp' and ap_pudetail.kodeitem = '$item' order by ap_pufile.tglpu desc";
	   	    $data  = $this->db->query($query)->result();
			?>
			
			<table id="myTable">
			  <tr class="header">
				<th style="width:20%;">Tanggal</th>
				<th style="width:60%;">Harga</th>	
				<th style="width:10%;">Disc</th>	
				<th style="width:10%;">Satuan</th>	
			  </tr> 
			  
			<?php							
			foreach($data  as $row)
			{ ?>
			   <tr>
				 <td width="50" align="center">
					<a href="#" onclick="post_harga('<?php echo $row->hargabeli;?>','<?php echo $row->satuan;?>')">
					
					<?php echo date('d-m-Y',strtotime($row->tglpu));?></a>
				 </td>	     
				 <td><?php echo $row->hargabeli;?></td>
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
		$data = $this->db->get_where('ap_pofile',array('kodepo' => $kodepo))->row();
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
			if($param==2){
				 
				  //update faktur				
                  $bayar = $this->db->get_where('ap_bayardetil', array('kodebyr' => $nobukti))->result();				  
				  foreach($bayar as $row){
					  $_bayar = $row->bayar;
					  $_uangmuka = $row->uangmuka;
					  $faktur = $row->nomorfaktur;
					  $this->db->set('jumlahbayar', 'jumlahbayar - '.$_bayar,FALSE); 
					  $this->db->set('uangmuka', 'uangmuka - '.$_uangmuka,FALSE); 
					  $this->db->where('kodepu', $faktur); 
					  $this->db->update('ap_pufile'); 
					  
					 $dfaktur =  $this->db->query("select * from ap_pufile where kodepu = '$faktur'")->row();
					 $kodepb  = $dfaktur->kodepb;
					 $dpo     = $this->db->query("select * from ap_lpb where nolpb = '$kodepb'")->row();
					 $kodepo  = $dpo->kodepo;
					 
					 $this->db->query("update ap_uangmuka set jumlahbayar=jumlahbayar-$_uangmuka
					 where kodepo = '$kodepo'");
					 
				  }
				  
			}
			$this->db->delete('ap_bayardetil',array('kodebyr' => $nobukti));
			$faktur  = $this->input->post('faktur');
			$tglfaktur   = $this->input->post('tglfaktur');
		    $totfaktur   = $this->input->post('totfaktur');
			$hutang = $this->input->post('hutang');
			$bayar = $this->input->post('bayar');
			$disc  = $this->input->post('disc');
			$uangmuka  = $this->input->post('uangmuka');
		   
			$jumdata  = count($faktur);
						
			$nourut = 1;
			$_totuangmuka = 0;
			
			for($i=0;$i<=$jumdata;$i++)
			{
			    $_faktur   = $faktur[$i];
				$_totfaktur =str_replace(',','',$totfaktur[$i]);
				$_hutang    =str_replace(',','',$hutang[$i]);
				$_bayar     =str_replace(',','',$bayar[$i]);
				$_disc      =str_replace(',','',$disc[$i]);
				$_uangmuka  =str_replace(',','',$uangmuka[$i]);
				
				$_total = $_bayar - $_disc + $_uangmuka;
				
				$_totuangmuka = $_totuangmuka + $_uangmuka;
				
			    $datad = array(
				'kodebyr'   => $nobukti,
				'nomorfaktur' => $_faktur,
				'tglfaktur' => date('Y-m-d',strtotime($tglfaktur[$i])),
				'totalfaktur' => $_totfaktur,
				'terhutang' => $_hutang,
				'bayar' => $_bayar,
				'uangmuka' => $_uangmuka,
				'diskon' => $_disc,				
			    );
				if($_total!="0"){
			      $this->db->insert('ap_bayardetil', $datad);	
				  
				  //update faktur				  				  				 
				  $this->db->set('jumlahbayar', 'jumlahbayar + '.$_bayar,FALSE); 
				  $this->db->set('uangmuka', 'uangmuka + '.$_uangmuka,FALSE); 
				  $this->db->where('kodepu', $_faktur); 
				  $this->db->update('ap_pufile'); 				  				  
				  
				  if($_uangmuka>0){
					 $dfaktur =  $this->db->query("select * from ap_pufile where kodepu = '$_faktur'")->row();
					 $kodepo  = $dfaktur->kodepo;
					 
					 $this->db->query("update ap_uangmuka set jumlahbayar=jumlahbayar+$_uangmuka
					 where kodepo = '$kodepo'");
					 
				  }
				  
				  $this->db->query('update ap_pufile set statusid=2 where jumlahbayar+uangmuka>=totalpu and kodepu = "'.$_faktur.'"');				  
				}
			}
			
			$_jumlahbayar =str_replace(',','',$this->input->post('jumlahbayar'));
			$data = array(
			    'kodecbg' => $this->session->userdata('unit'),
				'kodesup' => $this->input->post('supp'),
				'kodebyr'  => $this->input->post('nomorbukti'),
				'kodebank'  => $this->input->post('kasbank'),
				'metodebayar'  => $this->input->post('metodebayar'),				
				'tglbayar'   => date('Y-m-d',strtotime($this->input->post('tanggal'))),
				'nomorcek'  => $this->input->post('nomorcek'),				
				'tglcek'   => date('Y-m-d',strtotime($this->input->post('tanggalcek'))),
				'jumlahbayar'  => $_jumlahbayar,				
				'kodeuser'=> $userid,
				'keterangan'     => $this->input->post('keterangan'),				
				'statusid'=> 1,			                
			);
					
			$this->M_global->_hapusjurnal($this->input->post('nomorbukti'), 'JP');	
			
			$profile = $this->M_global->_LoadProfileLap();			
			$akun_debet     = $profile->akun_hutang;
			$akun_uangmuka  = $profile->akun_uangmuka;
			
			$akun_kredit    = $this->input->post('kasbank');
			
			
			$this->M_global->_rekamjurnal(
			date('Y-m-d',strtotime($this->input->post('tanggal'))),
			$this->input->post('nomorbukti'),
			'JP',
			$this->input->post('supp'),
			1,
			$akun_debet,
			'Pembayaran ke Supplier '.$this->input->post('supp'),
			'Pembayaran ke Supplier',
			$_jumlahbayar+$_totuangmuka,
			0
			);
			
			$this->M_global->_rekamjurnal(
			date('Y-m-d',strtotime($this->input->post('tanggal'))),
			$this->input->post('nomorbukti'),
			'JP',
			$this->input->post('supp'),
			2,
			$akun_kredit,
			'Pembayaran ke Supplier '.$this->input->post('supp'),
			'Pembayaran ke Supplier',
			0,
			$_jumlahbayar
			);
			
			if($_totuangmuka>0){
			$this->M_global->_rekamjurnal(
			date('Y-m-d',strtotime($this->input->post('tanggal'))),
			$this->input->post('nomorbukti'),
			'JP',
			$this->input->post('supp'),
			3,
			$akun_uangmuka,
			'Pembayaran ke Supplier '.$this->input->post('supp'),
			'Pembayaran ke Supplier',
			0,
			$_totuangmuka
			);	
			}
			
			
			if($param==1)
			{
			  $this->db->insert('ap_bayar',$data);	
			  $this->M_global->_updatecounter1('PP');		  
			} else {
			  $this->db->update('ap_bayar',$data, array('kodebyr' => $nobukti));				 
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
					
			$header = $this->db->get_where('ap_bayar', array('kodebyr' => $nomor));
			$detil  = $this->db->get_where('ap_bayardetil', array('kodebyr' => $nomor));
			
			$d['header']  = $header->result();
			$d['detil']   = $detil->result();			
			$d['jumdata1']= $detil->num_rows();				
			$d['supp'] = $this->db->order_by('nama')->get_where('ap_supplier',array('nama !=' => ''))->result();			
		    $d['bank'] = $this->db->get_where('ms_akun',array('akuninduk !=' => '','kelompok' => 'BANK'))->result();
		    $d['unit'] = $this->db->get('ms_unit')->result();
			$this->load->view('pembelian/v_pembelian_bayar_edit',$d);
			} else
		{
			header('location:'.base_url());
		}	
	}
}
/* End of file Pembelian_bayar.php */
/* Location: ./application/controllers/Pembelian_bayar.php */