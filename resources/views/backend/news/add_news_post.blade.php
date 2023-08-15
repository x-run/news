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
                        <li class="breadcrumb-item active">Add News Post</li>
                    </ol>
                </div>
                <h4 class="page-title">Add News Post</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <!-- Form row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="myForm" method="post" action="{{ route('store.news.post')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6 mb-3">
                                <label for="inputEmail4" class="form-label">Category Name</label>
                                <select name="category_id" class="form-select" id="example-select" required>
                                    <option disabled selected>Select Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id}}">{{ $category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- ><div class="row">
                            <div class="form-group col-md-6 mb-3">
                                <label for="inputEmail4" class="form-label">SubCategory Name</label>
                                <select name="subcategory_id" class="form-select" id="example-select">
                                    <option></option>
                                   
                                </select>
                            </div>
                        </div>
                        < -->

                        <div class="row">
                            <div class="form-group col-md-6 mb-3">
                                <label for="inputEmail4" class="form-label">Writer </label>
                                <select name="user_id" class="form-select" id="example-select" required>
                                    <option disabled selected>Select Writer</option>
                                    @foreach($adminuser as $user)
                                    <option value="{{ $user->id}}">{{ $user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 mb-3">
                                <label for="inputEmail4" class="form-label">News Title</label>
                                <input type="text" name="news_title" class="form-control" id="inputEmail4" >
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 mb-3">
                            <label for="example-fileinput" class="form-label">News Post Photo</label>
                            <input type="file" name="image" id="image" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 mb-3">
                            <label for="example-fileinput" class="form-label"></label>
                            <img id="showImage" src="{{ url('upload/no_image.jpg') }}" class="rounded-circle avatar-lg img-thumbnail" 
                            alt="profile-image">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="inputEmail4" class="form-label">News Details</label>
                                <textarea name="news_details" id="" cols="30" rows="20"></textarea>
                            </div>
                        </div>

                        <div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="inputEmail4" class="form-label">Tags</label>
                                <input type="text" name="tags" class="selectize-close-btn" value="沖縄" >
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-check mb-2 form-check-primary">
                                    <input type="checkbox" class="form-check-input" value="1" name="breaking_news" id="customcheck1">
                                    <label for="customcheck1" class="form-check-label">Breaking News</label>
                                </div>

                                <div class="form-check mb-2 form-check-primary">
                                    <input type="checkbox" class="form-check-input" value="1" name="top_slider" id="customcheck2">
                                    <label for="customcheck2" class="form-check-label">Top Slider</label>
                                </div>
                            </div>

                        <div>
                            <div class="col-lg-6">
                                <div class="form-check mb-2 form-check-danger">
                                    <input type="checkbox" class="form-check-input" value="1" name="first_section_three" id="customcheck3">
                                    <label for="customcheck3" class="form-check-label">First Section Three</label>
                                </div>

                                <div class="form-check mb-2 form-check-danger">
                                    <input type="checkbox" class="form-check-input" value="1" name="first_section_nine" id="customcheck4">
                                    <label for="customcheck4" class="form-check-label">First Section Nine</label>
                                </div>
                            </div>
                        </div>



                        <button type="submit" class="btn btn-primary waves-effect waves-light">Let's Post</button>

                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->


 
    
</div> <!-- container -->

</div>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                news_title: {
                    required : true,
                }, 
            },
            messages :{
                news_title: {
                    required : 'Please Enter News Title',
                },
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>

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

<script type="text/javascript">
        $(document).ready(function(){
            $('select[name="category_id"]').on('change', function(){
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ url('/subcategory/ajax') }}/"+category_id,
                        type: "GET",  
                        dataType: "json", 
                        success:function(data){
                            $('select[name="subcategory_id"]').html('');
                            var d =$('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="subcategory_id"]').append('<option value="'+ value.id +'"> ' + value.subcategory_name + '</option>');
                            });
                        },
                    });
                } else{
                    alert('danger');
                }
            });
        });
        
</script>

<!-- Check if tiny cloud is empty -->

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                news_title: {
                    required : true,
                }, 
            },
            messages :{
                news_title: {
                    required : 'Please Enter News Title',
                },
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });

        // フォームの送信ボタンのクリックイベントにリスナーを追加
        $('button[type="submit"]').on('click', function(event) {
            // textarea要素を取得
            const textarea = document.querySelector('textarea[name="news_details"]');

            // textarea要素が空の場合
            if (textarea.value.trim() === '') {
                // アラートを表示
                alert('News Details is required.');

                // フォームの送信を中断
                event.preventDefault();
            }
        });

    });
    
</script>








@endsection