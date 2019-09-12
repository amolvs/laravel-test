<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreateCategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = Category::getMasterCategory();
        $data['masterCategoryAll'] = $category->get();
        $data['masterCategory'] = $category->paginate(3);
        return view('master-category-listing', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $new_file_name = false;
        if (isset($request['category_img'])) {
            $new_file_name = time() . '_' . $request->file('category_img')->getClientOriginalName();
            $request->file('category_img')->storeAs('/public/category-image/', $new_file_name);
        }
        $validKeys = [
            'parent_category_id',
            'category_name',
            'category_img',
            'category_info'
        ];

        $newCategory = [];
        foreach ($validKeys as $key) {
            if ($key == 'category_img' && $new_file_name)
                    $newCategory[$key] = $new_file_name;
            else if (isset($request[$key]))
                $newCategory[$key] = $request[$key];
        }

        Category::create($newCategory);
        return redirect()->route('category-listing');
    }

    public function getSubCategoryList($id)
    {
        $subCategoryList = Category::select('category_name', 'category_img', 'category_info')
            ->where('parent_category_id', $id)
            ->get();

        return response()->json($subCategoryList);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
