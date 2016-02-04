<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo ($this->uri->segment(3)=="new")?"New":"All";?> Member
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
<form action="" method="post">
			<table class="table">
				<tr>
					<td>Year</td>
					<td>
						<input class="form-control" required value="<?php echo $this->input->post("tahun");?>" type="number" minlength="4" maxlength="4" name="tahun">
					</td>
				</tr>
				<tr>
					<td></td>
					<td><div class="highlight"><button class="btn btn-primary" type="submit">Submit</button>
					<a class="btn btn-success" href="<?php echo base_url('marketing/export_member_monthly?tahun='.(($this->input->post('tahun')=="")?2015:$this->input->post('tahun')));?>">Export</a>
					</div></td>  
				</tr>
			</table>
		</form>
		<div style="overflow-x:scroll;overflow-y:hidden;">
		<table id="example2" style="width:2000px;" class="table table-bordered table-striped for_datatables_asc">
		<thead>
			<tr>
				<th>Date Join</th>
				<th>Klasifikasi</th>
				<th>Brand Name</th>
				<th>Jan</th>
				<th>%</th>
				<th>A</th>
				<th>Feb</th>
				<th>%</th>
				<th>A</th>
				<th>Mar</th>
				<th>%</th>
				<th>A</th>
				<th>Apr</th>
				<th>%</th>
				<th>A</th>
				<th>Mei</th>
				<th>%</th>
				<th>A</th>
				<th>Jun</th>
				<th>%</th>
				<th>A</th>
				<th>Jul</th>
				<th>%</th>
				<th>A</th>
				<th>Agu</th>
				<th>%</th>
				<th>A</th>
				<th>Sep</th>
				<th>%</th>
				<th>A</th>
				<th>Okt</th>
				<th>%</th>
				<th>A</th>
				<th>Nov</th>
				<th>%</th>
				<th>A</th>
				<th>Des</th>
				<th>%</th>
				<th>A</th>
				<th>Total</th>
				<th>%</th>
				<th>A</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if(!empty($data)){
		$datas = $data;
		foreach ($datas as $key) {
		?>
			<tr>
				<td><?php echo $key[0];?></td>
				<td><?php echo $key[41];?></td>
				<td><?php echo $key[1];?></td>
				<td><?php echo $key[2];?></td>
				<td><?php echo $key[3];?></td>
				<td><?php echo $key[4];?></td>
				<td><?php echo $key[5];?></td>
				<td><?php echo $key[6];?></td>
				<td><?php echo $key[7];?></td>
				<td><?php echo $key[8];?></td>
				<td><?php echo $key[9];?></td>
				<td><?php echo $key[10];?></td>
				<td><?php echo $key[11];?></td>
				<td><?php echo $key[12];?></td>
				<td><?php echo $key[13];?></td>
				<td><?php echo $key[14];?></td>
				<td><?php echo $key[15];?></td>
				<td><?php echo $key[16];?></td>
				<td><?php echo $key[17];?></td>
				<td><?php echo $key[18];?></td>
				<td><?php echo $key[19];?></td>
				<td><?php echo $key[20];?></td>
				<td><?php echo $key[21];?></td>
				<td><?php echo $key[22];?></td>
				<td><?php echo $key[23];?></td>
				<td><?php echo $key[24];?></td>
				<td><?php echo $key[25];?></td>
				<td><?php echo $key[26];?></td>
				<td><?php echo $key[27];?></td>
				<td><?php echo $key[28];?></td>
				<td><?php echo $key[29];?></td>
				<td><?php echo $key[30];?></td>
				<td><?php echo $key[31];?></td>
				<td><?php echo $key[32];?></td>
				<td><?php echo $key[33];?></td>
				<td><?php echo $key[34];?></td>
				<td><?php echo $key[35];?></td>
				<td><?php echo $key[36];?></td>
				<td><?php echo $key[37];?></td>
				<td><?php echo $key[38];?></td>
				<td><?php echo $key[39];?></td>
				<td><?php echo $key[40];?></td>
			</tr>
		<?php
		}
		?>
		</tbody>
		</table>
		</div>
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