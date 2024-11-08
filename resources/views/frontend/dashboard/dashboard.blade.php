@include('frontend.dashboard.header')

<!-- jQuery and Toastr CSS -->
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
                            <div class="bg-white card mb-8 order-list shadow-lg"
                                style="padding: 20px; min-height: 400px;">
                                <div class="gold-members p-9">
                                    <a href="#">
                                        <div class="media">
                                            <img class="mr-4" src="{{ asset('frontend/img/3.jpg') }}"
                                                alt="Pre Training Exercise">
                                            <div class="media-body">
                                                <h6 class="mb-8">
                                                    <a href="https://forms.gle/6ph8XYdKFchDLgqr9" target="_blank"
                                                        class="text-black"
                                                        style="font-size: 1.5rem; font-weight: bold; color: #db1111; text-decoration: none; padding: 8px 12px; display: inline-block; border-radius: 4px; transition: background-color 0.3s ease, color 0.3s ease;">
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
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Learning Material Section -->
                        <div class="tab-pane fade" id="learning" role="tabpanel" aria-labelledby="learning-tab">
                            <h4 class="font-weight-bold mt-0 mb-4">Self-Paced Learning Material</h4>

                            <!-- Learning Material Cards -->
                            <div class="row mb-20 pb-2">
                                <div class="col-md-8">
                                    <div class="card offer-card shadow-lg">
                                        <div class="card-body">
                                            <img src="{{ asset('frontend/img/list/2.png') }}" class="img-fluid w-100"
                                                alt="MCDM">
                                            <h6 class="card-subtitle mt-3 mb-2 text-block">Preloaded Learning Material
                                            </h6>
                                            <a href="{{ route('user.materials') }}" class="card-link">FIND OUT
                                                MORE</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Multimedia Repository Section -->
                        <div class="tab-pane fade" id="multimedia" role="tabpanel" aria-labelledby="multimedia-tab">
                            <h4 class="font-weight-bold mt-0 mb-4">Multimedia Repositories</h4>

                            <!-- Multimedia Repository Cards - Row 1 -->
                            <div class="row mb-4 pb-2">
                                <!-- First YouTube Video -->
                                <div class="col-md-6">
                                    <div class="card offer-card shadow-sm">
                                        <div class="card-body">
                                            <!-- YouTube Video Thumbnail and Link -->
                                            <iframe width="100%" height="250"
                                                src="https://www.youtube.com/embed/MRckVd2JlqE"
                                                title="YouTube video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen>
                                            </iframe>
                                            <h6 class="card-subtitle mt-3 mb-2 text-block">Multi Criteria Decision
                                                Making</h6>
                                            <a href="https://youtu.be/MRckVd2JlqE" class="card-link"
                                                target="_blank">Watch on YouTube</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Second YouTube Video -->
                                <div class="col-md-6">
                                    <div class="card offer-card shadow-sm">
                                        <div class="card-body">
                                            <!-- YouTube Video Thumbnail and Link for Second Video -->
                                            <iframe width="100%" height="250"
                                                src="https://www.youtube.com/embed/-MpFHElskyU"
                                                title="YouTube video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen>
                                            </iframe>
                                            <h6 class="card-subtitle mt-3 mb-2 text-block">Reduced Complexity</h6>
                                            <a href="https://youtu.be/-MpFHElskyU" class="card-link"
                                                target="_blank">Watch on YouTube</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Multimedia Repository Cards - Row 2 -->
                            <div class="row mb-4 pb-2">
                                <!-- Third YouTube Video -->
                                <div class="col-md-6">
                                    <div class="card offer-card shadow-sm">
                                        <div class="card-body">
                                            <!-- YouTube Video Thumbnail and Link for Third Video -->
                                            <iframe width="100%" height="250"
                                                src="https://www.youtube.com/embed/L36J6vbqsPE"
                                                title="YouTube video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen>
                                            </iframe>
                                            <h6 class="card-subtitle mt-3 mb-2 text-block">Risk Level Determination
                                            </h6>
                                            <a href="https://youtu.be/L36J6vbqsPE" class="card-link"
                                                target="_blank">Watch on YouTube</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Fourth YouTube Video -->
                                <div class="col-md-6">
                                    <div class="card offer-card shadow-sm">
                                        <div class="card-body">
                                            <!-- YouTube Video Thumbnail and Link for Fourth Video -->
                                            <iframe width="100%" height="250"
                                                src="https://www.youtube.com/embed/WGg-91GuJgA"
                                                title="YouTube video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen>
                                            </iframe>
                                            <h6 class="card-subtitle mt-3 mb-2 text-block">Cost Benefit Analysis</h6>
                                            <a href="https://youtu.be/WGg-91GuJgA" class="card-link"
                                                target="_blank">Watch on YouTube</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Technical Software Intermediaries Section -->
                        <div class="tab-pane fade" id="favourites" role="tabpanel" aria-labelledby="favourites-tab">
                            <h4 class="font-weight-bold mt-0 mb-4">Software Intermediaries</h4>
                            <div class="row">
                                <!-- First Card (Fuzzy AHP) -->
                                <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                    <div
                                        class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                        <div class="p-3 position-relative">
                                            <!-- Image Section -->
                                            <img src="{{ asset('frontend/img/list/1.png') }}"
                                                alt="Multi Criteria Decision Making" class="w-100 mb-3 rounded">

                                            <div class="list-card-body">
                                                <h6 class="mb-1">
                                                    <a href="{{ route('tasks.fuzzy-ahp') }}" class="text-black">Multi
                                                        Criteria Decision Making</a>
                                                </h6>
                                                <p class="text-gray mb-3">STRIDE Objective Elements</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Second Card (System Complexity) -->
                                <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                    <div
                                        class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                        <div class="p-3 position-relative">
                                            <!-- Image Section -->
                                            <img src="{{ asset('frontend/img/list/3.png') }}" alt="System Complexity"
                                                class="w-100 mb-3 rounded">

                                            <div class="list-card-body">
                                                <h6 class="mb-1">
                                                    <a href="{{ route('tasks.domain-mapping') }}"
                                                        class="text-black">Reduced System Complexity</a>
                                                </h6>
                                                <p class="text-gray mb-3">Best Practice • Assets • Domain Mapping
                                                    Matrix</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Third Card (Risk Level Determination) -->
                                <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                    <div
                                        class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                        <div class="p-3 position-relative">
                                            <!-- Image Section -->
                                            <img src="{{ asset('frontend/img/list/6.png') }}"
                                                alt="Risk Level Determination" class="w-100 mb-3 rounded">

                                            <div class="list-card-body">
                                                <h6 class="mb-1">
                                                    <a href="{{ route('tasks.fuzzy-logic') }}"
                                                        class="text-black">Risk
                                                        Level Determination</a>
                                                </h6>
                                                <p class="text-gray mb-3">System Complexity • Impact • Exploitability
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                    <div
                                        class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                        <div class="p-3 position-relative">
                                            <!-- Image Section -->
                                            <img src="{{ asset('frontend/img/list/10.png') }}"
                                                alt="Risk Level Determination" class="w-100 mb-3 rounded">

                                            <div class="list-card-body">
                                                <h6 class="mb-1">
                                                    <a href="{{ route('tasks.cost_benefit_analysis') }}"
                                                        class="text-black">Cost Benefit Analysis</a>
                                                </h6>
                                                <p class="text-gray mb-3">Cost • Benefit • Assumptions
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Post-assessment Section -->
                        <div class="tab-pane fade" id="postassessment" role="tabpanel"
                            aria-labelledby="postassessment-tab">
                            <h4 class="font-weight-bold mt-0 mb-8">Post Training Activities</h4>
                            <div class="bg-white card mb-8 order-list shadow-lg"
                                style="padding: 20px; min-height: 400px;">
                                <div class="gold-members p-9">
                                    <a href="#">
                                        <div class="media">
                                            <img class="mr-4" src="{{ asset('frontend/img/3.jpg') }}"
                                                alt="Post Training Exercise">
                                            <div class="media-body">
                                                <h6 class="mb-6">
                                                    <a href="https://forms.gle/TF1x4H98BbMQzqLR8" class="text-black"
                                                        style="font-size: 1.5rem; font-weight: bold; color: #db1111; text-decoration: none; padding: 8px 12px; display: inline-block; border-radius: 4px; transition: background-color 0.3s ease, color 0.3s ease;">
                                                        Post Training Exercise Questionnaire
                                                    </a>
                                                </h6>
                                                <p class="text-black mb-1"><i class="icofont-location-arrow"></i>
                                                    Conduct final knowledge assessment</p>
                                                <p class="text-gray mb-3"><i class="icofont-clock-time ml-2"></i>
                                                    <span id="order-time"></span>
                                                </p>

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
                                                        href="https://forms.gle/TF1x4H98BbMQzqLR8" target="_blank"><i
                                                            class="icofont-refresh"></i> VISIT HERE</a>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Addresses Section -->
                        <div class="tab-pane fade center-content" id="addresses" role="tabpanel"
                            aria-labelledby="addresses-tab">
                            <h4 class="font-weight-bold text-center" style="padding: 10px; min-height: 250px;">Manage
                                Addresses</h4>
                            <div class="row">
                                <!-- First Address Box -->
                                <div class="col-md-6">
                                    <div
                                        class="bg-white card addresses-item mb-4 border border-primary shadow address-card">
                                        <div class="gold-members p-4">
                                            <div class="media">
                                                <div class="mr-3"><i class="icofont-ui-home icofont-3x"></i></div>
                                                <div class="media-body">
                                                    <h6 class="mb-1 text-secondary">Cyber Resilience Lab</h6>
                                                    <p class="text-black">3rd Floor, Building A, 8916-5 Takayama,
                                                        Ikoma, Nara 630-0192, Japan</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Second Address Box -->
                                <div class="col-md-6">
                                    <div class="bg-white card addresses-item mb-4 shadow-sm address-card">
                                        <div class="gold-members p-4">
                                            <div class="media">
                                                <div class="mr-3"><i class="icofont-briefcase icofont-3x"></i></div>
                                                <div class="media-body">
                                                    <h6 class="mb-1">ICSCoE Japan</h6>
                                                    <p>2-28-8 Honkomagome, Bunkyo-ku, Tokyo, Japan 113-6591</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div> <!-- End of Tab Content -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- CSS for Hover Effect with Glowing Gold Effect -->
<style>
    /* Address card hover effect */
    .address-card {
        transition: all 0.3s ease;
    }

    .address-card:hover {
        background-color: #ffd700;
        /* Gold background on hover */
        box-shadow: 0px 0px 15px 5px rgba(255, 215, 0, 0.6), 0px 0px 20px 10px rgba(255, 215, 0, 0.4);
        /* Glowing effect */
        transform: scale(1.02);
        /* Slightly enlarge on hover */
    }
</style>

<script type="text/javascript">
    $(document).ready(function() {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        })
    });
</script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch (type) {
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;

            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;

            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;

            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
    @endif
</script>

@include('frontend.dashboard.footer')
