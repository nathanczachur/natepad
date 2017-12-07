<?php
include('Note.php');

$response = [];
try {
	$post = new Note(
		$_POST['noteTitle'],
		$_POST['noteText']
	);
	file_put_contents('notes/' . $post->title() . '.txt', $post->text());
	$response = ['message' => 'file created'];
} catch (Exception $e) {
	$response = ['message' => 'error'];
}

header('Content-Type: application/json');
echo json_encode($response);