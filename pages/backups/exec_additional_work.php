<?

//case 'add_additional_work':
            $repack_id      = $_POST['repack_id'];
            $wo_id          = $_POST['wo_id'];
              
                /*$query = mysqli_query($link, 'INSERT INTO additional_work (repack_id, work_order,date) VALUES (\''.sf($repack_id).'\', \''.$wo_id.'\', NOW())');
                $aw_id = mysqli_insert_id($link);*/
                $query = mysqli_query($link, 'SELECT id FROM additional_work ORDER BY id DESC LIMIT 1');
                
                if(mysqli_num_rows($query) == 0)
                {
                    $aw_id = 1;    
                }
                else
                {
                    $res = mysqli_fetch_assoc($query);
                    $aw_id = $res['id']+1;
                }

                echo $aw_id;
//		break;
		
//		case 'save_additional_work':
		    
                /*$query = 'UPDATE additional_work SET qb_code=\''.sf($_POST['qb_code']).'\', description=\''.sf($_POST['description']).'\' WHERE id=\''.sf($_GET['id']).'\'';*/
                $query = 'INSERT INTO additional_work (repack_id, work_order,date,qb_code,description) VALUES (\''.sf($repack_id).'\', \''.$wo_id.'\', NOW(),\''.sf($_POST['qb_code']).'\',\''.sf($_POST['description']).'\')';
                mysqli_query($link, $query);
		//break;
		?>
		<script>
		    $(document).on('click', '#addFields', function() {
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
            data: {'repack_id' : $("#aw_repack_id").val(), 'wo_id' : $("#aw_wo_id").val(), },
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
		</script>