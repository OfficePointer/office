<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('Utility/Login');
	}
	public function ceklogin()
	{
        $this->general->logging();
		$this->db->where('email',$this->input->post('email'));
		$this->db->where('password',md5($this->input->post('password')));
		$a = $this->db->get('data_user')->row_array();
		if(!empty($a)){
			$this->session->set_userdata('id',$a['ID']);
			$this->session->set_userdata('nama',$a['name']);
			$this->session->set_userdata('divisi',$a['division']);
			$this->session->set_userdata('group',$a['grup']);
			$this->session->set_userdata('picture',$a['picture']);
			$this->session->set_userdata('email',$a['email']);
			redirect(base_url());
		}else{
			redirect(base_url());
		}
	}
	public function logout()
	{
        $this->general->logging();
		$this->session->set_userdata('id',0);
		$this->session->set_userdata('nama',0);
		$this->session->set_userdata('divisi',0);
		$this->session->set_userdata('group',0);
		$this->session->set_userdata('picture',0);
		$this->session->set_userdata('email',0);
		redirect(base_url());
	}
}
