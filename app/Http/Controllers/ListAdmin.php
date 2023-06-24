<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\File;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\Models\hero;
use App\Models\weapon;
use App\Models\account;

use RealRashid\SweetAlert\Facades\Aler;

class ListAdmin extends Controller
{
    public function add_products(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'files' => 'required',
            'files.*' => 'image|mimes:png,jpg,gif,jpeg'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag(),
            ]);
        } else {
            if ($request->hasFile('files')) {
                $image_names = array();
                foreach ($request->file('files') as $file) {
                    $imageExte = $file->getClientOriginalExtension();
                    $newName = uniqid("", true) . "." . $imageExte;
                    $file->move("uploads", $newName);
                    array_push($image_names, $newName);
                }

                $filess = new hero();
                $filess->name = $request['name'];

                $filess->files = implode("|", $image_names);
                $filess->save();

                return response()->json([
                    'status' => 200,
                    'success' => "Thêm Thành Công",
                ]);
            }
        }
    }

    public function add_weapon(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'files' => 'required',
            'files.*' => 'image|mimes:png,jpg,gif,jpeg'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->getMessageBag(),
            ]);
        } else {
            if ($request->hasFile('files')) {
                $image_names = array();
                foreach ($request->file('files') as $file) {
                    $imageExte = $file->getClientOriginalExtension();
                    $newName = uniqid("", true) . "." . $imageExte;
                    $file->move("uploads/imageWeapon", $newName);
                    array_push($image_names, $newName);
                }
                //put this in here
                $filess = new weapon();
                $filess->name = $request['name'];

                $filess->files = implode("|", $image_names);
                $filess->save();

                return response()->json([
                    'status' => 200,
                    'success' => "Add successfully!",
                ]);
            }
        }
    }

    public function edit_products(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'files' => 'required',
            'files.*' => 'image|mimes:png,jpg,gif,jpegv',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag(),
            ]);
        } else {
            $hero = hero::find($request->id);
            $hero->name = $request->name;
            if ($request->hasFile('files')) {
                $image_name = explode("|", $hero->files);
                // Xóa các tệp trên máy chủ
                foreach ($image_name as $image) {
                    $image_path = public_path("uploads/") . $image;
                    unlink($image_path);
                }

                $image_names = array();
                foreach ($request->file('files') as $file) {
                    $imageExte = $file->getClientOriginalExtension();
                    $newName = uniqid("", true) . "." . $imageExte;
                    $file->move("uploads/", $newName);
                    array_push($image_names, $newName);
                }
                $hero->files = implode("|", $image_names);
            }
            $hero->update();
            return response()->json([
                'status' => 200,
                'message' => "Update successfully!",
            ]);
        }
    }
//edit_products
    public function edit_weapons(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'files' => 'required',
            'files.*' => 'image|mimes:png,jpg,gif,jpegv',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag(),
            ]);
        } else {
            $weapon = weapon::find($request->id);
            $weapon->name = $request->name;
            if ($request->hasFile('files')) {
                $image_name = explode("|", $weapon->files);
                // Xóa các tệp trên máy chủ
                foreach ($image_name as $image) {
                    $image_path = public_path("uploads/imageWeapon/") . $image;
                    unlink($image_path);
                }

                $image_names = array();
                foreach ($request->file('files') as $file) {
                    $imageExte = $file->getClientOriginalExtension();
                    $newName = uniqid("", true) . "." . $imageExte;
                    $file->move("uploads/imageWeapon", $newName);
                    array_push($image_names, $newName);
                }
                $weapon->files = implode("|", $image_names);
            }
            $weapon->update();
            return response()->json([
                'status' => 200,
                'message' => "Update successfully!",
            ]);
        }
    }
    public function remove_products($id)
    {
        $products = hero::find($id);
        if ($products) {

            // Xóa các bản ghi trong database
            $products->delete();
            $image_names = explode("|", $products->files);
            // Xóa các tệp trên máy chủ
            foreach ($image_names as $image_name) {
                $image_path = public_path("uploads/") . $image_name;
                unlink($image_path);
            }
            return response()->json([
                'status' => 200,
                'success' => "Delete hero successfully!",
            ]);
        }
        return response()->json([
            'status' => 400,
            'errors' => "An error occurred, please try again",
        ]);
    }
