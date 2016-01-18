<?php
//----------------------------PHP Script---------------------------------------

$this->db->where_in('id',array(7,8,9,10,15,16,17));
$this->db->order_by('id','asc');
$us = $this->db->get('flowsys')->result_array();
$group_alert = array();
foreach ($us as $key) {
	if($key['id']==10){
		$group_alert['alert_topup_finops'] = explode(",", $key['assign_user']);
	}
	if($key['id']==15){
		$group_alert['notif_issued_process_revert_log'] = explode(",", $key['assign_user']);
	}
	if($key['id']==16){
		$group_alert['notif_pending_log'] = explode(",", $key['assign_user']);
	}
	if($key['id']==17){
		$group_alert['notif_saldo_log'] = explode(",", $key['assign_user']);
	}
}





//-----------------------------------------------------------------------------
?>
<div class="for_numberinput" style="display:none;"></div>
<script type="text/javascript">
//----------------------------JavaScript---------------------------------------
var muncul_deposit = 0;
	Waves.attach('button');
    Waves.attach('button', ['waves-button', 'waves-float']);
    Waves.attach('.btn', ['waves-button', 'waves-float']);
	Waves.init();

var bunyi = 0;

var temp_code = '';
    $(".for_numberinput").jqxNumberInput({ spinMode:'simple',width:'100%',digits: 10, max:9999999999999999999,symbol:'Rp. '});
    $('#nta').on('valueChanged', function (event) {$('#nta_num').val(event.args.value);}); 
    $('#basic').on('valueChanged', function (event) {$('#basic_num').val(event.args.value);}); 
    $('#pax').on('valueChanged', function (event) {$('#pax_num').val(event.args.value);}); 
    $('#memberpaid').on('valueChanged', function (event) {$('#memberpaid_num').val(event.args.value);}); 
    $('#rebook_admin_cost_div').on('valueChanged', function (event) {$('#rebook_admin_cost').val(event.args.value);}); 
    $('#rebook_airline_cost_div').on('valueChanged', function (event) {$('#rebook_airline_cost').val(event.args.value);}); 

	$(document).ready(function(){


		//$(".inside-box-im").hide();
		if(Notification.permission !== 'granted'){
			Notification.requestPermission();
		}
	    $('.for_datatables').DataTable({
	    		"order": [[ 0, "desc" ]]
	    	});
	    $('.for_datatables_asc').DataTable({
	    		"order": [[ 0, "asc" ]]
	    	});
	    $("a").css('cursor','pointer');
	    $('#modal_profiling').modal({'show':false});
	    $('#modal_funnyname').modal({'show':false});

		$('#modal_funnyname .modal-dialog').css('width','1200px');
	    $(".for_date").datepicker();
	    $(".datepicker").daterangepicker();

	    setInterval(function () {
			<?php if(in_array($this->session->userdata('id'), $group_alert['notif_issued_process_revert_log'])){?>
	    	get_issued_log_data();
	    	<?php }
			if(in_array($this->session->userdata('id'), $group_alert['notif_pending_log'])){?>
	    	get_pending_action();
	    	<?php }
	    	if(in_array($this->session->userdata('id'), $group_alert['notif_saldo_log'])){?>
 	    	get_saldo_airline();
 	    	<?php } ?>
	    },1000*1);

	});
var REVERT_DATA = <?php echo $this->session->userdata('revert_data');?>;

	function openfordate(id){
		$("#"+id).focus();
	}

	function clear_btn(){
		$("#btn_fol").remove();
		$("#btn_fol2").remove();
		$("#btn_fol3").remove();

		$("#btn_fol").remove();
		$("#btn_fol2").remove();
		$("#btn_fol3").remove();

		$("#btn_fol").remove();
		$("#btn_fol2").remove();
		$("#btn_fol3").remove();
	}
