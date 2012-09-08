<?php

class Gourmet {
    // constants
    const VERSION = '0.0.1';
    const NAME = 'Gourmet';
    const PREFIX = 'wpgourmet_';
    const TEXT_DOMAIN = 'wp-gourmet';
	const MEDIA_BUTTON_TYPE = 'gourmet_media';

    public $gnavi;

    public function __construct() {
        $this->loadLanguages();
        $this->gnavi = new Gnavi(self::getApiKey());
    }

    private function loadLanguages() {
        load_plugin_textdomain(self::TEXT_DOMAIN, false, 'wp-gourmet/languages');
    }

    public function initEvent() {
        // load action and filter
        require_once(self::getDir() . 'lib/GourmetPostEvent.php');
        $postEvent = new GourmetPostEvent();
        $postEvent->initEvent();

        require_once(self::getDir() . 'lib/GourmetAdminSettingEvent.php');
        $adminSettingEvent = new GourmetAdminSettingEvent();
        $adminSettingEvent->initEvent();
    }

    public static function getApiKey() {
        return get_option(self::getKey('api_key'));
    }

    public static function getKey($key) {
        return self::PREFIX . $key;
    }

    public static function getDir() {
        global $wp_gourmet_dir;
        return $wp_gourmet_dir;
    }

	public static function getPluginUrl($uri) {
		return plugins_url($uri, 'wp-gourmet/wp-gourmet.php');
	}

}
