<?php
require_once __DIR__ . '/GnaviApi.php';

class GnaviPrefSearchApi extends GnaviApi {

    private static $COPY_FIELDS = array(
        'pref_code',
        'pref_name',
        'area_code',
    );

    public function execute($query=array()) {
        $content = $this->_doGet("/PrefSearchAPI/", $query);
        $data = $this->_parse($content);
        return $data;
    }

    public function _parse($content) {
        $xml = simplexml_load_string($content);
        if ( ! isset( $xml->pref ) ) {
            return $this->_parseErrorObject($xml);
        }

        $data = (object) array(
            'pref' => array(),
        );

        foreach ( $xml->pref as $r ) {
            $d = new stdClass;
            foreach ( self::$COPY_FIELDS as $f ) {
                $d->$f = $r->$f;
            }
            $data->pref[] = $d;
        }
        
        return $data;
    }
}