$(function() {
	$(".for_mitra").autocomplete({
	  source: function( request, response ) {
	     $.ajax({
			url: "<?php echo base_url('xhr_ajax/ajax_get_mitra');?>",
			type: "POST",
			dataType: "json",
			data: {term: request.term},
			success: function(data) {
				response(data);
			}
	     });
	   },
		select:function(event, ui){
			$("#id_mitra").val(ui.item.id);
		}
	 });
});

	function get_saldo_airline(){

		var clock = new Date().getHours();
		var minutes = new Date().getMinutes();
		var second = new Date().getSeconds();

 		$.ajax({
 			url:'<?php echo base_url("xhr_ajax/cek_deposit");?>',
 			type:'GET',
 			dataType:'json',
 			success:function(balik){
 				var saldo = balik.saldo;
 				var muncul = balik.muncul;
 				$("#deposit_data").html('');
 				$("#deposit_data").html('');
 				$("#deposit_data").html('');
 				$("#deposit_data").html('');
 				var jml_dt = 0;
 				for(var data in saldo) {
 					var color = "";
 					var click = "";
 					if(saldo[data].muncul==1){
 						color = "bg-green";
 					}
 					if(saldo[data].muncul==2){
 						color = "bg-orange";
 					}
 					if(saldo[data].muncul==3){
 						color = "bg-red";
 					}

 					if(saldo[data].muncul>0 || clock==15 || clock==16){

 						$("#deposit_data").append('<li class="'+color+'" id="'+saldo[data].id+'" onclick="update_saldo('+saldo[data].id+',\''+saldo[data].code+'\',\''+saldo[data].airline+'\')" style="cursor:pointer;">'+
	 													'<a class="text-black waves-eff-li">'+
	 			  											'<i class="fa fa-money text-aqua"></i> '+saldo[data].code+' - '+saldo[data].airline+' - '+saldo[data].saldo+
	 													'</a>'+
	 												'</li>');

					jml_dt++;
 					}

					//console.log(clock+' '+minutes+' '+second);
 				}
 				$("#label_deposit_data").html(jml_dt);
 				if(muncul || (clock==15 && minutes==30 && (second>30 && second<32))){
					
					notif = new Notification('Alert Top Up Saldo Airlines', {
				      icon: 'http://office.pointer.co.id/office/assets/favicon.png',
				      body: 'Alert Top Up Saldo Airlines, Please Check',
				    });

				    notif.onclick = function (x) {
				      window.focus();
				    };

					var audio_saldo = new Audio('<?php echo base_url("assets/sound/RedAlert.mp3");?>');
					audio_saldo.play();

				}

 			}
 		});
 	}
	function get_pending_action(){

 		$.ajax({
 			url:'<?php echo base_url("xhr_ajax/ajax_get_pending_action");?>',
 			type:'GET',
 			dataType:'json',
 			success:function(balik){
 				var action = balik.action;
 				var muncul = balik.muncul;
 				$("#pending_data").html('');
 				$("#label_pending").html(action.length);
 				var info = "";
 				var i = 1;

 				for(var data in action) {


	 					if(action[data].trx_info=='topup'){
	 						color="";
	 						if(action[data].id_assign==<?php echo $this->session->userdata('id');?>){
	 							color = 'bg-blue';
	 						}
	 						if(action[data].id_assign!=<?php echo $this->session->userdata('id');?> && action[data].id_assign>0 && action[data].assign_view==1 && action[data].status==1){
	 							color = 'bg-green';
	 						}

	 						$("#pending_data").append('<li class="'+color+'" id="'+action[data].id+'" onclick="show_update_saldo('+action[data].id+')" style="cursor:pointer;">'+
								'<a class="text-black waves-eff-li">'+
										'<i class="fa fa-money text-aqua"></i> '+action[data].info+
								'</a>'+
							'</li>');
	 						info += action[data].info;

						}
						else if(action[data].trx_info=='rebook'){
							if(action[data].id_assign==0){
			 					$("#pending_data").append('<li class="" id="'+action[data].id+'" style="cursor:pointer;">'+
									'<a class="text-black waves-eff-li">'+
										'<i class="fa fa-money text-aqua"></i> ambil baru '+action[data].info+
									'</a>'+
								'</li>');
	 							info += action[data].info;
		 					}else if(action[data].status==1 && action[data].user_view==0){
			 					$("#pending_data").append('<li class="" id="'+action[data].id+'" style="cursor:pointer;">'+
									'<a class="text-black waves-eff-li">'+
										'<i class="fa fa-ticket text-aqua"></i> request selesai '+action[data].info+
									'</a>'+
								'</li>');
	 							info += action[data].info;
		 					}
						}
						else if(action[data].trx_info=='issued'){
							if(action[data].id_flowsys==5){
			 					$("#pending_data").append('<li class="" id="'+action[data].id+'" style="cursor:pointer;">'+
									'<a class="text-black waves-eff-li">'+
										'<i class="fa fa-money text-aqua"></i> '+action[data].info+
									'</a>'+
								'</li>');
	 							info += action[data].info;
		 					}
						}
						else if(action[data].trx_info=='...'){
							//other transaction info.................
						}
						else{
							// if doesn't find trx info
		 					$("#pending_data").append('<li class="" id="'+action[data].id+'" style="cursor:pointer;">'+
								'<a class="text-black waves-eff-li">'+
									'<i class="fa fa-money text-aqua"></i> '+action[data].info+
									'<div class="btn pull-right" onclick="alert(\'Transaction is not defined\')">OK</div>'+
								'</a>'+
							'</li>');
						}

						//console.log(action.length);
						//console.log(i);
 					if(i<action.length){
 						info += '\r\n';
 					}
 					
 					i++;

 				}
				if(muncul){
				
					notif = new Notification('Pending Request', {
				      icon: 'http://office.pointer.co.id/office/assets/favicon.png',
				      body: info,
				    });

				    notif.onclick = function (x) {
				      window.focus();
				    };
				}
 			// 	if(muncul){
				// 	 var audio_saldo = new Audio('<?php echo base_url("assets/sound/RedAlert.mp3");?>');
				// 	 audio_saldo.play();
				// }

 			}
 		});
 	}

	function showstatus () {
		clear_btn();
		$(".modal-footer").prepend('<button onclick="save_status()" id="btn_fol" class="pull-left btn btn-primary">Submit</button>');
		$("#exampleModalLabel").html('Change Status');
		$("#isinya").html('<tr>'+
				'<td>Status</td>'+
				'<td><select class="form-control" type="text" id="status_online">'+
						'<option value="Online"><i class="fa fa-circle text-success"></i> Online</option>'+
						'<option value="Invisible"><i class="fa fa-circle text-error"></i> Invisible</option>'+
				'</td>'+
			'</tr>');
	    $('#modal_profiling').modal('show');
	}	
	function update_saldo (id,code,airline) {
		close_popup();
		clear_btn();
		$(".modal-footer").prepend('<button onclick="save_saldo('+id+')" id="btn_fol" class="pull-left btn btn-primary">Submit</button>');
		$("#exampleModalLabel").html('Update Top Up Saldo '+airline);
		$("#isinya").html('<tr>'+
				'<td>Airline</td>'+
				'<td>'+code+' - '+airline+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td>Jumlah</td>'+
				'<td><div class="form-control" id="jumlah_saldo"></div></td>'+
			'</tr>');

        $("#jumlah_saldo").jqxNumberInput({ width: '330px', height: '25px', digits: 20, max:9999999999999999999,symbol:'Rp. '});
	    $('#modal_profiling').modal('show');
	}
    function save_saldo (id) {

		close_popup();
		clear_btn();
		setTimeout(function(){
			var vendor = id;				
			var saldo = $("#jumlah_saldo").jqxNumberInput('getDecimal');
			var info = $("#exampleModalLabel").html();
			//alert(saldo);

			$.ajax({
				type:"POST",
				url:'<?php echo base_url("xhr_ajax/ajax_actionsys_save");?>',
				dataType:'json',
				data:{info:info,act_budget:saldo,vendor:vendor,id_flowsys:10,user_view:1,assign_view:0,trx_info:'topup'},
				success:function(isi){

					$("#exampleModalLabel").html(info);
					$("#isinya").html(isi.status+" - "+isi.msg);
				    $('#modal_profiling').modal('show');
				}
			});
		},1000);
	}
	function opencode (lanjut,kode_booking) {

		close_popup();
		clear_btn();
		setTimeout(function(){				

			$.ajax({
				type:"POST",
				url:'<?php echo base_url("xhr_ajax/lookup_code");?>',
				dataType:'json',
				data:{code:kode_booking},
				success:function(isi){
					if(isi.ar_booking!==null){
						temp_code = isi;
						var ar = isi.ar_booking;
						var mi = isi.mitra;
						var ar_pnr = isi.ar_booking_pnr;

						var paxinfo = '<table class="table">';
						paxinfo +=    '<tr>'+
										'<th>Title</th>'+
										'<th>Name</th>'+
										'<th>Type</th>'+
										'<th>Rute</th>'+
										'<th>Class</th>'+
									'</tr>';
						$.each( ar_pnr, function( key, value ) {
						  paxinfo +=    '<tr>'+
											'<td>'+value.title_pax+'</td>'+
											'<td>'+value.nama_pax+'</td>'+
											'<td>'+value.jenis_pax+'</td>'+
											'<td>'+value.kota_asal+'-'+value.kota_tujuan+'</td>'+
											'<td>'+value.kelas+'</td>'+
										'</tr>';
						});
							paxinfo +='</table>';

						var html = '<table class="table">'+
									'<tr>'+
										'<td>Booking Code</td>'+
										'<td><b>'+ar.kode_booking+'</b></td>'+
										'<td colspan=2>Brand Name</td>'+
										'<td colspan=2>'+mi.brand_name+' ('+mi.prefix+')</td>'+
									'</tr>'+
									'<tr>'+
										'<td>Airline</td>'+
										'<td>'+ar.nama_pesawat+'</td>'+
										'<td colspan=2>Depart</td>'+
										'<td colspan=2>'+ar.tgl_berangkat_takeoff+' '+ar.time_berangkat_takeoff+'</td>'+
									'</tr>'+
									'<tr>'+
										'<td>Flight Type</td>'+
										'<td>'+ar.flight_type+'</td>'+
										'<td colspan=2>Route</td>'+
										'<td colspan=2>'+ar_pnr[0].kota_asal+' - '+ar_pnr[0].kota_tujuan+' ('+ar.route+')</td>'+
									'</tr>'+
									'<tr>'+
										'<td colspan=6>Pax Info</td>'+
									'</tr>'+
									'<tr>'+
										'<td colspan=6>'+paxinfo+'</td>'+
									'</tr>'+
									'<tr>'+
										'<td>NTA</td>'+
										'<td>'+ar.nta_idr+'</td>'+
										'<td>Pax</td>'+
										'<td>'+ar.pax_idr+'</td>'+
										'<td>Member Paid</td>'+
										'<td>'+ar.self_price+'</td>'+
									'</table>';
						$(".modal-footer").prepend('<button onclick="us'+'ecode_'+lanjut+'()" id="btn_fol" class="pull-left btn btn-primary">Use This</button>');

						$("#exampleModalLabelFunnyname").html(kode_booking);
						$("#isinyafunnyname").html(html);
					    $('#modal_funnyname').modal('show');
					}else{
						//$(".inside-box-im").fadeIn();
					}
				}
			});
		},500);
	}
    function lookupcode (lanjut) {

		close_popup();
		clear_btn();
		setTimeout(function(){
			var kode_booking = $("#kode_booking").val();				

			$.ajax({
				type:"POST",
				url:'<?php echo base_url("xhr_ajax/lookup_code");?>',
				dataType:'json',
				data:{code:kode_booking},
				success:function(isi){
					if(isi.ar_booking!==null){
						temp_code = isi;
						var ar = isi.ar_booking;
						var mi = isi.mitra;
						var ar_pnr = isi.ar_booking_pnr;

						var paxinfo = '<table class="table">';
						paxinfo +=    '<tr>'+
										'<th>Title</th>'+
										'<th>Name</th>'+
										'<th>Type</th>'+
										'<th>Rute</th>'+
										'<th>Class</th>'+
									'</tr>';
						$.each( ar_pnr, function( key, value ) {
						  paxinfo +=    '<tr>'+
											'<td>'+value.title_pax+'</td>'+
											'<td>'+value.nama_pax+'</td>'+
											'<td>'+value.jenis_pax+'</td>'+
											'<td>'+value.kota_asal+'-'+value.kota_tujuan+'</td>'+
											'<td>'+value.kelas+'</td>'+
										'</tr>';
						});
							paxinfo +='</table>';

						var html = '<table class="table">'+
									'<tr>'+
										'<td>Booking Code</td>'+
										'<td><b>'+ar.kode_booking+'</b></td>'+
										'<td colspan=2>Brand Name</td>'+
										'<td colspan=2>'+mi.brand_name+' ('+mi.prefix+')</td>'+
									'</tr>'+
									'<tr>'+
										'<td>Airline</td>'+
										'<td>'+ar.nama_pesawat+'</td>'+
										'<td colspan=2>Depart</td>'+
										'<td colspan=2>'+ar.tgl_berangkat_takeoff+' '+ar.time_berangkat_takeoff+'</td>'+
									'</tr>'+
									'<tr>'+
										'<td>Flight Type</td>'+
										'<td>'+ar.flight_type+'</td>'+
										'<td colspan=2>Route</td>'+
										'<td colspan=2>'+ar_pnr[0].kota_asal+' - '+ar_pnr[0].kota_tujuan+' ('+ar.route+')</td>'+
									'</tr>'+
									'<tr>'+
										'<td colspan=6>Pax Info</td>'+
									'</tr>'+
									'<tr>'+
										'<td colspan=6>'+paxinfo+'</td>'+
									'</tr>'+
									'<tr>'+
										'<td>NTA</td>'+
										'<td>'+ar.nta_idr+'</td>'+
										'<td>Pax</td>'+
										'<td>'+ar.pax_idr+'</td>'+
										'<td>Member Paid</td>'+
										'<td>'+ar.self_price+'</td>'+
									'</table>';
						$(".modal-footer").prepend('<button onclick="us'+'ecode_'+lanjut+'()" id="btn_fol" class="pull-left btn btn-primary">Use This</button>');

						$("#exampleModalLabelFunnyname").html(kode_booking);
						$("#isinyafunnyname").html(html);
					    $('#modal_funnyname').modal('show');
					}else{
						//$(".inside-box-im").fadeIn();
					}
				}
			});
		},500);
	}
	function usecode_issued(){
		//$(".inside-box-im").fadeIn();
		close_popup();
		clear_btn();
		$("#pax").jqxNumberInput('setDecimal',temp_code.ar_booking.pax_idr);
		$("#nta").jqxNumberInput('setDecimal',temp_code.ar_booking.nta_idr);
		$("#memberpaid").jqxNumberInput('setDecimal',temp_code.ar_booking.self_price);
		$("#mitra").val(temp_code.mitra.brand_name+' ('+temp_code.mitra.prefix+')');
		$("#from").val(temp_code.ar_booking_pnr[0].kota_asal);
		$("#to").val(temp_code.ar_booking_pnr[0].kota_tujuan);
		$("#class").val(temp_code.ar_booking_pnr[0].kelas);
		$("#id_mitra").val(temp_code.ar_booking.id_mitra);
		$("#flight_type").val(temp_code.ar_booking.flight_type);
		$("#adult").val(temp_code.ar_booking.jml_dewasa);
		$("#child").val(temp_code.ar_booking.jml_child);
		$("#infant").val(temp_code.ar_booking.jml_inf);
		$("#paxinfo").val(temp_code.json_data);
		$('#vendor option[value='+temp_code.ar_booking.vendor+']').attr('selected','selected');
		$("#tgl_info").focus();
	}
	function usecode_rebook(){
		//$(".inside-box-im").fadeIn();
		close_popup();
		clear_btn();
		$("#mitra").val(temp_code.mitra.brand_name+' ('+temp_code.mitra.prefix+')');
		$("#from").val(temp_code.ar_booking_pnr[0].kota_asal);
		$("#to").val(temp_code.ar_booking_pnr[0].kota_tujuan);
		$("#class").val(temp_code.ar_booking_pnr[0].kelas);
		$("#pax_name").val(temp_code.ar_booking_pnr[0].nama_pax);
		$("#id_mitra").val(temp_code.ar_booking.id_mitra);
		$("#paxinfo").val(temp_code.json_data);
		$('#vendor option[value='+temp_code.ar_booking.vendor+']').attr('selected','selected');
		$("#rebook_from").focus();
	}
    function show_update_saldo(id) {

		close_popup();
		clear_btn();
		setTimeout(function(){
			//alert(saldo);

			$.ajax({
				type:"POST",
				url:'<?php echo base_url("xhr_ajax/ajax_get_actionsys_data_open");?>',
				dataType:'json',
				data:{id:id},
				success:function(isi){
					if((isi.status=="VIEW" && isi.data.id_assign==<?php echo $this->session->userdata('id');?>) || isi.status=="OPEN"){
						$(".modal-footer").prepend('<button onclick="update_action_open('+id+')" id="btn_fol2" class="pull-left btn btn-primary " >Cancel</button>');
						$(".modal-footer").prepend('<button onclick="update_action_done('+id+')" id="btn_fol" class="pull-left btn btn-primary " >Done</button>');
						$("#exampleModalLabel").html(isi.data.info);
						$("#isinya").html(isi.data.info+" - "+isi.data.act_budget);
					    $('#modal_profiling').modal('show');
					}else if(isi.status=="FINISH"){
						$("#exampleModalLabel").html(isi.data.info);
						$("#isinya").html('This task has done by '+isi.by);
					    $('#modal_profiling').modal('show');
					}else{
						$("#exampleModalLabel").html(isi.data.info);
						$("#isinya").html('This task is viewed by '+isi.by);
					    $('#modal_profiling').modal('show');
					}
				}
			});
		},1000);
	}
    function update_action_open (id) {

		close_popup();
		clear_btn();
		setTimeout(function(){
			//alert(saldo);

			$.ajax({
				type:"POST",
				url:'<?php echo base_url("xhr_ajax/update_action_open");?>',
				data:{id:id},
				success:function(isi){
					$("#exampleModalLabel").html('Status');
					$("#isinya").html('OK, Revert to open');
				    $('#modal_profiling').modal('show');
				}
			});
		},1000);
	}
    function update_action_done (id) {

		close_popup();
		clear_btn();
		setTimeout(function(){
			//alert(saldo);

			$.ajax({
				type:"POST",
				url:'<?php echo base_url("xhr_ajax/update_action_done");?>',
				data:{id:id},
				success:function(isi){
					$("#exampleModalLabel").html('Status');
					$("#isinya").html('OK Clear!');
				    $('#modal_profiling').modal('show');
				}
			});
		},1000);
	}
	function show_funnyname(link) {
		clear_btn();
		$("#exampleModalLabelFunnyname").html('Funnyname');
		$("#isinyafunnyname").html('<iframe style="width:1150px;height:450px;border:0px;" src="'+link+'"></iframe>');
	    $('#modal_funnyname').modal('show');
	}

	function save_status () {
		$.ajax({
			url:'<?php echo base_url("xhr_ajax/change_status");?>',
			type:'POST',
			data:{status:$("#status_online").val()},
			success:function(balik){
				var data = 'error';
				if(balik=='Online'){
					data = 'success';
				}
				$("#status_").html('<i class="fa fa-circle text-'+data+'"></i> '+balik);

				close_popup();
			}
		});
	}

	function get_issued_log_data (date) {
		$.ajax({
			url:'<?php echo base_url("xhr_ajax/issued_log_data");?>',
			type:'GET',
			dataType:'json',
			success:function(balik){
				var process = balik.process;
				var revert = balik.revert;
				var muncul = balik.muncul;
				balik = balik.data;

				$("#label_processing_log").html(process.length);
				$("#label_revert_log").html(revert.length);
				$("#label_issued_log").html('10');
				$("#issued_log_data").html('');
				$("#processing_log_data").html('');
				$("#processing_train_data").html('');
				var abu = 0;
				for(var data in balik) {
					var url = "https://admin.pointer.co.id/hotel/admin/detail/"+balik[data].kode_booking;
					if(balik[data].tipe=="airline"){
						url = 'https://admin.pointer.co.id/airline/admin/viewbook/'+balik[data].id_mitra+'-'+balik[data].kode_booking;
					}else if(balik[data].tipe=="train"){
						url = 'https://admin.pointer.co.id/train/admin/viewbook/'+balik[data].id_mitra+'-'+balik[data].kode_booking;
					}
					$("#issued_log_data").append('<li >'+
													'<a style="color:black;" target="_blank" href="'+url+'" class="waves-eff-li">'+
			  											'<i class="fa fa-ticket text-aqua"></i> '+balik[data].kode_booking+' - '+balik[data].brand_name+
													'</a>'+
												'</li>');
				}
				for(var data in process) {
					var url = "https://admin.pointer.co.id/hotel/admin/detail/"+process[data].kode_booking;
					if(process[data].tipe=="airline"){
						url = 'https://admin.pointer.co.id/airline/admin/viewbook/'+process[data].id_mitra+'-'+process[data].kode_booking;
					}else if(process[data].tipe=="train"){
						url = 'https://admin.pointer.co.id/train/admin/viewbook/'+process[data].id_mitra+'-'+process[data].kode_booking;
					}

					var merah = ""; 

					if(parseInt(process[data].diff)>0){
						merah = "bg-red";
						abu = 1;
					}

						$("#processing_log_data").append('<li class="'+merah+'"><a class="waves-eff-li" style="color:black;" target="_blank" href="https://admin.pointer.co.id/airline/admin/viewbook/'+process[data].id_mitra+'-'+process[data].kode_booking+'">'+
	                      '<div class="pull-left">'+
	                        '<span style="font-size:30pt;text-align:center;color:orange;" class="fa fa-exclamation-circle"></span>'+
	                      '</div>'+
	                      '<h4>'+process[data].kode_booking+
	                        '<small><i class="fa fa-clock-o"></i> '+process[data].waktu+'</small>'+
	                      '</h4>'+
	                      '<p>'+process[data].brand_name+'</p>'+
	                    '</a></li>');
				}
				if(abu==0){
					bunyi=0;
				}

				$("#revert_log_data").html('');
					REVERT_DATA = revert.length;
					for(var data in revert) {
						if(revert[data].airline==13){
							revert[data].airline = 'GA';
						}else if(revert[data].airline==12 || revert[data].airline==2){
							revert[data].airline = 'JT';
						}

						if(revert[data].status==2 || revert[data].status==21){
							revert[data].status = 'Confirmed';
						}else{
							revert[data].status = 'Waiting';
						}
						var url = 'https://admin.pointer.co.id/airline/admin/viewbook/'+revert[data].id_mitra+'-'+revert[data].kode_booking;
						if(revert[data].airline=="KAI"){
							url = 'https://admin.pointer.co.id/train/admin/viewbook/'+revert[data].id_mitra+'-'+revert[data].kode_booking;
						}

						$("#revert_log_data").append('<li><a class="waves-eff-li" id="revert_'+revert[data].id+'" style="color:black;cursor:pointer;" onclick=\'error_followup("'+revert[data].id+'","'+url+'","'+revert[data].kode_booking+'","'+revert[data].brand_name+'")\'>'+
	                      '<div class="pull-left">'+
	                        '<span style="font-size:30pt;text-align:center;color:red;" class="fa fa-exclamation-circle"></span>'+
	                      '</div>'+
	                      '<h4>'+revert[data].nama+' - '+revert[data].kode_booking+' ('+revert[data].status+')'+
	                      '</h4>'+
	                      '<p>'+revert[data].brand_name+'</p>'+
	                      '<p><small><i class="fa fa-clock-o"></i> '+revert[data].created_at+'</small></p>'+
	                    '</a></li>');
					}

				if(muncul){
					var notif = new Array(revert.length);
					REVERT_DATA = revert.length;
					for(var data in revert) {
						if(revert[data].airline==13){
							revert[data].airline = 'GA';
						}else if(revert[data].airline==12 || revert[data].airline==2){
							revert[data].airline = 'JT';
						}
						if(revert[data].status==2 || revert[data].status==21){
							revert[data].status = 'Confirmed';
						}else{
							revert[data].status = 'Waiting';
						}
						var url = 'https://admin.pointer.co.id/airline/admin/viewbook/'+revert[data].id_mitra+'-'+revert[data].kode_booking;

					}
					if(REVERT_DATA>0){
						notif = new Notification('Revert Information', {
					      icon: 'http://office.pointer.co.id/office/assets/favicon.png',
					      body: 'new revert GA/JS, please check :)',
					    });

					    notif.onclick = function (x) {
					      window.focus();
					    };

						var audio = new Audio('<?php echo base_url("assets/sound/WhoopTypeAlert.mp3");?>');
						audio.play();
					}
					if(abu>0 && bunyi==0){
						notif = new Notification('Kode Abu-abu', {
					      icon: 'http://office.pointer.co.id/office/assets/favicon.png',
					      body: 'Informasi Kode Booking Abu-abu',
					    });

					    notif.onclick = function (x) {
					      window.focus();
					    };

						var audio = new Audio('<?php echo base_url("assets/sound/WhoopTypeAlert.mp3");?>');
						audio.play();
						bunyi = 1;
					}
				}
			}
		});
	}
		function openaddactivity (arg) {
			$.ajax({
	    		url:'<?php echo base_url("xhr_ajax/ajax_get_activity");?>/'+arg,
	    		type:'POST',
	    		success:function (data) {

	    			$("#TD_TR_"+arg).html(data);
	    			$("#TR_"+arg).fadeIn();
					$("#FRM_"+arg).remove();
					$.ajax({
						type:"POST",
						url:'<?php echo base_url("xhr_ajax/ajax_get_profiling");?>',
						dataType:'json',
						data:{id:arg},
						success:function(balik){
							balik = balik.response;
							var html = '';

							for(var data in balik) {
								html += '<option value="'+balik[data].id+'">'+balik[data].respon+'</option>';
							}

							var isi = '<tr style="display:none;" id="FRM_'+arg+'"><td><input type="hidden" id="member_ID_'+arg+'" value="'+arg+'"></td>'+
							'<td><div class="field"><div class="select"><select id="type_'+arg+'" class="form-control">'+
							'<option value="call">Call</option>'+
							'<option value="email">E-Mail</option>'+
							'<option value="visit">Visit</option>'+
							'<option value="sms">SMS</option>'+
							'<option value="info">Info</option>'+
							'<option value="chat">Chat</option>'+
							'</select></div></div></td>'+
							'<td><div class="field"><div class="select"><select id="respon_'+arg+'" class="form-control">'+
							html+
							'</select></div></div></td>'+
							'<td colspan=3><div class="input2"><input class="form-control" type="text" id="reason_'+arg+'"></div></td>'+
							'<td><button class="btn btn-block btn-primary" onclick="save_data('+arg+')">Submit</button></td></tr>';
							$("#TBL_"+arg).append(isi);
							$("#FRM_"+arg).fadeIn();

			    		}
			    	});
	    		}
	    	});
	    }
	    function showactivity (arg) {

	    	var disp = $("#TR_"+arg).css('display');

			setTimeout(function(){

		    	if(disp=='none'){
			    	$.ajax({
			    		url:'<?php echo base_url("xhr_ajax/ajax_get_activity");?>/'+arg,
			    		type:'POST',
			    		success:function (data) {
			    			$("#TD_TR_"+arg).html(data);
			    			$("#TR_"+arg).fadeIn();
			    		}
			    	});
		    	}else{
		    			$("#TR_"+arg).fadeOut();
		    	}
	    	
			},100);
	    }
	    function save_data (id) {
			var member_ID = $("#member_ID_"+id).val();
			var type = $("#type_"+id).val();
			var reason = $("#reason_"+id).val();
			var respon = $("#respon_"+id).val();
			var respon_data = $("#respon_"+id+" option:selected").html();

			setTimeout(function(){

			$.ajax({
				type:"POST",
				url:'<?php echo base_url("xhr_ajax/ajax_save_act");?>',
				dataType:'json',
				data:{member_ID:member_ID,type:type,reason:reason,id_respon:respon},
				success:function(isi){
					var url = '<?php echo base_url("ajax_del_act/followup_del");?>';
					$("#TBL_"+id).append('<tr style="display:none" id="detail_'+isi.ID+'"><td>#'+isi.ID+'</td><td>'+type+'</td><td>'+respon_data+'</td><td>'+reason+'</td><td>'+isi.PIC+'</td><td>'+isi.create_at+'</td><td><a href="'+url+'/'+isi.ID+'"><i class="fa fa-times"></i></a></td></tr>');
					$("#detail_"+isi.ID).fadeIn();
					$("#FRM_"+id).remove();
				}
			});

			},100);
		}
	    function save_data_from_popup (id) {
			//$('#modal_profiling').modal('hide');

			//$('#modal_profiling').modal('close');
			var member_ID = $("#member_ID_"+id).val();
			var type = $("#type_"+id).val();
			var respon = $("#respon_"+id).val();
			var reason = $("#reason_"+id).val();

			if(reason.replace(' ','')==""){
				alert('Please fill response');
				return;
			}
			close_popup();
			clear_btn();

			setTimeout(function(){

				$.ajax({
					type:"POST",
					url:'<?php echo base_url("xhr_ajax/ajax_save_act");?>',
					dataType:'json',
					data:{member_ID:member_ID,type:type,reason:reason,id_respon:respon},
					success:function(isi){

						$("#isinya").html('Saved!');
						$('#modal_profiling').modal('show');
					}
				});

			},1000);
		}
	    function close_popup() {
	    	clear_btn();
	    	clear_btn();
	    	$(this).find("#btn_modal_close").click();
	    	$(this).find("#btn_modal_close_funnyname").click();
	    	$(document).find("#btn_modal_close").click();
	    	$(document).find("#btn_modal_close_funnyname").click();
	    	$('#modal_profiling').modal('hide');
	    	$('#modal_funnyname').modal('hide');
	    	$(".modal-backdrop fade in").remove();
	    	$(".modal-backdrop fade in").remove();
	    }
	    function del_followup(id) {
	    	if(confirm('Sure to delete?')){

	    	$("#detail_"+id).fadeOut();
			$.ajax({
				type:"POST",
				url:'<?php echo base_url("xhr_ajax/ajax_del_act");?>',
				dataType:'json',
				data:{id:id},
				success:function(isi){
				}
			});
			}
		}
	    function openformdetail(id) {

			$.ajax({
				type:"POST",
				url:'<?php echo base_url("xhr_ajax/ajax_get_profiling");?>',
				dataType:'json',
				data:{id:id},
				success:function(isi){
					var dm = isi.detail_mitra;
					isi     = isi.profiling;

					clear_btn();
					$(".modal-footer").prepend('<button onclick="update_open('+isi.id_mitra+')" id="btn_fol2" class="pull-left btn btn-success " >Update</button>');
					$(".modal-footer").prepend('<button onclick="followup_open('+isi.id_mitra+')" id="btn_fol" class="pull-left btn btn-primary " >Follow Up</button>');
					$("#exampleModalLabelFunnyname").html(isi.brand_name);
					$("#isinyafunnyname").html('<tr>'+
										'<td>Prefix</td>'+
										'<td>'+isi.prefix+'</td>'+
										'<td>Company Type</td>'+
										'<td>'+dm.tipe+'</td>'+
									'</tr>'+
									'<tr>'+
										'<td>Join Date</td>'+
										'<td>'+isi.join_date+'</td>'+
										'<td>Info</td>'+
										'<td>'+dm.info+'</td>'+
									'</tr>'+
									'<tr>'+
										'<td>Type</td>'+
										'<td>'+isi.type+'</td>'+
										'<td>Last Used System</td>'+
										'<td>'+dm.lastsystem+'</td>'+
									'</tr>'+
									'<tr>'+
										'<td>E-Mail</td>'+
										'<td>'+isi.email+'</td>'+
										'<td>Other Info</td>'+
										'<td>'+dm.otherinfo+'</td>'+
									'</tr>'+
									'<tr>'+
										'<td>Address</td>'+
										'<td>'+isi.address+'</td>'+
									'</tr>'+
									'<tr>'+
										'<td>Mobile</td>'+
										'<td>'+isi.mobile+'</td>'+
									'</tr>'+
									'<tr>'+
										'<td>City</td>'+
										'<td>'+isi.city+'</td>'+
									'</tr>'+
									'<tr>'+
										'<td>Province</td>'+
										'<td>'+isi.province+'</td>'+
									'</tr>'+
									'<tr>'+
										'<td>Classification</td>'+
										'<td>'+isi.klasifikasi+'</td>'+
									'</tr>'+
									'<tr>'+
										'<td>Bank</td>'+
										'<td>'+dm.bank+'</td>'+
									'</tr>');
				    $('#modal_funnyname').modal('show');
				}
			});
		}
		function error_followup(id,url,kode_booking,brand_name) {
			close_popup();
			clear_btn();
			setTimeout(function(){
				$.ajax({
					type:"POST",
					url:'<?php echo base_url("xhr_ajax/get_solve_note_option");?>',
					success:function(isi){
						$(".modal-footer").prepend('<button class="btn pull-left btn-primary" id="btn_fol2" onclick="save_solve_note('+id+')">Submit</button><a class="btn pull-left btn-primary" target="_blank" href="'+url+'" id="btn_fol2">View Reservation</a>');
						$("#exampleModalLabel").html(kode_booking+' - '+brand_name);
						var isi = '<tr><td>Brand Name</td><td>'+brand_name+'</td></tr>'+
						'<tr><td>Kode Booking</td><td>'+kode_booking+'</td></tr>'+
						'<tr><td colspan=2>Solve Note</td></tr>'+
						'<tr><td colspan=2><select id="solve_note" class="form-control">'+isi+'</select></td></tr>';
						$("#isinya").html(isi);
					    $('#modal_profiling').modal('show');
					}
				});
			},1000);
		}
		function get_email(id,url,kode_booking,brand_name,kasus) {
			close_popup();
			clear_btn();

			setTimeout(function(){

				$.ajax({
					type:"POST",
					url:'<?php echo base_url("xhr_ajax/get_email_templates_json");?>',
					success:function(isi){
						$(".modal-footer").prepend('<button class="btn pull-left btn-primary" id="btn_fol2" onclick="send_email('+id+')">Submit</button>');
						$("#exampleModalLabel").html(kode_booking+' - '+brand_name);
						var isi = '<tr><td>Brand Name</td><td>'+brand_name+'</td></tr>'+
						'<tr><td>Kode Booking</td><td>'+kode_booking+'</td></tr>'+
						'<tr><td>Kasus</td><td>'+kasus+'</td></tr>'+
						'<tr><td colspan=2>Template</td></tr>'+
						'<tr><td colspan=2><select id="template" class="form-control">'+isi+'</select></td></tr>';
						$("#isinya").html(isi);
					    $('#modal_profiling').modal('show');
					}
				});

			},1000);
		}
		function save_solve_note(id) {
			clear_btn();
			close_popup();

			setTimeout(function(){

			$.ajax({
				type:"POST",
				url:'<?php echo base_url("xhr_ajax/solve_revert");?>',
				data:{id:id,solve_note:$("#solve_note").val()},
				success:function(isi){
					if(isi=="good"){

						$("#isinya").html('OK Clear!');
						$('#modal_profiling').modal('show');
						get_issued_log_data();
					}else{
						$("#isinya").html('Too late...');
						$('#modal_profiling').modal('show');
						get_issued_log_data();
					}
				}
			});

			},1000);
		}
		function send_email(id) {
			clear_btn();
			close_popup();

			setTimeout(function(){
			$.ajax({
				type:"POST",
				url:'<?php echo base_url("xhr_ajax/send_email_solver_revert");?>',
				data:{id:id,template:$("#template").val()},
				success:function(isi){
					if(isi=="sent"){
						$("#isinya").html('OK Clear!');
						$('#modal_profiling').modal('show');
						get_issued_log_data();
					}
				}
			});

			},1000);
		}
	    function followup_open(id) {
			close_popup();


			setTimeout(function(){

			$.ajax({
				type:"POST",
				url:'<?php echo base_url("xhr_ajax/ajax_get_profiling");?>',
				dataType:'json',
				data:{id:id},
				success:function(data){
					var isi = data.profiling;
					console.log(isi);
					var response = data.response;

					var html = '';

					for(var data in response) {
						html += '<option value="'+response[data].id+'">'+response[data].respon+'</option>';
					}

					clear_btn();
					clear_btn();
					$(".modal-footer").prepend('<button class="btn pull-left btn-primary" id="btn_fol" onclick="save_data_from_popup('+isi.id_mitra+')">Submit</button>');
					$("#exampleModalLabel").html(isi.brand_name);
					var isi = '<tr id="FRM_'+isi.id_mitra+'"><td>Brand Name</td><td>'+isi.brand_name+'<input type="hidden" id="member_ID_'+isi.id_mitra+'" value="'+isi.id_mitra+'"></td></tr>'+
					'<tr><td>Type</td><td><select id="type_'+isi.id_mitra+'" class="form-control">'+
					'<option value="call">Call</option>'+
					'<option value="email">E-Mail</option>'+
					'<option value="visit">Visit</option>'+
					'<option value="sms">SMS</option>'+
					'<option value="info">Info</option>'+
					'<option value="chat">Chat</option>'+
					'</select></td></tr>'+
					'<tr><td>Respon</td><td><select id="respon_'+isi.id_mitra+'" class="form-control">'+
					html+
					'</select></td></tr>'+
					'<tr><td>Reason / Response</td><td><input class="form-control" type="text" id="reason_'+isi.id_mitra+'"></td></tr>';
					$("#isinya").html(isi);
				    $('#modal_profiling').modal('show');
				}
			});

			},1000);
		}

