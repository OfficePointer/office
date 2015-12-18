<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Edit
        <small>Profile</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <div class="col-md-12">
          <form method="POST" enctype="multipart/form-data" action="<?php echo base_url("pengaturan/save_profile");?>">
          <!-- The time line -->
          <h1>User Info</h1>
          <table class="table">
            <tr>
              <td>Nama</td>
              <td><input type="text" class="form-control" name="name" value="<?php echo $user['name'];?>"></td>
            </tr>
            <tr>
              <td>NIK</td>
              <td><input type="text" class="form-control" name="nik" value="<?php echo $user['nik'];?>"></td>
            </tr>
            <tr>
              <td>Jabatan</td>
              <td><input type="text" class="form-control" name="jabatan" value="<?php echo $user['jabatan'];?>"></td>
            </tr>
            <tr>
              <td>Direktorat</td>
              <td><input type="text" class="form-control" name="direktorat" value="<?php echo $user['direktorat'];?>"></td>
            </tr>
            <tr>
              <td>Foto</td>
              <td>
              <img style="max-width:100px;max-height:100px;" src="<?php echo $user['picture'];?>">
              <input type="file" class="form-control" name="picture"></td>
            </tr>
          </table>
          <h1>Account Settings</h1>
          <table class="table">
            <tr>
              <td>E-Mail</td>
              <td><input type="email" class="form-control" name="email" value="<?php echo $user['email'];?>"></td>
            </tr>
            <tr>
              <td>Password</td>
              <td><input type="password" class="form-control" name="password" placeHolder="isi untuk mengganti password"></td>
            </tr>
            <tr>
              <td></td>
              <td><button type="submit" class="btn btn-success">Save</button></td>
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