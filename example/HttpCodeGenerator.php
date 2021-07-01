<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use LDL\Http\Core\Collection\HttpCodeKeyCollection;
use LDL\Http\Core\Collection\HttpCodeValueCollection;

/*
echo "Generate single response code\n\n";
var_dump(HttpCodeGenerator::generateArray("200"));

echo "\nGenerate code range from 200 to 205\n\n";
var_dump(HttpCodeGenerator::generateArray("200-205"));

echo "\nGenerate comma delimited codes, 200 and 300\n\n";
var_dump(HttpCodeGenerator::generateArray("200,300"));
*/

echo "\nCreate Http Code Key Collection\n\n";

$collection = new HttpCodeKeyCollection();

echo "Add code range, 200-205\n\n";
$collection->appendRange('200-205');

foreach($collection as $httpCode => $value){
    echo "$httpCode => $value\n";
}

echo "Add another range, except this time is 203-206\n\n";
$collection->appendRange('203-206');

foreach($collection as $httpCode => $value){
    echo "$httpCode => $value\n";
}

try {
    echo "Try to add an invalid http code (700), EXCEPTION must be thrown:\n";
    $collection->append(700);
}catch(\Exception $e){
    echo "EXCEPTION: {$e->getMessage()}\n";
}


echo "Create Http code value collection (keys are http codes)\n";

$collection = new HttpCodeValueCollection();
$collection->appendRange('test', '400-420');

foreach($collection as $httpCode => $value){
    echo "$httpCode => $value\n";
}
