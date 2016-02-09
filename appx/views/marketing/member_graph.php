<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Member Graph
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
      
        <form action="<?php echo base_url("marketing/member_graph");?>" method="post">
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
                  <input class="form-control" value="<?php echo $this->input->post("tahun");?>" type="number" minlength="4" maxlength="4" name="tahun">
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
                <a class="btn btn-success" href="<?php echo base_url();?>marketing/member_graph_export/?vendor=<?php echo $this->input->post('vendor');?>&tahun=<?php echo $this->input->post('tahun');?>&bulan=<?php echo $this->input->post('bulan');?>&klasifikasi=<?php echo $this->input->post('klasifikasi');?>">Export All</a> <a class="btn btn-success" href="<?php echo base_url();?>marketing/member_graph_export_trx/?vendor=<?php echo $this->input->post('vendor');?>&tahun=<?php echo $this->input->post('tahun');?>&bulan=<?php echo $this->input->post('bulan');?>&klasifikasi=<?php echo $this->input->post('klasifikasi');?>">Export Selling</a></td>
              </tr>
            </table>
          </form>
          <div style="width:100%;overflow-x:scroll;">
          <?php
          if($this->input->post('tahun')!="" and strlen($this->input->post('tahun'))==4){
            $data_for_dtttbls = array();
            //echo $this->input->post('tahun')."-".$this->input->post('bulan')."-";
            $this->db->select('airline_member.id_mitra,data_mitra.brand_name,data_mitra.join_date,data_mitra.prefix');
            $this->db->join('data_mitra','data_mitra.id_mitra=airline_member.id_mitra','left');

            $this->db->join('klasifikasi_member k1','k1.id_mitra=data_mitra.id_mitra','left');
            $this->db->join('klasifikasi_member k2','k2.id_mitra=data_mitra.id_mitra and k1.id<k2.id','left outer');
            $this->db->join('data_klasifikasi','data_klasifikasi.id=k1.id_klasifikasi','left');
            $this->db->where('k2.id',NULL);
            
            if($this->input->post('klasifikasi')!=""){
              if($this->input->post('klasifikasi')==0){
                $this->db->where('data_klasifikasi.id',NULL);
              }else{
                $this->db->where('data_klasifikasi.id',$this->input->post('klasifikasi'));
              }
            }

            $this->db->like('kode',$this->input->post('vendor'),'both');
            $this->db->like('tanggal',$this->input->post('tahun')."-".$this->input->post('bulan')."-",'both');
            $this->db->group_by('airline_member.id_mitra');
            //$this->db->where('status','active');
            $xa = $this->db->get('airline_member');
            $xa = $xa->result_array();
            //echo $this->db->last_query();
            echo "<table class='table table-bordered table-striped for_datatables'><thead>";
            echo "<th style='width:150px !important;'>Brand Name</th>";
            echo "<th style='width:80px !important;'>Date Join</th>";   
            echo "<th style='width:80px !important;'>Klasifikasi</th>";   
            for($i=1;$i<=31;$i++){
             if(checkdate($this->input->post('bulan'), $i, $this->input->post('tahun'))){
               echo "<th>".$i."</th>";
             }
            }
            echo "<th style='width:80px !important;'>Total</th>";   
            echo "</thead><tbody>";
            $ss = 0;
            foreach($xa as $key) {    
              $total = 0;
              $data_for_dtttbls[$ss] = array($key['brand_name']." (".$key['prefix'].")",$key['join_date']);
            echo "<tr>";
            echo "<td><a onclick='openformdetail(".$key['id_mitra'].")'>".$key['brand_name']." (".$key['prefix'].")</a></td>";
            echo "<td>".$key['join_date']."</td>";   
            echo "<td>".$this->general->get_klasifikasi($key['id_mitra'],$this->input->post('tahun')."-".$this->input->post('bulan')."-")."</td>";   
              for($i = 1;$i<=31;$i++){

              if(checkdate($this->input->post('bulan'), $i, $this->input->post('tahun'))){
                $this->db->select('sum(jumlah) as jumlah');
                $this->db->where('airline_member.id_mitra',$key['id_mitra']);
                $this->db->like('kode',$this->input->post('vendor'),'both');
                $this->db->where('tanggal',$this->input->post('tahun')."-".$this->input->post('bulan')."-".$i);
                $aaa = $this->db->get('airline_member');
                $aaa = $aaa->row_array();
                echo "<td>".(isset($aaa['jumlah'])?$aaa['jumlah']:"0")."</td>";
                $total+=(isset($aaa['jumlah'])?$aaa['jumlah']:0);
                //array_push($data_for_dtttbls[$ss], (isset($aaa['jumlah'])?$aaa['jumlah']:"0"));

              }
              }
              echo "<td>".$total."</td>";   
              //array_push($data_for_dtttbls[$ss], $total);
              echo "</tr>";

                $ss++;
            }
            echo "</tbody></table>";
          }
          ?>
          </div>
      </div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->