<?php

class Notice_model extends CI_Model
{


	function __consturct()
	{
		parent::__construct();

	}

	//Gets notice from the database.
	public function GetNotice()
	{
		$sql = "SELECT * FROM `notice` ORDER BY `notice`.`date` DESC;";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	//This function is responsible for established published notices.
	public function Published_Notice($data)
	{
		$this->db->insert('notice', $data);
	}

	public function GetNoticelimit()
	{
		$this->db->order_by('date', 'DESC');
		$query = $this->db->get('notice');
		$result = $query->result();
		return $result;
	}

}

?>
