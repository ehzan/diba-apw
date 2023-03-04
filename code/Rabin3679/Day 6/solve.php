<?php

include '../file-handle.php';

function puzzle11($input_file)
{
	$data = read_file($input_file);
	$input = str_split($data);
	$result = false;
	for($packet_marker_pos = 0; $packet_marker_pos < count($input); $packet_marker_pos++)
	{ 
	    $char_marker = array_slice($input, $packet_marker_pos, 4);
		if(checkForMarker($char_marker))
		{
			$result = $packet_marker_pos + 4;
			break;
		}
	}
	return $result;	
}
function puzzle12($input_file)
{
	$data = read_file($input_file);
	$input = str_split($data);
	$result = false;
	for($message_marker_pos = 0; $message_marker_pos < count($input); $message_marker_pos++)
	{ 
	    $char_marker = array_slice($input, $message_marker_pos, 14);
		if(checkForMarker($char_marker))
		{
			$result = $message_marker_pos + 14;
			break;
		}
	}
	return $result;	
}
function checkForMarker($char_marker)
{
	$unique = array_unique($char_marker);
	return count($unique) == count($char_marker);
}

echo 'Day #6, part one: ' . puzzle11('input.txt') . PHP_EOL;
echo 'Day #6, part two: ' . puzzle12('input.txt') . PHP_EOL;
