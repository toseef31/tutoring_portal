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
                    @if($customer['user_image'] != '')
                    <?php
                    $profilePhoto = url('frontend-assets/images/dashboard/profile-photos/'.$user['user_image']);
                     ?>
                  @endif

          <form class="form-horizontal employers-form" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="hidden" name="customer_id" value="{{ $customer->id }}">

              <div class="form-group">
                  <label class="control-label col-md-3 text-right">&nbsp;</label>
                  <div class="col-md-6">
                      Required fields are marked *
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-3 text-right">First Name : *</label>
                  <div class="col-md-6">
                      <input type="text" class="form-control" name="first_name" required="" value="{{ $customer->first_name }}">
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-3 text-right">Last Name : *</label>
                  <div class="col-md-6">
                      <input type="text" class="form-control" name="last_name" required="" value="{{ $customer->last_name }}">
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-3 text-right">Email : *</label>
                  <div class="col-md-6">
                      <input type="email" class="form-control" name="email" required="" value="{{ $customer->email }}">
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-3 text-right">Phone : *</label>
                  <div class="col-md-6">
                      <input type="text" class="form-control" name="phone" required="" value="{{ $customer->phone }}">
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-3 text-right">Address : *</label>
                  <div class="col-md-6">
                      <input type="text" class="form-control" name="address" required="" value="{{ $customer->address }}">
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-3 text-right">City : *</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control border-input" placeholder="Enter City" id="city" name="city" required="" value="{{ $customer->city}}">
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-3 text-right">State : *</label>
                  <div class="col-md-6">
                    <select class="form-control border-input" name="state" id="state">
                      <option value="Alabama" {{$customer->state == 'Alabama' ? 'selected=="selected"':''}}>Alabama</option>
                      <option value="Alaska" {{$customer->state == 'Alaska' ? 'selected=="selected"':''}}>Alaska</option>
                      <option value="Arizona" {{$customer->state == 'Arizona' ? 'selected=="selected"':''}}>Arizona</option>
                      <option value="Arkansas" {{$customer->state == 'Arkansas' ? 'selected=="selected"':''}}>Arkansas</option>
                      <option value="California" {{$customer->state == 'California' ? 'selected=="selected"':''}}>California</option>
                      <option value="Colorado" {{$customer->state == 'Colorado' ? 'selected=="selected"':''}}>Colorado</option>
                      <option value=" Connecticut" {{$customer->state == 'Connecticut' ? 'selected=="selected"':''}}> Connecticut</option>
                      <option value="Delaware" {{$customer->state == 'Delaware' ? 'selected=="selected"':''}}>Delaware</option>
                      <option value="Florida" {{$customer->state == 'Florida' ? 'selected=="selected"':''}}>Florida</option>
                      <option value="Georgia" {{$customer->state == 'Georgia' ? 'selected=="selected"':''}}> Georgia</option>
                      <option value="Hawaii" {{$customer->state == 'Hawaii' ? 'selected=="selected"':''}}>Hawaii</option>
                      <option value="Idaho" {{$customer->state == 'Idaho' ? 'selected=="selected"':''}}>Idaho</option>
                      <option value="Illinois" {{$customer->state == 'Illinois' ? 'selected=="selected"':''}}>Illinois</option>
                      <option value="Indiana" {{$customer->state == 'Indiana' ? 'selected=="selected"':''}}>Indiana</option>
                      <option value="Iowa" {{$customer->state == 'Iowa' ? 'selected=="selected"':''}}>Iowa</option>
                      <option value="Kansas" {{$customer->state == 'Kansas' ? 'selected=="selected"':''}}>Kansas</option>
                      <option value="Kentucky" {{$customer->state == 'Kentucky' ? 'selected=="selected"':''}}>Kentucky</option>
                      <option value="Louisiana" {{$customer->state == 'Louisiana' ? 'selected=="selected"':''}}>Louisiana</option>
                      <option value="Maine" {{$customer->state == 'Maine' ? 'selected=="selected"':''}}>Maine</option>
                      <option value="Maryland" {{$customer->state == 'Maryland' ? 'selected=="selected"':''}}>Maryland</option>
                      <option value="Massachusetts" {{$customer->state == 'Massachusetts' ? 'selected=="selected"':''}}>Massachusetts</option>
                      <option value="Michigan" {{$customer->state == 'Michigan' ? 'selected=="selected"':''}}>Michigan</option>
                      <option value="Minnesota" {{$customer->state == 'Minnesota' ? 'selected=="selected"':''}}>Minnesota</option>
                      <option value="Mississippi" {{$customer->state == 'Mississippi' ? 'selected=="selected"':''}}>Mississippi</option>
                      <option value="Missouri" {{$customer->state == 'Missouri' ? 'selected=="selected"':''}}>Missouri</option>
                      <option value="Montana" {{$customer->state == 'Montana' ? 'selected=="selected"':''}}>Montana</option>
                      <option value="Nebraska" {{$customer->state == 'Nebraska' ? 'selected=="selected"':''}}>Nebraska</option>
                      <option value="Nevada" {{$customer->state == 'Nevada' ? 'selected=="selected"':''}}>Nevada</option>
                      <option value="New Hampshire" {{$customer->state == 'New Hampshire' ? 'selected=="selected"':''}}>New Hampshire</option>
                      <option value="New Jersey" {{$customer->state == 'New Jersey' ? 'selected=="selected"':''}}>New Jersey</option>
                      <option value="New Mexico" {{$customer->state == 'New Mexico' ? 'selected=="selected"':''}}>New Mexico</option>
                      <option value="New York" {{$customer->state == 'New York' ? 'selected=="selected"':''}}>New York</option>
                      <option value="North Carolina" {{$customer->state == 'North Carolina' ? 'selected=="selected"':''}}>North Carolina</option>
                      <option value="North Dakota" {{$customer->state == 'North Dakota' ? 'selected=="selected"':''}}>North Dakota</option>
                      <option value="Ohio" {{$customer->state == 'Ohio' ? 'selected=="selected"':''}}>Ohio</option>
                      <option value="Oklahoma" {{$customer->state == 'Oklahoma' ? 'selected=="selected"':''}}>Oklahoma</option>
                      <option value="Oregon" {{$customer->state == 'Oregon' ? 'selected=="selected"':''}}>Oregon</option>
                      <option value="Pennsylvania" {{$customer->state == 'Pennsylvania' ? 'selected=="selected"':''}}>Pennsylvania</option>
                      <option value="Rhode Island" {{$customer->state == 'Rhode Island' ? 'selected=="selected"':''}}>Rhode Island</option>
                      <option value="South Carolina" {{$customer->state == 'South Carolina' ? 'selected=="selected"':''}}>South Carolina</option>
                      <option value="South Dakota" {{$customer->state == 'South Dakota' ? 'selected=="selected"':''}}>South Dakota</option>
                      <option value="Tennessee" {{$customer->state == 'Tennessee' ? 'selected=="selected"':''}}>Tennessee</option>
                      <option value="Texas" {{$customer->state == 'Texas' ? 'selected=="selected"':''}}>Texas</option>
                      <option value="Utah" {{$customer->state == 'Utah' ? 'selected=="selected"':''}}>Utah</option>
                      <option value="Vermont" {{$customer->state == 'Vermont' ? 'selected=="selected"':''}}>Vermont</option>
                      <option value="Virginia" {{$customer->state == 'Virginia' ? 'selected=="selected"':''}}>Virginia</option>
                      <option value="Washington" {{$customer->state == 'Washington' ? 'selected=="selected"':''}}>Washington</option>
                      <option value="West Virginia" {{$customer->state == 'West Virginia' ? 'selected=="selected"':''}}>West Virginia</option>
                      <option value="Wisconsin" {{$customer->state == 'Wisconsin' ? 'selected=="selected"':''}}>Wisconsin</option>
                      <option value="Wyoming" {{$customer->state == 'Wyoming' ? 'selected=="selected"':''}}>Wyoming</option>
                    </select>
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-3 text-right">Zip Code : *</label>
                  <div class="col-md-6">
                      <input type="text" name="zip" class="form-control border-input" placeholder="Enter Zip Code" id="zip" value="{{ $customer->zip}}">
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-3 text-right">Time Zone : *</label>
                  <div class="col-md-6">
                    <select class="form-control border-input" name="time_zone" id="time_zone">
                      <option value="Pacific Time" {{$customer->time_zone == 'Pacific Time' ? 'selected=="selected"':''}}>Pacific Time</option>
                      <option value="Mountain Time" {{$customer->time_zone == 'Mountain Time' ? 'selected=="selected"':''}}>Mountain Time</option>
                      <option value="Central Time" {{$customer->time_zone == 'Central Time' ? 'selected=="selected"':''}}>Central Time</option>
                      <option value="Eastern Time" {{$customer->time_zone == 'Eastern Time' ? 'selected=="selected"':''}}>Eastern Time</option>
                    </select>
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-3 text-right">Password : *</label>
                  <div class="col-md-6">
                      <input type="password" class="form-control" name="password" value="">
                  </div>
              </div>
              <?php
              $credit_id = '';
              $credit_cost = '';
              $credit_balance= '';
              if ($credit !='') {
                $credit_id = $credit->credit_id;
                $credit_cost = $credit->credit_cost;
                $credit_balance = $credit->credit_balance;
              }
               ?>
              <input type="hidden" name="credit_id" value="{{$credit_id}}">
              <div class="form-group">
                  <label class="control-label col-md-3 text-right">Credit Cost : *</label>
                  <div class="col-md-6">
                      <input type="text" class="form-control" name="credit_cost" value="{{$credit_cost}}" placeholder="Credit Cost">
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-3 text-right">Credit Balance : *</label>
                  <div class="col-md-6">
                      <input type="text" class="form-control" name="credit_balance" value="{{$credit_balance !='' ? $credit_balance:0}}" placeholder="Credit Balance">
                  </div>
              </div>
              <div class="form-group">
                <!-- <label class="form-check-label control-label col-md-3 text-right"></label> -->
                  <label class="control-label col-md-3 text-right"></label>
                  <div class="col-md-6">
                      <input class="form-check-input" type="checkbox" name="automated_email" id="automated_email" value="1" {{$customer->automated_email =='Subscribe' ? 'checked':''}}> <span style="margin-left: 20px;">Subscribe to Automated Emails</span>
                  </div>

              </div>
              <!-- <div class="form-group radio-div">
                  <label class="control-label col-md-3 text-right">Role :</label>
                  <div class="col-md-6 radio-div">
                      <label class="custom-control custom-control-primary custom-radio">
                          <input name="role" class="custom-control-input" type="radio" value="admin" {{ $customer->role == 'admin' ? 'checked="checked"' : '' }}>
                          <span class="custom-control-indicator"></span>
                          <span class="custom-control-label">Customer</span>
                      </label>
                      <label class="custom-control custom-control-primary custom-radio" style="margin-left:20px;">
                          <input name="role" class="custom-control-input" type="radio" value="tutor" {{ $customer->role == 'tutor' ? 'checked="checked"' : '' }}>
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
                          <label class="control-label col-md-3 text-right">Name : *</label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="first_name" required="">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 text-right">Email : *</label>
                          <div class="col-md-6">
                              <input type="email" class="form-control" name="email" required="">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 text-right">password : *</label>
                          <div class="col-md-6">
                              <input type="password" class="form-control" name="password">
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
                          <label class="control-label col-md-3 text-right">Credit Cost : *</label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="dollar_cost" value="" placeholder="Credit Cost">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 text-right">Credit Balance : *</label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="credit" value="" placeholder="Credit Balance">
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
