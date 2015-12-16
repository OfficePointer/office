<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Data Classification
    </h1>
  </section>

<!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">

        <form action="<?= base_url('marketing/classificationupdate'); ?>" method="post">
          <table class="table">
            <tr>
              <td>Classification</td>
              <input type="hidden" name="id" class="form-control" value=" <?= $dataClassification['id']; ?> ">
              <td><input type="text" name="klasifikasi" class="form-control" value=" <?= $dataClassification['klasifikasi']; ?> "></td>
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
