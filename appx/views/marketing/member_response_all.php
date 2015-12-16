<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Master Responses All
    </h1>
  </section>

<!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">

        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th> Responses </th>
              <th> Action </th>
            </tr>
          </thead>

          <tbody>
            <?php
              $i=1;
              foreach ($dataRespon as $key) {
            ?>

            <tr>
              <td> <?= $key['respon'];?> </td>

              <td><a href=" <?= base_url('marketing/responedit/'.$key['id']);?> ">Edit</a></td>
              <td><a href=" <?= base_url('marketing/respondelete/'.$key['id']);?> ">Delete</a></td>
            </tr>

            <?php
              $i++;
                }
            ?>
          </tbody>
        </table>

      </div>
    </div>
  </section>

      </div>
    </div>
<!-- /.row (main row) -->

  </section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
