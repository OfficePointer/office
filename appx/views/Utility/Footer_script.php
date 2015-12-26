<?php
//----------------------------PHP Script---------------------------------------

$this->db->where_in('id',array(7,8,9,10));
$this->db->order_by('id','asc');
$us = $this->db->get('flowsys')->result_array();
$group_alert = array();
foreach ($us as $key) {
	if($key['id']==7){
		$group_alert['alert_topup_1'] = explode(",", $key['assign_user']);
	}
	if($key['id']==8){
		$group_alert['alert_topup_2'] = explode(",", $key['assign_user']);
	}
	if($key['id']==9){
		$group_alert['alert_topup_3'] = explode(",", $key['assign_user']);
	}
	if($key['id']==10){
		$group_alert['alert_topup_finops'] = explode(",", $key['assign_user']);
	}
}





//-----------------------------------------------------------------------------
?>

<script type="text/javascript">
//----------------------------JavaScript---------------------------------------
var muncul_deposit = 0;
	Waves.attach('button');
    Waves.attach('button', ['waves-button', 'waves-float']);
    Waves.attach('.btn', ['waves-button', 'waves-float']);
	Waves.init();

	$(document).ready(function(){


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
	    $(".datepicker").daterangepicker();
	    <?php
          if(in_array($this->session->userdata('group'), array('Service Operation'))){
		?>
	    get_issued_log_data();

	    setInterval(function () {
	    	get_issued_log_data();
	    },1000*5);
	    setInterval(function(){
	    	if($("#modal_profiling").css('display')=='none'){
	    		$('.modal-dialog').css('width','600px');
	    	}
	    },1000);
	    <?php
		}
		if(in_array($this->session->userdata('group'), array('Service Operation','Finance'))){
 		?>
 	    get_saldo_airline();

 	    setInterval(function () {
 	    	get_saldo_airline();
 	    },1000*60);
 	    <?php
 		}
 		?>

	});
