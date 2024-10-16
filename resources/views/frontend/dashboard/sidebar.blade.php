@php
    $id = Auth::user()->id;
    $profileData = App\Models\User::find($id);
@endphp

<div class="col-md-3"> <!-- Reduced width from col-md-4 to col-md-3 -->
    <div class="osahan-account-page-left shadow-lg rounded-lg h-full"
        style="
        background: linear-gradient(to bottom, #ffffff, #ffffff);
        color: #333;
        padding: 25px; /* Slightly reduced padding */
        border: 3px solid #ffd666;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(182, 130, 6, 0.6), 0px 6px 18px rgba(0, 0, 0, 0.15);
        ">
        <div class="osahan-user text-center">
            <div class="osahan-user-media">
                <img class="mb-3 rounded-full shadow-lg"
                    src="{{ !empty($profileData->photo) ? url('upload/user_images/' . $profileData->photo) : url('upload/no_image.jpg') }}"
                    alt="Profile Image"
                    style="
                    width: 120px;
                    height: 120px;
                    border: 4px solid #d59c0d;
                    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                    background: #fff;
                    transition: transform 0.3s ease;
                    ">
                <div class="osahan-user-media-body mt-4">
                    <h6 class="mb-1 text-lg font-bold">{{ $profileData->name }}</h6>
                    <p class="mb-1 text-sm">{{ $profileData->phone }}</p>
                    <p class="text-sm">{{ $profileData->email }}</p>
                </div>
            </div>
        </div>

        <!-- Separation Line -->
        <hr class="border-t-2 border-yellow-400 my-4">

        <!-- Sidebar Navigation Menu -->
        <ul class="nav flex-column border-0" id="myTab" role="tablist" style="padding: 0;">

            <!-- User Profile Link -->
            <li class="nav-item">
                <a class="nav-link text-left menu-item {{ request()->is('dashboard') ? 'active' : '' }}"
                    href="{{ route('dashboard') }}" role="tab" aria-controls="profile"
                    aria-selected="{{ request()->is('dashboard') ? 'true' : 'false' }}">
                    <i class="icofont-user mr-2"></i> User Profile
                </a>
            </li>

            <!-- Preassessment Link -->
            <li class="nav-item">
                <a class="nav-link text-left menu-item" id="preassessment-tab" data-toggle="tab" href="#preassessment"
                    role="tab" aria-controls="preassessment" aria-selected="false">
                    <i class="icofont-food-cart mr-2"></i> Preassessment
                </a>
            </li>

            <!-- Learning Materials Link -->
            <li class="nav-item">
                <a class="nav-link text-left menu-item" id="learning-tab" data-toggle="tab" href="#learning"
                    role="tab" aria-controls="learning" aria-selected="false">
                    <i class="icofont-sale-discount mr-2"></i> Learning Materials
                </a>
            </li>

            <!-- Learning Materials Link -->
            <li class="nav-item">
                <a class="nav-link text-left menu-item" id="multimedia-tab" data-toggle="tab" href="#multimedia"
                    role="tab" aria-controls="learning" aria-selected="false">
                    <i class="icofont-sale-discount mr-2"></i> Video Repositories
                </a>
            </li>

            <!-- Technical Software Link -->
            <li class="nav-item">
                <a class="nav-link text-left menu-item" id="favourites-tab" data-toggle="tab" href="#favourites"
                    role="tab" aria-controls="favourites" aria-selected="false">
                    <i class="icofont-heart mr-2"></i> Technical Software
                </a>
            </li>

            <!-- Post Assessment Link -->
            <li class="nav-item">
                <a class="nav-link text-left menu-item" id="postassessment-tab" data-toggle="tab" href="#postassessment"
                    role="tab" aria-controls="postassessment" aria-selected="false">
                    <i class="icofont-food-cart mr-2"></i> Post Assessment
                </a>
            </li>

            <!-- Addresses Link -->
            <li class="nav-item">
                <a class="nav-link text-left menu-item" id="addresses-tab" data-toggle="tab" href="#addresses"
                    role="tab" aria-controls="addresses" aria-selected="false">
                    <i class="icofont-location-pin mr-2"></i> Addresses
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- Sidebar Styles -->
<style>
    .nav-link.menu-item {
        font-size: 0.95rem;
        /* Reduced font size slightly */
        background-color: #ffd000 !important;
        /* Unified color for all menus */
        color: #333 !important;
        border-radius: 6px !important;
        margin-bottom: 10px !important;
        padding: 10px !important;
        transition: background-color 0.3s ease, color 0.3s ease, transform 0.3s ease !important;
        text-decoration: none !important;
        position: relative !important;
        overflow: hidden !important;
    }

    .nav-link.menu-item:hover {
        background-color: #f8be10 !important;
        /* Softer hover effect */
        color: white !important;
        transform: translateX(8px) !important;
    }

    .nav-link.menu-item.active {
        background-color: #ffd000 !important;
        color: #333 !important;
    }

    .osahan-user-media img:hover {
        transform: scale(1.12) !important;
    }

    .nav-link.menu-item::before {
        content: "" !important;
        position: absolute !important;
        top: 0 !important;
        left: -100% !important;
        width: 100% !important;
        height: 100% !important;
        background-color: #f0e68c !important;
        z-index: -1 !important;
        transition: left 0.3s ease !important;
    }

    .nav-link.menu-item:hover::before {
        left: 0 !important;
    }
</style>
