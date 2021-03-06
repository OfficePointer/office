<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Refund Data
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">

      <div class="col-md-12">
      <form method="POST" action="<?php echo base_url("operational/save_refund");?>">



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
            <label>Nama Penumpang</label>
            <div class="form-group">
            <input type="text" class="form-control" name="pax_name" id="pax_name">
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
            <label>Class</label>
            <div class="form-group">
            <input type="text" class="form-control" name="class" id="class">
        </div>
      </div>
      <div class="clearfix"></div>

<fieldset>
<legend>Refund Data</legend>

      <div class="clearfix"></div>
      <div class="inside-box-im">
        <div class="col-md-4">
            <label>Tanggal Proses Refund</label>
          <div class="input-group">
            <input autocomplete="off" type="text" required class="form-control for_date" name="refund_cost_received" id="refund_cost_received">
            <span onclick="openfordate('refund_cost_received')" class="input-group-addon"><i class="fa fa-calendar"></i></span>
          </div>
        </div>

        <div class="clearfix"></div>
        <div class="col-md-4">
            <label>Tanggal Keluar Refund</label>
          <div class="input-group">
            <input autocomplete="off" type="text" required class="form-control for_date" name="refund_cost_out" id="refund_cost_out" value="<?php echo date("m/d/Y");?>">
            <span onclick="openfordate('refund_cost_out')" class="input-group-addon"><i class="fa fa-calendar"></i></span>
          </div>
        </div>

         <div class="clearfix"></div>
        <div class="col-md-4">
            <label>No. Tanda Terima</label>
            <div class="form-group">
            <input type="text" class="form-control" name="nota_airline" id="nota_airline">
        </div>
      </div>
      <div class="clearfix"></div>

       <div class="clearfix"></div>
        <div class="col-md-4">
            <label>Perkiraan Amount</label>
            <div class="form-group">
            <input type="text" class="form-control" name="refund_est_amount" id="refund_est_amount">
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
