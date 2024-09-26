@include('frontend.dashboard.header')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cost-Benefit Analysis</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-6">
    <div class="container mx-auto">
        <h2 class="text-2xl font-bold text-center mb-8">Cost-Benefit Analysis</h2>

        <!-- Input Section -->
        <div class="grid grid-cols-2 gap-8">
            <!-- Cost Types -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Cost Types</h3>
                <div class="mb-4">
                    <label>Secure Coding Standard</label>
                    <input type="number" id="cost-secure-coding" class="w-full p-2 border rounded"
                        placeholder="Enter cost">
                </div>
                <div class="mb-4">
                    <label>Secure Coding Training</label>
                    <input type="number" id="cost-secure-training" class="w-full p-2 border rounded"
                        placeholder="Enter cost">
                </div>
                <div class="mb-4">
                    <label>Impact on Coding</label>
                    <input type="number" id="cost-impact-coding" class="w-full p-2 border rounded"
                        placeholder="Enter cost">
                </div>
                <div class="mb-4">
                    <label>Effect on the Review Cycle</label>
                    <input type="number" id="cost-review-cycle" class="w-full p-2 border rounded"
                        placeholder="Enter cost">
                </div>
                <div class="mb-4">
                    <label>Operational Cost (EC2, EKS, S3, Network Fees)</label>
                    <input type="number" id="cost-operational" class="w-full p-2 border rounded"
                        placeholder="Enter cost">
                </div>
                <div class="mb-4">
                    <label>Cloud Security Tools</label>
                    <input type="number" id="cost-cloud-security" class="w-full p-2 border rounded"
                        placeholder="Enter cost">
                </div>
                <div class="mb-4">
                    <label>Maintenance and Support</label>
                    <input type="number" id="cost-maintenance" class="w-full p-2 border rounded"
                        placeholder="Enter cost">
                </div>
                <div class="mb-4">
                    <label class="font-bold">Total Cost</label>
                    <input type="number" id="total-cost" class="w-full p-2 border rounded bg-gray-200" readonly>
                </div>
            </div>

            <!-- Benefit Types -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Benefit Types</h3>
                <div class="mb-4">
                    <label>Reduction in Rework</label>
                    <input type="number" id="benefit-rework" class="w-full p-2 border rounded"
                        placeholder="Enter benefit">
                </div>
                <div class="mb-4">
                    <label>Confidentiality</label>
                    <input type="number" id="benefit-confidentiality" class="w-full p-2 border rounded"
                        placeholder="Enter benefit">
                </div>
                <div class="mb-4">
                    <label>Integrity</label>
                    <input type="number" id="benefit-integrity" class="w-full p-2 border rounded"
                        placeholder="Enter benefit">
                </div>
                <div class="mb-4">
                    <label>Availability</label>
                    <input type="number" id="benefit-availability" class="w-full p-2 border rounded"
                        placeholder="Enter benefit">
                </div>
                <div class="mb-4">
                    <label>Authentication</label>
                    <input type="number" id="benefit-authentication" class="w-full p-2 border rounded"
                        placeholder="Enter benefit">
                </div>
                <div class="mb-4">
                    <label>Authorization</label>
                    <input type="number" id="benefit-authorization" class="w-full p-2 border rounded"
                        placeholder="Enter benefit">
                </div>
                <div class="mb-4">
                    <label>Non-Repudiation</label>
                    <input type="number" id="benefit-non-repudiation" class="w-full p-2 border rounded"
                        placeholder="Enter benefit">
                </div>
                <div class="mb-4">
                    <label>Quantifiable Aspects (Energy Saving, Staff Optimization)</label>
                    <input type="number" id="benefit-quantifiable" class="w-full p-2 border rounded"
                        placeholder="Enter benefit">
                </div>
                <div class="mb-4">
                    <label class="font-bold">Total Benefit</label>
                    <input type="number" id="total-benefit" class="w-full p-2 border rounded bg-gray-200" readonly>
                </div>
            </div>
        </div>

        <!-- Years and Discount Rate -->
        <div class="mt-8">
            <label>Years</label>
            <input type="number" id="years" class="w-full p-2 border rounded mb-4"
                placeholder="Enter number of years" value="0">
            <label class="mt-4">Discount Rate (%)</label>
            <input type="number" id="discount-rate" class="w-full p-2 border rounded"
                placeholder="Enter discount rate" value="0">
        </div>

        <!-- Buttons -->
        <div class="mt-8 flex justify-between">
            <button id="calculate" class="bg-blue-500 text-white px-4 py-2 rounded">Calculate</button>
            <button id="reset" class="bg-red-500 text-white px-4 py-2 rounded">Reset</button>
        </div>

        <!-- Results and Graph -->
        <div class="mt-8 grid grid-cols-2 gap-8">
            <div>
                <h3 class="text-lg font-semibold mb-4">Results Table</h3>
                <table class="table-auto w-full mt-4">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">Year</th>
                            <th class="border px-4 py-2">Cost</th>
                            <th class="border px-4 py-2">Benefit</th>
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
        <div class="mt-8">
            <h3 class="text-lg font-semibold">Summary</h3>
            <p><strong>NPV:</strong> <span id="npv-result">$0.00</span></p>
            <p><strong>BCR:</strong> <span id="bcr-result">0.00</span></p>
            <p><strong>IRR:</strong> <span id="irr-result">0.00%</span></p>
        </div>

        <!-- Conclusion -->
        <div id="notification"
            class="hidden mt-8 p-4 bg-yellow-100 text-yellow-800 border border-yellow-600 rounded text-center">
            <!-- Notification will be shown here -->
        </div>
    </div>

    <script src="{{ asset('js/analysis.js') }}"></script>
</body>

</html>

@include('frontend.dashboard.footer')
