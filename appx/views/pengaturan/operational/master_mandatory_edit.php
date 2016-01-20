<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Update Mandatory
    </h1>
  </section>

<!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">

        <form action="<?= base_url('pengaturan/mandatoryviewupdate'); ?>" method="post">
          <table class="table">

            <tr>
              <input type="hidden" name="id_mand" class="form-control" value="<?= $data['id_mand']; ?>">
              <td>Group</td>
              <td><input style='text-transform:uppercase' type="text" name="k_mand" class="form-control" value="<?= $data['k_mand']; ?>" required></td>
            </tr>
            <tr>
              <td>Sequence</td>
              <td><input type="number" name="u_mand" class="form-control" value="<?= $data['u_mand']; ?>" required></td>
            </tr>
            <tr>
              <td>Mandatory</td>
              <td><input style='text-transform:uppercase' type="text" name="mand" class="form-control" value="<?= $data['mand']; ?>" required></td>
            </tr>
            <tr>
              <td>Function</td>
              <td><input style='text-transform:uppercase' type="text" name="f_mand" class="form-control" value="<?= $data['f_mand']; ?>" required></td>
            </tr>
            <tr>
              <td>Example</td>
              <td><input style='text-transform:uppercase' type="text" name="c_mand" class="form-control" value="<?= $data['c_mand']; ?>" required></td>
            </tr>
            <tr>
              <td>Type</td>
              <td><select name="t_mand" class="form-control" value="<?= $data['t_mand']; ?>" >
                <option value="ABACUS">ABACUS</option>
                <option value="ALTEA">ALTEA</option>
              </select></td>
            </tr>

            <tr>
              <td></td>
              <td><button type="submit" class="btn btn-primary">Update</button>
              <span style="padding-left :10px;"><a class="btn btn-success" href="<?php echo base_url("pengaturan/mandatoryviewall");?>">Cancel</a></span>
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
