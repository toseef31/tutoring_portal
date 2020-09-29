@extends('frontend.dashboard.layout.master')

@section('title', 'Tutors')

@section('styling')

@endsection
@section('content')

@include('frontend.dashboard.menu.menu')

<div class="main-panel">
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar bar1"></span>
        <span class="icon-bar bar2"></span>
        <span class="icon-bar bar3"></span>
        </button>
        <a class="navbar-brand" href="#">Tutors</a>
      </div>
    </div>
  </nav>
  <div class="content">
    <div class="container-fluid app-view-mainCol">
      <div class="row">
        <!-- <div class="col-lg-4 col-md-5 app-view-mainCol">
          <div class="cards cards-user">
            <div class="image">
              <img src="{{asset('frontend-assets/images/dashboard/background.jpg')}}" alt="...">
            </div>
            <div class="content">
              <div class="author">
                <div class="re-img-box">
                  <img class="avatar border-white" src="" alt="...">
                  <div class="re-img-toolkit">
                    <div class="re-file-btn">
                      Change <i class="fa fa-camera"></i>
                      <input type="file" class="upload" id="imageFile"  name="image"  onchange="uploadpicture(this)">
                    </div>
                  </div>
                </div>
                <h4 class="title" id="userName">Zeeshan<br>
                </h4>
              </div>
            </div>
            <hr>
            <div class="text-center">
              <div class="row">
              </div>
            </div>
          </div>
        </div> -->
        <div class="col-lg-12 col-md-12 app-view-mainCol">
          <div class="cards">
            <div class="header">
              <h3 class="title"><img src="{{asset('/frontend-assets/images/glasses.png')}}" class="glass-img" alt="logo"><span class="page-title">Tutors</span></h3>
              <hr>
              @include('frontend.dashboard.menu.alerts')
              @if(Session::has('message'))
        			<div class="alert alert-success">
        				 {{ Session::get('message') }}
        				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        				 <span aria-hidden="true">&times;</span>
        				 </button>
        			</div>
        			@endif
            </div>
            <div class="content">
              @if(count($tutors)>0)
              <div class="table-responsive">
                <table class="table table-bordered hidden-sm hidden-xs">
                  <thead>
                    <tr>
                      <th>Tutor</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Assigned To</th>
                      <th>About Your Tutor</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($tutors as $tutor)
                    <tr>
                      <td>
                        <div class="text-center">
                          <img src="{{asset('/frontend-assets/images/dashboard/profile-photos/'.$tutor->image)}}" alt="" style="width:100px;height: 100px;border-radius:50%;">
                        </div>
                        <p class="text-center" style="margin-top:10px;">{{$tutor->first_name}} {{$tutor->last_name}}</p> </td>
                      <td>{{$tutor->email}}</td>
                      <td>{{$tutor->phone}}</td>
                      <td>{{SCT::getStudentName($tutor->student_id)->student_name}}</td>
                      <td>{{$tutor->description}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                {{$tutors->render()}}
              </div>
              @else
              <div class="hidden-sm hidden-xs">
                <h4>Tutor assignment pending <img src="{{asset('/frontend-assets/images/user.jpg')}}" alt=""></h4>
              </div>
              @endif
              <div class="hidden-md hidden-lg">
              @if(count($tutor_mobile)>0)
              @foreach($tutor_mobile as $tutor)
              <table class="table table-bordered ">
                <thead>
                </thead>
                <tbody>
                  <tr>
                    <td>Tutor</td>
                    <td>
                      <div class="text-center">
                        <img src="{{asset('/frontend-assets/images/dashboard/profile-photos/'.$tutor->image)}}" alt="" style="width:100px;height: 100px;border-radius:50%;">
                      </div>
                      <p class="text-center" style="margin-top:10px;">{{$tutor->first_name}} {{$tutor->last_name}}</p>
                    </td>
                  </tr>
                     <tr>
                       <td>Email</td>
                       <td>{{$tutor->email}}</td>
                     </tr>
                     <tr>
                       <td>Phone</td>
                       <td>{{$tutor->phone}}</td>
                     </tr>
                     <tr>
                       <td>Assigned To</td>
                       <td>{{SCT::getStudentName($tutor->student_id)->student_name}}</td>
                     </tr>
                     <tr>
                       <td>About Your Tutor</td>
                       <td>{{$tutor->description}}</td>
                     </tr>
                </tbody>
              </table>
              @endforeach
                {{$tutor_mobile->render()}}
                @else
                <h4>Tutor assignment pending <img src="{{asset('/frontend-assets/images/user.jpg')}}" alt=""></h4>
                @endif
              </div>
            </div>
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="modal-warning" role="dialog" class="modal fade in" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content bg-warning animated bounceIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <span class="icon icon-exclamation-triangle icon-5x"></span>
                    <h3>Are you sure?</h3>
                    <p>You will not be able to undo this action.</p>
                    <div class="m-t-lg">
                        <form method="post" action="{{ url('user-portal/student/delete') }}">
                            <input type="hidden" name="_method" value="delete">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="student_id" class="actionId">
                            <button class="btn btn-danger" type="submit">Continue</button>
                            <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
function deleteEmployer(userId){
    $('.actionId').val(userId);
    $('#modal-warning').modal();
}
function doAction(){
    var userId = $('.actionId').val();
    if(userId != ''){
        alert('delete this '+userId);
    }
}
</script>
@endsection
