<?php

class Note
{
	private $title;
	private $text;

	public function __construct($title = '', $text)
	{
		$this->setTitle((string) $title);
		$this->setText((string) $text);
	}

	public function setTitle($title)
	{
		if ($title === '') {
			$title = uniqid('note_');
		}
		$this->title = $title;
	}

	public function title()
	{
		return $this->title;
	}

	public function setText($text)
	{
		if (strlen(trim($text)) <= 0) {
			throw new Exception('Invalid text. Please provide a more characters.');
		}
		$this->text = $text;
	}

	public function text()
	{
		return $this->text;
	}

	public function __toString()
	{
		return 'Post: {$this->title}';
	}
}
