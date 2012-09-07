<?php
require_once __DIR__ . '/GnaviApi.php';

class GnaviRestSearchApi extends GnaviApi {

    private static $COPY_FIELDS = array(
        'id',
        'update_date',
        'name',
        'name_kana',
        'latitude',
        'longitude',
        'category',
        'url',
        'url_mobile',
        'address',
        'tel',
        'fax',
        'opentime',
        'holiday',
        'equipment',
        'budget',
    );

    public function execute($query=array()) {
        $content = $this->_doGet("/RestSearchAPI/", $query);
        $data = $this->_parse($content);
        return $data;
    }

    public function _parse($content) {
        $xml = simplexml_load_string($content);
        if ( ! isset( $xml->rest ) ) {
            return $this->_parseErrorObject($xml);
        }

        $data = (object) array(
            'total_hit_count' => (string)$xml->total_hit_count,
            'hit_per_page' => (string)$xml->hit_per_page,
            'page_offset' => (string)$xml->page_offset,
            'rest' => array(),
        );
        if ( ! isset( $xml->rest[0] ) ) {
            $xml->rest = array( $xml->rest );
        }

        foreach ( $xml->rest as $r ) {
            $rest = new stdClass;
            foreach ( self::$COPY_FIELDS as $k ) {
                $rest->$k = (string)$r->$k;
            }

            // image_url
            $rest->image_url = (object) array(
                'shop_image1' => (string)$r->image_url->shop_image1,
                'shop_image2' => (string)$r->image_url->shop_image2,
                'qrcode' => (string)$r->image_url->qrcode,
            );

            // access 
            $rest->access = (object) array(
                'line' => (string)$r->access->line,
                'station' => (string)$r->access->station,
                'station_exit' => (string)$r->access->station_exit,
                'walk' => (string)$r->access->walk,
                'note' => (string)$r->access->note,
            );

            // pr 
            $rest->pr = (object) array(
                'pr_short' => (string)$r->pr->pr_short,
                'pr_long' => (string)$r->pr->pr_long,
            );

            // code 
            $rest->code = (object) array(
                'areacode' => (string)$r->code->areacode,
                'areaname' => (string)$r->code->areaname,
                'prefcode' => (string)$r->code->prefcode,
                'prefname' => (string)$r->code->prefname,
            );

            // code -> category_code_l and category_code_s
            foreach ( array('l', 's') as $k ) {
                $key_code = "category_code_$k";
                $key_name = "category_name_$k";
                $key_categories = "category_$k";

                $codes = array();
                $names = array();
                foreach ( $r->code->$key_code as $n ) {
                    $codes[] = (string)$n;
                }
                foreach ( $r->code->$key_name as $n ) {
                    $names[] = (string)$n;
                }

                $rest->code->$key_categories = array();
                for ( $i=0; $i<count($codes); $i++ ) {
                    array_push(
                        $rest->code->$key_categories,
                        (object) array(
                            'code' => $codes[$i],
                            'name' => $names[$i],
                        )
                    );
                }
            }

            // flags
            $rest->flags = (object) array(
                'mobile_site' => (string)$r->flags->mobile_site,
                'mobile_coupon' => (string)$r->flags->mobile_coupon,
                'pc_coupon' => (string)$r->flags->pc_coupon,
            );

            $data->rest[] = $rest;
        }

        return $data;
    }
}
