<?php
/**
 * Description of App_user_model
 *
 * @author Ershadul
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_to_do_model extends CI_Model{

    private $_table;
    private $_primary_key;
    private $_fields;

    public function __construct(){
        $this->_table = "tbl_event_todo_list";
        $this->_primary_key = "todo_list_id";
        $this->_fields = [

        ];
    }


    public function save($data){
        return $this->db->insert($this->_table, $data) ?  $this->db->insert_id() : FALSE;
    }

    public function delete_by_id($id){
        return $this->db->delete($this->_table, array('todo_list_id' => $id));
    }

    public function update($data){
		if (isset($data[$this->_primary_key]) && $data[$this->_primary_key] != "") {
            $this->db->where($this->_primary_key, $data[$this->_primary_key]);
            return $this->db->update($this->_table, $data);
        }else{
			return FALSE;
		}
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
