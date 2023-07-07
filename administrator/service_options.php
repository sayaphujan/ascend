<style>
/*    .dataTables_filter { display : none; }*/
    .bootbox-body{
        color:#000;
    }
    .noClick { pointer-events: none; }
</style>
<!-- ################# SCHEDULED AND DELIVERED TABLE ####################### -->
<div class="container">
	<h3 style="margin-top:20px;margin-bottom:20px">Service Options</h3>
	<a href="<?php  echo root('add-service-option');?>"><button id="add" type="button" class="btn btn-success" style="float:right;">Add</button></a>
	<div class="row" style="margin-top:60px">
        <div class="service_list w-100 mt-3">
            <table id="service_list" class="table table-striped" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>APS QB-CODE</th> 
                  <th>GROUP</th>
                  <th>SERVICE ITEM</th>  
                  <th>Sales Price</th>
                  <th>Master Rigger</th>
                  <th>Senior Rigger</th>
                  <th>Trainee</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
<script>
    var tabel = null;
    var sesi = "<?php  echo $_SESSION['adminid'];?>";
    
    tabel = $('#service_list').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": true,
        "scrollX": true,
        "autoWidth": false,
        "order": [[ 1, 'asc' ]],
        "ajax":
        {
            "url": "<?php  echo root();?>do/service_list_options/",
            "type": "POST"
        },
        "deferRender": true,
        "columns": [
            
            { "data": "qb_code" },
            { "data": "group_qb_code" },
            { "data": "service_item" },
            { "data": "sales_price", "render": function ( data, type, row, meta ){
                return '<div style="text-align:right">'+data+'</div>';
              }
            },
            { "data": "master_rigger", "render": function ( data, type, row, meta ){
                return '<div style="text-align:right">'+data+'</div>';
              }
            },
            { "data": "senior_rigger", "render": function ( data, type, row, meta ){
                return '<div style="text-align:right">'+data+'</div>';
              }
            },
            { "data": "trainee", "render": function ( data, type, row, meta ){
                return '<div style="text-align:right">'+data+'</div>';
              }
            },
            { "data": "action", "render": function ( data, type, row, meta ){
                    return '<center><div><a href="<?php  echo root();?>add-service-option/?id='+row.id+'"><button type="button" class="btn btn-primary">Edit</button></a>&nbsp;<button type="button" class="delete btn btn-danger" id="del_'+row.id+'" data-id='+row.id+' >Delete</button></div></center>';
              }
            }
        ],
    });
    
    $(document).ready(function(){

  // Delete 
  $(document).on('click', '.delete', function(){
      var el = this;
  
      // Delete id
      var deleteid = $(this).data('id');
 
      // Confirm box
      bootbox.confirm("Do you really want to delete record?", function(result) {
 
         if(result){
            // AJAX Request
            $.ajax({
                url: '<?php  echo root();?>do/remove_service_option/?id='+deleteid,
                type: 'POST',
                data: { id:deleteid },
                success: function(response){

                   // Removing row from HTML Table
                   if(response == 1){
    		            $(el).closest('tr').css('background','tomato');
                        $(el).closest('tr').fadeOut(800,function(){
    		                $(this).remove();
    		            });
                        $('#service_list tr:odd').attr('style','background-color:rgba(0,0,0,.05)')
    	           }else{
    		        bootbox.alert('Record not deleted.');
    	           }
                }
            });
         }
      });
  });
});
</script>