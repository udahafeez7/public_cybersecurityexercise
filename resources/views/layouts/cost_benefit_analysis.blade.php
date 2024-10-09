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
        .analysis-table th,
        .analysis-table td {
            padding: 14px 18px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .analysis-table th {
            background-color: #f8f9fa;
        }

        .analysis-table input {
            padding: 12px;
            font-size: 16px;
            width: 120px;
        }

        .analysis-table tfoot td {
            font-weight: bold;
        }

        .action-buttons {
            margin-top: 20px;
        }

        .action-buttons button {
            margin-right: 10px;
        }

        .result-box {
            background-color: white;
            padding: 16px;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .result-box h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body class="bg-gray-100 p-6">
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold text-center mb-8">Cost-Benefit Analysis</h2>

        <div class="flex justify-between mb-4">
            <div>
                <label for="years">Insert Years of Investment:</label>
                <input type="number" id="years" class="w-full border rounded p-2"
                    placeholder="Enter number of years">
            </div>
            <div>
                <label for="risk-level">Select Current Risk Level:</label>
                <select id="risk-level" class="w-full border rounded p-2">
                    <option value="">Choose Risk Level</option>
                    <option value="low">Low Risk</option>
                    <option value="medium">Medium Risk</option>
                    <option value="high">High Risk</option>
                    <option value="catastrophic">Catastrophic Risk</option>
                </select>
            </div>
            <div>
                <label for="risk-scale">Select Risk Scale (%):</label>
                <select id="risk-scale" class="w-full border rounded p-2">
                    <!-- Dynamic options will be populated based on risk level selection -->
                </select>
            </div>
        </div>

        <div>
            <button id="generate-tables" class="bg-blue-500 text-white px-4 py-2 rounded">Generate Cost and Benefit
                Tables</button>
        </div>

        <!-- Cost Table Section -->
        <div id="cost-section" class="hidden mt-8">
            <h3 class="text-lg font-semibold mb-4">Cost Types</h3>
            <table class="table-auto analysis-table w-full mb-4">
                <thead>
                    <tr id="dynamic-cost-headers"></tr>
                </thead>
                <tbody id="cost-table-body"></tbody>
                <tfoot>
                    <tr id="cost-per-column" class="bg-gray-100">
                        <!-- Dynamic cost per column values -->
                    </tr>
                    <tr id="total-cost-row" class="bg-gray-200">
                        <td class="p-2 border font-bold text-right" colspan="100%">Total Cost:</td>
                        <td id="total-cost" class="p-2 border font-bold text-center">0.00</td>
                    </tr>
                </tfoot>
            </table>
            <button id="proceed-benefits" class="bg-green-500 text-white px-4 py-2 rounded">Proceed to Benefits</button>
        </div>

        <!-- Benefit Table Section -->
        <div id="benefit-section" class="hidden mt-8">
            <h3 class="text-lg font-semibold mb-4">Benefit Types</h3>
            <table class="table-auto analysis-table w-full mb-4">
                <thead>
                    <tr id="dynamic-benefit-headers"></tr>
                </thead>
                <tbody id="benefit-table-body"></tbody>
                <tfoot>
                    <tr id="benefit-per-column" class="bg-gray-100">
                        <!-- Dynamic benefit per column values -->
                    </tr>
                    <tr id="total-benefit-row" class="bg-gray-200">
                        <td class="p-2 border font-bold text-right" colspan="100%">Total Benefit:</td>
                        <td id="total-benefit" class="p-2 border font-bold text-center">0.00</td>
                    </tr>
                    <tr id="net-benefit-row" class="bg-gray-300">
                        <td class="p-2 border font-bold text-right" colspan="100%">Net Benefit:</td>
                        <td id="net-benefit" class="p-2 border font-bold text-center">0.00</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Action Buttons -->
        <div id="action-buttons" class="hidden action-buttons">
            <button id="calculate" class="bg-blue-500 text-white px-4 py-2 rounded">Compute</button>
            <button id="reset" class="bg-red-500 text-white px-4 py-2 rounded">Reset</button>
        </div>

        <!-- Results and Graph Section -->
        <div id="result-section" class="hidden mt-8">
            <div class="grid grid-cols-2 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">Results Table</h3>
                    <table class="table-auto w-full mt-4">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">Year</th>
                                <th class="border px-4 py-2">Cost</th>
                                <th class="border px-4 py-2">Benefit</th>
                                <th class="border px-4 py-2">Net Benefit</th>
                            </tr>
                        </thead>
                        <tbody id="results-table"></tbody>
                    </table>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Cost vs. Benefit Graph</h3>
                    <canvas id="costBenefitChart" class="w-full h-64"></canvas>
                </div>
            </div>

            <!-- Summary of NPV, BCR, IRR -->
            <div class="result-box">
                <h3 class="font-bold">Investment Summary</h3>
                <p><strong>NPV:</strong> <span id="npv-result">$0.00</span></p>
                <p><strong>BCR:</strong> <span id="bcr-result">0.00</span></p>
                <p><strong>IRR:</strong> <span id="irr-result">0.00%</span></p>
                <p id="notification" class="text-gray-600"></p>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/analysis.js') }}"></script>
</body>

</html>

@include('frontend.dashboard.footer')
