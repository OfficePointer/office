<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Root extends CI_Controller {

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
	public function kirim_email($email)
	{
        $this->general->logging();
		$this->load->library('email');

        $this->email->set_header('X-MC-PreserveRecipients',TRUE);
        $this->email->from('info@copasin.com', 'Copasin.com');
        $this->email->to('arief@pointer.co.id'); 
        //$this->email->bcc($this->general->get_email_div(array('Feedback Service'),false)); 
        //$this->email->bcc('them@their-example.com'); 
        $ss = "<h2>Office Pointer</h2>
        		<hr>
        		<p>Account Information</p>
        		<p>".$email."</p>
        		<p>&nbsp;</p>
        		<div><blockquote style='margin:0px 0px 0px 0.8ex;border-left:1px solid rgb(204,204,204);padding-left:1ex'><span style='font-family:verdana,sans-serif'><span><span><span><b><span><span><span><span><span><span><b>
	 </b></span></span></span></span></span></span></b></span></span></span>
</span><span><span><span><span><span><b>Office Pointer</b></span></span></span></span></span><span><span><span><span></span></span><br><span><span>PT. Pojok Celebes Mandiri</span></span><br><span><span>Jalan Condet Raya No. 333/J Balekambang, Kramat Jati, Jakarta Timur 13530</span></span><br><span><span>Telp. 021 2937 3371 | Fax. 021 2937 3372</span></span><span><span></span></span><br><a href='http://www.pointer.co.id' target='_blank'></a></blockquote></div>";
        $this->email->subject("Office Pointer Account Information");
        $this->email->message($ss);  

        $this->email->send();
	}

	public function logdata()
	{
		$limit = 100;
		$pg = 1;
		$start = 0;
		if($this->uri->segment(3)!=""){
			$pg = $this->uri->segment(3);
			if($pg<=0){
				$pg=1;
			}
			$start = ($pg-1)*$limit;
		}	
		$this->db->limit($limit,$start);
		$this->db->order_by('id','desc');
		$logdata = $this->db->get('logdata')->result_array();
		$data['logdata'] = $logdata;
		$count = $this->db->get('logdata')->num_rows();
		$data['paging'] = $this->general->pagination($count,$limit,$pg,base_url("root/logdata/%d"));
		$this->general->load('root/logdata',$data);
	}
	public function sendmail($idnya)
    {
        $this->general->logging();

        $this->email->from('office@office.pointer.co.id', 'Office Pointer');
        //all service operation
        $this->db->where('ID',$idnya);
        $em = $this->db->get('data_user');
        $em = $em->row_array();
        $this->email->to($em['email']); 
        //only me
        //$this->email->to('arief@pointer.co.id'); 
        $this->email->bcc($this->general->get_email_div(array('Feedback Service'),false)); 
        //$this->email->bcc('them@their-example.com'); 
        $ss = "<h2>Office Pointer</h2>
        		<hr>
        		<p>Account Information</p>
        		<p>Name : ".$em['name']."<br>E-Mail : ".$em['email']."<br>Password : test1234</p>
        		<p>&nbsp;</p>
        		<div><blockquote style='margin:0px 0px 0px 0.8ex;border-left:1px solid rgb(204,204,204);padding-left:1ex'><span style='font-family:verdana,sans-serif'><span><span><span><b><span><span><span><span><span><span><b>
	 </b></span></span></span></span></span></span></b></span></span></span>
</span><span><span><span><span><span><b>Office Pointer</b></span></span></span></span></span><span><span><span><span></span></span><br><span><span>PT. Pojok Celebes Mandiri</span></span><br><span><span>Jalan Condet Raya No. 333/J Balekambang, Kramat Jati, Jakarta Timur 13530</span></span><br><span><span>Telp. 021 2937 3371 | Fax. 021 2937 3372</span></span><span><span></span></span><br><a href='http://www.pointer.co.id' target='_blank'></a></blockquote></div>";
        $this->email->subject("Office Pointer Account Information");
        $this->email->message($ss);  

        $this->email->send();

        redirect(base_url("pengaturan/user_manage"));
        //echo $this->email->print_debugger();
    }
}
