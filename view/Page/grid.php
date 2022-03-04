<?php $pages = $this->getPages(); ?>
<?php $urlAction = new Controller_Core_Action();?>

    <button name="Add"><a href="<?php echo $urlAction->getUrl('add','page',null,true) ?>">Add page</a></button>
    <table border='1' width='100%' cellspacing="4">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Code</th>
            <th>Content</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php if(!$pages): ?>
            <tr>
                <td colspan="17">No records found.</td>
            </tr>
            <?php else: ?>
                <?php foreach($pages as $page): ?>
                    <tr>
                        <td>
                            <?php echo $page->pageId; ?>
                        </td>
                        <td>
                            <?php echo $page->name; ?>
                        </td>
                        <td>
                            <?php echo $page->code; ?>
                        </td>
                        <td>
                            <?php echo $page->content; ?>
                        </td>
                        
                        <td>
                            <?php echo $page->getStatus($page->status); ?>
                        </td>

                        <td>
                            <?php echo $page->createdAt; ?>
                        </td>
                        <td>
                            <?php echo $page->updatedAt; ?>
                        </td>
                        <td><a href="<?php echo $urlAction->getUrl('edit','page',['id' =>  $page->pageId],true) ?>">Edit</a></td>
                        <td><a href="<?php echo $urlAction->getUrl('delete','page',['id' =>  $page->pageId],true) ?>">Delete</a></td>
                    </tr>
                    <?php endforeach; ?>
                        <?php endif; ?>
    </table>