<?php
/**
 * Description of Staff model
 *
 * @author Ershadul
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff_model extends CI_Model{

    private $_table;
    private $_primary_key;
    private $_fields;

    public function __construct(){
        $this->_table = "tbl_staff";
        $this->_primary_key = "staff_id";
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
    public function delete_by_id($staff_id){
        return $this->db->delete($this->_table, array('staff_id' => $staff_id));
    }

    public function count_by_email($staff_email){
        $this->db->from($this->_table);
        $this->db->where("staff_email", $staff_email);
        return $this->db->count_all_results();
    }

    public function count_by_staff(){
        $this->db->from($this->_table);
        return $this->db->count_all_results();
    }

    public function select()
    {
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->join("tbl_staff_loc", "$this->_table.staff_loc=tbl_staff_loc.staff_loc_id");
        $result = $this->db->get();
        $result = $result->result();
        return $result;
    }

    public function search_staff_by_data($search_term,$staff_loc,$gender,$staff_type)
    {
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->join("tbl_staff_loc", "$this->_table.staff_loc=tbl_staff_loc.staff_loc_id");
        if($search_term != ""){
          $this->db->group_start();
          $this->db->like("$this->_table.full_name", $search_term);
          $this->db->or_like("$this->_table.staff_email", $search_term);
          $this->db->or_like("$this->_table.phn_num", $search_term);
          $this->db->or_like("$this->_table.expected_salary", $search_term);
          $this->db->or_like("$this->_table.experience", $search_term);
          $this->db->group_end();
        }
        if($staff_type != ""){
          $this->db->where("$this->_table.staff_type", $staff_type);
        }
        if($gender != ""){
          $this->db->where("$this->_table.gender", $gender);
        }
        if($staff_loc != ""){
          $this->db->where("tbl_staff_loc.staff_loc_id", $staff_loc);
        }
        $result = $this->db->get();
        $result = $result->result();
        return $result;
    }

}
