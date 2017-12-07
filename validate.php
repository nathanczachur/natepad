<?php

$return = [];

$return['noteTitle'] = (isset($_POST['noteTitle'])) ? $_POST['noteTitle'] : '';
$return['noteText'] = (isset($_POST['noteText'])) ? $_POST['noteText'] : '';

if (file_exists('notes/' . $return['noteTitle'] . '.txt')) {
	$return['errors'][] = 'File title "' . $return['noteTitle'] . '" already exists';
}
if (strlen(trim($return['noteText'])) <= 0) {
	$return['errors'][] = 'Note text is too short.';
}

header('Content-Type: application/json');
echo json_encode($return);