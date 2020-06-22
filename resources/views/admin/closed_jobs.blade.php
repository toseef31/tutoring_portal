@extends('admin.layouts.master')
@section('content')
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
            <a class="navbar-brand" href="#pablo">Jobs Management</a>
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
                  {{Session::get('fa_admin')->name}}
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
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Jobs List</h4>
              </div>

              <div class="card-body">
                <div class="table-responsive">
                  @if(session()->has('message'))
                    <div class="row">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <strong>Message:</strong>{{session()->get('message')}}
                      </div>
                    </div>
                  @endif
                  <table class="table">
                    <thead class=" text-primary">
                      <th colspan="2">Job_id</th>
                      <th colspan="2">Name</th>
                      <th colspan="3">Job_title</th>
                      <th colspan="3">Service</th>
                      <th colspan="3">Job_type</th>
                      <th colspan="3">Year_end</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>City</th>
                      <th class="text-right">Posted_date</th>
                      <th>Job Status</th>
                      <th class="text-right">Action</th>
                    </thead>
                    <tbody>
                    @foreach($alljobs as $jobs)
                      <tr>
                        <td colspan="2"> {{$jobs->id}}</td>
                        <td colspan="2"> {{$jobs->customer_name}}</td>
                        <td colspan="3"> {{$jobs->job_title}}</td>
                        <td colspan="3"> {{$jobs->services}}</td>
                        <td colspan="3"> {{$jobs->job_type}}</td>
                        <td colspan="3"> {{$jobs->ended_year}}</td>
                        <td> {{$jobs->job_email}}</td>
                        <td> {{$jobs->mobilenumber}}</td>
                        <td>{{$jobs->city}}</td>
                        <td>{{$jobs->created_at}}</td>
                        <td>Closed</td>
                        <td>
                          <a href="javascript:void(0);" onclick="change_status({{$jobs->id}})" class="btn btn-success">Repost Job</a>
                        </td>
                      </tr>
                      @endforeach

                    </tbody>
                  </table>
                </div>
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

function change_status(id){
  // alert(id);

 $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$.ajax({
        type: "post",
        url: "{{ url('dashboard/repost-job') }}/"+id,
        data:{id:id},
        success: function(data){
          //$('#treeviews').html(data);
          if(data ==1){
          toastr.success("Job Updated");
          location.reload();

          }
          console.log(data);
        }

  });
}
</script>
@endsection
