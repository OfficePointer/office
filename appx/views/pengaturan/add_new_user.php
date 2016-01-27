<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Add
        <small>Account</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <div class="col-md-12">
          <form method="POST" enctype="multipart/form-data" action="<?php echo base_url("pengaturan/save_user");?>">
          <!-- The time line -->
          <h1>Create New Account</h1>
        <div class="form-group">
          <label>Name</label>
          <input type="hidden" class="form-control" name="ID">
          <input type="text" class="form-control" name="name">
        </div>
        <div class="form-group">
          <label>NIK</label>
          <input type="text" class="form-control" name="nik">
        </div>
        <div class="form-group">
          <label>Jabatan</label>
          <input type="text" class="form-control" name="jabatan">
        </div>
        <div class="form-group">
          <label>Direktorat</label>
          <input type="text" class="form-control" name="direktorat">
        </div>
        <div class="form-group">
          <label>NIK</label>
          <input type="text" class="form-control" name="nik">
        </div>
        <div class="form-group">
          <label>Division</label>
          <select type="text" class="form-control" name="division">
          <?php
          foreach ($division as $data) {
            ?><option value="<?php echo $data['id'];?>"><?php echo $data ['name'];?></option>
            <?php  }  ?>
          </select>
        </div>
        <div class="form-group">
          <label>Group</label>
          <select type="text" class="form-control" name="level">
          <option value="0">This is parent</option>
          <?php
          foreach ($level as $key) {
            ?><option value="<?php echo $key['id'];?>"><?php echo $key['name']." - ".$this->general->get_sys_div_lev($key['id']);?></option><?php
          }
          ?>
          </select>
        </div>
        <h1>Account Settings</h1>
        <div class="form-group">
          <label>E-mail</label>
          <input type="text" class="form-control" name="email">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" name="password">
        </div>
        <div class="form-group">
          <div class="pull-right">
            <button type="submit" class="btn btn-primary">Create</button>
          </div>
        </div>
          </form>
          </div>
          </div>
          </section>
          </div>
