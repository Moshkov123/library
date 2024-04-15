<?php

namespace App\Http\Controllers;

use App\Services\Photos\Service;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public $service;

    public function __construct(Service $service) // Use the imported Service class
    {
        $this->service = $service;
    }
}
