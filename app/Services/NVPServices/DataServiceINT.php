<?php
namespace App\Services\NVPServices;

/**
 * This provides an interface of hte DataService
 */
Interface DataServiceINT {
	public function GetReturnStructure();
	public function RunQuery();
	public function SetReturnStructure(String $structure);
}
