<?php
require_once __DIR__ . '/GnaviApi.php';

class GnaviCategorySmallSearchApi extends GnaviApi {

    private static $COPY_FIELDS = array(
        'category_s_code',
        'category_s_name',
        'category_l_code',
    );

    public function execute() {
        $content = $this->_doGet("/CategorySmallSearchAPI/");
        $data = $this->_parse($content);
        return $data;
    }

    public function _parse($content) {
        $xml = simplexml_load_string($content);
        if ( ! isset( $xml->category_s ) ) {
            return $this->_parseErrorObject($xml);
        }

        $data = (object) array(
            'category_s' => array(),
        );

        foreach ( $xml->category_s as $r ) {
            $d = new stdClass;
            foreach ( self::$COPY_FIELDS as $f ) {
                $d->$f = $r->$f;
            }
            $data->category_s[] = $d;
        }
        
        return $data;
    }
}
