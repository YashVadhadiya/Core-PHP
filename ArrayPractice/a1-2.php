<?php
echo "<pre>";

$data = [
	'1'=>[
		'1' => [
			'1' => 1,
			'2' => 2		
		],
		'2' => [
			'3' => 3,
			'4' => 4		
		]
	],
	'2'=>[
		'3' => [
			'5' => 5,
			'6' => 6		
		],
		'4' => [
			'7' => 7,
			'8' => 8		
		]
	],
];

$final = [];

foreach ($data as $categoryId => $level1) {
	$row['category'] = $categoryId;

	foreach ($level1 as $attributeId => $level2) {
		$row['attribute'] = $attributeId;

		foreach ($level2 as $optionId => $level3) {
			$row['option'] = $optionId;

			array_push($final, $row);
		}
	}
}
print_r($final);

?>