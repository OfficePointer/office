<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="pull-right">
      <form class="form-group" method="GET" action="">
        <input type="search" name="q" style="min-width:250px;" value="<?php echo (isset($_GET['q']))?$_GET['q']:'';?>" class="form-control input-lg" placeHolder="Type and enter to search...">
      </form>
    </div>
      <h1>
      Koran
        <small>Helpdesk</small>
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
            foreach ($koran as $key) {
            ?>
            <li class="time-label">
                  <span class="bg-green">
                      <?php echo date_format(date_create($key['sys_create_date']),"D, d M Y");?>
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-comments bg-yellow"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> <?php echo date_format(date_create($key['sys_create_date']),"H:i:s");?></span>

                <h3 class="timeline-header"><a href="#"><?php echo $key['judul'];?></a></h3>

                <div class="timeline-body">
                <?php echo $key['isi'];?>
                </div>
                <div class="timeline-footer">
                  Posted by <?php echo $this->general->get_user($key['idpengguna']);?>
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