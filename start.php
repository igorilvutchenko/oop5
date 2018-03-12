<?php  

ini_set('display_errors', '1');
error_reporting(E_ALL);



require_once "classes/Db.php";
require_once "classes/FeatureItem.php";

$feature_item = new FeatureItem();
/*$feature_item->image = 'image4.jpg';
$feature_item->header = 'Header4';
$feature_item->text = 'This is long text';*/
$feature_item->delete(2);


/*echo '<pre>';
var_dump($list);
echo '</pre>';
*/
/*$feature_item = new FeatureItem(1);

echo $feature_item->header;*/

/*echo '<pre>';
var_dump($feature_item);
echo '</pre>';*/