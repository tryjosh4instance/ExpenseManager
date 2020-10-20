@extends('layouts.master')

@section('title')
    About Us | Expense Manager
@endsection

@section('content')

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add About Us</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <form action="/save-aboutus" method="POST">
    {{ csrf_field() }}
  

        <div class="modal-body">
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Title :</label>
                <input type="text" name="title" class="form-control" id="recipient-name">
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Subtitle :</label>
                <input type="text" name="subtitle" class="form-control" id="recipient-name">
            </div>
            <div class="form-group">
                <label for="message-text" class="col-form-label">Description :</label>
                <textarea name="description" class="form-control" id="message-text"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" autofocus="autofocus" class="btn btn-primary">SAVE</button>
        </div>
    </form>
    </div>
  </div>
</div>


<!-- Modal -->
<!-- <div class="modal fade" id="deletemodalpop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form id="delete_modal_Form" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
      <div class="modal-body">
        <input type="text" id="delete_aboutus_id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Yes. Delete it.</button>
      </div>
      </form>

    </div>
  </div>
</div> -->


<div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">About Us
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">ADD</button>
                </h4>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
              
              </div>
              <style>
                    .w-10p {
                        width: 10% ! important;
                    }
              </style>  
              <div class="card-body">
                <div class="table-responsive">
                  <table id="datatable" class="table">
                    <thead class=" text-primary">
                      <th class="w-10p">Id</th>
                      <th class="w-10p">Title</th>
                      <th class="w-10p">Subtitle</th>
                      <th class="w-10p">Description</th>
                      <th class="w-10p">EDIT</th>
                      <th class="w-10p">DELETE</th>
                    </thead>
                    <tbody>
                        @foreach ($aboutus as $data)
                      <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->title }}</td>
                        <td>{{ $data->subtitle }}</td>
                        <div style="height:10%; overflow:hidden;">
                            <td>{{ $data->description }}</td>
                        </div>
                        <td>
                          <a  class="btn btn-success" href="{{ url('/about-us/'. $data->id)  }}">EDIT</a>
                        </td>
                        <td>
                        <form action="{{ url('about-us-delete/' .$data->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger">DELETE</button>
                        </form>
                        </td>
                      </tr>
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


<!-- <script> 
    $(document).ready( function () {
        $('#datatable').DataTable();
    

      $('#datatable').on('click','.deletebtn', function (){
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function (){
          return $(this).text();
        }).get();
      
        //console.log(data);

        $('#delete_aboutus_id').val(data[0]);

        $('#delete_modal_Form').attr('action','/about-us-delete/'+data[0]);

        $('#deletemodalpop').modal('show');
      
      )};)
    }); 
  </script> -->

  <script>

$(document).ready( function () {
    $('#datatable').DataTable();
    });

  </script>

@endsection