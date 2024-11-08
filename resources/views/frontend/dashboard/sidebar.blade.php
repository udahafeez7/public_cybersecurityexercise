@php
    $id = Auth::user()->id;
    $profileData = App\Models\User::find($id);
@endphp

<!-- Sidebar and Content Container -->
<div class="d-flex">
    <!-- Sidebar -->
    <div class="expanded-sidebar"
        style="position: fixed; top: 0; left: 0; height: 600vh; width: 280px; overflow-y: auto; padding-top: 0;">
        <div class="osahan-account-page-left h-full"
            style="
            background: linear-gradient(to bottom, #ffffff, #ffffff);
            color: #333;
            padding: 20px; /* Reduced padding for closer alignment to top */
            border-radius: 0 0 0 0; /* Rounded corners on right side only */
            box-shadow: 2px 0px 5px rgba(0, 0, 0, 0.15);
            ">
            <!-- User Profile Section -->
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
                <li class="nav-item">
                    <a class="nav-link text-left menu-item {{ request()->is('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}" role="tab" aria-controls="profile"
                        aria-selected="{{ request()->is('dashboard') ? 'true' : 'false' }}">
                        <i class="icofont-user mr-2"></i> User Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-left menu-item" id="preassessment-tab" data-toggle="tab"
                        href="#preassessment" role="tab" aria-controls="preassessment" aria-selected="false">
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
                <!-- Video Link -->
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
                    <a class="nav-link text-left menu-item" id="postassessment-tab" data-toggle="tab"
                        href="#postassessment" role="tab" aria-controls="postassessment" aria-selected="false">
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

    <!-- Main Content Area -->
    <div class="content-area" style="padding-right: 300px; width: calc(100% - 300px);">
        {{-- <h1>Main Content Area</h1>
        <p>This is the main content section that appears beside the expanded sidebar.</p> --}}
        <!-- Other content goes here -->
    </div>
</div>

<!-- Sidebar and Navbar Styles -->
<style>
    /* Sidebar and Navbar Styling */
    .expanded-sidebar {
        width: 280px;
    }

    .content-area {
        margin-right: 400px;
        padding: 10px;
    }

    .nav-link.menu-item {
        font-size: 0.95rem;
        background-color: #ffd000 !important;
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
