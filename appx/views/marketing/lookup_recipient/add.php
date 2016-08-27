<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">    
    <span class="pull-right"><a class="btn btn-success" href="<?php echo base_url("marketing/lookup_recipient");?>">All Lookup Recipient</a></span>

      <h1>
      Add Lookup Recipient
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-md-12">
      <form method="POST" action="<?php echo base_url("marketing/lookup_recipient_save");?>">
        <div class="form-group">
          <label>Name</label>
          <input type="text" class="form-control" required name="name" placeholder="Name of Lookup Recipient">
        </div>
      	<div class="form-group">
      		<label>Query</label>
      		<textarea class="form-control notes" required name="query" id="notes">select id_mitra as 'id_mitra', brand_name as 'name', email as 'email' from data_mitra where type='Mitra' and status='active'</textarea>
      	</div>
      	<div class="form-group">
      		<div class="pull-right">
      			<button type="submit" class="btn btn-primary">Submit</button>
      		</div>
      	</div>
      </form>
      </div>

      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>