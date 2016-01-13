<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Follow Up Add
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
                  <div class="form-group">
                      <input autocomplete="off" type="text" required class="form-control for_mitra" id="mitra">
                      <input autocomplete="off" type="hidden" required class="form-control" name="id_mitra" id="id_mitra">
                  </div>
                  </td>
                 
              </tr>
              <tr>
                <td>Type</td>
                <td><select class="form-control" name="type">
                  <option <?php echo ($this->input->post("type")=="all");?> value="">-- Type --</option>
                  <option <?php echo ($this->input->post("type")=="01");?> value="01">Call</option>
                  <option <?php echo ($this->input->post("type")=="02");?> value="02">SMS</option>
                  <option <?php echo ($this->input->post("type")=="03");?> value="03">E-Mail</option>
                  <option <?php echo ($this->input->post("type")=="04");?> value="04">Visit</option>
                  <option <?php echo ($this->input->post("type")=="05");?> value="05">Chat</option>
                  <option <?php echo ($this->input->post("type")=="06");?> value="06">Info</option>
                  </select>
                </td>
              </tr>
              <tr>
              <td>Respon</td>
              <td>
                <select name="id_respon" class="form-control">
                <option <?php echo ($this->session->userdata('data_respon')=="");?> value="">Selection...</option>
                <?php
                foreach($data_respon as $data){
                ?>
                <option <?php echo ($this->session->userdata('$data')==$data['id']);?> 
                value="<?php echo $data['id'];?>"><?php echo $data['$data'];?></option>
                <?php } ?>
                </select>
              </td>
              </tr>
              <tr>
                  <td>Response</td>
                  <td><input type="text" name="respon_followup" class="form-control" ></td>
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