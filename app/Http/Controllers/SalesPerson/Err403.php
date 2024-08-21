<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\AdminController;

class Err403 extends AdminController {

    public $data = [];

    function __construct() {
        parent::__construct();
    }

    public function index() {
        return view('admin.err403', $this->data);
    }
}
