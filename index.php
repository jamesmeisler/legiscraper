<?php

require 'vendor/autoload.php';

$app = new \Slim\Slim(array(
	'templates.path' => 'templates'
));

$app->config(array(
	'templates.path' => './',
));

//$file = '/Users/james/htdocs/freelance/scrape/marshbills.html';
//$handle = fopen($file, "r");
//$contents = fread($handle, filesize($file));
//fclose($handle);


//$pattern = '/SB\w{1,3}-(int|eng|enr)\.pdf/';

//preg_match_all($pattern, $contents, $matches);

//print_r($matches[0]);

$app->get('/', function() use ($app){
	$app->render('form.html');
});

$app->post('/scrape', function()use($app){
	$file = $_FILES['filename']['tmp_name'];

	$handle = fopen($file, "r");
	$contents = fread($handle, filesize($file));
	fclose($handle);


	$pattern = '/SB\w{1,3}-(int|eng|enr)\.pdf/';

	preg_match_all($pattern, $contents, $matches);

	$out = '<html><head></head><body><h2>List of PDF files linked:</h2><ul style="list-style-type: none;">';

	foreach($matches[0] as $match){
		 $out .="<li>" . $match . "</li>";
	}

	echo $out . "</ul></body></html>";
});


$app->run()
?>