<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brands;

class BrandsController extends Controller
{
    public function index()
    {
        $pagination = 10;

        $brands = Brands::orderByDesc('id')->paginate($pagination);
        return view('admin.brands')->with('brands', $brands);
    }



    public function addBrand(Request $request)
    {
        if ($request->isMethod('post')) {
            // $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $brand = new Brands;

            //upload image
            if ($request->hasFile('image')) {
                $image = $request->file('image');

                if ($image->isValid()) {
                    $extension = $image->getClientOriginalExtension();
                    $filename = rand(111, 99999) . '.' . $extension;

                    $folder = '/img/Brands/';
                    $filePath = $folder . $filename;

                    $destinationPath = public_path($folder);
                    $image->move($destinationPath, $filename);

                    $brand->image = $filePath;
                }
            }
            
            $brand->save();
            return redirect()->back()->with('flash_message_success', 'Brands added Successfully!');
        }

        $pagination = 10;

        $brands = Brands::orderByDesc('id')->paginate($pagination);
        return view('admin.brands')->with('brands', $brands);
    }



    
    public function deleteBrand($id = null)
    {
        if (!empty($id)) {
            $brands = Brands::where(['id' => $id])->firstOrFail();
            $filename = $brands->image;
            unlink(public_path() . $filename);
            Brands::where(['id' => $id])->delete();
        
            return redirect()->back()->with('flash_message_success', 'Brand deleted Successfully!');
        }
    }
}
