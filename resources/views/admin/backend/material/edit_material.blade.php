@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Edit Existing Material</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Edit Material</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="card">
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card-body p-4">
                            <form id="myForm" action="{{ route('material.update') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $material->id }}">
                                <div class="row">
                                    <div class="col-xl-4 col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="example-text-input" class="form-label">Category Name</label>
                                            <select name="category_id" class="form-select">
                                                <option>Please Select Category</option>
                                                @foreach ($category as $cat)
                                                    <option value="{{ $cat->id }}"
                                                        {{ $cat->id == $material->category_id ? 'selected' : '' }}>
                                                        {{ $cat->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xl-4 col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="example-text-input" class="form-label">Pretasks Name</label>
                                            <select name="pretasks_id" class="form-select">
                                                <option selected="" disabled="">Please Select Pretasks</option>
                                                @foreach ($pretasks as $pre)
                                                    <option value="{{ $pre->id }}"
                                                        {{ $pre->id == $material->pretasks_id ? 'selected' : '' }}>
                                                        {{ $pre->pretasks_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xl-4 col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="example-text-input" class="form-label">Code</label>
                                            <input class="form-control" name="code" type="text"
                                                value="{{ $material->code }}">
                                        </div>
                                    </div>

                                    <div class="col-xl-8 col-md-8">
                                        <div class="form-group mb-3">
                                            <label for="example-text-input" class="form-label">Title</label>
                                            <input class="form-control" name="title" type="text"
                                                value="{{ $material->title }}">
                                        </div>
                                    </div>

                                    <div class="col-xl-12 col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="example-text-input" class="form-label">Description</label>
                                            <input class="form-control" name="description" type="text"
                                                value="{{ $material->description }}">
                                        </div>
                                    </div>

                                    <!-- Long Description with CKEditor -->
                                    <div class="col-xl-12 col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="example-textarea-input" class="form-label">Long Description</label>
                                            <textarea class="form-control" name="long_description" rows="6" id="long_description">{{ old('long_description', $material->long_description) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-xl-4 col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="example-text-input" class="form-label">Material Image</label>
                                            <input class="form-control" name="image" type="file" id="image">
                                        </div>
                                    </div>

                                    <div class="col-xl-4 col-md-6">
                                        <div class="form-group mb-3">
                                            <img id="showImage" src="{{ asset($material->image) }}" alt=""
                                                class="img-fluid rounded-block d-block p-1 bg-primary" width="110">
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Edit
                                            Material</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include CKEditor 4.16.2 via CDN -->
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

    <!-- Initialize CKEditor after DOM has loaded -->
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            CKEDITOR.replace('long_description', {
                language: 'en', // Set the language you want, e.g., 'en' for English, 'fr' for French
                toolbar: [{
                        name: 'clipboard',
                        items: ['Undo', 'Redo']
                    },
                    {
                        name: 'styles',
                        items: ['Bold', 'Italic', 'Underline']
                    },
                    {
                        name: 'paragraph',
                        items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent']
                    },
                    {
                        name: 'editing',
                        items: ['Scayt']
                    },
                    {
                        name: 'insert',
                        items: ['Link', 'Image']
                    },
                    {
                        name: 'tools',
                        items: ['Maximize']
                    }
                ],
                height: 300
            });
            console.log("CKEditor initialized");
        });
    </script>

    <!-- Image Preview Script -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>

    <!-- Form Validation -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    title: {
                        required: true,
                    },
                    pretasks_id: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },
                    long_description: {
                        required: true,
                    },
                },
                messages: {
                    title: {
                        required: 'You HAVE to Enter a Material Title',
                    },
                    pretasks_id: {
                        required: 'You HAVE to SELECT a pretask',
                    },
                    description: {
                        required: 'You HAVE to provide some description',
                    },
                    long_description: {
                        required: 'You HAVE to provide the content description',
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
