<?php
$s = $_GET['s'];

switch ($s) {
	case '1':
		$o = 'Assemblies, Repacks, Inspections';
		break;
	case '2':
		$o = 'Common Maintenance Items';
		break;
	case '3':
		$o = 'Tandem Maintenance';
		break;
	case '4':
		$o = 'Canopy Sewing';
		break;
	case '5':
		$o = 'Harness Work';
		break;
	
	default:
		$o = 'Assemblies, Repacks, Inspections';
		break;
}

?>
<div class="container-fluid">

    <div class="row">
    	<h4><?php echo $o;?></h4>
    </div>

    <div class="row">
    	<div class="col-md-12">
    	  <form>
    	  	<?php if($s == 1){ ?>
    	  	<div class="form-group">
                <label for="make" class="control-label"><strong>Reserve Repack (SPORT) STANDARD LEAD TIME</strong></label>
                <select class="form-control"  id="S-IRS1" name="S-IRS1" >
                	<option value="Sales Price $110,00">Sales Price $110,00</option>
                	<option value="Master Rigger $60,50">Master Rigger $60,50</option>
                	<option value="Senior Rigger $44,00">Master Rigger $44,00</option>
                	<option value="Trainee $33,00">Master Rigger $33,00</option>
                </select>
            </div>
    	  	<?php }
    	  		if($s == 2){ 
    	  	 ?>
			<div class="form-group">
                <label for="make" class="control-label"><strong>Replace BOC pocket</strong></label>
                <select class="form-control"  id="S-REPLBOC" name="S-REPLBOC" >
                	<option value="Sales Price $40,00">Sales Price $40,00</option>
                	<option value="Master Rigger $20,40">Master Rigger $20,40</option>
                	<option value="Senior Rigger $16,00">Master Rigger $16,00</option>
                	<option value="Trainee $12,00">Master Rigger $12,00</option>
                </select>
            </div>
            <?php }
    	  		if($s == 3){ 
    	  	 ?>
    	  	<div class="form-group">
                <label for="make" class="control-label"><strong>Replace BOC pocket</strong></label>
                <select class="form-control"  id="S-REPLBOC" name="S-REPLBOC" >
                	<option value="Sales Price $40,00">Sales Price $40,00</option>
                	<option value="Master Rigger $20,40">Master Rigger $20,40</option>
                	<option value="Senior Rigger $16,00">Master Rigger $16,00</option>
                	<option value="Trainee $12,00">Master Rigger $12,00</option>
                </select>
            </div>
    	  	<?php } ?>
    		<hr/>
    		<div class="form-group">
                <label for="make" class="control-label"><strong>Rush Fee(front of line)</strong></label>
                <input type="text" class="form-control" id="S-RUSH1" name="S-RUSH1" placeholder="Rush Fee(front of line)" value="Sales Price $60,00" />
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Rush Fee(right now)</strong></label>
                <input type="text" class="form-control" id="S-RUSH2" name="S-RUSH2" placeholder="Rush Fee(right now)" value="Sales Price $100,00" />
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Hourly shop rate</strong></label>
                <select class="form-control"  id="S-SHOPRATE" name="S-SHOPRATE" >
                	<option value="Sales Price $90,00">Sales Price $90,00</option>
                	<option value="Master Rigger $49,50">Master Rigger $49,50</option>
                	<option value="Senior Rigger $44,00">Master Rigger $44,00</option>
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Monthly storage fee</strong></label>
                <input type="text" class="form-control" id="S-STORAGE" name="S-STORAGE" placeholder="Monthly storage fee" value="Sales Price $25,00" />
            </div>

          </form>
    	</div>
    </div>

</div>