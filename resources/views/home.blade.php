@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/expense-add" method="POST">
          {{ csrf_field() }}
          {{ method_field('POST') }}
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Category</label>
            <select name="category" id="cars" class=form-control>
            @foreach ($data as $category)
                <option >{{$category->category}}</option>
             @endforeach
            </select>
          </div>
          <div class="form-group">
            <label  for="message-text"  class="col-form-label">Amount</label>
            <input placeholder="$ 0.00" name="amount" class="form-control" id="message-text"></input>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Date</label>
            <input type="date" name="date"  class="form-control" id="message-text"></input>
          </div>       
      
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Confirm</button>
          </div>
      </form> 
      </div>
    </div>
  </div>
</div>



                <form style="padding: 30px">
                <button type="button"  class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">ADD</button>
                    <table class="table">
                        <thead>
                            <th>Category</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </thead>
                        @php
                        $cat = App\Models\Expense::all();
                        @endphp
                        @foreach($cat as $row)
                            <tr>
                            <td>{{$row->category}}</td>
                            <td>{{$row->amount}}</td>
                            <td>{{$row->date}}</td>
                            <td>EDIT</td>
                            <td>DELETE</td>
                            
                            </tr>
                          @endforeach
                        <tbody>
                        
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection