<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

function __construct()
	{
		parent::__construct();
	}
var $table = 't_user';

function check_user($user,$password)
{
	$query = $this->db->get_where($this->table,
			array('kode' => $user,
				  'password_user' => $password),1,0
				 );
			
				if($query->num_rows() > 0)
				 {
					 return TRUE;
				 }else{
					 return FALSE;
				
				 }
								 
}

function get_perusahaan()
{
	$uid = $this->session->userdata('user');
	$data = $this->db->get_where('user', array('usr_uname' => $uid));
	return $data->result_array();
}
	
}
