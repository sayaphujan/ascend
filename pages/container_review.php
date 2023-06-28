<style>
    .dataTables_filter { display : none; }
    .form-control:disabled, .form-control[readonly]{
        background-color: #adb2b7;
        opacity: 1;
    }
    textarea
    {
      border:1px solid #999999;
      width:100%;
      margin:5px 0;
      padding:3px;
    }
    
    .boxsizingBorder {
        -webkit-box-sizing: border-box;
           -moz-box-sizing: border-box;
                box-sizing: border-box;
    }

    #repack_content { color: #fff}
    
    .table {
    	background-color: bebebe;
    }
    
    fieldset {
        display: none;
    }
    
    fieldset.show {
        display: block;
    }
    
    select:focus, input:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid #2196F3 !important;
        outline-width: 0 !important;
        font-weight: 400;
    }
    
    button:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        outline-width: 0;
    }
    
    .tabs {
        margin: 2px 5px 0px 5px;
        padding-bottom: 10px;
        cursor: pointer;
    }
    
    .tabs:hover, .tabs.active {
        border-bottom: 1px solid #2196F3;
    }
    
    a:hover {
        text-decoration: none;
        color: #1565C0;
    }
    
    .box {
        margin-bottom: 10px;
        border-radius: 5px;
        padding: 10px;
    }
    
    .modal-backdrop { 
        background-color: #64B5F6;
    }
    
    .line {
        background-color: #CFD8DC;
        height: 1px;
        width: 100%;
    }
    
    @media screen and (max-width: 768px) {
        .tabs h6 {
            font-size: 12px;
        }
    }
    
    .font-weight-bold {
        color: #fff!important;
        font-weight: 700!important;
    }
    
    .text-muted  {
        color: #fff!important;
    }
    
</style>
<div class="container">
	<h3 style="margin-top:20px;margin-bottom:20px">Containers List</h3>
	<div class="row">
        <div class="container_list w-100 mt-3">
            <table id="container_list" class="table table-striped" cellspacing="0">
              <thead>
                <tr>
                  <th class="th-sm" scope="col">ID#</th>  
                  <th class="th-sm" scope="col">Manufacturer</th>  
                  <th class="th-sm" scope="col">Model</th>
                  <th class="th-sm" scope="col">Serial Number</th>
                  <th class="th-sm" scope="col">AAD</th>
                  <th class="th-sm" scope="col"></th>
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
    
    tabel = $('#container_list').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": true,
        "scrollX": true,
        "autoWidth": false,
        "order": [[ 0, 'asc' ]],
        "ajax":
        {
            "url": "<?=root();?>do/container_list_review/?id=<?=$_GET['id'];?>",
            "type": "POST"
        },
        "deferRender": true,
        columnDefs: [
            { "width": "10px", "targets": [0,1,4,5] },     
        ],
        "columns": [
            
            { "data": "id" },
            { "data": "manufacturer" },
            { "data": "model" },
            { "data": "serial" },
            { "data": "aad" },
            { "data": "action", "render": function ( data, type, row, meta ){
                return '<center><div><a href="<?=root();?>repacks-review/?id='+row.id+'"><button type="button" class="btn btn-primary">View</button></a></div><center>';
              }
            }
        ],
    });
    
    </script>