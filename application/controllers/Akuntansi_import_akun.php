<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Akuntansi_import_akun extends CI_Controller {

	/**
	 * @author : Enjang RK
	 * @web : http://e-soft.comli.com
	 * @keterangan : Controller untuk modul import COA dari file csv
	 **/
	
	
	
	
	public function __construct()
	{
		parent::__construct();			
		$this->session->set_userdata('menuapp', '200');
		$this->session->set_userdata('submenuapp', '239');	
		
	}

	public function index()
	{
		$cek = $this->session->userdata('level');	
		$usr = $this->session->userdata('username');		
		if(!empty($cek))
		{		
			
			$this->load->view('akuntansi/v_import');
		} else
		{
			header('location:'.base_url());
		}			
	}
	
	
		
	public function import_akun_csv() {
		       $kateg=$this->input->post('kateg');
                //extract($this->xss_html_filter(array_merge($this->data)));
                $filename = $_FILES["file"]["name"];
                
                if($_FILES['file']['size'] > 0)
                {   
                    
                    $config['upload_path']          = './uploads/csv/akun';
                    $config['allowed_types']        = 'csv';
                    $this->load->library('upload', $config);

                    if ( ! $this->upload->do_upload('file')){
                            $error = array('error' => $this->upload->display_errors());
                            print($error['error']);
                            exit();
                    }
                    else{
                            $file_name=$this->upload->data('file_name');
                    }
                    
                  
                    $this->db->delete('ms_akun_import',array(''));
                    $file = fopen('uploads/csv/akun/'.$file_name,"r");
                    
                    //Save flag
                    $flag='true';
                    $this->db->trans_begin();
                    $i=1;
                    while(($importdata = fgetcsv($file, NULL, ",")) !== FALSE){

					    /*
						  0=kode
						  1=nama
						  
						*/
						
                        $data = array(
							'kode' => $importdata[0],
							'nama' => $importdata[1],
							
						);
						
                        if(!empty($importdata[0])){						
						$this->db->insert('ms_akun_import', $data);	
						}
				
				        
						$v_akun = $this->db->get_where('ms_akun', array('kodeakun' => $importdata[0]))->row();
					  
					    if($v_akun){
							$id_akun = $v_akun->kodeakun;
							
							$data_akun = array(
						     'namaakun' => $importdata[1],
						   
						   );
						   $this->db->update('ms_akun', $data_akun, array('kodeakun' => $id_akun));
					  
					  
						} else {
							$row = array(
						       'kodeakun'   => $importdata[0], 
                               'namaakun' => $importdata[1],
							   );
							   
							  if(!empty($importdata[0])){
						
								if(!$this->db->insert('ms_akun',$row)){
									$flag='false';
								}
								
								  
							  
								}  
							   
                        
						}
					  
					     
                        
                        
                        
                      
                        
                        //Compulsary records
                        if(empty($importdata[0])){
                          $flag='false';   
                        }


                        
                    }
                    
                    
                    if(!$flag){
                        $this->db->trans_rollback();
                        $qstring = '?status=err';
                    }else{
                        $this->db->trans_commit();
                      
						$qstring = '?status=succ';
                    }
                    fclose($file);
                }
            
            //unlink('uploads/csv/suppliers/'.$file_name);
			header('location:'.base_url().'akuntansi_import_akun/'.$qstring);
        }	
	
	
	
	
}

