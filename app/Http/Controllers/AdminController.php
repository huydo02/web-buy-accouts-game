<?php

namespace App\Http\Controllers;

use App\Models\account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\hero;
use App\Models\views;
use App\Models\weapon;
use App\Models\notifications;

class AdminController extends Controller
{
    function index(){
        $notifycation_value = DB::table('notifications')->count('*');
        $views = views::select('views')->first();
        $vip = account::count();
        // $normal = accountNormal::count();

        return view('homePage.home',compact('notifycation_value','views','vip'));
    }
    function list_products(){
        $show_products = DB::table('hero')->get();
        return view('homePage.ListAdmin.listProduct',compact('show_products'));
    }
    function add_products(){
        return view('homePage.ListAdmin.addProduct');
    }
    function add_weapon(){
        return view('homePage.ListAdmin.addWeapon');
    }
    public function edit_products($id){
        $products = hero::find($id);
        return view('homePage.ListAdmin.updateProduct',compact('products'));
    }
    public function list_weapon(){
        $show_weapons = DB::table('weapons')->get();
        return view('homePage.ListAdmin.listWeapon',compact('show_weapons'));
    }
    public function edit_weapons($id){
        $weapon = weapon::find($id);
        return view('homePage.ListAdmin.updateWeapon',compact('weapon'));
    }
    public function list_account(){
        $Account = account::get();
        return view('homePage.ListAdmin.listAccount',compact('Account'));

    }
    public function add_account(){
        $hero = hero::select('id','name')->get();
        $weapon = weapon::select('id','name')->get();

        return view('homePage.ListAdmin.addAccount',compact('hero','weapon'));
    }
    public function edit_account($id){
        $Account = account::where('id', $id)->first();
        // $selected_heroes = json_decode($Account->hero) ;
        // dd( $selected_heroes );
        $hero = hero::select('id','name')->get();
        $weapon = weapon::select('id','name')->get();
        return view('homePage.ListAdmin.updateAccount',compact('Account','hero','weapon'));
    }
}