//------------------------------------------------------------------------------
		function update_open(id){
			close_popup();

			setTimeout(function(){

			$.ajax({
				type:"POST",
				url:'<?php echo base_url("xhr_ajax/ajax_get_klasifikasi");?>',
				dataType:'json',
				data:{id:id},
				success:function(data){

					var isi = data.getMemberKlas;
					console.log(isi);
					var klasifikasi = data.getKlasifikasi;

					var html = '';

					for(var data in klasifikasi) {
						html += '<option value="'+klasifikasi[data].id+'">'+klasifikasi[data].klasifikasi+'</option>';
					}

					clear_btn();
					clear_btn();

					$(".modal-footer").prepend('<button class="btn pull-left btn-primary" id="btn_fol" onclick="save_dataklas_from_popup('+isi.id_mitra+')">Submit</button>');
					$("#exampleModalLabel").html(isi.brand_name);

					var isi	 = '<tr id="FRM_'+isi.id_mitra+'"><td>Brand Name</td><td>'+isi.brand_name+'</td></tr>'+
					'<tr><td>classification</td><td><select id="klasifikasi_'+isi.id_mitra+'" class="form-control">'+
					html+
					'</select></td></tr>';

					$("#isinya").html(isi);
					$('#modal_profiling').modal('show');

				}
			});

			},1000);
		}
//------------------------------------------------------------------------------

		function save_dataklas_from_popup (id) {

			var member_klas_id = $("#klasifikasi_"+id).val();
			var member_mitra_id = id;

			close_popup();
			clear_btn();

			setTimeout(function(){

			$.ajax({
				type:"POST",
				url:'<?php echo base_url("xhr_ajax/ajax_save_klasifikasi");?>',
				dataType:'json',
				data:{id_klasifikasi:member_klas_id,id_mitra:member_mitra_id},
				success:function(isi){

					$("#isinya").html('Saved!');
					$('#modal_profiling').modal('show');
				}
			});

			},1000);

		}

//------------------------------------------------------------------------------
</script>
