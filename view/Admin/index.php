<form >
	<div id="indexContent"></div>
</form>

<script type="text/javascript">
	admin.setUrl("<?php echo $this->getUrl('grid1');?>");
	alert(admin.getUrl());
	admin.setForm(jQuery('#indexForm'));
	admin.load();
</script>
