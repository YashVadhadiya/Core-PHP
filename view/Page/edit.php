<?php $page = $this->getPage(); ?>


		<form method="POST" action="<?php echo $this->getUrl('save','page',null, false) ?>">
			<table border="1" width="100%" cellspacing="4">
				<!-- this is used for personal data -->
				<tr>
					<td colspan="4">
						<h1>Page Details</h1></td>
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
							<?php foreach ($page->getStatus() as $key => $value): ?>
              			<option <?php if($page->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
            				<?php endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type="submit" value="Save" name="edit">
						<button type="button"><a href="<?php echo $this->getUrl('grid','page',null,true) ?>">Cancel</a></button>
					</td>
				</tr>
			</table>
		</form>