@extends('frontend.dashboard.layout.master')

@section('title', 'My Profile')

@section('styling')
<link rel="stylesheet" type="text/css" href="{{asset('frontend-assets/css/credit-card.css')}}">
<style>
  .border-radius{
    border-radius: 25px;
  }
</style>
@endsection
@section('content')

@include('frontend.dashboard.menu.menu')

<div class="main-panel">
  <nav class="navbar navbar-default" style="position: initial !important;">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar bar1"></span>
          <span class="icon-bar bar2"></span>
          <span class="icon-bar bar3"></span>
        </button>
        <a class="navbar-brand" href="#">Dashboard</a>
      </div>

    </div>
  </nav>


  <div class="content">
  @if(Session::has('success'))
			<div class="alert alert-success">
				{{ Session::get('success') }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			@endif
    <div class="container-fluid app-view-mainCol">
      <div class="row">
        <div class="col-lg-6 col-md-6 app-view-mainCol">
          <div class="cards cards-user">
            <div class="header">
              <h4 class="title">NUMBERS</h4>
            </div>
            <div class="content">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Label</th>
                      <th>Number</th>
                      <th>Connect To</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Business Number</td>
                      <td>

                     <form action="{{ url('user-portal/changeNumber')}}" method="post" id="submitchangeNumber">
                      {{ csrf_field() }}
                      <select name="number" id="selectNumber" class="form-control" required="required">
                        <option value="">Select Number</option>
                          <option value=""></option>
                      </select>
                     </form>
                      </td>
                      <td>Virtual Receptionist</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <a href="{{url('user-portal/create-extension')}}" class="btn btn-success border-radius">Manage Number</a>

            </div>
            <hr>
            <div class="header">
              <h4 class="title">EXTENSIONS</h4>
            </div>
            <div class="content">
              <div class="table-responsive">
                <table class="table  table-bordered">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Ext.</th>
                      <th>Connect To</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Johan Alam (Me)</td>
                      <td>301</td>
                      <td>Mobile App & +6512345678</td>
                    </tr>

                  </tbody>
                </table>
              </div>
              <a href="{{url('user-portal/call-report')}}" class="btn btn-success border-radius">Manage My Extensions</a>

            </div>
            <hr>

          </div>

        </div>
        <div class="col-lg-6 col-md-6 app-view-mainCol">
          <div class="cards cards-user usage-card">
            <div class="header">
              <h4 class="title">Usage</h4>
            </div>
            <div class="content">
              <form>
                <div class="row">
                  <div class="col-xs-12">
                    <label>Voice mintues</label><span class="pull-right">0 used of 50</span>
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow="0"
                      aria-valuemin="0" aria-valuemax="100">
                        <span class="sr-only">70% Complete</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                    <label>1-to-1 SMS Messages</label><span class="pull-right">0 used of 50</span>
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow="0"
                      aria-valuemin="0" aria-valuemax="100">
                        <span class="sr-only">70% Complete</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                    <label>Allocated Extensions</label><span class="pull-right">1 used of 2</span>
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow="50"
                      aria-valuemin="0" aria-valuemax="100" style="width:50%">
                        <span class="sr-only">50% Complete</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                    <label>Allocated Phone Numbers</label><span class="pull-right">1 used of 1</span>
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow="100"
                      aria-valuemin="0" aria-valuemax="100" style="width:100%">
                        <span class="sr-only">100% Complete</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                    <label>Overage Charges</label><span class="pull-right">0.0 used of 6.0</span>
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow="0"
                      aria-valuemin="0" aria-valuemax="100">
                        <span class="sr-only">0% Complete</span>
                      </div>
                    </div>
                  </div>
                </div>
                <a href="" class="btn btn-success border-radius">Save Usage</a>
              </form>
            </div>


          </div>
            <div style="clear: both;"></div>
        </div>


      </div>
    </div>
  </div>


</div>
@endsection

@section('script')
<script>
function deleteItem(id) {
    if (confirm("Are you sure?")) {

        window.location.href = "{{url('user-portal/stopnumber')}}/"+id;
    }
    return false;
}
$('#selectNumber').change(function(){
  $('#submitchangeNumber').submit();
})
</script>
@endsection
