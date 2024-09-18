@include('frontend.dashboard.header')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>6x6 Reciprocal Matrix</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">

    <style>
        /* Title styling */
        h2 {
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            color: #ff0000;
            transition: color 0.3s ease, text-shadow 0.3s ease;
        }

        /* Glowing effect on hover */
        h2:hover {
            color: #f59d10;
            text-shadow: 0 0 8px rgba(255, 99, 71, 0.8), 0 0 16px rgba(255, 99, 71, 0.8);
        }

        /* Description box styling with glowing effect */
        #description-box {
            font-size: 1rem;
            color: #fff;
            text-align: center;
            margin: 20px auto;
            max-width: 800px;
            background-color: rgba(0, 0, 0, 0.8);
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            opacity: 0;
            display: none;
            transition: opacity 0.5s ease-in-out, text-shadow 0.3s ease-in-out;
        }

        /* Glowing effect inside the hover box */
        #description-box:hover {
            text-shadow: 0 0 8px rgba(255, 215, 0, 0.8), 0 0 16px rgba(255, 215, 0, 0.6);
        }

        /* Hover triggers the description box to appear */
        h2:hover+#description-box {
            display: block;
            opacity: 1;
        }

        /* Error message styling (hover under the bar) */
        .error-message {
            display: none;
            color: red;
            font-size: 0.8em;
            margin-top: 2px;
        }

        input.out-of-range {
            border-color: red;
            background-color: #ffcccc;
        }

        /* Description column row colors */
        .priority-1 {
            background-color: #ffcccb;
        }

        .priority-2 {
            background-color: #ffe5b4;
        }

        .priority-3 {
            background-color: #ffffe0;
        }

        .priority-4 {
            background-color: #d3ffce;
        }

        .priority-5 {
            background-color: #c1f0f6;
        }

        .priority-6 {
            background-color: #e0ccff;
        }
    </style>
</head>

