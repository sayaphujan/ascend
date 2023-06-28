<?
$rq = mysqli_query($link, 'SELECT repacks.*, containers.manufacturer, containers.model, containers.serial, users.first_name, users.last_name FROM `repacks` LEFT JOIN containers ON repacks.container = containers.id LEFT JOIN users ON repacks.customer = users.id ORDER BY repacks.speed, repacks.estimated_pickup');

$r = mysqli_fetch_assoc($rq);
	
if($_GET['load']==1) {
	
	echo 'console.log(\'Loading repack #'.$_GET['id'].'\');';
	echo '$(\'#repack_title\').html(\'Repack #'.$_GET['id'].' - Due '.$r['estimated_pickup'].'\');';
	echo '$(\'#repack_content\').load(\'/inc/exec.php?act=repack_content&id='.$_GET['id'].'\');';

	exit();
}

?>

Repack View / edit content

<pre>
check in - 

Show repack and container info in popover - allow user to edit any relevant info. second popover for edit container

show Check in Button. 

mark as Checked In. Refresh page


Begin Repack

Show repack and container info in popover - allow user to edit any relevant info. second popover for edit container

show Begin Repack.

mark as In Progress. Refresh page


Complete Repack

Show repack and container info in popover - allow user to edit any relevant info. second popover for edit container

show Complete Repack.

mark as Completed, send customer email. Refresh page



Completed

Show repack and container info in popover - allow user to edit any relevant info. second popover for edit container

</pre>