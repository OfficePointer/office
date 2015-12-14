</div>
<!-- ./wrapper -->
 <div class="modal fade" id="modal_profiling" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-striped" id="isinya">
          <tr>
            <td></td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" id="btn_fol" class="pull-left btn btn-default">Follow Up</button>
        <button type="button" id="btn_modal_close" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- jQuery 2.1.4 -->
<!-- Bootstrap 3.3.5 -->

<script src="<?php echo base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/knob/jquery.knob.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/moment/moment.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/datepicker/bootstrap-datepicker.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/fastclick/fastclick.js');?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('assets/dist/js/app.min.js');?>"></script>
<script type="text/javascript">


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

	    //get_processing_log_data();
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
		?>
	    // setInterval(function () {
	    // 	if(FIRST_CODE!=""){
	    // 		get_processing_log_data();
	    // 	}
	    // },5000);

	});
var REVERT_DATA = <?php echo $this->session->userdata('revert_data');?>;

	// function get_new_data_issued (date,id) {
	// 	$.ajax({
	// 		url:'<?php echo base_url("marketing/new_issued_log_data");?>/'+date+'/'+id,
	// 		type:'GET',
	// 		success:function(balik){
	// 			var balik = jQuery.parseJSON(balik);
	// 			var num = balik.jum;
	// 			balik = balik.data;
	// 			var i=0;
	// 			$("#label_issued_log").html(num);
	// 			for(var data in balik) {
	// 			   	if(i==0){
	// 					FIRST_CODE = balik[data].id;
	// 				}
	// 				$("#issued_log_data").prepend('<li>'+
	// 												'<a href="target="_blank" href="https://admin.pointer.co.id/airline/admin/viewbook/'+balik[data].id_mitra+'-'+balik[data].kode_booking+'">'+
	// 		  											'<i class="fa fa-ticket text-aqua"></i> '+balik[data].kode_booking+' - '+balik[data].brand_name+" ("+balik[data].prefix+")"+
	// 												'</a>'+
	// 											'</li>');
	// 				i++;
	// 			}
	// 		}
	// 	});	
	// }

	function showstatus () {
		$("#btn_fol2").remove();
		$("#btn_fol2").remove();
		$("#btn_fol").remove();
		$(".modal-footer").prepend('<button onclick="save_status()" id="btn_fol" class="pull-left btn btn-primary">Submit</button>');
		$("#btn_fol2").remove();
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
	function show_funnyname(link) {
		$("#btn_fol2").remove();
		$("#btn_fol2").remove();
		$("#btn_fol").remove();
		$("#btn_fol2").remove();
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
			url:'<?php echo base_url("operational/change_status");?>',
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
			url:'<?php echo base_url("marketing/issued_log_data");?>',
			type:'GET',
			success:function(balik){
				var balik = jQuery.parseJSON(balik);
				var process = balik.process;
				var revert = balik.revert;
				var muncul = balik.muncul;
				var kai = balik.kai;
				balik = balik.data;

				$("#label_processing_log").html(process.length);
				$("#label_processing_train").html(kai.length);
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
					$("#issued_log_data").append('<li>'+
													'<a style="color:black;" target="_blank" href="'+url+'">'+
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
					
					$("#processing_log_data").append('<li><a style="color:black;" target="_blank" href="https://admin.pointer.co.id/airline/admin/viewbook/'+process[data].id_mitra+'-'+process[data].kode_booking+'">'+
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

						$("#revert_log_data").append('<li><a id="revert_'+revert[data].id+'" style="color:black;cursor:pointer;" onclick=\'error_followup("'+revert[data].id+'","'+url+'","'+revert[data].kode_booking+'","'+revert[data].brand_name+'")\'>'+
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
	function get_processing_log_data () {
		$.ajax({
			url:'<?php echo base_url("marketing/processing_log_data");?>',
			type:'GET',
			success:function(balik){
				var balik = jQuery.parseJSON(balik);
				var num = balik.jum;
				balik = balik.data;
				$("#label_processing_log").html(num);
				$("#processing_log_data").html('');
				for(var data in balik) {
					$("#processing_log_data").append('<li>'+
													'<a target="_blank" href="https://admin.pointer.co.id/airline/admin/viewbook/'+balik[data].id_mitra+'-'+balik[data].kode_booking+'">'+
														balik[data].kode_booking+' - '+balik[data].brand_name+" ("+balik[data].prefix+")"+
			  											'<small class="pull-right"><i class="fa fa-clock-o"></i> '+balik[data].waktu+'</small>'+
													'</a>'+
												'</li>');
				}
			}
		});
	}
		function openaddactivity (arg) {	    	
			$.ajax({
	    		url:'<?php echo base_url("marketing/ajax_get_activity");?>/'+arg,
	    		type:'POST',
	    		success:function (data) {
	    			$("#TD_TR_"+arg).html(data);
	    			$("#TR_"+arg).fadeIn();
					$("#FRM_"+arg).remove();
					var isi = '<tr style="display:none;" id="FRM_'+arg+'"><td><input type="hidden" id="member_ID_'+arg+'" value="'+arg+'"></td>'+
					'<td><div class="field"><div class="select"><select id="type_'+arg+'" class="form-control">'+
					'<option value="call">Call</option>'+
					'<option value="email">E-Mail</option>'+
					'<option value="visit">Visit</option>'+
					'<option value="sms">SMS</option>'+
					'<option value="info">Info</option>'+
					'<option value="chat">Chat</option>'+
					'</select></div></div></td>'+		
					'<td colspan=3><div class="input2"><input class="form-control" type="text" id="reason_'+arg+'"></div></td>'+
					'<td><button class="btn btn-block btn-primary" onclick="save_data('+arg+')">Submit</button></td></tr>';
					$("#TBL_"+arg).append(isi);
					$("#FRM_"+arg).fadeIn();

	    		}
	    	});
	    }
	    function showactivity (arg) {

	    	var disp = $("#TR_"+arg).css('display');
	    	if(disp=='none'){
	    	$.ajax({
	    		url:'<?php echo base_url("marketing/ajax_get_activity");?>/'+arg,
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

			$.ajax({
				type:"POST",
				url:'<?php echo base_url("marketing/ajax_save_act");?>',
				dataType:'json',
				data:{member_ID:member_ID,type:type,reason:reason},
				success:function(isi){
					var url = '<?php echo base_url("marketing/followup_del");?>';
					$("#TBL_"+id).append('<tr style="display:none" id="detail_'+isi.ID+'"><td>#'+isi.ID+'</td><td>'+type+'</td><td>'+reason+'</td><td>'+isi.PIC+'</td><td>'+isi.create_at+'</td><td><a href="'+url+'/'+isi.ID+'">Delete</a></td></tr>');
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
			var reason = $("#reason_"+id).val();

			if(reason.replace(' ','')==""){
				alert('Please fill response');
				return;
			}
			$(this).find("#btn_modal_close").click();
			$("#btn_fol").remove();
					$("#btn_fol2").remove();

			$.ajax({
				type:"POST",
				url:'<?php echo base_url("marketing/ajax_save_act");?>',
				dataType:'json',
				data:{member_ID:member_ID,type:type,reason:reason},
				success:function(isi){				

					$("#isinya").html('Saved!');
					$('#modal_profiling').modal('show');
				}
			});
		}
	    function del_followup(id) {					
	    	$("#detail_"+id).fadeOut();
			$.ajax({
				type:"POST",
				url:'<?php echo base_url("marketing/ajax_del_act");?>',
				dataType:'json',
				data:{id:id},
				success:function(isi){
				}
			});
		}
	    function openformdetail(id) {		
			$.ajax({
				type:"POST",
				url:'<?php echo base_url("marketing/ajax_get_profiling");?>',
				dataType:'json',
				data:{id:id},
				success:function(isi){
					console.log(isi);
					$("#btn_fol2").remove();
					$("#btn_fol").remove();
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
		function error_followup(id,url,kode_booking,brand_name) {				
			$(this).find("#btn_modal_close").click();
			$("#btn_fol").remove();
			$("#btn_fol2").remove();
			$("#btn_fol").remove();
			$("#btn_fol2").remove();
			$.ajax({
				type:"POST",
				url:'<?php echo base_url("marketing/get_solve_note_option");?>',
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
		function save_solve_note(id) {		
			$("#btn_fol").remove();
			$("#btn_fol2").remove();				
			$("#btn_fol2").remove();				
			$(this).find("#btn_modal_close").click();	
			$.ajax({
				type:"POST",
				url:'<?php echo base_url("marketing/solve_revert");?>',
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
	    function followup_open(id) {				
			$(this).find("#btn_modal_close").click();

	
			$.ajax({
				type:"POST",
				url:'<?php echo base_url("marketing/ajax_get_profiling");?>',
				dataType:'json',
				data:{id:id},
				success:function(isi){
					$("#btn_fol2").remove();
					$("#btn_fol").remove();
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
					'<tr><td>Reason / Response</td><td><input class="form-control" type="text" id="reason_'+isi.id_mitra+'"></td></tr>';
					$("#isinya").html(isi);
				    $('#modal_profiling').modal('show');
				}
			});
		}
</script>

</body>
</html>
