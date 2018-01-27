<?php

class Model {
    function __construct() {
        $this->db = new Database();
        $this->db->query("SET NAMES 'utf8';");
    }
}