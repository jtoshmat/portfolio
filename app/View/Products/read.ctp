
<?php
// echo "{";
// foreach ($products as $product): 
// 	echo "'id' : ".strtolower(h($product['Product']['id'])).", ";
// 	echo "'short_name' : ".strtolower(h($product['Product']['short_name'])).", ";
// 	echo "'long_name' : ".h($product['Product']['long_name']);
// 	echo "'description' : ".strtolower(h($product['Product']['description'])).", ";
// 	echo "'brouchure_link' : ".strtolower(h($product['Product']['brochure_link']));
	

// 	endforeach; 
// echo "}";
echo json_encode($products);
?>
