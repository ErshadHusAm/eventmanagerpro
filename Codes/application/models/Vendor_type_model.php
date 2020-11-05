<?php
/**
 * Description of Client_model
 *
 * @author Ershadul
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_type_model extends CI_Model{

    private $_table;
    private $_primary_key;
    private $_fields;

    public function __construct(){
        $this->_table = "tbl_vendor_type";
        $this->_primary_key = "vendor_type_id";
        $this->_fields = [];
    }

    public function select(){
        $fields = "$this->_table.*";
        $this->db->from($this->_table);
        $result = $this->db->get();
        return $result->result();
    }


}
