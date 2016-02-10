<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <br>NTA Garuda<br>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">

      <div class="col-md-12">

      <table class="table table-bordered table-striped">
        <thead>
          <tr>
      
            <th>Nama Member</th>
            <th>Tipe Member</th>
            <th>Pax Paid</th>
            <th>Basic</th>
            <th>Tax</th>
    
          </tr>
        </thead>
        <tbody>
        <?php
        foreach ($actionsys as $key) {
        ?>
          <tr>

            <td><?php echo $this->general->get_member($key['id_mitra']);?></td>
            <td><?php echo $key['tipe_meber'];?></td>
            <td><?php echo $key['pax_num'];?></td>
            <td><?php echo $key['basic_num'];?></td>
            <td><?php echo $key['tax_num'];?></td>

            <td><a onclick="openrequest('<?php echo $key['id'];?>')">Open</a></td>

          </tr>
        <?php
        }
        ?>
        </tbody>
      </table>
        
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->