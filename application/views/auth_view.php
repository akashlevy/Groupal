<h1>Groupal</h1>

<div id="content">
	<h2>Login</h2>
    (Temporary CAS Replacement)<br /><br />
    <?php if($action == 'login') { echo validation_errors('<div class="red">', '</div>'); } ?>
    <?php echo form_open($this->uri->uri_string()); ?>
    <?php
	$data = array(
    	'action'  => 'login',
    );

	echo form_hidden($data);
	?>
    
    <table class="auth-form">
    <tr>
    <?php
	$data = array(
		'name'        	=> 'netID',
	  	'id'          	=> 'netID',
	  	'value'       	=> set_value('netID'),
	  	'maxlength'		=> 255,
	);
	
	echo form_label('<td style="text-align: right; padding-right: 10px;">NetID:<span class="red">*</span></td>', 'netID');
	echo '<td>';
	echo form_input($data);
	echo '</td>';
	?>
    </tr>
    <tr>
    <?php
	$data = array(
		'name'        	=> 'password',
	  	'id'          	=> 'password',
	  	'value'       	=> set_value('password'),
	  	'maxlength'		=> 255,
	);
	
	echo form_label('<td style="text-align: right; padding-right: 10px;">Password (any string will work):<span class="red">*</span></td>', 'netID');
	echo '<td>';
	echo form_password($data);
	echo '</td>';
	?>
    </tr>
    <tr>
    <td></td>
    <td>
    <?php
	$data = array(
	  	'name'        => 'submit',
	  	'id'          => 'submit',
	  	'value'       => 'Submit',
	);
	
	echo form_submit($data);
	?>
    </td>
    </tr>
    </table>
    
    <?php echo form_close(); ?>
    
	<h2>Sign Up!</h2>
    We just need some of your info:<br /><br />
    <?php if($action == 'register') { echo validation_errors('<div class="red">', '</div>'); } ?>
    <?php echo form_open($this->uri->uri_string()); ?>
    
    <?php
	$data = array(
    	'action'  => 'register',
    );

	echo form_hidden($data);
	?>
    <table class="auth-form">
    <tr>
    <?php
	$data = array(
		'name'        	=> 'netID',
	  	'id'          	=> 'netID',
	  	'value'       	=> set_value('netID'),
	  	'maxlength'		=> 255,
	);
	
	echo form_label('<td style="text-align: right; padding-right: 10px;">NetID (demo purpose only):<span class="red">*</span></td>', 'netID');
	echo '<td>';
	echo form_input($data);
	echo '</td>';
	?>
    </tr>
    <tr>
    <?php
	$data = array(
	  	'name'        	=> 'name',
	  	'id'          	=> 'name',
	  	'value'       	=> set_value('name'),
	 	'maxlength'		=> 255,
	);
	
	echo form_label('<td style="text-align: right; padding-right: 10px;">Name:<span class="red">*</span></td>', 'name');
	echo '<td>';
	echo form_input($data);
	echo '</td>';
	?>
    </tr>
    <tr>
    <?php
	echo form_label('<td style="text-align: right; padding-right: 10px;">Phone:<span class="red">*</span></td>', 'phone1');
	
	echo '<td>';
	
	$data = array(
	  	'name'        	=> 'phone1',
	  	'id'          	=> 'phone1',
	 	'value'       	=> set_value('phone1'),
	 	'maxlength'		=> 3,
		'style'			=> 'width: 30px',
	);
	
	echo '( ';
	echo form_input($data);
	echo ' ) ';
	
	$data = array(
	 	'name'        	=> 'phone2',
	  	'id'          	=> 'phone2',
	  	'value'       	=> set_value('phone2'),
	  	'maxlength'		=> 3,
		'style'			=> 'width: 30px',
	);
	
	echo form_input($data);
	
	echo ' - ';
	
	$data = array(
	  	'name'        	=> 'phone3',
	 	'id'          	=> 'phone3',
	  	'value'       	=> set_value('phone3'),
	  	'maxlength'		=> 4,
		'style'			=> 'width: 40px',
	);
	
	echo form_input($data);
	
	echo '</td>';
	?>
    </tr>
    <tr>
    <td></td>
    <td>
    <?php
	$data = array(
	  	'name'        => 'submit',
	  	'id'          => 'submit',
	  	'value'       => 'Submit',
	);
	
	echo form_submit($data);
	?>
    </td>
    </tr>
    </table>
	
	<?php echo form_close(); ?>
</div>