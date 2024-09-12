<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penjualan_retur extends CI_Controller {

	/**
	 * @author : Enjang RK
	 * @web : http://e-soft.comli.com
	 * @keterangan : Controller untuk modul retur penjualan
	 **/
	
	
	
	
	public function __construct()
	{
		parent::__construct();
		$this->session->set_userdata('menuapp', '400');
		$this->session->set_userdata('submenuapp', '426');
		$this->load->helper('simkeu_nota');
	}

	public function index()
	{
		$cek = $this->session->userdata('level');		
		$unit= $this->session->userdata('unit');	
        		
		if(!empty($cek))
		{	
		  	 
		  $q1 = 
				"select a.koderetur,  a.tglretur, b.nama, a.keterangan, a.totalretur, a.statusid
				from
				   ar_retur a,
				   ar_customer b
				where
				   a.kodecust=b.kode and
				   year(a.tglretur)= (select periode_tahun from ms_identity) and
				   month(a.tglretur)= (select periode_bulan from ms_identity) and
				   a.kodecbg = '$unit'
				order by
				   a.tglretur, a.kodesi desc";

		  $bulan  = $this->M_global->_periodebulan();
          $nbulan = $this->M_global->_namabulan($bulan);
		  $periode= 'Periode '.$nbulan.'-'.$this->M_global->_periodetahun();	   
	      $d['keu'] = $this->db->query($q1)->result();
		  $level=$this->session->userdata('level');		
		  $akses= $this->M_global->cek_menu_akses($level, 426);
		  $d['akses']= $akses;
          $d['periode'] = $periode;		  
		  $this->load->view('penjualan/v_penjualan_retur',$d);			   
		
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
				"select a.koderetur,  a.tglretur, b.nama, a.keterangan, a.totalretur, a.statusid
				from
				   ar_retur a,
				   ar_customer b
				where
				   a.kodecust=b.kode and
				   a.tglretur between '$_tgl1' and '$_tgl2' and
				   a.kodecbg = '$unit'
				order by
				   a.tglretur, a.kodesi desc";

		  
		  $periode= 'Periode '.date('d-m-Y',strtotime($tgl1)).' s/d '.date('d-m-Y',strtotime($tgl2));	   
	      $d['keu'] = $this->db->query($q1)->result();
		  $level=$this->session->userdata('level');		
		  $akses= $this->M_global->cek_menu_akses($level, 426);
		  $d['akses']= $akses;
          $d['periode'] = $periode;		  
		  $this->load->view('penjualan/v_penjualan_retur',$d);			   
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
		  
		    $queryh = "select * from ar_retur inner join ar_customer on ar_retur.kodecust=ar_customer.kode where koderetur = '$param'";
			$queryd = "select * from ar_returdetil inner join inv_barang on ar_returdetil.kodeitem=inv_barang.kodeitem where ar_returdetil.koderetur = '$param'";
			 
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
			$judul=array('Dari :','','Retur Penjualan');
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
			$pdf->FancyRow(array($header->nama,'','No. Retur',':',$header->koderetur), $fc, $border);
			$pdf->FancyRow(array($header->alamat1,'','Tanggal',':',date('d M Y',strtotime($header->tglretur))), $fc, $border);
			$pdf->FancyRow(array($header->alamat2,'','Pengembalian',':',$header->kodesi), $fc, $border);
			$pdf->FancyRow(array($header->telp,'','','',''), $fc, $border);
			
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
			  $dpp = $db->qtyretur*$db->hargajual;	
			  $dis = ($db->disc/100)*$dpp;
			  $jum = $dpp-$dis;
			  $tot = $tot + $jum; 	
			  
			  $subtot = $subtot + $dpp; 	
			  $tdisc  = $tdisc + $dis; 	
			  
			  $pdf->FancyRow(array(
			  $db->kodeitem, 
			  $db->namabarang,
			  $db->qtyretur,
			  number_format($db->hargajual,0,'.',','),
			  $db->disc, 
			  number_format($jum,0,'.',',')),$fc, $border, $align);
			  
			}
			
			
			if($header->sppn=="Y"){
			    $ppn = $subtot * 0.1;
			} else {
				$ppn = 0;
			}
			$tot = $tot + $ppn;
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
			$pdf->FancyRow(array($header->keterangan,'', 'Diskon', number_format($tdisc,0,'.',',')),$fc, $border, $align);
			$pdf->FancyRow(array('','', 'PPN (10%)', number_format($ppn,0,'.',',')),$fc, $border, $align);
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
			$pdf->AliasNbPages();
			$pdf->output($param.'.PDF','I');			
		}
		else
		{
			
			header('location:'.base_url());
			
		}
	}
	
	
	public function getpo($po)
	{   	    
        $data = $this->db->select('ar_sidetail.*, inv_barang.namabarang')->join('inv_barang','inv_barang.kodeitem=ar_sidetail.kodeitem','left')->get_where('ar_sidetail',array('kodesi' => $po))->result();
		echo json_encode($data);
	}
	
	public function getbiaya($po)
	{   	    
        $data = $this->db->select('ap_pobiaya.*, ms_akun.namaakun')->join('ms_akun','ms_akun.kodeakun=ap_pobiaya.kodeakun','left')->get_where('ap_pobiaya',array('kodepo' => $po))->result();
		echo json_encode($data);
	}
	
	public function getlistpo( $supp )
	{
		if(!empty($supp))
		{
		    //$po  = $this->db->get_where('ar_sifile',array('kodecust' => $supp, 'statusid' => 1))->result();	
			$po  = $this->db->query('select * from ar_sifile where kodesi not in(select kodesi from ar_retur)')->result();	
			
			?>						
			<select name="kodesi" id="kodesi" class="form-control  input-medium select2me"  >            											
			  <option value="">-- Tanpa Faktur ---</option>
			  <?php 			    
				foreach($po  as $row){	
				?>
				<option value="<?php echo $row->kodesi;?>"><?php echo $row->kodesi;?></option>
				
			  <?php } ?>
			</select>
			<span class="input-group-btn">
				<a class="btn blue" onclick="getpoheader();getpo();"><i class="fa fa-download"></i></a>
			</span>	
			
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
		  $d['nomor']= $this->M_global->_Autonomor('SR');
		  $this->load->view('penjualan/v_penjualan_retur_add',$d);				
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
	       $dataretur = $this->db->get_where('ar_returdetil', array('koderetur' => $nomor))->result();
				   foreach($dataretur as $row){					 
					 $this->db->query('update inv_barang set stok = stok - '.$row->qtyretur.' where kodeitem = "'.$row->kodeitem.'"');	
					 $this->db->delete('inv_transaksi',array('nobukti' => $nomor, 'kodeitem' => $row->kodeitem));
		   }
		   
		   $this->db->delete('ar_retur',array('koderetur' => $nomor));
		   $this->db->delete('ar_returdetil',array('koderetur' => $nomor));
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
			
			<table id="myTable" class="table">
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
				 <td width="50" align="center">
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
			$this->db->delete('ar_returdetil',array('koderetur' => $nobukti));
			//$this->db->delete('ap_retur',array('koderetur' => $nobukti));
			$kode  = $this->input->post('kode');
			$qty   = $this->input->post('qty');
		    $sat   = $this->input->post('sat');
			$harga = $this->input->post('harga');
			$disc  = $this->input->post('disc');
		   
			$jumdata  = count($kode);
			
			
			$nourut = 1;
			$tot = 0;
			$tdisc = 0;
			
			for($i=0;$i<=$jumdata;$i++)
			{
			    $_kode   = $kode[$i];
				//$tot = $tot + str_replace(',','',$jumlah[$i]);
				$hpp = $this->db->get_where('inv_barang', ['kodeitem' => $_kode])->row()->hargabeli;
				if($param==2){
				   $dataretur = $this->db->get_where('ar_returdetil', array('koderetur' => $nobukti))->result();
				   foreach($dataretur as $row){					 
					 $this->db->query('update inv_barang set stok = stok - '.$row->qtyretur.' where kodeitem = "'.$row->kodeitem.'"');	
					 $this->db->delete('inv_transaksi',array('nobukti' => $nobukti, 'kodeitem' => $row->kodeitem));
				   }				   				   				   		  
				}   		
				
				$vjum  = $qty[$i] * $harga[$i];
				$vdisc = $vjum * ($disc[$i]/100);
				$tot   = $tot + $vjum;
				$tdisc = $tdisc + $vdisc;
				
			    $datad = array(
				'koderetur'   => $nobukti,
				'kodeitem' => $_kode,
				'qtyretur' => $qty[$i],
				'satuan' => $sat[$i],
				'hargajual' => $harga[$i],
				'disc' => $disc[$i],
			    );
				
				$data_inv = array(
				'tanggal'   => date('Y-m-d'),
				'kodeitem' => $_kode,
				'penerimaan' => $qty[$i],
				'pengeluaran' => 0,
				'satuan' => $sat[$i],
				'jenis' => 'Retur Penjualan',
				'nobukti' => $nobukti,
				'tglrekam'   => date('Y-m-d H:i:s'),
				'hpp'   => $hpp,
				'hargajual'   => 0,
			    );
				
				if($qty[$i]!="0" && $_kode!=""){
			      $this->db->insert('ar_returdetil', $datad);
				  $this->db->insert('inv_transaksi', $data_inv);	                   		 		   
				  $this->db->query('update inv_barang set stok = stok + '.$qty[$i].' where kodeitem = "'.$_kode.'"');						  				  
				}
			}
			
			if($this->input->post('sppn')=="Y"){
				$tppn = ($tot - $tdisc) * 0.1;
			} else {
				$tppn = 0;
			}
			
			$data = array(
			    'kodecbg' => $this->session->userdata('unit'),
				'kodecust' => $this->input->post('cust'),
				'koderetur'  => $this->input->post('nomorbukti'),
				'kodesi'  => $this->input->post('kodesi'),
				'tglretur'   => date('Y-m-d',strtotime($this->input->post('tanggal'))),
				'kodeuser'=> $userid,
				'keterangan' => $this->input->post('keterangan'),
				'totalretur' => $tot+$tppn-$tdisc,
				'dpp'     => $tot,
				'ppn'     => $tppn,
				'diskon'  => $tdisc,
				'sppn'    => $this->input->post('sppn'),
				'statusid'=> 1,			
			);
						
			$this->M_global->_hapusjurnal($this->input->post('nomorbukti'), 'JJ');	
			
			$profile = $this->M_global->_LoadProfileLap();			
			$akun_debet     = $profile->akun_retjual;
			$akun_kredit    = $profile->akun_persediaan;
			
			$total = $tot+$tppn-$tdisc;
			
			$this->M_global->_rekamjurnal(
			date('Y-m-d',strtotime($this->input->post('tanggal'))),
			$this->input->post('nomorbukti'),
			'JJ',
			$this->input->post('kodesi'),
			1,
			$akun_debet,
			'Retur Penjualan '.$this->input->post('kodesi'),
			'Retur Penjualan '.$this->input->post('kodesi'),
			$total,
			0
			);
			
			$this->M_global->_rekamjurnal(
			date('Y-m-d',strtotime($this->input->post('tanggal'))),
			$this->input->post('nomorbukti'),
			'JJ',
			$this->input->post('kodesi'),
			2,
			$akun_kredit,
			'Retur Penjualan '.$this->input->post('kodesi'),
			'Retur Penjualan '.$this->input->post('kodesi'),
			0,
			$total
			);
			
			if($param==1)
			{
			  $this->db->insert('ar_retur',$data);	
			  $this->M_global->_updatecounter1('SR');		  
			} else {
			  $this->db->update('ar_retur',$data, array('koderetur' => $nobukti));				 
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
					
			$header = $this->db->get_where('ar_retur', array('koderetur' => $nomor));
			$detil  = $this->db->join('inv_barang','inv_barang.kodeitem=ar_returdetil.kodeitem')->get_where('ar_returdetil', array('koderetur' => $nomor));
			
			$d['header']  = $header->result();
			$d['detil']   = $detil->result();
			$d['jumdata1']= $detil->num_rows();	
			$d['cust'] = $this->db->order_by('nama')->get_where('ar_customer',array('nama !=' => ''))->result();
		    $d['unit'] = $this->db->get('ms_unit')->result();
			$this->load->view('penjualan/v_penjualan_retur_edit',$d);
			} else
		{
			header('location:'.base_url());
		}	
	}
}
/* End of file penjualan_retur.php */
/* Location: ./application/controllers/penjualan_retur.php */