@extends('admin.layouts.master')
@section('content')
<style>
img{ max-width:100%;}
.inbox_people {
background: #f8f8f8 none repeat scroll 0 0;
float: left;
overflow: hidden;
width: 100%; border-right:1px solid #c4c4c4;
}
.inbox_msg {
border: 1px solid #c4c4c4;
clear: both;
overflow: hidden;
}
.top_spac{ margin: 20px 0 0;}


.recent_heading {float: left; width:40%;}
.srch_bar {
display: inline-block;
text-align: right;
width: 60%; padding:
}
.headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

.recent_heading h4 {
color: #05728f;
font-size: 21px;
margin: auto;
}
.srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
.srch_bar .input-group-addon button {
background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
border: medium none;
padding: 0;
color: #707070;
font-size: 18px;
}
.srch_bar .input-group-addon { margin: 0 0 0 -27px;}

.chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}
.chat_ib h5 span{ font-size:13px; float:right;}
.chat_ib p{ font-size:14px; color:#989898; margin:auto}
.chat_img {
float: left;
width: 11%;
}
.chat_ib {
float: left;
padding: 0 0 0 15px;
width: 88%;
}

.chat_people{ overflow:hidden; clear:both;}
.chat_list {
border-bottom: 1px solid #c4c4c4;
margin: 0;
padding: 18px 16px 10px;
}
.inbox_chat { height: 550px; overflow-y: scroll;}

.active_chat{ background:#ebebeb;}

.incoming_msg_img {
display: inline-block;
width: 6%;
}
.received_msg {
display: inline-block;
padding: 0 0 0 10px;
vertical-align: top;
width: 92%;
}
.received_withd_msg p {
background: #ebebeb none repeat scroll 0 0;
border-radius: 3px;
color: #646464;
font-size: 14px;
margin: 0;
padding: 5px 10px 5px 12px;
width: 100%;
}
.time_date {
color: #747474;
display: block;
font-size: 12px;
margin: 8px 0 0;
}
.received_withd_msg { width: 57%;}
.mesgs {
float: left;
padding: 30px 15px 0 25px;
width: 60%;
}

.sent_msg p {
background: #05728f none repeat scroll 0 0;
border-radius: 3px;
font-size: 14px;
margin: 0; color:#fff;
padding: 5px 10px 5px 12px;
width:100%;
}
.outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
.sent_msg {
float: right;
width: 46%;
}
.input_msg_write input {
background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
border: medium none;
color: #4c4c4c;
font-size: 15px;
min-height: 48px;
width: 100%;
}

.type_msg {border-top: 1px solid #c4c4c4;position: relative;}
.msg_send_btn {
background: #05728f none repeat scroll 0 0;
border: medium none;
border-radius: 50%;
color: #fff;
cursor: pointer;
font-size: 17px;
height: 33px;
position: absolute;
right: 0;
top: 11px;
width: 33px;
}
.messaging { padding: 0 0 50px 0;}
.msg_history {
height: 516px;
overflow-y: auto;
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
            <a class="navbar-brand" href="#pablo">Agreements List</a>
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
                <h4 class="card-title"> Agreements List <a href="{{url('dashboard/agreement/add')}}" style="float:right;font-size: 15px;font-size: 12px; color:white;" type="button" class="btn btn-md btn-primary">Add Agreement</a></h4>
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
                      <th>Name</th>
                      <th>Send Agreement</th>
                      <th class="text-right">Action</th>
                    </thead>
                    <tbody>
                    @foreach($all_agreement as $agreement)
                      <tr>
                        <td> {{$agreement->aggreement_name}}</td>
                        <td>
                          <a href="javascript:0;" class="btn btn-primary" onclick="GetUsers('{{ $agreement->aggreement_id }}')"> Send </a>
                         </td>
                        <td class="text-right">
                          <a href="{{url('/dashboard/agreement/edit/'.$agreement->aggreement_id)}}" data-toggle="tooltip" data-original-title="Update"><i class="fa fa-edit text-primary"></i></a>
                          <!-- <i class="fa fa-eye text-success"></i> -->
                          <a href="javascript:0;" onclick="deleteEmployer('{{ $agreement->aggreement_id }}')"> <i class="fa fa-trash text-danger"></i> </a>
                        </td>
                      </tr>
                      @endforeach

                    </tbody>
                  </table>
                  {{$all_agreement->render()}}
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
                          <form method="post" action="{{ url('dashboard/agreement/delete') }}">
                              <input type="hidden" name="_method" value="delete">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <input type="hidden" name="aggreement_id" class="actionId">
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
  <div class="show_modal">

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
function GetUsers(id){
  // alert(id);
   $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
          type: "get",
          url: "{{ url('dashboard/get_all_user') }}/"+id,
          // data:{id:id,value:value},
          success: function(response){
            $('.show_modal').html(response);
            $('#modal-warning2').modal();

          }

    });
}

function sendAgreement(id,user_id) {
  // alert(id+','+user_id);
  var temp = "<button class='btn btn-success' disabled>Sent</button>"
  $('.user-'+user_id).removeClass('btn btn-primary');
  $('.user-'+user_id).html(temp);
  $.ajax({
          type: "get",
          url: "{{ url('dashboard/sendAgreement') }}/"+id+'/'+user_id,
          // data:{id:id,value:value},
          success: function(response){
            // $('.show_modal').html(response);
            // $('#modal-warning2').modal();


          }

    });
}

</script>
@endsection
