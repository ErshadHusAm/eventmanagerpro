<?php
/**
 * Description of Client_model
 *
 * @author Ershadul Bari
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_Type_model extends CI_Model{

    private $_table;
    private $_primary_key;
    private $_fields;

    public function __construct(){
        $this->_table = "tbl_event_type";
        $this->_primary_key = "event_type_id";
        $this->_fields = [];
    }

    public function select()
    {
        $this->db->select("$this->_table.*");
        $this->db->from($this->_table);
        $result = $this->db->get();
        $result = $result->result();
        return $result;
    }


}
