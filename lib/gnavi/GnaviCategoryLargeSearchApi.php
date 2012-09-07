<?php
require_once __DIR__ . '/GnaviApi.php';

class GnaviCategoryLargeSearchApi extends GnaviApi {

    private static $COPY_FIELDS = array(
        'category_l_code',
        'category_l_name',
    );

    public function execute() {
        $content = $this->_doGet("/CategoryLargeSearchAPI/");
        $data = $this->_parse($content);
        return $data;
    }

    public function _parse($content) {
        $xml = simplexml_load_string($content);
        if ( ! isset( $xml->category_l ) ) {
            return $this->_parseErrorObject($xml);
        }

        $data = (object) array(
            'category_l' => array(),
        );

        foreach ( $xml->category_l as $r ) {
            $d = new stdClass;
            foreach ( self::$COPY_FIELDS as $f ) {
                $d->$f = $r->$f;
            }
            $data->category_l[] = $d;
        }
        
        return $data;
    }
}
