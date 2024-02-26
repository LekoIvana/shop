<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Prompts\SearchPrompt;

class ProductController extends Controller
{
    public function dodajProizvod(Request $request){
        $data = $request->validate([
            'user_id' => '',
            'category_id' => '',
            'gender_id' => '',
            'name' => '',
            'description' => '',
            'size' => '',
            'price' => '',
            'image' => ''
        ]);

        $data['user_id'] = auth()->id();

        if($request->hasFile('image')){
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $data['image'] = $name;
        }

        DB::table('products')->insert($data);
        return response()->json(['message' => 'Uspjesno dodano'], 201);
    }

    public function dohvatiProizvode(){
        $product = Product::with('user','category','gender')->get();
        return response()->json(['product' => $product]);
    }

    public function izbrisiProizvod($id){
        $product = Product::find($id);
        $product->delete();
        return response()->json(['message' => 'Uspjesno ste izbrisali proizvod!']);
    }

    public function urediArtikl(Request $request, $id){

        $product = Product::findOrFail($id);
        $data = $request->validate([
            'name' => '',
            'size' => '',
            'description' => '',
            'gender_id' => '',
            'category_id' => '',
            'price' => '',
            'image' => '',

        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $data['image'] = $name;
        }


        DB::table('products')
    ->where('id', $id)
    ->update([
        'name' => $data['name'],
        'price' => $data['price'],
        'size' => $data['size'],
        'gender_id' => $data['gender_id'],
        'category_id' => $data['category_id'],
        'description' => $data['description'],
        'image' => $data['image']
    ]);

        $product->save();
        return response()->json([
            'poruka' => 'Uspjesno uredjeno',
            'product' => $product,
        ]);
    }

    public function dohvatiProizvodeMuski(){
        $proizvodiMuski = Product::with('user', 'category', 'gender')
                                ->whereHas('gender', function ($query) {
                                    $query->where('name', 'Muškarci');
                                })
                                ->get();

        return response()->json(['proizvodiMuski' => $proizvodiMuski]);
    }

    public function dohvatiProizvodeZenski(){
        $proizvodiZenski = Product::with('user', 'category', 'gender')
                                ->whereHas('gender', function ($query) {
                                    $query->where('name', 'Žene');
                                })
                                ->get();

        return response()->json(['proizvodiZenski' => $proizvodiZenski]);
    }

    public function dohvatiProizvodeDjecji(){
        $proizvodiDjeca = Product::with('user', 'category', 'gender')
                                ->whereHas('gender', function ($query) {
                                    $query->where('name', 'Djeca');
                                })
                                ->get();

        return response()->json(['proizvodiDjeca' => $proizvodiDjeca]);
    }

    public function searchProducts(Request $request){
        $text = $request->input('text');
        $results = Product::where('name', 'like', "%$text%")->get();
        return response()->json(['results' => $results]);
    }
}
