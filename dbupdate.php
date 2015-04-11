<?php
$webfeedurl = 'http://etcweb.princeton.edu/webfeeds/courseofferings/?subject=all';
$xml = simplexml_load_file($webfeedurl);

foreach ($xml->term->subjects->subject as $subject)
{
	foreach ($subject->courses->course as $course)
	{
		
		$data = array(
				'')
	}
}