<div class="content-wrapper">
<?php $tabs = $this->getTabs(); ?>
<?php foreach($tabs as $key => $tab): ?>
    <button type="button" class="tabOpen btn btn-primary" value="<?php echo $tab['url'] ?>" <?php echo ($this->getCurrentTab() == $key) ? 'style ="color:white";' : 'style ="color:black";' ; ?>><?php echo $tab['title'];?></button>
<?php endforeach;?>
</div>

<script>
    jQuery(".tabOpen").click(function(){
        admin.setUrl($(this).val());
//        alert(admin.getUrl());
        admin.load();
    });

</script>