<?php

/**
 * Generates a formatted structure with the data
 *
 * @param [type] $data
 * @param integer $page
 * @param integer $itemsPerPage
 * @return void
 */
function FormatReturn($data, $returnStructure, int $page = 1, int $itemsPerPage = 10) {
	$format = new stdClass;

	$format->data = $data;

	/**
	 * This section is unecessary at this point, but I am putting it here to demonstrate
	 * that should there be a need formatting of output like such, they will be implmeented
	 * in a helper that is agnostic fo where the data comes from.
	 */
	if($returnStructure === config('app.NVPReturnStructures.DATA_SET')) {
		$format->page = $page; 
		$format->itemsPerPage = $itemsPerPage;
	}
	
	return $format;
}

/**
 * Generates the JSON response for the api
 *
 * @param [type] $data
 * @return void
 */
function GenerateResponse($data) {
	return response()->json($data)->header('Content-Type', 'application/json');
}