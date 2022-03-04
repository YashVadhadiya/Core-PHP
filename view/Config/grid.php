<?php $configs = $this->getConfigs(); ?>
<?php $urlAction = new Controller_Core_Action();?>

    <button name="Add"><a href="<?php echo $urlAction->getUrl('add','config',null,true) ?>">Add Config</a></button>
    <table border='1' width='100%' cellspacing="4">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Code</th>
            <th>Value</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php if(!$configs): ?>
            <tr>
                <td colspan="17">No records found.</td>
            </tr>
            <?php else: ?>
                <?php foreach($configs as $config): ?>
                    <tr>
                        <td>
                            <?php echo $config->configId; ?>
                        </td>
                        <td>
                            <?php echo $config->name; ?>
                        </td>
                        <td>
                            <?php echo $config->code; ?>
                        </td>
                        <td>
                            <?php echo $config->value; ?>
                        </td>
                        <td>
                            <?php echo $config->getStatus($config->status); ?>
                        </td>
                        <td>
                            <?php echo $config->createdAt; ?>
                        </td>
                        <td><a href="<?php echo$urlAction->getUrl('edit','config',['configId' =>  $config->configId],true) ?>">Edit</a></td>
                        <td><a href="<?php echo$urlAction->getUrl('delete','config',['configId' =>  $config->configId],true) ?>">Delete</a></td>
                    </tr>
                    <?php endforeach; ?>
                        <?php endif; ?>
    </table>