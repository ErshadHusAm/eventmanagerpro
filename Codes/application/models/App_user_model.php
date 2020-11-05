<?php
/**
 * Description of App_user_model
 *
 * @author Ershadul
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class App_user_model extends CI_Model{

    private $_table;
    private $_primary_key;
    private $_fields;

    public function __construct(){
        $this->_table = "tbl_app_users";
        $this->_primary_key = "user_id";
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



    //In this section some other functions based on requirements
    public function select_status_by_email($email){
        $fields = "*";
        $this->db->select($fields);
        $this->db->from($this->_table);
        $this->db->where("$this->_table.email", $email);
        $result = $this->db->get();
        $result = $result->row();
        return $result;
    }

    //In this section some other functions based on requirements
    public function select_by_email_password($email, $password){
        $fields = "*";
        $this->db->select($fields);
        $this->db->from($this->_table);
        $this->db->where("$this->_table.email", $email);
        $this->db->where("$this->_table.password", $password);
        $result = $this->db->get();
        $result = $result->row();
        return $result;
    }

    //All count related function

    /**
    * Description: This function will receive email as parameter
    *              and run a count query. Finally, it will return
    *              a numeric value 0 | 1.
    * Params: N/A
    * Used By/ Dependencies: Controller@User->register_jobseeker
    **/
    public function count_by_email($email){
        $this->db->from($this->_table);
        $this->db->where("email", $email);
        return $this->db->count_all_results();
    }

    public function get_active_users(){
        $fields = " COUNT(IF(user_type=1, 1, NULL)) AS active_client_count ";
        $fields .= ", COUNT(IF(user_type=2, 1, NULL)) AS active_vendor_count ";
        $this->db->select($fields);
        $this->db->from($this->_table);
        $this->db->where("$this->_table.User_status", 1);
        $result = $this->db->get();
        return $result->row();
    }


}
