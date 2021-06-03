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
		return ($this->filterKey !== '')? $this->queryBasedOnKey():$this->queryAll();
	}

	/**
	 * Returns the result of querying all records
	 *
	 * @return void
	 */
	private function queryAll(){
		return NVPModel::all();
	}

	/**
	 * Returns the result of querying just one
	 *
	 * @return void
	 */
	private function queryBasedOnKey() {
		$query = NVPModel::where('key', $this->filterKey);

		if($this->filterTimestamp) {
			$query->where('value', $this->filterTimestamp); 
		}

		return $query->get();
	}
}