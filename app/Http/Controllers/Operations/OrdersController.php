<?php

namespace App\Http\Controllers\Operations;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller {

    public function index() {
        return view("Operations.Orders.init");
    }

}
