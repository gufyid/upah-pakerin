<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		if($this->session->userdata('login') == true)
		{
			redirect(base_url().'index.php/utama/');
	}else{
		$this->load->view('login');
	}
	}
	
	public function process_login()
	{
		
		
		$user = $this->input->post('username');
		$password = md5($this->input->post('password'));
			 
		if($this->login_model->check_user($user,$password) == TRUE)
		{
			$d = array(
				'kode' => $user, 
				);
			$dataku = $this->db->get_where('t_user',$d)->result_array();
			
			$data = array('user' => $user,
							'bagian' 	=> $dataku[0]['bagian'],
							'foto' 		=> $dataku[0]['tanda_tangan'],
							'pabrik' 	=> $dataku[0]['pabrik'],
							'login' 	=> TRUE,
							'tipe'  	=> $dataku[0]['tipe'],
						);
			$this->session->set_userdata($data);
			redirect(base_url().'index.php/utama/');
		}else{
			
			$this->session->set_flashdata('message',
			'Maaf, User dan atau Password Anda Salah!!!');
			redirect('login');
		}
		/*
		$data =$this->login_model->hello();
		echo $data;
		*/
	}
	
	public function process_logout()
	{
		$this->session->sess_destroy();
		redirect('login','refresh');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */