<h1>Groupal</h1>

<div id="search-bar">
	<div id="search-middle">
    	<div id="search">
			<?php echo form_open($this->uri->uri_string()); ?>
			<input type="hidden" name="course_id" id="course_id" value="" />
			<?php
			
			$data = array(
				'name'        	=> 'autocomplete',
				'id'          	=> 'autocomplete',
			);
			
			echo form_label('Find a course: ', 'autocomplete');
			echo form_input($data);
			
			$data = array(
				'name'        => 'submit',
				'id'          => 'submit',
				'value'       => 'Go',
			);
			
			echo form_submit($data);
			?>
			
			<?php echo form_close(); ?>
    	</div>
    </div>
</div>

<div id="content">
	<h2>My Groups</h2>
    Welcome, <?php echo $name; ?>!
    <?php
		if(empty($groups)) {
	?>
    <br />
    <h3>Join or start a group now!</h3>
    <?php			
		}
		else {
	?>
    <div id="main-accordion">
        <h3>First</h3>
        <div>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.</div>
        <h3>Second</h3>
        <div>Phasellus mattis tincidunt nibh.</div>
        <h3>Third</h3>
        <div>Nam dui erat, auctor a, dignissim quis.</div>
    </div>
    <?php
		}
	?>
</div>