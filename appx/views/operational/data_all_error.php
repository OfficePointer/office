<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Data All Error
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

        <form method="POST" action="<?php echo base_url('operational/all_error');?>">
        <table class="table">
          <tr>
            <td>Date Error</td>
            <td><input value="<?php echo date_format(date_create($this->session->userdata('all_error_date_start')),"m/d/Y");?> - <?php echo date_format(date_create($this->session->userdata('all_error_date_end')),"m/d/Y");?>" type="text" name="date_error" class="datepicker form-control"></td>
          </tr>
          <tr>
            <td></td>
            <td><button class="btn btn-primary">Search</button>
            <a class="btn btn-warning" href="<?php echo base_url("operational/all_error/clear");?>">Reset</a>
            <a class="btn btn-success" href="<?php echo base_url("operational/expr_all_error");?>">Export</a></td>
          </tr>
        </table>
        </form>

            </div>
            <!-- /.box-footer -->
          </div>
      <table class="table table-bordered table-striped for_datatables">
        <thead>
          <tr>
            <th>No.</th>
            <th>Kasus</th>
            <th title="Kode Booking">KB</th>
            <th title="Solve Note">Solve NT</th>
            <th title="Solve DateTime">Solve DT</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
        foreach ($error as $key) {
            if($key['airline']==13){
              $key['airline'] = 'GA'; 
            }else if($key['airline']==12 or $key['airline']==2){
              $key['airline'] = 'JT';
            }

            if($key['status']==2 or $key['status']==21){
              $key['status'] = 'Confirmed'; 
            }else{
              $key['status'] = 'Waiting';
            }
            $url = 'https://admin.pointer.co.id/airline/admin/viewbook/'.$key['id_mitra'].'-'.$key['kode_booking'];
            if($key['airline']=="KAI"){
              $url = 'https://admin.pointer.co.id/train/admin/viewbook/'.$key['id_mitra'].'-'.$key['kode_booking'];
            }
        ?>
          <tr>
            <td><?php echo $key['id'];?></td>
            <td><?php echo $key['kasus'];?></td>
            <td><a onclick="error_followup('<?php echo $key["id"];?>','<?php echo $url;?>','<?php echo $key["kode_booking"];?>','<?php echo $key["brand_name"];?>')"><?php echo $key['kode_booking'];?></a></td>
            <td><?php echo $key['solve_note'];?></td>
            <td><?php echo $key['updated_at'];?></td>
            <td><a onclick="get_email('<?php echo $key["id"];?>','<?php echo $url;?>','<?php echo $key["kode_booking"];?>','<?php echo $key["brand_name"];?>','<?php echo $key["kasus"];?>')" data-toggle="tooltip" data-placement="top" title="Send E-Mail Solver">SEM</a> | <a onclick="openformdetail(<?php echo $key['id_mitra'];?>)" data-toggle="tooltip" data-placement="top" title="Detail Mitra">DTM</a> | <a data-toggle="tooltip" data-placement="left" title="Brand Name : <?php echo $this->general->get_member($key['id_mitra']);?> | Status : <?php echo $key['status'];?> | Error DateTime : <?php echo $key['created_at'];?> | Solve DateTime : <?php echo $key['updated_at'];?> | Solve By : <?php echo $this->general->get_user($key['updated_by']);?>">DTE</a></td>
          </tr>
        <?php
        }
        ?>
        </tbody>
      </table>
      </div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->