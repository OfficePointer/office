<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Xhr_ajax extends CI_Controller {


    public function ajax_get_mitra()
    {
        $term = $this->input->post('term');
        $this->db->select("id_mitra as id, concat(brand_name,' (',prefix,')') as value, prefix");
        $this->db->group_start();
        $this->db->like("concat(brand_name,' (',prefix,')')",$term,'both');
        $this->db->group_end();
        $this->db->where('status','active');
        $this->db->limit(7);
        $a = $this->db->get('data_mitra')->result_array();
        echo json_encode($a);
    }
    public function update_action_done()
    {
        $id = $this->input->post('id');

        $this->db->where('id',$id);
        $dat = $this->db->get('actionsys')->row_array();

        $data['comment'] = $dat['comment']."\r\nDone by Human (".date("Y-m-d H:i:s").") ".$this->session->userdata('nama');
        $data['done_at'] = date("Y-m-d H:i:s");
        $data['status'] = 2;
        $this->db->where('id',$id);
        $this->db->update('actionsys',$data);


        echo "OK";
    }
    public function update_issued_manual_done()
    {
        $id = $this->input->post('id');

        $this->db->where('id',$id);
        $dat = $this->db->get('actionsys')->row_array();

        $data['comment'] = $dat['comment']."\r\nDone by Human (".date("Y-m-d H:i:s").") ".$this->session->userdata('nama');
        $data['done_at'] = date("Y-m-d H:i:s");
        $data['nota_airline'] = $this->input->post('nota_airlines');
        $data['nota_member'] = $this->input->post('nota_member');
        $data['status'] = 2;
        $this->db->where('id',$id);
        $this->db->update('actionsys',$data);


        echo "OK";
    }
    public function update_rebook_done()
    {
        $data = $this->input->post();

        $this->db->where('id',$data['id']);
        $dat = $this->db->get('actionsys')->row_array();

        if($data['rebook_status']==2){
            $data['comment'] = $dat['comment']."\r\nDone by Human (".date("Y-m-d H:i:s").") ".$this->session->userdata('nama');
            $data['done_at'] = date("Y-m-d H:i:s");
            $data['status'] = 2;
            $data['rebook_status'] = 2;
            $data['assign_view'] = 1;
            $data['rebook_process'] = date("Y-m-d H:i:s");
        }
        if($data['rebook_status']==1 or $data['rebook_status']==0){
            $data['comment'] = $dat['comment']."\r\nUpdate by Human (".date("Y-m-d H:i:s").") ".$this->session->userdata('nama');
            $data['done_at'] = NULL;
            $data['status'] = $data['rebook_status'];
            $data['assign_view'] = $data['rebook_status'];
            if($data['rebook_status']==0){
                $data['id_assign'] = 0;
                $data['rebook_process'] = NULL;
            }else{
                $data['rebook_process'] = date("Y-m-d H:i:s");
            }
        }
        $data['act_budget'] = $this->input->post('act_budget');
        $this->db->where('id',$data['id']);
        $this->db->update('actionsys',$data);


        echo "OK";
    }
    public function lookup_code()
    {
        $value = $this->input->post('code');
        $dbs = $this->load->database('dbpointer',TRUE);
        $dbs->where('kode_booking',$value);
        $data['ar_booking'] = $dbs->get('ar_booking')->row_array();
        if($data['ar_booking']!=null){
            $dbs->select('mitra.prefix,company.brand_name');
            $dbs->join('company','company.id_mitra=mitra.id_mitra','left');
            $dbs->where('mitra.id_mitra',$data['ar_booking']['id_mitra']);
            $data['mitra'] = $dbs->get('mitra')->row_array();
            $dbs->where('id_booking',$data['ar_booking']['id']);
            $data['ar_booking_pnr'] = $dbs->get('ar_booking_pnr')->result_array();
            $data['json_data'] = json_encode($data);
        }
        echo (json_encode($data));

    }
    public function update_action_open()
    {
        $id = $this->input->post('id');

        $this->db->where('id',$id);
        $dat = $this->db->get('actionsys')->row_array();

        $data['comment'] = $dat['comment']."\r\nOpen by Human (".date("Y-m-d H:i:s").") ".$this->session->userdata('nama');

        $data['status'] = 0;
        $data['assign_view'] = 0;
        $data['id_assign'] = 0;
        $this->db->where('id',$id);
        $this->db->update('actionsys',$data);
        echo "OK";
    }
    public function ajax_get_actionsys_data($id)
    {
        $this->db->where('id',$id);
        $data = $this->db->get('actionsys');
        $data['act_budget'] = "Rp. ".number_format($data['act_budget']);
        echo json_encode($data);
    }

    public function ajax_get_actionsys_data_open()
    {
        $id = $this->input->post('id');
        $this->db->where('id',$id);
        $data = $this->db->get('actionsys')->row_array();
        $data['brand_name'] = $this->general->get_member($data['id_mitra'],1);
        $data['airline'] = $this->general->get_vendor($data['vendor']);
        if($data['status']==0){
            $data['act_budget'] = "Rp. ".number_format($data['act_budget']);
            $dat['status'] = "OPEN";
            $dat['data'] = $data;

            $upt['comment'] = $data['comment']."\r\nHold by Human (".date("Y-m-d H:i:s").") ".$this->session->userdata('nama');

            if($data['id_assign']==0 or $data['id_assign']==$this->session->userdata('id')){
                $upt['id_assign'] = $this->session->userdata('id');
            }else{
                $upt['id_user'] = $this->session->userdata('id');
            }
            $upt['assign_view'] = 1;
            $upt['status'] = 1;
            $this->db->where('id',$id);
            $this->db->update('actionsys',$upt);
            echo json_encode($dat);
        }elseif($data['status']==1){
            $data['act_budget'] = "Rp. ".number_format($data['act_budget']);
            $dat['status'] = "VIEW";
            $dat['data'] = $data;
            $dat['by'] = $this->general->get_user($data['id_assign']);
            echo json_encode($dat);
        }elseif($data['status']==2){
            $dat['status'] = "FINISH";
            $dat['data'] = $data;
            $dat['by'] = $this->general->get_user($data['id_assign']);
            echo json_encode($dat);
        }
    }

    public function ajax_get_pending_action()
    {
        $data = array();
        $this->db->select('actionsys.*,flowsys.assign_user');
        $this->db->join('flowsys','flowsys.id=actionsys.id_flowsys','left');
        // $this->db->group_start();
        // $this->db->like('flowsys.assign_user',','.$this->session->userdata('id').',','both');
        // $this->db->or_like('flowsys.assign_user',$this->session->userdata('id').',','after');
        // $this->db->or_like('flowsys.assign_user',','.$this->session->userdata('id'),'before');
        // $this->db->or_like('actionsys.id_user',$this->session->userdata('id'));
        // $this->db->or_like('actionsys.id_assign',$this->session->userdata('id'));
        // $this->db->group_end();
        $this->db->where_in('status',array(0,1));
        $data['action'] = $this->db->get('actionsys')->result_array();

        $d = array();
        foreach ($data['action'] as $key) {
            $assign_user = explode(",", $key['assign_user']);
            if($key['id_assign']==0 and in_array($this->session->userdata('id'), $assign_user)
                or $key['id_assign']==$this->session->userdata('id') and $key['assign_view']==0 and $key['status'] == 0
                or $key['id_assign']==$this->session->userdata('id') and $key['assign_view']==1 and $key['status'] == 1
                or $key['id_user']==$this->session->userdata('id') and $key['user_view']==0 and $key['status']==0
                or $key['id_user']==$this->session->userdata('id') and $key['user_view']==1 and $key['status']==1
                ){
                $d[] = $key;
            }
        }

        $data['action'] = $d;
        //echo $this->db->last_query();
        $jumlah = sizeof($data['action']);
        $data['muncul'] = 0;
        if($this->session->userdata('pending')<$jumlah){
            $this->session->set_userdata('pending',$jumlah);
            $data['muncul'] = 1;
        }
        $this->session->set_userdata('pending',$jumlah);
        echo json_encode($data);
    }

    public function ajax_actionsys_save()
    {
        $data = $this->input->post();
        $data['created_at'] = date("Y-m-d H:i:s");
        $data['id_ticket'] = uniqid();
        $data['comment'] = "Created by Human (".date("Y-m-d H:i:s").") ".$this->session->userdata('nama');
        if(empty($data['tgl_info'])){
            $data['tgl_info'] = date("Y-m-d H:i:s");
        }
        $data['id_user'] = $this->session->userdata('id');
        $this->db->insert('actionsys',$data);
        if($this->db->insert_id()!=""){
            echo json_encode(array('status'=>'OK','msg'=>'Request Saved!'));
        }else{
            echo json_encode(array('status'=>'ER','msg'=>'Request failed to save'));
        }
    }
//------------------------------------------------------------------------------

  public function ajax_get_klasifikasi(){
    $this->general->logging();
		$data = $this->input->post();
		$this->db->where('id_mitra',$data['id']);
		$datklas['getMemberKlas'] = $this->db->get('data_mitra')->row_array();
		$datklas['getKlasifikasi'] = $this->db->get('data_klasifikasi')->result_array();
		print_r(json_encode($datklas));
  }

//------------------------------------------------------------------------------

public function ajax_save_klasifikasi()
{
  $this->general->logging();
  $data = $this->input->post();
  $data['tgl_update'] = date("Y-m-d H:i:s");
  $data['created_by'] = $this->session->userdata('id');
  $this->db->insert('klasifikasi_member',$data);
  print_r(json_encode($data));
}

//------------------------------------------------------------------------------

   public function cek_deposit()
    {
        $jumlah_muncul = $this->session->userdata('saldo');
        $muncul = 0;
        $this->db->select('cek_deposit.*,vendor.nama,vendor.min_first,vendor.min_second,vendor.min_third');
        $this->db->join('vendor','vendor.id=cek_deposit.id','left');
        $this->db->order_by('airline','asc');
        $data = $this->db->get('cek_deposit');
        $data = $data->result_array();
        $baru = array();
        foreach ($data as $key) {
            $muncul = 0;
            if($key['saldo']>0 or $key['saldo']<0){
                if($key['saldo']<$key['min_first']){
                    $muncul = 1;
                }
                if($key['saldo']<$key['min_second']){
                    $muncul = 2;
                }
                if($key['saldo']<$key['min_third']){
                    $muncul = 3;
                }
            }

            if($muncul>0 and $muncul != $jumlah_muncul){
                $jumlah_muncul = $muncul;
            }

            $baru[] = array('code'=>$key['code'],
                            'airline'=>$key['airline'],
                            'id'=>$key['id'],
                            'saldo'=>'Rp. '.number_format($key['saldo'],2),
                            'muncul'=>$muncul);
        }


        $all = array();

        $all['muncul'] = 0;
        if($this->session->userdata('saldo')<$jumlah_muncul){
            $this->session->set_userdata('saldo',$jumlah_muncul);
            $all['muncul'] = 1;
        }
        $this->session->set_userdata('saldo',$jumlah_muncul);
        $all['saldo'] = $baru;
        echo json_encode($all);
    }
//------------------------------------------------------------------------------

   public function cron_cek_deposit()
    {
        $this->db->select('cek_deposit.*,vendor.nama,vendor.min_first,vendor.min_second,vendor.min_third');
        $this->db->join('vendor','vendor.id=cek_deposit.id','left');
        $this->db->order_by('airline','asc');
        $data = $this->db->get('cek_deposit');
        $data = $data->result_array();
        $baru = array();
        foreach ($data as $key) {
            $muncul = 0;
            if($key['saldo']<$key['min_first']){
                $muncul = 1;
            }
            if($key['saldo']<$key['min_second']){
                $muncul = 2;
            }
            if($key['saldo']<$key['min_third']){
                $muncul = 3;
            }

            if($muncul>0){


                $this->db->where_in('actionsys.id_flowsys',array(7,8,9));
                $this->db->where('actionsys.vendor',$key['id']);
                $this->db->where('actionsys.status','0');
                $cek = $this->db->get('actionsys')->result_array();
                if(sizeof($cek)==0){
                    $input = array();
                    $input['id_user'] = 0;
                    $input['id_flowsys'] = 7;
                    $input['info'] = "Alert 1 Top Up Saldo Vendor ".$key['nama'];
                    $input['user_view'] = 0;
                    $input['assign_view'] = 0;
                    $input['comment'] = $this->general->comment_msg("System");
                    $input['status'] = 0;
                    $input['vendor'] = $key['id'];
                    $input['created_at'] = date("Y-m-d H:i:s");
                    $input['id_ticket'] = "#".uniqid();
                    $this->db->insert('actionsys',$input);
                    $log['id_user'] = 0;
                    $log['info'] = "Create alert 1 top up saldo vendor ".$key['nama'];
                    $log['created_at'] = date("Y-m-d H:i:s");
                    $this->db->insert('actionsyslog',$log);
                }else{
                    if($muncul==2){

                        $this->db->where_in('actionsys.id_flowsys',array(7,8,9));
                        $this->db->where('actionsys.vendor',$key['id']);
                        $this->db->where('actionsys.status','0');
                        $cek2 = $this->db->get('actionsys')->row_array();
                        if(empty($cek2)){
                            
                            $input['id_user'] = 0;
                            $input['id_flowsys'] = 8;
                            $input['info'] = "Alert 2 Top Up Saldo Vendor ".$key['nama'];
                            $input['user_view'] = 0;
                            $input['assign_view'] = 0;
                            $input['comment'] = $this->general->comment_msg("System");
                            $input['status'] = 0;
                            $input['created_at'] = date("Y-m-d H:i:s");
                            $input['id_ticket'] = "#".uniqid();

                            $this->db->where('actionsys.id_flowsys',7);
                            $this->db->where('actionsys.vendor',$key['id']);
                            $this->db->where('actionsys.status','0');
                            $this->db->update('actionsys',$input);

                            $log['id_user'] = 0;
                            $log['info'] = "Create alert 2 top up saldo vendor ".$key['nama'];
                            $log['created_at'] = date("Y-m-d H:i:s");
                            $this->db->insert('actionsyslog',$log);
                        }
                    }
                    if($muncul==3){

                        $this->db->where_in('actionsys.id_flowsys',array(7,8,9));
                        $this->db->where('actionsys.vendor',$key['id']);
                        $this->db->where('actionsys.status','0');
                        $cek2 = $this->db->get('actionsys')->row_array();
                        if(empty($cek2)){

                            $input['id_user'] = 0;
                            $input['id_flowsys'] = 9;
                            $input['info'] = "Alert 3 Top Up Saldo Vendor ".$key['nama'];
                            $input['user_view'] = 0;
                            $input['assign_view'] = 0;
                            $input['comment'] = $this->general->comment_msg("System");
                            $input['status'] = 0;
                            $input['created_at'] = date("Y-m-d H:i:s");
                            $input['id_ticket'] = "#".uniqid();

                            $this->db->where('actionsys.id_flowsys',8);
                            $this->db->where('actionsys.vendor',$key['id']);
                            $this->db->where('actionsys.status','0');
                            $this->db->update('actionsys',$input);

                            $log['id_user'] = 0;
                            $log['info'] = "Create alert 3 top up saldo vendor ".$key['nama'];
                            $log['created_at'] = date("Y-m-d H:i:s");
                            $this->db->insert('actionsyslog',$log);
                        }
                    }
                }
            }

            $baru[] = array('code'=>$key['code'],
                            'airline'=>$key['airline'],
                            'id'=>$key['id'],
                            'saldo'=>'Rp. '.number_format($key['saldo'],2),
                            'muncul'=>$muncul);
        }

        echo json_encode($baru);
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

        $hasil['muncul'] = 0;
        if($this->session->userdata('revert')<sizeof($dataz)){
            $this->session->set_userdata('revert',sizeof($dataz));
            $hasil['muncul'] = 1;
        }
        $this->session->set_userdata('revert',sizeof($dataz));

		$hasil['revert'] = $dataz;
		$this->session->set_userdata('revert_data',sizeof($dataz));
		$datay = $this->db->get('temp_processing_issued');
		$datay = $datay->result_array();

        $newdatay = array();
        foreach ($datay as $key) {
            $strStart = $key['waktu']; 
            $strEnd   = date("Y-m-d H:i:s"); 

            $dteStart = new DateTime($strStart); 
            $dteEnd   = new DateTime($strEnd); 

            $dteDiff  = $dteStart->diff($dteEnd); 

            $pre="";
            if($dteDiff->format("%i")>0){
                if($dteStart>$dteEnd){
                    $pre = "-";
                }
            }


            $newdatay[] = $key+array('diff'=>$pre.$dteDiff->format("%i"));
        }
        $datay = $newdatay;

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

        $this->db->join('data_klasifikasi','data_klasifikasi.id=klasifikasi_member.id_klasifikasi','left');
        $this->db->where('id_mitra',$data['id']);
        $this->db->order_by('klasifikasi_member.id','desc');
        $class = $this->db->get('klasifikasi_member')->row_array();
		$dat['profiling']['klasifikasi'] = !empty($class['klasifikasi'])?$class['klasifikasi']:"No Data";
        $this->db->where('id_mitra',$data['id']);
        $data_detail = $this->db->get('data_detail_mitra')->row_array();
        if(empty($data_detail)){
            $data_detail = array('bank'=>'No Data',
                                    'tipe'=>'No Data',
                                    'lastsystem'=>'No Data',
                                    'info'=>'No Data',
                                    'otherinfo'=>'No Data');
        }
        $dat['detail_mitra'] = $data_detail;
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
    public function get_last_activity($id)
    {
        $this->general->logging();
        $this->db->where('member_ID',$id);
        $this->db->where('delete_by',NULL);
        $this->db->order_by('id','desc');
        $this->db->limit(1);
        $a = $this->db->get('data_activity');
        $a = $a->row_array();
        $data = array();
        if(empty($a)){
            $data['followup'] = "No one follow up";
        }else{
            $data['followup'] = $a['type']." : ".$this->general->get_respon($a['id_respon'])." : ".$a['reason'];
        }

        $this->db->join('data_klasifikasi','data_klasifikasi.id=klasifikasi_member.id_klasifikasi','left');
        $this->db->where('id_mitra',$id);
        $this->db->order_by('klasifikasi_member.id','desc');
        $this->db->limit(1);
        $a = $this->db->get('klasifikasi_member');
        $a = $a->row_array();
        if(empty($a)){
            $data['klasifikasi'] = "No Data";
        }else{
            $data['klasifikasi'] = $a['klasifikasi'];
        }

        echo json_encode($data);

    }
    public function ajax_del_act()
    {
        $this->general->logging();
        $data = $this->input->post();
        $this->db->where('ID',$data['id']);
        $this->db->delete('data_activity');
    }
}
