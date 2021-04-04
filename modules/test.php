<?php 
define('ROOT', __DIR__);
require_once(ROOT.'/vendor/autoload.php');
require_once (ROOT.'/db/rb-mysql.php');
R::setup('mysql:host=localhost; dbname=clients', 'root', '');

for ($i=0; $i < 20; $i++) { 
	
$buyers = R::dispense('buyers');

$faker = Faker\Factory::create();

$buyers->name = $faker->name();

$buyers->city = $faker->city();

$buyers->phoneNumber = $faker->phoneNumber();

$buyers->conpany = $faker->company();

$buyers->email = $faker->email();

R::store($buyers);
}



?>
