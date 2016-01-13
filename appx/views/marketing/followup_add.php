<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Add New Follow Up
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
      
        <form action="<?php echo base_url("marketing/followup_add_save");?>" method="post">
            <table class="table">
              <tr>
                  
                  <td>Member</td> 
                  <td>
                      <input required autocomplete="off" type="text" required class="form-control for_mitra" id="mitra">
                      <input required autocomplete="off" type="hidden" required class="form-control" name="id_mitra" id="id_mitra">
                  </td>
                 
              </tr>
              <tr>
                <td>Type</td>
                <td><select required class="form-control" name="type">
                  <option value="call">Call</option>
                  <option value="sms">SMS</option>
                  <option value="email">E-Mail</option>
                  <option value="visit">Visit</option>
                  <option value="chat">Chat</option>
                  <option value="info">Info</option>
                  </select>
                </td>
              </tr>
              <tr>
              <td>Respon</td>
              <td>
                <select required name="id_respon" class="form-control">
                <?php
                foreach($data_respon as $data){
                ?>
                <option value="<?php echo $data['id'];?>"><?php echo $data['respon'];?></option>
                <?php } ?>
                </select>
              </td>
              </tr>
              <tr>
                  <td>Response</td>
                  <td><input required type="text" name="reason" class="form-control" ></td>
              </tr>
              <tr>
                <td></td>
                <td><button class="btn btn-primary" type="submit">Submit</button>  
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