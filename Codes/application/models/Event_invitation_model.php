<?php
/**
 * Description of App_user_model
 *
 * @author Ershadul
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_invitation_model extends CI_Model{

    private $_table;
    private $_primary_key;
    private $_fields;

    public function __construct(){
        $this->_table = "tbl_event_invitation";
        $this->_primary_key = "event_invitation_id";
        $this->_fields = [

        ];
    }


    public function save($data){
        return $this->db->insert($this->_table, $data) ?  $this->db->insert_id() : FALSE;
    }

    /*
    $data = array();
    $data['status'] = 1;
    */

    public function update_by_event($data, $event_id){
      $this->db->where("event_id", $event_id);
      return $this->db->update($this->_table, $data);
    }

    public function count_by_email($email){
        $this->db->from($this->_table);
        $this->db->where("email_address", $email);
        return $this->db->count_all_results();
    }

    public function select_by_event_id($event_id){
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where("$this->_table.event_id", $event_id);
        $result = $this->db->get();
        $result = $result->result();
        return $result;
    }


}
