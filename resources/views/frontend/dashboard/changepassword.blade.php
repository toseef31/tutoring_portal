@extends('frontend.dashboard.layout.master')

@section('title', 'Change Password')

@section('styling')
<style>
.field-icon {
  float: right;
  right: 10px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
}
</style>
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
        <a class="navbar-brand" href="#">Change Password</a>
      </div>
      
    </div>
  </nav>
  <div class="content">
    <div class="container-fluid app-view-mainCol">
      <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
          <div class="cards">
            
            <div class="content">
              <form class="form-change">
                {{ csrf_field() }}
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Enter Current Password</label>
                      <input id="password-field" type="password" class="form-controls border-input" name="oldpass" placeholder="Enter Current Password" required>
                      
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Password:</label>
                      <input type="password" name="password" id="pwd" onkeyup='checklen();' class="form-control" placeholder="Enter Password" required maxlength="15">
                      
                      <span toggle="#password-field" class="fa fa-fw fa-eye-slash field-icon " id="toggle-passwords"></span>
                    </div>
                    <button type="submit" class="btn btn-info btn-fill btn-wd" style="float:right">Change Password</button>
                  </div>
                  
                </div>
                
              </form>
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
  
  $('#toggle-passwords').click(function(){
    
    if($('#pwd').attr("type") == "text"){
      $('#pwd').attr('type', 'password');
      $('#toggle-passwords').addClass( "fa-eye-slash" );
      $('##toggle-passwords').removeClass( "fa-eye" );
    }else if($('#pwd').attr("type") == "password"){
      $('#pwd').attr('type', 'text');
      $('#toggle-passwords').removeClass( "fa-eye-slash" );
      $('#toggle-passwords').addClass( "fa-eye" );
    }
  });

</script>
@endsection