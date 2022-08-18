<?php

class Organization_model extends CI_Model
{


	function __consturct()
	{
		parent::__construct();

	}

//Select department
	public function depselect()
	{
		$query = $this->db->get('department');
		$result = $query->result();
		return $result;
	}

//Add department
	public function Add_Department($data)
	{
		$this->db->insert('department', $data);
	}

//Delete a department
	public function department_delete($dep_id)
	{
		$this->db->delete('department', array('id' => $dep_id));
	}

//Update or edit a department.
	public function department_edit($dep)
	{
		$sql = "SELECT * FROM `department` WHERE `id`='$dep'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}

//Update a department
	public function Update_Department($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('department', $data);
	}

//Add designation or title.
	public function Add_Designation($data)
	{
		$this->db->insert('designation', $data);
	}

//Delete a designation or title.
	public function designation_delete($des_id)
	{
		$this->db->delete('designation', array('id' => $des_id));
	}

//Edit a designation or department.
	public function designation_edit($des)
	{
		$sql = "SELECT * FROM `designation` WHERE `id`='$des'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}

//Update designation or title
	public function Update_Designation($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('designation', $data);
	}

	public function desselect()
	{
		$query = $this->db->get('designation');
		$result = $query->result();
		return $result;
	}
}

?>
