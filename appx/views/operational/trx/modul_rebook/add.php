<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      New Rebook
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
            <select class="form-control" name="type_info">
              <?php foreach ($type_info as $key) {
                ?>
                  <option value="<?php echo $key['id'];?>"><?php echo $key['info'];?></option>
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
          <span onclick="lookupcode()" style="cursor:pointer" class="input-group-addon"><i class="fa fa-search"></i></span>
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
          <label>Pax</label> 
          <div class="form-group">
            <div id="pax" class="for_numberinput form-control"></div>
            <input autocomplete="off" type="hidden" class="form-control" name="pax" id="pax_num">
          </div>
        </div>

      <div class="clearfix"></div>
        <div class="col-md-4">
            <label>Nama Penumpang</label>
            <div class="form-group">
            <input type="text" class="form-control">
        </div>
      </div>

      <div class="clearfix"></div>
        <div class="col-md-4">
            <label>Class</label>
            <div class="form-group">
            <input type="text" class="form-control">
        </div>
      </div>


      <div class="clearfix"></div>
        <div class="col-md-4">
          <label>Rebook From</label> 
          <div class="form-group">
            <input autocomplete="off" type="text" class="form-control" name="from" id="rebook_from">
          </div>
      </div>


 
        <div class="col-md-4">
          <label>Rebook To</label> 
          <div class="form-group">
            <input autocomplete="off" type="text" class="form-control" name="to" id="rebook_to">
          </div>
      </div>


        <div class="col-md-4">
          <label>Rebook To 2</label> 
          <div class="form-group">
            <input autocomplete="off" type="text" class="form-control" name="to2" id="rebook_to2">
          </div>
      </div>

       <div class="col-md-4">
          <label>Class</label> 
          <div class="form-group">
            <input autocomplete="off" type="text" class="form-control" name="rebook_class" id="rebook_class">
          </div>
      </div>

      <div class="clearfix"></div>
      <div class="inside-box-im">
        <div class="col-md-4">
            <label>Date Flight *)</label> 
          <div class="input-group">
            <input autocomplete="off" type="text" required class="form-control for_date" name="tgl_info" id="tgl_info">
            <span onclick="openfordate('tgl_info')" class="input-group-addon"><i class="fa fa-calendar"></i></span>
          </div>
        </div>


        <div class="col-md-4">
          <label>Time Flight</label> 
          <div class="form-group">
            <input autocomplete="off" type="timepicker" class="form-control" name="time_flight" id="time_flight">
          </div>
      </div>


        <div class="clearfix"></div>
        <div class="col-md-4">
          <label>Time Limit</label> 
          <div class="form-group">
            <input autocomplete="off" type="datetime" class="form-control" name="to2" id="rebook_to2">
          </div>
      </div>
      
        
      <div class="clearfix"></div>
        <div class="col-md-4">
          <label>Airline Cost</label> 
          <div class="form-group">
            <div id="basic" class="for_numberinput form-control"></div>
            <input autocomplete="off" type="hidden" class="form-control" name="rebook_airlane_cost" id="rebook_airlane_cost">
          </div>
        </div>


        <div class="col-md-4">
          <label>Admin Cost</label> 
          <div class="form-group">
            <div id="nta" class="for_numberinput form-control"></div>
            <input autocomplete="off" type="hidden" class="form-control" name="rebook_admin_cost" id="rebook_admin_cost">
          </div>
        </div>


        <div class="clearfix"></div>
      <div class="inside-box-im">
        <div class="col-md-4">
            <label>Rebook Date *)</label> 
          <div class="input-group">
            <input autocomplete="off" type="text" required class="form-control for_date" name="tgl_info" id="tgl_info">
            <span onclick="openfordate('tgl_info')" class="input-group-addon"><i class="fa fa-calendar"></i></span>
          </div>
        </div>

        
        <div class="clearfix"></div>
        <div class="col-md-4">
          <label>Nomor Tiket</label> 
          <div class="form-group">
            <input autocomplete="off" type="text" class="form-control" name="nomor_tiket" id="nomor_tiket">
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