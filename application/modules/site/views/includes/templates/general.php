<!DOCTYPE html>
<html lang="en">
	<?php echo $this->load->view('includes/header', '', TRUE);?>
	
    <body>
			<?php echo $this->load->view('includes/navigation', '', TRUE);?>
            <?php echo $content; ?>
            <?php echo $this->load->view('includes/footer', '', TRUE);?>
	</body>
</html>