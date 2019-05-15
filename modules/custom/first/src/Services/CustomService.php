<?php

namespace Drupal\first\Services;

/**
 * Class CustomService.
 */
class CustomService {

    public $table_name;
    /**
     * Constructs a new CustomService object.
     */
    public function __construct() {
//        $this->table_name = $table_name;
    }

    public function getServiceData() {
        //Do something here to get any data.
    }
    /**
     * Here you can pass your values as $array.
     */
    public function postServiceData($array) {
        //Do something here to post any data.
    }

    public function insertIntoDB()
    {

    }
}