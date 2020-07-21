@extends('admin.layouts.master')
@section('content')
<style>
.search-row {
  margin: 0;
  /* box-shadow: 0px -1px 1px 1px #ccc; */
  background: transparent;
}
.search-row .col-md-3 {
    align-items: center;
    display: grid;
    height: 183px;
    border-right: 2px solid #afafaf;
}
.search-row .col-md-6 {
    padding: 16px;
}
.form-group {
    margin-bottom: 15px;
}
.search-label label {
    background: #ecebeb;
    padding: 3px 15px 5px;
    border-radius: 2px;
    box-shadow: 1px 0px 3px 1px #ccc;
    margin-right: 10px;
    font-weight: 400;
}
.search-label a {
    color: black;
}
.search-box select {
    margin: 0 5px;
    padding: 3px;
    background: white;
    border-right: 1px solid #aba4a4 !important;
}
.search-box {
    display: -webkit-box;
    display: -ms-inline-flexbox;
}
.search-btn {
  position: absolute;
  top: -15px;
  right: 45px;
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
            <a class="navbar-brand" href="#pablo">Timesheet Details</a>
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
            <div class="card">
              <div class="card-header">
                <!-- <h4 class="card-title"> Clients List <a href="{{url('dashboard/admin/add')}}" style="float:right;font-size: 15px;font-size: 12px; color:white;" type="button" class="btn btn-md btn-primary">Add Customer</a></h4> -->
              </div>

              <div class="card-body">
                <div class="col-md-6">
                  <?php
                  $jan1 = date('Y-01-1');
                  $jan2 =date('Y-01-15');
                  $jan3 =date('Y-01-16');
                  $jan4 =date('Y-m-t', strtotime($jan3));
                  $feb1 = date('Y-02-1');
                  $feb2 =date('Y-02-15');
                  $feb3 =date('Y-02-16');
                  $feb4 = date('Y-m-t', strtotime($feb3));
                  $mar1 = date('Y-03-1');
                  $mar2 =date('Y-03-15');
                  $mar3 =date('Y-03-16');
                  $mar4 =date('Y-m-t', strtotime($mar3));
                  $apr1 = date('Y-04-1');
                  $apr2 =date('Y-04-15');
                  $apr3 =date('Y-04-16');
                  $apr4 =date('Y-m-t', strtotime($apr3));
                  $may1 = date('Y-05-1');
                  $may2 =date('Y-05-15');
                  $may3 =date('Y-05-16');
                  $may4 =date('Y-m-t', strtotime($may3));
                  $jun1 = date('Y-06-1');
                  $jun2 =date('Y-06-15');
                  $jun3 =date('Y-06-16');
                  $jun4 =date('Y-m-t', strtotime($jun3));
                  $jul1 = date('Y-07-1');
                  $jul2 =date('Y-07-15');
                  $jul3 =date('Y-07-16');
                  $jul4 =date('Y-m-t', strtotime($jul3));
                  $aug1 = date('Y-08-1');
                  $aug2 =date('Y-08-15');
                  $aug3 =date('Y-08-16');
                  $aug4 =date('Y-m-t', strtotime($aug3));
                  $sep1 = date('Y-09-1');
                  $sep2 =date('Y-09-15');
                  $sep3 =date('Y-09-16');
                  $sep4 =date('Y-m-t', strtotime($sep3));
                  $oct1 = date('Y-10-1');
                  $oct2 =date('Y-10-15');
                  $oct3 =date('Y-10-16');
                  $oct4 =date('Y-m-t', strtotime($oct3));
                  $nov1 = date('Y-11-1');
                  $nov2 =date('Y-11-15');
                  $nov3 =date('Y-11-16');
                  $nov4 =date('Y-m-t', strtotime($nov3));
                  $dec1 = date('Y-12-1');
                  $dec2 =date('Y-12-15');
                  $dec3 =date('Y-12-16');
                  $dec4 =date('Y-m-t', strtotime($dec3));

                  $jan1_show = date('M d, Y', strtotime($jan1))." - ".date('M d, Y', strtotime($jan2));
                  $jan2_show = date('M d, Y', strtotime($jan3))." - ".date('M d, Y', strtotime($jan4));
                  $feb1_show = date('M d, Y', strtotime($feb1))." - ".date('M d, Y', strtotime($feb2));
                  $feb2_show = date('M d, Y', strtotime($feb3))." - ".date('M d, Y', strtotime($feb4));
                  $mar1_show = date('M d, Y', strtotime($mar1))." - ".date('M d, Y', strtotime($mar2));
                  $mar2_show = date('M d, Y', strtotime($mar3))." - ".date('M d, Y', strtotime($mar4));
                  $apr1_show = date('M d, Y', strtotime($apr1))." - ".date('M d, Y', strtotime($apr2));
                  $apr2_show = date('M d, Y', strtotime($apr3))." - ".date('M d, Y', strtotime($apr4));
                  $may1_show = date('M d, Y', strtotime($may1))." - ".date('M d, Y', strtotime($may2));
                  $may2_show = date('M d, Y', strtotime($may3))." - ".date('M d, Y', strtotime($may4));
                  $jun1_show = date('M d, Y', strtotime($jun1))." - ".date('M d, Y', strtotime($jun2));
                  $jun2_show = date('M d, Y', strtotime($jun3))." - ".date('M d, Y', strtotime($jun4));
                  $jul1_show = date('M d, Y', strtotime($jul1))." - ".date('M d, Y', strtotime($jul2));
                  $jul2_show = date('M d, Y', strtotime($jul3))." - ".date('M d, Y', strtotime($jul4));
                  $aug1_show = date('M d, Y', strtotime($aug1))." - ".date('M d, Y', strtotime($aug2));
                  $aug2_show = date('M d, Y', strtotime($aug3))." - ".date('M d, Y', strtotime($aug4));
                  $sep1_show = date('M d, Y', strtotime($sep1))." - ".date('M d, Y', strtotime($sep2));
                  $sep2_show = date('M d, Y', strtotime($sep3))." - ".date('M d, Y', strtotime($sep4));
                  $oct1_show = date('M d, Y', strtotime($oct1))." - ".date('M d, Y', strtotime($oct2));
                  $oct2_show = date('M d, Y', strtotime($oct3))." - ".date('M d, Y', strtotime($oct4));
                  $nov1_show = date('M d, Y', strtotime($nov1))." - ".date('M d, Y', strtotime($nov2));
                  $nov2_show = date('M d, Y', strtotime($nov3))." - ".date('M d, Y', strtotime($nov4));
                  $dec1_show = date('M d, Y', strtotime($dec1))." - ".date('M d, Y', strtotime($dec2));
                  $dec2_show = date('M d, Y', strtotime($dec3))." - ".date('M d, Y', strtotime($dec4));
                  // dd($jan1_show);
                   ?>
                  <select class="form-control" name="time_period" id="time_period">
                    <option value="{{$jan1_show}}" {{$period == $jan1_show ? 'selected="selected"' : ''}}>{{$jan1_show}}</option>
                    <option value="{{$jan2_show}}" {{$period == $jan2_show ? 'selected="selected"' : ''}}>{{$jan2_show}}</option>
                    <option value="{{$feb1_show}}" {{$period == $feb1_show ? 'selected="selected"' : ''}}>{{$feb1_show}}</option>
                    <option value="{{$feb2_show}}" {{$period == $feb2_show ? 'selected="selected"' : ''}}>{{$feb2_show}}</option>
                    <option value="{{$mar1_show}}" {{$period == $mar1_show ? 'selected="selected"' : ''}}>{{$mar1_show}}</option>
                    <option value="{{$mar2_show}}" {{$period == $mar2_show ? 'selected="selected"' : ''}}>{{$mar2_show}}</option>
                    <option value="{{$apr1_show}}" {{$period == $apr1_show ? 'selected="selected"' : ''}}>{{$apr1_show}}</option>
                    <option value="{{$apr2_show}}" {{$period == $apr2_show ? 'selected="selected"' : ''}}>{{$apr2_show}}</option>
                    <option value="{{$may1_show}}" {{$period == $may1_show ? 'selected="selected"' : ''}}>{{$may1_show}}</option>
                    <option value="{{$may2_show}}" {{$period == $may2_show ? 'selected="selected"' : ''}}>{{$may2_show}}</option>
                    <option value="{{$jun1_show}}" {{$period == $jun1_show ? 'selected="selected"' : ''}}>{{$jun1_show}}</option>
                    <option value="{{$jun2_show}}" {{$period == $jun2_show ? 'selected="selected"' : ''}}>{{$jun2_show}}</option>
                    <option value="{{$jul1_show}}" {{$period == $jul1_show ? 'selected="selected"' : ''}}>{{$jul1_show}}</option>
                    <option value="{{$jul2_show}}" {{$period == $jul2_show ? 'selected="selected"' : ''}}>{{$jul2_show}}</option>
                    <option value="{{$aug1_show}}" {{$period == $aug1_show ? 'selected="selected"' : ''}}>{{$aug1_show}}</option>
                    <option value="{{$aug2_show}}" {{$period == $aug2_show ? 'selected="selected"' : ''}}>{{$aug2_show}}</option>
                    <option value="{{$sep1_show}}" {{$period == $sep1_show ? 'selected="selected"' : ''}}>{{$sep1_show}}</option>
                    <option value="{{$sep2_show}}" {{$period == $sep2_show ? 'selected="selected"' : ''}}>{{$sep2_show}}</option>
                    <option value="{{$oct1_show}}" {{$period == $oct1_show ? 'selected="selected"' : ''}}>{{$oct1_show}}</option>
                    <option value="{{$oct2_show}}" {{$period == $oct2_show ? 'selected="selected"' : ''}}>{{$oct2_show}}</option>
                    <option value="{{$nov1_show}}" {{$period == $nov1_show ? 'selected="selected"' : ''}}>{{$nov1_show}}</option>
                    <option value="{{$nov2_show}}" {{$period == $nov2_show ? 'selected="selected"' : ''}}>{{$nov2_show}}</option>
                    <option value="{{$dec1_show}}" {{$period == $dec1_show ? 'selected="selected"' : ''}}>{{$dec1_show}}</option>
                    <option value="{{$dec2_show}}" {{$period == $dec2_show ? 'selected="selected"' : ''}}>{{$dec2_show}}</option>
                    <!-- <option value="">{{date('M d, Y', strtotime($dec3))}} - {{date('M d, Y', strtotime($dec4))}}</option> -->
                  </select>
                </div>
                <div class="table-responsive">
                  @if(session()->has('message'))
                    <div class="row">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <strong>Message:</strong>{{session()->get('message')}}
                      </div>
                    </div>
                  @endif
                  <div class="show_data">
                    <table class="table" style="margin-top:30px;">
                      <thead class=" text-primary">

                      </thead>
                      <tbody>
                        <tr>
                          <td>Tutor Name</td>
                          <td  style="border-left: 1px solid #ccc;">
                            {{$tutor->first_name}} {{$tutor->last_name}}
                          </td>
                        </tr>
                        <tr>
                          <td>Pay Period</td>
                          <td style="border-left: 1px solid #ccc;">{{$period}}</td>
                        </tr>
                        <?php
                        $sum='';
                        ?>
                        @foreach($earnings as $earning)
                        <tr>
                          <td>{{SCT::getClientName($earning->user_id)->first_name}} {{SCT::getClientName($earning->user_id)->last_name}}
                            @if(SCT::checkFirstEarning($earning->user_id,$earning->tutor_id) == 0)
                            Earnings*
                            @else
                            Earnings
                            @endif
                          </td>
                          <td style="border-left: 1px solid #ccc;">{{$earning->earning}} $</td>
                        </tr>
                        <?php
                        $sum = (float)$sum+(float)$earning->earning;
                        // dd($sum);
                        ?>
                        @endforeach
                        <tr  style="border-bottom: 1px solid #ccc;">
                          <td><strong>Total Earnings</strong></td>
                          @if($sum != '')
                          <td  style="border-left: 1px solid #ccc;"><strong>{{$sum}} $</strong></td>
                          @else
                          <td style="border-left: 1px solid #ccc;"><strong>0 $</strong></td>
                          @endif
                        </tr>
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
                          <form method="post" action="{{ url('dashboard/delete-timesheet') }}">
                              <input type="hidden" name="_method" value="delete">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <input type="hidden" name="timesheet_id" class="actionId">
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
function deleteTimesheet(userId){
    $('.actionId').val(userId);
    $('#modal-warning').modal();
}
function doAction(){
    var userId = $('.actionId').val();
    if(userId != ''){
        alert('delete this '+userId);
    }
}

$('#time_period').on('change',function () {
  var period = $(this).val();
  var tutor_id = "{{Request::segment(3)}}";
  // alert(period);
  $.ajaxSetup({
   headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
 });
 $.ajax({
         type: "POST",
         url: "{{ url('dashboard/tutor_reports_ajax') }}",
         data: {tutor_id:tutor_id,period:period},
         success: function(data){
           $('.show_data').html(data);

           // console.log(data);
         }

   });
});
</script>
@endsection
