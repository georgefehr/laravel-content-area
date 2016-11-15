<?php 

return [

	'can_edit' => function(){
		// enter email addresses of users that can edit content here,
		// or replace this function with your own custom filter
		$editors = [

		];
		return (Auth::check() && in_array(Auth::user()->email, $editors));
	}

];
