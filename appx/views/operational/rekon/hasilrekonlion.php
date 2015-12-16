<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Hasil Rekon Tiket Lion Air</h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
            <h2>Selisih Num Tiket</h2>
            <table class="table table-bordered table-striped for_datatables">
                <thead>
                    <th>No</th>
                    <th>Kode Booking</th>
                    <th>NTA Pointer</th>
                    <th>NTA Lion</th>
                    <th>Tiket Pointer</th>
                    <th>Tiket Lion</th>
                    <th>Perbaikan di Pointer</th>
                </thead>
                <tbody>
                <?php
                $i = 1;
                    foreach ($tiket as $key) {
                    ?>
                        <tr>
                            <td><?php echo $i++;?></td>
                            <td><?php echo $key['kode_booking'];?></td>
                            <td><?php echo $key['nta_pointer'];?></td>
                            <td><?php echo $key['nta_lion'];?></td>
                            <td><?php echo $key['num_tiket_pointer'];?></td>
                            <td><?php echo $key['num_tiket_lion'];?></td>
                            <td><?php echo $key['num_tiket_lion']-$key['num_tiket_pointer'];?></td>
                        </tr>
                    <?php
                    }
                ?>
                </tbody>
            </table>
          </div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->