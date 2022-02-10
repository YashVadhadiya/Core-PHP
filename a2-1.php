<?php
echo '<pre>';

 $data = [

 	['category'=>1,'categoryname'=>'c1','attribute'=>1,'attributename'=>'a1','option'=>1,'optionname'=>'o1'],
 	['category'=>1,'categoryname'=>'c1','attribute'=>1,'attributename'=>'a1','option'=>2,'optionname'=>'o2'],
 	['category'=>1,'categoryname'=>'c1','attribute'=>2,'attributename'=>'a2','option'=>3,'optionname'=>'o3'],
 	['category'=>1,'categoryname'=>'c1','attribute'=>2,'attributename'=>'a2','option'=>4,'optionname'=>'o4'],
 	['category'=>2,'categoryname'=>'c2','attribute'=>3,'attributename'=>'a3','option'=>5,'optionname'=>'o5'],
 	['category'=>2,'categoryname'=>'c2','attribute'=>3,'attributename'=>'a3','option'=>6,'optionname'=>'o6'],
 	['category'=>2,'categoryname'=>'c2','attribute'=>4,'attributename'=>'a4','option'=>7,'optionname'=>'o7'],
 	['category'=>2,'categoryname'=>'c2','attribute'=>4,'attributename'=>'a4','option'=>8,'optionname'=>'o8']

 ];
$final = [];
foreach ($data as $row) {

	if(!array_key_exists('category', $final)){
		$final['category'] = [];
	}
	if(!array_key_exists($row['category'], $final['category'])){
		$final['category'][$row['category']] = [];
	}
	if(!array_key_exists('categoryname', $final['category'][$row['category']])){
		$final['category'][$row['category']]['categoryname'] = $row['categoryname'];
	}
	if(!array_key_exists('attribute', $final['category'][$row['category']])){
		$final['category'][$row['category']]['attribute'] = [];
	}
	if(!array_key_exists($row['attribute'], $final['category'][$row['category']]['attribute'])){
		$final['category'][$row['category']]['attribute'][$row['attribute']] = [];
	}
	if(!array_key_exists('attributename', $final['category'][$row['category']]['attribute'][$row['attribute']])){
		$final['category'][$row['category']]['attribute'][$row['attribute']]['attributename'] = $row['attributename']; 
	}
	if(!array_key_exists('option', $final['category'][$row['category']]['attribute'][$row['attribute']])){
		$final['category'][$row['category']]['attribute'][$row['attribute']]['option'] = [];
	}
	if(!array_key_exists($row['option'], $final['category'][$row['category']]['attribute'][$row['attribute']]['option'])){
		$final['category'][$row['category']]['attribute'][$row['attribute']]['option'][$row['option']] = [];
	}
	if(!array_key_exists('optionname', $final['category'][$row['category']]['attribute'][$row['attribute']]['option'])){
		$final['category'][$row['category']]['attribute'][$row['attribute']]['option'][$row['option']]['optionname'] = $row['optionname'];
	}
}
print_r($final);
?>