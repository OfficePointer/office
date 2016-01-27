<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class general extends CI_Model {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/welcome
	 *	- or -
	 * 		http://example.com/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		if($this->uri->segment(1)!="login"
			and $this->uri->segment(2)!="generate_tanggal"
			and $this->uri->segment(2)!="cron_cek_deposit"){
			if($this->session->userdata('id')==0 or $this->session->userdata('id')==""){
				$this->session->set_userdata('revert_data',0);
				$this->session->set_userdata('sekarang',0);
				$this->session->set_userdata('revert',0);
				$this->session->set_userdata('saldo',0);
				$this->session->set_userdata('pending',0);
				$this->session->set_userdata('saldosekarang',0);
				redirect(base_url("login"));
			}
		}
	}

	public function load($page,$data=array())
	{
		$this->load->view('Utility/Header');
		$this->load->view('Utility/Menu');
		$this->load->view($page,$data);
		$this->load->view('Utility/Footer');
		$this->general->logdata($page,$data);
	}

	public function logdata($page,$data)
	{
		$datas['idpengguna'] = $this->session->userdata('id');
		$datas['url'] = current_url();
		$datas['tanggal'] = date("Y-m-d");
		$datas['jam'] = date("H:i:s");
		$datas['ip'] = $_SERVER['REMOTE_ADDR'];
		// $datas['client_info'] = json_encode($_SERVER);
		// $datas['hostname'] = gethostname();
		// $datas['header'] = json_encode(headers_list());
		$datas['get_info'] = json_encode($_GET);
		$datas['post_info'] = json_encode($this->input->post());
		$this->db->insert('logdata',$datas);
	}

	public function simpan($tbl,$data)
	{
		$this->db->insert($tbl,$data);
		return $this->db->insert_id();
	}
	public function cek_root()
	{
		if($this->get_div()!="Root"){
			redirect(base_url());
		}
	}

