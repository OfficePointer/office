<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends CI_Controller {

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
	public function office_manual()
	{
		$limit = 5;
		$pg = 1;
		$start = 0;
		if($this->uri->segment(3)!=""){
			$pg = $this->uri->segment(3);
			if($pg<=0){
				$pg=1;
			}
			$start = ($pg-1)*$limit;
		}	
		$this->db->where('sys_delete_date',"");
		$this->db->limit($limit,$start);
		$this->db->order_by('sys_create_date','desc');
		$data['manual'] = $this->db->get('help')->result_array();
		$this->db->where('sys_delete_date',"");
		$count = $this->db->get('help');
		$count = $count->num_rows();
		$data['paging'] = $this->general->pagination($count,$limit,$pg,base_url("pengaturan/office_manual/%d"));
		$this->general->load('pengaturan/manual_office',$data);
	}
	public function user_manage()
	{
		$data['users'] = $this->db->get('data_user')->result_array();
		$this->general->load('pengaturan/user_manage',$data);
	}
	public function level_data()
	{
		$data['level'] = $this->db->get('level')->result_array();
		$this->general->load('pengaturan/level/all',$data);
	}
	public function division_data()
	{
		$data['division'] = $this->db->get('division')->result_array();
		$this->general->load('pengaturan/division/all',$data);
	}
	public function edit_profile()
	{
		$data['user'] = $this->db->where('id',$this->session->userdata('id'))->get('data_user')->row_array();
		$this->general->load('pengaturan/edit_profile',$data);
	}
	public function division_add()
	{
		$this->general->load('pengaturan/division/add');
	}
	public function division_save()
	{
		$data = $this->input->post();
		$this->db->insert('division',$data);
		redirect(base_url('pengaturan/division_data'));
	}
	public function division_edit($id)
	{
		$this->db->where('id',$id);
		$data['division'] = $this->db->get('division')->row_array();
		$this->general->load('pengaturan/division/edit',$data);
	}
	public function division_update()
	{
		$data = $this->input->post();
		$this->db->where('id',$data['id']);
		$this->db->update('division',$data);
		redirect(base_url('pengaturan/division_data'));
	}
	public function division_delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('division');
		redirect(base_url('pengaturan/division_data'));
	}
	public function level_add()
	{
		$data['division'] = $this->db->get('division')->result_array();
		$data['level'] = $this->db->get('level')->result_array();
		$this->general->load('pengaturan/level/add',$data);
	}
	public function level_save()
	{
		$data = $this->input->post();
		$this->db->insert('level',$data);
		redirect(base_url('pengaturan/level_data'));
	}
	public function level_edit($id)
	{
		$data['division'] = $this->db->get('division')->result_array();
		$data['level'] = $this->db->get('level')->result_array();
		$this->db->where('id',$id);
		$data['data'] = $this->db->get('level')->row_array();
		$this->general->load('pengaturan/level/edit',$data);
	}
	public function user_edit($id)
	{
		$data['division'] = $this->db->get('division')->result_array();
		$data['level'] = $this->db->get('level')->result_array();
		$this->db->where('id',$id);
		$data['data'] = $this->db->get('data_user')->row_array();
		$this->general->load('pengaturan/user_edit',$data);
	}
	public function level_update()
	{
		$data = $this->input->post();
		$this->db->where('id',$data['id']);
		$this->db->update('level',$data);
		redirect(base_url('pengaturan/level_data'));
	}
	public function user_update()
	{
		$data = $this->input->post();
		$this->db->where('ID',$data['ID']);
		$this->db->update('data_user',$data);
		redirect(base_url('pengaturan/user_manage'));
	}
	public function level_delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('level');
		redirect(base_url('pengaturan/level_data'));
	}
	public function save_profile()
	{
		$data = $this->input->post();
		
		if($_FILES['picture']['tmp_name']!=""){
        	$folder = $_FILES['picture']['tmp_name'];
        	mkdir("assets/images/".$this->session->userdata('id'));
        	$lokasi = "assets/images/".$this->session->userdata('id')."/".$_FILES['picture']['name'];
        	move_uploaded_file($folder, $lokasi);
        	$data['picture'] = base_url('assets/images/'.$this->session->userdata('id')."/".$_FILES['picture']['name']);
			$this->session->set_userdata('picture',$data['picture']);
    	}

		if($data['password']==""){
			unset($data['password']);
		}else{
			$data['password'] = md5($data['password']);
		}
		$this->session->set_userdata('nama',$data['name']);
		$data['update_at'] = date("Y-m-d H:i:s");
		$this->db->where('id',$this->session->userdata('id'));
		$this->db->update('data_user',$data);
		redirect(base_url());
	}
}
