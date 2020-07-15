@extends('admin.layouts.master')
@if($rPath == 'edit')
    @section('title', 'Update Session')
@else
    @section('title', 'Add Session')
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

          <form class="form-horizontal employers-form" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="hidden" name="session_id" value="{{ $session->session_id }}">

              <div class="form-group">
                  <label class="control-label col-md-3 text-right">Tutor : *</label>
                  <div class="col-md-6">
                    <select class="form-control border-input tutor" name="tutor_id" id="tutor_id" required>
                      <option value="">Select Tutor</option>
                      @foreach(SCT::getAllTutors() as $tutor)
                      <option value="{{$tutor->id}}" {{$session->tutor_id == $tutor->id ? 'selected="selected"' : ''}}>{{$tutor->first_name}} {{$tutor->last_name}}</option>
                      @endforeach
                    </select>
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-3 text-right">Student : *</label>
                  <div class="col-md-6">
                    <select class="form-control border-input student" name="student_id" id="student_id" required>
                      <option value="">Select Student</option>
                      @foreach(SCT::getAssingStudent($session->tutor_id) as $student)
                      <option value="{{$student->student_id}},{{$student->user_id}}" {{$session->student_id == $student->student_id ? 'selected="selected"' : '' }}>{{$student->student_name}}</option>
                      @endforeach
                    </select>
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-3 text-right">Subject : *</label>
                  <div class="col-md-6">
                      <input type="text" class="form-control border-input" placeholder="Enter Subject" id="subject" name="subject" value="{{$session->subject}}" required>
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-3 text-right">Date : *</label>
                  <div class="col-md-6">
                    <input type="date" class="form-control border-input" placeholder="Select Date" id="date" name="date" value="{{$session->date}}" required>
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-3 text-right">Time : *</label>
                  <div class="col-md-6">
                    <input type="time" class="form-control" id="time" name="time" value="{{$session->time}}" required>
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-3 text-right">Duration : *</label>
                  <div class="col-md-6">
                    <select class="form-control border-input" name="duration" id="duration">
                      <option value="0:30" {{$session->duration == '0:30' ? 'selected="selected"' : ''}}>0:30</option>
                      <option value="1:00" {{$session->duration == '1:00' ? 'selected="selected"' : ''}}>1:00</option>
                      <option value="1:30" {{$session->duration == '1:30' ? 'selected="selected"' : ''}}>1:30</option>
                      <option value="2:00" {{$session->duration == '2:00' ? 'selected="selected"' : ''}}>2:00</option>
                    </select>
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-3 text-right">Location : *</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control border-input" placeholder="Enter Location" id="location" name="location" value="{{$session->location}}" required>
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-3 text-right"></label>
                  <div class="col-md-6">
                      <input class="form-check-input" type="checkbox" name="initial_session" id="initial_session" value="1"  {{$session->session_type == 'First Session' ? 'checked':''}}><span style="margin-left: 20px;"> Initial Session</span>
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-3 text-right"></label>
                  <div class="col-md-6">
                    <input class="form-check-input" type="checkbox" name="recurs_weekly" id="recurs_weekly" value="1"  {{$session->recurs_weekly == 'Yes' ? 'checked':'disabled'}} ><span style="margin-left: 20px;"> Recurs Weekly</span>
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
                          <label class="control-label col-md-3 text-right">Tutor : *</label>
                          <div class="col-md-6">
                            <select class="form-control border-input tutor" name="tutor_id" id="tutor_id" required>
                              <option value="">Select Tutor</option>
                              @foreach(SCT::getAllTutors() as $tutor)
                              <option value="{{$tutor->id}}">{{$tutor->first_name}} {{$tutor->last_name}}</option>
                              @endforeach
                            </select>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 text-right">Student : *</label>
                          <div class="col-md-6">
                            <select class="form-control border-input student" name="student_id" id="student_id" required>
                              <option value="">Select Student</option>
                            </select>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 text-right">Subject : *</label>
                          <div class="col-md-6">
                              <input type="text" class="form-control border-input" placeholder="Enter Subject" id="subject" name="subject" required>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 text-right">Date : *</label>
                          <div class="col-md-6">
                            <input type="date" class="form-control border-input" placeholder="Select Date" id="date" name="date" value="" required>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 text-right">Time : *</label>
                          <div class="col-md-6">
                            <input type="time" class="form-control" id="time" name="time" required>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 text-right">Duration : *</label>
                          <div class="col-md-6">
                            <select class="form-control border-input" name="duration" id="duration">
      												<option value="0:30">0:30</option>
      												<option value="1:00" selected>1:00</option>
      												<option value="1:30">1:30</option>
      												<option value="2:00">2:00</option>
      											</select>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 text-right">Location : *</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control border-input" placeholder="Enter Location" id="location" name="location" required>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 text-right"></label>
                          <div class="col-md-6">
                              <input class="form-check-input" type="checkbox" name="initial_session" id="initial_session" value="1" checked><span style="margin-left: 20px;"> Initial Session</span>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 text-right"></label>
                          <div class="col-md-6">
                            <input class="form-check-input" type="checkbox" name="recurs_weekly" id="recurs_weekly" value="1" disabled><span style="margin-left: 20px;"> Recurs Weekly</span>
                          </div>
                      </div>
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
$('.tutor').on('change',function(){
  var tutorId = $(this).val();

  getStudents(tutorId,'student')
})
function getStudents(tutorId,cType){
  $.ajax({
    url: "{{ url('dashboard/get-assignStudent') }}/"+tutorId,
    success: function(response){
      var currentCategory = $('.student').attr('data-sub');
      // var currentState = $('.'+cType).attr('data-state');
      $('.student').html('').trigger('change');
      $('.student').append(response).trigger('change');
    }
  })
}

$('#initial_session').click(function () {
  var initial_session =  $('#initial_session').val();
if (this.checked == true) {
  $('#duration option[value="1:00"]').prop('selected', true)
  $('#recurs_weekly').prop('disabled',true);
}else {
  $('#recurs_weekly').prop('disabled',false);

}
})
</script>
@endsection
