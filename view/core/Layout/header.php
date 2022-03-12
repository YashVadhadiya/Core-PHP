<?php $menuAction = new Controller_Core_Action() ?>

<?php
$header = $menuAction->getLayout()->getHeader();
$menuGrid = Ccc::getBlock('Core_Layout_Header_Menu');
$message = Ccc::getBlock("Core_Message");
$header->addChild($menuGrid);
$header->addChild($message);
?>
<?php foreach ($header->getChildren() as $key => $child): ?>
<?php echo $child->toHtml(); ?>
<?php endforeach; ?>