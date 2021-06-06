<?php

namespace App\Services\NVPServices;
use App\Services\NVPServices\DataServiceINT;
use App\Models\NVPModel;
use Carbon\Carbon;

class NVPReader implements DataServiceINT {

	private $filterKey;
	private $filterTimestamp;
	private $returnStructure;

	public $page;
	public $limit; 
	public $skip; 

	function __construct(string $key = '', string $timestamp = '', int $page = 0, int $limit = 0)
	{
		$this->filterKey = $key;
		$this->filterTimestamp = $timestamp;
		$this->limit = ($limit > 0)? $limit: config('app.DEFAULT_ITEMS_PER_PAGE');
		$this->skip = ($page > 0)? ($page - 1) * $this->limit: config('app.DEFAULT_SKIP');
		$this->page = ($page > 0)? $page: 1;
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
		return NVPModel::skip($this->skip)->take($this->limit)->get();
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