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

foreach ($data as $category => $level1) {
	
	foreach ($level1 as $categoryId => $level2) {
	$row['categoryId'] = $categoryId;

	foreach ($level2 as $Cname => $level3) {
		If($Cname != 'attribute'){
			$row['Cname'] = $level3;
		}

		foreach ($level3 as $attribute => $level4) {
			$row['attribute'] = $attribute;

			foreach ($level4 as $Aname => $level5) {
				if ($Aname != 'option') {
					$row['Aname'] = $level5;
				}

				foreach ($level5  as $option => $level6) {
					$row['option'] = $option;
					
					foreach ($level6 as $Oname => $level7) {
						$row['Oname'] = $level7;

						array_push($final, $row);
					}
					}
				}
			}
		}
	}
}
print_r($final);


?>