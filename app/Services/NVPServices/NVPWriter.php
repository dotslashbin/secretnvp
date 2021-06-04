<?php

namespace App\Services\NVPServices;
use App\Services\NVPServices\DataServiceINT;
use App\Models\NVPModel;
use stdClass;

class NVPWriter implements DataServiceINT {

	private $key;
	private $value;
	private $returnStructure;

	function __construct(string $key = '', string $value = '')
	{
		$this->key = $key;
		$this->value = $value;
	}

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