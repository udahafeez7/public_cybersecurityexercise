@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Add New Gallery</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Gallery</li>
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
                            <form id="myForm" action="{{ route('gallery.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    {{-- <div class="col-lg-12">
                                        {{-- <div>
                                            <div class="form-group mb-3">
                                                <label for="example-text-input" class="form-label"> Pretasks Name</label>
                                                <input class="form-control" name="pretasks_name" type="text"
                                                    id="example-text-input" value="{{ old('pretasks_name') }}">
                                            </div>
                                        </div> --}}
                                    {{-- </div> --}}

                                    <div class="col-lg-6">
                                        <div class="mt-3 mt-lg-0">
                                            <div class="form-group mb-3">
                                                <label for="example-text-input" class="form-label">Gallery Image</label>
                                                <input class="form-control" name="gallery_img[]" type="file"
                                                    id="multiImg" multiple>
                                                <div class="="row id="preview_img"></div>
                                            </div>

                                            {{-- <div class="mb-3">
                                                <img id="showImage" src="{{ url('upload/no_image.jpg') }}" alt=""
                                                    class="img-fluid rounded-block d-block p-1 bg-primary" width="110">
                                            </div> --}}

                                            <div class="mt-4">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                    Add Galleries
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- container-fluid -->
        </div>
    </div>

    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script> --}}

    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    pretasks_name: {
                        required: true,
                    },
                    image: {
                        required: true,
                    },
                },
                messages: {
                    pretasks_name: {
                        required: 'You HAVE to Enter a Pretasks Name',
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
    </script> --}}
    <script>
        $(document).ready(function() {
            $('#multiImg').on('change', function() { //on file input change
                if (window.File && window.FileReader && window.FileList && window
                    .Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file
                                .type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file) { //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src',
                                            e.target.result).width(100)
                                        .height(80); //create image element
                                    $('#preview_img').append(
                                        img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
    </script>
@endsection
