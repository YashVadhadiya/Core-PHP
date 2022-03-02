<?php $page = $this->getPage(); ?>
<?php $urlAction = new Controller_Core_Action();?>

		<form method="POST" action="<?php echo $urlAction->getUrl('save','page',['id' =>  $page->pageId],true) ?>">
			<table border="1" width="100%" cellspacing="4">
				<!-- this is used for personal data -->
				<tr>
					<td colspan="4">
						<h1>page details</h1></td>
				</tr>
				<tr>
					<td>Id</td>
					<td>
						<input type="text" name="page[pageId]" value="<?php echo $page->pageId; ?>" readonly>
					</td>
				</tr>
				<tr>
					<td>Name</td>
					<td>
						<input type="text" name="page[name]" value="<?php echo $page->name; ?>">
					</td>
				</tr>
				<tr>
					<td>Code</td>
					<td>
						<input type="text" name="page[code]" value="<?php echo $page->code; ?>">
					</td>
				</tr>
				<tr>
					<td>Content</td>
					<td>
						<input type="text" name="page[content]" value="<?php echo $page->content; ?>">
					</td>
				</tr>
				<tr>
					<td>Status</td>
					<td>
						<select name="page[status]">
							<?php if($page->status == 2): ?>
				              <option value='2'>Disabled</option>
				              <option value='1'>Enabled</option>
				          	<?php else: ?>
				              <option value='1'>Enabled</option>
				              <option value='2'>Disabled</option>
				          	<?php endif;?>
				          	
							<!-- <option value="1" <?php //if($page->status==1 ): ?> selected = "selected"
								<?php //endif; ?>>Active</option>
							<option value="2" <?php //if($page->status==2 ): ?> selected = "selected"
								<?php //endif; ?>>Inactive</option> -->
						</select>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type="submit" value="Save" name="edit">
						<button type="button"><a href="<?php echo $urlAction->getUrl('grid','page',null,true) ?>">Cancel</a></button>
					</td>
				</tr>
			</table>
		</form>