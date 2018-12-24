<?php
/**
 * Created by PhpStorm.
 * User: wang
 * Date: 2018/12/19
 * Time: 16:00
 */

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Services\Api\Server;
use App\Services\Api\Error;



class IndexController extends Controller
{

    public function index()
    {
        $server = new Server(new Error());
        $server->run();
    }
}
