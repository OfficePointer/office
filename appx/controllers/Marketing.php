<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marketing extends CI_Controller {

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
	public function responseadd(){
 		$this->general->load('marketing/member_response_add');
 	}

	public function responsave()
	{
		$dataRespon = $this->input->post();
		$this->db->insert('data_respon',$dataRespon);
		redirect(base_url('marketing/responseall'));
	}

	public function responedit($id){
		$this->db->where('id',$id);
		$dataRespon['dataRespon'] = $this->db->get('data_respon')->row_array();
		$this->general->load('marketing/member_response_edit',$dataRespon);
	}

	public function responupdate()
	{
		$dataRespon = $this->input->post();
		$this->db->where('id',$dataRespon['id']);
		$this->db->update('data_respon',$dataRespon);
		redirect(base_url('marketing/responseall'));
	}

	public function respondelete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('data_respon');
		redirect(base_url('marketing/responseall'));
	}

	public function responseall(){
		$tableRespon = $this->db->get('data_respon');
		$dataRespon['dataRespon'] = $tableRespon->result_array();
		$this->general->load('marketing/member_response_all',$dataRespon);
	}

	//----------------------------------------------------------------------------

	public function classificationadd(){
 		$this->general->load('marketing/member_classification_add');
 	}

	public function classificationsave()
	{
		$dataClassification = $this->input->post();
		$this->db->insert('data_klasifikasi',$dataClassification);
		redirect(base_url('marketing/classificationall'));
	}

	public function classificationedit($id){
		$this->db->where('id',$id);
		$dataClassification['dataClassification'] = $this->db->get('data_klasifikasi')->row_array();
		$this->general->load('marketing/member_classification_edit',$dataClassification);
	}

	public function classificationupdate()
	{
		$dataClassification = $this->input->post();
		$this->db->where('id',$dataClassification['id']);
		$this->db->update('data_klasifikasi',$dataClassification);
		redirect(base_url('marketing/classificationall'));
	}

	public function classificationdelete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('data_klasifikasi');
		redirect(base_url('marketing/classificationall'));
	}

	public function classificationall(){
		$tableClassification = $this->db->get('data_klasifikasi');
		$dataClassification['dataClassification'] = $tableClassification->result_array();
		$this->general->load('marketing/member_classification_all',$dataClassification);
  }

	//----------------------------------------------------------------------------

	public function generate_tanggal()
	{
		$tanggal = $this->input->post('tanggal');
		if(isset($_GET['tanggal'])){
			$tanggal = $_GET['tanggal'];
		}

		$this->general->logging();

		$this->db->where('tanggal',date_format(date_create($tanggal),"Y-m-d"));
		$this->db->delete('airline_member');


		$this->db->select('id_mitra');
		$this->db->where('date_resv',date_format(date_create($tanggal),"Y-m-d"));
		$this->db->group_by('id_mitra');
		$a = $this->db->get('data_trx');
		$a = $a->result_array();
		foreach ($a as $key) {
			$this->db->select('vendor,sum(jml_tiket)');
			$this->db->where('date_resv',date_format(date_create($tanggal),"Y-m-d"));
			$this->db->where('id_mitra',$key['id_mitra']);
			$this->db->group_by('vendor');
			$as = $this->db->get('data_trx');
			$as = $as->result_array();
			foreach ($as as $kay) {
				$data['tanggal'] = date_format(date_create($tanggal),"Y-m-d");
				$data['id_mitra'] = $key['id_mitra'];
				$data['kode'] = $kay['vendor'];
				$data['jumlah'] = $kay['sum(jml_tiket)'];

				$this->db->insert('airline_member',$data);
			}

		}
		echo "Cron ".$tanggal." Finished";

	}
	public function export_member_monthly()
    {
        $this->general->logging();
    					header('Content-type: application/vnd.ms-excel');
				        header('Content-Disposition: attachment; filename=export_member_monthly_'.$_GET['vendor'].'_'.$_GET['klasifikasi'].'_'.$_GET['tahun'].'_by_'.$this->session->userdata('email').'.xls');
						// $this->db->select('airline_member.id_mitra,data_mitra.brand_name,data_mitra.join_date,data_mitra.prefix');
						// $this->db->join('data_mitra','data_mitra.id_mitra=airline_member.id_mitra','left');
						// $this->db->like('kode',$_GET['vendor'],'both');
						// $this->db->like('tanggal',$_GET['tahun']."-".$_GET['bulan']."-",'both');
						// $this->db->group_by('airline_member.id_mitra');
						// $xa = $this->db->get('airline_member');
    	$hasil = array();
		$newdata = array();
    	if($_GET["tahun"]!=""){
    		//$dbpointer = $this->load->database('dbpointer',true);
    // 		$hasil = $dbpointer->query("select join_date, company.id_mitra,brand_name, prefix,
				// (select sum(jml_tiket) from all_selling where all_selling.id_mitra=mitra.id_mitra and date_resv like '".($_GET["tahun"]-1)."-12-%' and jml_tiket<100 and jml_tiket>0) as deslalu ,
				// (select sum(jml_tiket) from all_selling where all_selling.id_mitra=mitra.id_mitra and date_resv like '".$_GET["tahun"]."-01-%' and jml_tiket<100 and jml_tiket>0) as januari ,
				// (select sum(jml_tiket) from all_selling where all_selling.id_mitra=mitra.id_mitra and date_resv like '".$_GET["tahun"]."-02-%' and jml_tiket<100 and jml_tiket>0) as februari ,
				// (select sum(jml_tiket) from all_selling where all_selling.id_mitra=mitra.id_mitra and date_resv like '".$_GET["tahun"]."-03-%' and jml_tiket<100 and jml_tiket>0) as maret ,
				// (select sum(jml_tiket) from all_selling where all_selling.id_mitra=mitra.id_mitra and date_resv like '".$_GET["tahun"]."-04-%' and jml_tiket<100 and jml_tiket>0) as april ,
				// (select sum(jml_tiket) from all_selling where all_selling.id_mitra=mitra.id_mitra and date_resv like '".$_GET["tahun"]."-05-%' and jml_tiket<100 and jml_tiket>0) as mei ,
				// (select sum(jml_tiket) from all_selling where all_selling.id_mitra=mitra.id_mitra and date_resv like '".$_GET["tahun"]."-06-%' and jml_tiket<100 and jml_tiket>0) as juni ,
				// (select sum(jml_tiket) from all_selling where all_selling.id_mitra=mitra.id_mitra and date_resv like '".$_GET["tahun"]."-07-%' and jml_tiket<100 and jml_tiket>0) as juli ,
				// (select sum(jml_tiket) from all_selling where all_selling.id_mitra=mitra.id_mitra and date_resv like '".$_GET["tahun"]."-08-%' and jml_tiket<100 and jml_tiket>0) as agustus ,
				// (select sum(jml_tiket) from all_selling where all_selling.id_mitra=mitra.id_mitra and date_resv like '".$_GET["tahun"]."-09-%' and jml_tiket<100 and jml_tiket>0) as september ,
				// (select sum(jml_tiket) from all_selling where all_selling.id_mitra=mitra.id_mitra and date_resv like '".$_GET["tahun"]."-10-%' and jml_tiket<100 and jml_tiket>0) as oktober ,
				// (select sum(jml_tiket) from all_selling where all_selling.id_mitra=mitra.id_mitra and date_resv like '".$_GET["tahun"]."-11-%' and jml_tiket<100 and jml_tiket>0) as november ,
				// (select sum(jml_tiket) from all_selling where all_selling.id_mitra=mitra.id_mitra and date_resv like '".$_GET["tahun"]."-12-%' and jml_tiket<100 and jml_tiket>0) as desember,
				// (select sum(jml_tiket) from all_selling where all_selling.id_mitra=mitra.id_mitra and date_resv like '".($_GET["tahun"]-1)."-%' and jml_tiket<100 and jml_tiket>0) as tahunlalu
				// from company left join mitra on mitra.id_mitra=company.id_mitra where status='active'");
    		$hasil = $this->db->query("select data_mitra.id_mitra, data_mitra.join_date, data_mitra.brand_name, airline_member.id_mitra as id_, data_mitra.brand_name,
				(select sum(jumlah) from airline_member where tanggal like '".($_GET['tahun']-1)."-12-%' and id_mitra = id_ and kode like '%".$_GET["vendor"]."%') as 'deslalu',
				(select sum(jumlah) from airline_member where tanggal like '".$_GET['tahun']."-01-%' and id_mitra = id_ and kode like '%".$_GET["vendor"]."%') as 'januari',
				(select sum(jumlah) from airline_member where tanggal like '".$_GET['tahun']."-02-%' and id_mitra = id_ and kode like '%".$_GET["vendor"]."%') as 'februari',
				(select sum(jumlah) from airline_member where tanggal like '".$_GET['tahun']."-03-%' and id_mitra = id_ and kode like '%".$_GET["vendor"]."%') as 'maret',
				(select sum(jumlah) from airline_member where tanggal like '".$_GET['tahun']."-04-%' and id_mitra = id_ and kode like '%".$_GET["vendor"]."%') as 'april',
				(select sum(jumlah) from airline_member where tanggal like '".$_GET['tahun']."-05-%' and id_mitra = id_ and kode like '%".$_GET["vendor"]."%') as 'mei',
				(select sum(jumlah) from airline_member where tanggal like '".$_GET['tahun']."-06-%' and id_mitra = id_ and kode like '%".$_GET["vendor"]."%') as 'juni',
				(select sum(jumlah) from airline_member where tanggal like '".$_GET['tahun']."-07-%' and id_mitra = id_ and kode like '%".$_GET["vendor"]."%') as 'juli',
				(select sum(jumlah) from airline_member where tanggal like '".$_GET['tahun']."-08-%' and id_mitra = id_ and kode like '%".$_GET["vendor"]."%') as 'agustus',
				(select sum(jumlah) from airline_member where tanggal like '".$_GET['tahun']."-09-%' and id_mitra = id_ and kode like '%".$_GET["vendor"]."%') as 'september',
				(select sum(jumlah) from airline_member where tanggal like '".$_GET['tahun']."-10-%' and id_mitra = id_ and kode like '%".$_GET["vendor"]."%') as 'oktober',
				(select sum(jumlah) from airline_member where tanggal like '".$_GET['tahun']."-11-%' and id_mitra = id_ and kode like '%".$_GET["vendor"]."%') as 'november',
				(select sum(jumlah) from airline_member where tanggal like '".$_GET['tahun']."-12-%' and id_mitra = id_ and kode like '%".$_GET["vendor"]."%') as 'desember',
				(select sum(jumlah) from airline_member where tanggal like '".($_GET['tahun']-1)."-%' and id_mitra = id_ and kode like '%".$_GET["vendor"]."%') as 'tahunlalu' 
				from airline_member left join data_mitra on data_mitra.id_mitra=airline_member.id_mitra group by id_");
		foreach ($hasil->result_array() as $key) {
			$jum = $key['januari']+$key['februari']+$key['maret']+$key['april']+$key['mei']+
								$key['juni']+$key['juli']+$key['agustus']+$key['september']+$key['oktober']+
								$key['november']+$key['desember'];
			if($jum>0){
				if($_GET['klasifikasi']!=""){
					if($this->general->get_klasifikasi_id($key['id_mitra'],$_GET['tahun']."-12-")==$_GET['klasifikasi']){
				$newdata[] = array($key['join_date'],
						$key['brand_name'],
						isset($key['januari'])?$key['januari']:0,
						($key['deslalu']==0 and $key['januari']==0)?0:(ceil(((($key['deslalu']==0 and $key['januari']>0)?2:$key['januari']/$key['deslalu'])*100)-100)),
						number_format(($key['januari']/31),2),
						isset($key['februari'])?$key['februari']:0,
						($key['januari']==0 and $key['februari']==0)?0:(ceil(((($key['januari']==0 and $key['februari']>0)?2:$key['februari']/$key['januari'])*100)-100)),
						number_format(($key['februari']/(($this->input->post('tahun')%4==0)?29:28)),2),
						isset($key['maret'])?$key['maret']:0,
						($key['februari']==0 and $key['maret']==0)?0:(ceil(((($key['februari']==0 and $key['maret']>0)?2:$key['maret']/$key['februari'])*100)-100)),
						number_format(($key['maret']/31),2),
						isset($key['april'])?$key['april']:0,
						($key['maret']==0 and $key['april']==0)?0:(ceil(((($key['maret']==0 and $key['april']>0)?2:$key['april']/$key['maret'])*100)-100)),
						number_format(($key['april']/30),2),
						isset($key['mei'])?$key['mei']:0,
						($key['april']==0 and $key['mei']==0)?0:(ceil(((($key['april']==0 and $key['mei']>0)?2:$key['mei']/$key['april'])*100)-100)),
						number_format(($key['mei']/31),2),
						isset($key['juni'])?$key['juni']:0,
						($key['mei']==0 and $key['juni']==0)?0:(ceil(((($key['mei']==0 and $key['juni']>0)?2:$key['juni']/$key['mei'])*100)-100)),
						number_format(($key['juni']/30),2),
						isset($key['juli'])?$key['juli']:0,
						($key['juni']==0 and $key['juli']==0)?0:(ceil(((($key['juni']==0 and $key['juli']>0)?2:$key['juli']/$key['juni'])*100)-100)),
						number_format(($key['juli']/31),2),
						isset($key['agustus'])?$key['agustus']:0,
						($key['juli']==0 and $key['agustus']==0)?0:(ceil(((($key['juli']==0 and $key['agustus']>0)?2:$key['agustus']/$key['juli'])*100)-100)),
						number_format(($key['agustus']/31),2),
						isset($key['september'])?$key['september']:0,
						($key['agustus']==0 and $key['september']==0)?0:(ceil(((($key['agustus']==0 and $key['september']>0)?2:$key['september']/$key['agustus'])*100)-100)),
						number_format(($key['september']/30),2),
						isset($key['oktober'])?$key['oktober']:0,
						($key['september']==0 and $key['oktober']==0)?0:(ceil(((($key['september']==0 and $key['oktober']>0)?2:$key['oktober']/$key['september'])*100)-100)),
						number_format(($key['oktober']/31),2),
						isset($key['november'])?$key['november']:0,
						($key['oktober']==0 and $key['november']==0)?0:(ceil(((($key['oktober']==0 and $key['november']>0)?2:$key['november']/$key['oktober'])*100)-100)),
						number_format(($key['november']/30),2),
						isset($key['desember'])?$key['desember']:0,
						($key['november']==0 and $key['desember']==0)?0:(ceil(((($key['november']==0 and $key['desember']>0)?2:$key['desember']/$key['november'])*100)-100)),
						number_format(($key['desember']/31),2),
						$jum,
						($key['tahunlalu']==0 and $jum==0)?0:(ceil(((($key['tahunlalu']==0 and $jum>0)?2:$jum/$key['tahunlalu'])*100)-100)),
						number_format(($jum/(($this->input->post('tahun')%4==0)?366:365)),2),
						$this->general->get_klasifikasi($key['id_mitra'],$_GET['tahun']."-12-"),
					);
					}
					}else{
						$newdata[] = array($key['join_date'],
						$key['brand_name'],
						isset($key['januari'])?$key['januari']:0,
						($key['deslalu']==0 and $key['januari']==0)?0:(ceil(((($key['deslalu']==0 and $key['januari']>0)?2:$key['januari']/$key['deslalu'])*100)-100)),
						number_format(($key['januari']/31),2),
						isset($key['februari'])?$key['februari']:0,
						($key['januari']==0 and $key['februari']==0)?0:(ceil(((($key['januari']==0 and $key['februari']>0)?2:$key['februari']/$key['januari'])*100)-100)),
						number_format(($key['februari']/(($this->input->post('tahun')%4==0)?29:28)),2),
						isset($key['maret'])?$key['maret']:0,
						($key['februari']==0 and $key['maret']==0)?0:(ceil(((($key['februari']==0 and $key['maret']>0)?2:$key['maret']/$key['februari'])*100)-100)),
						number_format(($key['maret']/31),2),
						isset($key['april'])?$key['april']:0,
						($key['maret']==0 and $key['april']==0)?0:(ceil(((($key['maret']==0 and $key['april']>0)?2:$key['april']/$key['maret'])*100)-100)),
						number_format(($key['april']/30),2),
						isset($key['mei'])?$key['mei']:0,
						($key['april']==0 and $key['mei']==0)?0:(ceil(((($key['april']==0 and $key['mei']>0)?2:$key['mei']/$key['april'])*100)-100)),
						number_format(($key['mei']/31),2),
						isset($key['juni'])?$key['juni']:0,
						($key['mei']==0 and $key['juni']==0)?0:(ceil(((($key['mei']==0 and $key['juni']>0)?2:$key['juni']/$key['mei'])*100)-100)),
						number_format(($key['juni']/30),2),
						isset($key['juli'])?$key['juli']:0,
						($key['juni']==0 and $key['juli']==0)?0:(ceil(((($key['juni']==0 and $key['juli']>0)?2:$key['juli']/$key['juni'])*100)-100)),
						number_format(($key['juli']/31),2),
						isset($key['agustus'])?$key['agustus']:0,
						($key['juli']==0 and $key['agustus']==0)?0:(ceil(((($key['juli']==0 and $key['agustus']>0)?2:$key['agustus']/$key['juli'])*100)-100)),
						number_format(($key['agustus']/31),2),
						isset($key['september'])?$key['september']:0,
						($key['agustus']==0 and $key['september']==0)?0:(ceil(((($key['agustus']==0 and $key['september']>0)?2:$key['september']/$key['agustus'])*100)-100)),
						number_format(($key['september']/30),2),
						isset($key['oktober'])?$key['oktober']:0,
						($key['september']==0 and $key['oktober']==0)?0:(ceil(((($key['september']==0 and $key['oktober']>0)?2:$key['oktober']/$key['september'])*100)-100)),
						number_format(($key['oktober']/31),2),
						isset($key['november'])?$key['november']:0,
						($key['oktober']==0 and $key['november']==0)?0:(ceil(((($key['oktober']==0 and $key['november']>0)?2:$key['november']/$key['oktober'])*100)-100)),
						number_format(($key['november']/30),2),
						isset($key['desember'])?$key['desember']:0,
						($key['november']==0 and $key['desember']==0)?0:(ceil(((($key['november']==0 and $key['desember']>0)?2:$key['desember']/$key['november'])*100)-100)),
						number_format(($key['desember']/31),2),
						$jum,
						($key['tahunlalu']==0 and $jum==0)?0:(ceil(((($key['tahunlalu']==0 and $jum>0)?2:$jum/$key['tahunlalu'])*100)-100)),
						number_format(($jum/(($this->input->post('tahun')%4==0)?366:365)),2),
						$this->general->get_klasifikasi($key['id_mitra'],$_GET['tahun']."-12-"),
					);
					}
				}
		}
    	}
						//echo $this->db->last_query();
						echo "<table><thead>";
						echo "<th>Join Date</th>";
						echo "<th>Klasifikasi</th>";
						echo "<th>Brand Name</th>";
						echo "<th>Jan</th>";
						echo "<th>%</th>";
						echo "<th>A</th>";
						echo "<th>Feb</th>";
						echo "<th>%</th>";
						echo "<th>A</th>";
						echo "<th>Mar</th>";
						echo "<th>%</th>";
						echo "<th>A</th>";
						echo "<th>Apr</th>";
						echo "<th>%</th>";
						echo "<th>A</th>";
						echo "<th>Mei</th>";
						echo "<th>%</th>";
						echo "<th>A</th>";
						echo "<th>Jun</th>";
						echo "<th>%</th>";
						echo "<th>A</th>";
						echo "<th>Jul</th>";
						echo "<th>%</th>";
						echo "<th>A</th>";
						echo "<th>Agu</th>";
						echo "<th>%</th>";
						echo "<th>A</th>";
						echo "<th>Sep</th>";
						echo "<th>%</th>";
						echo "<th>A</th>";
						echo "<th>Okt</th>";
						echo "<th>%</th>";
						echo "<th>A</th>";
						echo "<th>Nov</th>";
						echo "<th>%</th>";
						echo "<th>A</th>";
						echo "<th>Des</th>";
						echo "<th>%</th>";
						echo "<th>A</th>";
						echo "<th>Total</th>";
						echo "<th>%</th>";
						echo "<th>A</th>";
						echo "</thead><tbody>";
						foreach($newdata as $datanya) {
							$total = 0;
						echo "<tr>";
						echo "<td>".utf8_decode($datanya[0])."</td>";
						echo "<td>".utf8_decode($datanya[41])."</td>";
						echo "<td>".utf8_decode($datanya[1])."</td>";
						echo "<td>".utf8_decode($datanya[2])."</td>";
						echo "<td>".utf8_decode($datanya[3])."</td>";
						echo "<td>".utf8_decode($datanya[4])."</td>";
						echo "<td>".utf8_decode($datanya[5])."</td>";
						echo "<td>".utf8_decode($datanya[6])."</td>";
						echo "<td>".utf8_decode($datanya[7])."</td>";
						echo "<td>".utf8_decode($datanya[8])."</td>";
						echo "<td>".utf8_decode($datanya[9])."</td>";
						echo "<td>".utf8_decode($datanya[10])."</td>";
						echo "<td>".utf8_decode($datanya[11])."</td>";
						echo "<td>".utf8_decode($datanya[12])."</td>";
						echo "<td>".utf8_decode($datanya[13])."</td>";
						echo "<td>".utf8_decode($datanya[14])."</td>";
						echo "<td>".utf8_decode($datanya[15])."</td>";
						echo "<td>".utf8_decode($datanya[16])."</td>";
						echo "<td>".utf8_decode($datanya[17])."</td>";
						echo "<td>".utf8_decode($datanya[18])."</td>";
						echo "<td>".utf8_decode($datanya[19])."</td>";
						echo "<td>".utf8_decode($datanya[20])."</td>";
						echo "<td>".utf8_decode($datanya[21])."</td>";
						echo "<td>".utf8_decode($datanya[22])."</td>";
						echo "<td>".utf8_decode($datanya[23])."</td>";
						echo "<td>".utf8_decode($datanya[24])."</td>";
						echo "<td>".utf8_decode($datanya[25])."</td>";
						echo "<td>".utf8_decode($datanya[26])."</td>";
						echo "<td>".utf8_decode($datanya[27])."</td>";
						echo "<td>".utf8_decode($datanya[28])."</td>";
						echo "<td>".utf8_decode($datanya[29])."</td>";
						echo "<td>".utf8_decode($datanya[30])."</td>";
						echo "<td>".utf8_decode($datanya[31])."</td>";
						echo "<td>".utf8_decode($datanya[32])."</td>";
						echo "<td>".utf8_decode($datanya[33])."</td>";
						echo "<td>".utf8_decode($datanya[34])."</td>";
						echo "<td>".utf8_decode($datanya[35])."</td>";
						echo "<td>".utf8_decode($datanya[36])."</td>";
						echo "<td>".utf8_decode($datanya[37])."</td>";
						echo "<td>".utf8_decode($datanya[38])."</td>";
						echo "<td>".utf8_decode($datanya[39])."</td>";
						echo "<td>".utf8_decode($datanya[40])."</td>";
						echo "</tr>";
						}
						echo "</tbody></table>";
    }
	public function member_monthly()
    {
    	$hasil = array();
    	if($this->input->post("tahun")!=""){
    	$hasil = $this->db->query("select data_mitra.join_date, data_mitra.id_mitra, data_mitra.brand_name, airline_member.id_mitra as id_, data_mitra.brand_name,
		(select sum(jumlah) from airline_member where tanggal like '".($this->input->post('tahun')-1)."-12-%' and id_mitra = id_ and kode like '%".$this->input->post("vendor")."%') as 'deslalu',
		(select sum(jumlah) from airline_member where tanggal like '".$this->input->post('tahun')."-01-%' and id_mitra = id_ and kode like '%".$this->input->post("vendor")."%') as 'januari',
		(select sum(jumlah) from airline_member where tanggal like '".$this->input->post('tahun')."-02-%' and id_mitra = id_ and kode like '%".$this->input->post("vendor")."%') as 'februari',
		(select sum(jumlah) from airline_member where tanggal like '".$this->input->post('tahun')."-03-%' and id_mitra = id_ and kode like '%".$this->input->post("vendor")."%') as 'maret',
		(select sum(jumlah) from airline_member where tanggal like '".$this->input->post('tahun')."-04-%' and id_mitra = id_ and kode like '%".$this->input->post("vendor")."%') as 'april',
		(select sum(jumlah) from airline_member where tanggal like '".$this->input->post('tahun')."-05-%' and id_mitra = id_ and kode like '%".$this->input->post("vendor")."%') as 'mei',
		(select sum(jumlah) from airline_member where tanggal like '".$this->input->post('tahun')."-06-%' and id_mitra = id_ and kode like '%".$this->input->post("vendor")."%') as 'juni',
		(select sum(jumlah) from airline_member where tanggal like '".$this->input->post('tahun')."-07-%' and id_mitra = id_ and kode like '%".$this->input->post("vendor")."%') as 'juli',
		(select sum(jumlah) from airline_member where tanggal like '".$this->input->post('tahun')."-08-%' and id_mitra = id_ and kode like '%".$this->input->post("vendor")."%') as 'agustus',
		(select sum(jumlah) from airline_member where tanggal like '".$this->input->post('tahun')."-09-%' and id_mitra = id_ and kode like '%".$this->input->post("vendor")."%') as 'september',
		(select sum(jumlah) from airline_member where tanggal like '".$this->input->post('tahun')."-10-%' and id_mitra = id_ and kode like '%".$this->input->post("vendor")."%') as 'oktober',
		(select sum(jumlah) from airline_member where tanggal like '".$this->input->post('tahun')."-11-%' and id_mitra = id_ and kode like '%".$this->input->post("vendor")."%') as 'november',
		(select sum(jumlah) from airline_member where tanggal like '".$this->input->post('tahun')."-12-%' and id_mitra = id_ and kode like '%".$this->input->post("vendor")."%') as 'desember',
		(select sum(jumlah) from airline_member where tanggal like '".($this->input->post('tahun')-1)."-%' and id_mitra = id_ and kode like '%".$this->input->post("vendor")."%') as 'tahunlalu' 
		from airline_member left join data_mitra on data_mitra.id_mitra=airline_member.id_mitra group by id_");
    // 		$dbpointer = $this->load->database('dbpointer',true);
    // 		$hasil = $dbpointer->query("select join_date,company.id_mitra,brand_name, prefix,
				// (select sum(jml_tiket) from all_selling where all_selling.id_mitra=mitra.id_mitra and date_resv like '".($this->input->post("tahun")-1)."-12-%' and jml_tiket<100 and jml_tiket>0) as deslalu ,
				// (select sum(jml_tiket) from all_selling where all_selling.id_mitra=mitra.id_mitra and date_resv like '".$this->input->post("tahun")."-01-%' and jml_tiket<100 and jml_tiket>0) as januari ,
				// (select sum(jml_tiket) from all_selling where all_selling.id_mitra=mitra.id_mitra and date_resv like '".$this->input->post("tahun")."-02-%' and jml_tiket<100 and jml_tiket>0) as februari ,
				// (select sum(jml_tiket) from all_selling where all_selling.id_mitra=mitra.id_mitra and date_resv like '".$this->input->post("tahun")."-03-%' and jml_tiket<100 and jml_tiket>0) as maret ,
				// (select sum(jml_tiket) from all_selling where all_selling.id_mitra=mitra.id_mitra and date_resv like '".$this->input->post("tahun")."-04-%' and jml_tiket<100 and jml_tiket>0) as april ,
				// (select sum(jml_tiket) from all_selling where all_selling.id_mitra=mitra.id_mitra and date_resv like '".$this->input->post("tahun")."-05-%' and jml_tiket<100 and jml_tiket>0) as mei ,
				// (select sum(jml_tiket) from all_selling where all_selling.id_mitra=mitra.id_mitra and date_resv like '".$this->input->post("tahun")."-06-%' and jml_tiket<100 and jml_tiket>0) as juni ,
				// (select sum(jml_tiket) from all_selling where all_selling.id_mitra=mitra.id_mitra and date_resv like '".$this->input->post("tahun")."-07-%' and jml_tiket<100 and jml_tiket>0) as juli ,
				// (select sum(jml_tiket) from all_selling where all_selling.id_mitra=mitra.id_mitra and date_resv like '".$this->input->post("tahun")."-08-%' and jml_tiket<100 and jml_tiket>0) as agustus ,
				// (select sum(jml_tiket) from all_selling where all_selling.id_mitra=mitra.id_mitra and date_resv like '".$this->input->post("tahun")."-09-%' and jml_tiket<100 and jml_tiket>0) as september ,
				// (select sum(jml_tiket) from all_selling where all_selling.id_mitra=mitra.id_mitra and date_resv like '".$this->input->post("tahun")."-10-%' and jml_tiket<100 and jml_tiket>0) as oktober ,
				// (select sum(jml_tiket) from all_selling where all_selling.id_mitra=mitra.id_mitra and date_resv like '".$this->input->post("tahun")."-11-%' and jml_tiket<100 and jml_tiket>0) as november ,
				// (select sum(jml_tiket) from all_selling where all_selling.id_mitra=mitra.id_mitra and date_resv like '".$this->input->post("tahun")."-12-%' and jml_tiket<100 and jml_tiket>0) as desember,
				// (select sum(jml_tiket) from all_selling where all_selling.id_mitra=mitra.id_mitra and date_resv like '".($this->input->post("tahun")-1)."-%' and jml_tiket<100 and jml_tiket>0) as tahunlalu
				// from company left join mitra on mitra.id_mitra=company.id_mitra where status='active'");
		$newdata = array();
		foreach ($hasil->result_array() as $key) {
			$jum = $key['januari']+$key['februari']+$key['maret']+$key['april']+$key['mei']+
								$key['juni']+$key['juli']+$key['agustus']+$key['september']+$key['oktober']+
								$key['november']+$key['desember'];
			if($jum>0){
				if($this->input->post('klasifikasi')!=""){
					if($this->general->get_klasifikasi_id($key['id_mitra'],$this->input->post('tahun')."-12-")==$this->input->post('klasifikasi')){
				$newdata[] = array($key['join_date'],
						$key['brand_name'],
						isset($key['januari'])?$key['januari']:0,
						($key['deslalu']==0 and $key['januari']==0)?0:(ceil(((($key['deslalu']==0 and $key['januari']>0)?2:$key['januari']/$key['deslalu'])*100)-100)),
						number_format(($key['januari']/31),2),
						isset($key['februari'])?$key['februari']:0,
						($key['januari']==0 and $key['februari']==0)?0:(ceil(((($key['januari']==0 and $key['februari']>0)?2:$key['februari']/$key['januari'])*100)-100)),
						number_format(($key['februari']/(($this->input->post('tahun')%4==0)?29:28)),2),
						isset($key['maret'])?$key['maret']:0,
						($key['februari']==0 and $key['maret']==0)?0:(ceil(((($key['februari']==0 and $key['maret']>0)?2:$key['maret']/$key['februari'])*100)-100)),
						number_format(($key['maret']/31),2),
						isset($key['april'])?$key['april']:0,
						($key['maret']==0 and $key['april']==0)?0:(ceil(((($key['maret']==0 and $key['april']>0)?2:$key['april']/$key['maret'])*100)-100)),
						number_format(($key['april']/30),2),
						isset($key['mei'])?$key['mei']:0,
						($key['april']==0 and $key['mei']==0)?0:(ceil(((($key['april']==0 and $key['mei']>0)?2:$key['mei']/$key['april'])*100)-100)),
						number_format(($key['mei']/31),2),
						isset($key['juni'])?$key['juni']:0,
						($key['mei']==0 and $key['juni']==0)?0:(ceil(((($key['mei']==0 and $key['juni']>0)?2:$key['juni']/$key['mei'])*100)-100)),
						number_format(($key['juni']/30),2),
						isset($key['juli'])?$key['juli']:0,
						($key['juni']==0 and $key['juli']==0)?0:(ceil(((($key['juni']==0 and $key['juli']>0)?2:$key['juli']/$key['juni'])*100)-100)),
						number_format(($key['juli']/31),2),
						isset($key['agustus'])?$key['agustus']:0,
						($key['juli']==0 and $key['agustus']==0)?0:(ceil(((($key['juli']==0 and $key['agustus']>0)?2:$key['agustus']/$key['juli'])*100)-100)),
						number_format(($key['agustus']/31),2),
						isset($key['september'])?$key['september']:0,
						($key['agustus']==0 and $key['september']==0)?0:(ceil(((($key['agustus']==0 and $key['september']>0)?2:$key['september']/$key['agustus'])*100)-100)),
						number_format(($key['september']/30),2),
						isset($key['oktober'])?$key['oktober']:0,
						($key['september']==0 and $key['oktober']==0)?0:(ceil(((($key['september']==0 and $key['oktober']>0)?2:$key['oktober']/$key['september'])*100)-100)),
						number_format(($key['oktober']/31),2),
						isset($key['november'])?$key['november']:0,
						($key['oktober']==0 and $key['november']==0)?0:(ceil(((($key['oktober']==0 and $key['november']>0)?2:$key['november']/$key['oktober'])*100)-100)),
						number_format(($key['november']/30),2),
						isset($key['desember'])?$key['desember']:0,
						($key['november']==0 and $key['desember']==0)?0:(ceil(((($key['november']==0 and $key['desember']>0)?2:$key['desember']/$key['november'])*100)-100)),
						number_format(($key['desember']/31),2),
						$jum,
						($key['tahunlalu']==0 and $jum==0)?0:(ceil(((($key['tahunlalu']==0 and $jum>0)?2:$jum/$key['tahunlalu'])*100)-100)),
						number_format(($jum/(($this->input->post('tahun')%4==0)?366:365)),2),
						$this->general->get_klasifikasi($key['id_mitra'],$this->input->post('tahun')."-12-"),
					);
					}
					}else{
						$newdata[] = array($key['join_date'],
						$key['brand_name'],
						isset($key['januari'])?$key['januari']:0,
						($key['deslalu']==0 and $key['januari']==0)?0:(ceil(((($key['deslalu']==0 and $key['januari']>0)?2:$key['januari']/$key['deslalu'])*100)-100)),
						number_format(($key['januari']/31),2),
						isset($key['februari'])?$key['februari']:0,
						($key['januari']==0 and $key['februari']==0)?0:(ceil(((($key['januari']==0 and $key['februari']>0)?2:$key['februari']/$key['januari'])*100)-100)),
						number_format(($key['februari']/(($this->input->post('tahun')%4==0)?29:28)),2),
						isset($key['maret'])?$key['maret']:0,
						($key['februari']==0 and $key['maret']==0)?0:(ceil(((($key['februari']==0 and $key['maret']>0)?2:$key['maret']/$key['februari'])*100)-100)),
						number_format(($key['maret']/31),2),
						isset($key['april'])?$key['april']:0,
						($key['maret']==0 and $key['april']==0)?0:(ceil(((($key['maret']==0 and $key['april']>0)?2:$key['april']/$key['maret'])*100)-100)),
						number_format(($key['april']/30),2),
						isset($key['mei'])?$key['mei']:0,
						($key['april']==0 and $key['mei']==0)?0:(ceil(((($key['april']==0 and $key['mei']>0)?2:$key['mei']/$key['april'])*100)-100)),
						number_format(($key['mei']/31),2),
						isset($key['juni'])?$key['juni']:0,
						($key['mei']==0 and $key['juni']==0)?0:(ceil(((($key['mei']==0 and $key['juni']>0)?2:$key['juni']/$key['mei'])*100)-100)),
						number_format(($key['juni']/30),2),
						isset($key['juli'])?$key['juli']:0,
						($key['juni']==0 and $key['juli']==0)?0:(ceil(((($key['juni']==0 and $key['juli']>0)?2:$key['juli']/$key['juni'])*100)-100)),
						number_format(($key['juli']/31),2),
						isset($key['agustus'])?$key['agustus']:0,
						($key['juli']==0 and $key['agustus']==0)?0:(ceil(((($key['juli']==0 and $key['agustus']>0)?2:$key['agustus']/$key['juli'])*100)-100)),
						number_format(($key['agustus']/31),2),
						isset($key['september'])?$key['september']:0,
						($key['agustus']==0 and $key['september']==0)?0:(ceil(((($key['agustus']==0 and $key['september']>0)?2:$key['september']/$key['agustus'])*100)-100)),
						number_format(($key['september']/30),2),
						isset($key['oktober'])?$key['oktober']:0,
						($key['september']==0 and $key['oktober']==0)?0:(ceil(((($key['september']==0 and $key['oktober']>0)?2:$key['oktober']/$key['september'])*100)-100)),
						number_format(($key['oktober']/31),2),
						isset($key['november'])?$key['november']:0,
						($key['oktober']==0 and $key['november']==0)?0:(ceil(((($key['oktober']==0 and $key['november']>0)?2:$key['november']/$key['oktober'])*100)-100)),
						number_format(($key['november']/30),2),
						isset($key['desember'])?$key['desember']:0,
						($key['november']==0 and $key['desember']==0)?0:(ceil(((($key['november']==0 and $key['desember']>0)?2:$key['desember']/$key['november'])*100)-100)),
						number_format(($key['desember']/31),2),
						$jum,
						($key['tahunlalu']==0 and $jum==0)?0:(ceil(((($key['tahunlalu']==0 and $jum>0)?2:$jum/$key['tahunlalu'])*100)-100)),
						number_format(($jum/(($this->input->post('tahun')%4==0)?366:365)),2),
						$this->general->get_klasifikasi($key['id_mitra'],$this->input->post('tahun')."-12-"),
					);
					}
				}
			}
			$hasil = array('data'=>$newdata);
    	}


    	$this->general->load('marketing/member_monthly',$hasil);
    }

    public function member_monthly_v2()
    {
    	if($this->input->post('tahun')!=""){
    		$a = $this->db->query("select airline_member.id_mitra as id_, data_mitra.brand_name,
		(select sum(jumlah) from airline_member where tanggal like '2015-01-%' and id_mitra = id_ and ) as 'Januari',
		(select sum(jumlah) from airline_member where tanggal like '2015-02-%' and id_mitra = id_) as 'Februari',
		(select sum(jumlah) from airline_member where tanggal like '2015-03-%' and id_mitra = id_) as 'Maret',
		(select sum(jumlah) from airline_member where tanggal like '2015-04-%' and id_mitra = id_) as 'April',
		(select sum(jumlah) from airline_member where tanggal like '2015-05-%' and id_mitra = id_) as 'Mei',
		(select sum(jumlah) from airline_member where tanggal like '2015-06-%' and id_mitra = id_) as 'Juni',
		(select sum(jumlah) from airline_member where tanggal like '2015-07-%' and id_mitra = id_) as 'Juli',
		(select sum(jumlah) from airline_member where tanggal like '2015-08-%' and id_mitra = id_) as 'Agustus',
		(select sum(jumlah) from airline_member where tanggal like '2015-09-%' and id_mitra = id_) as 'September',
		(select sum(jumlah) from airline_member where tanggal like '2015-10-%' and id_mitra = id_) as 'Oktober',
		(select sum(jumlah) from airline_member where tanggal like '2015-11-%' and id_mitra = id_) as 'November',
		(select sum(jumlah) from airline_member where tanggal like '2015-12-%' and id_mitra = id_) as 'Desember' 
		from airline_member left join data_mitra on data_mitra.id_mitra=airline_member.id_mitra group by id_");
			print_r($a);
    	}


    	$this->general->load('marketing/member_monthly_v2');
    }
	public function member_summary()
	{
		$this->db->select('data_mitra.brand_name,temp_trx.date_join,temp_trx.updated_at,temp_trx.jumlah,temp_trx.umur');
		$this->db->join('data_mitra','data_mitra.id_mitra=temp_trx.id_mitra','left');
		$this->db->order_by('temp_trx.id_mitra','desc');
		$dat = $this->db->get('temp_trx');
		$dat = $dat->result_array();
		$data['membersummary'] = $dat;
		$this->general->load('marketing/member_summary',$data);
	}

	public function member_statistic(){
		$this->db->select('type, count(id_mitra) as jumlah');
		$this->db->where('status','active');
		$this->db->order_by('jumlah','desc');
		$this->db->group_by('type');
		$a = $this->db->get('data_mitra');
		$data['pertype'] = $a->result_array();
		$a = $this->db->query("select id_mitra,id_mitra as idnya, brand_name, prefix,(select count(id_mitra) from data_mitra where parent = idnya and `status`='active') as jumlah from data_mitra where type = 'Mitra' and `status` = 'active' order by jumlah desc");
		$data['mitrasub'] = $a->result_array();
		$this->general->load('marketing/member_statistic',$data);
	}
	public function member($new='')
	{
		if($new=="clear" or $new=="new"){
			$this->session->set_userdata('brand_name','');
			$this->session->set_userdata('date_join_start','');
			$this->session->set_userdata('date_join_end','');
			$this->session->set_userdata('prefix','');
			$this->session->set_userdata('province','');
			$this->session->set_userdata('type','');
			$this->session->set_userdata('status','');
			$this->session->set_userdata('klasifikasi','');
		}

		if($this->input->method()=="post"){
		if($this->input->post('brand_name')!=""){
			$this->session->set_userdata('brand_name',$this->input->post('brand_name'));
		}else{
			$this->session->set_userdata('brand_name','');
		}
		if($this->input->post('date_join')!=""){
			$daten = explode(" - ",$this->input->post('date_join'));
			$this->session->set_userdata('date_join_start',$daten[0]);
			$this->session->set_userdata('date_join_end',$daten[1]);
		}else{
			$this->session->set_userdata('date_join_start','');
			$this->session->set_userdata('date_join_end','');
		}
		if($this->input->post('prefix')!=""){
			$this->session->set_userdata('prefix',$this->input->post('prefix'));
		}else{
			$this->session->set_userdata('prefix','');
		}
		if($this->input->post('province')!=""){
			$this->session->set_userdata('province',$this->input->post('province'));
		}else{
			$this->session->set_userdata('province','');
		}
		if($this->input->post('type')!=""){
			$this->session->set_userdata('type',$this->input->post('type'));
		}else{
			$this->session->set_userdata('type','');
		}
		if($this->input->post('status')!=""){
			$this->session->set_userdata('status',$this->input->post('status'));
		}else{
			$this->session->set_userdata('status','');
		}
		if($this->input->post('klasifikasi')!=""){
			$this->session->set_userdata('klasifikasi',$this->input->post('klasifikasi'));
		}else{
			$this->session->set_userdata('klasifikasi','');
		}

		}


		$limit = 10;
		$pg = 1;
		$start = 0;
		if($this->uri->segment(3)!=""){
			$pg = $this->uri->segment(3);
			if($pg<=0){
				$pg=1;
			}
			$start = ($pg-1)*$limit;
		}
		
		$this->db->select("data_mitra.*,data_klasifikasi.klasifikasi, data_klasifikasi.id as id_klasifikasi");
		$this->db->join('klasifikasi_member k1','k1.id_mitra=data_mitra.id_mitra','left');
		$this->db->join('klasifikasi_member k2','k2.id_mitra=data_mitra.id_mitra and k1.id<k2.id','left outer');
		$this->db->join('data_klasifikasi','data_klasifikasi.id=k1.id_klasifikasi','left');
		$this->db->where('k2.id',NULL);
		if($this->session->userdata('brand_name')!=""){
			$this->db->like('brand_name',$this->session->userdata('brand_name'),'both');
		}
		if($this->session->userdata('prefix')!=""){
			$this->db->like('prefix',$this->session->userdata('prefix'),'both');
		}
		if($this->session->userdata('date_join_start')!=""){
			$this->db->where('join_date>=',date_format(date_create($this->session->userdata('date_join_start')),"Y-m-d"));
		}
		if($this->session->userdata('date_join_end')!=""){
			$this->db->where('join_date<=',date_format(date_create($this->session->userdata('date_join_end')),"Y-m-d"));
		}
		if($this->session->userdata('status')!=""){
			$this->db->where('status',$this->session->userdata('status'));
		}
		if($this->session->userdata('province')!=""){
			$this->db->like('data_mitra.province',$this->session->userdata('province'));
		}
		if($this->session->userdata('type')!=""){
			$this->db->where('data_mitra.type',$this->session->userdata('type'));
		}
		if($this->session->userdata('klasifikasi')!=""){
			if($this->session->userdata('klasifikasi')==0){
				$this->db->where('data_klasifikasi.id',NULL);
			}else{
				$this->db->where('data_klasifikasi.id',$this->session->userdata('klasifikasi'));
			}
		}
		if($new=="new"){
			$this->db->where('data_mitra.join_date >',date('Y-m-d',strtotime('-3 day')));
		}else{
			$this->db->limit($limit,$start);
		}
		//$this->db->group_by('id_mitra');


		$data['mitra'] = $this->db->get('data_mitra')->result_array();
		
// 		echo "<pre>".print_r($this->db->last_query(),1)."<pre>";
// die();

		$this->db->select('count(data_mitra.id_mitra) as jumlah, status');
		$this->db->join('klasifikasi_member k1','k1.id_mitra=data_mitra.id_mitra','left');
		$this->db->join('klasifikasi_member k2','k2.id_mitra=data_mitra.id_mitra and k1.id<k2.id','left outer');
		$this->db->join('data_klasifikasi','data_klasifikasi.id=k1.id_klasifikasi','left');
		$this->db->where('k2.id',NULL);
		if($new=="new"){
			$this->db->where('data_mitra.join_date >',date('Y-m-d',strtotime('-3 day')));
		}
		if($this->session->userdata('brand_name')!=""){
			$this->db->like('brand_name',$this->session->userdata('brand_name'),'both');
		}
		if($this->session->userdata('prefix')!=""){
			$this->db->like('prefix',$this->session->userdata('prefix'),'both');
		}
		if($this->session->userdata('date_join_start')!=""){
			$this->db->where('join_date>=',date_format(date_create($this->session->userdata('date_join_start')),"Y-m-d"));
		}
		if($this->session->userdata('date_join_end')!=""){
			$this->db->where('join_date<=',date_format(date_create($this->session->userdata('date_join_end')),"Y-m-d"));
		}
		if($this->session->userdata('status')!=""){
			$this->db->where('status',$this->session->userdata('status'));
		}
		if($this->session->userdata('province')!=""){
			$this->db->like('data_mitra.province',$this->session->userdata('province'));
		}
		if($this->session->userdata('type')!=""){
			$this->db->where('data_mitra.type',$this->session->userdata('type'));
		}
		if($this->session->userdata('klasifikasi')!=""){
			if($this->session->userdata('klasifikasi')==0){
				$this->db->where('data_klasifikasi.id',NULL);
			}else{
				$this->db->where('data_klasifikasi.id',$this->session->userdata('klasifikasi'));
			}
		}
		$this->db->group_by('status');
		$jum = 0;
		$data['summary'] = $this->db->get('data_mitra')->result_array();
		foreach($data['summary'] as $keya){
			$jum+=$keya['jumlah'];
		}


		$data['paging'] = $this->general->pagination($jum,$limit,$pg,base_url("marketing/member/%d"));
		$data['klasifikasi'] = $this->db->get('data_klasifikasi')->result_array();
		

		$this->general->load('marketing/member',$data);
	}
	public function followup_all($new='')
	{
		//echo "<pre>".print_r($this->session->userdata(),1)."</pre>";
		if($new=="clear"){
			$this->session->set_userdata('followup_brand_name','');
			$this->session->set_userdata('followup_date_activity','');
			$this->session->set_userdata('followup_date_join','');
			$this->session->set_userdata('followup_prefix','');
			$this->session->set_userdata('followup_province','');
			$this->session->set_userdata('followup_type','');
			$this->session->set_userdata('followup_status','');
			$this->session->set_userdata('followup_topup','');
			$this->session->set_userdata('followup_trx','');
			$this->session->set_userdata('followup_respon','');
			$this->session->set_userdata('followup_klasifikasi','');
		}

		if($this->input->method()=="post"){
		if($this->input->post('brand_name')!=""){
			$this->session->set_userdata('followup_brand_name',$this->input->post('brand_name'));
		}else{
			$this->session->set_userdata('followup_brand_name','');
		}
		if($this->input->post('id_respon')!=""){
			$this->session->set_userdata('followup_respon',$this->input->post('id_respon'));
		}else{
			$this->session->set_userdata('followup_respon','');
		}
		if($this->input->post('topup')!=""){
			$this->session->set_userdata('followup_topup',$this->input->post('topup'));
		}else{
			$this->session->set_userdata('followup_topup','');
		}
		if($this->input->post('trx')!=""){
			$this->session->set_userdata('followup_trx',$this->input->post('trx'));
		}else{
			$this->session->set_userdata('followup_trx','');
		}
		if($this->input->post('date_activity')!="" and $this->input->post('date_activity')!=" - "){
			$this->session->set_userdata('followup_date_activity',$this->input->post('date_activity'));
		}else{
			$this->session->set_userdata('followup_date_activity','');
		}
		if($this->input->post('date_join')!="" and $this->input->post('date_join')!=" - "){
			$this->session->set_userdata('followup_date_join',$this->input->post('date_join'));
		}else{
			$this->session->set_userdata('followup_date_join','');
		}
		if($this->input->post('prefix')!=""){
			$this->session->set_userdata('followup_prefix',$this->input->post('prefix'));
		}else{
			$this->session->set_userdata('followup_prefix','');
		}
		if($this->input->post('type')!=""){
			$this->session->set_userdata('followup_type',$this->input->post('type'));
		}else{
			$this->session->set_userdata('followup_type','');
		}
		if($this->input->post('status')!=""){
			$this->session->set_userdata('followup_status',$this->input->post('status'));
		}else{
			$this->session->set_userdata('followup_status','');
		}
		if($this->input->post('province')!=""){
			$this->session->set_userdata('followup_province',$this->input->post('province'));
		}else{
			$this->session->set_userdata('followup_province','');
		}
		if($this->input->post('klasifikasi')!=""){
			$this->session->set_userdata('followup_klasifikasi',$this->input->post('klasifikasi'));
		}else{
			$this->session->set_userdata('followup_klasifikasi','');
		}

		}

		$limit = 10;
		$pg = 1;
		$start = 0;
		if($this->uri->segment(3)!=""){
			$pg = $this->uri->segment(3);
			if($pg<=0){
				$pg=1;
			}
			$start = ($pg-1)*$limit;
		}
		$this->db->select('data_mitra.brand_name,data_mitra.id_mitra,data_mitra.topup,data_mitra.trx,data_mitra.join_date,data_klasifikasi.klasifikasi, a1.reason, a1.type,data_respon.respon');
		$this->db->join('data_mitra','data_mitra.id_mitra=data_activity.member_ID','right');
		$this->db->join('klasifikasi_member k1','k1.id_mitra=data_mitra.id_mitra','left');
		$this->db->join('klasifikasi_member k2','k2.id_mitra=data_mitra.id_mitra and k1.id<k2.id','left outer');
		$this->db->join('data_klasifikasi','data_klasifikasi.id=k1.id_klasifikasi','left');
		$this->db->join('data_activity a1','a1.member_ID=data_mitra.id_mitra','left');
		$this->db->join('data_activity a2','a2.member_ID=data_mitra.id_mitra and a1.ID<a2.ID and ISNULL(a1.delete_at)','left outer');
		$this->db->join('data_respon','data_respon.id=a1.id_respon','left');
		$this->db->where('k2.id',NULL);
		$this->db->where('a2.ID',NULL);
		
		if($this->session->userdata('followup_date_activity')!=""){
			$daten = explode(" - ", $this->session->userdata('followup_date_activity'));
			$date_start = $daten[0];
			$date_end = $daten[1];
			$this->db->where('data_activity.create_at>=',date_format(date_create($date_start),"Y-m-d"));
			$this->db->where('data_activity.create_at<=',date_format(date_create($date_end),"Y-m-d"));
		}
		if($this->session->userdata('followup_date_join')!=""){
			$daten = explode(" - ", $this->session->userdata('followup_date_join'));
			$date_start = $daten[0];
			$date_end = $daten[1];
			$this->db->where('data_mitra.join_date>=',date_format(date_create($date_start),"Y-m-d"));
			$this->db->where('data_mitra.join_date<=',date_format(date_create($date_end),"Y-m-d"));
		}
		if($this->session->userdata('followup_brand_name')!=""){
			$this->db->like('data_mitra.brand_name',$this->session->userdata('followup_brand_name'),'both');
		}
		if($this->session->userdata('followup_prefix')!=""){
			$this->db->like('data_mitra.prefix',$this->session->userdata('followup_prefix'),'both');
		}

		if($this->session->userdata('followup_type')!=""){
			$this->db->like('data_mitra.type',$this->session->userdata('followup_type'),'both');
		}
		if($this->session->userdata('followup_respon')!=""){
			$this->db->like('data_activity.id_respon',$this->session->userdata('followup_respon'),'both');
		}
		if($this->session->userdata('followup_topup')!=""){
			$this->db->like('data_mitra.topup',$this->session->userdata('followup_topup'),'both');
		}
		if($this->session->userdata('followup_trx')!=""){
			$this->db->like('data_mitra.trx',$this->session->userdata('followup_trx'),'both');
		}
		if($this->session->userdata('followup_province')!=""){
			$this->db->like('data_mitra.province',$this->session->userdata('followup_province'),'both');
		}
		if($this->session->userdata('followup_klasifikasi')!=""){
			if($this->session->userdata('followup_klasifikasi')==0){
				$this->db->where('data_klasifikasi.id',NULL);
			}else{
				$this->db->where('data_klasifikasi.id',$this->session->userdata('followup_klasifikasi'));
			}
		}

		if($this->session->userdata('followup_status')!=""){
			if($this->session->userdata('followup_status')!="all"){
				$this->db->like('data_mitra.status',$this->session->userdata('followup_status'),'both');
			}
		}else{
			$this->db->like('data_mitra.status','active','both');
		}
		$this->db->order_by('data_activity.create_at','desc');
		$this->db->group_by('data_mitra.id_mitra');
		$this->db->limit($limit,$start);
		$a = $this->db->get('data_activity');

		$this->db->select('data_mitra.brand_name,data_mitra.id_mitra,data_mitra.topup,data_mitra.trx,data_mitra.join_date,data_klasifikasi.klasifikasi, a1.reason, a1.type,data_respon.respon');
        $this->db->join('data_mitra','data_mitra.id_mitra=data_activity.member_ID','right');
        $this->db->join('klasifikasi_member k1','k1.id_mitra=data_mitra.id_mitra','left');
        $this->db->join('klasifikasi_member k2','k2.id_mitra=data_mitra.id_mitra and k1.id<k2.id','left outer');
        $this->db->join('data_klasifikasi','data_klasifikasi.id=k1.id_klasifikasi','left');
        $this->db->join('data_activity a1','a1.member_ID=data_mitra.id_mitra','left');
        $this->db->join('data_activity a2','a2.member_ID=data_mitra.id_mitra and a1.ID<a2.ID and ISNULL(a1.delete_at)','left outer');
        $this->db->join('data_respon','data_respon.id=a1.id_respon','left');
        $this->db->where('k2.id',NULL);
        $this->db->where('a2.ID',NULL);     

        if($this->session->userdata('followup_date_activity')!=""){
            $daten = explode(" - ", $this->session->userdata('followup_date_activity'));
            $date_start = $daten[0];
            $date_end = $daten[1];
            $this->db->where('data_activity.create_at>=',date_format(date_create($date_start),"Y-m-d"));
            $this->db->where('data_activity.create_at<=',date_format(date_create($date_end),"Y-m-d"));
        }
        if($this->session->userdata('followup_date_join')!=""){
            $daten = explode(" - ", $this->session->userdata('followup_date_join'));
            $date_start = $daten[0];
            $date_end = $daten[1];
            $this->db->where('data_mitra.join_date>=',date_format(date_create($date_start),"Y-m-d"));
            $this->db->where('data_mitra.join_date<=',date_format(date_create($date_end),"Y-m-d"));
        }
        if($this->session->userdata('followup_brand_name')!=""){
            $this->db->like('data_mitra.brand_name',$this->session->userdata('followup_brand_name'),'both');
        }
        if($this->session->userdata('followup_prefix')!=""){
            $this->db->like('data_mitra.prefix',$this->session->userdata('followup_prefix'),'both');
        }

        if($this->session->userdata('followup_type')!=""){
            $this->db->like('data_mitra.type',$this->session->userdata('followup_type'),'both');
        }
        if($this->session->userdata('followup_topup')!=""){
            $this->db->like('data_mitra.topup',$this->session->userdata('followup_topup'),'both');
        }
        if($this->session->userdata('followup_trx')!=""){
            $this->db->like('data_mitra.trx',$this->session->userdata('followup_trx'),'both');
        }
        if($this->session->userdata('followup_respon')!=""){
            $this->db->like('data_activity.id_respon',$this->session->userdata('followup_respon'),'both');
        }
        if($this->session->userdata('followup_province')!=""){
            $this->db->like('data_mitra.province',$this->session->userdata('followup_province'),'both');
        }
        if($this->session->userdata('followup_klasifikasi')!=""){
            if($this->session->userdata('followup_klasifikasi')==0){
                $this->db->where('data_klasifikasi.id',NULL);
            }else{
                $this->db->where('data_klasifikasi.id',$this->session->userdata('followup_klasifikasi'));
            }
        }
        if($this->session->userdata('followup_status')!=""){
            if($this->session->userdata('followup_status')!="all"){
                $this->db->like('data_mitra.status',$this->session->userdata('followup_status'),'both');
            }
        }else{
            $this->db->like('data_mitra.status','active','both');
        }
        $this->db->group_by('data_mitra.id_mitra');
        $data['paging'] = $this->general->pagination($this->db->get('data_activity')->num_rows(),$limit,$pg,base_url("marketing/followup_all/%d"));

		//die("<pre>".print_r($a->result_array(),1)."</pre>");

		$data['followup_data'] = $a->result_array();


		$data['klasifikasi'] = $this->db->get('data_klasifikasi')->result_array();



		$data['response'] = $this->db->get('data_respon')->result_array();

		$this->general->load('marketing/followup_all',$data);
	}

	public function followup_add()
	{

		$data['data_respon'] = $this->db->get('data_respon')->result_array();
   		$this->general->load('marketing/followup_add',$data);
		
		
	}

	public function followup_add_save()
	{

		$data = $this->input->post();
		$data['member_ID'] = $data['id_mitra'];
		$data['create_at'] = date("Y-m-d H:i:s");
		$data['create_by'] = $this->session->userdata('id');
		unset($data['id_mitra']);
		unset($data['mitra']);
		$this->db->insert('data_activity',$data);
		redirect(base_url('marketing/followup_add'));

	}

	public function member_graph()
	{
		$data['klasifikasi'] = $this->db->get('data_klasifikasi')->result_array();
		$this->general->load('marketing/member_graph',$data);		


	}
	public function member_week()
	{
		$data['klasifikasi'] = $this->db->get('data_klasifikasi')->result_array();
		$tbl = '';
            $klasifikasi_data = array();
        	foreach ($data['klasifikasi'] as $key) {
        		$klasifikasi_data+=array($key['klasifikasi']=>0);
        	}
        	$klasifikasi_data+=array('No Data'=>0);
          if($this->input->post('bulan')!="" and $this->input->post('tahun')!=""){
            $month = $this->input->post('bulan');
            $year = $this->input->post('tahun');

            $beg = (int) date('W', strtotime("first thursday of $year-$month"));
            $end = (int) date('W', strtotime("last  thursday of $year-$month"));

            $re = (range($beg, $end));


            $this->db->where('status','active');
            $member = $this->db->get('data_mitra');
            $member = $member->result_array();

            $datatgl = array();

            for($i=$beg;$i<=$end;$i++){

                $week_start = new DateTime();
                $week_start->setISODate($year,$i);
                $week_end = new DateTime();
                $week_end->setISODate($year,$i+1);

                $a = $this->general->createDateRangeArray($week_start->format('Y-m-d'),$week_end->format('Y-m-d'));
                $datatgl[] = $a;
                //echo "<pre>".print_r($a,1)."</pre>";
            }

             $tbl = '<table class="table table-bordered table-striped for_datatables">
                <thead>
                  <tr>
                    <th>Brand Name</th>
                    <th>Date Join</th>
                    <th>Klasifikasi</th>';
                    foreach ($datatgl as $kay) {
                      $tbl .="<th>".date_format(date_create($kay['arr'][0]),"d M")." - ".date_format(date_create($kay['arr'][1]),"d M")."</th>";
                    }
                  $tbl .= '</tr>
                </thead>
            <tbody>';
            foreach ($member as $key) {
              $id_mitra = $key['id_mitra'];
              $jum_trx = 0;
              $intbl='';
              if($this->input->post('klasifikasi')!=""){
              if($this->general->get_klasifikasi($id_mitra,$this->input->post('tahun')."-".$this->input->post('bulan')."-")==(($this->input->post('klasifikasi')==0)?"No Data":$this->general->get_klasifikasi_name($this->input->post('klasifikasi')))){
              $intbl .='<tr>
                <td>'.$key['brand_name'].'</td>
                <td>'.$key['join_date'].'</td>
                <td>'.$this->general->get_klasifikasi($key['id_mitra'],$this->input->post('tahun')."-".$this->input->post('bulan')."-").'</td>';
                    $jum_trx = 0;
                    foreach ($datatgl as $kay) {

                    	$this->db->select('sum(jumlah) as jumlah');
                    	$this->db->like('kode',$this->input->post('vendor'),'both');
                    	$this->db->where('id_mitra',$id_mitra);
                    	$this->db->where('tanggal >=',$kay['arr'][0]);
                    	$this->db->where('tanggal <=',$kay['arr'][1]);
                    	$datanya = $this->db->get('airline_member');
                    	$datanya = $datanya->row_array();
                    	$datanya = $datanya['jumlah'];
                    	$jum_trx +=$datanya;
                      $intbl .= "<td>".$datanya."</td>";
                    }
              		$intbl .='</tr>';
          		}
          		}else{
          			$intbl .='<tr>
                <td>'.$key['brand_name'].'</td>
                <td>'.$key['join_date'].'</td>
                <td>'.$this->general->get_klasifikasi($key['id_mitra'],$this->input->post('tahun')."-".$this->input->post('bulan')."-").'</td>';
                    $jum_trx = 0;
                    foreach ($datatgl as $kay) {
                    	$this->db->select('sum(jumlah) as jumlah');
                    	$this->db->like('kode',$this->input->post('vendor'),'both');
                    	$this->db->where('id_mitra',$id_mitra);
                    	$this->db->where('tanggal >=',$kay['arr'][0]);
                    	$this->db->where('tanggal <=',$kay['arr'][1]);
                    	$datanya = $this->db->get('airline_member');
                    	$datanya = $datanya->row_array();
                    	$datanya = $datanya['jumlah'];
                    	$jum_trx +=$datanya;
                      $intbl .= "<td>".$datanya."</td>";
                    }
              		$intbl .='</tr>';
          		}

          		if($jum_trx>0){
                    $klasifikasi_data[$this->general->get_klasifikasi($key['id_mitra'],$this->input->post('tahun')."-".$this->input->post('bulan')."-")]+=$jum_trx;
          			$tbl .=$intbl;
          		}
            }

          $tbl .='</tbody>
              </table>';
          }
        $data['klasifikasi_data'] = $klasifikasi_data;
		$data['table'] = $tbl;
		$this->general->load('marketing/member_week',$data);
	}
	public function member_week_export()
	{
		$this->general->logging();
	        header('Content-type: application/vnd.ms-excel');
	        header('Content-Disposition: attachment; filename=Export_Member_Week_'.$_GET['vendor'].'_'.$_GET['bulan'].'_'.$_GET['tahun'].'_by_'.$this->session->userdata('email').'.xls');
			
		$data['klasifikasi'] = $this->db->get('data_klasifikasi')->result_array();
		$tbl = '';
            $klasifikasi_data = array();
        	foreach ($data['klasifikasi'] as $key) {
        		$klasifikasi_data+=array($key['klasifikasi']=>0);
        	}
        	$klasifikasi_data+=array('No Data'=>0);
          if($_GET['bulan']!="" and $_GET['tahun']!=""){
            $month = $_GET['bulan'];
            $year = $_GET['tahun'];

            $beg = (int) date('W', strtotime("first thursday of $year-$month"));
            $end = (int) date('W', strtotime("last  thursday of $year-$month"));

            $re = (range($beg, $end));


            $this->db->where('status','active');
            $member = $this->db->get('data_mitra');
            $member = $member->result_array();

            $datatgl = array();

            for($i=$beg;$i<=$end;$i++){

                $week_start = new DateTime();
                $week_start->setISODate($year,$i);
                $week_end = new DateTime();
                $week_end->setISODate($year,$i+1);

                $a = $this->general->createDateRangeArray($week_start->format('Y-m-d'),$week_end->format('Y-m-d'));
                $datatgl[] = $a;
                //echo "<pre>".print_r($a,1)."</pre>";
            }

             $tbl = '<table>
                <thead>
                  <tr>
                    <th>Brand Name</th>
                    <th>Date Join</th>
                    <th>Klasifikasi</th>';
                    foreach ($datatgl as $kay) {
                      $tbl .="<th>".date_format(date_create($kay['arr'][0]),"d M")." - ".date_format(date_create($kay['arr'][1]),"d M")."</th>";
                    }
                  $tbl .= '</tr>
                </thead>
            <tbody>';
            foreach ($member as $key) {
              $id_mitra = $key['id_mitra'];
              $jum_trx = 0;
              $intbl='';
              if($_GET['klasifikasi']!=""){
              if($this->general->get_klasifikasi($id_mitra,$_GET['tahun']."-".$_GET['bulan']."-")==(($_GET['klasifikasi']==0)?"No Data":$this->general->get_klasifikasi_name($_GET['klasifikasi']))){
              $intbl .='<tr>
                <td>'.$key['brand_name'].'</td>
                <td>'.$key['join_date'].'</td>
                <td>'.$this->general->get_klasifikasi($key['id_mitra'],$_GET['tahun']."-".$_GET['bulan']."-").'</td>';
                    $jum_trx = 0;
                    foreach ($datatgl as $kay) {

                    	$this->db->select('sum(jumlah) as jumlah');
                    	$this->db->like('kode',$_GET['vendor'],'both');
                    	$this->db->where('id_mitra',$id_mitra);
                    	$this->db->where('tanggal >=',$kay['arr'][0]);
                    	$this->db->where('tanggal <=',$kay['arr'][1]);
                    	$datanya = $this->db->get('airline_member');
                    	$datanya = $datanya->row_array();
                    	$datanya = $datanya['jumlah'];
                    	$jum_trx +=$datanya;
                      $intbl .= "<td>".$datanya."</td>";
                    }
              		$intbl .='</tr>';
          		}
          		}else{
          			$intbl .='<tr>
                <td>'.$key['brand_name'].'</td>
                <td>'.$key['join_date'].'</td>
                <td>'.$this->general->get_klasifikasi($key['id_mitra'],$_GET['tahun']."-".$_GET['bulan']."-").'</td>';
                    $jum_trx = 0;
                    foreach ($datatgl as $kay) {
                    	$this->db->select('sum(jumlah) as jumlah');
                    	$this->db->like('kode',$_GET['vendor'],'both');
                    	$this->db->where('id_mitra',$id_mitra);
                    	$this->db->where('tanggal >=',$kay['arr'][0]);
                    	$this->db->where('tanggal <=',$kay['arr'][1]);
                    	$datanya = $this->db->get('airline_member');
                    	$datanya = $datanya->row_array();
                    	$datanya = $datanya['jumlah'];
                    	$jum_trx +=$datanya;
                      $intbl .= "<td>".$datanya."</td>";
                    }
              		$intbl .='</tr>';
          		}

          		if($jum_trx>0){
                    $klasifikasi_data[$this->general->get_klasifikasi($key['id_mitra'],$_GET['tahun']."-".$_GET['bulan']."-")]+=$jum_trx;
          			$tbl .=$intbl;
          		}
            }

          $tbl .='</tbody>
              </table>';
          }
              echo $tbl;
	}
	public function member_graph_export(){

        	$this->general->logging();
	        header('Content-type: application/vnd.ms-excel');
	        header('Content-Disposition: attachment; filename=Export_Member_Airline_Graph_'.$_GET['vendor'].'_'.$_GET['bulan'].'_'.$_GET['tahun'].'_by_'.$this->session->userdata('email').'.xls');
						// $this->db->select('airline_member.id_mitra,data_mitra.brand_name,data_mitra.join_date,data_mitra.prefix');
						// $this->db->join('data_mitra','data_mitra.id_mitra=airline_member.id_mitra','left');
						// $this->db->like('kode',$_GET['vendor'],'both');
						// $this->db->like('tanggal',$_GET['tahun']."-".$_GET['bulan']."-",'both');
						// $this->db->group_by('airline_member.id_mitra');
						// $xa = $this->db->get('airline_member');
			$this->db->select('data_mitra.id_mitra,data_mitra.brand_name,data_mitra.join_date,data_mitra.prefix,data_mitra.city,data_mitra.type');
			$this->db->join('klasifikasi_member k1','k1.id_mitra=data_mitra.id_mitra','left');
            $this->db->join('klasifikasi_member k2','k2.id_mitra=data_mitra.id_mitra and k1.id<k2.id','left outer');
            $this->db->join('data_klasifikasi','data_klasifikasi.id=k1.id_klasifikasi','left');
            $this->db->where('k2.id',NULL);
            
            // if($_GET['klasifikasi']!=""){
            //   $this->db->where('data_klasifikasi.id',$_GET['klasifikasi']);
            // }
        if($_GET['klasifikasi']!=""){
			if($_GET['klasifikasi']==0){
				$this->db->where('data_klasifikasi.id',NULL);
			}else{
				$this->db->where('data_klasifikasi.id',$_GET['klasifikasi']);
			}
		}
						$this->db->where('status','active');
						$xa = $this->db->get('data_mitra');
						$xa = $xa->result_array();
						//echo "<pre>".print_r($xa,1)."</pre>";
						//die();
						//echo $this->db->last_query();
						echo "<table><thead>";
						echo "<th>Brand Name</th>";
						echo "<th>Date Join</th>";
						echo "<th>Type</th>";
						echo "<th>City</th>";
						echo "<th>Klasifikasi</th>";
						for($i=1;$i<=31;$i++){
							if(checkdate($_GET['bulan'], $i, $_GET['tahun'])){
								echo "<th>".$i."</th>";
							}
						}
						echo "<th>Total</th>";
						echo "</thead><tbody>";
						foreach($xa as $key) {
							$total = 0;
						echo "<tr>";
						echo "<td>".$key['brand_name']." (".$key['prefix'].")</td>";
						echo "<td>".utf8_decode($key['join_date'])."</td>";
						echo "<td>".utf8_decode($key['type'])."</td>";
						echo "<td>".utf8_decode($key['city'])."</td>";
						echo "<td>".utf8_decode($this->general->get_klasifikasi($key['id_mitra'],$_GET['tahun']."-".$_GET['bulan']."-"))."</td>";

							for($i = 1;$i<=31;$i++){

							if(checkdate($_GET['bulan'], $i, $_GET['tahun'])){
								$this->db->select('sum(jumlah) as jumlah');
								$this->db->where('airline_member.id_mitra',$key['id_mitra']);
								$this->db->like('kode',$_GET['vendor'],'both');
								$this->db->where('tanggal',$_GET['tahun']."-".$_GET['bulan']."-".$i);
								$aaa = $this->db->get('airline_member');
								$aaa = $aaa->row_array();
								$total+=(isset($aaa['jumlah'])?$aaa['jumlah']:0);
								echo "<td>".utf8_decode((isset($aaa['jumlah'])?$aaa['jumlah']:"0"))."</td>";
							}
							}
						echo "<td>".utf8_decode($total)."</td>";
						echo "</tr>";
						}
						echo "</tbody></table>";
	}
	public function member_graph_export_trx(){

        $this->general->logging();
	        header('Content-type: application/vnd.ms-excel');
	        header('Content-Disposition: attachment; filename=Export_Member_Airline_Graph_TRX_'.$_GET['vendor'].'_'.$_GET['bulan'].'_'.$_GET['tahun'].'_by_'.$this->session->userdata('email').'.xls');
			$this->db->select('airline_member.id_mitra,data_mitra.brand_name,data_mitra.join_date,data_mitra.prefix,data_mitra.city,data_mitra.type');
			$this->db->join('data_mitra','data_mitra.id_mitra=airline_member.id_mitra','left');
			$this->db->join('klasifikasi_member k1','k1.id_mitra=data_mitra.id_mitra','left');
            $this->db->join('klasifikasi_member k2','k2.id_mitra=data_mitra.id_mitra and k1.id<k2.id','left outer');
            $this->db->join('data_klasifikasi','data_klasifikasi.id=k1.id_klasifikasi','left');
            $this->db->where('k2.id',NULL);
            
        if($_GET['klasifikasi']!=""){
			if($_GET['klasifikasi']==0){
				$this->db->where('data_klasifikasi.id',NULL);
			}else{
				$this->db->where('data_klasifikasi.id',$_GET['klasifikasi']);
			}
		}
						$this->db->like('airline_member.kode',$_GET['vendor'],'both');
						$this->db->like('airline_member.tanggal',$_GET['tahun']."-".$_GET['bulan']."-",'both');
						$this->db->group_by('airline_member.id_mitra');
						$xa = $this->db->get('airline_member');
						// $this->db->where('status','active');
						// $xa = $this->db->get('data_mitra');
						$xa = $xa->result_array();
						//echo $this->db->last_query();
						echo "<table><thead>";
						echo "<th>Brand Name</th>";
						echo "<th>Date Join</th>";
						echo "<th>Type</th>";
						echo "<th>City</th>";
						echo "<th>Klasifikasi</th>";
						for($i=1;$i<=31;$i++){
							if(checkdate($_GET['bulan'], $i, $_GET['tahun'])){
								echo "<th>".$i."</th>";
							}
						}
						echo "<th>Total</th>";
						echo "</thead><tbody>";
						foreach($xa as $key) {
							$total = 0;
						echo "<tr>";
						echo "<td>".$key['brand_name']." (".$key['prefix'].")</td>";
						echo "<td>".utf8_decode($key['join_date'])."</td>";
						echo "<td>".utf8_decode($key['type'])."</td>";
						echo "<td>".utf8_decode($key['city'])."</td>";
						echo "<td>".utf8_decode($this->general->get_klasifikasi($key['id_mitra'],$_GET['tahun']."-".$_GET['bulan']."-"))."</td>";
							for($i = 1;$i<=31;$i++){

							if(checkdate($_GET['bulan'], $i, $_GET['tahun'])){
								$this->db->select('sum(jumlah) as jumlah');
								$this->db->where('airline_member.id_mitra',$key['id_mitra']);
								$this->db->like('kode',$_GET['vendor'],'both');
								$this->db->where('tanggal',$_GET['tahun']."-".$_GET['bulan']."-".$i);
								$aaa = $this->db->get('airline_member');
								$aaa = $aaa->row_array();
								$total+=(isset($aaa['jumlah'])?$aaa['jumlah']:0);
								echo "<td>".utf8_decode((isset($aaa['jumlah'])?$aaa['jumlah']:"0"))."</td>";
							}
							}
						echo "<td>".utf8_decode($total)."</td>";
						echo "</tr>";
						}
						echo "</tbody></table>";
	}
	public function airline_graph()
	{
		$this->general->load('marketing/airline_graph');
	}
	public function airline_graph_export(){
        $this->general->logging();
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename=Export_Airline_Graph_'.$_GET['bulan'].'_'.$_GET['tahun'].'_by_'.$this->session->userdata('email').'.xls');
		$xa = $this->db->get('data_kode');
		$xa = $xa->result_array();
		//echo $this->db->last_query();
		echo "<table><thead>";
		echo "<th>Airline</th>";
		for($i=1;$i<=31;$i++){
			if(checkdate($_GET['bulan'], $i, $_GET['tahun'])){
				echo "<th>".$i."</th>";
			}
		}
		echo "<th>Total</th>";
		echo "</thead><tbody>";
		foreach($xa as $key) {
		$total = 0;
		echo "<tr>";
		echo "<td>".$key['isi']."</td>";
			for($i = 1;$i<=31;$i++){

			if(checkdate($_GET['bulan'], $i, $_GET['tahun'])){
				$this->db->where('kode',$key['kode']);
				$this->db->where('tipe','tanggal');
				$this->db->where('jenis','vendor');
				$this->db->where('date_vend',$_GET['tahun']."-".$_GET['bulan']."-".$i);
				$aaa = $this->db->get('data_statistik');
				$aaa = $aaa->row_array();
				$total+=(isset($aaa['jumlah'])?$aaa['jumlah']:0);
				echo "<td>".(isset($aaa['jumlah'])?$aaa['jumlah']:"0")."</td>";
			}
			}
			echo "<td>".utf8_decode($total)."</td>";
		echo "</tr>";
		}
		echo "</tbody></table>";
	}
	public function member_transaction()
	{
		$data['klasifikasi'] = $this->db->get('data_klasifikasi')->result_array();
		$this->general->load('marketing/member_transaction',$data);
	}
	public function export_trx()
	{
		$this->general->logging();
	        header('Content-type: application/vnd.ms-excel');
	        header('Content-Disposition: attachment; filename=Export_Member_Transaction_'.$_GET['vendor'].'_'.$_GET['date_range'].'_by_'.$this->session->userdata('email').'.xls');
	        ?>
			<table class="table table-bordered table-striped for_datatables">
						<thead>
							<tr>
								<th>No.</th>
								<th>Date Join</th>
								<th>Brand Name</th>
								<th>Klasifikasi</th>
								<th>Type</th>
								<th>Num Ticket</th>
								<th>Sum NTA</th>
								<th>Sum PAX</th>
							</tr>
						</thead>
						<tbody>
							<?php 

							$data = array();
							$pg = 1;
							$start = 0;

							$vendor = ($_GET['vendor']=="all")?"":$_GET['vendor'];
							$datenya = $_GET['date_range'];
							$daten = explode(" - ", $datenya);
							$date_start = $daten[0];
							$date_end = $daten[1];

							$this->db->select('id_mitra as idm,join_date,brand_name,prefix,type,(select sum(jml_tiket) from data_trx where id_mitra=idm AND date_resv >="'.date_format(date_create($date_start),"Y-m-d").'" AND date_resv <="'.date_format(date_create($date_end),"Y-m-d").'" AND vendor like "%'.$vendor.'%") as jml_tiket,(select sum(nta_idr) from data_trx where id_mitra=idm AND date_resv >="'.date_format(date_create($date_start),"Y-m-d").'" AND date_resv <="'.date_format(date_create($date_end),"Y-m-d").'" AND vendor like "%'.$vendor.'%") as jml_nta,(select sum(pax_idr) from data_trx where id_mitra=idm AND date_resv >="'.date_format(date_create($date_start),"Y-m-d").'" AND date_resv <="'.date_format(date_create($date_end),"Y-m-d").'" AND vendor like "%'.$vendor.'%") as jml_pax');
							$this->db->where('status','active');
							$this->db->like('brand_name',$_GET['brand_name'],'both');
							$this->db->like('prefix',$_GET['prefix'],'both');
							$this->db->order_by('jml_tiket','desc');
							$a = $this->db->get('data_mitra');
							$a = $a->result_array();
							//print_r($a);
							$i = 1;
							$jum = sizeof($a);
							foreach ($a as $key) {
								//print_r($key);
								//$key['jml_tiket']+=$this->create_model->get_manual($key['idm'],$date_start,$date_end);
								if($key['jml_tiket']>0){
									$this->db->join('data_klasifikasi','data_klasifikasi.id=klasifikasi_member.id_klasifikasi','left');
									$this->db->where('id_mitra',$key['idm']);
									$this->db->where('tgl_update <=',date_format(date_create($date_end),"Y-m-d"));
									$this->db->order_by('klasifikasi_member.id','desc');
									$this->db->limit(1);
									$kasl = $this->db->get('klasifikasi_member');
									$klas = $kasl->row_array();
									if($_GET['klasifikasi']!=""){

										if($_GET['klasifikasi']=="non" and $klas['id_klasifikasi']==NULL){
											?>
											<tr>
											<td><?php echo $i;?></td>
											<td><?php echo $key['join_date'];?></td>
											<td><a onclick="openformdetail(<?php echo $key['idm'];?>)"><?php echo $key['brand_name']." (".$key['prefix'].")";?></a></td>
											<td><?php echo ($klas['klasifikasi']==""?"Non Data":$klas['klasifikasi']);?></td>
											<td><?php echo $key['type'];?></td>
											<td><?php echo $key['jml_tiket'];?></td>
											<td><?php echo number_format($key['jml_nta'],2,",",".");?></td>
											<td><?php echo number_format($key['jml_pax'],2,",",".");?></td>
											</tr>
											<?php
										}

										if($klas['id_klasifikasi']==$_GET['klasifikasi']){
											?>
											<tr>
											<td><?php echo $i;?></td>
											<td><?php echo $key['join_date'];?></td>
											<td><a onclick="openformdetail(<?php echo $key['idm'];?>)"><?php echo $key['brand_name']." (".$key['prefix'].")";?></a></td>
											<td><?php echo ($klas['klasifikasi']==""?"Non Data":$klas['klasifikasi']);?></td>
											<td><?php echo $key['type'];?></td>
											<td><?php echo $key['jml_tiket'];?></td>
											<td><?php echo number_format($key['jml_nta'],2,",",".");?></td>
											<td><?php echo number_format($key['jml_pax'],2,",",".");?></td>
											</tr>
											<?php
										}

									}else{
									?>
									<tr>
									<td><?php echo $i;?></td>
									<td><?php echo $key['join_date'];?></td>
									<td><a onclick="openformdetail(<?php echo $key['idm'];?>)"><?php echo $key['brand_name']." (".$key['prefix'].")";?></a></td>
									<td><?php echo ($klas['klasifikasi']==""?"Non Data":$klas['klasifikasi']);?></td>
									<td><?php echo $key['type'];?></td>
									<td><?php echo $key['jml_tiket'];?></td>
									<td><?php echo number_format($key['jml_nta'],2,",",".");?></td>
									<td><?php echo number_format($key['jml_pax'],2,",",".");?></td>
									</tr>
									<?php
									}
								$i++;
								}	
							}
							?>
						</tbody>
					</table>
					<?php
	}
	public function export_trx_all()
	{
		$this->general->logging();
	        header('Content-type: application/vnd.ms-excel');
	        header('Content-Disposition: attachment; filename=Export_Member_Transaction_All_'.$_GET['vendor'].'_'.$_GET['date_range'].'_by_'.$this->session->userdata('email').'.xls');
	        ?>
			<table class="table table-bordered table-striped for_datatables">
						<thead>
							<tr>
								<th>No.</th>
								<th>Date Join</th>
								<th>Brand Name</th>
								<th>Klasifikasi</th>
								<th>Type</th>
								<th>Num Ticket</th>
								<th>Sum NTA</th>
								<th>Sum PAX</th>
							</tr>
						</thead>
						<tbody>
							<?php 

							$data = array();
							$pg = 1;
							$start = 0;

							$vendor = ($_GET['vendor']=="all")?"":$_GET['vendor'];
							$datenya = $_GET['date_range'];
							$daten = explode(" - ", $datenya);
							$date_start = $daten[0];
							$date_end = $daten[1];

							$this->db->select('id_mitra as idm,join_date,brand_name,prefix,type,(select sum(jml_tiket) from data_trx where id_mitra=idm AND date_resv >="'.date_format(date_create($date_start),"Y-m-d").'" AND date_resv <="'.date_format(date_create($date_end),"Y-m-d").'" AND vendor like "%'.$vendor.'%") as jml_tiket,(select sum(nta_idr) from data_trx where id_mitra=idm AND date_resv >="'.date_format(date_create($date_start),"Y-m-d").'" AND date_resv <="'.date_format(date_create($date_end),"Y-m-d").'" AND vendor like "%'.$vendor.'%") as jml_nta,(select sum(pax_idr) from data_trx where id_mitra=idm AND date_resv >="'.date_format(date_create($date_start),"Y-m-d").'" AND date_resv <="'.date_format(date_create($date_end),"Y-m-d").'" AND vendor like "%'.$vendor.'%") as jml_pax');
							$this->db->where('status','active');
							$this->db->like('brand_name',$_GET['brand_name'],'both');
							$this->db->like('prefix',$_GET['prefix'],'both');
							$this->db->order_by('jml_tiket','desc');
							$a = $this->db->get('data_mitra');
							$a = $a->result_array();
							//print_r($a);
							$i = 1;
							$jum = sizeof($a);
							foreach ($a as $key) {
								//print_r($key);
								//$key['jml_tiket']+=$this->create_model->get_manual($key['idm'],$date_start,$date_end);
									$this->db->join('data_klasifikasi','data_klasifikasi.id=klasifikasi_member.id_klasifikasi','left');
									$this->db->where('id_mitra',$key['idm']);
									$this->db->where('tgl_update <=',date_format(date_create($date_end),"Y-m-d"));
									$this->db->order_by('klasifikasi_member.id','desc');
									$this->db->limit(1);
									$kasl = $this->db->get('klasifikasi_member');
									$klas = $kasl->row_array();
									if($_GET['klasifikasi']!=""){

										if($_GET['klasifikasi']=="non" and $klas['id_klasifikasi']==NULL){
											?>
											<tr>
											<td><?php echo $i;?></td>
											<td><?php echo $key['join_date'];?></td>
											<td><a onclick="openformdetail(<?php echo $key['idm'];?>)"><?php echo $key['brand_name']." (".$key['prefix'].")";?></a></td>
											<td><?php echo ($klas['klasifikasi']==""?"Non Data":$klas['klasifikasi']);?></td>
											<td><?php echo $key['type'];?></td>
											<td><?php echo $key['jml_tiket'];?></td>
											<td><?php echo number_format($key['jml_nta'],2,",",".");?></td>
											<td><?php echo number_format($key['jml_pax'],2,",",".");?></td>
											</tr>
											<?php
										}

										if($klas['id_klasifikasi']==$_GET['klasifikasi']){
											?>
											<tr>
											<td><?php echo $i;?></td>
											<td><?php echo $key['join_date'];?></td>
											<td><a onclick="openformdetail(<?php echo $key['idm'];?>)"><?php echo $key['brand_name']." (".$key['prefix'].")";?></a></td>
											<td><?php echo ($klas['klasifikasi']==""?"Non Data":$klas['klasifikasi']);?></td>
											<td><?php echo $key['type'];?></td>
											<td><?php echo $key['jml_tiket'];?></td>
											<td><?php echo number_format($key['jml_nta'],2,",",".");?></td>
											<td><?php echo number_format($key['jml_pax'],2,",",".");?></td>
											</tr>
											<?php
										}

									}else{
									?>
									<tr>
									<td><?php echo $i;?></td>
									<td><?php echo $key['join_date'];?></td>
									<td><a onclick="openformdetail(<?php echo $key['idm'];?>)"><?php echo $key['brand_name']." (".$key['prefix'].")";?></a></td>
									<td><?php echo ($klas['klasifikasi']==""?"Non Data":$klas['klasifikasi']);?></td>
									<td><?php echo $key['type'];?></td>
									<td><?php echo $key['jml_tiket'];?></td>
									<td><?php echo number_format($key['jml_nta'],2,",",".");?></td>
									<td><?php echo number_format($key['jml_pax'],2,",",".");?></td>
									</tr>
									<?php
									}
								$i++;
							}
							?>
						</tbody>
					</table>
					<?php
	}

        /*$this->general->logging();
		if($_GET['vendor']!="" or $_GET['date_start']!="" or $_GET['date_end']!=""){
		$this->general->logging();
		$this->load->library('Excel');
		$data = array();

///$dbs = $this->load->database('default',TRUE);
							// if($this->uri->segment(3)!=""){
							// 	$pg = $this->uri->segment(3);
							// 	if($pg<=0){
							// 		$pg=1;
							// 	}
							// 	$start = ($pg-1)*10;
							// }
							//$dbs->limit(10,$start);
							//$dbs->order_by('date_vend','desc');
							//$this->db->select('mitra.*,company.brand_name');

							$vendor = ($_GET['vendor']=="all")?"":$_GET['vendor'];

							//$dbs->select('id_mitra as idm,join_date as "Join Date",brand_name as "Brand Name",prefix as "Member Code",type as "Type",(select sum(jml_tiket) from data_trx where id_mitra=idm AND date_resv >="'.date_format(date_create($_GET['date_start']),"Y-m-d").'" AND date_resv <="'.date_format(date_create($_GET['date_end']),"Y-m-d").'" AND vendor like "%'.$vendor.'%") as Jumlah_Tiket,(select sum(nta_idr) from data_trx where id_mitra=idm AND date_resv >="'.date_format(date_create($_GET['date_start']),"Y-m-d").'" AND date_resv <="'.date_format(date_create($_GET['date_end']),"Y-m-d").'" AND vendor like "%'.$vendor.'%") as "Total NTA",(select sum(pax_idr) from data_trx where id_mitra=idm AND date_resv >="'.date_format(date_create($_GET['date_start']),"Y-m-d").'" AND date_resv <="'.date_format(date_create($_GET['date_end']),"Y-m-d").'" AND vendor like "%'.$vendor.'%") as "Total PAX"');
							$this->db->select('data_mitra.join_date as "Join Date",data_mitra.brand_name as "Brand Name",data_mitra.prefix as "Member Code",data_klasifikasi.klasifikasi as "Klasifikasi",data_mitra.type as "Tipe Member",sum(jml_tiket) as "Jumlah_Tiket",sum(nta_idr) as "Total NTA", sum(pax_idr) as "Total PAX"');
							$this->db->join('data_mitra','data_mitra.id_mitra=data_trx.id_mitra','left');
							
							$this->db->where('date_resv >=',date_format(date_create($_GET['date_start']),"Y-m-d"));
							$this->db->where('date_resv <=',date_format(date_create($_GET['date_end']),"Y-m-d"));
							//$this->db->where('Jumlah_Tiket >',0);
							$this->db->like('vendor',$vendor,'both');
							$this->db->like('data_mitra.brand_name',$_GET['brand_name'],'both');
							$this->db->like('data_mitra.prefix',$_GET['prefix'],'both');
							$this->db->group_by('data_trx.id_mitra');

								// if($this->input->post('date_end')!=""){
								// 	$this->db->where('all_selling.date_resv <=',date_format(date_create($this->input->post('date_end')),"Y-m-d"));
								// }
							$this->db->order_by('Jumlah_Tiket','desc');
							//$this->db->group_by('all_selling.id_mitra');
							//$this->db->join('company','company.id_mitra=mitra.id_mitra','left');
//							$this->db->join('type','type.id_type=mitra.id_type','left');
							//$this->db->join('all_selling','all_selling.id_mitra=mitra.id_mitra','left');
							$a = $this->db->get('data_trx');

							$this->excel->to_excel($a,'Export_Transaction_'.$_GET['date_start']."_".$_GET['date_end']."_".$_GET['vendor']."_".$_GET['brand_name']."_".$_GET['prefix'].'_by_'.$this->session->userdata('email'));
						}else{
							redirect(base_url("index.php/marketing/transaction"));
						}
						*/
	//}


		public function export_excel()
	{
		$this->general->logging();
		$this->load->library('Excel');

		$this->db->select('data_mitra.join_date as "Join Date",data_mitra.expire_date as "Expire Date",data_mitra.brand_name as "Brand Name",data_mitra.prefix as "Kode Member",data_mitra.name as "Name",data_klasifikasi.klasifikasi as "Klasifikasi", data_mitra.type as "Type",b.brand_name as "Parent",data_mitra.email as "E-Mail",data_mitra.mobile as "Mobile",data_mitra.phone as "Phone",data_mitra.status as "Status",data_mitra.address as "Address",data_mitra.city as "City"');
		$this->db->join('klasifikasi_member k1','k1.id_mitra=data_mitra.id_mitra','left');
		$this->db->join('klasifikasi_member k2','k2.id_mitra=data_mitra.id_mitra and k1.id<k2.id','left outer');
		$this->db->join('data_klasifikasi','data_klasifikasi.id=k1.id_klasifikasi','left');
		$this->db->where('k2.id',NULL);

		$this->db->join('data_mitra b','b.id_mitra=data_mitra.parent','left');

		if($this->session->userdata('brand_name')!=""){
			$this->db->like('data_mitra.brand_name',$this->session->userdata('brand_name'),'both');
		}
		if($this->session->userdata('prefix')!=""){
			$this->db->like('data_mitra.prefix',$this->session->userdata('prefix'),'both');
		}
		if($this->session->userdata('date_join_start')!=""){
			$this->db->where('data_mitra.join_date>=',date_format(date_create($this->session->userdata('date_join_start')),"Y-m-d"));
		}
		if($this->session->userdata('date_join_end')!=""){
			$this->db->where('data_mitra.join_date<=',date_format(date_create($this->session->userdata('date_join_end')),"Y-m-d"));
		}
		if($this->session->userdata('status')!=""){
			$this->db->where('data_mitra.status',$this->session->userdata('status'));
		}
		if($this->session->userdata('province')!=""){
			$this->db->like('data_mitra.province',$this->session->userdata('province'));
		}
		if($this->session->userdata('type')!=""){
			$this->db->where('data_mitra.type',$this->session->userdata('type'));
		}
		if($this->session->userdata('prefix')!=""){
			$this->db->like('data_mitra.prefix',$this->session->userdata('prefix'),'both');
		}
		if($this->session->userdata('klasifikasi')!=""){
			if($this->session->userdata('klasifikasi')==0){
				$this->db->where('data_klasifikasi.id',NULL);
			}else{
				$this->db->where('data_klasifikasi.id',$this->session->userdata('klasifikasi'));
			}
		}

		$sql = $this->db->get('data_mitra');

		$this->excel->to_excel($sql, 'Data_Export_Member_'.$this->session->userdata('date_join_start').'_'.$this->session->userdata('date_join_end').'_'.$this->session->userdata('status').'_'.$this->session->userdata('province').'_'.$this->session->userdata('type').'_'.$this->session->userdata('prefix').'_by_'.$this->session->userdata('email'));
	}
	public function email_templates_add()
	{
		$data['ckeditor'] = $this->_setup_ckeditor('notes');
		$this->general->load('marketing/email_templates/add',$data);
	}
	public function email_templates_edit($id)
	{
		$data['data'] = $this->db->where('id',$id)->get('marketing_email_templates')->row_array();
		$data['ckeditor'] = $this->_setup_ckeditor('notes');
		$this->general->load('marketing/email_templates/edit',$data);
	}
	public function email_templates_update(){
		$data = $this->input->post();
		$data['status'] = 'U';
		$data['created_at'] = date("Y-m-d H:i:s");
		$data['id_user'] = $this->session->userdata('id');
		$this->db->where('id',$data['id']);
		$this->db->update('marketing_email_templates',$data);

		redirect(base_url('marketing/email_templates'));
	}
	public function email_templates_view($id){
		$data['data'] = $this->db->where('id',$id)->get('marketing_email_templates')->row_array();
		$this->load->view('marketing/email_templates/view',$data);
	}
	public function email_templates_delete($id){
		$this->db->where('id',$id)->delete('marketing_email_templates');

		redirect(base_url('marketing/email_templates'));
	}
	public function email_templates()
	{
		$data['data'] = $this->db->get('marketing_email_templates')->result_array();
		$this->general->load('marketing/email_templates/all',$data);
	}
	public function email_templates_save(){
		$data = $this->input->post();
		$data['status'] = 'A';
		$data['created_at'] = date("Y-m-d H:i:s");
		$data['id_user'] = $this->session->userdata('id');
		$this->db->insert('marketing_email_templates',$data);

		redirect(base_url('marketing/email_templates'));
	}
	private function _setup_ckeditor($id)
    {
        $this->load->helper('url');
        $this->load->helper('ckeditor');

        $ckeditor = array(
            'id' => $id,
            'path' => 'assets/ckeditor_for_email',
            'config' => array(
                'toolbar' => 'standard',
                'width' => '99%',
                'height'=>'450px',
                'allowedContent'=>true,
                'extraPlugins'=>'token',
                'availableTokens'=>array(
                	array('Brand Name','brand-name'),
                	array('Owner Name','owner-name')
               	)));

        return $ckeditor;
    }
    public function member_graph_daily()
    {
    	$data = array();
    	if($this->input->get('bulan')!="" and $this->input->get('tahun')!=""){
    		$number = cal_days_in_month(1, $this->input->get('bulan'), $this->input->get('tahun'));
    		$dn = array();
    		foreach($this->db->get('data_klasifikasi')->result_array() as $key){
    			$dt = array();
    			for($i=0; $i <= $number; $i++) { 
    				$this->db->select('count(k1.id) as jumlah');
					$this->db->join('klasifikasi_member k1','k1.id_mitra=data_mitra.id_mitra','left');
					$this->db->join('klasifikasi_member k2','k2.id_mitra=data_mitra.id_mitra and k1.id<k2.id','left outer');
					if($i<$number){
						$likedate = date_format(date_create($this->input->get('tahun')."-".$this->input->get('bulan')."-".($i+1)),"Y-m-d");
					}else{
						$likedate = date_format(date_create($this->input->get('tahun')."-".$this->input->get('bulan')."-1"),"Y-m-");
					}
					$this->db->like('k1.tgl_update',$likedate,'both');
					$this->db->where('k1.id_klasifikasi',$key['id']);
					$this->db->where('k2.id',NULL);
					//$this->db->group_by('k1.id_mitra');
					$xa = $this->db->get('data_mitra');
					$xa = $xa->row_array();
					$dt[$i+1] = $xa['jumlah'];
					// die($this->db->last_query());
    			}
    			$dn[$key['klasifikasi']] = $dt;
    			// die();
    		}

    			$dt = array();
    			for($i=0; $i <= $number; $i++) { 
    				$this->db->select('count(data_mitra.id_mitra) as jumlah');
					$this->db->join('klasifikasi_member','klasifikasi_member.id_mitra=data_mitra.id_mitra','left');
					if($i<$number){
						$likedate = date_format(date_create($this->input->get('tahun')."-".$this->input->get('bulan')."-".($i+1)),"Y-m-d");
					}else{
						$likedate = date_format(date_create($this->input->get('tahun')."-".$this->input->get('bulan')."-1"),"Y-m-");
					}
					$this->db->like('data_mitra.join_date',$likedate,'both');
					$this->db->where('id_klasifikasi',NULL);
					//$this->db->group_by('k1.id_mitra');
					$xa = $this->db->get('data_mitra');
					$xa = $xa->row_array();
					$dt[$i+1] = $xa['jumlah'];
					// die($this->db->last_query());
    			}
    			$dn['Non Data'] = $dt;
    		$data['data'] = $dn;
    	}

    	$this->general->load('marketing/member_graph_daily',$data);
    }
    public function member_graph_daily_export()
    {
    	$this->general->logging();
	        header('Content-type: application/vnd.ms-excel');
	        header('Content-Disposition: attachment; filename=Export_Member_Graph_Daily_'.$_GET['bulan'].'_'.$_GET['tahun'].'_by_'.$this->session->userdata('email').'.xls');
	      
    	$data = array();
    	if($this->input->get('bulan')!="" and $this->input->get('tahun')!=""){
    		$number = cal_days_in_month(1, $this->input->get('bulan'), $this->input->get('tahun'));
    		$dn = array();
    		foreach($this->db->get('data_klasifikasi')->result_array() as $key){
    			$dt = array();
    			for($i=0; $i <= $number; $i++) { 
    				$this->db->select('count(k1.id) as jumlah');
					$this->db->join('klasifikasi_member k1','k1.id_mitra=data_mitra.id_mitra','left');
					$this->db->join('klasifikasi_member k2','k2.id_mitra=data_mitra.id_mitra and k1.id<k2.id','left outer');
					if($i<$number){
						$likedate = date_format(date_create($this->input->get('tahun')."-".$this->input->get('bulan')."-".($i+1)),"Y-m-d");
					}else{
						$likedate = date_format(date_create($this->input->get('tahun')."-".$this->input->get('bulan')."-1"),"Y-m-");
					}
					$this->db->like('k1.tgl_update',$likedate,'both');
					$this->db->where('k1.id_klasifikasi',$key['id']);
					$this->db->where('k2.id',NULL);
					//$this->db->group_by('k1.id_mitra');
					$xa = $this->db->get('data_mitra');
					$xa = $xa->row_array();
					$dt[$i+1] = $xa['jumlah'];
					// die($this->db->last_query());
    			}
    			$dn[$key['klasifikasi']] = $dt;
    			// die();
    		}

    			$dt = array();
    			for($i=0; $i <= $number; $i++) { 
    				$this->db->select('count(data_mitra.id_mitra) as jumlah');
					$this->db->join('klasifikasi_member','klasifikasi_member.id_mitra=data_mitra.id_mitra','left');
					if($i<$number){
						$likedate = date_format(date_create($this->input->get('tahun')."-".$this->input->get('bulan')."-".($i+1)),"Y-m-d");
					}else{
						$likedate = date_format(date_create($this->input->get('tahun')."-".$this->input->get('bulan')."-1"),"Y-m-");
					}
					$this->db->like('data_mitra.join_date',$likedate,'both');
					$this->db->where('id_klasifikasi',NULL);
					//$this->db->group_by('k1.id_mitra');
					$xa = $this->db->get('data_mitra');
					$xa = $xa->row_array();
					$dt[$i+1] = $xa['jumlah'];
					// die($this->db->last_query());
    			}
    			$dn['Non Data'] = $dt;
    		$data['data'] = $dn;
    	}
    	?>
    	<table class="table table-bordered table-striped for_datatables_asc">
          <thead>
            <th>No</th>
            <th>Klasifikasi</th>
            <?php
              $number = cal_days_in_month(1, $this->input->get('bulan'), $this->input->get('tahun'));
              for ($i=1; $i <= $number; $i++) { 
                ?>
                <th><?php echo $i;?></th>
                <?php
              }
            ?>
            <th>Total</th>
          </thead>
          <tbody>
          <?php 
          $i = 1;
              foreach ($data as $key => $value) {
                ?>

          <tr>
          <?php
                echo "<td>".$i++."</td>";
                echo "<td>".$key."</td>";
                foreach ($value as $data) {
                echo "<td>".$data."</td>";
                 } 
              }
            ?>
          </table>
    	<?php

    	//$this->general->load('marketing/member_graph_daily',$data);
    }
}
