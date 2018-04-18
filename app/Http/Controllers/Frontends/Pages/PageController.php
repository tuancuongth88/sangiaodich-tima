<?php

namespace App\Http\Controllers\Frontends\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
	/*
	|-----------------------------------------------
	| Show content of a page
	|-----------------------------------------------
	| @method GET
	| @author tantan
	|*/
    public function show($slug){
    	$data = \App\Models\Page::findBySlugOrFail($slug);

    	$viewName = 'frontend.pages.page';
    	$machineName = $data['machine_name'] ?? str_slug($data['title'], '_');
    	if ( \View::exists('frontend.pages.page_'.$machineName) ) {
            $viewName .= '_'.$machineName;
        }
    	return view($viewName)->with(compact('data'));
    }
}
