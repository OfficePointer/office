<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
    <ul class="nav nav-pills nav-wizard">
        <li><a>Select Template</a><div class="nav-arrow"></div></li>
        <li><div class="nav-wedge"></div><a href="<?php echo base_url("marketing/customize_template/".$uniqid);?>">Customize Template</a><div class="nav-arrow"></div></li>
        <li><div class="nav-wedge"></div><a href="<?php echo base_url("marketing/select_recipient/".$uniqid);?>"><?php if($status!="F"){?>Select <?php } ?>Recipients</a><div class="nav-arrow"></div></li>
        <li class="active"><div class="nav-wedge"></div><a data-toggle="tab">Configure Campaign</a><div class="nav-arrow"></li>
        <li><div class="nav-wedge"></div><a href="<?php echo base_url("marketing/campaign_summary/".$uniqid);?>">Summary</a></li>
    </ul>
      <h3>Configure Campaign</h3>
      <div class="row">
      <div class="col-md-12">   
      <form method="POST" action="<?php echo base_url("marketing/campaign_summary/".$uniqid);?>">
        <table class="table" style="width:50%;">
          <tr>
            <td>Campaign Name</td>
            <td><input type="text" required name="name" class="form-control" value="<?php echo $name;?>" placeholder="E-Mail Campaign Name"></td>
          </tr>
          <tr>
            <td>E-Mail From</td>
            <td><input disabled value="sales@pointer.co.id" type="text" name="email_from" class="form-control" placeholder="E-Mail From"></td>
          </tr>
          <tr>
            <td>E-Mail Reply-To</td>
            <td><input required value="<?php echo $reply_to;?>" type="text" name="reply_to" class="form-control" placeholder="E-Mail Campaign Subject"></td>
          </tr>
          <tr>
            <td>E-Mail Subject</td>
            <td><input required value="<?php echo $subject;?>" type="text" name="subject" class="form-control" placeholder="E-Mail Campaign Subject"></td>
          </tr>
          <tr>
            <td>Tracking Option</td>
            <td>
              <ul style="list-style-type:none;">
                <li><input type="checkbox" <?php echo (in_array($tracking_open, array(1,4,6,9))?"checked":"");?> name="track_open"> OPEN</li>
                <li><input type="checkbox" <?php echo (in_array($tracking_open, array(4,9))?"checked":"");?> name="track_click"> CLICK</li>
                <li><input type="checkbox" <?php echo (in_array($tracking_open, array(6,9))?"checked":"");?> name="track_unsubscribe"> UNSUBSCRIBE</li>
              </ul>
            </td>
          </tr>
          <tr>
            <td></td>
            <td><button type="submit" class="btn btn-primary">Save &amp; Next</button></td>
          </tr>
        </table>
      </form>
      
      </div>

      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>