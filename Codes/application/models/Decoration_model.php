<?php
/**
 * Description of Client_model
 *
 * @author Ershadul Bari
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Decoration_model extends CI_Model{

    private $_table;
    private $_primary_key;
    private $_fields;

    public function __construct(){
        $this->_table = "tbl_decoration";
        $this->_primary_key = "decoration_id";
        $this->_fields = [];
    }

    /**
    * Description: This function will receive a associative array
    *              where key is table field name and value
    *              is field value and pass CI insert function
    *              to save into table.
    *              This function will return last insert id if success,
    *              return false if failed to save
    * Params: $data = PHP associated array
    * Used By/ Dependency: N/A
    **/
    public function save($data){
        return $this->db->insert($this->_table, $data) ?  $this->db->insert_id() : FALSE;
    }


    /**
    * Description: This function will receive a associative array
    *              where key is table field name and value
    *              is field value and pass CI update function
    *              to update into table. It will automatically
    *              identify primary key from array
    * Params: $data = PHP associated array
    * Used By/ Dependency: N/A
    **/
    public function update($data){
		if (isset($data[$this->_primary_key]) && $data[$this->_primary_key] != "") {
            $this->db->where($this->_primary_key, $data[$this->_primary_key]);
            return $this->db->update($this->_table, $data);
        }else{
			return FALSE;
		}
	}


    /**
    * Description: This function will receive user_id as parameter
    *              and run a delete query. Finally, it will return
    *              true/false.
    * Params: N/A
    * Used By/ Dependency: N/A
    **/
    public function delete_by_id($id){
        return $this->db->delete($this->_table, array('decoration_id' => $id));
    }

    public function check_exist($name){
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where("$this->_table.decoration_name", $name);
        $result = $this->db->get();
        $result = $result->row();
        return $result;
    }

    public function check_upd_exist($name, $id)
    {
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where("$this->_table.decoration_name", $name);
        $this->db->where("$this->_table.decoration_id<>", $id);
        $result = $this->db->get();
        $result = $result->row();
        return $result;
    }

    public function select_by_id($id){
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where("$this->_table.decoration_id", $id);
        $result = $this->db->get();
        $result = $result->row();
        return $result;
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
