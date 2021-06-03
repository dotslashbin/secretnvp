<?php

namespace App\Services\NVPServices;
use App\Services\NVPServices\DataServiceINT;
use App\Models\NVPModel;
use Carbon\Carbon;

class NVPReader implements DataServiceINT {

	private $filterKey;
	private $filterTimestamp;
	private $returnStructure;

	function __construct(string $key = '', string $timestamp = '')
	{
		$this->filterKey = $key;
		$this->filterTimestamp = $timestamp;
	}

	public function GetReturnStructure() {
		return $this->returnStructure;
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
			$convertedDate = Carbon::createFromTimestamp($this->filterTimestamp);
			$query->where('created_at', $convertedDate); 
		}

		$query->orderBy('created_at', 'desc');

		return $query->first();
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
	 * Sets the return structure value
	 *
	 * @param string $structure
	 * @return void
	 */
	public function SetReturnStructure(string $structure)
	{
		$this->returnStructure = $structure;
	}
}