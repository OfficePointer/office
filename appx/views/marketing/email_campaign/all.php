<div class="content-wrapper">
  <section class="content-header">        
  <span class="pull-right"><a class="btn btn-success" href="<?php echo base_url("marketing/email_campaign_add");?>">Add E-Mail Campaign</a></span>
    <h1>
      E-Mail Campaign
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <ul class="products-list product-list-in-box">
        <?php
          foreach ($data as $key) { ?>
          <li class="item">
            <div class="product-img" style="padding:15px;">
              <i class="fa fa-envelope" style="font-size:20pt;"></i>
            </div>
            <div class="product-info" style="padding:10px;">
              <a href="#" class="product-title" style="font-size:20pt;"><?php echo $key['name'];?></a>
                <span class="label label-warning pull-right" style="font-size:15pt;"><?php switch ($key['status']) {
                  case "A":echo "CUSTOMIZE TEMPLATE";break;
                  case "B":echo "SELECT RECIPIENT";break;
                  case "C":echo "CONFIGURE CAMPAIGN";break;
                  case "D":echo "READY TO SEND";break;
                  case "E":echo "SENDING";break;
                  case "F":echo "SENT";break;
                }
                ?></span>
                <span class="product-description">
                UNIQ ID : <?php echo $key['uniqid'];?><br>
                Subject : <?php echo $key['subject'];?><br>
                Recipient : <?php echo $this->general->marketing_get_recipient($key['recipient_id']);?><br>
                Tracking Options : <?php switch ($key['tracking_open']) {
                  case 0:echo "NO TRACKING";break;
                  case 1:echo "OPEN";break;
                  case 4:echo "OPEN CLICK";break;
                  case 6:echo "OPEN UNSUBSCRIBE";break;
                  case 9:echo "OPEN CLICK UNSUBSCRIBE";break;
                }
                ?><br>
                </span>
                <div class="text-right">
                  <?php if($key['status']=="D"){ ?>
                  <a class="btn btn-success" href="<?php echo base_url('marketing/send_now/'.$key['uniqid']);?>">Send Now</a>
                  <?php } ?>
                  <a class="btn btn-primary" href="<?php echo base_url('marketing/campaign_summary/'.$key['uniqid']);?>">View</a>
                  <a class="btn btn-danger" onclick="return confirm('Are you sure to delete <?php echo $key['name'];?>?')" href="<?php echo base_url('marketing/email_campaign_delete/'.$key['id']);?>">Delete</a>
                </div>
            </div>
          </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </section>
</div>