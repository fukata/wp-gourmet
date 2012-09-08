<?php

$pluginPath = Gourmet::getPluginUrl();
wp_enqueue_script("media-upload_search", "$pluginPath/public/js/media-upload_search.js", array(), Gourmet::VERSION);


$GLOBALS['body_id'] = 'media-upload';
wp_iframe('media_upload_search_form');

function media_upload_search_form() {
?>

<p><input type="button" value="<?php echo __('Search', Gourmet::TEXT_DOMAIN) ?>" class="button" id="search-btn"/></p>

<?php
}
?>
