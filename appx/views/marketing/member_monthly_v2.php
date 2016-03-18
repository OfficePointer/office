<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Member Monthly 
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
		<?php
		if($this->input->post('tahun')!=""){
		?>
		<div style="overflow-x:scroll;overflow-y:hidden;">
		<table id="example2" style="width:2000px;" class="table table-bordered table-striped for_datatables_asc">
		<thead>
			<tr>
				<th>Date Join</th>
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