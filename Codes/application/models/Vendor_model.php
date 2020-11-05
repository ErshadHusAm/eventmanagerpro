<?php
/**
 * Description of Client_model
 *
 * @author Ershadul Bari
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_model extends CI_Model{

    private $_table;
    private $_primary_key;
    private $_fields;

    public function __construct(){
        $this->_table = "tbl_vendor";
        $this->_primary_key = "vendor_id";
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
    public function delete_by_id($user_id){
        return $this->db->delete($this->_table, array('user_id' => $user_id));
    }

    public function select()
    {
        $this->db->select("$this->_table.*,tbl_app_users.*,tbl_vendor_type.*");
        $this->db->from($this->_table);
        $this->db->join("tbl_app_users", "$this->_table.user_id=tbl_app_users.user_id");
        $this->db->join("tbl_vendor_type", "$this->_table.vendor_type=tbl_vendor_type.vendor_type_id");
        $this->db->where("tbl_app_users.user_type", 2);
        $result = $this->db->get();
        $result = $result->result();
        return $result;
    }

    public function select_by_id($id)
    {
        $this->db->select("$this->_table.*");
        $this->db->from($this->_table);
        $this->db->where("$this->_table.vendor_id", $id);
        $result = $this->db->get();
        $result = $result->result();
        return $result;
    }

    public function select_by_user_id($id){
        $this->db->select("tbl_app_users.email, $this->_table.*, tbl_vendor_type.*");
        $this->db->from($this->_table);
        $this->db->join("tbl_app_users", "tbl_app_users.user_id=$this->_table.user_id");
        $this->db->join("tbl_vendor_type", "$this->_table.vendor_type=tbl_vendor_type.vendor_type_id");
        $this->db->where("$this->_table.user_id", $id);
        $result = $this->db->get();
        return $result->row();
    }

    public function count_by_vendor(){
        $this->db->from($this->_table);
        return $this->db->count_all_results();
    }


}
