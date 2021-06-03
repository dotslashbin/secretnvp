<?php
namespace App\Services\NVPServices;


Interface DataServiceINT {
	public function GetReturnStructure();
	public function RunQuery();
	public function SetReturnStructure(String $structure);
}
