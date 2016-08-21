<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Member Graph Daily
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
      
        <form action="<?php echo base_url("marketing/member_graph_daily");?>" method="GET">
            <table class="table">
              <tr>
                <td>Month</td>
                <td><select class="form-control" name="bulan">
                  <option <?php echo ($_GET["bulan"]=="01")?"selected":"";?> value="01">Januari</option>
                  <option <?php echo ($_GET["bulan"]=="02")?"selected":"";?> value="02">Februari</option>
                  <option <?php echo ($_GET["bulan"]=="03")?"selected":"";?> value="03">Maret</option>
                  <option <?php echo ($_GET["bulan"]=="04")?"selected":"";?> value="04">April</option>
                  <option <?php echo ($_GET["bulan"]=="05")?"selected":"";?> value="05">Mei</option>
                  <option <?php echo ($_GET["bulan"]=="06")?"selected":"";?> value="06">Juni</option>
                  <option <?php echo ($_GET["bulan"]=="07")?"selected":"";?> value="07">Juli</option>
                  <option <?php echo ($_GET["bulan"]=="08")?"selected":"";?> value="08">Agustus</option>
                  <option <?php echo ($_GET["bulan"]=="09")?"selected":"";?> value="09">September</option>
                  <option <?php echo ($_GET["bulan"]=="10")?"selected":"";?> value="10">Oktober</option>
                  <option <?php echo ($_GET["bulan"]=="11")?"selected":"";?> value="11">November</option>
                  <option <?php echo ($_GET["bulan"]=="12")?"selected":"";?> value="12">Desember</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Year</td>
                <td>
                  <input required class="form-control" value="<?php echo $_GET["tahun"];?>" type="number" minlength="4" maxlength="4" name="tahun">
                </td>
              </tr>
              <tr>
                <td></td>
                <td><button class="btn btn-primary" type="submit">Submit</button>  
                <a class="btn btn-success" href="<?php echo base_url();?>marketing/member_graph_daily_export/?tahun=<?php echo $_GET['tahun'];?>&bulan=<?php echo $_GET['bulan'];?>">Export Data</a></td>
              </tr>
            </table>
          </form>
          <div style="width:100%;overflow-x:scroll;">
          <?php
          if(isset($data)){
            ?>
          <table class="table table-bordered table-striped for_datatables_asc">
          <thead>
            <th>No</th>
            <th>Klasifikasi</th>
            <?php
              $number = cal_days_in_month(1, $_GET['bulan'], $_GET['tahun']);
              for ($i=1; $i <= $number; $i++) { 
                ?>
                <th><?php echo $i;?></th>
                <?php
              }
            ?>
            <th>Total</th>
          </thead>
          <tbody>
          <?php 
          $i = 1;
              foreach ($data as $key => $value) {
                ?>

          <tr>
          <?php
                echo "<td>".$i++."</td>";
                echo "<td>".$key."</td>";
                foreach ($value as $data) {
                echo "<td>".$data."</td>";
                 } 
              }
            ?>
          </table>
          <?php } ?>
          </div>
      </div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->