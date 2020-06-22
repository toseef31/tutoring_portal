@if( \Session::has('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
  {{ \Session::get('success')}}
</div>
@endif
@if( \Session::has('red-alert'))
<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert">×</button>
  {{ \Session::get('red-alert')}}
</div>
@endif