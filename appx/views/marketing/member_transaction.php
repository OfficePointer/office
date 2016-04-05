<?php
$date_start = "";
$date_end = "";
if($this->input->post('date_range')!=""){
	$datenya = $this->input->post('date_range');
	$daten = explode(" - ", $datenya);
	$date_start = $daten[0];
	$date_end = $daten[1];
}


?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Member Transaction
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
					<form action="<?php echo base_url("marketing/member_transaction");?>" method="post">
						<table class="table">
							<tr>
								<td>Date Range</td>
								<td><input class="form-control datepicker" type="text" value="<?php echo $this->input->post("date_range");?>" name="date_range" id="dt1"></td>
							</tr>
							<tr>
								<td>Brand Name</td>
								<td><input class="form-control" type="text" value="<?php echo $this->input->post("brand_name");?>" name="brand_name"></td>
							</tr>
							<tr>
								<td>Member Code</td>
								<td><input class="form-control" type="text" value="<?php echo $this->input->post("prefix");?>" name="prefix"></td>
							</tr>
							<tr>
								<td>Airline</td>
								<td>
								<select type="text"  class="form-control" required id="vendor" name="vendor" class="medium">
									<option <?php echo ($this->input->post("vendor")=="all")?"selected":"";?> value="all">-- All --</option>
									<option <?php echo ($this->input->post("vendor")=="KAI")?"selected":"";?> value="KAI">Kereta Api</option>
									<option <?php echo ($this->input->post("vendor")=="MG")?"selected":"";?> value="MG">Hotel</option>
									<option <?php echo ($this->input->post("vendor")=="JT")?"selected":"";?> value="JT">Lion Air</option>
									<option <?php echo ($this->input->post("vendor")=="GA")?"selected":"";?> value="GA">Garuda Indonesia</option>
									<option <?php echo ($this->input->post("vendor")=="SJ")?"selected":"";?> value="SJ">Sriwijaya</option>
									<option <?php echo ($this->input->post("vendor")=="QG")?"selected":"";?> value="QG">Citilink</option>
									<option <?php echo ($this->input->post("vendor")=="QZ")?"selected":"";?> value="QZ">AirAsia</option>
									<option <?php echo ($this->input->post("vendor")=="KD")?"selected":"";?> value="KD">Kalstar</option>
									<option <?php echo ($this->input->post("vendor")=="SN")?"selected":"";?> value="SN">ExpressAir</option>
									<option <?php echo ($this->input->post("vendor")=="TGN")?"selected":"";?> value="TGN">Trigana</option>
									<option <?php echo ($this->input->post("vendor")=="TNU")?"selected":"";?> value="TNU">Transnusa</option>
								</select></td>
							</tr>
							<tr>
								<td>Klasifikasi</td>
								<td>
								<select type="text"  class="form-control" id="klasifikasi" name="klasifikasi" class="medium">
									<option <?php echo ($this->input->post("klasifikasi")=="")?"selected":"";?> value="">-- All --</option>
									<option <?php echo ($this->input->post("klasifikasi")=="non")?"selected":"";?> value="non">Non Data</option>
									<?php foreach ($klasifikasi as $key) { ?>
									<option <?php echo ($this->input->post("klasifikasi")==$key['id'])?"selected":"";?> value="<?php echo $key['id'];?>"><?php echo $key['klasifikasi'];?></option>
									<?php } ?>
								</select></td>
							</tr>
							<tr>
								<td></td>
								<td><div class="highlight"><button class="btn btn-primary" type="submit">Submit</button>  
								<a class="btn btn-success" href="<?php echo base_url("marketing/export_trx/?klasifikasi=".$this->input->post('klasifikasi')."&vendor=".$this->input->post('vendor')."&date_range=".$this->input->post('date_range')."&brand_name=".$this->input->post('brand_name')."&prefix=".$this->input->post('prefix'));?>">Export</a>
								<a class="btn btn-success" href="<?php echo base_url("marketing/export_trx_all/?klasifikasi=".$this->input->post('klasifikasi')."&vendor=".$this->input->post('vendor')."&date_range=".$this->input->post('date_range')."&brand_name=".$this->input->post('brand_name')."&prefix=".$this->input->post('prefix'));?>">Export All</a></div></td>
							</tr>
						</table>
					</form>
					<?php
					if($this->input->post('date_range')!=""){
					?>
					<table class="table table-bordered table-striped for_datatables">
						<thead>
							<tr>
								<th style="width:10px;">No.</th>
								<th>Date Join</th>
								<th>Brand Name</th>
								<th>Klasifikasi</th>
								<th>Type</th>
								<th>Num Ticket</th>
								<th>Sum NTA</th>
								<th>Sum PAX</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 

							$data = array();
							$pg = 1;
							$start = 0;

							$vendor = ($this->input->post('vendor')=="all")?"":$this->input->post('vendor');
							$datenya = $this->input->post('date_range');
							$daten = explode(" - ", $datenya);
							$date_start = $daten[0];
							$date_end = $daten[1];

							$this->db->select('id_mitra as idm,join_date,brand_name,prefix,type,(select sum(jml_tiket) from data_trx where id_mitra=idm AND date_resv >="'.date_format(date_create($date_start),"Y-m-d").'" AND date_resv <="'.date_format(date_create($date_end),"Y-m-d").'" AND vendor like "%'.$vendor.'%") as jml_tiket,(select sum(nta_idr) from data_trx where id_mitra=idm AND date_resv >="'.date_format(date_create($date_start),"Y-m-d").'" AND date_resv <="'.date_format(date_create($date_end),"Y-m-d").'" AND vendor like "%'.$vendor.'%") as jml_nta,(select sum(pax_idr) from data_trx where id_mitra=idm AND date_resv >="'.date_format(date_create($date_start),"Y-m-d").'" AND date_resv <="'.date_format(date_create($date_end),"Y-m-d").'" AND vendor like "%'.$vendor.'%") as jml_pax');
							$this->db->where('status','active');
							$this->db->like('brand_name',$this->input->post('brand_name'),'both');
							$this->db->like('prefix',$this->input->post('prefix'),'both');
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
									if($this->input->post('klasifikasi')!=""){

										if($this->input->post('klasifikasi')=="non" and $klas['id_klasifikasi']==NULL){
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
											<td><?php echo "<span onclick='openformdetail(".$key['idm'].")' style='cursor:pointer'>Detail</span>";?></td>
											</tr>
											<?php
										}

										if($klas['id_klasifikasi']==$this->input->post('klasifikasi')){
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
											<td><?php echo "<span onclick='openformdetail(".$key['idm'].")' style='cursor:pointer'>Detail</span>";?></td>
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
									<td><?php echo "<span onclick='openformdetail(".$key['idm'].")' style='cursor:pointer'>Detail</span>";?></td>
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
					?>
				</div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->