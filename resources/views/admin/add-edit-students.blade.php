@extends('admin.layouts.master')
@if($rPath == 'edit')
    @section('title', 'Update Customer')
@else
    @section('title', 'Add Customer')
@endif
@section('content')
<style>
.form-horizontal .control-label {
  text-align: right;
  margin-bottom: 0;
  padding-top: 7px;
}
.form-horizontal .form-group {
    margin-left: -15px;
    margin-right: -15px;
}
.form-group {
    margin-bottom: 15px;
    display: flex;
  }
.form-horizontal .form-group:after, .form-horizontal .form-group:before {
    content: " ";
    display: table;
}
.col-md-6 {
    width: 50%;
    /* float: right; */
}
.card {
    background-color: #fff;
    border: 1px solid #f2f5f8;
    border-radius: 4px;
    -webkit-box-shadow: none;
    box-shadow: none;
    display: block;
    margin-bottom: 10px;
    position: relative;
}
.card-body {
    padding: 15px;
    position: relative;
}
.col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
    position: relative;
    min-height: 1px;
    padding-left: 15px;
    padding-right: 15px;
}
label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: 700;
    color: black !important;
}
.custom-control {
    cursor: pointer;
    font-weight: 400;
    line-height: 14px;
    margin-bottom: 0;
    min-height: 14px;
    min-width: 14px;
    position: relative;
    -webkit-user-select: none;
    -ms-user-select: none;
    user-select: none;
    vertical-align: middle;
}
.radio-div {
  display: flex;
}
</style>
  <div class="wrapper">
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
            <div class="collapse navbar-collapse justify-content-end" id="navigation">

            <ul class="navbar-nav">

              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  {{Session::get('sct_admin')->first_name}}
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="{{ url('dashboard/logout') }}">Logout</a>
                </div>
              </li>

            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <!-- <div class="panel-header panel-header-sm">


</div> -->
      <div class="content">
        <div class="row">
          <div class="col-md-12">
              @include('admin.includes.alerts')
              <div class="card">
                  <div class="card-body">

                    @if($rPath == 'edit')
                    @if($student['user_image'] != '')
                    <?php
                    $profilePhoto = url('frontend-assets/images/dashboard/profile-photos/'.$user['user_image']);
                     ?>
                  @endif

          <form class="form-horizontal employers-form" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="hidden" name="student_id" value="{{ $student->student_id }}">

              <div class="form-group">
                  <label class="control-label col-md-3 text-right">&nbsp;</label>
                  <div class="col-md-6">
                      Required fields are marked *
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-3 text-right">Student Name : *</label>
                  <div class="col-md-6">
                      <input type="text" class="form-control" name="student_name" required="" value="{{ $student->student_name }}">
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-3 text-right">Email : </label>
                  <div class="col-md-6">
                      <input type="email" class="form-control" name="email" value="{{ $student->email }}">
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-3 text-right">School/College : *</label>
                  <div class="col-md-6">
                      <input type="text" class="form-control" name="college" placeholder="College" value="{{ $student->college }}">
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-3 text-right">Grade/Level : *</label>
                  <div class="col-md-6">
                      <input type="text" class="form-control" name="grade" placeholder="Grade" value="{{ $student->grade }}">
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-3 text-right">Tutoring Subject : *</label>
                  <div class="col-md-6">
                      <input type="text" class="form-control" name="subject" placeholder="Subject" value="{{ $student->subject }}">
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-3 text-right">Goals : </label>
                  <div class="col-md-6">
                    <textarea name="goal" class="form-control" rows="8" placeholder="Goals" cols="30">{{$student->goal}}</textarea>
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-3 text-right">Client *</label>
                  <div class="col-md-6">
                    <select class="form-control" name="user_id">
                      @foreach($users as $user)
                      <option value="{{$user->id}}" {{$student->user_id == $user->id ? 'selected=="selected"':''}}>{{$user->first_name}} {{$user->last_name}}</option>
                      @endforeach
                    </select>
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-3 text-right">&nbsp;</label>
                  <div class="col-md-6">
                      <button class="btn btn-block btn-primary do-save" type="submit" name="save">Save</button>
                  </div>
              </div>
          </form>
                  @else
                  <form class="form-horizontal employers-form" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <div class="form-group">
                          <label class="control-label col-md-3 text-right">&nbsp;</label>
                          <div class="col-md-6">
                              Required fields are marked *
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 text-right">Student Name : *</label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="student_name" required="">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 text-right">Email : </label>
                          <div class="col-md-6">
                              <input type="email" class="form-control" name="email" >
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 text-right">School/College : *</label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="college" placeholder="College">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 text-right">Grade/Level : *</label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="grade" placeholder="Grade">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 text-right">Tutoring Subject : *</label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="subject" placeholder="Subject">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 text-right">Goals : </label>
                          <div class="col-md-6">
                            <textarea name="goal" class="form-control" rows="8" placeholder="Goals" cols="30"></textarea>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 text-right">Client *</label>
                          <div class="col-md-6">
                            <select class="form-control" name="user_id">
                              @foreach($users as $user)
                              <option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
                              @endforeach
                            </select>
                          </div>
                      </div>
                      <!-- <div class="form-group">
                          <label class="control-label col-md-3 text-right">Role :</label>
                          <div class="col-md-6 radio-div">
                              <label class="custom-control custom-control-primary custom-radio">
                                  <input name="role" class="custom-control-input" type="radio" value="admin" checked>
                                  <span class="custom-control-indicator"></span>
                                  <span class="custom-control-label">Customer</span>
                              </label>
                              <label class="custom-control custom-control-primary custom-radio" style="margin-left:20px;">
                                  <input name="role" class="custom-control-input" type="radio" value="tutor">
                                  <span class="custom-control-indicator"></span>
                                  <span class="custom-control-label">Tutor</span>
                              </label>
                          </div>
                      </div> -->

                      <div class="form-group">
                          <label class="control-label col-md-3 text-right">&nbsp;</label>
                          <div class="col-md-6">
                              <button class="btn btn-block btn-primary do-save" type="submit" name="save">Save</button>
                          </div>
                      </div>
                  </form>
                  @endif


                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
      function myFunction() {

          var x =confirm("you want to delete this job ");
          if (x)
          {
              return true;
          }
          else
          {
              event.preventDefault();
              return false;
          }
      }
  </script>
@endsection

@section('script')
<script>
$('select').on('change', function() {
  var value=this.value;
  var id=$(this).parent().attr("data-id");
   $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
  $.ajax({
          type: "POST",
          url: "{{ url('dashboard/post_portal') }}",
          data: {job_id:id,value:value},
          success: function(data){
            //$('#treeviews').html(data);
            if(data ==1){
            toastr.success("Status Update");
            }
            console.log(data);
          }

    });

});
</script>
@endsection
