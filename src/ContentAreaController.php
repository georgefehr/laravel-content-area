<?php

namespace Cirruslab\LaravelContentArea;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class ContentAreaController extends BaseController
{

    public function save(Request $request)
    {
        $can_edit = config('contentarea.can_edit');
        if(!$can_edit()){
	        if($request->input('section_id')){
	        	$content_area = \Cirruslab\LaravelContentArea\ContentArea::findOrFail($request->input('section_id'));
	        	$content_area->content = $request->input('content');
	        	$content_area->save();
	        }
	    } else {
	    	abort(403, 'Access denied.');
	    }
    }

}
