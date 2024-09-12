<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pembelian_retur extends CI_Controller {

	/**
	 * @author : Enjang RK
	 * @web : http://e-soft.comli.com
	 * @keterangan : Controller untuk modul saldo awal keuangan
	 **/
	
	
	
	
	public function __construct()
	{
		parent::__construct();
		$this->session->set_userdata('menuapp', '300');
		$this->session->set_userdata('submenuapp', '326');
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
				   ap_retur a,
				   ap_supplier b
				where
				   a.kodesup=b.kode and
				   year(a.tglretur)= (select periode_tahun from ms_identity) and
				   month(a.tglretur)= (select periode_bulan from ms_identity) and
				   a.kodecbg = '$unit'
				order by
				   a.tglretur, a.kodepu desc";

		  $bulan  = $this->M_global->_periodebulan();
          $nbulan = $this->M_global->_namabulan($bulan);
		  $periode= 'Periode '.$nbulan.'-'.$this->M_global->_periodetahun();	   
	      $d['keu'] = $this->db->query($q1)->result();
          $d['periode'] = $periode;
          $level=$this->session->userdata('level');		
		  $akses= $this->M_global->cek_menu_akses($level, 326);
		  $d['akses']= $akses;		  
		  
		  $this->load->view('pembelian/v_pembelian_retur',$d);			   
		
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
				   ap_retur a,
				   ap_supplier b
				where
				   a.kodesup=b.kode and
				   a.tglretur between '$_tgl1' and '$_tgl2'  and
				   a.kodecbg = '$unit'
				order by
				   a.tglretur, a.kodepu desc";

		  
		  $periode= 'Periode '.date('d-m-Y',strtotime($tgl1)).' s/d '.date('d-m-Y',strtotime($tgl2));	   
	      $d['keu'] = $this->db->query($q1)->result();
          $d['periode'] = $periode;	
          $level=$this->session->userdata('level');		
		  $akses= $this->M_global->cek_menu_akses($level, 326);
		  $d['akses']= $akses;		  
		  $this->load->view('pembelian/v_pembelian_retur',$d);			   
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
		  
		    $queryh = "select * from ap_retur inner join ap_supplier on ap_retur.kodesup=ap_supplier.kode where koderetur = '$param'";
			$queryd = "select * from ap_returdetil inner join inv_barang on ap_returdetil.kodeitem=inv_barang.kodeitem where ap_returdetil.koderetur = '$param'";
			 
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
			$judul=array('Kepada :','','Retur Pembelian');
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
			$pdf->FancyRow(array($header->alamat2,'','No. Ref',':',$header->kodepu), $fc, $border);
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
			  $dpp = $db->qtyretur*$db->hargabeli;	
			  $dis = ($db->disc/100)*$dpp;
			  $jum = $dpp-$dis;
			  $tot = $tot + $jum; 	
			  
			  $subtot = $subtot + $dpp; 	
			  $tdisc  = $tdisc + $dis; 	
			  
			  $pdf->FancyRow(array(
			  $db->kodeitem, 
			  $db->namabarang,
			  $db->qtyretur,
			  number_format($db->hargabeli,0,'.',','),
			  $db->disc, 
			  number_format($jum,0,'.',',')),$fc, $border, $align);
			  
			}
			
			
			if($header->sppn=="Y"){
			    $ppn = ($subtot-$tdisc) * 0.1;
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
			///$pdf->SetFillColor(0,0,139);
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
        $data = $this->db->select('ap_pudetail.*, inv_barang.namabarang')->join('inv_barang','inv_barang.kodeitem=ap_pudetail.kodeitem','left')->get_where('ap_pudetail',array('kodepu' => $po))->result();
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
		    //$po  = $this->db->get_where('ap_pufile',array('kodesup' => $supp, 'statusid' => 1))->result();	
			$po  = $this->db->query('select * from ap_pufile where kodepu not in(select kodepu from ap_retur)')->result();	
			?>						
			<select name="kodepu" id="kodepu" class="form-control  input-medium select2me"  >            											
			  <option value="">-- Tanpa Faktur ---</option>
			  <?php 			    
				foreach($po  as $row){	
				?>
				<option value="<?php echo $row->kodepu;?>"><?php echo $row->kodepu;?></option>
				
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
          $d['supp'] = $this->db->order_by('nama')->get_where('ap_supplier',array('nama !=' => ''))->result();
		  $d['unit'] = $this->db->get('ms_unit')->result();
		  $d['nomor']= $this->M_global->_Autonomor('PR');
		  $this->load->view('pembelian/v_pembelian_retur_add',$d);				
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
	       if($param==2){
				   $dataretur = $this->db->get_where('ap_returdetil', array('koderetur' => $nomor))->result();
				   foreach($dataretur as $row){					 
					 $this->db->query('update inv_barang set qty = qty + '.$row->qtyretur.' where kodeitem = "'.$row->kodeitem.'"');	
					 $this->db->delete('inv_transaksi',array('nobukti' => $nomor, 'kodeitem' => $row->kodeitem));
				   }				   				   				   		  
		   } 
				
		   $this->db->delete('ap_retur',array('koderetur' => $nomor));
		   $this->db->delete('ap_returdetil',array('koderetur' => $nomor));
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
					<a href="#" onclick="post_harga('<?php echo $row->hargabeli;?>','<?php echo $row->satuan;?>')">
					
					<?php echo $row->kodepu;?></a>
				 </td>	     
				 <td><?php echo date('d-m-Y',strtotime($row->tglpu));?></td>
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
				   $dataretur = $this->db->get_where('ap_returdetil', array('koderetur' => $nobukti))->result();
				   foreach($dataretur as $row){					 
					 $this->db->query('update inv_barang set stok = stok + '.$row->qtyretur.' where kodeitem = "'.$row->kodeitem.'"');	
					 $this->db->delete('inv_transaksi',array('nobukti' => $nobukti, 'kodeitem' => $row->kodeitem));
				   }				   				   				   		  
				} 
				
			$this->db->delete('ap_returdetil',array('koderetur' => $nobukti));
			
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
				$vjum  = $qty[$i] * $harga[$i];
				$vdisc = $vjum * ($disc[$i]/100);
				$tot   = $tot + $vjum;
				$tdisc = $tdisc + $vdisc;
				
			    $datad = array(
				'koderetur'   => $nobukti,
				'kodeitem' => $_kode,
				'qtyretur' => $qty[$i],
				'satuan' => $sat[$i],
				'hargabeli' => $harga[$i],
				'disc' => $disc[$i],
			    );
				
				$data_inv = array(
				'tanggal'   => date('Y-m-d'),
				'kodeitem' => $_kode,
				'penerimaan' => 0,
				'pengeluaran' => $qty[$i],
				'satuan' => $sat[$i],
				'jenis' => 'Retur Pembelian',
				'nobukti' => $nobukti,
				'tglrekam'   => date('Y-m-d H:i:s'),
				'hpp'   => $hpp,
				'hargajual'   => 0,
			    );
				
				if($qty[$i]!="0" && $_kode!=""){
			      $this->db->insert('ap_returdetil', $datad);
				  $this->db->insert('inv_transaksi', $data_inv);	                   		 		   
				  $this->db->query('update inv_barang set stok = stok - '.$qty[$i].' where kodeitem = "'.$_kode.'"');		
				}
			}
			
			if($this->input->post('sppn')=="Y"){
				$tppn = ($tot - $tdisc) * 0.1;
			} else {
				$tppn = 0;
			}
			
			$data = array(
			    'kodecbg' => $this->session->userdata('unit'),
				'kodesup' => $this->input->post('supp'),
				'koderetur'  => $this->input->post('nomorbukti'),
				'kodepu'  => $this->input->post('kodepu'),
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
						
			$this->M_global->_hapusjurnal($this->input->post('nomorbukti'), 'JP');	
			
			$profile = $this->M_global->_LoadProfileLap();			
			$akun_debet     = $profile->akun_hutang;
			$akun_kredit    = $profile->akun_persediaan;
			
			$total = $tot+$tppn-$tdisc;
			
			$this->M_global->_rekamjurnal(
			date('Y-m-d',strtotime($this->input->post('tanggal'))),
			$this->input->post('nomorbukti'),
			'JP',
			$this->input->post('kodepu'),
			1,
			$akun_debet,
			'Retur Pembelian '.$this->input->post('kodepu'),
			'Retur Pembelian '.$this->input->post('kodepu'),
			$total,
			0
			);
			
			$this->M_global->_rekamjurnal(
			date('Y-m-d',strtotime($this->input->post('tanggal'))),
			$this->input->post('nomorbukti'),
			'JP',
			$this->input->post('kodepu'),
			2,
			$akun_kredit,
			'Retur Pembelian '.$this->input->post('kodepu'),
			'Retur Pembelian '.$this->input->post('kodepu'),
			0,
			$total
			);
			
			
			if($param==1)
			{
			  $this->db->insert('ap_retur',$data);	
			  $this->M_global->_updatecounter1('PR');		  
			} else {
			  $this->db->update('ap_retur',$data, array('koderetur' => $nobukti));				 
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
					
			$header = $this->db->get_where('ap_retur', array('koderetur' => $nomor));
			$detil  = $this->db->join('inv_barang','inv_barang.kodeitem=ap_returdetil.kodeitem')->get_where('ap_returdetil', array('koderetur' => $nomor));
			
			$d['header']  = $header->result();
			$d['detil']   = $detil->result();
			$d['jumdata1']= $detil->num_rows();	
			$d['supp'] = $this->db->order_by('nama')->get_where('ap_supplier',array('nama !=' => ''))->result();
		    $d['unit'] = $this->db->get('ms_unit')->result();
			$this->load->view('pembelian/v_pembelian_retur_edit',$d);
			} else
		{
			header('location:'.base_url());
		}	
	}
}
/* End of file keuangan_saldo.php */
/* Location: ./application/controllers/keuangan_saldo.php */