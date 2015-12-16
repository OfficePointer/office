<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php
         echo $formdata['judul'];?>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <iframe width="100%" style="overflow:hidden;" height="1700" frameborder="0" src="<?php echo $formdata['url'];?>"></iframe>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->