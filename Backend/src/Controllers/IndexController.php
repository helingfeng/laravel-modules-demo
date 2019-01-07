<?php
/**
 * User: helingfeng
 */
namespace LaravelModulesDemo\Backend\Controllers;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(){
        return view('test-plugin::welcome');
    }
}