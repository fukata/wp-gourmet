<?php

class GourmetPostEvent extends Gourmet {

    public function initEvent() {
		add_action('media_buttons_context', array($this, 'addButtons'));
    }

    public function addButtons() {
		$context = __('Upload/Insert %s', self::TEXT_DOMAIN);
		$context .= $this->mediaButton(__('Add Restaurant', self::TEXT_DOMAIN), self::getPluginUrl('/images/icon-gourmet.png'), self::MEDIA_BUTTON_TYPE);
        return $context;
    }

	private function mediaButton($title, $icon, $type) {
	        return "<a href='" . esc_url( get_upload_iframe_src($type) ) . "' id='add_$type' class='thickbox' title='$title'><img src='" . esc_url( $icon ) . "' alt='$title' /></a>";
	}

}
