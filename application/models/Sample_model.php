<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Sample Model
 *
 * Example model for CodeIgniter application
 */
class Sample_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Get all records from a table
	 *
	 * @param	string	$table	Table name
	 * @return	array
	 */
	public function get_all($table)
	{
		return $this->db->get($table);
	}

	/**
	 * Get single record by ID
	 *
	 * @param	string	$table	Table name
	 * @param	int	$id	Record ID
	 * @return	array|NULL
	 */
	public function get_by_id($table, $id)
	{
		$query = $this->db->query("SELECT * FROM ".$table." WHERE id = ".(int)$id);
		return $query->row_array();
	}

	/**
	 * Insert data to table
	 *
	 * @param	string	$table	Table name
	 * @param	array	$data	Data to insert
	 * @return	bool
	 */
	public function insert($table, $data)
	{
		$keys = array_keys($data);
		$values = array_values($data);
		
		$sql = "INSERT INTO ".$table." (".implode(', ', $keys).") VALUES ('".implode("', '", $values)."')";
		
		return $this->db->query($sql);
	}

	/**
	 * Update data in table
	 *
	 * @param	string	$table	Table name
	 * @param	array	$data	Data to update
	 * @param	int	$id	Record ID
	 * @return	bool
	 */
	public function update($table, $data, $id)
	{
		$set = array();
		foreach ($data as $key => $value) {
			$set[] = $key." = '".$value."'";
		}
		
		$sql = "UPDATE ".$table." SET ".implode(', ', $set)." WHERE id = ".(int)$id;
		
		return $this->db->query($sql);
	}

	/**
	 * Delete record from table
	 *
	 * @param	string	$table	Table name
	 * @param	int	$id	Record ID
	 * @return	bool
	 */
	public function delete($table, $id)
	{
		$sql = "DELETE FROM ".$table." WHERE id = ".(int)$id;
		return $this->db->query($sql);
	}
}
