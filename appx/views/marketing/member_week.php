<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Weekly Member Graph
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
      
        <form action="<?php echo base_url("marketing/member_week");?>" method="post">
            <table class="table">
              <tr>
                <td>Month</td>
                <td><select class="form-control" name="bulan">
                  <option <?php echo ($this->input->post("bulan")=="01")?"selected":"";?> value="01">Januari</option>
                  <option <?php echo ($this->input->post("bulan")=="02")?"selected":"";?> value="02">Februari</option>
                  <option <?php echo ($this->input->post("bulan")=="03")?"selected":"";?> value="03">Maret</option>
                  <option <?php echo ($this->input->post("bulan")=="04")?"selected":"";?> value="04">April</option>
                  <option <?php echo ($this->input->post("bulan")=="05")?"selected":"";?> value="05">Mei</option>
                  <option <?php echo ($this->input->post("bulan")=="06")?"selected":"";?> value="06">Juni</option>
                  <option <?php echo ($this->input->post("bulan")=="07")?"selected":"";?> value="07">Juli</option>
                  <option <?php echo ($this->input->post("bulan")=="08")?"selected":"";?> value="08">Agustus</option>
                  <option <?php echo ($this->input->post("bulan")=="09")?"selected":"";?> value="09">September</option>
                  <option <?php echo ($this->input->post("bulan")=="10")?"selected":"";?> value="10">Oktober</option>
                  <option <?php echo ($this->input->post("bulan")=="11")?"selected":"";?> value="11">November</option>
                  <option <?php echo ($this->input->post("bulan")=="12")?"selected":"";?> value="12">Desember</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Year</td>
                <td>
                  <input required class="form-control" value="<?php echo $this->input->post("tahun");?>" type="number" minlength="4" maxlength="4" name="tahun">
                </td>
              </tr>
              <tr>
                <td>Airline</td>
                <td>
                <select type="text" id="vendor" name="vendor" class="form-control">
                  <option <?php echo ($this->input->post("vendor")=="all")?"selected":"";?> value="">-- All --</option>
                  <option <?php echo ($this->input->post("vendor")=="KAI")?"selected":"";?> value="KAI">Kereta Api</option>
                  <option <?php echo ($this->input->post("vendor")=="MG")?"selected":"";?> value="MG">Hotel</option>
                  <option <?php echo ($this->input->post("vendor")=="JT")?"selected":"";?> value="JT">Lion Air</option>
                  <option <?php echo ($this->input->post("vendor")=="GA")?"selected":"";?> value="GA">Garuda Indonesia</option>
                  <option <?php echo ($this->input->post("vendor")=="SJ")?"selected":"";?> value="SJ">Sriwijaya</option>
                  <option <?php echo ($this->input->post("vendor")=="QG")?"selected":"";?> value="QG">Citilink</option>
                  <option <?php echo ($this->input->post("vendor")=="QZ")?"selected":"";?> value="QZ">AirAsia</option>
                  <option <?php echo ($this->input->post("vendor")=="KD")?"selected":"";?> value="KD">Kalstar</option>
                  <option <?php echo ($this->input->post("vendor")=="SN")?"selected":"";?> value="SN">ExpressAir</option>
                  <option <?php echo ($this->input->post("vendor")=="TGN")?"selected":"";?> value="TGN">Trigana</option>
                  <option <?php echo ($this->input->post("vendor")=="TNU")?"selected":"";?> value="TNU">Transnusa</option>
                </select></td>
              </tr>
              <tr>
              <td>Klasifikasi</td>
              <td>
                <select name="klasifikasi" class="form-control">
                <option <?php echo ($this->input->post('klasifikasi')=="")?"selected":"";?> value="">-- All --</option>
                <option <?php echo ($this->input->post('klasifikasi')=="0")?"selected":"";?> value="0">No Data</option>
                <?php
                foreach($klasifikasi as $dataklasifikasi){
                ?>
                <option <?php echo ($this->input->post('klasifikasi')==$dataklasifikasi['id'])?"selected":"";?> value="<?php echo $dataklasifikasi['id'];?>"><?php echo $dataklasifikasi['klasifikasi'];?></option>
                <?php } ?>
                </select>
              </td>
              </tr>
              <tr>
                <td></td>
                <td><button class="btn btn-primary" type="submit">Submit</button>  
                <a class="btn btn-success" href="<?php echo base_url();?>marketing/expr_/?vendor=<?php echo $this->input->post('vendor');?>&tahun=<?php echo $this->input->post('tahun');?>&bulan=<?php echo $this->input->post('bulan');?>">Export Selling</a></td>
              </tr>
            </table>
          </form>
          <div style="width:100%;overflow-x:scroll;">
          <?php echo $table;?>
          </div>
          <?php
          foreach ($klasifikasi_data as $key => $value) {
          ?>
          <span class="btn"><?php echo $key." : ".$value;?></span>
          <?php 
            }
          ?>
      </div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->