//remove_weapons

    public function remove_weapons($id)
    {
        $weapons = weapon::find($id);
        if ($weapons) {
            // Xóa các bản ghi trong database
            $weapons->delete();
            $image_names = explode("|", $weapons->files);
            // Xóa các tệp trên máy chủ
            foreach ($image_names as $image_name) {
                $image_path = public_path("uploads/imageWeapon/") . $image_name;
                unlink($image_path);
            }
            return response()->json([
                'status' => 200,
                'success' => "Delete weapon successfully!",
            ]);
        }
        return response()->json([
            'status' => 400,
            'errors' => "An error occurred, please try again",
        ]);
    }

    public function post_account(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'account_name' => 'required',
            'password' => 'required',
            'hero' =>'required',
            'weapon' =>'required',
            'servers' =>'required',
            'price' =>'required',
            'files' => 'required',
            'files.*' => 'image|mimes:png,jpg,gif,jpegv',
        ]);
        // dd((( $request->hero)));
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag(),
            ]);

        }else {
            $account = new account();
            $hero = array();
            $weapon = array();
                $account->name = $request->name;
                $account->account_name = $request->account_name;
                $account->password = $request->password;
                foreach ($request->hero as $heros) {
                    
                    array_push($hero, $heros);
                }
                $account->hero = implode("|", $hero);

                foreach ($request->weapon as $weapons) {
                    
                    array_push($weapon, $weapons);
                }
                $account->weapon = implode("|", $weapon);
                $account->server = $request->servers;
                $account->price = $request->price;
                if ($request->hasFile('files')) {
                    $image_names = array();
                    foreach ($request->file('files') as $file) {
                        $imageExte = $file->getClientOriginalExtension();
                        $newName = uniqid("", true) . "." . $imageExte;
                        $file->move("uploads/imageAccount", $newName);
                        array_push($image_names, $newName);
                    }
                    $account->file = implode("|", $image_names);
            }
                $account -> save(); 
                return response()->json([
                    'status' => 200,
                    'success' => "Add successfully!",
                ]);

        }   
    }
    public function edit_account(Request $request){
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'account_name' => 'required',
            'password' => 'required',
            'hero' =>'required',
            'weapon' =>'required',
            'servers' =>'required',
            'price' =>'required',
            'files' => 'required',
            'files.*' => 'image|mimes:png,jpg,gif,jpegv',
        ]);
        // dd(gettype(json_encode( $request->hero)));
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag(),
            ]);

        }else {
            $account = account::find($request->id);

            $hero = array();
            $weapon = array();
                $account->name = $request->name;
                $account->account_name = $request->account_name;
                $account->password = $request->password;
                foreach ($request->hero as $heros) {
                    
                    array_push($hero, $heros);
                }
                $account->hero = implode("|", $hero);

                foreach ($request->weapon as $weapons) {
                    
                    array_push($weapon, $weapons);
                }
                $account->server = $request->servers;
                $account->price = $request->price;
                if ($request->hasFile('files')) {
                    $image_account = explode("|", $account->file);
                    // Xóa các tệp trên máy chủ
                    foreach ($image_account as $image) {
                        $image_path = public_path("uploads/imageAccount/") . $image;
                        unlink($image_path);
                    }
    
                    $image_names = array();
                    foreach ($request->file('files') as $file) {
                        $imageExte = $file->getClientOriginalExtension();
                        $newName = uniqid("", true) . "." . $imageExte;
                        $file->move("uploads/imageAccount", $newName);
                        array_push($image_names, $newName);
                    }
                    $account->file = implode("|", $image_names);
                }
                $account -> update(); 
                return response()->json([
                    'status' => 200,
                    'success' => "Add successfully!",
                ]);

        }   
    }
    public function remove_account($id)
    {
        $account = account::find($id);
        if ($account) {
            // Xóa các bản ghi trong database
            $account->delete();
            $image_names = explode("|", $account->file);
            // Xóa các tệp trên máy chủ
            foreach ($image_names as $image_name) {
                $image_path = public_path("uploads/imageAccount/") . $image_name;
                unlink($image_path);
            }
            return response()->json([
                'status' => 200,
                'success' => "Delete account successfully!",
            ]);
        }
        return response()->json([
            'status' => 400,
            'errors' => "An error occurred, please try again",
        ]);
    }
}
