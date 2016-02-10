<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      NTA Garuda
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">

      <div class="col-md-12">
      <form method="POST" action="<?php echo base_url("operational/save_nta_garuda");?>">



      <div class="clearfix"></div>
        <div class="col-md-4">
          <label>Nama Member</label>
          <div class="form-group">
            <input autocomplete="off" type="text" required class="form-control for_mitra" name="mitra" id="mitra">
            <input autocomplete="off" type="hidden" required class="form-control" name="id_mitra" id="id_mitra">
          </div>
        </div>


       <div class="clearfix"></div>
        <div class="col-md-4">
          <label>Pax Paid</label> 
          <div class="form-group">
            <div id="pax" class="for_numberinput form-control"></div>
            <input autocomplete="off" type="hidden" class="form-control" name="pax" id="pax_num">
          </div>
        </div>

		<div class="clearfix"></div>
        <div class="col-md-4">
          <label>Basic</label> 
          <div class="form-group">
            <div id="basic" class="for_numberinput form-control"></div>
            <input autocomplete="off" type="hidden" class="form-control" name="basic" id="basic_num">
          </div>
        </div>

         <div class="clearfix"></div>
        <div class="col-md-4">
          <label>Tax</label> 
          <div class="form-group">
            <div id="basic" class="for_numberinput form-control"></div>
            <input autocomplete="off" type="hidden" class="form-control" name="tax" id="tax_num">
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <div class="">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </div>
      </div>
      </form>
      </div>

      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

