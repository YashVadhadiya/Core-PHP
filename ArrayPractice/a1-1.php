<?php

echo "<pre>";
$data = [

	['category'=>1,'attribute'=>1,'option'=>1],
	['category'=>1,'attribute'=>1,'option'=>2],
	['category'=>1,'attribute'=>2,'option'=>3],
	['category'=>1,'attribute'=>2,'option'=>4],
	['category'=>2,'attribute'=>3,'option'=>5],
	['category'=>2,'attribute'=>3,'option'=>6],
	['category'=>2,'attribute'=>4,'option'=>7],
	['category'=>2,'attribute'=>4,'option'=>8]
];

$final = [];
foreach ($data as $row) {
	$categoryId = $row['category'];
	$attributeId = $row['attribute'];
	$optionId = $row['option'];

	if(!array_key_exists($categoryId, $final)){
		$final[$categoryId] = [];
	}
	if(!array_key_exists($attributeId, $final[$categoryId])){
		$final[$categoryId][$attributeId] = [];
	}

	$final[$categoryId][$attributeId][$optionId] = $optionId;
}
print_r($final);

?>