<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add Data Responses
    </h1>
  </section>

<!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">

        <form action="<?= base_url('marketing/responsave'); ?>" method="post">
          <table class="table">
            <tr>
              <td>Response</td>
              <td><input type="text" name="respon" class="form-control" required></td>
            </tr>

            <tr>
              <td></td>
              <td><button type="submit" class="btn btn-primary">Save Data</button>
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
