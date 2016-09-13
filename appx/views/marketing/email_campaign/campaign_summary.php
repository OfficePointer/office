<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
    <ul class="nav nav-pills nav-wizard">
        <li><a>Select Template</a><div class="nav-arrow"></div></li>
        <li><div class="nav-wedge"></div><a href="<?php echo base_url("marketing/customize_template/".$uniqid);?>">Customize Template</a><div class="nav-arrow"></div></li>
        <li><div class="nav-wedge"></div><a href="<?php echo base_url("marketing/select_recipient/".$uniqid);?>"><?php if($status!="F"){?>Select <?php } ?>Recipients</a><div class="nav-arrow"></div></li>
        <li><div class="nav-wedge"></div><a href="<?php echo base_url("marketing/configure_campaign/0/".$uniqid);?>">Configure Campaign</a><div class="nav-arrow"></li>
        <li class="active"><div class="nav-wedge"></div><a data-toggle="tab">Summary</a></li>
    </ul>
      <h3>Campaign Summary</h3>
      <div class="row">
      <div class="col-md-12">
      <form method="POST" action="<?php echo base_url("marketing/send_now/".$uniqid);?>">
        <input type="hidden" name="uniqid" value="<?php echo $uniqid;?>">
        <table class="table">
          <tr>
            <td style="width:15%;">Campaign Name</td>
            <td><input readonly type="text" required name="name" class="form-control" value="<?php echo $name;?>" placeholder="E-Mail Campaign Name"></td>
          </tr>
          <tr>
            <td style="width:15%;">Author</td>
            <td><input readonly type="text" required name="author" class="form-control" value="<?php echo $this->general->get_user($id_user);?>" placeholder="E-Mail Campaign Name"></td>
          </tr>
          <tr>
            <td style="width:15%;">Recipient</td>
            <td><input readonly type="text" required name="recipient" class="form-control" value="<?php echo $this->general->marketing_get_recipient($recipient_id);?>" placeholder="E-Mail Campaign Recipient"></td>
          </tr>
          <tr>
            <td>E-Mail From</td>
            <td><input readonly value="sales@pointer.co.id" type="text" name="email_from" class="form-control" placeholder="E-Mail From"></td>
          </tr>
          <tr>
            <td>E-Mail Reply-To</td>
            <td><input required readonly value="<?php echo $reply_to;?>" type="text" name="reply_to" class="form-control" placeholder="E-Mail Campaign Reply-To"></td>
          </tr>
          <tr>
            <td>E-Mail Subject</td>
            <td><input required readonly value="<?php echo $subject;?>" type="text" name="subject" class="form-control" placeholder="E-Mail Campaign Subject"></td>
          </tr>
          <tr>
            <td>Content</td>
            <td>
              <iframe style="width:100%;height:300px;border:1px solid #ddd;" src="<?php echo base_url('marketing/email_campaign_temp_view/'.$uniqid);?>"></iframe>
            </td>
          </tr>
          <tr>
            <td>Tracking Option</td>
            <td>
              <ul style="list-style-type:none;">
                <li><input type="checkbox" disabled <?php echo (in_array($tracking_open, array(1,4,6,9))?"checked":"");?> name="track_open"> OPEN</li>
                <li><input type="checkbox" disabled <?php echo (in_array($tracking_open, array(4,9))?"checked":"");?> name="track_click"> CLICK</li>
                <li><input type="checkbox" disabled <?php echo (in_array($tracking_open, array(6,9))?"checked":"");?> name="track_unsubscribe"> UNSUBSCRIBE</li>
              </ul>
            </td>
          </tr>
          <tr>
            <td style="width:15%;">Status</td>
            <td><input readonly type="text" required name="name" class="form-control" value="<?php switch ($status) {
                  case "A":echo "CUSTOMIZE TEMPLATE";break;
                  case "B":echo "SELECT RECIPIENT";break;
                  case "C":echo "CONFIGURE CAMPAIGN";break;
                  case "D":echo "READY TO SEND";break;
                  case "E":echo "SENDING";break;
                  case "F":echo "SENT";break;
                }
                ?>"></td>
          </tr>
          <tr>
            <td></td>
            <td><a class="btn btn-primary" href="<?php echo base_url("marketing/email_campaign");?>">Back to E-Mail Campaign List</a> <?php if($status=="D"){?><button type="submit" class="btn btn-primary">Send Now</button><?php } ?></td>
          </tr>
        </table>
      </form>
      </div>

      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>