function csv_to_array($filename='', $delimiter=',')
{
    if(!file_exists($filename) || !is_readable($filename))
        return FALSE;

    $header = NULL;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== FALSE)
    {
        while (($row = fgetcsv($handle, 100000000, $delimiter)) !== FALSE)
        {
            if(!$header)
                $header = $row;
            else
                $data[] = array_combine(
                    $header,
                    $row
                    );
        }
        fclose($handle);
    }
    return $data;
}

	public function log()
	{
		return $this->session->userdata('login');
	}
	public function ceklog()
	{
		if($this->log()==false){
			redirect(base_url("login"));
		}
	}
	public function get_div()
	{
		$this->db->where('id',$this->session->userdata('id'));
		$xa = $this->db->get('data_user');
		$xa = $xa->row_array();
		return $xa['division'];
	}
	public function get_vendor($id)
	{
		$this->db->where('id',$id);
		$xa = $this->db->get('vendor');
		$xa = $xa->row_array();
		return $xa['nama'];
	}
	public function get_forms($id)
	{
		$this->db->where('delete_at',NULL);
		$this->db->where('utama',$id);
		$xa = $this->db->get('forms');
		$xa = $xa->result_array();
		return $xa;
	}
	public function get_klasifikasi($id_mitra=0,$time="last")
	{
		$this->db->select('klasifikasi');
		$this->db->join('data_klasifikasi','data_klasifikasi.id=klasifikasi_member.id_klasifikasi','left');
		$this->db->where('klasifikasi_member.id_mitra',$id_mitra);
		if($time=="last"){
			$this->db->order_by('klasifikasi_member.id','desc');
			$this->db->limit(1);
		}else{
			$this->db->order_by('klasifikasi_member.id','desc');
			$this->db->where('klasifikasi_member.tgl_update <=',$time."31 00:00:00");
			$this->db->limit(1);
		}
		$xa = $this->db->get('klasifikasi_member');
		$xa = $xa->row_array();
		if($xa['klasifikasi']==""){
			$xa['klasifikasi'] = "No Data";
		}
		return $xa['klasifikasi'];
	}
	public function get_email_div($div = array(),$array = false)
	{
		$this->db->select('email');
		$this->db->where_in('division',$div);
		$xa = $this->db->get('data_user');
		if($array){
			return $xa->result_array();
		}else{
			$data = "";
			foreach ($xa->result_array() as $key) {
				$data .= "<".$key['email'].">,";
			}
			return $data;
		}
	}
	public function cek($data){
		$query = $this->db->where('email',$data['email']);
		$query = $this->db->get('data_user');
		$hasil = $query->row_array();
		if(empty($hasil)){
			$hasil = "gagal";
		}
		else{
			if($hasil['password']!=$data['password']){
				$hasil = "gagal";
			}
		}
		return $hasil;
	}
	public function get_user($id)
	{
		$this->db->where('id',$id);
		$a = $this->db->get('data_user');
		$a = $a->row_array();
		if(empty($a['email'])){
			return "someone";
		}elseif($a['name']==""){
			return $a['email'];
		}elseif($a['name']!=""){
			return $a['name'];
		}
	}
	public function get_email($id)
	{
		$this->db->where('id',$id);
		$a = $this->db->get('data_user');
		$a = $a->row_array();
		return $a['email'];
	}
	public function get_member($id=0,$kode=0)
	{
		if($id==0){
			return "";
		}
		$this->db->where('id_mitra',$id);
		$a = $this->db->get('data_mitra');
		$a = $a->row_array();
		if($kode){
			$kode = " (".$a['prefix'].")";
		}else{
			$kode = "";
		}
		return $a['brand_name'].$kode;
	}
	public function get_respon($id=0)
	{
		if($id==0){
			return "";
		}
		$this->db->where('id',$id);
		$a = $this->db->get('data_respon');
		$a = $a->row_array();
		return $a['respon'];
	}
	public function get_airline($id)
	{
		$this->db->where('kode',$id);
		$a = $this->db->get('data_kode');
		$a = $a->row_array();
		return $a['isi'];
	}

	public function get_sys_div($id)
	{		
		if($id==0){
			return "";
		}
		$this->db->where('id',$id);
		$a = $this->db->get('division')->row_array();
		return $a['name'];
	}
	public function get_sys_div_lev($id)
	{
		if($id==0){
			return "";
		}
		$this->db->where('id',$id);
		$a = $this->db->get('level')->row_array();
		$this->db->where('id',$a['id_division']);
		$a = $this->db->get('division')->row_array();
		return $a['name'];
	}
	public function get_sys_lev($id)
	{
		if($id>0){
		$this->db->where('id',$id);
		$a = $this->db->get('level')->row_array();
		return $a['name'];
		}else{
			return "This is parent";
		}
	}
	public function logging()
	{
		$dataxlog['idpengguna'] = $this->session->userdata('id');
		$dataxlog['url'] = current_url();
		$dataxlog['tanggal'] = date("Y-m-d");
		$dataxlog['jam'] = date("H:i:s");
		$dataxlog['ip'] = $_SERVER['REMOTE_ADDR'];
		// $dataxlog['client_info'] = json_encode($_SERVER);
		// $dataxlog['hostname'] = gethostname();
		// $dataxlog['header'] = json_encode(headers_list());
		$dataxlog['get_info'] = json_encode($_GET);
		$dataxlog['post_info'] = json_encode($this->input->post());
		$this->db->insert('logdata',$dataxlog);
	}
	public function get_manual($id_mitra,$tanggal_awal,$tanggal_akhir)
	{
		$dbs = $this->load->database('default',TRUE);
		$a = $dbs->query('select sum(jml_tiket) as jumlah from data_trx where type_iss=1 and id_mitra="'.$id_mitra.'" AND date_resv >="'.date_format(date_create($tanggal_awal),"Y-m-d").'" AND date_resv <="'.date_format(date_create($tanggal_akhir),"Y-m-d").'"');
		$a = $a->row_array();
		return $a['jumlah'];
	}

	public function in_division($arr = array())
	{
		if(in_array($this->get_div(), $arr)){

		}else{
			redirect(base_url('ofur'));
		}
	}

	public function get_sync_process()
	{
		$this->db->where('is_sync',1);
		$a = $this->db->get('data_sync');
		$a = $a->result_array();
		return $a;
	}
	public function pagination($item_count, $limit, $cur_page, $link)
	{
       $page_count = ceil($item_count/$limit);
       $current_range = array(($cur_page-2 < 1 ? 1 : $cur_page-2), ($cur_page+2 > $page_count ? $page_count : $cur_page+2));

       // First and Last pages
       $first_page = $cur_page > 3 ? '<li><a href="'.sprintf($link, '1').'">1</a></li>'.($cur_page < 5 ? ', ' : '<li><a>...</a></li>') : null;
       $last_page = $cur_page < $page_count-2 ? ($cur_page > $page_count-4 ? ', ' : '<li><a>...</a></li>').'<li><a href="'.sprintf($link, $page_count).'">'.$page_count.'</a></li>' : null;

       // Previous and next page
       $previous_page = $cur_page > 1 ? '<li><a href="'.sprintf($link, ($cur_page-1)).'">Previous</a></li>' : null;
       $next_page = $cur_page < $page_count ? '<li><a href="'.sprintf($link, ($cur_page+1)).'">Next</a></li>' : null;

       // Display pages that are in range
       for ($x=$current_range[0];$x <= $current_range[1]; ++$x)
               $pages[] = '<li><a class="current" href="'.sprintf($link, $x).'">'.($x == $cur_page ? '<strong>'.$x.'</strong>' : $x).'</a></li>';

       if ($page_count > 1)
               return '<span class="btn btn-primary">Total Data : '.$item_count.'</span><ul class="pagination pagination-sm no-margin pull-right">'.$previous_page.$first_page.implode(' ', $pages).$last_page.$next_page.'</ul>';
	}
	function get_friendly_time_ago($distant_timestamp, $max_units = 1) {
	    $i = 0;
	    $time = time() - $distant_timestamp - strtotime("3 minute"); // to get the time since that moment
	    $tokens = array(
	        31536000 => 'tahun',
	        2592000 => 'bulan',
	        604800 => 'minggu',
	        86400 => 'hari',
	        3600 => 'jam',
	        60 => 'menit',
	        1 => 'detik'
	    );

	    $responses = array();
	    while ($i < $max_units) {
	        foreach ($tokens as $unit => $text) {
	            if ($time < $unit) {
	                continue;
	            }
	            $i++;
	            $numberOfUnits = floor($time / $unit);

	            $responses[] = $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? '' : '');
	            $time -= ($unit * $numberOfUnits);
	            //break;
	        }
	    }

	    if (!empty($responses)) {
	        return $responses[0];
	    }

	    return 'Just now';
	}

	function createDateRangeArray($strDateFrom,$strDateTo)
	{
    // takes two dates formatted as YYYY-MM-DD and creates an
    // inclusive array of the dates between the from and to dates.

    // could test validity of dates here but I'm already doing
    // that in the main script

    $aryRange=array();

    $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
    $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

    if ($iDateTo>=$iDateFrom)
    {
        array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
        while ($iDateFrom<$iDateTo)
        {
            $iDateFrom+=86400; // add 24 hours
            if(sizeof($aryRange)<7){
				array_push($aryRange,date('Y-m-d',$iDateFrom));
			}
        }

			$dataRange[0] = $aryRange[0];
			$dataRange[1] = $aryRange[6];
	    }
	    return array('arr'=>$dataRange);
	}

	public function kirim_email_solver_revert($email,$subject,$body)
    {
        $this->logging();
        $this->load->library('email');

        $this->email->set_header('X-MC-PreserveRecipients',TRUE);
        $this->email->from('qa.dev.pointer@outlook.com', $this->session->userdata('nama'));
        $this->email->to($email);
        //$this->email->bcc($this->general->get_email_div(array('Feedback Service'),false));
        //$this->email->bcc('them@their-example.com');

        $body .= "<div><blockquote style='margin:0px 0px 0px 0.8ex;border-left:1px solid rgb(204,204,204);padding-left:1ex'><span style='font-family:verdana,sans-serif'><span><span><span><b><span><span><span><span><span><span><b>
     </b></span></span></span></span></span></span></b></span></span></span>
</span><span><span><span><span><span><b>Office Pointer</b></span></span></span></span></span><span><span><span><span></span></span><br><span><span>PT. Pojok Celebes Mandiri</span></span><br><span><span>Jalan Condet Raya No. 333/J Balekambang, Kramat Jati, Jakarta Timur 13530</span></span><br><span><span>Telp. 021 2937 3371 | Fax. 021 2937 3372</span></span><span><span></span></span><br><a href='http://www.pointer.co.id' target='_blank'></a></blockquote></div>";
        $this->email->subject($subject);
        $this->email->message($body);

        $this->email->send();
    }

    public function get_infosys($id)
    {
    	if($id==0){
			return "";
		}
    	return $this->db->where('id',$id)
    				->get('infosys')
    				->row_array()['title'];
    }

	public function get_infosys_by_idflowsys($id)
    {
    	if($id==0){
			return "";
		}
		return $this->db->join('infosys','infosys.id=flowsys.id_info','left')
					->where('flowsys.id',$id)
					->get('flowsys')
					->row_array()['title'];	
    }

	public function get_flowsys($id)
    {
    	if($id==0){
			return "";
		}
		return $this->db->where('id',$id)
						->get('flowsys')
						->row_array()['description'];
    }

    public function parse_user($user)
    {
    	$assign_user = array();
    	$ex = explode(",", $user);
		foreach ($ex as $key) {
			if(strlen($key)<3 and $key!=""){
				$assign_user[] = $key;
			}
		}
		return implode(",", $assign_user);
    }
    public function comment_msg($pesan)
    {
    	return "Created by ".$pesan." (".date("D, d F Y H:i:s").")";
    }
}
