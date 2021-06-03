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
		$this->returnStructure = config('app.NVPReturnStructures.RESULT');

	}

	public function GetReturnStructure() {
		return $this->returnStructure;
	}

	/**
	 * Executes the running of db query
	 *
	 * @return void
	 */
	public function RunQuery(): stdClass
	{
		$nvpRecord = new NVPModel;
		$nvpRecord->key = $this->key;
		$nvpRecord->value = $this->value;

		$result = $nvpRecord->save();
		$returnObject = new stdClass;
		$returnObject->result = $result;
		$returnObject->ID = ($result)? $nvpRecord->id:'';

		return $returnObject;
	}
}