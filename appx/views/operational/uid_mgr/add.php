<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add User ID Airline
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
      
          <form role="form" method="POST" action="<?php echo base_url("operational/uid_mgr_save");?>">
            <div class="form-group">
              <label>Airline</label>
              <select onchange="change()" name="vendor" class="form-control for_chosen">
                <?php 
                foreach ($airline as $key) {
                ?>
                <option value="<?php echo $key['id'];?>"><?php echo $key['nama'];?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label>PIC</label>
              <select name="id_user" class="form-control for_chosen">
                <?php 
                foreach ($id_user as $key) {
                ?>
                <option value="<?php echo $key['ID'];?>"><?php echo $key['name']." (".$key['email'].")";?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Used For</label>
              <select name="uid_used" class="form-control for_chosen">
                <option value="h">Helpdesk</option>
                <option value="s">Server</option>
                <option value="q">QA</option>
                <option value="a">FinOps</option>
                <option value="f">Finance</option>
                <option value="o">Office</option>
              </select>
            </div>
            <div class="form-group">
              <label>E-Mail Username</label>
              <input type="text" name="email_akun" class="form-control" placeholder="">
            </div>
            <div class="form-group">
              <label>E-Mail Password</label>
              <input type="text" name="email_pass" class="form-control" placeholder="">
            </div>
            <div class="form-group">
              <label>Airline Username</label>
              <input type="text" name="username_airline" class="form-control" placeholder="">
            </div>
            <div class="form-group">
              <label>Airline Password</label>
              <input type="text" name="password_airline" class="form-control" placeholder="">
            </div>
            <div class="form-group" id="ga_chg" style="display:none;">
              <label>Last GA Change Password</label>
              <input type="text" name="ga_chg" class="form-control for_date" placeholder="">
            </div>
            <div class="form-group">
              <label>Note</label>
              <textarea class="form-control" rows="3" placeholder="Note" name="note"></textarea>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary pull-right">Save</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
      function change() {
        if($("select[name=vendor]").val()=="13"){
          $("#ga_chg").fadeIn();
        }else{
          $("#ga_chg").fadeOut();
        }
      }
  </script>