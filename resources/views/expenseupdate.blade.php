@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Selected Expenses') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
    <div class="modal-body">
        <form action="{{ url('expense-save/' .$data->id) }}" method="POST">    
          {{ csrf_field() }}
          {{ method_field('PUT') }}
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Category</label>
            <select name="category" id="cars" class=form-control>
            @php
                $data = App\Models\ExpenseCategory::all();
            @endphp
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
</div>

@endsection


@section('scripts')
<script type="text/javascript">

$(document).ready( function () {
    $('#datatable').DataTable();
} );

</script>
@endsection