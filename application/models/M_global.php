<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_global extends CI_Model {

	
	function __construct()
	{
	
	parent::__construct();
	}
	
	
	public function cek_menu($level, $modul)
	{		
		$query = $this->db->get_where( 'ms_modul_grupd', array( 'nomor_grup' => $level,'nomor_modul' => $modul));        
        return $query->num_rows();        			
	}
	
	public function cek_menu_akses($level, $modul)
	{		
		$query = $this->db->get_where( 'ms_modul_grupd', array( 'nomor_grup' => $level,'nomor_modul' => $modul));        
        return $query->row();        			
	}
	
	public function _periodebulan()
	{		
        $query = $this->db->get('ms_identity');
        $row = $query->row();
        return $row->periode_bulan;				
	}
	
	public function _hutangjatuhtempo()
	{		
	    /*
        $query = $this->db->get('ms_identity');
        $row = $query->row();
        return $row->periode_bulan;				
		*/
		return 500000;
	}
	
	public function _LoadProfile()
	{		
        $query = $this->db->get('ms_identity')->result();        
        return $query;				
	}
	
	public function _LoadProfileLap()
	{		
        $query = $this->db->get('ms_identity')->row();        
        return $query;				
	}
	
	public function _periodetahun()
	{
		$query = $this->db->get('ms_identity');
        $row = $query->row();
        return $row->periode_tahun;		
	}
	
	public function _statusrubahharga()
	{
		$query = $this->db->get('ms_identity');
        $row = $query->row();
        return $row->rubahhrg;		
	}
	
	public function _statusrubahhargam()
	{
		$query = $this->db->get('ms_identity');
        $row = $query->row();
        return $row->rubahhrgm;		
	}
	
	public function _namabulan($bln)
	{
		$nbln=array('','JANUARI','PEBRUARI','MARET','APRIL','MEI','JUNI','JULI','AGUSTUS','SEPTEMBER','OKTOBER','NOPEMBER','DESEMBER');		
		return $nbln[$bln];		
	}
	
	public function _namaunit($kode)
	{		
		$query = $this->db->get_where( 'ms_unit', array( 'kode' => $kode ) );
		$row = $query->row();
		if($row){
        return $row->nama;
        } else {
		return "";
		}			
		
	}
	
	public function _namabarang($kode)
	{		
		$query = $this->db->get_where( 'inv_barang', array( 'kodeitem' => $kode ) );
		$row = $query->row();
		if($row){
          return $row->namabarang;
		} else {
		  return '';	
		}
	}
	
	public function _hpp($kode)
	{		
		$query = $this->db->get_where( 'inv_barang', array( 'kodeitem' => $kode ) );
		$row = $query->row();
        return $row->hargabeli;
	}
	
	public function _tipeakun($kode)
	{		
		$query = $this->db->get_where( 'ms_akun_kelompok', array( 'kode' => $kode ) );
		$row = $query->row();
        return $row->nama;
	}
	
	public function _jenisakun($kode)
	{		
		$query = $this->db->select('ms_akun_kelompok.sn as jenis')->join('ms_akun_kelompok','ms_akun_kelompok.kode=ms_akun.kelompok')->get_where( 'ms_akun', array( 'ms_akun.kodeakun' => $kode ));
		$row = $query->row();
        return $row->jenis;
	}
	
	public function _lapakun($kode)
	{		
		$query = $this->db->select('ms_akun_kelompok.lap as lap')->join('ms_akun_kelompok','ms_akun_kelompok.kode=ms_akun.kelompok')->get_where( 'ms_akun', array( 'ms_akun.kodeakun' => $kode ));
		$row = $query->row();
        return $row->lap;
	}
	
	public function _namaakun($kode)
	{		
		$query = $this->db->get_where( 'ms_akun', array( 'kodeakun' => $kode ) );
		$row = $query->row();
        return $row->namaakun;
	}
	
	public function _satbarang($kode)
	{		
		$query = $this->db->get_where( 'inv_barang', array( 'kodeitem' => $kode ) );
		$row = $query->row();
        return $row->satuan;		
		
	}
	
	public function _namabank($kode)
	{
		$query = $this->db->get_where( 'ms_bank', array( 'bank_kode' => $kode ) );
		$row = $query->row();
        return $row->bank_nama;		
	}
	
			
	public function _akunlrberjalan()
	{
		$query = $this->db->get('ms_identity');
        $row = $query->row();
        return $row->akunlrberjalan;	
        
	}
	
	public function _namakaryawan($id)
	{
		$query = $this->db->get_where( 'hrd_karyawan', array( 'id' => $id ) );
		$row = $query->row();
        return $row->nama;		
	}
	
	public function _hapusjurnal($nobukti, $jenis)
	{
		$this->db->delete('tr_jurnal', ['novoucher' => $nobukti, 'jenis' => $jenis]);
	}
	
	public function _rekamjurnal($tanggal, $nobukti, $jenis, $noref, $nourut, $kodeakun, $ketglobal, $ket, $debet, $kredit)
	{
		$data = array(
				'tanggal' => date('Y-m-d',strtotime($tanggal)),
				'novoucher' => $nobukti,
				'jenis' => $jenis,
				'noref' => $noref,
				'nourut' => $nourut,
				'kodeakun' => $kodeakun,
				'ket'=> $ketglobal,
				'keterangan' => $ket,
				'debet' => str_replace(',','',$debet),
				'kredit' => str_replace(',','',$kredit),			
				'kodecbg' => $this->session->userdata('unit'),
				'userid' => $this->session->userdata('username'),
				'wbs' => '',
				'tgledit' => date('Y-m-d H:i:s'),
			    );
		//if ($kodeakun !=""){
		$this->db->insert('tr_jurnal', $data);
		//}  			
	}
	
	public function _updatejurnal($akun, $tanggal, $debet, $kredit)
	{
		$bulan = date('n',strtotime($tanggal));
		$tahun = date('Y',strtotime($tanggal));
		
		$jumdata  = $this->db->get_where('ms_akunsaldo',array('kodeakun' => $akun, 'tahun' => $tahun, 'bulan' => $bulan))->num_rows();
		if ($jumdata<1) {
			$data_awal = array(
			 'kodeakun' => $akun,
			 'tahun'    => $tahun,
			 'bulan'    => $bulan,
			 'userid'   => $this->session->userdata('username'),
			 
			);
			$this->db->insert('ms_akunsaldo', $data_awal);
		}	
	    $this->db->query('update ms_akunsaldo set debetm  = debetm  + '.$debet.', kreditm  = kreditm  + '.$kredit.' where kodeakun = "'.$akun.'" and tahun = "'.$tahun.'" and bulan = '.$bulan);
		
	}
	
	public function _saldoakun($akun,$bulan, $tahun)
	{
		
		$query = $this->db->select('*')->get_where('ms_akunsaldo',array('kodeakun' => $akun, 'tahun' => $tahun, 'bulan' => $bulan));
		$data  = $query->row();
		$jumdata= $query->num_rows();
		
		if($jumdata >0 ){
		   $saldo = $data->debet + $data->kredit;
		   return $saldo;
		} else {
			return 0;
		}
	}
	
	public function _totjurnal($akun,$jenis,$tgl1,$tgl2)
	{
		$_tgl1 = date('Y-m-d',strtotime($tgl1));
		$_tgl2 = date('Y-m-d',strtotime($tgl2));
		
		$query = $this->db->query("select sum(debet) as debet, sum(kredit) as kredit from tr_jurnal where kodeakun='$akun' and tanggal between '$_tgl1' and '$_tgl2'");	
		$data  = $query->row();
		if($jenis=="D"){
			return $data->debet - $data->kredit;
		} else {
			return $data->kredit - $data->debet;
		}		
	}
	
	public function _labarugiberjalan_tahun()
	{
		$tahun = $this->_periodetahun();
		
		$pend  = 0;
		$biaya = 0;
		$qry = 
		    "select sum(kredit-debet) as total from tr_jurnal inner join ms_akun
			on tr_jurnal.kodeakun=ms_akun.kodeakun inner join
			ms_akun_kelompok on ms_akun.kelompok=ms_akun_kelompok.kode
			where ms_akun_kelompok.lap='L' and ms_akun_kelompok.nokel=1
			and year(tr_jurnal.tanggal) = '$tahun'";
			
		$query = $this->db->query($qry);	
		$data  = $query->row();
		$pend  = $data->total;
		
		$qry = 
		    "select sum(debet-kredit) as total from tr_jurnal inner join ms_akun
			on tr_jurnal.kodeakun=ms_akun.kodeakun inner join
			ms_akun_kelompok on ms_akun.kelompok=ms_akun_kelompok.kode
			where ms_akun_kelompok.lap='L' and ms_akun_kelompok.nokel=2
			and year(tr_jurnal.tanggal) = '$tahun'";
			
		$query = $this->db->query($qry);	
		$data  = $query->row();
		$biaya = $data->total;
		
		return $pend-$biaya;
		
		
	}
	
	public function _labarugiberjalan($tgl1,$tgl2)
	{
		$_tgl1 = date('Y-m-d',strtotime($tgl1));
		$_tgl2 = date('Y-m-d',strtotime($tgl2));
		
		$pend  = 0;
		$biaya = 0;
		$qry = 
		    "select sum(kredit-debet) as total from tr_jurnal inner join ms_akun
			on tr_jurnal.kodeakun=ms_akun.kodeakun inner join
			ms_akun_kelompok on ms_akun.kelompok=ms_akun_kelompok.kode
			where ms_akun_kelompok.lap='L' and ms_akun_kelompok.nokel=1
			and tr_jurnal.tanggal between '$_tgl1' and '$_tgl2'";
			
		$query = $this->db->query($qry);	
		$data  = $query->row();
		$pend  = $data->total;
		
		$qry = 
		    "select sum(debet-kredit) as total from tr_jurnal inner join ms_akun
			on tr_jurnal.kodeakun=ms_akun.kodeakun inner join
			ms_akun_kelompok on ms_akun.kelompok=ms_akun_kelompok.kode
			where ms_akun_kelompok.lap='L' and ms_akun_kelompok.nokel=2
			and tr_jurnal.tanggal between '$_tgl1' and '$_tgl2'";
			
		$query = $this->db->query($qry);	
		$data  = $query->row();
		$biaya = $data->total;
		
		return $pend-$biaya;
		
		
	}
	
	
	
	public function _totjurnalakunbln($akun,$jenis,$bln,$thn)
	{
		$q = $this->db->query("select sum(debet) as debet, sum(kredit) as kredit from tr_jurnal where kodeakun='$akun' and year(tanggal)='$thn' and month(tanggal)='$bln'");	
        foreach($q->result() as $row)
		{
		  $debet = $row->debet;
          $kredit= $row->kredit;
        } 		  
		if($jenis=='D')
		{
		   return $debet-$kredit;
        } else
		{
		   return $kredit-$debet;	
		}			
				
	}
	
	public function _akunbank($kode)
	{				
        $query = $this->db->get_where( 'ms_bank', array( 'bank_kode' => $kode ) );
		$row = $query->row();
        return $row->bank_kodeakun;			
	}
	
	public function _data_merk( $id )
	{
		$query = $this->db->get_where( 'inv_merk', array( 'kode' => $id ) );
		return $query->row();
	}
	
	public function _data_rak( $id )
	{
		$query = $this->db->get_where( 'inv_rak', array( 'kode' => $id ) );
		return $query->row();
	}
	
	public function _data_barang( $id )
	{
		$query = $this->db->get_where( 'inv_barang', array( 'kodeitem' => $id ) );
		if($query){
		 return $query->row();
		} else {
		 return ""; 	
        }			
	}
	
	public function _data_akun( $id )
	{
		$query = $this->db->get_where( 'ms_akun', array( 'kodeakun' => $id ) );
		return $query->row();
	}
	
	public function _data_customer( $id )
	{
		$query = $this->db->get_where( 'ar_customer', array( 'kode' => $id ) );
		return $query->row();
	}
		
	function konversi ($x) {
	   $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
	   if ($x < 12)
	   return " " . $abil[$x] ;
	   elseif ($x < 20)
	     return $this->konversi($x - 10) . " belas";
	   elseif ($x < 100)
	     return $this->konversi($x / 10) . " puluh" . $this->konversi(fmod($x,10));
	   elseif ($x < 200)
	     return " seratus" . $this->konversi($x - 100);
	   elseif ($x < 1000)
	     return $this->konversi($x / 100) . " ratus" . $this->konversi(fmod($x,100));
	   elseif ($x < 2000)
	     return " seribu" . $this->konversi($x - 1000);
	   elseif ($x < 1000000)
	     return $this->konversi($x / 1000) . " ribu" . $this->konversi(fmod($x,1000));
	   elseif ($x < 1000000000)
	     return $this->konversi($x / 1000000) . " juta" . $this->konversi(fmod($x,1000000));
	   elseif ($x < 1000000000000)
	     return $this->konversi($x / 1000000000) . " milyar" . $this->konversi(fmod($x,1000000000));
	   elseif ($x < 1000000000000000)
	     return $this->konversi($x / 1000000000000) . " trilyun" . $this->konversi(fmod($x,1000000000000));
	}

	 function tkoma($x)
	 {

	   $x = stristr($x,'.');
	   if ($x>0)
	  {

	   $string = array("nol", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan",   "sembilan","sepuluh", "sebelas");
	   $temp = "";
	   $pjg  = strlen($x);
	   $pos = 1;

	   while ($pos<$pjg)
	   {
		 $char = substr($x, $pos, 1);
		 $pos++;
		 $temp .= " ".$string[$char];
	   }

	   return $temp;
	  } else
	  {
	   return "";
	  }
	 }

	 public function terbilang($x){
	  if($x<0){
	   $hasil = "minus ".trim($this->konversi(x));
	  }else{
	   $poin = trim($this->tkoma($x));
	   $hasil = trim($this->konversi($x));
	  }

	if($poin){
	   $hasil = $hasil." koma ".$poin;
	  }else{
	   $hasil = $hasil;
	  }
	  return '# '. $hasil.' Rupiah #';
	 }
     	 
	function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
    }
	
     function input_data($data,$table){
		$this->db->insert($table,$data);
	}
 
	function hapus_data($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}
    
	public function update_idjurnal()
	{			    
	    $this->db->query('update nomor_auto set nilai=nilai+1 where id=1');				
	}
	
	public function nomor_jurnal($unit, $jenis, $thn, $bln)
	{
		$q = $this->db->query("select nilai from nomor_auto where id=1");
		$kd = "";
		if($q->num_rows()>0)
		{
			foreach($q->result() as $k)
			{
				$tmp = ((int)$k->nilai)+1;
				$kd = sprintf("%06s", $tmp);
			}
		}
		else
		{
			$kd = "000001";
		}							
		return "$unit$jenis$thn$bln$kd";
	}
		
	function manualQuery($q)
	{
		return $this->db->query($q);
	} 
	
	function tgln()
	{
		$hari = date('d');
        $hari1= date('N');     
        $bulan= date('n');
		$tahun= date('Y');		
		$nbln = array('','Januari','Pebruari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
		$nhari= array('','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');
		return  $nhari[$hari1].", ".$hari." ".$nbln[$bulan]." ".$tahun." ";		
	}
	
	public function _counter1($kode)
	{		
		$query = $this->db->get_where( 'ms_counter1', array( 'kdtr' => $kode ) );
		$row = $query->row();
        return $row->cdno;
	}
	
	public function _updatecounter1($kode)
	{		
	    $this->db->where('kdtr', $kode);
        $this->db->set('cdno', 'cdno+ 1', FALSE);
		$this->db->update('ms_counter1');		
	}
	
	public function _Autonomor($kode)
	{		
	    $nourut= $this->_counter1($kode);
        $nomor = $kode.'.'.date('Y').'.'.date('m').'.'.str_pad( $nourut, 4, '0', STR_PAD_LEFT );	
		//$nomor = $kode.date('y').'-'.$nourut;
	    return $nomor;
	}
	
	function getcoa($str)
    {        
		if($str!=""){
          $query = $this->db->query("select kodeakun as id, concat(kodeakun,'-',namaakun) as text from ms_akun where tx='Y' and (namaakun like '%$str%' or kodeakun like '$str%')");
		} else {
		  $query = $this->db->query("select kodeakun as id, concat(kodeakun,'-',namaakun) as text from ms_akun where tx='Y'");	
		}
		
        return $query->result();
    }
	
	function getbarang($str)
    {   
        $query = '';	
		if($str!=""){
          $query = $this->db->query("select kodeitem as id, namabarang as text from inv_barang where namabarang like '%$str%'");
		}  else {
          $query = $this->db->query("select kodeitem as id, namabarang as text from inv_barang limit 5");			
		}
		
        return $query->result();
    }
	
    
}

?>