@include('frontend.dashboard.header')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cost-Benefit Analysis</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Title styling */
        h2 {
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            color: #ff9900;
            position: relative;
            display: inline-block;
            width: 100%;
        }

        /* Smaller and closer question mark */
        .question-mark {
            font-size: 1.2rem;
            color: #ffffff;
            background-color: #ff9900;
            padding: 2px 5px;
            border-radius: 50%;
            margin-left: 5px;
            cursor: pointer;
            transition: color 0.3s ease, text-shadow 0.3s ease, background-color 0.3s ease;
            vertical-align: super;
            /* Ensures it's positioned like a superscript */
            position: relative;
            top: 3px;
            /* Adjust this value to move it slightly lower */
        }

        /* Glowing effect on question mark hover */
        .question-mark:hover {
            background-color: #fff;
            color: #ffd700;
            text-shadow: 0 0 8px rgba(255, 215, 0, 0.8), 0 0 16px rgba(255, 215, 0, 0.8);
        }

        /* Description box styling */
        #description-box {
            font-size: 1.4rem;
            color: #ffffff;
            text-align: center;
            margin: 20px auto;
            max-width: 800px;
            background-color: rgba(0, 0, 0, 0.85);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
            opacity: 0;
            display: none;
            transition: opacity 0.5s ease-in-out 0.3s, text-shadow 0.3s ease-in-out, font-size 0.3s ease-in-out;
        }

        /* Text inside the description box */
        #description-box p {
            color: #ffffff;
            text-shadow: 0 0 12px rgba(255, 255, 255, 1), 0 0 24px rgba(255, 255, 255, 1);
            transition: font-size 0.3s ease, text-shadow 0.3s ease;
        }

        /* Glowing and enlarging effect inside the box */
        #description-box p:hover {
            color: #ffd700;
            text-shadow: 0 0 16px rgba(255, 215, 0, 1), 0 0 32px rgba(255, 215, 0, 1);
            font-size: 1.8rem;
        }

        /* Ensure the box becomes visible on hover or click */
        #description-box.active {
            opacity: 1;
            display: block;
        }
    </style>

</head>

<body class="bg-gray-100 p-6">
    <div class="hover-container text-center"> <!-- Ensures centering of content -->
        <!-- Title with Question Mark -->
        <h2 class="text-3xl font-bold text-center mb-8">
            Cost-Benefit Analysis
            <span class="question-mark" onclick="toggleDescription()">?</span> <!-- Small question mark -->
        </h2>

        <!-- Description Box (Initially Hidden) -->
        <div id="description-box">
            <p><strong>Cost-Benefit Analysis (CBA):</strong> A financial process used to evaluate the feasibility of a
                project by comparing expected costs and benefits. The goal is to determine whether the benefits outweigh
                the costs. CBA is widely applied in fields like economics, engineering, and public policy to make
                data-driven decisions.</p>
            <br><br>
            <p><strong>コストベネフィット分析:</strong>
                プロジェクトの実現可能性を評価するために、予想されるコストと利益を比較する財務プロセス。コストを上回る利益があるかどうかを判断します。データに基づいた意思決定を行うために、経済学、工学、公共政策などで広く応用されています。
            </p>
        </div>
    </div>


    <!-- Initial Input: Specify Initial Investment and Discount Rate -->
    <div class="flex justify-center mb-6">
        <div class="text-center mr-6">
            <label for="initial-investment" class="block mb-1 font-semibold text-lg">Insert Initial
                Investment:</label>
            <input type="number" id="initial-investment" placeholder="Enter initial money value of investment"
                class="w-80 p-2 border rounded text-center" />
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
            <table class="w-full mb-4 text-center border-collapse border border-gray-400">
                <thead id="cost-table-headers" class="bg-gray-200">
                    <!-- Dynamically Generated -->
                </thead>
                <tbody id="cost-table-body" class="border-t">
                    <!-- Dynamically Generated -->
                </tbody>
            </table>
        </div>

        <!-- Operational Benefit Types Table -->
        <div id="benefit-section">
            <h3 class="text-xl font-semibold mb-4 text-center">Operational Benefit Types</h3>
            <table class="w-full mb-4 text-center border-collapse border border-gray-400">
                <thead id="benefit-table-headers" class="bg-gray-200">
                    <!-- Dynamically Generated -->
                </thead>
                <tbody id="benefit-table-body" class="border-t">
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
        <p class="text-lg"><strong>Benefit-Cost Ratio:</strong> <span id="bcr-summary-result">0.00</span></p>
        <p id="notification" class="text-gray-600"></p>
    </div>

    <!-- Chart Section -->
    <div class="chart-container mt-8">
        <canvas id="costBenefitChart" width="400" height="200"></canvas>
    </div>

    <div class="chart-container mt-8">
        <canvas id="netBenefitChart" width="400" height="200"></canvas>
    </div>

    <!-- Overall Summary Section -->
    <div id="overall-summary" class="hidden mt-10 bg-white p-6 shadow-lg rounded-lg">
        <h4 class="text-2xl font-semibold mb-4">Project Summary</h4>
        <p class="text-lg" id="overall-summary-text"></p>
    </div>

    <script>
        function toggleDescription() {
            const descriptionBox = document.getElementById('description-box');
            descriptionBox.classList.toggle('active');
        }
    </script>

    <script src="{{ asset('js/analysis.js') }}"></script>
</body>

</html>

@include('frontend.dashboard.footer')
