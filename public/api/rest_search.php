<?php
require_once(dirname(__FILE__).'/../lib/check-setting.php');

$gourmet = new Gourmet();

$query = array( 'name' => $_GET['name'] );
$data = $gourmet->gnavi->doRestSearchApi($query);

echo json_encode($data);
