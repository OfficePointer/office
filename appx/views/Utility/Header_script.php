<script type="text/javascript">
    function get_activity_info (id) {
    $.ajax({
      url:'<?php echo base_url("xhr_ajax/get_last_activity");?>/'+id,
      type:'GET',
      dataType:'json',
      success:function(balik){
        $("#detail_fol_"+id).html(balik.followup);       
        $("#detail_class_"+id).html(balik.klasifikasi);       
      }
    });
  }

  function get_user_assign(){
    $.ajax({
      url:'<?php echo base_url("xhr_ajax/get_user_assign");?>',
      type:'GET',
      dataType:'json',
      success:function(data){

          var source =
                {
                    datatype: "json",
                    datafields: [
                        { name: 'id' },
                        { name: 'parentid' },
                        { name: 'text' },
                        { name: 'value' }
                    ],
                    id: 'id',
                    localdata: data
                };
                // create data adapter.
                var dataAdapter = new $.jqx.dataAdapter(source);
                // perform Data Binding.
                dataAdapter.dataBind();
                // get the tree items. The first parameter is the item's id. The second parameter is the parent item's id. The 'items' parameter represents 
                // the sub items collection name. Each jqxTree item has a 'label' property, but in the JSON data, we have a 'text' field. The last parameter 
                // specifies the mapping between the 'text' and 'label' fields.  
                var records = dataAdapter.getRecordsHierarchy('id', 'parentid', 'items', [{ name: 'text', map: 'label'}]);
                $('#user_assign_id').jqxTree({ checkboxes:true,source: records, width: '300px'});
                $('#user_assign_id').jqxTree('expandAll');
                $('#user_assign_id').jqxTree({ hasThreeStates: true });
                $('#user_assign_id').on('checkChange',function (event)
                {
                var items = $('#user_assign_id').jqxTree('getCheckedItems');
                  
                var nilai = "";
                for(var data in items) {
                    nilai += items[data].id+",";
                }
                  $("#id_user").val(nilai);
                });  
      }
    });
  }
</script>