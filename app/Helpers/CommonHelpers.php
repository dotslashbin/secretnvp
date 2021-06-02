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

	if($returnStructure === 'DATA_SET') {
		$format->page = $page; 
		$format->itemsPerPage = $itemsPerPage;
	}
	
	$format->foo = "whatever we need";

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