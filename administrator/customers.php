<style>
    .dataTables_filter { display : none; }
</style>
<!-- ################# SCHEDULED AND DELIVERED TABLE ####################### -->
<!--<div class="container" style="max-width:100%;">-->
<div class="container">
	<h3 style="margin-top:20px;margin-bottom:20px">Customers</h3>
	<div class="row">
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
<script>
    var tabel = null;
    
    tabel = $('#customer_list').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": true,
        "scrollX": true,
        "autoWidth": false,
        "order": [[ 0, 'asc' ]],
        "ajax":
        {
            "url": "<?php  echo root();?>do/customer_list/",
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
                return '<center><div><a href="<?php  echo root();?>container-review/?id='+row.id+'"><button type="button" class="btn btn-primary">View</button></a><button type="button" class="btn btn-success" onclick="make_session(0,'+row.id+');  return false;">Make Order</button></div></center>';
              }
            }
        ],
    });

function make_session(container, uid){
	$.post( "<?php echo root();?>inc/exec.php?act=make_session&ajax=1&schedule=1&s=<?php echo $_GET['s'];?>&uid="+uid, { 'uid':uid,'s':'<?php echo $_GET['s'];?>' }, '', 'script');
}

</script>