var REVERT_DATA = <?php echo $this->session->userdata('revert_data');?>;

	function clear_btn(){
		$("#btn_fol").remove();
		$("#btn_fol2").remove();
		$("#btn_fol3").remove();

		$("#btn_fol").remove();
		$("#btn_fol2").remove();
		$("#btn_fol3").remove();
	}

	function get_saldo_airline(){

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
 				$("#label_deposit_data").html(saldo.length);
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

 					$("#deposit_data").append('<li class="'+color+'" id="'+saldo[data].id+'" onclick="update_saldo('+saldo[data].id+',\''+saldo[data].code+'\',\''+saldo[data].airline+'\')" style="cursor:pointer;">'+
 													'<a class="text-black waves-eff-li">'+
 			  											'<i class="fa fa-money text-aqua"></i> '+saldo[data].code+' - '+saldo[data].airline+' - '+saldo[data].saldo+
 													'</a>'+
 												'</li>');
 					<?php
 					if(in_array($this->session->userdata('id'), $group_alert['alert_topup_1'])
 						or in_array($this->session->userdata('id'), $group_alert['alert_topup_2'])
 						or in_array($this->session->userdata('id'), $group_alert['alert_topup_3'])){
 					?>

			 				if(muncul && saldo[data].muncul>0){
							
								notif = new Notification('Alert Top Up Saldo Vendor', {
							      icon: 'http://office.pointer.co.id/office/assets/favicon.png',
							      body: 'Alert '+saldo[data].muncul+' Top Up Saldo '+saldo[data].code+' - '+saldo[data].airline+' - '+saldo[data].saldo,
							    });

							    notif.onclick = function (x) {
							      window.focus();
							    };

							    if(saldo[data].muncul==3){
								 var audio_saldo = new Audio('<?php echo base_url("assets/sound/RedAlert.mp3");?>');
								 audio_saldo.play();
								}
							}

					<?php
					}
					?>
 				}

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
		clear_btn();
		$(".modal-footer").prepend('<button onclick="save_saldo('+id+')" id="btn_fol" class="pull-left btn btn-primary">Submit</button>');
		$("#exampleModalLabel").html('Update Top Up Saldo '+airline);
		$("#isinya").html('<tr>'+
				'<td>Airline</td>'+
				'<td>'+code+' - '+airline+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td>Jumlah</td>'+
				'<td><div type="text" class="form-control" id="jumlah_saldo"></div></td>'+
			'</tr>');

        $("#jumlah_saldo").jqxNumberInput({ width: '90%', height: '25px', digits: 20, max:9999999999999999999999999,symbol:'Rp. '});
	    $('#modal_profiling').modal('show');
	}
    function save_saldo (id) {
		var vendor = id;
		var saldo = $("#jumlah_saldo").jqxNumberInput('getDecimal');

		alert(saldo);


		// $.ajax({
		// 	type:"POST",
		// 	url:'<?php echo base_url("xhr_ajax/ajax_save_act");?>',
		// 	dataType:'json',
		// 	data:{member_ID:member_ID,type:type,reason:reason,id_respon:respon},
		// 	success:function(isi){
		// 		var url = '<?php echo base_url("marketing/followup_del");?>';
		// 		$("#TBL_"+id).append('<tr style="display:none" id="detail_'+isi.ID+'"><td>#'+isi.ID+'</td><td>'+type+'</td><td>'+respon_data+'</td><td>'+reason+'</td><td>'+isi.PIC+'</td><td>'+isi.create_at+'</td><td><a href="'+url+'/'+isi.ID+'">Delete</a></td></tr>');
		// 		$("#detail_"+isi.ID).fadeIn();
		// 		$("#FRM_"+id).remove();
		// 	}
		// });
	}
	function show_funnyname(link) {
		clear_btn();
		$("#exampleModalLabel").html('Funnyname');
		$("#isinya").html('<iframe style="width:1150px;height:450px;border:0px;" src="'+link+'"></iframe>');
	    $('.modal-dialog').css('width','1200px');
	    $('#modal_profiling').modal('show');
	    $("#modal_profiling").on('hide',function(){
	    	$('.modal-dialog').css('width','600px');
	    });
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

				$(document).find("#btn_modal_close").click();
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

					$("#processing_log_data").append('<li><a class="waves-eff-li" style="color:black;" target="_blank" href="https://admin.pointer.co.id/airline/admin/viewbook/'+process[data].id_mitra+'-'+process[data].kode_booking+'">'+
                      '<div class="pull-left">'+
                        '<span style="font-size:30pt;text-align:center;color:orange;" class="fa fa-exclamation-circle"></span>'+
                      '</div>'+
                      '<h4>'+process[data].kode_booking+
                        '<small><i class="fa fa-clock-o"></i> '+process[data].waktu+'</small>'+
                      '</h4>'+
                      '<p>'+process[data].brand_name+'</p>'+
                    '</a></li>');
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
	    }
	    function save_data (id) {
			var member_ID = $("#member_ID_"+id).val();
			var type = $("#type_"+id).val();
			var reason = $("#reason_"+id).val();
			var respon = $("#respon_"+id).val();
			var respon_data = $("#respon_"+id+" option:selected").html();

			$.ajax({
				type:"POST",
				url:'<?php echo base_url("xhr_ajax/ajax_save_act");?>',
				dataType:'json',
				data:{member_ID:member_ID,type:type,reason:reason,id_respon:respon},
				success:function(isi){
					var url = '<?php echo base_url("marketing/followup_del");?>';
					$("#TBL_"+id).append('<tr style="display:none" id="detail_'+isi.ID+'"><td>#'+isi.ID+'</td><td>'+type+'</td><td>'+respon_data+'</td><td>'+reason+'</td><td>'+isi.PIC+'</td><td>'+isi.create_at+'</td><td><a href="'+url+'/'+isi.ID+'">Delete</a></td></tr>');
					$("#detail_"+isi.ID).fadeIn();
					$("#FRM_"+id).remove();
				}
			});
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
			$(this).find("#btn_modal_close").click();
			clear_btn();

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
					isi     = isi.profiling;

			$.ajax({
				type:"POST",
				url:'<?php echo base_url("xhr_ajax/ajax_get_klasifikasi");?>',
				dataType:'json',
				data:{id:id},
				success:function(isiklas){
					isiklas = isiklas.getMemberKlas;

					clear_btn();
					$(".modal-footer").prepend('<button onclick="update_open('+isi.id_mitra+')" id="btn_fol" class="pull-left btn btn-success " >Update</button>');
					$(".modal-footer").prepend('<button onclick="followup_open('+isi.id_mitra+')" id="btn_fol" class="pull-left btn btn-primary " >Follow Up</button>');
					$("#exampleModalLabel").html(isi.brand_name);
					$("#isinya").html('<tr>'+
										'<td>Prefix</td>'+
										'<td>'+isi.prefix+'</td>'+
									'</tr>'+
									'<tr>'+
										'<td>Join Date</td>'+
										'<td>'+isi.join_date+'</td>'+
									'</tr>'+
									'<tr>'+
										'<td>Type</td>'+
										'<td>'+isi.type+'</td>'+
									'</tr>'+
									'<tr>'+
										'<td>E-Mail</td>'+
										'<td>'+isi.email+'</td>'+
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
									'</tr>');
				    $('#modal_profiling').modal('show');

						}
					});
				}
			});
		}
		function error_followup(id,url,kode_booking,brand_name) {
			$(this).find("#btn_modal_close").click();
			clear_btn();
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
		}
		function get_email(id,url,kode_booking,brand_name,kasus) {
			$(this).find("#btn_modal_close").click();
			clear_btn();
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
		}
		function save_solve_note(id) {
			clear_btn();
			$(this).find("#btn_modal_close").click();
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
		}
		function send_email(id) {
			clear_btn();
			$(this).find("#btn_modal_close").click();
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
		}
	    function followup_open(id) {
			$(this).find("#btn_modal_close").click();


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
		}

//------------------------------------------------------------------------------
		function update_open(id){
			$(this).find("#btn_modal_close").click();

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
		}
//------------------------------------------------------------------------------

		function save_dataklas_from_popup (id) {

			var member_klas_id = $("#klasifikasi_"+id).val();
			var member_mitra_id = id;

			$(this).find("#btn_modal_close").click();
			clear_btn();

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

		}

//------------------------------------------------------------------------------
</script>
