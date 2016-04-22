<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit User ID Airline
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
      
          <form role="form" method="POST" action="<?php echo base_url("operational/uid_mgr_update");?>">
            <input type="hidden" name="id" value="<?php echo $data['id'];?>"/>
            <div class="form-group">
              <label>Airline</label>
              <select onchange="change()" name="vendor" class="form-control for_chosen">
                <?php 
                foreach ($airline as $key) {
                ?>
                <option <?php echo ($key['id']==$data['vendor']?"selected":"");?> value="<?php echo $key['id'];?>"><?php echo $key['nama'];?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label>PIC</label>
              <select name="id_user" class="form-control for_chosen">
                <?php 
                foreach ($id_user as $key) {
                ?>
                <option <?php echo ($key['ID']==$data['id_user']?"selected":"");?> value="<?php echo $key['ID'];?>"><?php echo $key['name']." (".$key['email'].")";?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Used For</label>
              <select name="uid_used" class="form-control for_chosen">
                <option <?php echo ("h"==$data['uid_used']?"selected":"");?> value="h">Helpdesk</option>
                <option <?php echo ("s"==$data['uid_used']?"selected":"");?> value="s">Server</option>
                <option <?php echo ("q"==$data['uid_used']?"selected":"");?> value="q">QA</option>
                <option <?php echo ("a"==$data['uid_used']?"selected":"");?> value="a">FinOps</option>
                <option <?php echo ("f"==$data['uid_used']?"selected":"");?> value="f">Finance</option>
                <option <?php echo ("o"==$data['uid_used']?"selected":"");?> value="o">Office</option>
              </select>
            </div>
            <div class="form-group">
              <label>E-Mail Username</label>
              <input type="text" value="<?php echo $data['email_akun'];?>" name="email_akun" class="form-control" placeholder="">
            </div>
            <div class="form-group">
              <label>E-Mail Password</label>
              <input type="text" value="<?php echo $data['email_pass'];?>" name="email_pass" class="form-control" placeholder="">
            </div>
            <div class="form-group">
              <label>Airline Username</label>
              <input type="text" value="<?php echo $data['username_airline'];?>" name="username_airline" class="form-control" placeholder="">
            </div>
            <div class="form-group">
              <label>Airline Password</label>
              <input type="text" value="<?php echo $data['password_airline'];?>" name="password_airline" class="form-control" placeholder="">
            </div>
            <div class="form-group" id="ga_chg" style="display:none;">
              <label>Last GA Change Password</label>
              <input type="text" value="<?php echo $data['ga_chg'];?>" name="ga_chg" class="form-control for_date" placeholder="">
            </div>
            <div class="form-group">
              <label>Note</label>
              <textarea class="form-control" rows="3" placeholder="Note" name="note"><?php echo $data['note'];?></textarea>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary pull-right">Update</button>
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