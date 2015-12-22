<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Xhr_ajax extends CI_Controller {

   public function cek_deposit()
    {
        $this->db->order_by('airline','asc');
        $data = $this->db->get('cek_deposit');
        $data = $data->result_array();
        $baru = array();
        foreach ($data as $key) {
            $baru[] = array('code'=>$key['code'],
                            'airline'=>$key['airline'],
                            'saldo'=>'Rp. '.number_format($key['saldo'],2));
        }

        $all = array();

        $all['muncul'] = 0;
        if($this->session->userdata('saldosekarang')==0 and $this->session->userdata('saldo')!=sizeof($baru)){
            $this->session->set_userdata('saldosekarang',1);
            $all['muncul'] = 1;
        }
        if($this->session->userdata('saldo')!=sizeof($baru)){
            $this->session->set_userdata('saldo',sizeof($baru));
        }
        if($this->session->userdata('saldosekarang')==1){
            $this->session->set_userdata('saldosekarang',0);
        }

        $all['saldo'] = $baru;
        echo json_encode($all);
    }

    public function change_status()
    {
        $this->general->logging();
        $this->db->where('id',$this->session->userdata('id'));
        $this->db->update('data_user',array('status'=>$this->input->post('status')));
        echo $this->input->post('status');
    }
	public function issued_log_data()
	{
		$datax = $this->db->get('temp_issued_today');
		$datax = $datax->result_array();
		$hasil['data'] = $datax;
		$this->db->select('def_kode_error.nama,data_mitra.prefix,data_mitra.brand_name,data_all_error.*');
		$this->db->join('data_mitra','data_mitra.id_mitra=data_all_error.id_mitra','left');
		$this->db->join('def_kode_error','def_kode_error.kode_error=data_all_error.kasus','left');
		$this->db->where('updated_at',NULL);
		$dataz = $this->db->get('data_all_error');
		$dataz = $dataz->result_array();
		if($this->session->userdata('sekarang')==0 and $this->session->userdata('revert')!=sizeof($dataz)){
			$this->session->set_userdata('sekarang',1);
			$hasil['muncul'] = 1;
		}
		if($this->session->userdata('revert')!=sizeof($dataz)){
			$this->session->set_userdata('revert',sizeof($dataz));
		}
		if($this->session->userdata('sekarang')==1){
			$this->session->set_userdata('sekarang',0);
		}
		$hasil['revert'] = $dataz;
		$this->session->set_userdata('revert_data',sizeof($dataz));
		$datay = $this->db->get('temp_processing_issued');
		$datay = $datay->result_array();
		$hasil['process'] = $datay;
		echo json_encode($hasil);
	}
	public function ajax_get_activity($id_mitra)
	{
        $this->general->logging();
	?>
              <table class="table table-bordered table-striped" id="TBL_<?php echo $id_mitra;?>">
              <tr>
                <th style="width:10px;">TicketID</th>
                <th>Type</th>
                <th>Respon</th>
                <th>Note / Response / Reason</th>
                <th>PIC</th>
                <th>DateTime</th>
                <th class="last" style="width:20px;">Action</th>
              </tr>

              <?php

              $this->db->where('member_ID',$id_mitra);
              $this->db->where('delete_by',NULL);
              $this->db->where('delete_at',NULL);
              $this->db->order_by('create_at','desc');
              $aa = $this->db->get('data_activity');
              $aa = $aa->result_array();
              foreach ($aa as $koka) {
              ?>
              <tr id="detail_<?php echo $koka['ID'];?>">
                <td>#<?php echo $koka['ID'];?></td>
                <td><?php echo $koka['type'];?></td>
                <td><?php echo $this->general->get_respon($koka['id_respon']);?></td>
                <td style="max-width:300px;"><?php echo $koka['reason'];?></td>
                <td><?php echo $this->general->get_user($koka['create_by']);?></td>
                <td><?php echo $koka['create_at'];?></td>
                <td class="last"><a style="cursor:pointer" onclick="del_followup(<?php echo $koka['ID'];?>)"><i class="fa fa-times"></i></a></td>
              </tr>
              <?php
              }
              ?>
              </table>
              <?php
	}
	public function ajax_save_act()
	{
		$this->general->logging();
		$data = $this->input->post();
		$data['create_at'] = date("Y-m-d H:i:s");
		$data['create_by'] = $this->session->userdata('id');
		$this->db->insert('data_activity',$data);
		$id = $this->db->insert_id();
		$dat['create_at'] = $data['create_at'];
		$dat['ID'] = $id;
		$dat['PIC'] = $this->general->get_user($this->session->userdata('id'));
		print_r(json_encode($dat));
	}
	public function ajax_get_profiling()
	{
		$this->general->logging();
		$data = $this->input->post();
		$this->db->where('id_mitra',$data['id']);
		$dat['profiling'] = $this->db->get('data_mitra')->row_array();
		$dat['response'] = $this->db->get('data_respon')->result_array();
		print_r(json_encode($dat));
	}
	public function get_solve_note_option()
	{
        $this->general->logging();
		$this->db->order_by('id','asc');
		$a = $this->db->get('def_solve_note');
		$a = $a->result_array();
		foreach ($a as $key) {
			echo "<option value='".$key['isi']."'>".$key['isi']."</option>";
		}
	}

    public function get_user_assign()
    {
        $data = array();
        // $a = $this->db->get('division')->result_array();
        // foreach ($a as $key) {
        //     $data[] = array('id'=>$key['id'],'parentid'=>-1,'text'=>$key['name'],'value'=>'!'.$key['id'].'!');
        //     $x = $this->db->where('id_division',$key['id'])->get('level')->result_array();
        //     foreach ($x as $kay) {
        //         $data[] = array('id',$key['id'].$kay['id'],'parentid'=>$key['id'],'text'=>$kay['name'],'value'=>'@'.$kay['id'].'@');
        //         // $s = $this->db->where('id_division',$key['id'])->where('id_level',$kay['id'])->get('data_user')->result_array();
        //         // foreach ($s as $kuy) {
        //         //     $data[] = array('id'=>$key['id'].$kay['id'].$kuy['ID'],'parentid'=>$key['id'].$kay['id'],'text'=>$kuy['name'],'value'=>'|'.$kuy['ID'].'|');
        //         // }
        //     }
        // }
        $a = $this->db->get('level')->result_array();
        foreach ($a as $key) {
            $data[] = array('id'=>"DIVLEV".$key['id'].$key['id_division'].$key['id_division'].$key['id_division'],'parentid'=>($key['id_level']==0)?"DIV".$key['id_division'].$key['id_division'].$key['id_division']:("DIVLEV".$key['id_level'].$key['id_division'].$key['id_division'].$key['id_division']),'text'=>$key['name'],'value'=>'!'.$key['id'].'!');
        }
        $a = $this->db->get('division')->result_array();
        foreach ($a as $key) {
            $data[] = array('id'=>"DIV".$key['id'].$key['id'].$key['id'],'parentid'=>-1,'text'=>$key['name'],'value'=>'!'.$key['id'].'!');
        }
        $a = $this->db->where('id_level !=',0)->get('data_user')->result_array();
        foreach ($a as $key) {
            $data[] = array('id'=>$key['ID'],'parentid'=>"DIVLEV".$key['id_level'].$key['id_division'].$key['id_division'].$key['id_division'],'text'=>$key['name'],'value'=>'@'.$key['ID'].'@');
        }

        echo json_encode($data);
    }
 
    public function get_email_templates_json()
    {
        $data = $this->db->get('email_templates')->result_array();
        foreach ($data as $key) {
            echo "<option value='".$key['id']."'>".$key['judul']."</option>";
        }
    }

    public function solve_revert()
	{
        $this->general->logging();

		$data = $this->input->post();
		$this->db->where('id',$data['id']);
		$a = $this->db->get('data_all_error');
		$a = $a->row_array();
		if($a['updated_at']==NULL){
			$data['updated_at'] = date("Y-m-d H:i:s");
			$data['updated_by'] = $this->session->userdata('id');
			$this->db->where('id',$data['id']);
			$this->db->update('data_all_error',$data);
			echo "good";
		}else{
			echo "bad";
		}
	}


    public function send_email_solver_revert()
    {
        $data = $this->input->post();
        $this->db->where('id',$data['id']);
        $a = $this->db->get('data_all_error')->row_array();
        $this->db->where('id',$data['template']);
        $temp = $this->db->get('email_templates')->row_array();

        $kode_booking = $a['kode_booking'];
        $kasus = $a['kasus'];
        $template = $temp['template'];
        $subject = $temp['judul'];
        $tujuan = $temp['id_user'];

        $template = str_replace("{{kode_booking}}", $kode_booking, $template);
        $template = str_replace("{{name}}", $this->session->userdata('nama'), $template);

        $subject = str_replace("{{kode_booking}}", $kode_booking, $subject);

        $to = explode(",", $tujuan);
        $em = array();
        foreach ($to as $key) {
            $em[] = $this->general->get_email($key);
        }
        $em[] = $this->session->userdata('email');

        $this->general->kirim_email_solver_revert($em,$subject,$template);
        echo "sent";

    }
}
