<?php $menuAction = new Controller_Core_Action() ?>
<?php

$header = $menuAction->getLayout()->getHeader();
$menuGrid = Ccc::getBlock('Core_Layout_Header_Menu');
$header->addChild($menuGrid);
?>

<?php foreach ($header->getChildren() as $key => $child): ?>
<?php $child->toHtml(); ?>
<?php endforeach; ?>

