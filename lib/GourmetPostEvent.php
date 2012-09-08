<?php

class GourmetPostEvent extends Gourmet {

    public function initEvent() {
		add_action('media_buttons_context', array($this, 'addButtons'));
        add_action('media_upload_gourmet_media', array($this, 'mediaUploadGourmetMedia'));
        add_filter(self::MEDIA_BUTTON_TYPE.'_upload_iframe_src', array($this, 'getUploadIframeSrc'));
    }

    public function addButtons() {
		$context = __('Upload/Insert %s', self::TEXT_DOMAIN);
		$context .= $this->mediaButton(__('Add Restaurant', self::TEXT_DOMAIN), self::getPluginUrl('/images/icon-gourmet.png'), self::MEDIA_BUTTON_TYPE);
        return $context;
    }

	private function mediaButton($title, $icon, $type) {
	        return "<a href='" . esc_url( get_upload_iframe_src($type) ) . "' id='add_$type' class='thickbox' title='$title'><img src='" . esc_url( $icon ) . "' alt='$title' /></a>";
	}

	public function mediaUploadGourmetMedia() {
		require_once dirname(__FILE__) . '/media-upload.php';	
	}

	public static function getUploadIframeSrc($uploadIframeSrc) {
        return "$uploadIframeSrc&mode=search";
	}

}
