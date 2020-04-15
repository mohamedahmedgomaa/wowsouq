<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use App\Model\Client;
use App\Model\Comment;
use App\Model\Like;
use App\Model\Order;
use App\Model\Product;
use App\Model\Seller;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeneralController extends Controller
{
    //
    public function dashboard()
    {
        $categories = Category::count();
        $clients = Client::count();
        $comments = Comment::count();
        $likes = Like::count();
        $products = Product::count();
        $sellers = Seller::count();
        $users = User::count();
        $orders = Order::count();
        $orders_new = Order::where('status', 'pending')->count();
        $orders_current = Order::where('status', 'accepted')->count();
        $orders_old = Order::whereIn('status', ['rejected', 'delivered', 'declined'])->count();
        return view('admin.dashboard', compact('categories', 'clients', 'comments',
                                                        'likes', 'orders', 'products', 'sellers', 'users'
                                                    , 'orders_old', 'orders_new', 'orders_current'));
    }
}
