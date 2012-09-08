<?php

$pluginPath = Gourmet::getPluginUrl();
wp_enqueue_script("media-upload_search", "$pluginPath/public/js/media-upload_search.js", array(), Gourmet::VERSION);


$GLOBALS['body_id'] = 'media-upload';
wp_iframe('media_upload_search_form');

function media_upload_search_form() {
?>
<div style="display:none">
    <input type="hidden" id="base_url" value="<?php echo admin_url('admin.php?action=wpgourmet_api') ?>" />
</div>

<p><input type="button" value="<?php echo __('Search', Gourmet::TEXT_DOMAIN) ?>" class="button" id="search-btn"/></p>

<?php
}
?>
