
@extends('frontend.dashboard.layout.master')

<style type="text/css">

    #left
    {
        background-color:#f4f3ef; height: 500px; margin:15px; margin-left: 10px;
        box-shadow: 2px 2px 2px 2px lightgrey;

    }
    #right
    {
        background-color:#f4f3ef; margin:10px; margin-right: 15px;
        box-shadow: 2px 2px 2px 2px lightgrey;
    }

    @media screen and (max-width: 992px) {

        .main
        {
            width:100%;
            height: 100%;
        }
        #left
        {
            padding-top: 5%;
            align-content: center;
            align-items:center;



        }
        #right
        {
            align-content: center;
            align-items:center;

        }
    }
    @media screen and (max-width: 768px) {



       .main
       {
        width:100%;
           height: 100%;
       }
        #left {
            padding-top: 10%;

        }
        #right
        {
            padding-bottom: 7%;

        }


    }

    @media screen and (max-width: 320px)
    {

        .main
        {
            width:320px ;
            height: 100%;
        }
        #left {
            padding-top: 10%;

        }
        #right
        {
            padding-bottom: 7%;

        }



    }
</style>
@section('content')
<div class="container">
    @if(count($errors))
        <div class="form-group">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <div class="row">
<div  class="col-md-8 " id="left" style="">
    <p>Have queries? We are here to help!</p><br>
</div>
<div class="col-md-3 " id="right" style="">

    <div class="company-box-right">
        <h4>Contact Details</h4>
        <hr>
        <div class="row">
            <div class="col-md-3"><strong>Phone</strong></div>
            <div class="col-md-9">8222058013</div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3"><strong>Email</strong></div>
            <div class="col-md-9"><a href="#">info@jobcallme.com</a> </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3"><strong>Address</strong></div>
            <div class="col-md-9">
              <span>서울시 서초구 논현로 27길 39 천일 빌딩 2층 대한민국 06746</span>
        </div>
    </div>
        <div class="company-box-right">
            <h3>Have queries? We are here to help!</h3>

            <hr>

            <form class="contact-us-form" method="post" action="{{url('/contact')}}" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="email" placeholder="Enter your email" id="feedemail" class="form-control" name="email" style="margin-bottom:10px">
                    <select class="form-control" name="type" id="feedtype">
                        <option>Select type</option>
                        <option>Bug Report</option>
                        <option>Feature Report</option>
                        <option>Feedback</option>
                        <option>Testimonial</option>

                    </select>
                </div>
                <div class="form-group">

                    <textarea class="form-control" id="transcript12" name="message" style="resize: vertical;" placeholder="Detail..." rows="10" required=""></textarea>

                    <div style="text-align: center;">
                        <label class="search-bar" style="text-align: center;padding-top:10px;" onclick="feedbackDictation()"><i class="fa fa-microphone" style="color:#e6b706;font-size:17px;" title="Voice Search
Tell After Click"></i></label>
                    </div>

                </div>
                <div class="form-group">
                    <button class="btn btn-block btn-primary" type="submit" name="submit">Submit</button>
                </div>
            </form>
        </div>

</div>
</div>
</div>
</div>

    <script type="text/javascript">
        function feedbackDictation() {

            if (window.hasOwnProperty('webkitSpeechRecognition')) {

                var recognition = new webkitSpeechRecognition();

                recognition.continuous = false;
                recognition.interimResults = false;

                recognition.lang = 'en';
                recognition.start();

                recognition.onresult = function(e) {
                    console.log(e.results[0][0].transcript);
                    document.getElementById('transcript12').value
                        = e.results[0][0].transcript;

                    recognition.stop();
                    //document.getElementById('labnol').submit();
                };

                recognition.onerror = function(e) {
                    recognition.stop();
                }

            }
        }




        </script>
@endsection