<body>

    <h2 onmouseover="showDescription()">Multi-Criteria Decision Making - Fuzzy AHP</h2>

    <!-- Description box -->
    <div id="description-box">
        In today's cloud computing world, containerized orchestration is essential for scalability, efficiency, and
        optimizing resources. However, it faces security risks, especially in AWS. To manage these risks, we use the
        fuzzy AHP method with the STRIDE model for decision-making.
        <br><br>
        現代のクラウドコンピューティング環境では、コンテナオーケストレーションはスケーラビリティ、効率性、およびリソースの最適化において重要な役割を果たしています。
        しかし、特にAWS環境では、さまざまなセキュリティリスクにさらされています。これらのリスクを効果的に評価するために、意思決定の枠組みとして
        STRIDEモデルを使用し、ファジーAHP手法を採用しています。
    </div>

    <table id="matrix">
        <thead>
            <tr>
                <th></th>
                <th>A1 Confidentiality</th>
                <th>A2 Integrity</th>
                <th>A3 Availability</th>
                <th>A4 Authentication</th>
                <th>A5 Authorization</th>
                <th>A6 Non Repudiation</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>A1 Confidentiality</th>
                <td><input type="number" id="cell-0-0" disabled></td>
                <td><input type="number" id="cell-0-1" step="any" oninput="validateInput(this)"><span
                        class="error-message">Re-check the value</span></td>
                <td><input type="number" id="cell-0-2" step="any" oninput="validateInput(this)"><span
                        class="error-message">Re-check the value</span></td>
                <td><input type="number" id="cell-0-3" step="any" oninput="validateInput(this)"><span
                        class="error-message">Re-check the value</span></td>
                <td><input type="number" id="cell-0-4" step="any" oninput="validateInput(this)"><span
                        class="error-message">Re-check the value</span></td>
                <td><input type="number" id="cell-0-5" step="any" oninput="validateInput(this)"><span
                        class="error-message">Re-check the value</span></td>
            </tr>
            <tr>
                <th>A2 Integrity</th>
                <td><input type="number" id="cell-1-0" step="any" oninput="validateInput(this)"><span
                        class="error-message">Re-check the value</span></td>
                <td><input type="number" id="cell-1-1" disabled></td>
                <td><input type="number" id="cell-1-2" step="any" oninput="validateInput(this)"><span
                        class="error-message">Re-check the value</span></td>
                <td><input type="number" id="cell-1-3" step="any" oninput="validateInput(this)"><span
                        class="error-message">Re-check the value</span></td>
                <td><input type="number" id="cell-1-4" step="any" oninput="validateInput(this)"><span
                        class="error-message">Re-check the value</span></td>
                <td><input type="number" id="cell-1-5" step="any" oninput="validateInput(this)"><span
                        class="error-message">Re-check the value</span></td>
            </tr>
            <tr>
                <th>A3 Availability</th>
                <td><input type="number" id="cell-2-0" step="any" oninput="validateInput(this)"><span
                        class="error-message">Re-check the value</span></td>
                <td><input type="number" id="cell-2-1" step="any" oninput="validateInput(this)"><span
                        class="error-message">Re-check the value</span></td>
                <td><input type="number" id="cell-2-2" disabled></td>
                <td><input type="number" id="cell-2-3" step="any" oninput="validateInput(this)"><span
                        class="error-message">Re-check the value</span></td>
                <td><input type="number" id="cell-2-4" step="any" oninput="validateInput(this)"><span
                        class="error-message">Re-check the value</span></td>
                <td><input type="number" id="cell-2-5" step="any" oninput="validateInput(this)"><span
                        class="error-message">Re-check the value</span></td>
            </tr>
            <tr>
                <th>A4 Authentication</th>
                <td><input type="number" id="cell-3-0" step="any" oninput="validateInput(this)"><span
                        class="error-message">Re-check the value</span></td>
                <td><input type="number" id="cell-3-1" step="any" oninput="validateInput(this)"><span
                        class="error-message">Re-check the value</span></td>
                <td><input type="number" id="cell-3-2" step="any" oninput="validateInput(this)"><span
                        class="error-message">Re-check the value</span></td>
                <td><input type="number" id="cell-3-3" disabled></td>
                <td><input type="number" id="cell-3-4" step="any" oninput="validateInput(this)"><span
                        class="error-message">Re-check the value</span></td>
                <td><input type="number" id="cell-3-5" step="any" oninput="validateInput(this)"><span
                        class="error-message">Re-check the value</span></td>
            </tr>
            <tr>
                <th>A5 Authorization</th>
                <td><input type="number" id="cell-4-0" step="any" oninput="validateInput(this)"><span
                        class="error-message">Re-check the value</span></td>
                <td><input type="number" id="cell-4-1" step="any" oninput="validateInput(this)"><span
                        class="error-message">Re-check the value</span></td>
                <td><input type="number" id="cell-4-2" step="any" oninput="validateInput(this)"><span
                        class="error-message">Re-check the value</span></td>
                <td><input type="number" id="cell-4-3" step="any" oninput="validateInput(this)"><span
                        class="error-message">Re-check the value</span></td>
                <td><input type="number" id="cell-4-4" disabled></td>
                <td><input type="number" id="cell-4-5" step="any" oninput="validateInput(this)"><span
                        class="error-message">Re-check the value</span></td>
            </tr>
            <tr>
                <th>A6 Non Repudiation</th>
                <td><input type="number" id="cell-5-0" step="any" oninput="validateInput(this)"><span
                        class="error-message">Re-check the value</span></td>
                <td><input type="number" id="cell-5-1" step="any" oninput="validateInput(this)"><span
                        class="error-message">Re-check the value</span></td>
                <td><input type="number" id="cell-5-2" step="any" oninput="validateInput(this)"><span
                        class="error-message">Re-check the value</span></td>
                <td><input type="number" id="cell-5-3" step="any" oninput="validateInput(this)"><span
                        class="error-message">Re-check the value</span></td>
                <td><input type="number" id="cell-5-4" step="any" oninput="validateInput(this)"><span
                        class="error-message">Re-check the value</span></td>
                <td><input type="number" id="cell-5-5" disabled></td>
            </tr>
            <tr>
                <th>Sum</th>
                <td id="sum-0">0</td>
                <td id="sum-1">0</td>
                <td id="sum-2">0</td>
                <td id="sum-3">0</td>
                <td id="sum-4">0</td>
                <td id="sum-5">0</td>
            </tr>
        </tbody>
    </table>

    <div class="button-group">
        <button id="reset-button">Reset</button>
        <button id="edit-button">Edit</button>
        <button id="compute-ahp" onclick="computeFuzzyAHP()">Compute Fuzzy AHP</button>
    </div>

    <!-- Linguistic Variables Table -->
    <div id="linguistic-variables">
        <h3>Linguistic Variables for Pairwise Comparison</h3>
        <table id="linguistic-matrix">
            <thead>
                <tr>
                    <th>A1 Confidentiality</th>
                    <th>A2 Integrity</th>
                    <th>A3 Availability</th>
                    <th>A4 Authentication</th>
                    <th>A5 Authorization</th>
                    <th>A6 Non Repudiation</th>
                </tr>
            </thead>
            <tbody id="linguistic-body">
                <!-- Rows will be populated here dynamically -->
            </tbody>
        </table>
    </div>

    <div id="result" style="display: none;">
        <h3>Fuzzy AHP Results</h3>
        <table>
            <thead>
                <tr>
                    <th>Criterion</th>
                    <th>Original Value</th>
                    <th>Linguistic Variables</th>
                    <th>Fuzzy Geometric Mean</th>
                    <th>Fuzzy Weight Criteria</th>
                    <th>Defuzzification</th>
                    <th>Center of Area</th>
                    <th>Normalized Value</th>
                </tr>
            </thead>
            <tbody id="result-output">
                <!-- Rows will be populated here -->
            </tbody>
        </table>
        <div>
            <span>Sum of Center of Area: <span id="sum-center">0.0</span></span>
            <span>Sum of Normalized Values: <span id="sum-normalized">0.0</span></span>
        </div>
    </div>

    <!-- Priority Table -->
    <div id="priority-table-container" style="display:none;">
        <h3>Priority Table</h3>
        <table id="priority-table">
            <thead>
                <tr>
                    <th>Normalized Value</th>
                    <th>Aspect</th>
                    <th>Priority Number</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <script src="{{ asset('js/scripts.js') }}"></script>
    <script>
        // Function to validate inputs between 0.111111 and 9, excluding 0
        function validateInput(inputElement) {
            const value = parseFloat(inputElement.value);
            const errorMessage = inputElement.nextElementSibling;

            if (value < 0.111111 || value > 9 || value === 0) {
                inputElement.classList.add('out-of-range'); // Make input box red
                errorMessage.style.display = 'block'; // Show error message below input
            } else {
                inputElement.classList.remove('out-of-range'); // Reset input styling
                errorMessage.style.display = 'none'; // Hide error message
            }
        }

        // Function to compute Fuzzy AHP and assign priorities with colors
        function computeFuzzyAHP() {
            const normalizedValues = [{
                    criterion: 'A1 Confidentiality',
                    value: parseFloat(document.getElementById('cell-0-0').value || 0)
                },
                {
                    criterion: 'A2 Integrity',
                    value: parseFloat(document.getElementById('cell-1-0').value || 0)
                },
                {
                    criterion: 'A3 Availability',
                    value: parseFloat(document.getElementById('cell-2-0').value || 0)
                },
                {
                    criterion: 'A4 Authentication',
                    value: parseFloat(document.getElementById('cell-3-0').value || 0)
                },
                {
                    criterion: 'A5 Authorization',
                    value: parseFloat(document.getElementById('cell-4-0').value || 0)
                },
                {
                    criterion: 'A6 Non Repudiation',
                    value: parseFloat(document.getElementById('cell-5-0').value || 0)
                }
            ];

            // Sort values from highest to lowest
            normalizedValues.sort((a, b) => b.value - a.value);

            // Assign priorities based on the sorted values
            const priorities = ['1st', '2nd', '3rd', '4th', '5th', '6th'];
            const priorityClasses = ['priority-1', 'priority-2', 'priority-3', 'priority-4', 'priority-5', 'priority-6'];

            // Populate the result-output table
            const resultOutput = document.getElementById('result-output');
            resultOutput.innerHTML = ''; // Clear previous results

            normalizedValues.forEach((item, index) => {
                const row = document.createElement('tr');
                row.classList.add(priorityClasses[index]);

                row.innerHTML = `
                    <td>${item.criterion}</td>
                    <td>${item.value.toFixed(4)}</td>
                    <td>Linguistic Variable ${index + 1}</td>
                    <td>Fuzzy Geometric Mean ${index + 1}</td>
                    <td>Fuzzy Weight Criteria ${index + 1}</td>
                    <td>Defuzzification ${index + 1}</td>
                    <td>Center of Area ${index + 1}</td>
                    <td>${item.value.toFixed(4)}</td>
                    <td>${priorities[index]}</td>
                `;

                resultOutput.appendChild(row);
            });

            // Show the results
            document.getElementById('result').style.display = 'block';
        }

        // Function to show the description
        function showDescription() {
            const descriptionBox = document.getElementById("description-box");
            descriptionBox.style.display = "block";
            descriptionBox.style.opacity = "1";

            // Hide the box after 10 seconds
            setTimeout(function() {
                descriptionBox.style.opacity = "0";
                setTimeout(function() {
                    descriptionBox.style.display = "none";
                }, 500); // Wait for opacity transition before hiding completely
            }, 5000); // 10-second delay
        }
    </script>

</body>

</html>

@include('frontend.dashboard.footer')
