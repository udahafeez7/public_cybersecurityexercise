@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Add New Category</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Category</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="card">
                <div class="row">
                    <div class="col-xl-9 col-lg-8">
                        <div class="card-body p-4">
                            <form id="myForm" action="{{ route('category.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div>
                                            <div class="form-group mb-3">
                                                <label for="example-text-input" class="form-label"> Category Name</label>
                                                <input class="form-control" name="category_name" type="text"
                                                    id="example-text-input">
                                            </div>



                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mt-3 mt-lg-0">


                                            <div class="form-group mb-3">
                                                <label for="example-text-input" class="form-label">Category Image</label>
                                                <input class="form-control" name="image" type="file" id="image">
                                            </div>

                                            <div class="mb-3">
                                                <img id="showImage" src="{{ url('upload/no_image.jpg') }}" alt=""
                                                    class="img-fluid rounded-block d-block p-1 bg-primary" width="110">

                                            </div>
                                            <div class="mt-4">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">Add
                                                    Category</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>







                        <!-- end tab content -->
                    </div>
                    <!-- end col -->


                    <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->
            </form>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) { // Corrected selector
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]); // Corrected file access
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    category_name: {
                        required: true,
                    },
                    image: {
                        required: true,
                    },

                },
                messages: {
                    category_name: {
                        required: 'You HAVE to Enter a Category Name',
                    },
                    image: {
                        required: 'You HAVE to provide some image',
                    },


                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection
