<style>
    .print-content {
        width: 100%;
    }
    /* Define the two-column layout for printing */
    .col {
        float: left;
        width: 50%;
        padding: 10px;
    }
    /* Clear the float after the two columns to prevent content overlap */
    .clearfix::after {
        content: "";
        display: table;
        clear: both;
    }
    /*
    .modal-dialog{
        margin:0;
    }
    .modal-content{
        width:100vw;
        height:100vh;
    }*/
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

        <div id="print-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
            <div role="document" class="modal-dialog modal-lg">
                <div class="modal-content" style="background-color:#1d1e22">
                    <div class="modal-header row d-flex justify-content-between mx-1 mx-sm-3 mb-0 pb-0 border-0">
                        <h6 class="font-weight-bold order-id"></h6>
                        <div class="modal-body p-0 print-content clearfix">
                            <div class="infobox p-3 my-3">
                                <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6 container-content">
                                    </div>
                                    <div class="col-md-6 service-content">
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="line"></div>
                        <div class="modal-footer">
                    		<button type="button" class="btn btn-warning" id="btn-print"><i class="fa fa-print"></i> Print</button> 
                    		<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> 
                    	</div>
                    </div>
                </div>
            </div>
        </div>
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
            "url": "<?php  echo root();?>do/container_list_review/?id=<?php  echo $_GET['id'];?>",
            "type": "POST"
        },
        "deferRender": true,
        columnDefs: [
            { "width": "10px", "targets": [0,3] },     
        ],
        "columns": [
            
            { "data": "id" },
            { "data": "manufacturer" },
            { "data": "model" },
            { "data": "serial", "render": function ( data, type, row, meta ){
                return '<div align="center">'+data+'</div>';
              }
            },
            { "data": "aad" },
            { "data": "action", "render": function ( data, type, row, meta ){
                return '<center><div><a href="<?php  echo root();?>container_information/?id='+row.id+'&container='+row.id+'&s='+row.service_id+'&uid='+row.customer+'"><button type="button" class="btn btn-primary" title="View Order"><i class="fa fa-eye"></i></button></a><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#print-modal" data-backdrop="static" data-keyboard="false" data-cont-id="'+row.id+'" title="Print Order" id="show-print"><i class="fa fa-print"></i></button></div><center>';
              }
            }
        ],
    });
    
     $(document).on('click', '#show-print', function() {
        var id = $(this).attr('data-cont-id');
        var item = [];
        var list_item = '';
        var detail_id = 0;
        var total_price = 0;
        
    	$('#print-modal').modal({backdrop: 'static', keyboard: false});
    	
    	$.ajax({
            url: '<?php  echo root();?>do/container_service/?id='+id+'&load=1',
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                
                //console.log(res.container);
                    $('.container-content').html(res.container);     
                    $('.service-content').html(res.service);     
            },
             error: function(jqXHR, textStatus, errorThrown) {
                setTimeout(function() {$('#print-modal').modal('hide');}, 200);
                alert("error");
            }
        });
    });
    
    // Print button click event
    $("#print-modal").on("click", "#btn-print", function() {
        // Get the modal content to print
        var contentToPrint = $('.print-content').html();

        // Open the print dialog with the modal content
        var printWindow = window.open('', '_blank');
        printWindow.document.write('<html><head><title>Print Modal Content</title></head><body>');
        printWindow.document.write(contentToPrint);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
        printWindow.close();
    });
    </script>