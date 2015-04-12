<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

</div>
<div id="space" style="width: 100%; height: 5vh;">
</div>
<div id="footer" style="width: 100%; height: 5vh; text-align: center;">
&copy; 2015 Mohamed El-Dirany, DG Kim, Akash Levy | <a href="https://github.com/akashlevy/groupal">GitHub Repository</a><?php if($logged_in) { ?> | <a href="<?php echo base_url('/home/logout'); ?>">Logout</a><?php } ?><?php if($admin){ ?> | <a href="<?php echo base_url('/home/update/'); ?>">Update Database</a> <?php } ?>
</div>
</body>
</html>