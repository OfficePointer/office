<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Mandatory Garuda Indonesia
    </h1>
  </section>

<!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">

        <form action="<?= base_url('pengaturan/mandatoryviewsave'); ?>" method="post">
          <table class="table">

            <tr>
              <td>Group</td>
              <td><input style='text-transform:uppercase' type="text" name="k_mand" class="form-control" required></td>
            </tr>
            <tr>
              <td>Sequence</td>
              <td><input type="number" name="u_mand" class="form-control" required></td>
            </tr>
            <tr>
              <td>Mandatory</td>
              <td><input style='text-transform:uppercase' type="text" name="mand" class="form-control" required></td>
            </tr>
            <tr>
              <td>Function</td>
              <td><input style='text-transform:uppercase' type="text" name="f_mand" class="form-control" required></td>
            </tr>
            <tr>
              <td>Example</td>
              <td><input style='text-transform:uppercase' type="text" name="c_mand" class="form-control" required></td>
            </tr>
            <tr>
              <td>Type</td>
              <td><select name="t_mand" class="form-control">
                <option value="ABACUS">ABACUS</option>
                <option value="ALTEA">ALTEA</option>
              </select></td>
            </tr>

            <tr>
              <td></td>
              <td><button type="submit" class="btn btn-primary">Submit</button>
              <span style="padding-left :10px;"><a class="btn btn-success" href="<?php echo base_url("pengaturan/mandatoryviewall");?>">View All Mandatory</a></span>
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
