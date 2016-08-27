<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">    
    <span class="pull-right"><a class="btn btn-success" href="<?php echo base_url("marketing/subscribers_list/");?>">All Subscribers List</a></span>
      <h1>Detail Subscribers List "<?php echo $data['name'];?>"</h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-md-12">
        <table class="table for_datatables_asc">
          <thead>
            <tr>
              <th>No</th>
              <th>Name</th>
              <th>E-Mail</th>
              <th>Classification</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($recipient as $key => $value) { ?>
            <tr>
              <td><?php echo $key+1;?></td>
              <td><?php echo $value['name'];?></td>
              <td><?php echo $value['email'];?></td>
              <td><?php echo $this->general->get_klasifikasi($value['id_mitra']);?></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>

      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>