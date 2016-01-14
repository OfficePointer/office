<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Airline
        <small>Info</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">

      <!-- Main row -->
      <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
            <?php 
            foreach ($info as $key) {
            ?>
            <li class="time-label">
                  <span class="bg-green">
                      <?php echo date_format(date_create($key['created_at']),"D, d M Y");?>
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-comments bg-yellow"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> <?php echo date_format(date_create($key['created_at']),"H:i:s");?></span>

                <h3 class="timeline-header"><a href="<?php echo base_url("operational/airline_status/".$key['id']);?>">Airline Info <?php echo $key['waktu']." ".date_format(date_create($key['created_at']),"D, d F Y");?></a></h3>

                <div class="timeline-body">
                <?php echo $key['info'];?>
                </div>
                <div class="timeline-footer">
                  Posted by <?php echo $this->general->get_user($key['id_user']);?>
                </div>
              </div>
            </li>
            <?php 
              }
            ?>
            <!-- END timeline item -->
            <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
          </ul>
          <?php echo $paging;?>
        </div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->