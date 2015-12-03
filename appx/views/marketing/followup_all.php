<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Follow Up Member
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
        <form method="POST" action="<?php echo base_url('marketing/followup_all');?>">
        <table class="table">
          <tr>
            <td>Brand Name</td>
            <td><input value="<?php echo $this->session->userdata('followup_brand_name');?>" type="text" name="brand_name" class="form-control"></td>
          </tr>
          <tr>
            <td>Prefix</td>
            <td><input value="<?php echo $this->session->userdata('followup_prefix');?>" type="text" name="prefix" class="form-control"></td>
          </tr>
          <tr>
            <td>Date Join</td>
            <td><input value="<?php echo $this->session->userdata('followup_date_join');?>" type="text" name="date_join" class="datepicker form-control"></td>
          </tr>
          <tr>
            <td>Date Activity</td>
            <td><input value="<?php echo $this->session->userdata('followup_date_activity');?>" type="text" name="date_activity" class="datepicker form-control"></td>
          </tr>
          <tr>
            <td>Status</td>
            <td><select name="status" class="form-control">
              <option <?php echo ($this->session->userdata('followup_status')=="active")?"selected":"";?> value="active">active</option>
              <option <?php echo ($this->session->userdata('followup_status')=="pending")?"selected":"";?> value="pending">pending</option>
              <option <?php echo ($this->session->userdata('followup_status')=="rejected")?"selected":"";?> value="rejected">rejected</option>
              <option <?php echo ($this->session->userdata('followup_status')=="blocked")?"selected":"";?> value="blocked">blocked</option>
              <option <?php echo ($this->session->userdata('followup_status')=="all")?"selected":"";?> value="">all</option>
            </select></td>
          </tr>
          <tr>
            <td>Provinsi</td>
            <td><input value="<?php echo $this->session->userdata('followup_province');?>" type="text" name="province" class="form-control"></td>
          </tr>
          <tr>
            <td></td>
            <td><button class="btn btn-primary">Search</button>
            <a class="btn btn-warning" href="<?php echo base_url("marketing/followup_all/clear");?>">Reset</a></td>
          </tr>
        </table>
        </form>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th style="width:5px;">No.</th>
            <th style="width:50px;">Member Name</th>
            <th style="width:30px;">Date Join</th>
            <th style="width:400px;">Last Activity</th>
            <th style="width:5px;">TopUp</th>
            <th style="width:5px;">Trx</th>
            <th class="last" style="width:120px;">Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $i=1;
        foreach ($followup_data as $key) {
        ?>
          <tr>
            <td style="text-align:center"><?php echo $i;?></td>
            <td style="width:200px;"><a onclick="openformdetail(<?php echo $key['id_mitra'];?>)"><?php echo $key['brand_name'];?></a></td>
            <td style="width:90px;"><?php echo $key['join_date'];?></td>
            <td id="detail_fol_<?php echo $key['id_mitra'];?>" style="width:200px !important;"></td>               
            <td style="width:50px;"><?php echo $key['topup'];?></td>
            <td style="width:50px;"><?php echo $key['trx'];?></td>
            <td class="last"><a onclick="showactivity(<?php echo $key['id_mitra'];?>)"><span class="glyphicon glyphicon-search" title='View Details'></span> View</a> | <a onclick="openaddactivity(<?php echo $key['id_mitra'];?>)"><span class="glyphicon glyphicon-plus" title='Add New'></span> Add</a></td>
          </tr>
          <tr style="display:none;" id="TR_<?php echo $key['id_mitra'];?>">
              <td colspan="7" id="TD_TR_<?php echo $key['id_mitra'];?>">
              </td>
          </tr>
        <?php
        $i++;
        }
        ?>
        </tbody>
      </table>
      <?php echo $paging;?>
      <?php
        foreach ($followup_data as $key) {
        ?>
        <script type="text/javascript">
          get_activity_info(<?php echo $key['id_mitra'];?>);
        </script>
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