<html>
<?php echo $this->getHead()->toHtml(); ?>
<body>
	<table id="example2" class="table table-bordered table-hover">
		
		<tr><td><?php echo $this->getHeader()->toHtml(); ?></td></tr>
		<tr><td><?php echo $this->getContent()->toHtml(); ?></td></tr>
		<tr><td><?php echo $this->getFooter()->toHtml(); ?></td></tr>

	</table>

</body>
</html>