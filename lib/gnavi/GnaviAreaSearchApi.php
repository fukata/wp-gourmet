<?php
require_once __DIR__ . '/GnaviApi.php';

class GnaviAreaSearchApi extends GnaviApi {

    private static $COPY_FIELDS = array(
        'area_code',
        'area_name',
    );

    public function execute() {
        $content = $this->_doGet("/AreaSearchAPI/");
        $data = $this->_parse($content);
        return $data;
    }

    public function _parse($content) {
        $xml = simplexml_load_string($content);
        if ( ! isset( $xml->area ) ) {
            return $this->_parseErrorObject($xml);
        }

        $data = (object) array(
            'area' => array(),
        );

        foreach ( $xml->area as $r ) {
            $d = new stdClass;
            foreach ( self::$COPY_FIELDS as $f ) {
                $d->$f = $r->$f;
            }
            $data->area[] = $d;
        }
        
        return $data;
    }
}
