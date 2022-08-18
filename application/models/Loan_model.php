<?php

class Loan_model extends CI_Model
{


	function __consturct()
	{
		parent::__construct();

	}

//This function is used to add new loan data.
	public function Add_LoanData($data)
	{
		$this->db->insert('loan', $data);
	}

//This function is used to add new installments data.
	public function Add_installData($data)
	{
		$this->db->insert('loan_installment', $data);
	}

//This function is used to add new loan model data.
	public function loan_modeldata()
	{
		$sql = "SELECT `loan`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`
      FROM `loan`
      LEFT JOIN `employee` ON `loan`.`emp_id`=`employee`.`em_id` ORDER BY `loan`.`id` DESC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

//This function is used to select loan values.
	public function LoanValselect($id)
	{
		$sql = "SELECT `loan`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`
      FROM `loan`
      LEFT JOIN `employee` ON `loan`.`emp_id`=`employee`.`em_id`
      WHERE `loan`.`id`='$id'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}

//This function is used to select loan value for a employee.
	public function LoanValEmselect($id)
	{
		$sql = "SELECT `loan`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`
      FROM `loan`
      LEFT JOIN `employee` ON `loan`.`emp_id`=`employee`.`em_id`
      WHERE `loan`.`emp_id`='$id' AND `loan`.`status`!='Done'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}

//This function is used to select installments.

	public function installmentSelect()
	{
		$sql = "SELECT `loan_installment`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`
      FROM `loan_installment`
      LEFT JOIN `employee` ON `loan_installment`.`emp_id`=`employee`.`em_id` ORDER BY `loan_installment`.`id` DESC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

//This function is used to get loan value by id.
	public function GetLoanValuebyLId($loanid)
	{
		$sql = "SELECT `loan`.*,
        `employee`.`em_id`,`first_name`,`last_name`,`em_code`
        FROM `loan`
        LEFT JOIN `employee` ON `loan`.`emp_id`=`employee`.`em_id`
        WHERE `loan`.`id`='$loanid'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}

//This function is used to update loan data.
	public function update_LoanData($loan_id, $data)
	{
		$this->db->where('id', $loan_id);
		$this->db->update('loan', $data);
	}

//This updates loan data.
	public function update_LoanDataVal($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('loan', $data);
	}

//This updates loan installments data.
	public function update_LoanInstallData($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('loan_installment', $data);
	}

//This function gets emoployees for loan checks.
	public function GetEmployeeForloancheck($em_id)
	{
		$sql = "SELECT * from `loan` WHERE `emp_id`='$em_id' AND `status`='Granted'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}

//This function gets loan installments value for an employee.
	public function LoanInstallValEmselect($id)
	{
		$sql = "SELECT * from `loan_installment` WHERE `id`='$id'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}
}
