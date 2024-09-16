@include('frontend.dashboard.header')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>6x6 Reciprocal Matrix</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <h2>Fuzzy AHP</h2>
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
                <td><input type="number" id="cell-0-1" step="any" oninput="updateSpecificReciprocals()"></td>
                <td><input type="number" id="cell-0-2" step="any" oninput="updateSpecificReciprocals()"></td>
                <td><input type="number" id="cell-0-3" step="any" oninput="updateSpecificReciprocals()"></td>
                <td><input type="number" id="cell-0-4" step="any" oninput="updateSpecificReciprocals()"></td>
                <td><input type="number" id="cell-0-5" step="any" oninput="updateSpecificReciprocals()"></td>
            </tr>
            <tr>
                <th>A2 Integrity</th>
                <td><input type="number" id="cell-1-0" step="any" oninput="updateSpecificReciprocals()"></td>
                <td><input type="number" id="cell-1-1" disabled></td>
                <td><input type="number" id="cell-1-2" step="any" oninput="updateSpecificReciprocals()"></td>
                <td><input type="number" id="cell-1-3" step="any" oninput="updateSpecificReciprocals()"></td>
                <td><input type="number" id="cell-1-4" step="any" oninput="updateSpecificReciprocals()"></td>
                <td><input type="number" id="cell-1-5" step="any" oninput="updateSpecificReciprocals()"></td>
            </tr>
            <tr>
                <th>A3 Availability</th>
                <td><input type="number" id="cell-2-0" step="any" oninput="updateSpecificReciprocals()"></td>
                <td><input type="number" id="cell-2-1" step="any" oninput="updateSpecificReciprocals()"></td>
                <td><input type="number" id="cell-2-2" disabled></td>
                <td><input type="number" id="cell-2-3" step="any" oninput="updateSpecificReciprocals()"></td>
                <td><input type="number" id="cell-2-4" step="any" oninput="updateSpecificReciprocals()"></td>
                <td><input type="number" id="cell-2-5" step="any" oninput="updateSpecificReciprocals()"></td>
            </tr>
            <tr>
                <th>A4 Authentication</th>
                <td><input type="number" id="cell-3-0" step="any" oninput="updateSpecificReciprocals()"></td>
                <td><input type="number" id="cell-3-1" step="any" oninput="updateSpecificReciprocals()"></td>
                <td><input type="number" id="cell-3-2" step="any" oninput="updateSpecificReciprocals()"></td>
                <td><input type="number" id="cell-3-3" disabled></td>
                <td><input type="number" id="cell-3-4" step="any" oninput="updateSpecificReciprocals()"></td>
                <td><input type="number" id="cell-3-5" step="any" oninput="updateSpecificReciprocals()"></td>
            </tr>
            <tr>
                <th>A5 Authorization</th>
                <td><input type="number" id="cell-4-0" step="any" oninput="updateSpecificReciprocals()"></td>
                <td><input type="number" id="cell-4-1" step="any" oninput="updateSpecificReciprocals()"></td>
                <td><input type="number" id="cell-4-2" step="any" oninput="updateSpecificReciprocals()"></td>
                <td><input type="number" id="cell-4-3" step="any" oninput="updateSpecificReciprocals()"></td>
                <td><input type="number" id="cell-4-4" disabled></td>
                <td><input type="number" id="cell-4-5" step="any" oninput="updateSpecificReciprocals()"></td>
            </tr>
            <tr>
                <th>A6 Non Repundiation</th>
                <td><input type="number" id="cell-5-0" step="any" oninput="updateSpecificReciprocals()"></td>
                <td><input type="number" id="cell-5-1" step="any" oninput="updateSpecificReciprocals()"></td>
                <td><input type="number" id="cell-5-2" step="any" oninput="updateSpecificReciprocals()"></td>
                <td><input type="number" id="cell-5-3" step="any" oninput="updateSpecificReciprocals()"></td>
                <td><input type="number" id="cell-5-4" step="any" oninput="updateSpecificReciprocals()"></td>
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
        <button id="compute-ahp">Compute Fuzzy AHP</button>
    </div>
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
                    <th>A6 Non Repundiation</th>
                </tr>
            </thead>
            <tbody id="linguistic-body">
                <!-- Rows will be populated here -->
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
            <tbody id="result-output"></tbody>
        </table>
        <div>
            <span>Sum of Center of Area: <span id="sum-center">0.0</span></span>
            <span>Sum of Normalized Values: <span id="sum-normalized">0.0</span></span>
        </div>
    </div>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>

</html>

@include('frontend.dashboard.footer')
