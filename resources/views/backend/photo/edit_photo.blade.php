@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="content">

<!-- Start Content-->
<div class="container-fluid">
    
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Edit Multi Photo</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit Multi Photo</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <!-- Form row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="myForm" method="post" action="{{ route('update.photo.gallery',['id' => $photogallery->id])}}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{ $photogallery->id }}">

                        <div class="row">
                            <div class="form-group col-md-8 mb-3">
                                <label for="inputEmail4" class="form-label">Multi Photo Gallery</label>
                                <input type="file" name="multi_image" class="form-control" id="multiImg" multiple>
                            </div>
                            <div class="form-group col-md-8 mb-3">
                                <label for="inputEmail4" class="form-label"></label>
                                <img src="{{ asset($photogallery->photo_gallery)}}" style="width:400px; height:200px;" alt="">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save Changes</button>

                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->


 
    
</div> <!-- container -->

</div>


<script> 
    $(document).ready(function(){
    $('#multiImg').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            var data = $(this)[0].files; //this file data
           
            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                    .height(80); //create image element 
                        $('#preview_img').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });
           
        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
    });
    });
   
</script>

@endsection