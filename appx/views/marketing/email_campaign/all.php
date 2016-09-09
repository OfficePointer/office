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
                <span class="label label-warning pull-right" style="font-size:15pt;"><?php echo $key['tracking_open'];?></span>
                <span class="product-description">
                UNIQ ID : <?php echo $key['uniqid'];?><br>
                Subject : <?php echo $key['subject'];?><br>
                Purposes : <?php echo $key['purposes'];?><br>
                </span>
                <div class="text-right">
                  <a class="btn btn-primary" href="<?php echo base_url('marketing/email_campaign_view/'.$key['id']);?>">View</a>
                  <a class="btn btn-danger" href="<?php echo base_url('marketing/email_campaign_delete/'.$key['id']);?>">Delete</a>
                </div>
            </div>
          </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </section>
</div>