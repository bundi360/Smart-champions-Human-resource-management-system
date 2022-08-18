<?php

class Employee_model extends CI_Model
{


	function __consturct()
	{
		parent::__construct();

	}

// This function is used to get the designation of the employee.
	public function getdesignation()
	{
		$query = $this->db->get('designation');
		$result = $query->result();
		return $result;
	}

	//This is used to get the department  of a certain employee.
	public function getdepartment()
	{
		$query = $this->db->get('department');
		$result = $query->result();
		return $result;
	}

//This is used to select an employee.
	public function emselect()
	{
		$sql = "SELECT * FROM `employee` WHERE `status`='ACTIVE'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

//THis is used to select an employee by the id.
	public function emselectByID($emid)
	{
		$sql = "SELECT * FROM `employee`
      WHERE `em_id`='$emid'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}

// This is used to select by employee by code.
	public function emselectByCode($emid)
	{
		$sql = "SELECT * FROM `employee`
      WHERE `em_code`='$emid'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}

//This used to get a valid employee.
	public function getInvalidUser()
	{
		$sql = "SELECT * FROM `employee`
      WHERE `status`='INACTIVE'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

//Check if email exists.
	public function Does_email_exists($email)
	{
		$user = $this->db->dbprefix('employee');
		$sql = "SELECT `em_email` FROM $user
		WHERE `em_email`='$email'";
		$result = $this->db->query($sql);
		if ($result->row()) {
			return $result->row();
		} else {
			return false;
		}
	}

//Adds an employee to the database.
	public function Add($data)
	{
		$this->db->insert('employee', $data);
	}

//Get basic information of the employee.
	public function GetBasic($id)
	{
		$sql = "SELECT `employee`.*,
      `designation`.*,
      `department`.*
      FROM `employee`
      LEFT JOIN `designation` ON `employee`.`des_id`=`designation`.`id`
      LEFT JOIN `department` ON `employee`.`dep_id`=`department`.`id`
      WHERE `em_id`='$id'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}

//display employees
	public function ProjectEmployee($id)
	{
		$sql = "SELECT `assign_task`.`assign_user`,
      `employee`.`em_id`,`first_name`,`last_name`
      FROM `assign_task`
      LEFT JOIN `employee` ON `assign_task`.`assign_user`=`employee`.`em_id`
      WHERE `assign_task`.`project_id`='$id' AND `user_type`='Team Head'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

//Get employee per address
	public function GetperAddress($id)
	{
		$sql = "SELECT * FROM `address`
      WHERE `emp_id`='$id' AND `type`='Permanent'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}

	//Get per address where it is permanent.
	public function GetpreAddress($id)
	{
		$sql = "SELECT * FROM `address`
      WHERE `emp_id`='$id' AND `type`='Present'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}

//Get employee per the level of education.
	public function GetEducation($id)
	{
		$sql = "SELECT * FROM `education`
      WHERE `emp_id`='$id'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

//Get employee by experience.
	public function GetExperience($id)
	{
		$sql = "SELECT * FROM `emp_experience`
      WHERE `emp_id`='$id'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

//Get employee bank information.
	public function GetBankInfo($id)
	{
		$sql = "SELECT * FROM `bank_info`
      WHERE `em_id`='$id'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}

//Get all employees
	public function GetAllEmployee()
	{
		$sql = "SELECT * FROM `employee`";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	//Get disciplinary action.
	public function desciplinaryfetch()
	{
		$sql = "SELECT `desciplinary`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`
      FROM `desciplinary`
      LEFT JOIN `employee` ON `desciplinary`.`em_id`=`employee`.`em_id`";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

//Get leave information.
	public function GetLeaveiNfo($id, $year)
	{
		$sql = "SELECT `assign_leave`.*,
      `leave_types`.`name`
      FROM `assign_leave`
      LEFT JOIN `leave_types` ON `assign_leave`.`type_id`=`leave_types`.`type_id`
      WHERE `assign_leave`.`emp_id`='$id' AND `dateyear`='$year'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

//Get salary value of an employee.
	public function GetsalaryValue($id)
	{
		$sql = "SELECT `emp_salary`.*,
      `addition`.*,
      `deduction`.*,
      `salary_type`.*
      FROM `emp_salary`
      LEFT JOIN `addition` ON `emp_salary`.`id`=`addition`.`salary_id`
      LEFT JOIN `deduction` ON `emp_salary`.`id`=`deduction`.`salary_id`
      LEFT JOIN `salary_type` ON `emp_salary`.`type_id`=`salary_type`.`id`
      WHERE `emp_salary`.`emp_id`='$id'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}

// update education status of an employee.
	public function Update_Education($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('education', $data);
	}

	public function Update($data, $id)
	{
		$this->db->where('em_id', $id);
		$this->db->update('employee', $data);
	}

//Update bank information.
	public function Update_BankInfo($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('bank_info', $data);
	}

//Update permanent address.
	public function UpdateParmanent_Address($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('address', $data);
	}

//Reset password.
	public function Reset_Password($id, $data)
	{
		$this->db->where('em_id', $id);
		$this->db->update('employee', $data);
	}

//Update experience.
	public function Update_Experience($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('emp_experience', $data);
	}

//Update salary of an employee.
	public function Update_Salary($sid, $data)
	{
		$this->db->where('id', $sid);
		$this->db->update('emp_salary', $data);
	}

//Update deductions of an employee.
	public function Update_Deduction($did, $data)
	{
		$this->db->where('de_id', $did);
		$this->db->update('deduction', $data);
	}

//Update salary additions of an employee.
	public function Update_Addition($aid, $data)
	{
		$this->db->where('addi_id', $aid);
		$this->db->update('addition', $data);
	}

//Update disciplinary data of an employee.
	public function Update_Desciplinary($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('desciplinary', $data);
	}

//Update social media data by a respective id.
	public function Update_Media($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('social_media', $data);
	}

//add permanent address of an employee to the database.
	public function AddParmanent_Address($data)
	{
		$this->db->insert('address', $data);
	}

//Add education data of an employee to the database.
	public function Add_education($data)
	{
		$this->db->insert('education', $data);
	}

//Add experience data of an employee.
	public function Add_Experience($data)
	{
		$this->db->insert('emp_experience', $data);
	}

//Add disciplinary action of an employee.
	public function Add_Desciplinary($data)
	{
		$this->db->insert('desciplinary', $data);
	}

//Add bank information.
	public function Add_BankInfo($data)
	{
		$this->db->insert('bank_info', $data);
	}

//Get all employees based on the id.
	public function GetEmployeeId($id)
	{
		$sql = "SELECT `em_password` FROM `employee` WHERE `em_id`='$id'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}

//Get employee file information.
	public function GetFileInfo($id)
	{
		$sql = "SELECT * FROM `employee_file` WHERE `em_id`='$id'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

//Get socia media values of an employee.
	public function GetSocialValue($id)
	{
		$sql = "SELECT * FROM `social_media` WHERE `emp_id`='$id'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}

//Get education value by id.
	public function GetEduValue($id)
	{
		$sql = "SELECT * FROM `education` WHERE `id`='$id'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}

//Get experience value of an employee with their respective id.
	public function GetExpValue($id)
	{
		$sql = "SELECT * FROM `emp_experience` WHERE `id`='$id'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}

//Get disciplinary value of an employee based on the id.
	public function GetDesValue($id)
	{
		$sql = "SELECT * FROM `desciplinary` WHERE `id`='$id'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}

//Get department of an employee.
	public function depselect()
	{
		$query = $this->db->get('department');
		$result = $query->result();
		return $result;
	}

//Add department data .
	public function Add_Department($data)
	{
		$this->db->insert('department', $data);
	}

//Add designation or title.
	public function Add_Designation($data)
	{
		$this->db->insert('designation', $data);
	}

//This function inserts a file uploaded to the database.
	public function File_Upload($data)
	{
		$this->db->insert('employee_file', $data);
	}

//Add employee salary to the database.
	public function Add_Salary($data)
	{
		$this->db->insert('emp_salary', $data);
	}

//Add addition to the database, ie on salary.
	public function Add_Addition($data1)
	{
		$this->db->insert('addition', $data1);
	}

//Add deductions.
	public function Add_Deduction($data2)
	{
		$this->db->insert('deduction', $data2);
	}

//This function is used to handle the leaves assigned.
	public function Add_Assign_Leave($data)
	{
		$this->db->insert('assign_leave', $data);
	}

//Insert social media profile to the database.
	public function Insert_Media($data)
	{
		$this->db->insert('social_media', $data);
	}

	public function desselect()
	{
		$query = $this->db->get('designation');
		$result = $query->result();
		return $result;
	}

	public function DeletEdu($id)
	{
		$this->db->delete('education', array('id' => $id));
	}

	public function DeletEXP($id)
	{
		$this->db->delete('emp_experience', array('id' => $id));
	}

	public function DeletDisiplinary($id)
	{
		$this->db->delete('desciplinary', array('id' => $id));
	}
}

?>
