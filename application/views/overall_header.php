<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <script src="<?php echo base_url("/js/external/jquery/jquery.js"); ?>"></script>
	<script src="<?php echo base_url("/js/jquery-ui.js"); ?>"></script>
    <script>
		$(document).ready(function(){
			$( "#main-accordion" ).accordion({heightStyle: 'panel', collapsible: true});
			
			var availableTags = [
				<?php echo $tags; ?>
			];
			
			$( "#autocomplete" ).autocomplete({
				source: availableTags,
				select: function( event, ui ) {
					event.preventDefault();
					$("#autocomplete").val(ui.item.label);
					$("#course_id").val(ui.item.value);
					PK.render(ui.item.value);
				}
			});
		});
	</script>
    
    <script src="//use.typekit.net/kku0iyj.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>
	<title><?php echo $title; ?></title>
    <link href="<?php echo base_url("/js/jquery-ui.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("/css/stylesheet.css"); ?>" rel="stylesheet" type="text/css">
</head>
<body>

<div id="wrapper">
