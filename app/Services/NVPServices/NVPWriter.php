<?php

namespace App\Services\NVPServices;
use App\Services\NVPServices\DataServiceINT;
use App\Models\NVPModel;

/**
 * This class is responsible for writing or saving data. 
 */
class NVPWriter implements DataServiceINT {

	private $key;
	private $value;
	private $returnStructure;

	function __construct(string $key = '', string $value = '')
	{
		$this->key = $key;
		$this->value = $value;
	}

	/**
	 * Returns the associated structure
	 *
	 * @return void
	 */
	public function GetReturnStructure() {
		return $this->returnStructure;
	}

	/**
	 * Executes the running of db query
	 *
	 * @return void
	 */
	public function RunQuery(): NVPModel
	{
		$nvpRecord = new NVPModel;
		$nvpRecord->key = $this->key;
		$nvpRecord->value = $this->value;
		$nvpRecord->timestamp = time();
		$result = $nvpRecord->save();

		return ($result)? $nvpRecord: null;
	}

	/**
	 * Sets the return structure value
	 *
	 * @param string $structure
	 * @return void
	 */
	public function SetReturnStructure(String $structure)
	{
		$this->returnStructure = $structure;
	}
}