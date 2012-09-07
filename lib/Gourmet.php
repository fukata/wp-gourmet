<?php

class Gourmet {
    // constants
    const VERSION = '0.0.1';
    const NAME = 'Gourmet';
    const PREFIX = 'wpgourmet_';
    const TEXT_DOMAIN = 'wp-gourmet';

    public $gnavi;

    public function __construct() {
        $this->loadLanguages();
        $this->gnavi = new Gnavi($this->getApiKey());
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

    public function getApiKey() {
        return get_option($this->getKey('api_key'));
    }

    public function getKey($key) {
        return self::PREFIX . $key;
    }

    public static function getDir() {
        global $wp_gourmet_dir;
        return $wp_gourmet_dir;
    }
}
