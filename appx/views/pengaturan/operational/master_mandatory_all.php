<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Master Mandatory
    </h1>
  </section>

<!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">

        <table class="table table-bordered table-striped for_datatables_asc">
          <thead>
            <tr>
              <th> Group </th>
              <th> Sequence </th>
              <th> Mandatory </th>
              <th> Function </th>
              <th> Example </th>
              <th> Type </th>
              <th> Action </th>
            </tr>
          </thead>

          <tbody>
            <?php
              $i=1;
              foreach ($data as $key) {
            ?>

            <tr>
              <td> <?= $key['k_mand'];?> </td>
              <td> <?= $key['u_mand'];?> </td>
              <td> <?= $key['mand'];?> </td>
              <td> <?= $key['f_mand'];?> </td>
              <td> <?= $key['c_mand'];?> </td>
              <td> <?= $key['t_mand'];?> </td>

              <td><a href="  <?= base_url('pengaturan/mandatoryviewedit/'.$key['id_mand']);?> "><span class="fa fa-pencil"></span></a> |
                  <a href=" <?= base_url('pengaturan/mandatoryviewdelete/'.$key['id_mand']);?> "><span class="fa fa-trash"></span></a></td>
            </tr>

            <?php
              $i++;
                }
            ?>
          </tbody>
        </table>

        <span class="pull-left"><a class="btn btn-success" href="<?php echo base_url("pengaturan/mandatoryviewadd");?>">Add Mandatory</a></span>
      </div>
    </div>
<!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
