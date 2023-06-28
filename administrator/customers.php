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
            "url": "<?=root();?>do/customer_list/",
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
                return '<center><div><a href="<?=root();?>container-review/?id='+row.id+'"><button type="button" class="btn btn-primary">View</button></a></div></center>';
              }
            }
        ],
    });
    
</script>