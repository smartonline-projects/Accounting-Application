<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_keuangan_masuk extends CI_Model {
    
    
	
	public function __construct()
	{
		parent::__construct();	
		
	}
		
	public function update_saldo($tahun,$bulan,$bank,$saldo)
	{	        
		$q   = $this->db->query("select * from ms_banksaldo where tahun = '$tahun' and bulan='$bulan' and bank_kode = '$bank'");				
		if($q->num_rows()==0)
		{
		  return $this->db->query("insert into ms_banksaldo(tahun, bulan, bank_kode, saldo_awal) values('$tahun','$bulan','$bank','$saldo')");		  
		} 
		else
		{	        
		  return $this->db->query("update ms_banksaldo set saldo_awal='$saldo' where tahun = '$tahun' and bulan='$bulan' and bank_kode = '$bank'");	    
		} 	
     
	}
	
	public function nomor_register($jn)
	{
     
     if($jn==1)
     {
         $query = "select nilai from nomor_auto where id=2";
         $hasil = $this->db->query($query)->result();
		 foreach($hasil as $row){
		 $no = $row->nilai;	 
		 } 
     } else
     {
         $query = "select nilai from nomor_auto where id=6";
         $hasil = $this->db->query($query)->result();
		 foreach($hasil as $row){
		 $no = $row->nilai;	 
		 } 
        
     }
	 	
     return $no;	
    }
	
	public function update()
	{			
       $this->M_global->_updatecounter1('KM');			
	}
	
	function input_data($data,$table){
		$this->db->insert($table,$data);
	}
 
	function hapus_data($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}
	
	function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}	
	
	public function hapus_penerimaan($no)
	{			    
	    $this->db->where('terima_nomor', $no);
		$this->db->delete('tr_penerimaan');
		$this->db->where('terimad_nomor', $no);
        $this->db->delete('tr_penerimaand');		
	}


}
