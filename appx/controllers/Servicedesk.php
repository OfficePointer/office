<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicedesk extends CI_Controller {

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
	public function infosys()
	{
		$data['info'] = $this->db->get('infosys')->result_array();
		$this->general->load('servicedesk/infosys/all',$data);
	}
	public function infosys_add()
	{
		$this->general->load('servicedesk/infosys/add');
	}
	public function infosys_save()
	{
        $this->general->logging();
		$data = $this->input->post();
		$data['id_user'] = $this->session->userdata('id');
		$this->db->insert('infosys',$data);
		redirect(base_url('servicedesk/infosys'));
	}
	public function infosys_delete($id)
	{
        $this->general->logging();
		$this->db->where('id',$id);
		$this->db->delete('infosys');
		redirect(base_url('servicedesk/infosys'));
	}
	public function flowsys()
	{
		$data['flow'] = $this->db->get('flowsys')->result_array();
		$this->general->load('servicedesk/flowsys/all',$data);
	}
	public function flowsys_add()
	{
		$data['info'] = $this->db->get('infosys')->result_array();
		$this->general->load('servicedesk/flowsys/add',$data);
	}
	public function flowsys_save()
	{
        $this->general->logging();
		$data = $this->input->post();
		$data['assign_user'] = $this->general->parse_user($data['assign_user']);
		$data['id_user'] = $this->session->userdata('id');
		$data['created_at'] = date("Y-m-d H:i:s");
		$data['updated_at'] = date("Y-m-d H:i:s");
		$this->db->insert('flowsys',$data);
		redirect(base_url('servicedesk/flowsys'));
	}
	public function flowsys_edit($id){
		$data = array();
		$data['info'] = $this->db->get('infosys')->result_array();
		$data['flow'] = $this->db->where('id',$id)->get('flowsys')->row_array();
		$this->general->load('servicedesk/flowsys/edit',$data);
	}

	public function flowsys_update()
	{
        $this->general->logging();
		$data = $this->input->post();
		$data['assign_user'] = $this->general->parse_user($data['assign_user']);
		$data['id_user'] = $this->session->userdata('id');
		$data['created_at'] = date("Y-m-d H:i:s");
		$data['updated_at'] = date("Y-m-d H:i:s");
		$this->db->where('id',$data['id']);
		$this->db->update('flowsys',$data);
		redirect(base_url('servicedesk/flowsys'));
	}
	public function flowsys_delete($id)
	{
        $this->general->logging();
		$this->db->where('id',$id);
		$this->db->delete('flowsys');
		redirect(base_url('servicedesk/flowsys'));
	}
}
