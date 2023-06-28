<style>
    .dataTables_filter { display : none; }
    .bootbox-body{
        color:#000;
    }
    .noClick { pointer-events: none; }
</style>
<!-- ################# SCHEDULED AND DELIVERED TABLE ####################### -->
<div class="container">
	<h3 style="margin-top:20px;margin-bottom:20px">Staff</h3>
	<a href="<?php  echo root('add-staff');?>"><button id="add" type="button" class="btn btn-success" style="float:right;">Add</button></a>
	<div class="row" style="margin-top:60px">
        <div class="customer_list w-100 mt-3">
            <table id="customer_list" class="table table-striped" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ID#</th> 
                  <th>Name</th>  
                  <th>Email</th>
                  <th>Phone</th>
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
    
    tabel = $('#customer_list').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": true,
        "scrollX": true,
        "autoWidth": false,
        "order": [[ 0, 'asc' ]],
        "ajax":
        {
            "url": "<?php  echo root();?>do/staff_list/",
            "type": "POST"
        },
        "deferRender": true,
        "columns": [
            
            { "data": "id" },
            { "data": "name" },
            { "data": "email" },
            { "data": "phone", "render": function ( data, type, row, meta ){
                return '<div style="text-align:right">'+data+'</div>';
              }
            },
            { "data": "action", "render": function ( data, type, row, meta ){
                if(row.id == sesi){
                    return '<center><div><a href="<?php  echo root();?>add-staff/?id='+row.id+'"><button type="button" class="btn btn-primary">Edit</button></a></div></center>';
                }else{
                    return '<center><div><a href="<?php  echo root();?>add-staff/?id='+row.id+'"><button type="button" class="btn btn-primary">Edit</button></a>&nbsp;<button type="button" class="delete btn btn-danger" id="del_'+row.id+'" data-id='+row.id+' >Delete</button></div></center>';
                }
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
                url: '<?php  echo root();?>do/remove-staff/?id='+deleteid,
                type: 'POST',
                data: { id:deleteid },
                success: function(response){

                   // Removing row from HTML Table
                   if(response == 1){
    		            $(el).closest('tr').css('background','tomato');
                        $(el).closest('tr').fadeOut(800,function(){
    		                $(this).remove();
    		            });
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