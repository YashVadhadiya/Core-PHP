<?php $tabs = $this->getTabs(); ?>
<?php foreach ($tabs as $key => $tab) { ?>
<a href="<?php echo $tab['url']; ?>" 
	<?php if($this->getCurrentTab() == $key): ?> style="color: red;" 
	<?php endif; ?>><?php echo $tab['title']; ?></a> <?php } ?>