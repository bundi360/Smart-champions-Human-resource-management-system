<?php

class Dashboard_model extends CI_Model
{
//This class is resposndible for dashboard control.

	function __consturct()
	{
		parent::__construct();

	}

	//This function is used to add data to the to do list.
	public function insert_tododata($data)
	{
		$this->db->insert('to-do_list', $data);
	}

	//This function is used to get to do infor.
	public function GettodoInfo($userid)
	{
		$sql = "SELECT * FROM `to-do_list` WHERE `user_id`='$userid' ORDER BY `date` DESC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	//This is the class used to get the running projects.l

	public function GetRunningProject()
	{
		$sql = "SELECT * FROM `project` WHERE `pro_status`='running' ORDER BY `id` DESC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	//This is the function used to get the holiday information.
	public function GetHolidayInfo()
	{
		$sql = "SELECT * FROM `holiday` ORDER BY `id` DESC LIMIT 10";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

//This class is used to update the to-do-list.
	public function UpdateTododata($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('to-do_list', $data);
	}
}

?>
