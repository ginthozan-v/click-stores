<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Images;
use Facade\FlareClient\Stacktrace\File;
use PhpParser\Node\Stmt\Foreach_;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = 10;

        $products = Product::with('categories')->orderByDesc('id')->paginate($pagination);
        return view('admin.products')->with('products', $products);
    }



    /// Add Product
    ////////////////////////////////////////////////////////////////
    public function addProduct(Request $request)
    {
        if ($request->isMethod('post')) {

            $validated = $request->validate([
                'ProductTitle' => 'required|max:255',
                'inputDetail' => 'required',
                'inputPrice' => 'required',
                'inputDescription' => 'required',
                'MainCategoryName' => 'required',
            ]);

            $data = $request->all();

            if ($request->has('InStock')) {
                $data['InStock'] = true;
            } else {
                $data['InStock'] = false;
            }

            $product = new Product;
            $product->category_id = $data['MainCategoryName'];

            if ($request->has('SubCategoryName')) {
                $product->sub_category_id = $data['SubCategoryName'];
            }

            $product->title = $data['ProductTitle'];
            $product->slug = strtolower($data['ProductTitle']);
            $product->details = $data['inputDetail'];
            $product->oldPrice = $data['inputOldPrice'];
            $product->price = $data['inputPrice'];
            $product->description = $data['inputDescription'];
            $product->in_stock = $data['InStock'];

            $category = Category::where(['id' => $data['MainCategoryName']])->pluck('id');

            $product->save();
            $pId = Product::pluck('id')->last();
            // echo "<pre>"; print_r($image_array); die;

            //upload multi image
            if ($request->hasFile('multiImage')) {
                $image_array = $request->file('multiImage');

                $array_len = count($image_array);

                for ($i = 0; $i < $array_len; $i++) {
                    $image_ext = $image_array[$i]->getClientOriginalExtension();
                    $filename = rand(111, 99999) . "." . $image_ext;
                    $folder = '/img/products/';
                    $destinationPath = public_path($folder);
                    $filePath = $folder . $filename;

                    $image_array[$i]->move($destinationPath, $filename);

                    $images = new Images();
                    $images->ImageName = $filePath;
                    $images->product_id = $pId;
                    $images->save();
                }
            } else {
                $images = new Images();
                $images->ImageName = "/img/products/noimage.png";
                $images->product_id = $pId;
                $images->save();
            }

            $product->categories()->attach($category);
            return redirect()->back()->with('flash_message_success', 'Product added Successfully!');
        }

        $categories = Category::get();
        $categories_dropdown = "<option selected disabled>Select</option>";
        foreach ($categories as $cat) {
            $categories_dropdown .= "<option value='" . $cat->id . "'>" . $cat->name . "</option>";
        }
        return view('admin.addProduct')->with(compact('categories_dropdown'));
    }


    //// Edit Product
    ////////////////////////////////////////////////////////////////
    public function editProduct(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if ($request->has('InStock')) {
                $data['InStock'] = true;
            } else {
                $data['InStock'] = false;
            }
            Product::where(['id' => $id])->update([
                'category_id' => $data['MainCategoryName'],
                'title' => $data['ProductTitle'],
                'slug' => strtolower($data['ProductTitle']),
                'details' => $data['inputDetail'],
                'oldPrice' => $data['inputOldPrice'],
                'price' => $data['inputPrice'],
                'description' => $data['inputDescription'],
                'in_stock' => $data['InStock']
            ]);
            if (isset($data['SubCategoryName'])) {
                Product::where(['id' => $id])->update(['sub_category_id' => $data['SubCategoryName']]);
            }

            //upload multi image
            if ($request->hasFile('multiImage')) {
                $image_array = $request->file('multiImage');
                $array_len = count($image_array);

                for ($i = 0; $i < $array_len; $i++) {
                    $image_ext = $image_array[$i]->getClientOriginalExtension();
                    $filename = rand(111, 99999) . "." . $image_ext;
                    $folder = '/img/products/';
                    $destinationPath = public_path($folder);
                    $filePath = $folder . $filename;

                    $image_array[$i]->move($destinationPath, $filename);

                    $images = new Images();
                    $images->ImageName = $filePath;
                    $images->product_id = $id;
                    $images->save();
                }
            }

            return redirect()->back()->with('flash_message_success', 'Product updated Successfully!');
        }

        $productDetail = Product::where(['id' => $id])->first();

        $images = Images::where(['product_id' => $id])->get();

        $categories = Category::get();
        $categories_dropdown = "<option selected disabled>Select</option>";
        foreach ($categories as $cat) {
            if ($cat->id == $productDetail->category_id) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $categories_dropdown .= "<option value='" . $cat->id . "' " . $selected . ">" . $cat->name . "</option>";
        }



        return view('admin.addProduct')
            ->with(compact('productDetail', 'categories_dropdown', 'images'));
    }


    //// Delete Product
    ////////////////////////////////////////////////////////////////
    public function deleteProduct($id = null)
    {
        if (!empty($id)) {
            $product = Product::where(['id' => $id])->firstOrFail();

            $productImages = $product->images()->get();
            $productImagesArray = $productImages->toArray();
            foreach ($productImagesArray as $image) {
                $img =  $image['ImageName'];
                if (file_exists(public_path() . $img)) {
                    unlink(public_path() . $img);
                }
            }
            $product->images()->delete();
            $product->delete();
            return redirect()->back()->with('flash_message_success', 'Product deleted Successfully!');
        }
    }

    //// Delete Image
    ////////////////////////////////////////////////////////////////
    public function deleteImage($id = null)
    {
        if (!empty($id)) {
            $image = Images::where(['id' => $id])->firstOrFail();
            $filename = $image->ImageName;
            if (file_exists(public_path() . $filename)) {
                unlink(public_path() . $filename);
            }
            Images::where(['id' => $id])->delete();

            return redirect()->back()->with('flash_message_success', 'Image deleted Successfully!');
        }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.addProduct');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id', $id)->firstOrFail();
        $img = Images::where(['product_id' => $id])->first();
        $images = Images::where(['product_id' => $id])->get();
        return view('admin.productDetail')
            ->with(compact('product', 'images', 'img'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
