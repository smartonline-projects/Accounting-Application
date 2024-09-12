<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App extends CI_Controller {
    
	public function __construct()
	{
		parent::__construct();		
	}
	
	public function index()
	{
		$this->load->view('login/v_login_page');	      		
	}
	
	public function lock()
	{			    
		$this->load->view('app/v_login_lock');
	}
	
	function auth() {		
		$this->load->model( 'M_login' );
		$userid   = $this->input->post( 'username' );
		$password = $this->input->post( 'password' );
				
		if ( $userid && $password && $this->M_login->validate_user( $userid, $password ) ) {
							
				$loggedinuserid = $this->session->username;	
				
				if($this->M_global->_statusrubahharga()=='Y'){
				  $this->M_hargajualp->process_discp3();
				}
				
				if($this->M_global->_statusrubahhargam()=='Y'){
				  $this->M_hargajualm->process_sethargam();
				}
				
				redirect( base_url( 'dashboard/' ) );
			
		} else {						
			$this->session->set_flashdata( 'ntf1', 'Nama atau Password yang dimasukan salah, Silahkan coba lagi, hubungi administrator untuk mendaftarkan user dan password aplikasi' );
			$this->index();
		}
	}
			
	function logout() {
		$this->session->sess_destroy();
		$this->index();
	}
	
	
	function search()
    {
        $q = $this->input->post('searchTerm');
		echo json_encode($this->M_global->getcoa($q));
		
    }
	
	function search_barang()
    {
        $q = $this->input->post('searchTerm');
		echo json_encode($this->M_global->getbarang($q));
		
    }
	

}

