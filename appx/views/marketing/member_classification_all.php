<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Master Classification
    </h1>
  </section>

<!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">

        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th> Classification </th>
              <th> Action </th>
            </tr>
          </thead>

          <tbody>
            <?php
              $i=1;
              foreach ($dataClassification as $key) {
            ?>

            <tr>
              <td> <?= $key['klasifikasi'];?> </td>

              <td><a href="  <?= base_url('marketing/classificationedit/'.$key['id']);?> ">Edit</a></td>
              <td><a href=" <?= base_url('marketing/classificationdelete/'.$key['id']);?> ">Delete</a></td>
            </tr>

            <?php
              $i++;
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
