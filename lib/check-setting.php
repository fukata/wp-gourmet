<?php
if (!is_admin()) {
	wp_die("Not in admin zone!");
}

$errors = array();

// check User ID
$apiKey = Gourmet::getApiKey();
if (empty($apiKey)) {
	$errors[] = __('API KEY is required. Please setting API KEY.', Gourmet::TEXT_DOMAIN);
}

if (!empty($errors) && count($errors)>0) {
	$buffer = "";
	foreach ($errors as $error) {
		$buffer .= "<p>{$error}</p>";
	}
	wp_die($buffer);
}
?>
