@extends('layouts.master')

@section('title')
    Expense Categories | Expense Manager
@endsection

@section('content')

{{-- Start Add Modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="/save-category" method="POST">
        {{ csrf_field() }}
        <div class="modal-body">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Category:</label>
                <input name="category" type="text" class="form-control" id="recipient-name">
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">Description:</label>
                <textarea name="description" class="form-control" id="message-text"></textarea>
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

      <form action="/expense-category-update/" method="POST" id="updateForm">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="modal-body">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Category:</label>
                <input name="category" id="category" type="text" class="form-control" id="recipient-name">
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">Description:</label>
                <textarea name="description" id="description" class="form-control" id="message-text"></textarea>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" onclick="return confirm('Update this category?')" class="btn btn-primary">Update</button>
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
              <div class="card-header">
                <h4 class="card-title"> Expense Categories: </h4>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add Category</button>
              </div>
              <div class="card-body">
              
                <div class="table-responsive">
                  <table id="datatable" class="table">
                    <thead class=" text-primary">
                      <th>Id</th>
                      <th>Category</th>
                      <th>Description</th>
                      <th>UPDATE</th>
                      <th>DELETE</th>
                    </thead>
                    <tbody>
                      @foreach ($data as $row)
                        <tr>
                          <td>{{$row->id}}</td>
                          <td>{{$row->category}}</td>
                          <td>{{$row->description}}</td>
                          <td>
                            <a href="#" class="btn btn-success update">UPDATE</a>
                          </td>
                          <td>
                          <form action="/category-delete/{{$row->id}}" method="POST">
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
    var table = $('#datatable').DataTable();

  //Start edit record

  table.on('click', '.update', function(){

    $tr = $(this).closest('tr');
    if ($($tr).hasClass('child')){
      $tr = $tr.prev('.parent');
    }

    var data = table.row($tr).data();
    console.log(data);

    $('#category').val(data[1]);
    $('#description').val(data[1]);

    $('#updateForm').attr('action', '/expense-category-update/'+data[0]);
    $('#updateModal').modal('show');

  });

});

</script>

@endsection