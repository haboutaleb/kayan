<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\PARENT_DASHBOARD;
use App\Model\Category;
use App\Http\Requests\dashboard\CreateCategoryRequest;
use App\Http\Requests\dashboard\EditCategoryRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\IMAGE_CONTROLLER;

class CategoryController extends PARENT_DASHBOARD
{
    //
    public function __construct()
    {
        $this->data['squence_pages'][trans('dash.category')] = route('category');
        $this->mainRedirect = 'dashboard.category.';
    }

    public function index()
    {
        $this->data['categories'] = Category::all();
        return view($this->mainRedirect . 'index', $this->data);
    }

    public function create()
    {
        $this->data['squence_pages'][trans('dash.add_new_category')] = route('category_create');
        $this->data['latest_categories'] = Category::latest()->take(10)->get();
        return view($this->mainRedirect . 'create', $this->data);
    }

    public function store(CreateCategoryRequest $request)
    {
        $category = new Category();
        $category->name_ar = $request->name_ar;
        $category->name_en = $request->name_en;
        $category->description_ar = $request->description_ar;
        $category->description_en = $request->description_en;
        
        if ($request->hasFile('image')) {
            $category->image = IMAGE_CONTROLLER::upload_single($request->image, 'storage/app/category');
        }

        $category->save();
        if ($request->back) {
            $forward_url = url('dashboard/category/create');
        } else {
            $forward_url = url('dashboard/category');
        }
        return redirect($forward_url)->with('class', 'alert alert-success')->with('message', trans('dash.added_successfully'));
    }
    
    public function edit($id = 0)
    {
        if (!Category::find($id)) {
            return back()->with('class', 'alert alert-danger')->with('message', trans('dash.try_2_access_not_found_content'));
        }
        $this->data['category'] = Category::find($id);
        $this->data['squence_pages'][trans('dash.edit_category')] = route('category_edit');
        $this->data['latest_categories'] = Category::latest()->take(10)->get();
        return view($this->mainRedirect . 'edit', $this->data);
    }

    public function update(EditCategoryRequest $request)
    {
        $category = Category::find($request->category_id);

        $category->name_ar = $request->name_ar;
        $category->name_en = $request->name_en;
        $category->description_ar = $request->description_ar;
        $category->description_en = $request->description_en;

        $del_old_image = false;
        if ($request->image) {
            if ($category->image) {
                $del_old_image = true;
                $old_image_name = $category->image;
            }
            $category->image = IMAGE_CONTROLLER::upload_single($request->image, 'storage/app/category');
        }

        $category->update();
        
        if ($del_old_image) {
            IMAGE_CONTROLLER::delete_image($old_image_name, 'category');
        }

        if ($request->back) {
            $forward_url = url('dashboard/category/edit') . '/' . $category->id;
        } else {
            $forward_url = url('dashboard/category');
        }
        return redirect($forward_url)->with('class', 'alert alert-success')->with('message', trans('dash.edited_successfully'));
    }


    public function delete($id = 0)
    {
        if (!$category = Category::find($id)) {
            return back()->with('class', 'alert alert-danger')->with('message', trans('dash.try_2_access_not_found_content'));
        }

        $category->delete();
        return back()->with('class', 'alert alert-success')->with('message', trans('dash.deleted_successfully'));
    }

}
