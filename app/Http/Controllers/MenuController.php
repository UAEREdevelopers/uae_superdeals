<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{

    public function listAll(){
        return view('backend.menu.listall');
    }
    public function create(){
        return view('backend.menu.create');
    }
    public function save(Request $request){
        $menu = Menu::create(['title'=> $request->title, 'parent_id'=> $request->parent_id ?? 0 ]);
        return $menu; 
    }

    public function update(Request $request , $id){

        $menu = Menu::where('id',$id)->firstorfail();
        $menu->title = $request->title;
        $menu->parent_id = $request->parent_id ?? 0;
        $menu->save();
        return $menu;
    }

    public function delete(Request $request , $id){
        Menu::where('id',$id)->delete();
        return true;
    }
    
}
