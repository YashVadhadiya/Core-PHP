<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<table border="1" width="100%">
		
		<tr><td><?php $this->getHeader()->toHtml(); ?></td></tr>
		<tr><td><?php $this->getFooter()->toHtml(); ?></td></tr>
		<tr><td><?php $this->getContent()->toHtml(); ?></td></tr>

	</table>

</body>
</html>