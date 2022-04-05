<form id="indexForm" action="<?php echo $this->getUrl('gridBlock');?>" method="POST">
	<div><h3 id="adminMessage"></h3></div>
	<div id="indexContent"></div>
</form>
<script type="text/javascript">
	admin.setForm(jQuery('#indexForm'));
	admin.load();
</script>