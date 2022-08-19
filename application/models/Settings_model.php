<?php

class Settings_model extends CI_Model
{


	function __consturct()
	{
		parent::__construct();

	}

//Get settings value.
	public function GetSettingsValue()
	{
		$settings = $this->db->dbprefix('settings');
		$sql = "SELECT * FROM $settings";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}

//This function updates settings.
	public function SettingsUpdate($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('settings', $data);
	}
}
