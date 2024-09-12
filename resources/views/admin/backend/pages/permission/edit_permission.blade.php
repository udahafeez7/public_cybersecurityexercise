@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Edit Existing Permission</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Edit Permission</li>
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
                            <!-- Update the form action to point to the update route -->
                            <form id="myForm" action="{{ route('permission.update') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <!-- Hidden input to pass the permission id -->
                                <input type="hidden" name="id" value="{{ $permission->id }}">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div>
                                            <div class="form-group mb-3">
                                                <label for="example-text-input" class="form-label">Permission Name</label>
                                                <input class="form-control" name="name" type="text"
                                                    id="example-text-input" value="{{ $permission->name }}">
                                            </div>
                                            <div>
                                                <div class="form-group mb-3">
                                                    <label for="example-text-input" class="form-label">Permission
                                                        Group</label>
                                                    <select name="group_name" class="form-select">
                                                        <option selected disabled>Select Permission Group</option>
                                                        <option value="Category"
                                                            {{ $permission->group_name == 'Category' ? 'selected' : '' }}>
                                                            Category</option>
                                                        <option value="Learning"
                                                            {{ $permission->group_name == 'Learning' ? 'selected' : '' }}>
                                                            Learning</option>
                                                        <option value="Gallery"
                                                            {{ $permission->group_name == 'Gallery' ? 'selected' : '' }}>
                                                            Gallery</option>
                                                    </select>
                                                </div>
                                                <div class="mt-4">
                                                    <button type="submit"
                                                        class="btn btn-primary waves-effect waves-light">Save
                                                        Changes</button>
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
    @endsection
