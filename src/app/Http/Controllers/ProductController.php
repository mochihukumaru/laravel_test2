<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use App\Http\Requests\RegisterRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->input('keyword');
        $query = Product::query();

    if (!empty($search)) {
        $query->where('name', 'like', '%' . $search . '%');
    }

    $perPage = 6;
    $products = $query->paginate($perPage);
    

    return view('index', compact('products', 'search'));
    }


    public function register(Request $request)
    {

        $seasons = Season::all();
        return view('register',compact('seasons'));
    }

    public function store(RegisterRequest $request)
    {
        if($request->has('back')){
            return redirect('/products');
        }
        
        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        if($request->hasFile('image'))
        {
            $path = $request->file('image')->store('public/products');
            $product->image = str_replace('public/','',$path);
        }

        $product->save();

        $product->seasons()->sync($request->input('season'));

        return redirect('/products');
    }


    public function show($id)
    {
        $product = Product::with('seasons')->findOrFail($id);
        $seasons = Season::all();
        $selectedSeasons = $product->seasons()->select('seasons.id')->pluck('id')->toArray();
        return view('show',compact('product','seasons'));
    }

    public function update(RegisterRequest $request,$id)
    {

        if($request->has('back')){
            return redirect('/products');
        }


        $product = Product::findOrFail($id);

        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->seasons() ->sync($request->input('season'));
        $product->description =$request->input('description');

        if($request->hasFile('image'))
        {
            $path = $request->file('image')->store('public/products');
            $product->image = str_replace('public/','',$path);
        }
        $product->save();

        return redirect('/products');
    }

    public function destroy(Request $request)
    {
        Product::find($request->id)->delete();
        return redirect('/products');
    }


   public function search(Request $request)
{
    $query = Product::query();
    $query = $this->getSearchQuery($request, $query);

    $products = $query->paginate(6);

    return view('index', compact('products'));
}


public function getSearchQuery($request, $query)
{
    if (!empty($request->input('keyword')))
    {
        $query->where('name', 'like', '%' . $request->input('keyword') . '%');
    }
    return $query;
}

}






