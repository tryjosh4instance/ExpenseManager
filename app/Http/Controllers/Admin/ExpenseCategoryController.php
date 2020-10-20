<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpenseCategory;

class ExpenseCategoryController extends Controller
{
    public function index()
    {
        $data = ExpenseCategory::all();

        return view('Admin.expensecategory',['data'=>$data]);
    }

    public function categoryadd(Request $request)
    {
        $category = new ExpenseCategory;

        $category->category = $request->input('category');
        $category->description = $request->input('description');

        $category->save();

        return redirect('/expense-categories')->with('status', 'New category has been added!');
        
    }

    public function categoryupdate(Request $request, $id)
    {
        $category = ExpenseCategory::findOrFail($id);

        $category->category = $request->input('category');
        $category->description = $request->input('description');

        $category->save();

        return redirect('/expense-categories')->with('status', 'You have updated a category.');
    }

    public function categorydelete($id)
    {
        $category = ExpenseCategory::findOrFail($id);
        $category->delete();

        return redirect('expense-categories')->with('status', 'A category has been deleted.');
    }
}
