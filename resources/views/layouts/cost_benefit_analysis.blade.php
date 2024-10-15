@include('frontend.dashboard.header')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cost-Benefit Analysis</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100 p-6">
    <div class="container mx-auto">
        <!-- Title -->
        <h2 class="text-3xl font-bold text-center mb-8">Cost-Benefit Analysis</h2>

        <!-- Initial Input: Specify Initial Investment and Discount Rate -->
        <div class="flex justify-center mb-6">
            <div class="text-center mr-6">
                <label for="initial-investment" class="block mb-1 font-semibold text-lg">Insert Initial
                    Investment:</label>
                <input type="number" id="initial-investment" placeholder="Enter initial investment"
                    class="w-80 p-2 border rounded text-right" />
            </div>
            <div class="text-center">
                <label for="discount-rate" class="block mb-1 font-semibold text-lg">Insert Discount Rate (%):</label>
                <input type="number" id="discount-rate" placeholder="Enter discount rate"
                    class="w-40 p-2 border rounded text-center" />
            </div>
        </div>

        <!-- Input for Years of Investment -->
        <div id="years-section" class="flex justify-center mb-6">
            <div class="text-center">
                <label for="years" class="block mb-1 font-semibold text-lg">Insert Number of Years of
                    Investment:</label>
                <input type="number" id="years" placeholder="Enter number of years"
                    class="w-40 p-2 border rounded text-center" />
            </div>
        </div>

        <!-- Expected Value of Initial Investment -->
        <div id="expected-value-section" class="text-center mb-6">
            <p class="text-lg"><strong>Expected Initial Investment:</strong> <span id="expected-value">$0.00</span></p>
        </div>

        <!-- Operational Cost and Benefit Tables Section -->
        <div id="cost-benefit-section" class="mt-8">
            <!-- Operational Cost Types Table -->
            <div id="cost-section">
                <h3 class="text-xl font-semibold mb-4 text-center">Operational Cost Types</h3>
                <table class="w-full mb-4 text-center">
                    <thead id="cost-table-headers">
                        <!-- Dynamically Generated -->
                    </thead>
                    <tbody id="cost-table-body">
                        <!-- Dynamically Generated -->
                    </tbody>
                </table>
            </div>

            <!-- Operational Benefit Types Table -->
            <div id="benefit-section">
                <h3 class="text-xl font-semibold mb-4 text-center">Operational Benefit Types</h3>
                <table class="w-full mb-4 text-center">
                    <thead id="benefit-table-headers">
                        <!-- Dynamically Generated -->
                    </thead>
                    <tbody id="benefit-table-body">
                        <!-- Dynamically Generated -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Compute Button -->
        <div class="action-buttons flex justify-center mt-6">
            <button id="calculate" class="bg-blue-600 text-white px-6 py-3 rounded">Compute</button>
        </div>

        <!-- Results Section -->
        <div id="result-section" class="hidden result-box mt-8 text-center">
            <h3 class="font-bold text-2xl">Investment Summary</h3>
            <p class="text-lg"><strong>NPV:</strong> <span id="npv-result">$0.00</span></p>
            <p class="text-lg"><strong>BCR:</strong> <span id="bcr-result">0.00</span></p>
            <p class="text-lg"><strong>IRR:</strong> <span id="irr-result">0.00%</span></p>
            <p id="notification" class="text-gray-600"></p>
        </div>

        <!-- Chart Section -->
        <div class="chart-container mt-8">
            <canvas id="costBenefitChart"></canvas>
        </div>

        <div class="chart-container mt-8">
            <canvas id="netBenefitChart"></canvas>
        </div>
    </div>

    <script src="{{ asset('js/analysis.js') }}"></script>
</body>

</html>

@include('frontend.dashboard.footer')
