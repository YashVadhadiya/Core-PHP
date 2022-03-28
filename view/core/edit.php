<form action="<?php echo $this->getEditUrl() ?>" method="POST">
	<?php echo $this->getTab()->toHtml(); ?>
	<?php echo $this->getTabContent()->toHtml(); ?>
</form>