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
			
			echo form_label('Add a course: ', 'autocomplete');
			echo form_input($data);
			
			$data = array(
				'name'        	=> 'submit',
				'id'          	=> 'submit',
				'value'       	=> 'Go',
				'style'			=> 'color: black;',
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
		if(empty($courses)) {
	?>
    <br />
    <h3>Join or start a group now!</h3>
    <?php			
		}
		else {
	?>
    <div id="main-accordion">
    	<?php
			foreach($courses as $course) {
		?>
        <h3><?php echo $course['data']->subject_code . ' ' . $course['data']->catalog_number;?></h3>
        <div><p><a href=""><img src="<?php echo base_url('/images/remove20.png'); ?>" />Remove this course</a><br />Term: <?php echo $course['data']->term; ?><br />Instructor(s): <?php echo $course['data']->instructors; ?></p>
        
        <p>
        <h4>Groups</h4>
        	<a href="<?php echo base_url('/home/create/' . $course['data']->id . '/' . $course['data']->term_id); ?>"><img src="<?php echo base_url('/images/add20.png'); ?>" />Create new group</a>
            <?php
				if(count($course['groups']) == 0) {
			?>
            No groups yet!
            <?php		
				}
				else {
			?>
            <table class="groups-table">
            	<thead>
                	<tr>
                        <th style="width: 10%;"></th>
                    	<th>Group Members</th>
                    </tr>
                </thead>
                <tbody>
                	<?php
						$i = 1;
						foreach($course['groups'] as $group) {
					?>
                	<tr>
                    	<?php
						if(in_array($user_id, $group['member_array'])) {
						?>
                        <td style="text-align: center;"><a href="<?php echo base_url('/home/join/' . $group['id'] . '/' . $course['data']->id); ?>"><img src="<?php echo base_url('/images/remove20.png'); ?>" /></a></td>
                        <?php
						}
						else {
						?>
                        <td style="text-align: center;"><a href="<?php echo base_url('/home/join/' . $group['id'] . '/' . $course['data']->id); ?>"><img src="<?php echo base_url('/images/add20.png'); ?>" /></a></td>
                        <?php
						}
						?>
                    	<td>Group <?php echo $i; ?>: <?php echo $group['member_string']; ?></td>
                    </tr>
                    <?php
							$i++;
						}
					?>
                </tbody>
            </table>
            <?php
				}
			?>
        </p>
        </div>
        <?php
			}
		?>
    </div>
    <?php
		}
	?>
</div>