<div id="modal-warning2" role="dialog" class="modal show" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content animated bounceIn">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="messaging">
          <div class="inbox_msg">
            <div class="inbox_people">
              <div class="headind_srch">
                <!-- <div class="recent_heading">
                <h4>Recent</h4>
              </div> -->
              <div class="srch_bar">
                <!-- <div class="stylish-input-group">
                <input type="text" class="search-bar"  placeholder="Search" >
                <span class="input-group-addon">
                <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
              </span> </div> -->
              <div class="form-group">
                <div class="radio-div" style="display:flex">
                  <label class="custom-control custom-control-primary custom-radio">
                    <input name="role" class="custom-control-input" type="radio" value="client" checked>
                    <span class="custom-control-indicator"></span>
                    <span class="custom-control-label">Client</span>
                  </label>
                  <label class="custom-control custom-control-primary custom-radio" style="margin-left:20px;">
                    <input name="role" class="custom-control-input" type="radio" value="tutor">
                    <span class="custom-control-indicator"></span>
                    <span class="custom-control-label">Tutor</span>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="inbox_chat">
            <div class="" id="client">
            @foreach($clients as $client)
            <div class="chat_list">
              <div class="chat_people">
                <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                <div class="chat_ib">
                  @if(SCT::checkAggrementSend($id,$client->id) !='')
                  <h5>{{$client->first_name}} {{$client->last_name}} <span><button class="btn btn-success" disabled>Sent</button> </span></h5>
                  @else
                  <h5>{{$client->first_name}} {{$client->last_name}} <span><a href="javascript:void(0);" onclick="sendAgreement({{$id}},{{$client->id}})" class="btn btn-primary user-{{$client->id}}">Request Signature</a> </span></h5>
                  @endif
                  <!-- <h5>{{$client->first_name}} {{$client->last_name}} <span><a href="{{url('/dashboard/sendAgreement/'.$id.'/'.$client->id)}}" class="btn btn-primary">Request Signature</a> </span></h5> -->
                  @if($client->role == 'customer')
                  <p>Client</p>
                  @else
                  <p>Tutor</p>
                  @endif
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <div class="" id="tutors">
            @foreach($tutors as $tutor)
            <div class="chat_list">
              <div class="chat_people">
                <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                <div class="chat_ib">
                  @if(SCT::checkAggrementSend($id,$tutor->id) !='')
                  <h5>{{$tutor->first_name}} {{$tutor->last_name}} <span><button class="btn btn-success" disabled>Sent</button> </span></h5>
                  @else
                  <h5>{{$tutor->first_name}} {{$tutor->last_name}} <span><a href="javascript:void(0);" onclick="sendAgreement({{$id}},{{$tutor->id}})" class="btn btn-primary user-{{$tutor->id}}">Request Signature</a> </span></h5>
                  @endif
                  <!-- <h5>{{$tutor->first_name}} {{$tutor->last_name}} <span><a href="{{url('/dashboard/sendAgreement/'.$id.'/'.$tutor->id)}}" class="btn btn-primary">Request Signature</a> </span></h5> -->
                  @if($tutor->role == 'customer')
                  <p>Client</p>
                  @else
                  <p>Tutor</p>
                  @endif
                </div>
              </div>
            </div>
            @endforeach
          </div>

          </div>
        </div>

      </div>
    </div>
  </div>
  <div class="modal-footer"></div>
</div>
</div>
</div>
<script>
$('#tutors').hide();
$("input[name=role]").click(function () {
	if ($('input[name=role]:checked').val() == "client") {
		$('#client').show();
		$('#tutors').hide();

	} else {
    $('#client').hide();
		$('#tutors').show();

	}
});
</script>
