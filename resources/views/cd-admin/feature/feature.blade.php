@extends('cd-admin.home-master')

@section('page-title')  
View Features
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Features List
        
      </h1>
     
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Features</a></li>
        <li class="active">View Features</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
           <div class="box">
            <div class="box-header">
              <h3 class="box-title">
                 <a href="{{url('/feature-add')}}"><button class="btn btn-success" style="margin-bottom: 10px; ">Add Feature</button></a>
              </h3>
              @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible">
          <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Data Inserted Successfully</strong>
          {{Session::get("message", '')}}
        </div>
        @elseif(Session::has('updatesuccess'))
        <div class="alert alert-info alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Data Updated Successfully</strong>
          {{Session::get("message", '')}}
        </div>
        @elseif(Session::has('deletesuccess'))
        <div class="alert alert-danger alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Data Deleted Successfully</strong>
          {{Session::get("message", '')}}
        </div>
        @endif
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <table id="example1" class="table table-bordered table-striped">
                <thead>

                <tr>
                  <th>SN</th>
                  <th>Feature Name</th>
                   <th>Status</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tbody>
                @foreach($services as $pa)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$pa->name}}</td>
                  <td height="75px">
                     <form action="{{url('/featurestatus/'.$pa->id)}}" method="POST">
                      {{csrf_field()}}
                    <div class="btn-group">

                 @if($pa->status == 'active')
                 <button type="button" class="btn btn-success">Active</button>
                 @else
                  <button type="button" class="btn btn-danger">Inactive</button>
                  @endif
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  @if($pa->status == 'active')
                  <div class="dropdown-menu" role="menu" style="min-width: 0px;">
                    <li> <button class="btn btn-danger" type="submit">Inactive</button>
                    </li>
                  </div>
                  @else
                  <div class="dropdown-menu" role="menu" style="min-width: 0px;">
                    <li> <button class="btn btn-success" type="submit">Active</button>
                    </li>
                     </div>
                     @endif
                </div>
              </form>
                     </td>
                  <td>
                    <button class="btn btn-info" data-toggle="modal" data-target="#edit{{$pa->id}}" ><i class="fa fa-edit">
                    </i></button></a>
                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal-danger{{$pa->id}}"><i class="fa fa-trash"> </i></button>
                   <button class="btn btn-success" data-toggle="modal" data-target="#view{{$pa->id}}"><i class="fa  fa-eye"> </i></button>
                 </td>
                </tr>
                @endforeach
                
                </tbody>
                <tfoot>
                <tr>
                  <th>S.N</th>
                  <th>Feature Name</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

  </div>


 
            
        

        <!--MODEL-->


@foreach($er as $t)
<div class="modal fade" id="view{{$t->id}}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle"><strong>{{$t->name}}</strong></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <strong>Status :</strong>
        @if($t->status=='active')
        <div class="btn btn-success">Active</div>

        @else
        <div class="btn btn-danger">Inactive</div>
        @endif
        <strong><h3 >Details :</h3></strong><p> {!!$t->description!!}</p> 
        <p> <img src="{{url('/imageupload/'.$t->image)}}" style="height: 100px; width:100px;"></p>
        

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

<!--Delete-->

<div class="modal modal-danger fade" id="modal-danger{{$t->id}}">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Message from web</h4>
              </div>
              <div class="modal-body">
                <p>Are you sure you want to delete ?&hellip;</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
               <a href="{{url('/deletefeature/'.$t->id)}}"> <button type="button" class="btn btn-outline">Yes</button></a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>


        <!--Edit-->
   
        <div class="modal fade" id="edit{{$t->id}}" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title" id="exampleModalLongTitle"><b>EDIT :</b>{{$t->title}}</div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form role="form" action= "{{url('/featureupdate/'.$t->id)}}" enctype="multipart/form-data" method="post">
          {{csrf_field()}}
            
               <div class="form-group">

            <div class="form-group">
              
              <label for="title" >Service Name</label>
              <div class="text text-danger">{{$errors->first('name')}}</div>
              <input type="text" class="form-control" name="name" id="title" value="{{$t->name}}">
            </div>
              
              <label for="Image"> Image</label>
              <div class="text text-danger">{{$errors->first('image')}}</div>
              <input type="file" class="form-control" id="image" name="image"> 

            <div class="form-group">
              <label for="Alternative Image Name" > Alternative Image Name</label>
              <div class="text text-danger">{{$errors->first('alt')}}</div>
              <input type="textarea" class="form-control" name="alt" id="alt" value="{{$t->alt}}"> 
            </div>

            
            <div class="form-group">
              
              <label for="description" > Description</label>
              <div class="text text-danger">{{$errors->first('description')}}</div>
              <textarea id="summernote" rows="10" cols="80" name="description" >
                {!!$t->description!!}
              </textarea>
            </div>
            
            
            <div class="form-group" >
              
              <label for="status">Status</label>
              <br>
                <label>
                  <input type="radio" class="minimal" <?php echo $t['status'] == 'active' ? 'checked' :  '' ?> checked name="status" value="active">Active

                </label>
                <label>
                  <input type="radio"  class="minimal"  <?php echo $t['status'] == 'inactive' ? 'checked' :  '' ?> name="status" value="inactive">Inactive
                </label>
              </div>
        
               <div class="modal-footer">
               <button type="submit" class="btn btn-primary">Update</button>
              </div>
         </div>
         </form>
         </div>
         </div>
         </div>
         </div>     



<style type="text/css">
  .p{
    width: 100px;
  }
</style>

 
@endforeach

@endsection