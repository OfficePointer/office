<div class="content-wrapper">
  <section class="content-header">        
  <span class="pull-right"><a class="btn btn-success" href="<?php echo base_url("marketing/subscribers_list/");?>">All Subscribers List</a> <a class="btn btn-success" href="<?php echo base_url("marketing/subscribers_list_manage_add/".$data['id']);?>">Add to List</a></span>
    <h1>
      Subscribers List "<?php echo $data['name'];?>"
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <ul class="products-list product-list-in-box">
        <?php
          foreach ($subscribers as $key) { ?>
          <li class="item">
            <div class="product-img" style="padding:15px;">
              <i class="fa fa-envelope" style="font-size:20pt;"></i>
            </div>
            <div class="product-info" style="padding:10px;">
              <a href="#" class="product-title" style="font-size:20pt;">List from
              <?php 
              if($key['id_type']==1){
                $new = $this->db->where('id',$key['type_value'])->get('marketing_recipient_type')->row_array();
                echo "Lookup Recipient '".$new['name']."'";
              }elseif($key['id_type']==2){
                $new = $this->db->where('id',$key['type_value'])->get('data_klasifikasi')->row_array();
                echo "Member by Klasifikasi '".$new['klasifikasi']."'";
              }elseif($key['id_type']==3){
                $new = $this->db->where('id_type',$key['type_value'])->get('type')->row_array();
                echo "Member by Type '".$new['type']."'";
              }else{
                echo "Other data";
              }
              ?>
                <span class="label label-warning pull-right" style="font-size:15pt;"><?php echo $key['jumlah'];?> recipient</span></a>
                <span class="product-description">
                UNIQ ID : <?php echo $key['uniqid'];?>
                </span>
                <div class="text-right">
                  <a class="btn btn-primary" href="<?php echo base_url('marketing/subscribers_list_manage_view/'.$key['id_master']."/".$key['id_type']."/".$key['type_value']);?>">View</a>
                  <a class="btn btn-danger" href="<?php echo base_url('marketing/subscribers_list_manage_delete/'.$key['id_master']."/".$key['id_type']."/".$key['type_value']);?>">Delete</a>
                </div>
            </div>
          </li>
          <?php } if(sizeof($subscribers)==0){?>
            <h1>No Lists Found</h1>
            <a class="btn btn-success" href="<?php echo base_url("marketing/subscribers_list_manage_add/".$data['id']);?>">Add to List</a>
            <?php } ?>
        </ul>
      </div>
    </div>
  </section>
</div>