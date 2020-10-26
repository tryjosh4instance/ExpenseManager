<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use App\Models\Expense;


class DashboardController extends Controller
{
    public function index()
    {
        $total = Expense::groupBy('category')
                ->selectRaw('sum(amount) as sum, category')
                ->get('sum','category');


        $data = Expense::all();

        return view('admin.dashboard', compact('total'))
            ->with('data', $data);
    }

    public function expenseaddadmin(Request $request)
    {
      
        $data = new Expense;

        $data->category = $request->input('category');
        $data->amount = $request->input('amount');
        $data->date = $request->input('date');
        $data->users_id = auth()->id();
        
        $data->save();

        return redirect('dashboard')->with('status', 'Expense added!');
    }

    public function expensdeleteadmin($id)
    {
        $data = Expense::findOrFail($id);

        $data->delete();

        return redirect('dashboard')->with('status', 'Expense Deleted.');
    }
    
    public function expenseupdateadmin(Request $request, $id)
    {
        $data = Expense::findOrFail($id);

        $data->category = $request->input('category');
        $data->amount = $request->input('amount');
        $data->date = $request->input('date');

        $data->save();

        return redirect('dashboard')->with('status', 'You have updated an Expense.');
    }
}
