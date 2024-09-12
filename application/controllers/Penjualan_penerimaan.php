<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penjualan_penerimaan extends CI_Controller {

	/**
	 * @author : Enjang RK
	 * @keterangan : Controller untuk modul Penerimaan Pembayaran
	 **/
	
	
	
	
	public function __construct()
	{
		parent::__construct();
		$this->session->set_userdata('menuapp', '400');
		$this->session->set_userdata('submenuapp', '425');
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
				   ar_penerimaan a,
				   ar_customer b,
				   ms_akun c
				where
				   a.kodecust=b.kode and
				   a.kodebank=c.kodeakun and
				   year(a.tglbayar)= (select periode_tahun from ms_identity) and
				   month(a.tglbayar)= (select periode_bulan from ms_identity) and
				   a.kodecbg = '$unit'
				order by
				   a.tglbayar, a.kodebyr desc";
       
		  $nbulan = $this->M_global->_namabulan($bulan);
		  $periode= 'Periode '.$nbulan.'-'.$this->M_global->_periodetahun();	   
	      $d['keu'] = $this->db->query($q1)->result();
          $level=$this->session->userdata('level');		
		  $akses= $this->M_global->cek_menu_akses($level, 425);
		  $d['akses']= $akses;		  
          $d['periode'] = $periode;		  
		  $this->load->view('penjualan/v_penjualan_penerimaan',$d);			   
		
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
				"select a.kodebyr, a.tglbayar, a.nomorcek, a.tglcek, b.nama, c.namaakun as bank, a.statusid, a.jumlahbayar
				from
				   ar_penerimaan a,
				   ar_customer b,
				   ms_akun c
				where
				   a.kodecust=b.kode and
				   a.kodebank=c.kodeakun and
				  tglbayar between '$_tgl1' and '$_tgl2' and 
				   a.kodecbg = '$unit'
				order by
				   a.tglbayar, a.kodebyr desc";

		  
		  $periode= 'Periode '.date('d-m-Y',strtotime($tgl1)).' s/d '.date('d-m-Y',strtotime($tgl2));	   
	      $d['keu'] = $this->db->query($q1)->result();
		  $level=$this->session->userdata('level');		
		  $akses= $this->M_global->cek_menu_akses($level, 425);
		  $d['akses']= $akses;
          $d['periode'] = $periode;		  
		  $this->load->view('penjualan/v_penjualan_penerimaan',$d);			   
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
		  
		    $queryh = "select * from ar_penerimaan inner join ar_customer on ar_penerimaan.kodecust=ar_customer.kode where kodebyr = '$param'";
			 
		    $header = $this->db->query($queryh)->row();			
		    $pdf=new simkeu_nota();
			$pdf->setID($nama_usaha,$alamat1,$alamat2);
			$pdf->setjudul('');
			$pdf->setsubjudul('');
			$pdf->addpage("P","A4");   
			$pdf->setsize("P","A4");
			$pdf->SetWidths(array(190));			
			$size   = array('','','');
			$pdf->setfont('Arial','B',18);
			$border = array('');
			$align = array('C');
			$style = array('');
			$size  = array('18');
			$pdf->SetFillColor(230,230,230);			
			$judul=array('Tanda Terima Pembayaran');
			$fc     = array('1');
			$hc     = array('20','20','20');
			$pdf->FancyRow2(10,$judul, $fc,  $border, $align, $style, $size);
			$pdf->ln(5);
			$pdf->setfont('Arial','',10);
			$pdf->SetWidths(array(15,30,5,100));
			$border = array('','','','');
			$fc     = array('0','0','0','0');						
			$align  = array('L','L',':','L');
			$pdf->FancyRow(array('','Nomor',':',$header->kodebyr), $fc, $border, $align);
			$pdf->FancyRow(array('','Tanggal',':',date('d M Y',strtotime($header->tglbayar))), $fc, $border);
			
			$pdf->ln(2);
			$pdf->SetWidths(array(10,100));	
			$align = array('C','L');
			$pdf->FancyRow(array('','Telah menerima pembayaran / Cek / Giro sebagai berikut :'), $fc, $border, $align);
			$pdf->ln(2);
			$pdf->SetWidths(array(15,30,5,100));
			$border = array('','','','');
			$fc     = array('0','0','0','0');						
			$align  = array('L','L','C','L');
			$style  = array('','','','');
			$size  = array('','','','');
			$pdf->FancyRow(array('','Diterima Dari',':',$header->nama), $fc, $border, $align,  $style, $size);
			$style = array('','','B','B');
			$pdf->FancyRow(array('','Jumlah',':','Rp '.number_format($header->jumlahbayar,0,'.',',')), $fc, $border, $align, $style, $size);
			$style = array('','','','');
			$pdf->FancyRow(array('','Terbilang',':',ucwords($this->M_global->terbilang($header->jumlahbayar))), $fc, $border, $align, $style, $size);
			
			
			$pdf->settextcolor(0);
			$pdf->SetWidths(array(80, 50,2,50));
			$pdf->SetFont('Arial','',10);
			$pdf->SetAligns(array('C','C','C','C'));
			$pdf->ln(10);
			
			$border = array('','','','');
			$align  = array('C','C','C','C');
			$pdf->FancyRow(array('','Mengetahui','','Penerima'),0,$border, $align);
			$pdf->ln(1);
			$pdf->ln(15);
		
			$pdf->SetFont('Arial','',8);		
            $fc     = array('0','0','0','0');				
			$align  = array('L','C','L','L');
			$border = array('','B','','B');	
			$pdf->FancyRow(array('* Pembayaran akan dianggap sah','','',''),$fc,$border,$align);
			$border = array('','','','');	
			$align  = array('L','L','L','L');
			$pdf->FancyRow(array('setelah cek/giro dicairkan','Tgl.','','Tgl.'),$fc,$border,$align);
	
		

			$pdf->AliasNbPages();
			$pdf->output($param.'.PDF','I');			
		}
		else
		{
			
			header('location:'.base_url());
			
		}
	}
	
	
	public function getfaktur($cust)
	{   	    
	   
		$data = $this->db->query("select ar_sifile.*, totalsi as total, (totalsi-jumlahbayar-uangmuka) as hutang from ar_sifile where kodecust='$cust' and totalsi>jumlahbayar+uangmuka")->result();
		$vdata = array();
		foreach($data as $row){
			//
			$kodeso = $row->kodeso;
			
			$duangmuka = $this->db->query("select * from ar_uangmuka where kodeso = '$kodeso' and jumlahum>jumlahbayar")->row();
			if($duangmuka){
			  $uangmuka = $duangmuka->jumlahum;	
			} else {
			  $uangmuka = 0;	
			}
				
			
			$vdata[] = array(
			 'kodesi' => $row->kodesi,
			 'tglsi' => date('d-m-Y',strtotime($row->tglsi)),
			 'totalsi' => $row->totalsi,
			 'uangmuka' => $uangmuka,
			 'hutang' => $row->hutang,
			 'total' => $row->total,
			);
		}
		echo json_encode($vdata);
		
	}
	
	public function getfaktur_entry($nomor)
	{   	    
        $data = $this->db->select('ar_penerimaandetil.*, date_format(tglfaktur, "%d-%m-%Y") as tanggal')->get_where('ar_penerimaandetil',array('kodebyr' => $nomor))->result();		
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
		    $po  = $this->db->get_where('ar_sifile',array('kodecust' => $supp))->result();	
			?>	
            <div class="input-group">
			<select name="kodesi" id="kodesi" class="form-control  input-medium select2me"  >            											
			  <option value="">-- Tanpa Faktur --</option>
			  <?php 			    
				foreach($po  as $row){	
				?>
				<option value="<?php echo $row->kodesi;?>"><?php echo $row->kodesi;?></option>
				
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
          $d['cust'] = $this->db->order_by('nama')->get_where('ar_customer',array('nama !=' => ''))->result();
		  $d['bank'] = $this->db->get_where('ms_akun',array('akuninduk !=' => '','kelompok' => 'BANK'))->result();
		  $d['unit'] = $this->db->get('ms_unit')->result();
		  $d['nomor']= $this->M_global->_Autonomor('ST');
		  $this->load->view('penjualan/v_penjualan_penerimaan_add',$d);				
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
	       //update faktur				
			  $bayar = $this->db->get_where('ar_penerimaandetil', array('kodebyr' => $nomor))->result();				  
			  foreach($bayar as $row){
				  $_bayar = $row->bayar;
				  $_uangmuka = $row->uangmuka;
				  $faktur = $row->nomorfaktur;
				  $this->db->set('jumlahbayar', 'jumlahbayar - '.$_bayar,FALSE); 
				  $this->db->set('uangmuka', 'uangmuka - '.$_uangmuka,FALSE); 
				  $this->db->where('kodesi', $faktur); 
				  $this->db->update('ar_sifile'); 
				  
				  $this->db->query('update ar_sifile set statusid=2 where jumlahbayar+uangmuka>=totalsi and kodesi = "'.$faktur.'"');				  
			      $this->db->query('update ar_sifile set statusid=1 where jumlahbayar+uangmuka<totalsi and kodesi = "'.$faktur.'"');				  
		   
		   
				 $dfaktur =  $this->db->query("select * from ar_sifile where kodesi = '$faktur'")->row();
				 $kodeso  =  $dfaktur->kodeso;
				 
				 $this->db->query("update ar_uangmuka set jumlahbayar=jumlahbayar-$_uangmuka
				 where kodeso = '$kodeso'");
				 
			  }
				  
		   $this->db->delete('ar_penerimaan',array('kodebyr' => $nomor));
		   $this->db->delete('ar_penerimaandetil',array('kodebyr' => $nomor));	
		   $this->M_global->_hapusjurnal($nomor, 'JT');	
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
			
			$query = "select * from ar_sidetail inner join ar_sifile on ar_sifile.kodesi=ar_sidetail.kodesi where ar_sifile.kodecust = '$supp' and ar_sidetail.kodeitem = '$item' order by ar_sifile.tglsi desc";
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
					<a href="#" onclick="post_harga('<?php echo $row->hargajual;?>','<?php echo $row->satuan;?>')">
					
					<?php echo date('d-m-Y',strtotime($row->tglsi));?></a>
				 </td>	     
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
		$data = $this->db->get_where('ar_sofile',array('kodeso' => $kodepo))->row();
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
                  $bayar = $this->db->get_where('ar_penerimaandetil', array('kodebyr' => $nobukti))->result();				  
				  foreach($bayar as $row){
					  $_bayar = $row->bayar;
					  $_uangmuka = $row->uangmuka;
					  $faktur = $row->nomorfaktur;
					  $this->db->set('jumlahbayar', 'jumlahbayar - '.$_bayar,FALSE); 
					  $this->db->set('uangmuka', 'uangmuka - '.$_uangmuka,FALSE); 
					  $this->db->where('kodesi', $faktur); 
					  $this->db->update('ar_sifile'); 
					  
					 $dfaktur =  $this->db->query("select * from ar_sifile where kodesi = '$faktur'")->row();
					 $kodeso  =  $dfaktur->kodeso;
					 
					 $this->db->query("update ar_uangmuka set jumlahbayar=jumlahbayar-$_uangmuka
					 where kodeso = '$kodeso'");
					 
				  }
				  
			}
			
			$this->db->delete('ar_penerimaandetil',array('kodebyr' => $nobukti));
			$faktur  = $this->input->post('faktur');
			$tglfaktur   = $this->input->post('tglfaktur');
		    $totfaktur   = $this->input->post('totfaktur');
			$hutang = $this->input->post('hutang');
			$bayar = $this->input->post('bayar');
			$disc  = $this->input->post('disc');
			$uangmuka  = $this->input->post('uangmuka');
		   
			$jumdata  = count($faktur);
						
			$nourut = 1;
			
			$profile = $this->M_global->_LoadProfileLap();				
			$akun_debet     = $this->input->post('kasbank');
			$akun_kredit    = $profile->akun_piutang;
						
			if($param==2){
			   $this->M_global->_hapusjurnal($nobukti, 'JT');	
			}
			
			for($i=0;$i<=$jumdata;$i++)
			{
			    $_faktur   = $faktur[$i];
				$_totfaktur =str_replace(',','',$totfaktur[$i]);
				$_hutang    =str_replace(',','',$hutang[$i]);
				$_bayar     =str_replace(',','',$bayar[$i]);
				$_disc      =str_replace(',','',$disc[$i]);
				$_uangmuka  =str_replace(',','',$uangmuka[$i]);
				
				$_total = $_bayar - $_disc + $_uangmuka;
				
			    $datad = array(
				'kodebyr'   => $nobukti,
				'nomorfaktur' => $_faktur,
				'tglfaktur' => date('Y-m-d',strtotime($tglfaktur[$i])),
				'totalfaktur' => $_totfaktur,
				'terhutang' => $_hutang,
				'uangmuka' => $_uangmuka,
				'bayar' => $_bayar,
				'diskon' => $_disc,				
			    );
				if($_total!="0"){
			      $this->db->insert('ar_penerimaandetil', $datad);	
				  
				  //update faktur				  				  				 
				  $this->db->set('jumlahbayar', 'jumlahbayar + '.$_bayar,FALSE);
				  $this->db->set('uangmuka', 'uangmuka + '.$_uangmuka,FALSE);
				  $this->db->where('kodesi', $_faktur); 
				  $this->db->update('ar_sifile'); 				  				  
				  
				  if($_uangmuka>0){
					 $dfaktur =  $this->db->query("select * from ar_sifile where kodesi = '$_faktur'")->row();
					 $kodeso  = $dfaktur->kodeso;
					 
					 $this->db->query("update ar_uangmuka set jumlahbayar=jumlahbayar+$_uangmuka
					 where kodeso = '$kodeso'");
					 
				  }
				  
				  $this->db->query('update ar_sifile set statusid=2 where jumlahbayar+uangmuka>=totalsi and kodesi = "'.$_faktur.'"');	


				  $this->M_global->_rekamjurnal(
					date('Y-m-d',strtotime($this->input->post('tanggal'))),
					$this->input->post('nomorbukti'),
					'JT',
					$_faktur,
					1,
					$akun_debet,
					'Pembayaran Piutang',
					'Pembayaran Piutang Faktur '.$_faktur,
					$_total,
					0
					);
					
					$this->M_global->_rekamjurnal(
					date('Y-m-d',strtotime($this->input->post('tanggal'))),
					$this->input->post('nomorbukti'),
					'JT',
					$_faktur,
					2,
					$akun_kredit,
					'Pembayaran Piutang',
					'Pembayaran Piutang Faktur '.$_faktur,
					0,
					$_total					
					);	

				  
				}
			}
			
			$_jumlahbayar =str_replace(',','',$this->input->post('jumlahbayar'));
			$data = array(
			    'kodecbg' => $this->session->userdata('unit'),
				'kodecust' => $this->input->post('cust'),
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
						
			
			
			if($param==1)
			{
			  $this->db->insert('ar_penerimaan',$data);	
			  $this->M_global->_updatecounter1('ST');		  
			} else {
			  $this->db->update('ar_penerimaan',$data, array('kodebyr' => $nobukti));				 
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
					
			$header = $this->db->get_where('ar_penerimaan', array('kodebyr' => $nomor));
			$detil  = $this->db->get_where('ar_penerimaandetil', array('kodebyr' => $nomor));
			
			$d['header']  = $header->result();
			$d['detil']   = $detil->result();			
			$d['jumdata1']= $detil->num_rows();				
			$d['cust'] = $this->db->order_by('nama')->get_where('ar_customer',array('nama !=' => ''))->result();			
		    $d['bank'] = $this->db->get_where('ms_akun',array('akuninduk !=' => '','kelompok' => 'BANK'))->result();
		    $d['unit'] = $this->db->get('ms_unit')->result();
			$this->load->view('penjualan/v_penjualan_penerimaan_edit',$d);
			} else
		{
			header('location:'.base_url());
		}	
	}
}
/* End of file Penjualan_penerimaan.php */
/* Location: ./application/controllers/Penjualan_penerimaan.php */