<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
    <ul class="nav nav-pills nav-wizard">
        <li><a>Select Template</a><div class="nav-arrow"></div></li>
        <li class="active"><div class="nav-wedge"></div><a data-toggle="tab">Customize Template</a><div class="nav-arrow"></div></li>
        <li><div class="nav-wedge"></div><a href="<?php echo base_url("marketing/select_recipient/".$uniqid);?>"><?php if($status!="F"){?>Select <?php } ?>Recipients</a><div class="nav-arrow"></div></li>
        <li><div class="nav-wedge"></div><a href="<?php echo base_url("marketing/configure_campaign/0/".$uniqid);?>">Configure Campaign</a><div class="nav-arrow"></li>
        <li><div class="nav-wedge"></div><a href="<?php echo base_url("marketing/campaign_summary/".$uniqid);?>">Summary</a></li>
    </ul>
      <h3>Customize E-Mail Templates</h3>
      <div class="row">
      <div class="col-md-12">
      <form method="POST" action="<?php echo base_url("marketing/select_recipient/".$uniqid);?>">
      	<div class="form-group">
      		<textarea class="form-control notes" required name="content" id="notes"><?php echo $content;?></textarea>
          <?php echo display_ckeditor($ckeditor); ?>
      	</div>
      	<div class="form-group">
      		<div class="pull-right">
      			<button type="submit" class="btn btn-primary">Next</button>
      		</div>
      	</div>
      </form>
      </div>

      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>