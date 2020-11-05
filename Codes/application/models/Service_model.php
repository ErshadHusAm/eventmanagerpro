<?php
/**
 * Description of Client_model
 *
 * @author Ershadul Bari
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_model extends CI_Model{

    private $_table;
    private $_primary_key;
    private $_fields;

    public function __construct(){
        $this->_table = "tbl_vendor_service";
        $this->_primary_key = "id";
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
        return $this->db->delete($this->_table, array('id' => $id));
    }

    public function check_exist($name){
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where("$this->_table.service_name", $name);
        $result = $this->db->get();
        $result = $result->row();
        return $result;
    }

    public function check_upd_exist($name, $id)
    {
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where("$this->_table.service_name", $name);
        $this->db->where("$this->_table.id<>", $id);
        $result = $this->db->get();
        $result = $result->row();
        return $result;
    }

    public function select_by_id($id){
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->join("tbl_event_category", "$this->_table.event_category=tbl_event_category.event_category_id");
        $this->db->where("$this->_table.vendor_id", $id);
        $result = $this->db->get();
        $result = $result->result();
        return $result;
    }

    public function select_by_id_vendor_id($service_id,$vendor_id){
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where("$this->_table.vendor_id", $vendor_id);
        $this->db->where("$this->_table.id", $service_id);
        $result = $this->db->get();
        $result = $result->row();
        return $result;
    }

    public function select()
    {
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->join("tbl_event_category", "$this->_table.event_category=tbl_event_category.event_category_id");
        $this->db->join("tbl_vendor", "$this->_table.vendor_id=tbl_vendor.vendor_id");
        $this->db->join("tbl_vendor_type", "tbl_vendor.vendor_type=tbl_vendor_type.vendor_type_id");
        $this->db->where("$this->_table.status", 0);
        $this->db->order_by("$this->_table.date", "DESC");
        $this->db->limit(6, 0);
        $result = $this->db->get();
        $result = $result->result();
        return $result;
    }

    public function search_service()
    {
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->join("tbl_event_category", "$this->_table.event_category=tbl_event_category.event_category_id");
        $this->db->join("tbl_vendor", "$this->_table.vendor_id=tbl_vendor.vendor_id");
        $this->db->join("tbl_vendor_type", "tbl_vendor.vendor_type=tbl_vendor_type.vendor_type_id");
        $this->db->where("$this->_table.status", 0);
        $this->db->order_by("$this->_table.date", "DESC");
        $result = $this->db->get();
        $result = $result->result();
        return $result;
    }

    public function search_service_by_data($search_term,$event_type,$service_price_start,$service_price_end)
    {
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->join("tbl_event_category", "$this->_table.event_category=tbl_event_category.event_category_id");
        $this->db->join("tbl_vendor", "$this->_table.vendor_id=tbl_vendor.vendor_id");
        $this->db->join("tbl_vendor_type", "tbl_vendor.vendor_type=tbl_vendor_type.vendor_type_id");
        if($search_term != ""){
          $this->db->group_start();
          $this->db->like("$this->_table.service_name", $search_term);
          $this->db->or_like("$this->_table.service_desc", $search_term);
          $this->db->or_like("$this->_table.service_price", $search_term);
          $this->db->or_like("tbl_event_category.event_category", $search_term);
          $this->db->or_like("tbl_vendor_type.vendor_name", $search_term);
          $this->db->group_end();
        }
        if($service_price_start != ""){
            $this->db->where("$this->_table.service_price > ", $service_price_start);
        }
        if($service_price_end != ""){
            $this->db->where("$this->_table.service_price < ", $service_price_end);
        }
        if($event_type != ""){
          $this->db->where("tbl_vendor_type.vendor_type_id", $event_type);
        }

        $this->db->where("$this->_table.status", 0);
        $this->db->order_by("$this->_table.date", "DESC");
        $result = $this->db->get();
        $result = $result->result();
        return $result;
    }

    public function count_by_service(){
        $this->db->from($this->_table);
        return $this->db->count_all_results();
    }


}
