<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      New Manual Issued
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">

      <div class="col-md-12">
      <form method="POST" action="<?php echo base_url("operational/save_issued_manual");?>">


      <div class="col-md-4">
        <label>Kode Booking *)</label>
        <div class="input-group">
          <input autocomplete="off" type="text" required class="form-control" id="kode_booking" name="kode_booking">
          <span onclick="lookupcode()" style="cursor:pointer" class="input-group-addon"><i class="fa fa-search"></i></span>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="inside-box-im">
        <div class="col-md-4">
            <label>Tanggal Issued *)</label>
          <div class="input-group">
            <input autocomplete="off" type="text" required class="form-control for_date" name="tgl_info" id="tgl_info">
            <span onclick="openfordate('tgl_info')" class="input-group-addon"><i class="fa fa-calendar"></i></span>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-4">
          <label>Issued For</label>
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
          <label>Basic</label>
          <div class="form-group">
            <div id="basic" class="for_numberinput form-control"></div>
            <input autocomplete="off" type="hidden" class="form-control" name="basic" id="basic_num">
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-4">
          <label>NTA</label>
          <div class="form-group">
            <div id="nta" class="for_numberinput form-control"></div>
            <input autocomplete="off" type="hidden" class="form-control" name="nta" id="nta_num">
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
          <label>Memberpaid</label>
          <div class="form-group">
            <div id="memberpaid" class="for_numberinput form-control"></div>
            <input autocomplete="off" type="hidden" class="form-control" name="memberpaid" id="memberpaid_num">
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-4">
          <label>Class</label>
          <div class="form-group">
            <input autocomplete="off" type="text" class="form-control" name="class" id="class">
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-4">
          <label>Flight Type</label>
          <div class="form-group">
            <select class="form-control" name="flight_type" id="flight_type">
                  <option value="OW">Oneway</option>
                  <option value="CT">Connecting</option>
                  <option value="RT">Return</option>
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
        <div class="col-md-2">
          <label>Adult</label>
          <div class="form-group">
            <input autocomplete="off" type="number" class="form-control" name="adult" id="adult" value="0">
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-2">
          <label>Child</label>
          <div class="form-group">
            <input autocomplete="off" type="number" class="form-control" name="child" id="child" value="0">
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-2">
          <label>Infant</label>
          <div class="form-group">
            <input autocomplete="off" type="number" class="form-control" name="infant" id="infant" value="0">
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12">
          <label>Reason</label>
          <div class="form-group">
            <input autocomplete="off" type="text" class="form-control" name="reason" id="reason">
            <input autocomplete="off" type="hidden" class="form-control" name="paxinfo" id="paxinfo">
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
