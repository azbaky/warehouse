@extends('cms.parent')
@section('title','Index')
@section('page-big-title','INDEX')
@section('page-sub-title','index')
@section('page-main-title','index')

@section('styles')
    
@endsection
@section('content')
<section class="content">
    <div class="container-fluid">
    
      <!-- /.row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Cities</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>created_at</th>
                    <th>updated_at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($cities as $city )
                    <tr>
                    <td>{{$city->id}}</td>
                    <td>{{$city->Name}}</td>
                    <td>{{$city->created_at}}</td>
                    <td>{{$city->updated_at}}</td>
                    <td><div class="btn-group">
                      <a href="{{route('cities.edit',$city->id)}}" class="btn btn-info">
                        <i class="fas fa-edit"></i>
                      </a>
                      
                      <form action="{{route('cities.destroy',$city->id)}}" method="POST" >
                        @csrf
                        @method('DELETE')
                        <button type="submit"class="btn btn-danger"  >
                          <i class="fas fa-trash"></i>
                        </button>
                      </form>

                    </div></td>
                  </tr>
                  @endforeach
                  
                  
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
     
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>

@endsection

@section('scripts')
    
@endsection
