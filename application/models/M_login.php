<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_login extends CI_Model {

	var $tabel_user="userlogin";
	var $details;
	
	
	function __construct()
	{
	
	parent::__construct();
	}

	function validate_user( $uid, $password ) {
		$this->db->from( 'userlogin' );
		$this->db->where( 'uidlogin', $uid );
		$this->db->where( 'pwdlogin', md5( $password ) );
		$login = $this->db->get()->result();

		if ( is_array( $login ) && count( $login ) == 1 ) {
			$this->details = $login[ 0 ];
			$this->set_session();
			return true;
		}
		return false;
	}
	
    function set_session() {
		$this->session->set_userdata( array(
		    'username'=>$this->details->uidlogin,
			'is_logged_in'=> true,
			'nama_lengkap'=>$this->details->username,
			'photo'=>$this->details->avatar,
			'level'=>$this->details->level,
			'unit'=>$this->details->cabang,
			'menuapp'=>'',
			'submenuapp'=>'',						
							
		) );
	}


}
?>