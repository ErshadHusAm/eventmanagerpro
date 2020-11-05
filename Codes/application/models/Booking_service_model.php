<?php
/**
 * Description of App_user_model
 *
 * @author Ershadul
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_service_model extends CI_Model{

    private $_table;
    private $_primary_key;
    private $_fields;

    public function __construct(){
        $this->_table = "tbl_booking_service";
        $this->_primary_key = "booking_service_id";
        $this->_fields = [

        ];
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


    public function update($data){
		if (isset($data[$this->_primary_key]) && $data[$this->_primary_key] != "") {
            $this->db->where($this->_primary_key, $data[$this->_primary_key]);
            return $this->db->update($this->_table, $data);
        }else{
			return FALSE;
		}
	}
    public function check_exist($vendor_id,$event_id,$client_id,$vendor_service_id){
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where("$this->_table.vendor_id", $vendor_id);
        $this->db->where("$this->_table.event_id", $event_id);
        $this->db->where("$this->_table.client_id", $client_id);
        $this->db->where("$this->_table.vendor_service", $vendor_service_id);
        $result = $this->db->get();
        $result = $result->row();
        return $result;
    }


    public function check_budget($event_id){
        $this->db->select("SUM(service_amount) AS service_amount");
        $this->db->from($this->_table);
        $this->db->where("$this->_table.event_id", $event_id);
        $this->db->where_in("$this->_table.status", [0,1]);
        $this->db->group_by("$this->_table.event_id");
        $result = $this->db->get();
        $result = $result->row();
        // echo $this->db->last_query();
        return $result;
    }

    public function select_by_vendor_id($id){
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->join("tbl_event", "$this->_table.event_id = tbl_event.event_id");
        $this->db->join("tbl_vendor_service", "$this->_table.vendor_service = tbl_vendor_service.id");
        $this->db->join("tbl_client", "$this->_table.client_id = tbl_client.client_id");
        $this->db->where("$this->_table.vendor_id", $id);
        $this->db->order_by("tbl_event.event_date", "ASC");
        $result = $this->db->get();
        $result = $result->result();
        return $result;
    }

    public function select_payment_by_client_id($id){
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->join("tbl_event", "$this->_table.event_id = tbl_event.event_id");
        $this->db->join("tbl_vendor_service", "$this->_table.vendor_service = tbl_vendor_service.id");
        $this->db->where("$this->_table.client_id", $id);
        $this->db->where("$this->_table.status", 1);
        $result = $this->db->get();
        $result = $result->result();
        return $result;
    }


}
