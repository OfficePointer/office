<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Rebook Data
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">

      <div class="col-md-12">
      <form method="POST" action="<?php echo base_url("operational/save_rebook");?>">


      <div class="clearfix"></div>
        <div class="col-md-4">
          <label>Tipe Rebook</label>
          <div class="form-group">
            <select class="form-control" name="id_infosys">
              <?php foreach ($type_info as $key) {
                ?>
                  <option value="<?php echo $key['id'];?>"><?php echo $key['title'];?></option>
                <?php
              }
              ?>
            </select>
          </div>
      </div>

      <div class="clearfix"></div>
      <div class="col-md-4">
        <label>Kode Booking *)</label>
        <div class="input-group">
          <input autocomplete="off" type="text" required class="form-control" id="kode_booking" name="kode_booking">
          <span onclick="lookupcode('rebook')" style="cursor:pointer" class="input-group-addon"><i class="fa fa-search"></i></span>
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
          <label>Vendor</label>
          <div class="form-group">
            <select class="form-control" name="vendor" id="vendor">
              <?php foreach ($vendor as $key) {
                ?>
                  <option value="<?php echo $key['id'];?>"><?php echo $key['nama'].(($key['company']!="")?" - ".$key['company']:"");?></option>
                <?php
              }
              ?>
            </select>
          </div>
        </div>


      <div class="clearfix"></div>
        <div class="col-md-4">
          <label>From</label>
          <div class="form-group">
            <input autocomplete="off" type="text" class="form-control" name="from" id="from">
          </div>
      </div>


      <div class="clearfix"></div>
        <div class="col-md-4">
          <label>To</label>
          <div class="form-group">
            <input autocomplete="off" type="text" class="form-control" name="to" id="to">
          </div>
      </div>


      <div class="clearfix"></div>
        <div class="col-md-4">
          <label>To 2</label>
          <div class="form-group">
            <input autocomplete="off" type="text" class="form-control" name="to2" id="to2">
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
            <label>Class</label>
            <div class="form-group">
            <input type="text" class="form-control" name="class" id="class">
        </div>
      </div>
      <div class="clearfix"></div>

<fieldset>
<legend>New Data</legend>
        <div class="col-md-3">
          <label>Rebook From</label>
          <div class="form-group">
            <input autocomplete="off" type="text" class="form-control" name="rebook_from" id="rebook_from">
          </div>
      </div>



        <div class="col-md-3">
          <label>Rebook To</label>
          <div class="form-group">
            <input autocomplete="off" type="text" class="form-control" name="rebook_to" id="rebook_to">
          </div>
      </div>


        <div class="col-md-3">
          <label>Rebook To 2</label>
          <div class="form-group">
            <input autocomplete="off" type="text" class="form-control" name="rebook_to2" id="rebook_to2">
          </div>
      </div>

       <div class="col-md-3">
          <label>Class</label>
          <div class="form-group">
            <input autocomplete="off" type="text" class="form-control" name="rebook_class" id="rebook_class">
          </div>
      </div>

      <div class="clearfix"></div>
      <div class="inside-box-im">
        <div class="col-md-3">
            <label>Date Flight</label>
          <div class="input-group">
            <input autocomplete="off" type="text" required class="form-control for_date" name="rebook_date_flight" id="rebook_date_flight">
            <span onclick="openfordate('rebook_date_flight')" class="input-group-addon"><i class="fa fa-calendar"></i></span>
          </div>
        </div>


        <div class="col-md-3">
          <label>Time Flight</label>
          <div class="form-group">
            <input autocomplete="off" type="timepicker" class="form-control" name="rebook_time_flight" id="rebook_time_flight">
          </div>
      </div>


        <div class="col-md-3">
          <label>Time Limit</label>
          <div class="form-group">
            <input autocomplete="off" type="datetime" class="form-control" name="rebook_timelimit" id="rebook_timelimit">
          </div>
      </div>

        <div class="col-md-3">
            <label>Rebook Date</label>
          <div class="input-group">
            <input autocomplete="off" type="text" required class="form-control for_date" name="rebook_process" id="rebook_process" value="<?php echo date("m/d/Y");?>">
            <span onclick="openfordate('rebook_process')" class="input-group-addon"><i class="fa fa-calendar"></i></span>
          </div>
        </div>

      <div class="clearfix"></div>
        <div class="col-md-4">
          <label>Airline Cost</label>
          <div class="form-group">
            <div id="rebook_airline_cost_div" class="for_numberinput form-control"></div>
            <input autocomplete="off" type="hidden" class="form-control" name="rebook_airline_cost" id="rebook_airline_cost">
          </div>
        </div>

      <div class="clearfix"></div>


        <div class="col-md-4">
          <label>Admin Cost</label>
          <div class="form-group">
            <div id="rebook_admin_cost_div" class="for_numberinput form-control"></div>
            <input autocomplete="off" type="hidden" class="form-control" name="rebook_admin_cost" id="rebook_admin_cost">
          </div>
        </div>

        <div class="clearfix"></div>
        <div class="col-md-4">
          <label>Nomor Tiket</label>
          <div class="form-group">
            <input autocomplete="off" type="text" class="form-control" name="nomor_tiket" id="nomor_tiket">
          </div>
      </div>
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
