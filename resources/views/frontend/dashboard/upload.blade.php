@extends('frontend.dashboard.layout.master')

@section('title', 'Listing')

@section('styling')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend-assets/css/dashboard.css') }}">
    <style type="text/css">
        #Category{
            margin-top: 20px;
            margin-bottom: 10px;
            width: 180px;
            margin-right: 80px;

        }

        #user_image{
            margin-top: 10px;
            border: 10px;
            margin-bottom: 30px;
            padding: 30px;
            margin-left: 40px;

        }
        #user_upload{
            text-align: center;
            height: 800px;
        }
        #upload_video{
            width: 400px;
            margin-left: 300px;
        }
        #youtube_link{
            width: 400px;
            margin-left: 280px;
        }
        #upload_image{
            width: 400px;
            margin-left: 300px;
            margin-right: 300px;
            height: 100px;
            width:100px;
        }

        #picture{
            height: 100px;
            width:100px;
        }
        .gallery img{
            width: 100%;
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
                    <a class="navbar-brand" href="#">Upload</a>
                </div>

            </div>
        </nav>

<div>



    <div class="content">
        <div class="container-fluid app-view-mainCol">
            <div class="row">

                <div class="cards">
                    <div class="row" style="margin: 0">
                        <div class="col-md-12 app-view-mainCol">
                            <div class="table-responsive" style="margin-top: 15px;">


                                <div class="form-group col-lg-12">

                                    <div class="col-md-12" >
                                        <div id="user_upload"  >
                                            @if(session()->has('warning'))
                                                <div class=" alert alert-warning alert-dismissible fade in" >
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                    <div  class="text-left">{{ session()->get('warning') }}</div>
                                                </div>
                                            @endif
                                            @if(session()->has('success'))
                                                <div class=" alert alert-success alert-dismissible fade in">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                                                   <div class="text-left">{{ session()->get('success') }}</div>


                                                </div>
                                            @endif
                                            <h4>Image / Video Upload</h4>
                                        <form action="{{url('/dashboard/upload_user')}}" method="post"  enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                                <label class ="col-lg-04"><h4>Category</h4></label>
                                                <select data-placeholder="Choose a Category" class =" well form-group"  name="Category"  id="Category" style="margin-bottom: 30px; padding: 10px; width: 200px"  required>
                                                 <option disabled="" selected=""value="">Chose a Category</option>
                                                <option value="Education">Education</option>
                                                <option value="Fashion">Fashion</option>
                                                <option value="Nature">Nature</option>
                                                <option value="Backgrounds">Backgrounds</option>
                                                <option value="Animals">Animals</option>
                                                <option value="Feelings">Feelings</option>
                                                <option value="Sports">Sports</option>
                                                <option value="Music">Music</option>
                                                <option value="Business">Business</option>
                                                <option value="Food">Food</option>
                                                <option value="Transportation">Transportation</option>
                                                <option value="Buildings">Buildings</option>
                                                <option value="Science">Science</option>
                                            </select><br>

                                            <input type="radio" id="user_video" value="video" name="type" required >Video


                                            <input type="radio" id="user_image" value="image" name="type" required >Image




                                <div id="video_sec" style="display:none">
                                    <div class="form-group col-lg-12">
                                        <label class="col-md-12">Select Video Method</label>
                                        <div class="col-md-12">
                                            <label class="radio-inline"><input type="radio" id="youtube" value="youtube" name="upload_method"  >Youtube Url</label>
                                            <label class=" radio-inline"><input type="radio" id="upload" value="upload" name="upload_method"  >Video Upload</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-12" id="youtube_url" style="display:none">
                                        <label class="col-md-12">Youtube Video Url:</label>
                                        <div class="col-md-12">
                                            <input type="url" class="form-control" id="youtube_link" name="video_url"  value="">
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-12" id="ad_video" style="display:none">
                                        <label class="col-md-12" >Media File <span style="color: green;font-size: 10px;"> ( Max_Size(20mb)) </span></label>
                                        <div class="col-md-12">
                                            <div class="select-admedai-box" id="select-ad-media">
                                                <input type="file"  multiple  class="form-control" placeholder="No file chosen" id="upload_video" name="video_source"  >


                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-12" id="image_sec" style="display:none">
                                    <label class="col-md-12 " id="imagesizeinfo">Media File <span style="color: green;font-size: 10px;"> ( Min_width(1000) - Max_width(1300) , Min_height(150) - Max_height(200) ) </span><!-- <input type="hidden" name="imagsize" value="category"> --></label>
                                    <div class="col-md-12">
                                        <div class="select-admedai-box" id="select-ad-media">


                                            <input type="file" multiple id="gallery-photo-add"  class="form-control " placeholder="No file chosen" id="upload_image" name="image" >
                                            <div class="col-md-12" style = "text-align: -webkit-center;">
                                                <div class="gallery" style="width: 20%;"></div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>



                                <div >
                                    <button type="submit" class="btn btn-primary  " style="width: 100px">Save</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                    </form>
                        </div>
            </div>
        </div>
    </div>
</div>
    </div>














@endsection
@section('script')

    <script type="text/javascript">

        $('#user_image').click(function(){
            $('#image_sec').show();
            $('#video_sec').hide();
        });

        $('#user_video').click(function(){
            $('#image_sec').hide();
            $('#video_sec').show();
        });

        $('#youtube').click(function(){
            $('#youtube_url').show();
            $('#ad_video').hide();
        });

        $('#upload').click(function(){
            $('#youtube_url').hide();
            $('#ad_video').show();
        });

        $(document).ready(function () {
            @if(['type'] == 'video')
              $('#image_sec').hide();
            $('#video_sec').show();
            @elseif (['type'] == 'image')
              $('#image_sec').show();
            $('#video_sec').hide();
            @endif

            @if(['upload_method'] == 'youtube')
              $('#youtube').prop('checked',true);
            $('#youtube_url').show();
            @else
            $('#upload').prop('checked',true);
            $('#ad_video').show();
            @endif
        });
    </script>

        <script>
            $(function() {
                // Multiple images preview in browser
                var imagesPreview = function(input, placeToInsertImagePreview) {

                    if (input.files) {
                        var filesAmount = input.files.length;

                        for (i = 0; i < filesAmount; i++) {
                            var reader = new FileReader();

                            reader.onload = function(event) {
                                $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                            }

                            reader.readAsDataURL(input.files[i]);
                        }
                    }

                };

                $('#gallery-photo-add').on('change', function() {
                    imagesPreview(this, 'div.gallery');
                });
            });
        </script>


@endsection
