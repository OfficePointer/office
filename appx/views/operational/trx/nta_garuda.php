<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <br>NTA Garuda<br>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">

      <div class="col-md-12">
        <table class="table">
          <tr>
            <td>Brand Name</td>
            <td>
                <input required autocomplete="off" type="text" required class="form-control for_mitra" id="mitra">
                <input required autocomplete="off" type="hidden" required class="form-control" name="id_mitra" id="id_mitra">
            </td>
            <td>Type</td>
            <td><input type="text" class="form-control" disabled id="type_mitra"/></td>
          </tr>
          <tr>
            <td>Pax</td>
            <td><input type="text" class="form-control" id="pax" value="0" /></td>
          </tr>
          <tr>
            <td>Basic</td>
            <td><input type="text" class="form-control" id="basic" value="0" /></td>
          </tr>
          <tr>
            <td>Tax</td>
            <td><input type="text" class="form-control" disabled id="tax" value="0" /></td>
            <td>Insuren 0,15%</td>
            <td><input type="text" class="form-control" disabled id="insuren"/></td>
          </tr>
          <tr style="display: none;">
            <td>Komisi</td>
            <td><input type="text" class="form-control" disabled id="komisi"/></td>
            <td>PPH 2%</td>
            <td><input type="text" class="form-control" disabled id="pph_2_p"/></td>
          </tr>
          <tr style="display: none;">
            <td>NTA Non</td>
            <td><input type="text" class="form-control" disabled id="nta_non"/></td>
          </tr>
          <tr>
            <td>NTA IATA</td>
            <td><input type="text" class="form-control" disabled id="nta_iata"/></td>
            <td>Memberpaid</td>
            <td><input type="text" class="form-control" disabled id="memberpaid"/></td>
          </tr>
          <tr>
            <td>Potongan Komisi</td>
            <td><input type="text" class="form-control" disabled id="potkom"/></td>
            <td>Self Share</td>
            <td><input type="text" class="form-control" disabled id="self_share"/></td>
          </tr>
        </table>
      </div>
        
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
    
    $("#pax, #basic, #tax").on('input',function() {
      var pax = $("#pax").val();
      var basic = $("#basic").val();
      $("#tax").val(rupiah(parseFloat(pax)-parseFloat(basic)));
      var tax = $("#tax").val();
      var komisi = parseFloat(basic)*(5/100);
      var komisi_2 = parseFloat(basic)*(4/100);
      $("#komisi").val(rupiah(komisi));
      var pph_2_p = parseFloat(komisi)*(2/100);
      $("#pph_2_p").val(rupiah(pph_2_p));
      var nta_non = parseFloat(pax)-parseFloat(komisi)+parseFloat(pph_2_p);
      var nta_non_2 = parseFloat(pax)-parseFloat(komisi_2);
      $("#nta_non").val(rupiah(nta_non));
      var insuren = parseFloat(nta_non)*(15/10000);
      $("#insuren").val(rupiah(insuren.toFixed(2)));
      var nta_iata = parseFloat(nta_non)+parseFloat(insuren);
      $("#nta_iata").val(rupiah(nta_iata));
      var self_share = (parseFloat(basic)*(4/100))*(20/100);
      $("#self_share").val(rupiah(self_share));
      var tipe_member = $("#type_mitra").val();
      var memberpaid = 0;
      if(tipe_member=="Enterprise"){
        memberpaid = pax;
      }else if(tipe_member=="Sub Mitra"){
        memberpaid = parseFloat(pax)-(parseFloat(basic)*(4/100)*(70/100));
      }else{
        memberpaid = nta_non_2;
      }
      $("#memberpaid").val(rupiah(memberpaid));
      var potkom = 0;
      if(tipe_member=="Sub Agent" || tipe_member=="Mitra"){
        potkom = parseFloat(memberpaid) - parseFloat(nta_iata);
      }else if(tipe_member=="Sub Mitra"){
        potkom = parseFloat(memberpaid) - parseFloat(nta_iata) - parseFloat(self_share);
      }else{
        potkom = parseFloat(pax) - parseFloat(nta_iata);
      }
      $("#potkom").val(rupiah(potkom.toFixed(2)));

    });
    function rupiah(value)
    {
    value += '';
    x = value.split(',');
    x1 = x[0];
    x2 = x.length > 1 ? ',' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
    x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return 'Rp ' + x1 + x2;
    }

  </script>