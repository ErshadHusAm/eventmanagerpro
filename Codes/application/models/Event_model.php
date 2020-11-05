<?php
/**
 * Description of Client_model
 *
 * @author Ershadul Bari
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_model extends CI_Model{

    private $_table;
    private $_primary_key;
    private $_fields;

    public function __construct(){
        $this->_table = "tbl_event";
        $this->_primary_key = "event_id";
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
        return $this->db->delete($this->_table, array('event_id' => $id));
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
        $this->db->where("$this->_table.event_name", $name);
        $this->db->where("$this->_table.event_id<>", $id);
        $result = $this->db->get();
        $result = $result->row();
        return $result;
    }

    public function select_by_id($id){
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->join("tbl_event_category", "$this->_table.event_category=tbl_event_category.event_category_id");
        $this->db->join("tbl_event_type", "$this->_table.event_type=tbl_event_type.event_type_id");
        $this->db->join("tbl_client", "$this->_table.client_id = tbl_client.client_id");
        $this->db->join("tbl_staff_loc", "$this->_table.event_loc = tbl_staff_loc.staff_loc_id");
        $this->db->where("$this->_table.event_id", $id);
        $result = $this->db->get();
        $result = $result->row();
        return $result;
    }

    public function select_by_client_id($id){
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->join("tbl_event_category", "$this->_table.event_category=tbl_event_category.event_category_id");
        $this->db->join("tbl_event_type", "$this->_table.event_type=tbl_event_type.event_type_id");
        $this->db->where("$this->_table.client_id", $id);
        $this->db->where("$this->_table.status", 0);
        $result = $this->db->get();
        $result = $result->result();
        return $result;
    }

    public function select_by_client($id){
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->join("tbl_event_category", "$this->_table.event_category=tbl_event_category.event_category_id");
        $this->db->join("tbl_event_type", "$this->_table.event_type=tbl_event_type.event_type_id");
        $this->db->join("tbl_staff_loc", "$this->_table.event_loc=tbl_staff_loc.staff_loc_id");
        $this->db->where("$this->_table.client_id", $id);
        $result = $this->db->get();
        $result = $result->result();
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

    public function select_by_event_id($id){
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where("$this->_table.event_id", $id);
        $result = $this->db->get();
        $result = $result->row();
        return $result;
    }

    public function select_by_event_client_id($event_id,$client_id){
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where("$this->_table.event_id", $event_id);
        $this->db->where("$this->_table.client_id", $client_id);
        $result = $this->db->get();
        return $result->row();
    }

    public function count_by_event(){
        $this->db->from($this->_table);
        return $this->db->count_all_results();
    }

    public function get_event_category_count(){
        $fields = " COUNT(IF(event_category=1, 1, NULL)) AS coporate_count ";
        $fields .= ", COUNT(IF(event_category=2, 1, NULL)) AS private_count ";
        $fields .= ", COUNT(IF(event_category=3, 1, NULL)) AS social_count ";
        $this->db->select($fields);
        $this->db->from($this->_table);
        $result = $this->db->get();
        return $result->row();
    }

    public function get_event_type_count(){
        $fields = " COUNT(IF(event_type=1, 1, NULL)) AS weeding_count ";
        $fields .= ", COUNT(IF(event_type=2, 1, NULL)) AS haldi_count ";
        $fields .= ", COUNT(IF(event_type=3, 1, NULL)) AS reception_count ";
        $fields .= ", COUNT(IF(event_type=4, 1, NULL)) AS birthday_count ";
        $fields .= ", COUNT(IF(event_type=5, 1, NULL)) AS engagment_count ";
        $this->db->select($fields);
        $this->db->from($this->_table);
        $result = $this->db->get();
        return $result->row();
    }

    public function check_budget_by_client_id($client_id){
        $this->db->select("SUM(service_amount) AS service_amount, $this->_table.*,tbl_event_category.*,tbl_event_type.*,tbl_staff_loc.*");
        $this->db->from($this->_table);
        $this->db->join("tbl_booking_service", "$this->_table.event_id = tbl_booking_service.event_id");
        $this->db->join("tbl_event_category", "$this->_table.event_category=tbl_event_category.event_category_id");
        $this->db->join("tbl_event_type", "$this->_table.event_type=tbl_event_type.event_type_id");
        $this->db->join("tbl_staff_loc", "$this->_table.event_loc=tbl_staff_loc.staff_loc_id");
        $this->db->where("$this->_table.client_id", $client_id);
        $this->db->where_in("$this->_table.status", [0,1]);
        $this->db->group_by("$this->_table.event_id");
        $result = $this->db->get();
        $result = $result->result();
        return $result;
    }

}
