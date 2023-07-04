<?php

$page = trim($_SERVER["REQUEST_URI"],"/");

if($page == 'repacks' && isset($_SESSION['repack_id']) > 0)
{
    $repack_id  = $_SESSION['repack_id'];
    
    $rq = mysqli_query($link,'SELECT * FROM repacks WHERE id =\''.sf($repack_id).'\'');
    $r = mysqli_fetch_assoc($rq);
    $wo_id = $r['work_order'];
}

?>

<style>
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
</style>
<div class="container-fluid">

    <div class="row">
    	<h4>Additional Work Required</h4>
    </div>
    
    <form class="form-horizontal" id="form_additional_work" action="" method="post">
        <input type="hidden" class="form-control" id="repack_id" name="repack_id" value="<?=$repack_id;?>">
        <input type="hidden" class="form-control" id="wo_id" name="wo_id" value="<?=$wo_id;?>">
        <? if($page != 'repacks_review') { ?>
        <button class="btn btn-primary btn-xs" type="button" id="addFields">Add Fields</button><br><br>
        <? } ?>
          <div id="fields">
            <?php
                $rq = mysqli_query($link,'SELECT * FROM additional_work WHERE repack_id =\''.sf($repack_id).'\' AND work_order=\''.sf($wo_id).'\'');
                
                echo 'SELECT * FROM additional_work WHERE repack_id =\''.sf($repack_id).'\' AND work_order=\''.sf($wo_id).'\'';
                while($r = mysqli_fetch_assoc($rq))
                {
            ?>
                    
                <div class="row">
            		<div class="col-md-4">
                        <div class="form-group">
                          <label for="qb_code" class="control-label">QB Code:</label>
                          <input type="text" class="form-control qb_code" id="qb_code_<?=$r['id'];?>" name="qb_code_<?=$r['id'];?>" value="<?=$r['qb_code'];?>" onblur="save_aw(<?=$r['id'];?>)">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description" class="control-label">Description:</label>
                            <br/>
                            <textarea class="form-control boxsizingBorder description" id="description_<?=$r['id'];?>" name="description_<?=$r['id'];?>" value="<?=$r['description'];?>" onblur="save_aw(<?=$r['id'];?>)"><?=$r['description'];?></textarea>
                        </div>
                    </div>
                    <? if($page != 'repacks_review') { ?>
                    <a href="#" class="remove_field" data-id="<?=$r['id'];?>">Remove</a>
                    <?}?>
                </div>
            <? } ?>
          </div><br><br>
    </form>
</div>
<script>
$(document).ready(function() {
  var max_fields = 10;
  var wrapper = $("#fields");
  var add_button = $("#addFields");
  
  var x = 1;
  $(add_button).click(function(e) {
    e.preventDefault();
    
    if (x < max_fields) {
      x++;
      
      $.ajax({
        url: '<?=root();?>do/add_additional_work/',
        type: 'POST',
        dataType: 'json', 
        data: {'repack_id' : $("#repack_id").val(), 'wo_id' : $("#wo_id").val(), },
        encode: true,
        success: function(res){
            if(res > 0){
                 $(wrapper).append('<div class="row"><div class="col-md-4"><div class="form-group"><label for="qb_code" class="control-label">QB Code:</label><input type="text" class="form-control qb_code" id="qb_code_'+res+'" name="qb_code_'+res+'" onblur="save_aw('+res+')"></div></div><div class="col-md-6"><div class="form-group"><label for="description" class="control-label">Description:</label><br/><textarea class="form-control boxsizingBorder description" id="description_'+res+'" name="description_'+res+'" onblur="save_aw('+res+')"></textarea></div></div><a href="#" class="remove_field" data-id="'+res+'">Remove</a></div>');
            }
        }
    });

    }
  });
 
  $(wrapper).on("click", ".remove_field", function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
            $.ajax({
                  type: "GET",
                  url: "<?=root();?>do/delete_additional_work/?id="+id,   
                  dataType:'JSON', 
	        });
    $(this).parent('div').remove();   
    x--;
  });
});

function save_aw(id){
    var qb_code = $('#qb_code_'+id).val();
	var description = $('#description_'+id).val();
	
	        $.ajax({
                  type: "POST",
                  url: "<?=root();?>do/save_additional_work/?id="+id,   
                  data: { 'qb_code' : qb_code, 'description' : description},
                  dataType:'JSON', 
                  success: function (result) {
                      
                  }
	        });
}
</script>