@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <!-- Enlarged title -->
        <h1
            class="text-center text-5xl font-extrabold text-gray-800 mb-12 transition-all duration-500 ease-in-out transform hover:scale-110">
            Learning Materials
        </h1>

        @if ($materials->isEmpty())
            <div class="alert alert-info text-center">
                <p>No materials available at the moment.</p>
            </div>
        @else
            <!-- Responsive grid for materials -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($materials as $material)
                    <!-- Box wrapper to handle individual resizing -->
                    <div class="relative">
                        <!-- Card container -->
                        <div id="material-card-{{ $material->id }}"
                            class="material-card border border-gray-300 rounded-lg shadow-lg p-4 bg-white cursor-pointer transition-transform duration-500 ease-in-out transform {{ $material->status_completed ? 'bg-gray-200' : '' }}">
                            <div>
                                <!-- Material Title with animation -->
                                <a href="javascript:void(0);"
                                    class="text-xl font-semibold text-blue-600 transition-transform duration-500 ease-in-out"
                                    onclick="expandBox({{ $material->id }})">
                                    {{ $material->title }}
                                </a>
                            </div>

                            <!-- Hidden Details Section -->
                            <div id="material-details-{{ $material->id }}" class="hidden mt-4">
                                @if ($material->image)
                                    <img src="{{ url('upload/materials_images/' . $material->image) }}"
                                        class="rounded-md mb-4 w-full h-48 object-cover" alt="{{ $material->title }}">
                                @else
                                    <img src="{{ url('upload/no_image.jpg') }}"
                                        class="rounded-md mb-4 w-full h-48 object-cover" alt="No image available">
                                @endif

                                <!-- Description from CKEditor (HTML supported) -->
                                <div class="text-gray-700 ck-content text-justify">
                                    {!! $material->long_description !!}
                                </div>

                                <div class="mt-4 text-sm text-gray-500">
                                    <strong>Category ID:</strong> {{ $material->category_id }} <br>
                                    <strong>Pretasks ID:</strong> {{ $material->pretasks_id }}
                                </div>

                                <!-- Mark as Completed/Incomplete buttons with improved aesthetics -->
                                <div class="mt-4 flex justify-between items-center">
                                    <!-- Mark as Completed Button -->
                                    <button id="complete-btn-{{ $material->id }}"
                                        onclick="markAsCompleted({{ $material->id }})"
                                        class="bg-light-gold text-gray-800 font-bold py-2 px-4 rounded-full shadow-md hover:bg-gold-600 transition duration-500 ease-in-out {{ $material->status_completed ? 'hidden' : '' }}">
                                        Mark as Completed
                                    </button>

                                    <!-- Mark as Incomplete Button -->
                                    <button id="incomplete-btn-{{ $material->id }}"
                                        onclick="markAsIncomplete({{ $material->id }})"
                                        class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-full transition duration-500 ease-in-out {{ $material->status_completed ? '' : 'hidden' }}">
                                        Mark as Incomplete
                                    </button>

                                    <!-- Close Button to shrink the box and hide details -->
                                    <button onclick="shrinkBox({{ $material->id }})"
                                        class="bg-light-gold text-gray-800 font-bold py-2 px-4 rounded-full shadow-md hover:bg-gold-600 transition duration-500 ease-in-out">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- JavaScript to toggle material details, center the clicked material, and mark as completed/incomplete -->
    <script>
        let previousPosition = {}; // Store the previous position for resetting

        function expandBox(id) {
            // Store the original position before expanding
            let card = document.getElementById('material-card-' + id);
            previousPosition[id] = card.getBoundingClientRect(); // Save the original position and size

            // Reset any previous expanded boxes
            document.querySelectorAll('.material-card').forEach(function(card) {
                card.style.position = 'relative';
                card.style.transform = 'scale(1)';
                card.style.width = 'auto';
                card.style.height = 'auto';
                card.style.zIndex = '0';
            });

            // Expand only the clicked box and move it to the center
            card.style.position = 'fixed'; // Position it fixed to make it float over everything
            card.style.left = '50%'; // Center horizontally
            card.style.top = '50%'; // Center vertically
            card.style.transform = 'translate(-50%, -50%) scale(1.3)'; // Make it bigger and move it to the middle
            card.style.zIndex = '10'; // Ensure the clicked card appears on top of others
            card.style.width = '60vw'; // Make the box wider
            card.style.height = 'auto'; // Keep the height dynamic based on content

            // Show the details
            var details = document.getElementById('material-details-' + id);
            details.classList.remove('hidden');
        }

        function shrinkBox(id) {
            // Shrink the card back to its original position and size
            let card = document.getElementById('material-card-' + id);

            card.style.position = 'absolute'; // Use absolute positioning
            card.style.left = previousPosition[id].left + 'px'; // Reset to original left
            card.style.top = previousPosition[id].top + 'px'; // Reset to original top
            card.style.width = previousPosition[id].width + 'px'; // Reset to original width
            card.style.height = previousPosition[id].height + 'px'; // Reset to original height

            setTimeout(function() {
                // After the transition, reset the position
                card.style.position = 'relative';
                card.style.transform = 'scale(1)';
                card.style.width = 'auto';
                card.style.height = 'auto';
                card.style.left = '';
                card.style.top = '';
                card.style.zIndex = '0';
            }, 600); // Timeout matches the transition duration to ensure smooth reset

            // Hide the details
            var details = document.getElementById('material-details-' + id);
            details.classList.add('hidden');
        }

        function markAsCompleted(id) {
            var card = document.getElementById('material-card-' + id);
            var completeBtn = document.getElementById('complete-btn-' + id);
            var incompleteBtn = document.getElementById('incomplete-btn-' + id);

            // Change the background color of the card to gray and update buttons
            card.classList.add('bg-gray-200');
            completeBtn.classList.add('hidden');
            incompleteBtn.classList.remove('hidden');
        }

        function markAsIncomplete(id) {
            var card = document.getElementById('material-card-' + id);
            var completeBtn = document.getElementById('complete-btn-' + id);
            var incompleteBtn = document.getElementById('incomplete-btn-' + id);

            // Change the background color of the card to white and update buttons
            card.classList.remove('bg-gray-200');
            incompleteBtn.classList.add('hidden');
            completeBtn.classList.remove('hidden');
        }
    </script>

    <!-- Tailwind CSS Styles for Hover, Active Card, and Layout -->
    <style>
        /* Basic card styles */
        .material-card {
            border: 1px solid #ccc;
            transition: all 0.6s ease-in-out;
            /* Smooth scaling and transition */
        }

        /* Hover effect */
        .material-card:hover {
            background-color: #ff6347;
            /* Change to red when hovering */
            border-color: #ff6347;
            color: white;
        }

        /* Title hover animation */
        .material-card a {
            transition: transform 0.6s ease-in-out, font-size 0.6s ease-in-out;
        }

        .material-card a:hover {
            transform: scale(1.1);
            font-size: 1.5rem;
        }

        /* CKEditor content, now justified */
        .ck-content {
            line-height: 1.6;
            font-size: 1rem;
            color: #333;
            text-align: justify;
            /* Ensure justification */
        }

        .ck-content p {
            margin-bottom: 1rem;
        }

        .ck-content h1,
        .ck-content h2,
        .ck-content h3 {
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
        }

        /* Styling for the "Mark as Completed" button */
        .bg-light-gold {
            background-color: #f9d56e;
        }

        .hover\:bg-gold-600:hover {
            background-color: #f2c14e;
        }

        /* Gray background for completed cards */
        .bg-gray-200 {
            background-color: #e2e8f0 !important;
        }
    </style>
@endsection
