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

            </div>
          </div>
          <div class="inbox_chat">
            <div class="" id="tutors">
              @foreach($tutors as $tutor)
              <div class="chat_list" style="position:relative;">
                <div class="chat_people">
                  <div class="chat_img"> <img src="{{asset('frontend-assets/images/user-profile.png')}}" alt="sunil"> </div>
                  <div class="chat_ib">
                    @if(SCT::checkTutorAssign($id,$tutor->id) !='')
                    <h5>{{$tutor->first_name}} {{$tutor->last_name}}
                      <span class="tutor-{{$tutor->id}}"><a href="javascript:void(0);" onclick="DeleteAssignTutor({{$id}},{{$tutor->id}})" class="btn btn-danger user-{{$tutor->id}}">Delete</a> </span></h5>
                    <div class="rating-div-{{$tutor->id}}">
                      <span class="heading_rate">Hourly Pay Rate</span><span class="amount_show">{{SCT::checkTutorAssign($id,$tutor->id)->hourly_pay_rate}}$</span>
                    </div>
                    <div class="rating2-div-{{$tutor->id}}">

                    </div>
                    @else
                    <h5>{{$tutor->first_name}} {{$tutor->last_name}} <span class="tutor-{{$tutor->id}}"><a href="javascript:void(0);" onclick="AssignTutor({{$id}},{{$tutor->id}})" class="btn btn-primary user-{{$tutor->id}}">Assign</a></span></h5>
                     <div class="rating-div-{{$tutor->id}}">
                       <span class="heading_rate">Hourly Pay Rate</span> <input type="text" class="form-control heading_input rate-{{$tutor->id}}" id="rate-{{$tutor->id}}" name="pay_rate" placeholder="Amount" value=""></span>
                     </div>
                     <div class="rating2-div-{{$tutor->id}}">

                     </div>
                    @endif

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
