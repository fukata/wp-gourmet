<?php

class GourmetApiEvent extends Gourmet {

    public static $APIS = array('rest_search');

    public function initEvent() {
        add_action('admin_action_wpgourmet_api', array($this, 'actionApi'));
    }

    public function actionApi() {
        $api = $_GET['api'];
        if ( !in_array($api, self::$APIS) ) {
            wp_die("Not support api.");
        } else {
            require_once dirname(__FILE__) . "/../public/api/$api.php";
        }
    }
}
