<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		if(isset($_GET['q'])){
            $this->db->group_start();
            $this->db->like('isi',$_GET['q'],'both');
            $this->db->or_like('judul',$_GET['q'],'both');
            $this->db->group_end();
		}
		$this->db->where('sys_delete_date',"");
		$this->db->limit($limit,$start);
		$this->db->order_by('sys_create_date','desc');
		$koran = $this->db->get('posts');
		if(isset($_GET['q'])){
            $this->db->group_start();
            $this->db->like('isi',$_GET['q'],'both');
            $this->db->or_like('judul',$_GET['q'],'both');
            $this->db->group_end();
		}
		$this->db->where('sys_delete_date',"");
		$count = $this->db->get('posts');
		$count = $count->num_rows();
		$data['koran'] = $koran->result_array();
		$data['paging'] = $this->general->pagination($count,$limit,$pg,base_url("welcome/index/%d"));
		$this->general->load('operational/koran_helpdesk',$data);
	}
}
