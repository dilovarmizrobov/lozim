<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\Product;
use App\Property;
use App\Category;
use App\Feedback;
use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;

class AdminController extends Controller
{
    public function index() {
        return view('admin.index');
    }
}
