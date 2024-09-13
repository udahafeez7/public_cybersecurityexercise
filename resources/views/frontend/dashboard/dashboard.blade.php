@include('frontend.dashboard.header')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

@php
    $id = Auth::user()->id;
    $profileData = App\Models\User::find($id);
@endphp

<section class="section pt-4 pb-4 osahan-account-page">
    <div class="container">
        <div class="row">
            @include('frontend.dashboard.sidebar')

            <div class="col-md-9">
                <div class="osahan-account-page-right rounded shadow-sm bg-white p-4 h-100">
                    <div class="tab-content" id="myTabContent">

                        <!-- User Profile Section -->
                        <div class="tab-pane fade show active" id="profile" role="tabpanel"
                            aria-labelledby="profile-tab">
                            <h4 class="font-weight-bold mt-0 mb-4">Update User Profile</h4>
                            <div class="bg-white card mb-4 shadow-sm">
                                <div class="card-body">
                                    <form action="{{ route('profile.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Name</label>
                                                    <input class="form-control" type="text" name="name"
                                                        value="{{ $profileData->name }}" id="name">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input class="form-control" name="email" type="email"
                                                        value="{{ $profileData->email }}" id="email">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">Phone</label>
                                                    <input class="form-control" name="phone" type="text"
                                                        value="{{ $profileData->phone }}" id="phone">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="address" class="form-label">Address</label>
                                                    <input class="form-control" name="address" type="text"
                                                        value="{{ $profileData->address }}" id="address">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="photo" class="form-label">Profile Image</label>
                                                    <input class="form-control" name="photo" type="file"
                                                        id="image">
                                                </div>

                                                <div class="mb-3">
                                                    <img id="showImage"
                                                        src="{{ !empty($profileData->photo) ? url('upload/user_images/' . $profileData->photo) : url('upload/no_image.jpg') }}"
                                                        alt="Profile Image" class="rounded-circle p-1 bg-primary"
                                                        width="110">
                                                </div>

                                                <div class="mt-4">
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End User Profile Section -->

                        <!-- Pre-assessment Section -->
                        <div class="tab-pane fade" id="preassessment" role="tabpanel"
                            aria-labelledby="preassessment-tab">
                            <h4 class="font-weight-bold mt-0 mb-4">Pre Training Activities</h4>
                            <div class="bg-white card mb-4 order-list shadow-sm">
                                <div class="gold-members p-4">
                                    <a href="#">
                                        <div class="media">
                                            <img class="mr-4" src="{{ asset('frontend/img/3.jpg') }}"
                                                alt="Pre Training Exercise">
                                            <div class="media-body">
                                                <h6 class="mb-2">
                                                    <a href="detail.html" class="text-black"
                                                        style="
                                                        font-size: 1.5rem;
                                                        font-weight: bold;
                                                        color: #db1111;
                                                        text-decoration: none;
                                                        padding: 8px 12px;
                                                        display: inline-block;
                                                        border-radius: 4px;
                                                        transition: background-color 0.3s ease, color 0.3s ease;">
                                                        Pre Training Exercise Questionnaire
                                                    </a>
                                                </h6>
                                                <p class="text-black mb-1"><i class="icofont-location-arrow"></i>
                                                    Conduct initial base knowledge</p>
                                                <p class="text-gray mb-3"><i class="icofont-clock-time ml-2"></i> <span
                                                        id="order-time"></span></p>

                                                <script>
                                                    function formatDateToJapanTime() {
                                                        const options = {
                                                            weekday: 'short',
                                                            year: 'numeric',
                                                            month: 'short',
                                                            day: 'numeric',
                                                            hour: '2-digit',
                                                            minute: '2-digit',
                                                            hour12: true,
                                                            timeZone: 'Asia/Tokyo'
                                                        };
                                                        return new Date().toLocaleDateString('en-US', options);
                                                    }
                                                    document.getElementById('order-time').textContent = formatDateToJapanTime();
                                                </script>

                                                <hr>
                                                <div class="float-right">
                                                    <a class="btn btn-sm btn-outline-primary" href="#"><i
                                                            class="icofont-headphone-alt"></i> HELP</a>
                                                    <a class="btn btn-sm btn-primary"
                                                        href="https://forms.gle/6ph8XYdKFchDLgqr9" target="_blank"><i
                                                            class="icofont-refresh"></i> VISIT HERE</a>
                                                </div> {{-- <p class="mb-0 text-black text-primary pt-2"><span
                                            class="text-black font-weight-bold"> Total Paid:</span> $300
                                    </p> --}}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                        </div>
                        <!-- Multi Criteria Decision Making (Records 1-7) -->
                        <div class="tab-pane fade" id="learning" role="tabpanel" aria-labelledby="learning-tab">
                            <h4 class="font-weight-bold mt-0 mb-4">Self-Paced Learning Material</h4>

                            <!-- First Row with Two Cards -->
                            <div class="row mb-4 pb-2">
                                @foreach ($materials->slice(0, 7) as $material)
                                    <div class="col-md-6">
                                        <div class="card offer-card shadow-sm">
                                            <div class="card-body">
                                                <!-- Image taking full width of the container -->
                                                <img src="{{ asset('frontend/img/list/1.png') }}"
                                                    class="img-fluid w-100" alt="{{ $material->title }}">
                                                <h6 class="card-subtitle mt-3 mb-2 text-block">{{ $material->title }}
                                                </h6>
                                                <a href="{{ route('user.materials') }}" class="card-link">KNOW
                                                    MORE</a>
                                                <a href="#" class="card-link">COPY CODE</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- System Complexity (Records 8-11) -->
                        <div class="row mb-4 pb-2">
                            @foreach ($materials->slice(7, 4) as $material)
                                <div class="col-md-6">
                                    <div class="card offer-card shadow-sm">
                                        <div class="card-body">
                                            <!-- Image taking full width of the container -->
                                            <img src="{{ asset('frontend/img/list/3.png') }}" class="img-fluid w-100"
                                                alt="{{ $material->title }}">
                                            <h6 class="card-subtitle mt-3 mb-2 text-block">{{ $material->title }}</h6>
                                            <a href="{{ route('user.materials') }}" class="card-link">KNOW MORE</a>
                                            <a href="#" class="card-link">COPY CODE</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Risk Level and Mitigation Determination (Records 12-15) -->
                        <div class="row mb-4 pb-2">
                            @foreach ($materials->slice(11, 4) as $material)
                                <div class="col-md-6">
                                    <div class="card offer-card shadow-sm">
                                        <div class="card-body">
                                            <!-- Image taking full width of the container -->
                                            <img src="{{ asset('frontend/img/list/6.png') }}" class="img-fluid w-100"
                                                alt="{{ $material->title }}">
                                            <h6 class="card-subtitle mt-3 mb-2 text-block">{{ $material->title }}</h6>
                                            <a href="{{ route('user.materials') }}" class="card-link">KNOW MORE</a>
                                            <a href="#" class="card-link">COPY CODE</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Key Performance Indicator (Record 16) -->
                        <div class="row mb-4 pb-2">
                            @foreach ($materials->slice(15, 1) as $material)
                                <div class="col-md-6">
                                    <div class="card offer-card shadow-sm">
                                        <div class="card-body">
                                            <!-- Image taking full width of the container -->
                                            <img src="{{ asset('frontend/img/list/8.png') }}" class="img-fluid w-100"
                                                alt="{{ $material->title }}">
                                            <h6 class="card-subtitle mt-3 mb-2 text-block">{{ $material->title }}</h6>
                                            <a href="{{ route('user.materials') }}" class="card-link">KNOW MORE</a>
                                            <a href="#" class="card-link">COPY CODE</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>



                        {{-- <!-- Third Row with Two Cards -->
                                <div class="row mb-4 pb-2">
                                    <!-- Fifth Card -->
                                    <div class="col-md-6">
                                        <div class="card offer-card shadow-sm">
                                            <div class="card-body">
                                                <h5 class="card-title"><img src="{{ asset('img/bank/1.png') }}"
                                                        alt="Discount"> OSAHANEAT50</h5>
                                                <h6 class="card-subtitle mb-2 text-block">Get 50% OFF on your first
                                                    osahan
                                                    eat order</h6>
                                                <p class="card-text">Use code OSAHANEAT50 & get 50% off on your first
                                                    osahan order on Website and Mobile site. Maximum discount: $200</p>
                                                <a href="#" class="card-link">COPY CODE</a>
                                                <a href="#" class="card-link">KNOW MORE</a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Sixth Card -->
                                    <div class="col-md-6">
                                        <div class="card offer-card shadow-sm">
                                            <div class="card-body">
                                                <h5 class="card-title"><img src="{{ asset('img/bank/2.png') }}"
                                                        alt="Discount"> EAT730</h5>
                                                <h6 class="card-subtitle mb-2 text-block">Get 50% OFF on your first
                                                    osahan
                                                    eat order</h6>
                                                <p class="card-text">Use code EAT730 & get 50% off on your first osahan
                                                    order on Website and Mobile site. Maximum discount: $600</p>
                                                <a href="#" class="card-link">COPY CODE</a>
                                                <a href="#" class="card-link">KNOW MORE</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}


                        <div class="tab-pane fade" id="favourites" role="tabpanel" aria-labelledby="favourites-tab">
                            <h4 class="font-weight-bold mt-0 mb-4">Software Intermediaries</h4>
                            <div class="row">
                                <!-- First Card -->
                                <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                    <div
                                        class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                        <div class="list-card-image">


                                        </div>
                                        <div class="p-3 position-relative">
                                            <div class="list-card-body">
                                                <h6 class="mb-1">
                                                    <a href="detail.html" class="text-black">Fuzzy
                                                        Analytical
                                                        Hierarchy Process</a>
                                                </h6>
                                                <p class="text-gray mb-3">Initial Criteria</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Second Card -->
                                <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                    <div
                                        class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                        <div class="p-3 position-relative">
                                            <div class="list-card-body">
                                                <h6 class="mb-1"><a href="detail.html" class="text-black">System
                                                        Complexity</a></h6>
                                                <p class="text-gray mb-3">Best Practice • Assets •
                                                    Domain Mapping
                                                    Matrix</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Third Card -->
                                <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                    <div
                                        class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                        <div class="p-3 position-relative">
                                            <div class="list-card-body">
                                                <h6 class="mb-1"><a href="detail.html" class="text-black">Risk
                                                        Level Determination</a></h6>
                                                <p class="text-gray mb-3">System Complexity •
                                                    Impact •
                                                    Exploitability
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Load More Button -->
                                <div class="col-md-12 text-center load-more">
                                    <button class="btn btn-primary" type="button" disabled>
                                        <span class="spinner-grow spinner-grow-sm" role="status"
                                            aria-hidden="true"></span>
                                        Loading...
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="addresses" role="tabpanel" aria-labelledby="addresses-tab">
                        <h4 class="font-weight-bold mt-0 mb-4">Manage Addresses</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="bg-white card addresses-item mb-4 border border-primary shadow">
                                    <div class="gold-members p-4">
                                        <div class="media">
                                            <div class="mr-3"><i class="icofont-ui-home icofont-3x"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mb-1 text-secondary">Cyber
                                                    Resilience Lab</h6>
                                                <p class="text-black">3rd Floor, Building A
                                                    8916-5 Takayama, Ikoma, Nara 630-0192, Japan
                                                </p>
                                                <p class="mb-0 text-black font-weight-bold"><a
                                                        class="text-primary mr-3" data-toggle="modal"
                                                        data-target="#add-address-modal" href="#"><i
                                                            class="icofont-ui-edit"></i>
                                                        EDIT</a> <a class="text-danger" data-toggle="modal"
                                                        data-target="#delete-address-modal" href="#"><i
                                                            class="icofont-ui-delete"></i>
                                                        DELETE</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-white card addresses-item mb-4 shadow-sm">
                                    <div class="gold-members p-4">
                                        <div class="media">
                                            <div class="mr-3"><i class="icofont-briefcase icofont-3x"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mb-1">ICSCoE Japan</h6>
                                                <p>2-28-8 Honkomagome, Bunkyo-ku, Tokyo, Japan
                                                    113-6591
                                                </p>
                                                <p class="mb-0 text-black font-weight-bold"><a
                                                        class="text-primary mr-3" data-toggle="modal"
                                                        data-target="#add-address-modal" href="#"><i
                                                            class="icofont-ui-edit"></i>
                                                        EDIT</a> <a class="text-danger" data-toggle="modal"
                                                        data-target="#delete-address-modal" href="#"><i
                                                            class="icofont-ui-delete"></i>
                                                        DELETE</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>


                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        })
    })
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'info':
                toastr.info(" {{ Session::get('message') }} ");
                break;

            case 'success':
                toastr.success(" {{ Session::get('message') }} ");
                break;

            case 'warning':
                toastr.warning(" {{ Session::get('message') }} ");
                break;

            case 'error':
                toastr.error(" {{ Session::get('message') }} ");
                break;
        }
    @endif
</script>

@include('frontend.dashboard.footer')
