@extends('frontend.dashboard.layout.master')

@if($rPath == 'edit')
    @section('title', 'Update Timesheet')
@else
    @section('title', 'Add Timesheet')
@endif

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
				<a class="navbar-brand" href="#">Timesheet Management</a>
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
				<div class="col-lg-9 col-md-9 app-view-mainCol">
					<div class="cards">
						<div class="header">
							<h3 class="title">{{ $rPath == 'edit' ? 'Update Timesheet' : 'Add Timesheet' }}</h3>
							<hr>
						</div>
            @include('frontend.dashboard.menu.alerts')
						<div class="content">
							@if($rPath == 'edit')
							<form class="form-horizontals profile-form" action="" method="post">
								{{ csrf_field() }}
								<input type="hidden" name="timesheet_id" value="{{$timesheet->timesheet_id}}">
								<input type="hidden" name="date" value="{{$timesheet->date}}">
                <input type="hidden" name="time" value="{{$timesheet->time}}">
                <div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Students</label>
											<select class="form-control border-input" name="student_id" id="student_id" required>
                        <option value="">Select Student</option>
                        @foreach($assign_students as $students)
												<option value="{{$students->student_id}},{{$students->user_id}}" {{$timesheet->student_id == $students->student_id ? 'selected="selected"' : ''}}>{{$students->student_name}}</option>
                        @endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Duration</label>
                      <select class="form-control border-input" name="duration" id="duration">
												<option value="0:30" {{$timesheet->duration == '0:30' ? 'selected="selected"' : ''}}>0:30</option>
												<option value="1:00" {{$timesheet->duration == '1:00' ? 'selected="selected"' : ''}}>1:00</option>
												<option value="1:30" {{$timesheet->duration == '1:30' ? 'selected="selected"' : ''}}>1:30</option>
												<option value="2:00" {{$timesheet->duration == '2:00' ? 'selected="selected"' : ''}}>2:00</option>
											</select>
                    </div>
									</div>
								</div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Session Description</label>
                      <textarea name="description" rows="3" cols="30" class="form-control" placeholder="Session Description" required>{{$timesheet->description}}</textarea>
                    </div>
                  </div>
                </div>


								<div class="text-center">
									<button type="submit" class="btn btn-info btn-wd btn-green">Save</button>
								</div>

								<div class="clearfix"></div>
							</form>
							@else
							<form class="form-horizontals profile-form" action="" method="post">
								{{ csrf_field() }}
                <input type="hidden" name="date" value="{{$date}}">
                <input type="hidden" name="time" value="{{$time}}">
                <div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Students</label>
											<select class="form-control border-input" name="student_id" id="student_id" required>
                        <option value="">Select Student</option>
                        @foreach($assign_students as $students)
												<option value="{{$students->student_id}},{{$students->user_id}}">{{$students->student_name}}</option>
                        @endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Duration</label>
                      <select class="form-control border-input" name="duration" id="duration">
												<option value="0:30">0:30</option>
												<option value="1:00" selected>1:00</option>
												<option value="1:30">1:30</option>
												<option value="2:00">2:00</option>
											</select>
                    </div>
									</div>
								</div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Session Description</label>
                      <textarea name="description" rows="3" cols="30" class="form-control" placeholder="Session Description" required></textarea>
                    </div>
                  </div>
                </div>
								<div class="text-center">
									<button type="submit" class="btn btn-info btn-wd btn-green">Save</button>
								</div>

								<div class="clearfix"></div>
							</form>
							@endif
						</div>
					</div>
				</div>


			</div>
		</div>
	</div>


</div>
@endsection

@section('script')
<script>
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
