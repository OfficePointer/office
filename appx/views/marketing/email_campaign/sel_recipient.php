<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
    <ul class="nav nav-pills nav-wizard">
        <li><a>Select Template</a><div class="nav-arrow"></div></li>
        <li><div class="nav-wedge"></div><a href="<?php echo base_url("marketing/customize_template/".$uniqid);?>">Customize Template</a><div class="nav-arrow"></div></li>
        <li class="active"><div class="nav-wedge"></div><a data-toggle="tab"><?php if($status!="F"){?>Select <?php } ?>Recipients</a><div class="nav-arrow"></div></li>
        <li><div class="nav-wedge"></div><a href="<?php echo base_url("marketing/configure_campaign/0/".$uniqid);?>">Configure Campaign</a><div class="nav-arrow"></li>
        <li><div class="nav-wedge"></div><a href="<?php echo base_url("marketing/campaign_summary/".$uniqid);?>">Summary</a></li>
    </ul>
      <h3><?php if($status!="F"){?>Select <?php } ?>Recipient</h3>
      <div class="row">
      <div class="col-md-12">

      <?php if($status!="F"){?>   
        <ul class="products-list product-list-in-box">
        <?php
          foreach ($subscribers as $key) { ?>
          <li class="item">
            <div class="product-img" style="padding:15px;">
              <i class="fa fa-envelope" style="font-size:20pt;"></i>
            </div>
            <div class="product-info" style="padding:10px;">
              <a href="#" class="product-title" style="font-size:20pt;"><?php echo $key['name'];?>
                <span class="label label-success pull-right" style="font-size:15pt;">
                <?php 
                $this->db->where('id_master',$key['id']);
                $a = $this->db->get('marketing_recipient_list_detail');
                $a = $a->num_rows();echo $a;?>
                recipient</span></a>
                <span class="product-description">
                UNIQ ID : <?php echo $key['uniqid'];?>
                </span>
                <div class="text-right">
                  <a class="btn btn-primary" href="<?php echo base_url('marketing/configure_campaign/'.$key['id']."/".$id);?>">Select &amp; Next</a>
                </div>
            </div>
          </li>
          <?php } ?>
        </ul>
        <?php }else{ ?>
      <table class="table">
        <tr>
          <th>E-Mail</th>
          <th>Name</th>
          <th>Status</th>
          <th>Result</th>
          <th>Sent At</th>
        </tr>
        <?php foreach ($this->db->where('id_master',$id)->get('marketing_email_campaign_recipient')->result_array() as $key) { ?>
        <tr>
          <td><?php echo $key['email'];?></td>
          <td><?php echo $key['name'];?></td>
          <td><?php switch($key['status']){case "R":echo "READY TO SENT";break;case "S":echo "SENT";break;case "F":echo "FAILED SENT";break;}?></td>
          <td><?php switch($key['result']){case "":echo "SENT";break;case "1":echo "OPEN";break;case "4":echo "OPEN CLICK";break;case "6":echo "OPEN UNSUBSCRIBE";break;case "9":echo "OPEN CLICK UNSUBSCRIBE";break;case "10":echo "FAILED SENT";break;}?></td>
          <td><?php echo $key['sent_at'];?></td>
        </tr>
        <?php } ?>
      </table>
      <?php } ?>

      </div>

      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>