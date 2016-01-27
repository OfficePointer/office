<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Void Garuda
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">

      <div class="col-md-12">
      <form method="POST" action="<?php echo base_url("operational/save_void_garuda");?>">



      <div class="clearfix"></div>
      <div class="col-md-4">
        <label>Kode Booking *)</label>
        <div class="form-group">
          <input autocomplete="off" type="text" required class="form-control " id="kode_booking" name="kode_booking">
        </div>
      </div>



      <div class="clearfix"></div>
        <div class="col-md-4">
          <label>Brand Name</label>
          <div class="form-group">
            <input autocomplete="off" type="text" required class="form-control for_mitra" name="mitra" id="mitra">
            <input autocomplete="off" type="hidden" required class="form-control" name="id_mitra" id="id_mitra">
          </div>
        </div>


      <div class="clearfix"></div>
        <div class="col-md-4">
          <label>Nomor Tiket</label>
          <div class="form-group">
            <input autocomplete="off" type="text" class="form-control" name="nomor_tiket" id="nomor_tiket">
          </div>
      </div>


      <div class="clearfix"></div>
      <div class="col-md-4">
          <label>Nama Penumpang</label>
          <div class="form-group">
          <input type="text" class="form-control" name="pax_name" id="pax_name">
      </div>
    </div>


         <div class="clearfix"></div>
        <div class="col-md-4">
            <label>Mandatory Void</label>
            <div class="form-group">
            <textarea type="text" class="form-control" name="void_mandatory" id="void_mandatory"></textarea>
        </div>
      </div>

      <div class="clearfix"></div>


  </fieldset>
            <input autocomplete="off" type="hidden" class="form-control" name="paxinfo" id="paxinfo">

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
