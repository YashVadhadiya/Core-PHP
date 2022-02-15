<?php	
echo '<pre>';

$data = [
	'category'=> [
		'1'=>[
			'Cname' => 'c1',
			'attribute'=>[
				'1' => [
					'Aname'=>'a1',
					'option' => [
						'1'=>[
							'Oname' => 'o1'
						],
						'2'=>[
							'Oname' => 'o2'
						]
					]
				],
				'2' => [
					'Aname'=>'a2',
					'option' => [
						'3'=>[
							'Oname' => 'o3'
						],
						'4'=>[
							'Oname' => 'o4'
						]
					]
				]
			]
		],
		'2'=>[
			'Cname' => 'c2',
			'attribute'=>[
				'3' => [
					'Aname'=>'a3',
					'option' => [
						'5'=>[
							'Oname' => 'o5'
						],
						'6'=>[
							'Oname' => 'o6'
						]
					]
				],
				'4' => [
					'Aname'=>'a4',
					'option' => [
						'7'=>[
							'Oname' => 'o7'
						],
						'8'=>[
							'Oname' => 'o8'
						]
					]
				]
			]
		]
	]
];

$final = [];

foreach ($data['category'] as $categoryId => $level1) {
	$row['category'] = $categoryId;
	$row['categoryname'] = $level1['Cname'];

	foreach ($level1['attribute'] as $attributeId => $level2) {
		$row['attribute'] = $attributeId;
		$row['attributename'] = $level2['Aname'];

		foreach ($level2['option'] as $optionId => $level3) {
			$row['option'] = $optionId;
			$row['optionname'] = $level3['Oname'];

			array_push($final, $row);
		}
	}
}
	/*
	foreach ($level1 as $Cname => $level2) {
	$row['Cname'] = $Cname;
	
		foreach ($level2 as $attributeId => $level3) {
		$row['attributeId'] = $attributeId;
	
			foreach ($level3 as $Aname => $level4) {
			$row['Aname'] = $Aname;
	
				foreach ($level4 as $optionId => $level5) {
				$row['optionId'] = $optionId;
	
					foreach ($level5 as $Oname => $level6) {
					$row['Oname'] = $Oname;						
		}
	}
}*/
print_r($final);


?>