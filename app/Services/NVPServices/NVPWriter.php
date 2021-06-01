<?php

namespace App\Services\NVPServices;
use App\Services\NVPServices\DataServiceINT;
use App\Models\NVPModel;

class NVPWriter implements DataServiceINT {

	private $key;
	private $value;

	function __construct(string $key = '', string $value = '')
	{
		$this->key = $key;
		$this->value = $value;
	}

	/**
	 * Executes the running of db query
	 *
	 * @return void
	 */
	public function RunQuery()
	{
		$nvpRecord = new NVPModel;
		$nvpRecord->key = $this->key;
		$nvpRecord->value = $this->value;

		return $nvpRecord->save();
	}
}