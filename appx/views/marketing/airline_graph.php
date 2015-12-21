		<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Airline Graph
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">

      <div class="col-md-12">
		<form action="<?php echo base_url("marketing/airline_graph");?>" method="post">
						<table class="table">
							<tr>
								<td>Month</td>
								<td><select class="form-control" name="bulan">
									<option <?php echo ($this->input->post("bulan")=="01")?"selected":"";?> value="01">Januari</option>
									<option <?php echo ($this->input->post("bulan")=="02")?"selected":"";?> value="02">Februari</option>
									<option <?php echo ($this->input->post("bulan")=="03")?"selected":"";?> value="03">Maret</option>
									<option <?php echo ($this->input->post("bulan")=="04")?"selected":"";?> value="04">April</option>
									<option <?php echo ($this->input->post("bulan")=="05")?"selected":"";?> value="05">Mei</option>
									<option <?php echo ($this->input->post("bulan")=="06")?"selected":"";?> value="06">Juni</option>
									<option <?php echo ($this->input->post("bulan")=="07")?"selected":"";?> value="07">Juli</option>
									<option <?php echo ($this->input->post("bulan")=="08")?"selected":"";?> value="08">Agustus</option>
									<option <?php echo ($this->input->post("bulan")=="09")?"selected":"";?> value="09">September</option>
									<option <?php echo ($this->input->post("bulan")=="10")?"selected":"";?> value="10">Oktober</option>
									<option <?php echo ($this->input->post("bulan")=="11")?"selected":"";?> value="11">November</option>
									<option <?php echo ($this->input->post("bulan")=="12")?"selected":"";?> value="12">Desember</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>Year</td>
								<td>
									<input class="form-control" value="<?php echo $this->input->post("tahun");?>" type="number" minlength="4" maxlength="4" name="tahun">
								</td>
							</tr>
							<tr>
								<td></td>
								<td><button type="submit" class="btn btn-primary">Submit</button>  
									<a class="btn btn-success" href="<?php echo base_url();?>marketing/airline_graph_export/?bulan=<?php echo $this->input->post('bulan');?>&tahun=<?php echo $this->input->post('tahun');?>">Export</a>
								</td>
							</tr>
						</table>
					</form>
          <div style="width:100%;overflow-x:scroll;">
					<?php
					if($this->input->post('tahun')!="" and strlen($this->input->post('tahun'))==4){
						//echo $this->input->post('tahun')."-".$this->input->post('bulan')."-";
						
						$xa = $this->db->get('data_kode');
						$xa = $xa->result_array();
						//echo $this->db->last_query();
						echo "<table class='table table-bordered table-striped for_datatables_asc'><thead><tr>";
						echo "<th>Airline</th>";		
						for($i=1;$i<=31;$i++){
							if(checkdate($this->input->post('bulan'), $i, $this->input->post('tahun'))){
								echo "<th>".$i."</th>";
							}
						}
						echo "<th>Total</th>";		
						echo "</tr></thead><tbody>";
						foreach($xa as $key) {
						$total = 0;		
						echo "<tr>";
						echo "<td>".$key['isi']."</td>";	
							for($i = 1;$i<=31;$i++){

							if(checkdate($this->input->post('bulan'), $i, $this->input->post('tahun'))){
								$this->db->where('kode',$key['kode']);
								$this->db->where('tipe','tanggal');
								$this->db->where('jenis','vendor');
								$this->db->where('date_vend',$this->input->post('tahun')."-".$this->input->post('bulan')."-".$i);
								$aaa = $this->db->get('data_statistik');
								$aaa = $aaa->row_array();
								$total+=(isset($aaa['jumlah'])?$aaa['jumlah']:0);
								echo "<td>".(isset($aaa['jumlah'])?$aaa['jumlah']:"0")."</td>";
							}
							}
						echo "<td>".$total."</td>";
						echo "</tr>";
						}
						echo "</tbody></table>";
					}
					?>
					</div>
</div>

      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->