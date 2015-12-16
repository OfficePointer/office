<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Data Responses
    </h1>
  </section>

<!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">

        <form action="<?= base_url('marketing/responupdate'); ?>" method="post">
          <table class="table">
            <tr>
              <td>Response</td>
              <input type="hidden" name="id" class="form-control" value=" <?= $dataRespon['id']; ?> ">
              <td><input type="text" name="respon" class="form-control" value=" <?= $dataRespon['respon']; ?> "></td>
            </tr>

            <tr>
              <td></td>
              <td><button type="submit" class="btn btn-primary">Edit Data</button>
            </tr>
          </table>
        </form>

      </div>
    </div>
<!-- /.row (main row) -->

  </section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
