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

        <?php 
        if($this->uri->segment(3)!="new"){?>
          <div class="box box-solid collapsed-box">
            <div class="box-header" style="cursor: move;">
              <i class="fa fa-filter"></i>

              <h3 class="box-title">Filter Data</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-sm" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <div class="box-body border-radius-none collapse" style="display: none;">

        <form method="POST" action="<?php echo base_url('marketing/member');?>">
        <table class="table">
          <tr>
            <td>Brand Name</td>
            <td><input value="<?php echo $this->session->userdata('brand_name');?>" type="text" name="brand_name" class="form-control"></td>
          </tr>
          <tr>
            <td>Prefix</td>
            <td><input value="<?php echo $this->session->userdata('prefix');?>" type="text" name="prefix" class="form-control"></td>
          </tr>
          <tr>
            <td>Date Join</td>
            <td><input value="<?php echo $this->session->userdata('date_join_start')." - ".$this->session->userdata('date_join_end');?>" type="text" name="date_join" class="datepicker form-control"></td>
          </tr>
          <tr>
            <td>Status</td>
            <td><select name="status" class="form-control">
              <option <?php echo ($this->session->userdata('status')=="")?"selected":"";?> value="">all</option>
              <option <?php echo ($this->session->userdata('status')=="active")?"selected":"";?> value="active">active</option>
              <option <?php echo ($this->session->userdata('status')=="pending")?"selected":"";?> value="pending">pending</option>
              <option <?php echo ($this->session->userdata('status')=="rejected")?"selected":"";?> value="rejected">rejected</option>
              <option <?php echo ($this->session->userdata('status')=="blocked")?"selected":"";?> value="blocked">blocked</option>
            </select></td>
          </tr>
          <tr>
            <td>Type</td>
            <td><select name="type" class="form-control">
              <option <?php echo ($this->session->userdata('type')=="")?"selected":"";?> value="">all</option>
              <?php

              $type = $this->db->get('type');
              foreach($type->result_array() as $datatype){
              ?>
              <option <?php echo ($this->session->userdata('type')==$datatype['type'])?"selected":"";?> value="<?php echo $datatype['type'];?>"><?php echo $datatype['type'];?></option>
              <?php } ?>
            </select></td>
          </tr>
          <tr>
            <td>Provinsi</td>
            <td><input value="<?php echo $this->session->userdata('province');?>" type="text" name="province" class="form-control"></td>
          </tr>
          <tr>
            <td></td>
            <td><button class="btn btn-primary">Search</button>
            <a class="btn btn-success" href="<?php echo base_url("marketing/export_excel");?>">Export</a>
            <a class="btn btn-warning" href="<?php echo base_url("marketing/member/clear");?>">Reset</a></td>
          </tr>
        </table>
        </form>
        </div>
        </div>
        <?php } ?>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Date Join</th>
            <th>Brand Name</th>
            <th>Type</th>
            <th>Province</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
        <?php
        foreach ($mitra as $key) {
        ?>
          <tr>
            <td><?php echo $key['join_date'];?></td>
            <td><a onclick="openformdetail(<?php echo $key['id_mitra'];?>)"><?php echo $key['brand_name']." (".$key['prefix'].")";?></a></td>
            <td><?php echo $key['type'];?></td>
            <td><?php echo $key['province'];?></td>
            <td><?php echo $key['status'];?></td>
          </tr>
        <?php
        }
        ?>
        </tbody>
      </table>
      <?php echo ($this->uri->segment(3)!="new")?$paging:"";?>
      </div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->