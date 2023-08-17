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
                        <li class="breadcrumb-item active"> Update Banner</li>
                    </ol>
                </div>
                <h4 class="page-title">Update Banner</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <!-- Form row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="myForm" method="post" action="{{ route('category.update')}}">
                        @csrf
                        <input type="hidden" name="id" value="">
                        <div class="row">
                            <div class="form-group col-md-6 mb-3">
                                <label for="example-fileinput" class="form-label">Home Banner One</label>
                                <input type="file" name="image" id="image" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="example-fileinput" class="form-label"></label>
                                <img id="showImage" src="{{ (!empty($banner->home_one)) ? url('upload/banner/' . $banner->home_one): url('upload/no_image.jpg') }}" class="" 
                                alt="profile-image" style="width:400px; height:60px;">
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

<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>


@endsection