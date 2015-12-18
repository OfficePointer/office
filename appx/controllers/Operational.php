<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operational extends CI_Controller {

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
    public function get_web_page($url)
    {
        //echo "curl:url<pre>".$url."</pre><BR>";
        $options = array(
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_USERAGENT      => "spider", // who am i
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 15,      // timeout on connect
            CURLOPT_TIMEOUT        => 15,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects

        );

        $ch      = curl_init($url);
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch,CURLINFO_EFFECTIVE_URL );
        curl_close( $ch );

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;

        //change errmsg here to errno
        if ($errmsg)
        {
            echo "CURL:".$errmsg."<BR>";
        }
        return $content;

    }

    public function all_error()
    {
        $a = $this->db->get('data_all_error');
        $data = array();
        $data['error'] = $a->result_array();
        $this->general->load('operational/data_all_error',$data);
    }

    public function change_status()
    {
        $this->general->logging();
        $this->db->where('id',$this->session->userdata('id'));
        $this->db->update('data_user',array('status'=>$this->input->post('status')));
        echo $this->input->post('status');
    }
    public function funnyname()
    {
        $a = $this->load->database('dbpointer',true);
        $hasil = $a->query('select ar_booking.id_mitra,brand_name,prefix,count(ar_booking.kode_booking) as jumlah from ar_booking left join company on company.id_mitra=ar_booking.id_mitra left join mitra on mitra.id_mitra=ar_booking.id_mitra where tgl_berangkat_takeoff>="'.date("Y-m-d").'" and ar_booking.status in (3) and id not in (select id_ar_booking from funnyname_log where status=1) and ar_booking.id_mitra>0 group by ar_booking.id_mitra');
        $data = array();
        $data['funnyname'] = array();
        foreach ($hasil->result_array() as $key) {
            $data['funnyname'][] = array('id_mitra'=>$key['id_mitra'],'jumlah'=>$key['jumlah'],'brand_name'=>$key['brand_name'],'prefix'=>$key['prefix'],'link'=>"https://admin.pointer.co.id/airline/admin/funnyname/".$key['id_mitra']."/all/all/all");            
        }
        $this->general->load('operational/funnynamelist',$data);
    }
    public function error_tickets()
    {
        $data['error'] = $this->db->get('data_all_error')->result_array();
        $this->general->load('operational/error_tickets',$data);
    }
	public function koran_helpdesk()
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
		$data['paging'] = $this->general->pagination($count,$limit,$pg,base_url("operational/koran_helpdesk/%d"));
		$this->general->load('operational/koran_helpdesk',$data);
	}
	public function form($value)
	{
		$this->db->where('id',$value);
		$forms = $this->db->get('forms');
		$data['formdata'] = $forms->row_array();
		$this->general->load('operational/form',$data);
	}
	private function _setup_ckeditor($id)
    {
        $this->load->helper('url');
        $this->load->helper('ckeditor');
 
        $ckeditor = array(
            'id' => $id,
            'path' => 'assets/js/ckeditor',
            'config' => array(
                'toolbar' => 'standard',
                'width' => '99%',
                'height'=>'450px'));
 
        return $ckeditor;
    }
    public function addkoran()
    {
		$data['ckeditor'] = $this->_setup_ckeditor('notes');
		$this->general->load('operational/addkoran',$data);
    }
    public function editkoran($id)
    {
    	$this->db->where('id',$id);
    	$data['koran'] = $this->db->get('posts')->row_array();
		$data['ckeditor'] = $this->_setup_ckeditor('notes');
		$this->general->load('operational/editkoran',$data);
    }
    public function addform()
    {
		$this->general->load('operational/addform');
    }
    public function forms()
    {
    	$a = $this->db->get('forms');
    	$data['formdata'] = $a->result_array();
    	$this->general->load('operational/forms',$data);
    }
    public function sendmail($idnya)
    {
        $this->general->logging();

        $this->email->set_header('X-MC-PreserveRecipients',TRUE);
        $this->email->from('koran@office.pointer.co.id', 'Koran Helpdesk');
        //all service operation
        $this->email->to($this->general->get_email_div(array('Root','Opera+','Opera','IT Support','Enterprise','Feedback Service'),false)); 
        //only me
        //$this->email->to('ariefsetya@live.com,arief@pointer.co.id,achmad@pointer.co.id');
        //$this->email->to($this->general->get_email_div(array('Root','Opera+','Opera','IT Support','Enterprise','Feedback Service'),false));         
        //$this->email->cc('another@another-example.com'); 
        //$this->email->bcc('them@their-example.com'); 
        $this->db->where('id',$idnya);
        $ss = $this->db->get('posts');
        $ss = $ss->row_array();
        $this->email->subject($ss['judul']);
        $this->email->message($ss['isi']."<br><hr>Posted by ".$this->general->get_user($ss['idpengguna'])." at ".$ss['tanggal']." ".$ss['jam']);  

         $to = $this->general->get_email_div(array('Root','Opera+','Opera','IT Support','Enterprise','Feedback Service'),true);
        $this->email->send();
        foreach ($to as $key) {
            $data['email'] = $key['email'];
            $data['from'] = $this->session->userdata('email');
            $data['created_at'] = date("Y-m-d H:i:s");
            $data['sent'] = 1;
            $this->db->insert('email_log',$data);
        }

        //echo $this->email->print_debugger();
    }
    public function kirim_surat($idnya)
	{
		$this->general->in_division(array('Root','Opera+'));
		$this->general->logging();
		$this->sendmail($idnya);
		redirect(base_url("operational/adminkoran"));
	}
	public function base64_to_jpeg($base64_string, $output_file) {
	    $ifp = fopen($output_file, "wb"); 

	    //$data = explode(',', $base64_string);

	    fwrite($ifp, base64_decode($base64_string)); 
	    fclose($ifp); 

	    return $output_file; 
	}
	public function koran_update()
	{
		//$this->general->ceklog();
		//$this->general->in_division(array('Root','Opera+'));
		$datasearch = array();
		$datarep = array();
        $data['isi'] = $this->input->post('notes');
		$tags = "";
		$awal = 0;
		$akhir = 0;
		$ada = 0;
		for($i=0;$i<strlen($data['isi']);$i++){
			if(substr($data['isi'], $i,5)=='src="'){
				$awal = $i+5;
				//echo "awal".$awal;
				$ada = 1;
			}

			if(substr($data['isi'], $i,2)=='/>' and $ada == 1){
				$akhir = $i;
				//echo "akhir".$akhir;
				//echo $awal." ".$akhir;
				$imgtags = substr($data['isi'], $awal,$akhir);
				//echo $imgtags;
				//echo $imgtags;
				$tags = explode('"', $imgtags);
				//echo $tags[0];
				$ima = explode(",", $tags[0]);

				//echo is_file($tags[0]);

				if(sizeof($ima)>1){
					//echo $ima[1];
					$tip = explode(";", $ima[0]);
					$tipe = explode("/", $tip[0]);

					//echo $tipe[1]."<br>";
				//echo $ima[0];
					//echo $ima[0];
					$tgl = date("YmdHis").uniqid('');
					//echo '<img src="data:image/jpeg;base64,'.$imgtags.'"/>';
					$this->base64_to_jpeg($ima[1],'assets/imgposts/'.$tgl.'.jpeg');
					//echo $ima[1]."<br>";

					$datasearch[] = "data:image/".$tipe[1].";base64,".$ima[1];

					$datarep[] = 'http://103.4.167.242/assets/imgposts/'.$tgl.'.jpeg';
					//echo $ima[1];
				}
				$ada = 0;
			}
		}
		//$data['isi'] = str_replace("data:image/".$tipe[1].";base64,".$ima[1], 'http://office.pointer.co.id/perf/imgposts/'.$tgl.'.jpeg' , $data['isi']);
		
		$data['isi'] = str_replace($datasearch, $datarep, $data['isi']);
        $data['judul'] = htmlspecialchars($this->input->post('judul'));
        $data['tanggal'] = date("Y-m-d");
        $data['jam'] = date("H:i:s");
        $data['sys_info'] = 1;
        $data['sys_create_date'] = date("Y-m-d H:i:s");
        $this->db->where('id',$this->input->post('id'));
        $this->db->update('posts',$data);
        $this->sendmail($this->input->post('id'));
		$this->general->logging();
        redirect(base_url('operational/adminkoran'));
	}
	public function koran_save()
	{
		//$this->general->ceklog();
		//$this->general->in_division(array('Root','Opera+'));
		$datasearch = array();
		$datarep = array();
        $data['isi'] = $this->input->post('notes');
		$tags = "";
		$awal = 0;
		$akhir = 0;
		$ada = 0;
		for($i=0;$i<strlen($data['isi']);$i++){
			if(substr($data['isi'], $i,5)=='src="'){
				$awal = $i+5;
				$ada = 1;
			}

			if(substr($data['isi'], $i,2)=='/>' and $ada==1){
				$akhir = $i;
				//echo $awal." ".$akhir;
				$imgtags = substr($data['isi'], $awal,$akhir);
				//echo $imgtags;
				$tags = explode('"', $imgtags);
				//echo $tags[0];
				$ima = explode(",", $tags[0]);

				if(sizeof($ima)>1){

					$tip = explode(";", $ima[0]);
					$tipe = explode("/", $tip[0]);

					//echo $tipe[1]."<br>";

					$tgl = date("YmdHis").uniqid('');
					//echo '<img src="data:image/jpeg;base64,'.$imgtags.'"/>';
					$this->base64_to_jpeg($ima[1],'assets/imgposts/'.$tgl.'.jpeg');
					///echo $ima[1]."<br>";

					$datasearch[] = "data:image/".$tipe[1].";base64,".$ima[1];

					$datarep[] = 'http://103.4.167.242/assets/imgposts/'.$tgl.'.jpeg';
					//echo $ima[1];
				}
				$ada = 0;
			}
		}
		//$data['isi'] = str_replace("data:image/".$tipe[1].";base64,".$ima[1], 'http://office.pointer.co.id/perf/imgposts/'.$tgl.'.jpeg' , $data['isi']);
		
		$data['isi'] = str_replace($datasearch, $datarep, $data['isi']);		
		//echo "<pre>".$data['isi']."</pre>";
		//die();
        $data['judul'] = htmlspecialchars($this->input->post('judul'));
        //$data['isi'] = $this->input->post('notes');
        $data['idpengguna'] = $this->session->userdata('id');
        $data['tanggal'] = date("Y-m-d");
        $data['jam'] = date("H:i:s");
        $data['sys_info'] = 1;
        $data['sys_create_date'] = date("Y-m-d H:i:s");
        $this->db->insert('posts',$data);
        $inid = $this->db->insert_id();
        $this->sendmail($inid);
		$this->general->logging();
        redirect(base_url('operational/adminkoran'));
	}
	public function adminkoran()
	{
		$this->db->where('sys_delete_date',"");
		$this->db->order_by('sys_create_date','desc');
		$data['koran'] = $this->db->get('posts')->result_array();
		$this->general->load('operational/adminkoran',$data);
	}	
	public function deletekoran($id=0)
	{
		$this->general->logging();
        $data['sys_delete_date'] = date("Y-m-d H:i:s");
        $this->db->where('id',$id);
        $this->db->update('posts',$data);
        redirect(base_url('operational/adminkoran'));
	}
	public function rekonlion()
	{
		$this->general->load('operational/rekon/rekonlion');
	}
	public function processrekonlion()
	{
        $this->general->logging();
		if(!isset($_FILES['csvlion']['name'])){
			redirect(base_url("operational/rekonlion"));
		}

        $tanggal = date("Y-m-d");
        
        move_uploaded_file(
            $_FILES['csvlion']['tmp_name'],
            "assets/csv/csvlion/lion/".$tanggal.$_FILES['csvlion']['name']
            );

        $delim = ";";

        $read = fopen("assets/csv/csvlion/lion/".$tanggal.$_FILES['csvlion']['name'], "r");
        $a = fread($read, 10000);
        $count = explode(";",$a);
        $count2 = explode(",",$a);
        if(sizeof($count2) > sizeof($count)){
            $delim = ",";
        }
        fclose($read);

        $b = $this->general->csv_to_array("assets/csv/csvlion/lion/".$tanggal.$_FILES['csvlion']['name'],$delim);
        
        $this->db->where('id >',0);
        $this->db->delete('rekon_lion');

        foreach($b as $key){    
            if($key['TransactionType']=="NTA"){
                $data = array();
                $data['num_tiket'] = $key['PaxSegCount'];
                $data['kode_booking'] = $key['BookingReloc'];
                $data['tr_datetime'] = $key['TransactionTimeStamp'];
                $data['nta'] = str_replace(array("-",","),"",$key['TransactionAmount']);
                $data['tanggal'] = $tanggal;
                $data['jam'] = date("H:i:s");
                $this->db->insert('rekon_lion',$data);
            }
        }


        $folder = $_FILES['csvpointer']['tmp_name'];
        $lokasi = "assets/csv/csvlion/pointer/".$_FILES['csvpointer']['name'];
        $filetype = explode(".", $lokasi);
        $filety = $filetype[sizeof($filetype)-1];
        if($filety!="xls"){
            echo "file tipe nya xls bos...<br>";
            echo "Balik lewat <a href='".base_url("operational/rekonlion")."'>sini</a>";
            die();
        }

        $this->db->where('id >',0);
        $this->db->delete('rekon_pointer');

        move_uploaded_file($folder, $lokasi);
        $file = $lokasi;
        //load the excel library
        $this->load->library('Excelphp');
        //read file from path
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        //get only the Cell Collection
        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
        $dat = array();
        //extract to a PHP readable array format
        foreach ($cell_collection as $cell) {
            $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
            $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
            $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
            //header will/should be in row 1 only. of course this can be modified to suit your need.
            if ($row == 1) {
                $header[$row][$column] = $data_value;
            } else {

                $arr_data[$row][$column] = $data_value;
            }
        }

        foreach ($arr_data as $key) {
            $data = array();
            $data['num_tiket'] = $key['M'];
            $data['kode_booking'] = $key['K'];
            $data['tr_datetime'] = $key['B']." ".$key['C'];
            $data['nta'] = str_replace(array("-",","),"",$key['S']);
            $data['tanggal'] = $tanggal;
            $data['jam'] = date("H:i:s");
            $this->db->insert('rekon_pointer',$data);
        }


        redirect(base_url("operational/reportrekonlion"));
	}
    public function reportrekonlion()
    {
        $a = $this->db->query('select nta,replace(replace(kode_booking,"-","")," ","") as kode, sum(num_tiket) as jumlah from rekon_pointer group by replace(replace(kode_booking,"-","")," ","")');
        $a = $a->result_array();
        $datatiket = array();
        //echo "<pre>".print_r($a,1)."</pre>";
        foreach ($a as $key) {
            $x = $this->db->query('select kode_booking, nta, num_tiket from rekon_lion where kode_booking="'.$key['kode'].'" and num_tiket<>'.$key['jumlah']);
            $x = $x->row_array();

            if(!empty($x)){
                $arr = array('kode_booking'=>$x['kode_booking'],'nta_lion'=>$x['nta'],'num_tiket_lion'=>$x['num_tiket'],
                    'nta_pointer'=>$key['nta'],'num_tiket_pointer'=>$key['jumlah']);
                $datatiket[] = $arr;
            }
        }



        // $this->db->join('rekon_pointer','rekon_pointer.kode_booking=rekon_lion.kode_booking and rekon_pointer.num_tiket=rekon_lion.num_tiket and rekon_pointer.nta=rekon_lion.nta','inner');
        // $a = $this->db->get('rekon_lion');
        // $data = array();
        // $a = $a->result_array();
        // foreach ($a as $key) {
        //     array_push($data, $key['kode_booking']);
        // }
        // $this->db->select('rekon_lion.kode_booking as kode_lion,rekon_lion.num_tiket as num_lion,rekon_lion.nta as nta_lion, rekon_pointer.nta as nta_pointer,rekon_pointer.kode_booking as kode_pointer,rekon_pointer.num_tiket as num_pointer, rekon_pointer.nta as nta_pointer');
        // $this->db->where_not_in('rekon_lion.kode_booking',$data);
        // $this->db->join('rekon_pointer','rekon_pointer.kode_booking=rekon_lion.kode_booking and rekon_pointer.nta=rekon_lion.nta','inner');
        // $a = $this->db->get('rekon_lion');
        // $a = $a->result_array();
        // $datatiketok = array();
        // foreach ($a as $key) {
        //     $datatiketok[] = array('kode_lion'=>$key['kode_lion'],
        //         'nta_lion'=>$key['nta_lion'],
        //         'num_lion'=>$key['num_lion'],
        //         'kode_pointer'=>$key['kode_pointer'],
        //         'nta_pointer'=>$key['nta_pointer'],
        //         'num_pointer'=>$key['num_pointer']);

        //     array_push($data, $key['kode_lion']);

        //     //echo "lion : ".$key['kode_lion']." ".$key['nta_lion']." ".$key['num_lion']." pointer : ".$key['kode_pointer']." ".$key['nta_pointer']." ".$key['num_pointer'] ."<br>";
        // }

        // $this->db->select('rekon_lion.kode_booking as kode_lion,rekon_lion.num_tiket as num_lion,rekon_lion.nta as nta_lion, rekon_pointer.nta as nta_pointer,rekon_pointer.kode_booking as kode_pointer,rekon_pointer.num_tiket as num_pointer, rekon_pointer.nta as nta_pointer');
        // $this->db->where_not_in('rekon_lion.kode_booking',$data);
        // $this->db->join('rekon_pointer','rekon_pointer.kode_booking=rekon_lion.kode_booking and rekon_pointer.num_tiket=rekon_lion.num_tiket','inner');
        // $a = $this->db->get('rekon_lion');
        // $a = $a->result_array();
        // $datatiketnonnta = array();
        // foreach ($a as $key) {
        //     $datatiketnonnta[] = array('kode_lion'=>$key['kode_lion'],
        //         'nta_lion'=>$key['nta_lion'],
        //         'num_lion'=>$key['num_lion'],
        //         'kode_pointer'=>$key['kode_pointer'],
        //         'nta_pointer'=>$key['nta_pointer'],
        //         'num_pointer'=>$key['num_pointer']);

        //     array_push($data, $key['kode_lion']);

        //     //echo "lion : ".$key['kode_lion']." ".$key['nta_lion']." ".$key['num_lion']." pointer : ".$key['kode_pointer']." ".$key['nta_pointer']." ".$key['num_pointer'] ."<br>";
        // }

        // $this->db->where_not_in('rekon_lion.kode_booking',$data);
        // $a = $this->db->get('rekon_lion');
        // $a = $a->result_array();
        // foreach ($a as $key) {

        //     $datatiketnonpointer[] = array('kode_booking'=>$key['kode_booking'],
        //         'nta'=>$key['nta'],
        //         'num_tiket'=>$key['num_tiket']);

        //     //echo $key['kode_booking']." ".$key['nta']." ".$key['num_tiket'] ."<br>";
        // }
        // $this->db->where_not_in('rekon_pointer.kode_booking',$data);
        // $a = $this->db->get('rekon_pointer');
        // $a = $a->result_array();
        // foreach ($a as $key) {

        //     $datatiketnonlion[] = array('kode_booking'=>$key['kode_booking'],
        //         'nta'=>$key['nta'],
        //         'num_tiket'=>$key['num_tiket']);

        //     //echo $key['kode_booking']." ".$key['nta']." ".$key['num_tiket'] ."<br>";
        // }
        $data['tiket'] = $datatiket;
        $this->general->load('operational/rekon/hasilrekonlion',$data);
    }
    public function rekonsj()
    {
        $this->general->load('operational/rekon/rekonsj');
    }
    public function processrekonsj()
    {

        $this->general->logging();
        $tanggal = date("Y-m-d");
        $folder = $_FILES['csvpointer']['tmp_name'];
        $lokasi = "assets/csv/csvsj/pointer/".$_FILES['csvpointer']['name'];
        $filetype = explode(".", $lokasi);
        $filety = $filetype[sizeof($filetype)-1];
        if($filety!="xls"){
            echo "file tipe nya xls bos...<br>";
            echo "Balik lewat <a href='".base_url("index.php/rekon/rekonsj")."'>sini</a>";
            die();
        }
        $this->db->where('id >',0);
        $this->db->delete('rekon_pointer');
        $this->db->where('id >',0);
        $this->db->delete('rekon_lion');


        move_uploaded_file($folder, $lokasi);
        $file = $lokasi;
        //load the excel library
        $this->load->library('Excelphp');
        //read file from path
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        //get only the Cell Collection
        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
        $dat = array();
        //extract to a PHP readable array format
        foreach ($cell_collection as $cell) {
            $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
            $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
            $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
            //header will/should be in row 1 only. of course this can be modified to suit your need.
            if ($row == 1) {
                $header[$row][$column] = $data_value;
            } else {

                $arr_data[$row][$column] = $data_value;
            }
        }

        foreach ($arr_data as $key) {
            $data = array();
            $data['num_tiket'] = $key['M'];
            $data['kode_booking'] = $key['K'];
            $data['tr_datetime'] = $key['B']." ".$key['C'];
            $data['tanggal'] = $tanggal;
            $data['jam'] = date("H:i:s");
            $this->db->insert('rekon_pointer',$data);
        }

        
        $folder = $_FILES['csvsj']['tmp_name'];
        $lokasi = "assets/csv/csvsj/sj/".$_FILES['csvsj']['name'];
        $filetype = explode(".", $lokasi);
        $filety = $filetype[sizeof($filetype)-1];
        if($filety!="xls"){
            echo "file tipe nya xls bos...<br>";
            echo "Balik lewat <a href='".base_url("index.php/rekon/rekonsj")."'>sini</a>";
            die();
        }

        $arr_data = array();
        $row = array();
        $column = array();

        move_uploaded_file($folder, $lokasi);
        $file = $lokasi;
        //load the excel library
        $this->load->library('Excelphp');
        //read file from path
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        //get only the Cell Collection
        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
        $dat = array();
        //extract to a PHP readable array format
        foreach ($cell_collection as $cell) {
            $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
            $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
            $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
            //header will/should be in row 1 only. of course this can be modified to suit your need.
            if ($row == 1) {
                $header[$row][$column] = $data_value;
            } else {

                $arr_data[$row][$column] = $data_value;
            }
        }

        $data = array();

        $tiket = "";
        $tiketasli = "";
        $jumlah = 0;

		//echo sizeof($arr_data);
		$aaa=0;
        foreach ($arr_data as $key) {
            if($key['B']=="DEPAG01012"){
                $key['C'] = str_replace("Incentive for ", "", $key['C']);
                $key['D'] = number_format(str_replace(',000 IDR', '',$key['D']))/10;
                unset($key['E']);
                //echo "<pre>".print_r($key,1)."</pre>";
                $data[] = array('tr_datetime'=>$key['A'],
                    'kode_booking'=>$key['C'],
                    'jumlah'=>$key['D']);
            }
            // if($key['C']!=""){
            //         $jumlah = 0;
            //     if($tiket!=$key['C']){
            //         $tiketasli = str_replace("Incentive for ", "", $key['C']);
                    
            //         $mulai = 0;
            //         foreach ($arr_data as $data_2) {
            //             if($data_2['C']==$key['C']){
            //                 $mulai = 1;
            //             }
            //             if($data_2['C']!=$key['C'] and TRIM($data_2['C'])!="" and $mulai==1){
            //                 $mulai = 0;
            //             }
            //             if($mulai == 1){
            //                 $jumlah++;
            //             }
            //         }
            //     }
                
            //     $tiket = $key['C'];
            // if(sizeof($arr_data)-2==$aaa){
            //         $jumlah--;
            //     }

            // $data[] = array('tr_datetime'=>$key['A'],
            //     'kode_booking'=>str_replace("Incentive for ", "", $key['C']),
            //     'jumlah'=>$jumlah);
            // }
            // $aaa++;
        }
        //echo $aaa;
        //echo "<pre>".print_r($data,1)."</pre>";
        foreach ($data as $key) {
            $data = array();
            $data['num_tiket'] = $key['jumlah'];
            $data['kode_booking'] = $key['kode_booking'];
            $data['tr_datetime'] = $key['tr_datetime'];
            $data['tanggal'] = $tanggal;
            $data['jam'] = date("H:i:s");
            $this->db->insert('rekon_lion',$data);
        }

        redirect(base_url("operational/reportrekonsj"));
    }
    public function reportrekonsj()
    {
        $a = $this->db->query('select nta,replace(replace(kode_booking,"-","")," ","") as kode, sum(num_tiket) as jumlah from rekon_pointer group by replace(replace(kode_booking,"-","")," ","")');
        $a = $a->result_array();
        $datatiket = array();
        //echo "<pre>".print_r($a,1)."</pre>";
        foreach ($a as $key) {
            $x = $this->db->query('select kode_booking, nta, num_tiket from rekon_lion where kode_booking="'.$key['kode'].'" and num_tiket<>'.$key['jumlah']);
            $x = $x->row_array();

            if(!empty($x)){
                $arr = array('kode_booking'=>$x['kode_booking'],'num_tiket_lion'=>$x['num_tiket'],
                    'num_tiket_pointer'=>$key['jumlah']);
                $datatiket[] = $arr;
            }
        }

        // $this->db->join('rekon_pointer','rekon_pointer.kode_booking=rekon_lion.kode_booking and rekon_pointer.num_tiket=rekon_lion.num_tiket','inner');
        // $a = $this->db->get('rekon_lion');
        // $data = array();
        // $a = $a->result_array();
        // foreach ($a as $key) {
        //     array_push($data, $key['kode_booking']);
        // }
        // $this->db->select('rekon_lion.kode_booking as kode_lion,rekon_lion.num_tiket as num_lion,rekon_lion.nta as nta_lion, rekon_pointer.nta as nta_pointer,rekon_pointer.kode_booking as kode_pointer,rekon_pointer.num_tiket as num_pointer, rekon_pointer.nta as nta_pointer');
        // $this->db->where_not_in('rekon_lion.kode_booking',$data);
        // $this->db->join('rekon_pointer','rekon_pointer.kode_booking=rekon_lion.kode_booking','inner');
        // $a = $this->db->get('rekon_lion');
        // $a = $a->result_array();
        // $datatiketok = array();
        // foreach ($a as $key) {
        //     $datatiketok[] = array('kode_lion'=>$key['kode_lion'],
        //         'nta_lion'=>$key['nta_lion'],
        //         'num_lion'=>$key['num_lion'],
        //         'kode_pointer'=>$key['kode_pointer'],
        //         'nta_pointer'=>$key['nta_pointer'],
        //         'num_pointer'=>$key['num_pointer']);

        //     array_push($data, $key['kode_lion']);

        //     //echo "sj : ".$key['kode_lion']." ".$key['nta_lion']." ".$key['num_lion']." pointer : ".$key['kode_pointer']." ".$key['nta_pointer']." ".$key['num_pointer'] ."<br>";
        // }

        // $this->db->select('rekon_lion.kode_booking as kode_lion,rekon_lion.num_tiket as num_lion,rekon_lion.nta as nta_lion, rekon_pointer.nta as nta_pointer,rekon_pointer.kode_booking as kode_pointer,rekon_pointer.num_tiket as num_pointer, rekon_pointer.nta as nta_pointer');
        // $this->db->where_not_in('rekon_lion.kode_booking',$data);
        // $this->db->join('rekon_pointer','rekon_pointer.kode_booking=rekon_lion.kode_booking and rekon_pointer.num_tiket=rekon_lion.num_tiket','inner');
        // $a = $this->db->get('rekon_lion');
        // $a = $a->result_array();
        // $datatiketnonnta = array();
        // foreach ($a as $key) {
        //     $datatiketnonnta[] = array('kode_lion'=>$key['kode_lion'],
        //         'nta_lion'=>$key['nta_lion'],
        //         'num_lion'=>$key['num_lion'],
        //         'kode_pointer'=>$key['kode_pointer'],
        //         'nta_pointer'=>$key['nta_pointer'],
        //         'num_pointer'=>$key['num_pointer']);

        //     array_push($data, $key['kode_lion']);

        //     //echo "sj : ".$key['kode_lion']." ".$key['nta_lion']." ".$key['num_lion']." pointer : ".$key['kode_pointer']." ".$key['nta_pointer']." ".$key['num_pointer'] ."<br>";
        // }

        // $this->db->where_not_in('rekon_lion.kode_booking',$data);
        // $a = $this->db->get('rekon_lion');
        // $a = $a->result_array();
        // foreach ($a as $key) {

        //     $datatiketnonpointer[] = array('kode_booking'=>$key['kode_booking'],
        //         'nta'=>$key['nta'],
        //         'num_tiket'=>$key['num_tiket']);

        //     echo $key['kode_booking']." ".$key['nta']." ".$key['num_tiket'] ."<br>";
        // }
        // $this->db->where_not_in('rekon_pointer.kode_booking',$data);
        // $a = $this->db->get('rekon_pointer');
        // $a = $a->result_array();
        // foreach ($a as $key) {

        //     $datatiketnonlion[] = array('kode_booking'=>$key['kode_booking'],
        //         'nta'=>$key['nta'],
        //         'num_tiket'=>$key['num_tiket']);

        //     echo $key['kode_booking']." ".$key['nta']." ".$key['num_tiket'] ."<br>";
        // }

        $data['tiketok'] = $datatiket;
        // $data['tiketnonlion'] = $datatiketnonlion;
        // $data['tiketnonpointer'] = $datatiketnonpointer;
        //$data['tiketnonnta'] = $datatiketnonnta;
        $this->general->load('operational/rekon/hasilrekonsj',$data);
    }
}
