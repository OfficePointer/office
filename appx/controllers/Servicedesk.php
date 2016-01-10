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
	public function all_tasks($new = '')
	{
        if($new=="clear"){
            $this->session->set_userdata('date_tasks','');
        }

		if($this->input->post('date_tasks')!=""){
            $daten = explode(" - ",$this->input->post('date_tasks'));
            $this->session->set_userdata('all_tasks_date_start',$daten[0]);
            $this->session->set_userdata('all_tasks_date_end',$daten[1]);
        }else{
            $this->session->set_userdata('all_tasks_date_start','');
            $this->session->set_userdata('all_tasks_date_end','');
        }

		// $data['all_tasks'] = $this->db->query('select 
		// 		id_ticket, trx_info, vendor.nama,a.`name` as pengirim, 
		// 		b.`name` as penerima, info, act_budget as jumlah, created_at,`comment`,
		// 		actionsys.`status` 
		// 		from actionsys 
		// 		left join vendor on vendor.id=actionsys.vendor 
		// 		left join data_user a on a.id=actionsys.id_user 
		// 		left join data_user b on b.id=actionsys.id_assign
		// 		')->result_array();

		$this->db->select('id_ticket, trx_info, vendor.nama,a.`name` as pengirim, 
				b.`name` as penerima, info, act_budget as jumlah, created_at,`comment`,
				actionsys.`status`');
		if($this->session->userdata('all_tasks_date_start')!=""){
            $this->db->where('DATE_FORMAT(actionsys.created_at,"%Y-%m-%d") >=',date_format(date_create($this->session->userdata('all_tasks_date_start')),"Y-m-d"));
        }
        if($this->session->userdata('all_tasks_date_end')!=""){
            $this->db->where('DATE_FORMAT(actionsys.created_at,"%Y-%m-%d") <=',date_format(date_create($this->session->userdata('all_tasks_date_end')),"Y-m-d"));
        }
		$this->db->join('vendor','vendor.id=actionsys.vendor','left');
		$this->db->join('data_user a','a.id=actionsys.id_user','left');
		$this->db->join('data_user b','b.id=actionsys.id_assign','left');
		$data['all_tasks'] = $this->db->get('actionsys')->result_array();
		//echo "<pre>".print_r($data,1)."<pre>";
		$this->general->load('servicedesk/all_tasks/data_tasks',$data);

	}
	    public function expr_all_tasks()
    {
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename=export_all_error_'.date_format(date_create($this->session->userdata('all_error_date_start')),"Y-m-d").'_'.date_format(date_create($this->session->userdata('all_error_date_end')),"Y-m-d").'_by_'.$this->session->userdata('email').'.xls');
                    
		$this->db->select('id_ticket, trx_info, vendor.nama,a.`name` as pengirim, 
				b.`name` as penerima, info, act_budget as jumlah, created_at,`comment`,
				actionsys.`status`');
		if($this->session->userdata('all_tasks_date_start')!=""){
            $this->db->where('DATE_FORMAT(actionsys.created_at,"%Y-%m-%d") >=',date_format(date_create($this->session->userdata('all_tasks_date_start')),"Y-m-d"));
        }
        if($this->session->userdata('all_tasks_date_end')!=""){
            $this->db->where('DATE_FORMAT(actionsys.created_at,"%Y-%m-%d") <=',date_format(date_create($this->session->userdata('all_tasks_date_end')),"Y-m-d"));
        }
		$this->db->join('vendor','vendor.id=actionsys.vendor','left');
		$this->db->join('data_user a','a.id=actionsys.id_user','left');
		$this->db->join('data_user b','b.id=actionsys.id_assign','left');
		$all_tasks = $this->db->get('actionsys')->result_array();
		?>
      <table>
        <thead>
          <tr>
            <th>IDTicket</th>
            <th>TrxInfo</th>
            <th>Info</th>
            <th>Pengirim</th>
            <th>Penerima</th>
            <th>Date Start</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($all_tasks as $key){ ?>
          <tr>
            <td><?php echo $key['id_ticket'];?></td>
            <td><?php echo $key['trx_info'];?></td>
            <td><?php echo $key['info'];?></td>
            <td><?php echo $key['pengirim'];?></td>
            <td><?php echo $key['penerima'];?></td>
            <td><?php echo $key['created_at'];?></td>
            <td><?php echo ($key['status']==0)?"Open":(($key['status']==1)?"Hold":(($key['status']==2)?"Done":""));?></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>

        <?php

    }
}
