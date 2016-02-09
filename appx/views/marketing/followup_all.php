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
            <td>Topup</td>
            <td><select name="topup" class="form-control">
              <option <?php echo ($this->session->userdata('followup_topup')=="")?"selected":"";?> value="">all</option>
              <option <?php echo ($this->session->userdata('followup_topup')=="yes")?"selected":"";?> value="yes">yes</option>
              <option <?php echo ($this->session->userdata('followup_topup')=="no")?"selected":"";?> value="no">no</option>
            </select></td>
          </tr>
          <tr>
            <td>Trx</td>
            <td><select name="trx" class="form-control">
              <option <?php echo ($this->session->userdata('followup_trx')=="")?"selected":"";?> value="">all</option>
              <option <?php echo ($this->session->userdata('followup_trx')=="yes")?"selected":"";?> value="yes">yes</option>
              <option <?php echo ($this->session->userdata('followup_trx')=="no")?"selected":"";?> value="no">no</option>
            </select></td>
          </tr>
          <tr>
            <td>Response</td>
            <td><select name="id_respon" class="form-control">
              <option <?php echo ($this->session->userdata('followup_respon')=="")?"selected":"";?> value="">all</option>
              <?php
              foreach ($response as $key) {
                ?>
                <option <?php echo ($this->session->userdata('followup_respon')==$key['id'])?"selected":"";?> value="<?php echo $key['id'];?>"><?php echo $key['respon'];?></option>
                <?php
              }
              ?>
            </select></td>
          </tr>
          <tr>
            <td>Provinsi</td>
            <td><input value="<?php echo $this->session->userdata('followup_province');?>" type="text" name="province" class="form-control"></td>
          </tr>
          <tr>
            <td>Klasifikasi</td>
            <td><select name="klasifikasi" class="form-control">
              <option <?php echo ($this->session->userdata('followup_klasifikasi')=="")?"selected":"";?> value="">all</option>
              <option <?php echo ($this->session->userdata('followup_klasifikasi')=="0")?"selected":"";?> value="0">No Data</option>
              <?php
              foreach($klasifikasi as $dataklasifikasi){
              ?>
              <option <?php echo ($this->session->userdata('followup_klasifikasi')==$dataklasifikasi['id'])?"selected":"";?> value="<?php echo $dataklasifikasi['id'];?>"><?php echo $dataklasifikasi['klasifikasi'];?></option>
              <?php } ?>
            </select></td>
          </tr>
          <tr>
            <td></td>
            <td><button class="btn btn-primary">Search</button>
            <a class="btn btn-warning" href="<?php echo base_url("marketing/followup_all/clear");?>">Reset</a></td>
          </tr>
        </table>
        </form>

            </div>
            <!-- /.box-footer -->
          </div>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th style="width:5px;">No.</th>
            <th style="width:50px;">Member Name</th>
            <th style="width:50px;">Klasifikasi</th>
            <th style="width:30px;">Date Join</th>
            <th style="width:400px;">Last Activity</th>
            <th style="width:5px;">TopUp</th>
            <th style="width:5px;">Trx</th>
            <th class="last" style="width:40px;">Action</th>
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
            <td id="detail_class_<?php echo $key['id_mitra'];?>" style="width:50px !important;"><?php echo ($key['klasifikasi']!="")?$key['klasifikasi']:"No Data";?></td>               
            <td style="width:90px;"><?php echo $key['join_date'];?></td>
            <td id="detail_fol_<?php echo $key['id_mitra'];?>" style="width:200px !important;"><?php echo ($key['type']!="")?$key['type']." : ".$key['respon']." : ".$key['reason']:"No one followup";?></td>               
            <td style="width:50px;"><?php echo $key['topup'];?></td>
            <td style="width:50px;"><?php echo $key['trx'];?></td>
            <td class="last"><a onclick="showactivity(<?php echo $key['id_mitra'];?>)"><span class="fa fa-reorder" title='View Details'></span></a> | <a onclick="openaddactivity(<?php echo $key['id_mitra'];?>)"><span class="fa fa-plus" title='Add New'></span></a></td>
          </tr>
          <tr style="display:none;" id="TR_<?php echo $key['id_mitra'];?>">
              <td colspan="8" id="TD_TR_<?php echo $key['id_mitra'];?>">
              </td>
          </tr>
        <?php
        $i++;
        }
        ?>
        </tbody>
      </table>
      <?php
      foreach ($followup_by as $key) {
        if($key['create_by']!=NULL){
          ?>
          <span class="btn"><?php echo $this->general->get_user($key['create_by'])." : ".$key['jumlah'];?></span>
          <?php 
        }
      }
      ?>
      <hr>
      <?php echo $paging;?>
      </div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->