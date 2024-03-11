<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function dodajKategoriju(Request $request){
        $data = $request -> validate([
            'user_id' => '',
            'name' => 'required',
            ],
        );
        $data['user_id'] = auth()->id();
        $category = new Category();
        $category->create($data);
        return response()->json(['message' => 'Uspjesno ste dodali kategoriju!'], 201);
    }

    public function dohvatiKategorije(){
        $category = Category::with('user')->get();
        return response()->json(['category' => $category]);
    }

    public function izbrisiKategoriju($id){
        $category = Category::find($id);
        $category->delete();
        return response()->json(['message' => 'Uspjesno ste izbrisali kategoriju!']);
    }



    public function urediKategoriju(Request $request, $id){

        $category = Category::findOrFail($id);
        $data = $request->validate([
            'name' => '',
            
        ]);

        


        DB::table('categories')
    ->where('id', $id)
    ->update([
        'name' => $data['name'],
        
    ]);

        $category->save();
        return response()->json([
            'poruka' => 'Uspjesno uredjeno',
            'category' => $category,
        ]);
    }


}
