<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <span class="pull-right"><a href="<?php echo base_url("operational/uid_mgr_add");?>" class="btn btn-success">Add New</a></span>
      <h1>
      Manage User ID Airline
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
      <table class="table table-bordered table-striped for_datatables_asc">
        <thead>
          <tr>
            <th>Vendor</th>
            <th>E-Mail Maskapai</th>
            <th>E-Mail Username</th>
            <th>PIC</th>
            <th>Used For</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
        foreach ($data as $key) {
          $uid_used = "Helpdesk";
          switch ($key['uid_used']) {
            case 'o':$uid_used = "Office";break;
            case 'q':$uid_used = "QA";break;
            case 's':$uid_used = "Server";break;
            case 'a':$uid_used = "FinOps";break;
            case 'f':$uid_used = "Finance";break;
          }
        ?>
          <tr>
            <td><?php echo $this->db->where('id',$key['vendor'])->get('vendor')->row_array()['nama'];?></td>
            <td><?php echo $key['username_airline'];?></td>
            <td><?php echo $key['email_akun'];?></td>
            <td><?php echo $this->db->where('id',$key['id_user'])->get('data_user')->row_array()['name']." (".$this->db->where('id',$key['id_user'])->get('data_user')->row_array()['email'].")";?></td>
            <td><?php echo $uid_used;?></td>
            <td><a title="Edit" href="<?php echo base_url("operational/uid_mgr_edit/".$key['id']);?>">Edit</a> <a title="Hapus" onclick="return confirm('Yakin hapus user <?php echo $this->db->where('id',$key['vendor'])->get('vendor')->row_array()['nama']." (".$key['email_akun'].")";?>?')" href="<?php echo base_url("operational/uid_mgr_delete/".$key['id']);?>">Hapus</a></td>
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