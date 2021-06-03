<?php

namespace App\Services\NVPServices;
use App\Services\NVPServices\DataServiceINT;
use App\Models\NVPModel;

class NVPReader implements DataServiceINT {

	private $filterKey;
	private $filterTimestamp;
	private $returnStructure;

	function __construct(string $key = '', string $timestamp = '')
	{
		$this->filterKey = $key;
		$this->filterTimestamp = $timestamp;
		$this->returnStructure = config('app.NVPReturnStructures.DATA_SET');
	}

	public function GetReturnStructure() {
		return $this->returnStructure;
	}

	/**
	 * Executes the running of db query
	 *
	 * @return void
	 */
	public function RunQuery()
	{
		$query = NVPModel::where('key', $this->filterKey);

		if($this->filterTimestamp) {
			$query->where('value', 'velit'); // TODO change this to the real one
		}

		return $query->get();
	}
}