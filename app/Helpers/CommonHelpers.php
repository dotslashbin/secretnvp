<?php

/**
 * Generates a formatted structure with the data
 *
 * @param [type] $data
 * @param integer $page
 * @param integer $itemsPerPage
 * @return void
 */
function FormatReturn($data, $returnStructure, $page = 0, $limit = 0) {
	$format = new stdClass;

	switch($returnStructure) {
		// If the structure to buid is for errors
		case config('app.NVPReturnStructures.ERROR'): 
			$format->errors = $data;
		break;

		// If the structure to build is a data set, it will include the page and limit values with the output
		case config('app.NVPReturnStructures.DATA_SET'): 
			$format->data = $data;
			$format->page = ($page > 0)? $page: config('app.DEFAULT_SKIP'); 
			$format->itemsPerPage = ($limit > 0)? $limit: config('app.DEFAULT_ITEMS_PER_PAGE');
		break;
		default: 
			$format->data = $data;
		break;
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