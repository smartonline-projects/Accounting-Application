<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_dashboard extends CI_Model {

	
	function months() {
	return array('Jan','Peb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nop','Des');
			
    }

	
	function jcustomer()
	{
		$this->db->from( 'ar_customer' );		
		$query = $this->db->get();
		return $query->num_rows();		
	}
	
	function dsaset()
	{
	   return $this->db->query('select sum(hargabeli*stok) as total from inv_barang')->row()->total;
	}
	
	function dshutang()
	{
	   return $this->db->query('select sum((totalpu-jumlahbayar)*kurs) as total from ap_pufile where year(tglpu) = (select periode_tahun from ms_identity)')->row()->total;
	}
	
	function dspiutang()
	{
	   return $this->db->query('select sum((totalsi-jumlahbayar)*kurs) as total from ar_sifile where pembayaran="K" and year(tglsi) = (select periode_tahun from ms_identity)')->row()->total;
	}
	
	function report(){
		
		$q ="
		    select 'Jan' as bulan, sum(totalsi) as jumlah from ar_sifile where year(tglsi) = (select periode_tahun from ms_identity) and month(tglsi)=1
			union
			select 'Peb' as bulan, sum(totalsi) as jumlah from ar_sifile where year(tglsi) = (select periode_tahun from ms_identity) and month(tglsi)=2
			union
			select 'Mar' as bulan, sum(totalsi) as jumlah from ar_sifile where year(tglsi) = (select periode_tahun from ms_identity) and month(tglsi)=3
			union
			select 'Apr' as bulan, sum(totalsi) as jumlah from ar_sifile where year(tglsi) = (select periode_tahun from ms_identity) and month(tglsi)=4
			union
			select 'Mei' as bulan, sum(totalsi) as jumlah from ar_sifile where year(tglsi) = (select periode_tahun from ms_identity) and month(tglsi)=5
			union
			select 'Jun' as bulan, sum(totalsi) as jumlah from ar_sifile where year(tglsi) = (select periode_tahun from ms_identity) and month(tglsi)=6
			union
			select 'Jul' as bulan, sum(totalsi) as jumlah from ar_sifile where year(tglsi) = (select periode_tahun from ms_identity) and month(tglsi)=7
			union
			select 'Agu' as bulan, sum(totalsi) as jumlah from ar_sifile where year(tglsi) = (select periode_tahun from ms_identity) and month(tglsi)=8
			union
			select 'Sep' as bulan, sum(totalsi) as jumlah from ar_sifile where year(tglsi) = (select periode_tahun from ms_identity) and month(tglsi)=9
			union
			select 'Okt' as bulan, sum(totalsi) as jumlah from ar_sifile where year(tglsi) = (select periode_tahun from ms_identity) and month(tglsi)=10
			union
			select 'Nop' as bulan, sum(totalsi) as jumlah from ar_sifile where year(tglsi) = (select periode_tahun from ms_identity) and month(tglsi)=11
			union
			select 'Des' as bulan, sum(totalsi) as jumlah from ar_sifile where year(tglsi) = (select periode_tahun from ms_identity) and month(tglsi)=12";

			
			  
        $query = $this->db->query($q);
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
		
		
    }

    

}
?>