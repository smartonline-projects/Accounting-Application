<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_akuntansi_ju extends CI_Model {

   
	var $table = 'tr_jurnal';
	var $column_order = array('novoucher', 'noref','tanggal','keterangan','debet','kredit','jenis',null); 
	var $column_search = array('novoucher', 'noref','tanggal','keterangan','debet','kredit','jenis'); 
	var $order = array('novoucher' => 'asc'); 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		
	}

	private function _get_datatables_query($jns, $bulan, $tahun )
	{   
	    
		if($jns==1){
			$this->db->select('tr_jurnal.*')->from('tr_jurnal');
			$this->db->where(array('year(tanggal)' => $tahun,'month(tanggal)' => $bulan));
			$this->db->order_by('tanggal, novoucher, nourut');
		} else {
		    $this->db->select('tr_jurnal.*')->from('tr_jurnal');
			$this->db->where(array('tanggal >=' => $bulan,'tanggal<= ' => $tahun));
			$this->db->order_by('tanggal, novoucher, nourut');
			
			
		}
		
		
		$i = 0;
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					
					//$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

			
					
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	
	
	function get_datatables( $jns,  $bulan, $tahun )
	{
		
		$this->_get_datatables_query($jns, $bulan, $tahun );
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);	
		$query = $this->db->get();
		return $query->result();
	}
	
	function count_filtered( $jns, $bulan, $tahun )
	{
		$this->_get_datatables_query( $jns, $bulan, $tahun );
		$query = $this->db->get();
		return $query->num_rows();
	}
	

	function count_filtered_entry( $nomor )
	{
		$this->db->select('tr_jurnal.*')->from('tr_jurnal');
		$this->db->where(array('novoucher >=' => $nomor));
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all( $jns, $bulan, $tahun )
	{
		if($jns==1){
			$this->db->select('tr_jurnal.*')->from('tr_jurnal');
			$this->db->where(array('year(tanggal)' => $tahun,'month(tanggal)' => $bulan));
		} else {
		    $this->db->select('tr_jurnal.*')->from('tr_jurnal');
			$this->db->where(array('tanggal >=' => $bulan,'tanggal<= ' => $tahun));
			
		}
		
		return $this->db->count_all_results();
	}
	
	public function count_all_entry( $nomor )
	{
		$this->db->select('tr_jurnal.*')->from('tr_jurnal');
		$this->db->where(array('novoucher >=' => $nomor));
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('nomor', $id);
		$this->db->delete($this->table);
	}


}

