<?php
$url = array('http://office-cron.copasin.com/index.php',
        'http://office-cron.copasin.com/qg_qz_tnu.php',
        'http://office-cron.copasin.com/tgn_kd.php',
        'http://office-cron.copasin.com/sn_mg_kai.php',
        'http://office-cron.copasin.com/ga_jt_sj.php');

foreach ($url as $key) {
$ch = curl_init($key);
curl_setopt($ch, CURLOPT_URL,$key);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_exec($ch);
curl_close($ch);
}
?>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        GD System Info
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
            <img src="http://office-cron.copasin.com/temp/simple<?php echo date("Y-m-d",strtotime("-1 day"));?>.png">
            <img src="http://office-cron.copasin.com/temp/qg_qz_tnu<?php echo date("Y-m-d",strtotime("-1 day"));?>.png">
            <img src="http://office-cron.copasin.com/temp/tgn_kd<?php echo date("Y-m-d",strtotime("-1 day"));?>.png">
            <img src="http://office-cron.copasin.com/temp/sn_mg_kai<?php echo date("Y-m-d",strtotime("-1 day"));?>.png">
            <img src="http://office-cron.copasin.com/temp/ga_jt_sj<?php echo date("Y-m-d",strtotime("-1 day"));?>.png">
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->