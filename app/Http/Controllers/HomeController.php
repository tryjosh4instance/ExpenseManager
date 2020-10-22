<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use App\Models\User;
use App\Models\Expense;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $data = ExpenseCategory::all();
        return view('home', ['data'=>$data]);
    }

    public function expenseadd(Request $request)
    {
      
        $data = new Expense;

        $data->category = $request->input('category');
        $data->amount = $request->input('amount');
        $data->date = $request->input('date');
        $data->users_id = auth()->id();
        
        $data->save();

        return redirect('/home')->with('status', 'Expense added!');
    }

    public function expensedelete($id)
    {
        $data = Expense::findOrFail($id);
        $data->delete();
        return redirect('/home');
    }

}
