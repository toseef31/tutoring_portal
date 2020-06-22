@extends('frontend.dashboard.layout.master')

@section('title', 'Disposition of Call Report')

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
        <a class="navbar-brand" href="#">Disposition Of Call Report</a>
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
              <h3 class="title">Enter Call Report</h3>
              <hr>
            </div> <br>
            <div class="content">
            	<form action="" method="post">
            		<div class="form-group">
            			<label>Enter nature of call</label>
            			<select class="form-controls border-input" name="call_nature" id="callType">
            				<option>This is inquiry call</option>
            				<option>This is a call to check the stock of items</option>
            				<option>This is a call from the supplier</option>
            				<option>This is a call from a customer</option>
            				<option>This is hot sales call</option>
            				<option value="other">Other...</option>
            			</select>
            			<input type="text" name="call_nature" id="other" class="form-controls border-input" style="display: none;">
            		</div>
            		<div class="form-group text-right">
            			<input type="submit" class="btn btn-primary" name="" value="Submit Nature">
            		</div>
            	</form>
            </div>
            <hr>
            <div class="header">
              <h3 class="title">Call Detail</h3>
              <hr>
            </div>
            <div class="content">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Incoming Calls</th>
                      <th>Outgoing Calls</th>
                      <th>Internal Calls</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>5</td>
                      <td>10</td>
                      <td>15</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <hr>

            <!-- <div class="header">
              <h4 class="title">Incoming Call Status</h4>
            </div>
            <div class="content">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Call Status</th>
                      <th>Total Calls</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Waiting</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>Answered</td>
                      <td>4</td>
                    </tr>
                    <tr>
                      <td>Missed</td>
                      <td>1</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div> -->
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
	$('#callType').change(function(){
		alert("ghfdsgfsjhd");
		if($(this).val() == 'other'){
			$('#other').css('display', 'block');
		}
	});
	function checkvalue(val)
{
	alert(val);
    if(val==="other")
       document.getElementById('other').style.display='block';
    else
       document.getElementById('other').style.display='none'; 
}
</script>
@endsection
