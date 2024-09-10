@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">All Material</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <a href="{{ route('add.material') }}" class="btn btn-primary waves-effect waves-light">
                                    Add Material
                                </a>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Pretasks</th>
                                        <th>Code</th>
                                        <th>Description</th>
                                        <th>Long Description</th>
                                        <th>Status Completed</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($material as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><img src="{{ asset($item->image) }}" alt=""
                                                    style="width: 70px; height:40px;"></td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->category_id }}</td>
                                            <td>{{ $item->pretasks_id }}</td>
                                            <td>{{ $item->code }}</td>

                                            <!-- Truncate description and long_description with "Read more" links -->
                                            <td>
                                                {{ Str::limit($item->description, 50) }}
                                                @if (strlen($item->description) > 50)
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#descriptionModal{{ $item->id }}">Read more</a>
                                                @endif
                                            </td>

                                            <td>
                                                {{ Str::limit($item->long_description, 50) }}
                                                @if (strlen($item->long_description) > 50)
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#longDescModal{{ $item->id }}">Read more</a>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($item->status_completed)
                                                    <span class="badge bg-success">Completed</span>
                                                @else
                                                    <span class="badge bg-danger">Incomplete</span>
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{ route('edit.material', $item->id) }}"
                                                    class="btn btn-info btn-sm">Edit</a>
                                                <a href="{{ route('delete.material', $item->id) }}"
                                                    class="btn btn-danger btn-sm" id="delete">Delete</a>
                                            </td>
                                        </tr>

                                        <!-- Description Modal -->
                                        <div class="modal fade" id="descriptionModal{{ $item->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Full Description</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ $item->description }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Long Description Modal -->
                                        <div class="modal fade" id="longDescModal{{ $item->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Full Long Description
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ $item->long_description }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
@endsection
