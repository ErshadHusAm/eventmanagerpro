<?php
/**
 * Description of Notification_model
 *
 * @author Ershadul
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model{

    private $_table;
    private $_primary_key;
    private $_fields;

    public function __construct(){
        $this->_table = "tbl_notification";
        $this->_primary_key = "notification_id";
        $this->_fields = [

        ];
    }

    public function save($data){
        return $this->db->insert($this->_table, $data) ?  $this->db->insert_id() : FALSE;
    }

    public function select_by_vendor_id($id){
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where("$this->_table.vendor_id", $id);
        $this->db->where("$this->_table.view", 1);
        $this->db->limit(6, 0);
        $result = $this->db->get();
        $result = $result->result();
        return $result;
    }

    public function select_by_client_id($id){
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where("$this->_table.client_id", $id);
        $this->db->where("$this->_table.view", 2);
        $this->db->limit(6, 0);
        $result = $this->db->get();
        $result = $result->result();
        return $result;
    }


}
