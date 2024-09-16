@php
    $id = Auth::user()->id;
    $profileData = App\Models\User::find($id);

@endphp

<div class="col-md-3">
    <div class="osahan-account-page-left shadow-sm rounded h-100"
        style="
        background: linear-gradient(to bottom, #ffcccc, #ffe6e6); /* Light pink to light red gradient */
        color: #333; /* Dark gray text color for better readability */
        padding: 15px; /* Padding inside the sidebar */
        border: 2px solid #ff6666; /* Red border that matches the theme */
        border-radius: 10px; /* Rounded corners for a softer look */
        box-shadow: 0px 4px 8px rgba(255, 102, 102, 0.5), 0px 6px 20px rgba(0, 0, 0, 0.1); /* Red and subtle shadow effect */
    ">
        <div class="osahan-user text-center">
            <div class="osahan-user-media">
                <img class="mb-3 rounded-pill shadow-sm"
                    src="{{ !empty($profileData->photo) ? url('upload/user_images/' . $profileData->photo) : url('upload/no_image.jpg') }}"
                    alt="gurdeep singh osahan"
                    style="
                    width: 100px; /* Fixed size for the image */
                    height: 100px;
                    border: 4px solid #ff6666; /* Light red border around the image */
                    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for a 3D effect */
                    background: #fff; /* White background to make the image pop */
                    transition: transform 0.3s ease; /* Animation for profile picture */
                ">
                <div class="osahan-user-media-body mt-3">
                    <h6 class="mb-1">{{ $profileData->name }}</h6>
                    <p class="mb-1" style="font-size: 0.875rem;">{{ $profileData->phone }}</p>
                    <p style="font-size: 0.875rem;">{{ $profileData->email }}</p>

                </div>
            </div>
        </div>

        <!-- Separation Line -->
        <hr style="border-top: 1px solid #ff6666; margin: 20px 0;">

        <ul class="nav nav-tabs flex-column border-0" id="myTab" role="tablist" style="padding: 0;">
            <li class="nav-item">
                <a class="nav-link text-left menu-item" href="{{ route('dashboard') }}" role="tab"
                    aria-controls="profile" aria-selected="true"><i class="icofont-user mr-2"></i>
                    User Profile</a>
            <li class="nav-item">
                <a class="nav-link text-left menu-item" href="{{ route('change.password') }}" role="tab"
                    aria-controls="profile" aria-selected="true"><i class="icofont-user mr-2"></i>
                    Change Password</a>

                <a class="nav-link text-left menu-item" id="preassessment-tab" data-toggle="tab" href="#preassessment"
                    role="tab" aria-controls="preassessment" aria-selected="true">
                    <i class="icofont-food-cart mr-2"></i> Preassessment
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-left menu-item" id="learning-tab" data-toggle="tab" href="#learning"
                    role="tab" aria-controls="learning" aria-selected="false">
                    <i class="icofont-sale-discount mr-2"></i> Learning Materials
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-left menu-item" id="favourites-tab" data-toggle="tab" href="#favourites"
                    role="tab" aria-controls="favourites" aria-selected="false"><i class="icofont-heart mr-2"></i>
                    Technical Software</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-left menu-item" id="postassessment-tab" data-toggle="tab" href="#postassessment"
                    role="tab" aria-controls="postassessment" aria-selected="true">
                    <i class="icofont-food-cart mr-2"></i> Post assessment</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-left menu-item" id="addresses-tab" data-toggle="tab" href="#addresses"
                    role="tab" aria-controls="addresses" aria-selected="false"><i
                        class="icofont-location-pin mr-2"></i> Addresses</a>
            </li>
        </ul>
    </div>
</div>

<style>
    /* Default styling for all menu items */
    .nav-link.menu-item {
        background-color: #ffb3b3 !important;
        /* Light red background for uniformity */
        color: #333 !important;
        /* Dark gray text */
        border-radius: 4px !important;
        /* Rounded corners */
        margin-bottom: 8px !important;
        /* Space between items */
        padding: 10px !important;
        /* Padding inside the tab */
        transition: background-color 0.3s ease, color 0.3s ease, transform 0.3s ease !important;
        /* Smooth transition effect */
        text-decoration: none !important;
        /* Remove underline from links */
        position: relative !important;
        overflow: hidden !important;
        /* Ensure animation stays within bounds */
    }

    /* Hover effect for menu items */
    .nav-link.menu-item:hover {
        background-color: #ff6666 !important;
        /* Darker red background on hover */
        color: white !important;
        /* White text on hover */
        transform: translateX(10px) !important;
        /* Slide effect on hover */
    }

    /* Active state to match the same color scheme */
    .nav-link.menu-item.active {
        background-color: #ffb3b3 !important;
        /* Same light red background as others */
        color: #333 !important;
        /* Keep text dark gray */
    }

    /* Animation for profile picture on hover */
    .osahan-user-media img:hover {
        transform: scale(1.1) !important;
        /* Slight zoom on hover */
    }

    /* Animation for hover effect (slide in color) */
    .nav-link.menu-item::before {
        content: "" !important;
        position: absolute !important;
        top: 0 !important;
        left: -100% !important;
        width: 100% !important;
        height: 100% !important;
        background-color: #ff8080 !important;
        /* Slightly darker background for the animation */
        z-index: -1 !important;
        /* Behind the text */
        transition: left 0.3s ease !important;
    }

    .nav-link.menu-item:hover::before {
        left: 0 !important;
        /* Slide the background in from left */
    }
</style>
