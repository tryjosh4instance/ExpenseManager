@extends('layouts.master')

@section('title')
    Expenses | Expense Manager
@endsection

@section('content')

{{-- Start Add Modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Expense</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="/expense-add-admin" method="POST">
        {{ csrf_field() }}
        <div class="modal-body">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Category:</label>
                <select name="category" id="cars" class=form-control>
                  @php
                  $cat = App\Models\ExpenseCategory::all();
                  @endphp
                  @foreach ($cat as $category)
                      <option >{{$category->category}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">Amount:</label>
                <input name="amount" placeholder="$0.0" class="form-control" id="message-text"></input>
                <label for="message-text" class="col-form-label">Date:</label>
                <input type="date" name="date" class="form-control" id="message-text"></input>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- End Add Modal --}}


{{-- Start Update Modal --}}
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="/expense-update-admin/" method="POST" id="updateForm">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="modal-body">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Category:</label>
                <select name="category" id="cars" class=form-control>
                  @php
                  $cat = App\Models\ExpenseCategory::all();
                  @endphp
                  @foreach ($cat as $category)
                      <option >{{$category->category}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">Amount:</label>
                <input name="amount" placeholder="$0.0" class="form-control" id="message-text"></input>
                <label for="message-text" class="col-form-label">Date:</label>
                <input type="date" name="date" class="form-control" id="message-text"></input>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" onclick="return confirm('Update this entry?')" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- End Update Modal --}}


@if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif



<div class="row">
          <div class="col-md-12">
            <div class="card">


{{-- Start of Total per Category --}}
          <div class="card">
          <table style="padding:30px;" class="card">
          <thead>
            <th class="modal-header text-primary"> <h3> Total Expense per Category </h3></th>
          </thead>
          <tbody >
          @foreach($total as $line)
          {
            <tr>
            <td>
            <strong>{{$line->category}}</strong>
            </td>
            </tr>
            <tr><td>${{$line->sum}}</td></tr>
          }
          @endforeach
           </tbody>
           </table>
           </div>
{{-- End of Total per Category --}}


              <div class="card-header">
                <h4 class="card-title"> Expenses: </h4>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add Expense</button>
              </div>
              <div class="card-body">

                <div class="table-responsive">
                  <table id="mytable" class="table">
                    <thead class=" text-primary">
                       <th>Id</th>
                      <th>Category</th>
                      <th>Amount</th>
                      <th>Date</th>
                      <th>Added</th>
                      <th>UPDATE</th>
                      <th>DELETE</th>
                    </thead>
                    <tbody>
                      @foreach ($data as $row)
                        <tr>
                          <td>{{$row->id}}</td>
                          <td>{{$row->category}}</td>
                          <td>{{$row->amount}}</td>
                          <td>{{$row->date}}</td>
                          <td>{{$row->created_at->diffForHumans()}}</td>
                          <td>
                            <a href="#" class="btn btn-success update">UPDATE</a>
                          </td>
                          <td>
                          <form action="/expense-delete-admin/{{$row->id}}" method="POST">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">DELETE</button>
                          </form>
                          </td>
                        </tr>
                        <!-- <form action="{{ url('about-us-delete/' .$row->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger">DELETE</button>
                        </form> -->
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
           
          </div>
        </div>

@endsection

@section('scripts')

<script type="text/javascript">

$(document).ready( function () {
    var table = $('#mytable').DataTable();

  //Start edit record

  table.on('click', '.update', function(){

    $tr = $(this).closest('tr');
    if ($($tr).hasClass('child')){
      $tr = $tr.prev('.parent');
    }

    var data = table.row($tr).data();
    console.log(data);

    $('#category').val(data[1]);
    $('#amount').val(data[1]);
    $('#date').val(data[1]);

    $('#updateForm').attr('action', '/expense-update-admin/'+data[0]);
    $('#updateModal').modal('show');

  });

});

</script>

@endsection