<h1>Groupal</h1>

<div id="content">
	<h2>Login</h2>
    (Temporary CAS Replacement)<br />
    <?php if($action == 'login') { echo validation_errors('<div class="red">', '</div>'); } ?>
    <?php echo form_open($this->uri->uri_string()); ?>
    <?php
	$data = array(
    	'action'  => 'login',
    );

	echo form_hidden($data);
	?>
    
    <?php
	$data = array(
		'name'        	=> 'netID',
	  	'id'          	=> 'netID',
	  	'value'       	=> set_value('netID'),
	  	'maxlength'		=> 255,
	);
	
	echo form_label('NetID:<span class="red">*</span> ', 'netID');
	echo form_input($data);
	?>
    <br />
    <?php
	$data = array(
		'name'        	=> 'password',
	  	'id'          	=> 'password',
	  	'value'       	=> set_value('password'),
	  	'maxlength'		=> 255,
	);
	
	echo form_label('Password (any string will work):<span class="red">*</span> ', 'netID');
	echo form_password($data);
	?>
    <br />
    <?php
	$data = array(
	  	'name'        => 'submit',
	  	'id'          => 'submit',
	  	'value'       => 'Submit',
	);
	
	echo form_submit($data);
	?>
    
    <?php echo form_close(); ?>
    
	<h2>Sign Up!</h2>
    We just need some of your info:<br />
    <?php if($action == 'register') { echo validation_errors('<div class="red">', '</div>'); } ?>
    <?php echo form_open($this->uri->uri_string()); ?>
    
    <?php
	$data = array(
    	'action'  => 'register',
    );

	echo form_hidden($data);
	?>
    
    <?php
	$data = array(
		'name'        	=> 'netID',
	  	'id'          	=> 'netID',
	  	'value'       	=> set_value('netID'),
	  	'maxlength'		=> 255,
	);
	
	echo form_label('NetID (demo purpose only):<span class="red">*</span> ', 'netID');
	echo form_input($data);
	?>
    <br />
    <?php
	$data = array(
	  	'name'        	=> 'name',
	  	'id'          	=> 'name',
	  	'value'       	=> set_value('name'),
	 	'maxlength'		=> 255,
	);
	
	echo form_label('Name:<span class="red">*</span> ', 'name');
	echo form_input($data);
	?>
    <br />
    <?php
	echo form_label('Phone:<span class="red">*</span> ', 'phone1');
	
	$data = array(
	  	'name'        	=> 'phone1',
	  	'id'          	=> 'phone1',
	 	'value'       	=> set_value('phone1'),
	 	'maxlength'		=> 3,
	);
	
	echo '(';
	echo form_input($data);
	echo ')';
	
	$data = array(
	 	'name'        	=> 'phone2',
	  	'id'          	=> 'phone2',
	  	'value'       	=> set_value('phone2'),
	  	'maxlength'		=> 3,
	);
	
	echo form_input($data);
	
	$data = array(
	  	'name'        	=> 'phone3',
	 	'id'          	=> 'phone3',
	  	'value'       	=> set_value('phone3'),
	  	'maxlength'		=> 4,
	);
	
	echo form_input($data);
	?>
    <br />
    <?php
	$data = array(
	  	'name'        => 'submit',
	  	'id'          => 'submit',
	  	'value'       => 'Submit',
	);
	
	echo form_submit($data);
	?>
	
	<?php echo form_close(); ?>
</div>