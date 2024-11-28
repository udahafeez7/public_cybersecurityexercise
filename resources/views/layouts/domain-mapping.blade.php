@include('frontend.dashboard.header')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Singular Value Decomposition & Reduced Complexity Information</title>
    <style>
        /* Ensure the title container is centered */
        .title-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
            text-align: center;
            position: relative;
        }

        /* Title styles - Change color to gold */
        h2 {
            font-size: 2.5rem;
            font-weight: bold;
            color: gold;
            /* Change title color to gold */
            position: relative;
            transition: color 0.3s ease, text-shadow 0.3s ease;
            text-align: center;
        }

        h2:hover {
            color: gold;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.8),
                0 0 20px rgba(255, 215, 0, 0.6),
                0 0 30px rgba(255, 215, 0, 0.4);
        }

        /* Superscript question mark */
        .question-mark {
            font-size: 1rem;
            color: #ffffff;
            background-color: #ff9900;
            padding: 3px 6px;
            border-radius: 50%;
            margin-left: 5px;
            cursor: pointer;
            position: relative;
            top: -10px;
            transition: color 0.3s ease, text-shadow 0.3s ease, background-color 0.3s ease;
        }

        .question-mark:hover {
            background-color: #fff;
            color: #ffd700;
            text-shadow: 0 0 8px rgba(255, 215, 0, 0.8), 0 0 16px rgba(255, 215, 0, 0.8);
        }

        /* Description box styling */
        #hover-box,
        #hover-box-complexity {
            display: none;
            font-size: 1.4rem;
            /* Slightly larger font */
            color: #fff;
            text-align: center;
            margin-top: 10px;
            background-color: rgba(0, 0, 0, 0.85);
            padding: 30px;
            /* Increase padding for larger box */
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
            opacity: 0;
            transition: opacity 0.5s ease-in-out, transform 0.3s ease-in-out;
            width: 90%;
            /* Make the hover box larger */
            max-width: 900px;
            /* Increase the max width */
            position: absolute;
            top: calc(100% + 15px);
            /* More space between title and hover box */
            left: 50%;
            /* Center it horizontally */
            transform: translateX(-50%);
            /* Ensure the box is centered */
        }

        /* Hover Box active state */
        #hover-box.active,
        #hover-box-complexity.active {
            opacity: 1;
            transform: scale(1.05);
            /* Slight enlargement when active */
            display: block;
        }

        /* Glowing effect for the hover box text */
        #hover-box p,
        #hover-box-complexity p {
            font-size: 1.4rem;
            /* Slightly larger font */
            color: white;
            /* Basic white font */
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.8),
                0 0 20px rgba(255, 215, 0, 0.6),
                0 0 30px rgba(255, 215, 0, 0.4);
            transition: transform 0.3s ease, text-shadow 0.3s ease;
        }

        /* Glowing effect and enlargement on hover */
        #hover-box:hover p,
        #hover-box-complexity:hover p {
            transform: scale(1.1);
            /* Enlarge the text on hover */
            text-shadow: 0 0 12px rgba(255, 215, 0, 1),
                0 0 24px rgba(255, 215, 0, 0.8),
                0 0 36px rgba(255, 215, 0, 0.6);
            /* Stronger glow */
        }

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
        }

        h2 {
            color: red;
            position: relative;
            display: inline-block;
            font-size: 24px;
            cursor: pointer;
            transition: color 0.3s ease, text-shadow 0.3s ease;
        }

        h2:hover {
            color: gold;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.8), 0 0 20px rgba(255, 215, 0, 0.6), 0 0 30px rgba(255, 215, 0, 0.4);
        }

        /* Hover box styling */
        #hover-box,
        #hover-box-complexity {
            display: none;
            position: absolute;
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 10px;
            border-radius: 5px;
            z-index: 1000;
            top: 40px;
            left: 0;
            width: 100%;
            box-sizing: border-box;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            font-size: 0.85em;
            transition: font-size 0.2s ease;
        }

        /* Magnify the hover box text when hovering within */
        #hover-box:hover,
        #hover-box-complexity:hover {
            font-size: 1.1em;
        }

        h2:hover #hover-box,
        h2#complexity-title:hover #hover-box-complexity {
            display: block;
        }

        form {
            margin-bottom: 20px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-right: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }

        button:disabled {
            background-color: #ccc;
        }

        .result {
            margin-top: 20px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .result ul {
            list-style-type: none;
            padding: 0;
        }

        .result li {
            margin-bottom: 10px;
            font-size: 1.1em;
        }

        .result span {
            font-weight: bold;
        }

        .input-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="number"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .error {
            color: red;
            display: none;
        }

        .hint {
            color: red;
            font-size: 0.9em;
            display: none;
        }

        .bar-container {
            position: relative;
            background-color: #e0e0e0;
            border-radius: 12px;
            margin-top: 10px;
            width: 80%;
            height: 40px;
            margin-left: auto;
            margin-right: auto;
        }

        .bar {
            position: absolute;
            height: 100%;
            border-radius: 12px;
            transition: width 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-weight: bold;
            font-size: 1.1em;
        }

        .low {
            background-color: green;
        }

        .medium {
            background-color: yellow;
            color: black;
        }

        .high {
            background-color: orange;
        }

        .very-high {
            background-color: red;
        }

        .scale {
            display: flex;
            justify-content: space-between;
            margin-top: 5px;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
            position: relative;
        }

        .scale div {
            text-align: center;
            flex: 1;
            position: relative;
        }

        .scale div::after {
            content: "";
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 1px;
            height: 10px;
            background-color: gold;
        }

        .minor-scale {
            display: flex;
            justify-content: space-between;
            width: 100%;
            position: absolute;
            top: -10px;
        }

        .minor-scale div {
            width: 1px;
            height: 5px;
            background-color: gold;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/numeric/1.2.6/numeric.min.js"></script>
</head>

<body>
    <!-- Title for Singular Value Decomposition -->
    <div class="title-container">
        <h2>Complexity Aspect - Singular Value Decomposition
            <span class="question-mark" onclick="toggleHoverBox()">?</span>
        </h2>
        <div id="hover-box">
            <p>
                The Complexity Aspects aim on generating three key things: Component, Interfaces, and Architecture,
                by applying linear algebra techniques such as Singular Value Decomposition (SVD). These aspects help in
                constructing Reduced Complexity Information.
                <br><br>
                複雑さの側面は、SVD (特異値分解) などの線形代数手法を適用することで、コンポーネント、インターフェイス、アーキテクチャという
                3 つの重要なものを生み出すことを目的としています。これらの側面は、複雑さの軽減された情報を構築するのに役立ちます。
            </p>
        </div>
    </div>

    <form id="dimension-form">
        <label for="rows">Number of Rows:</label>
        <input type="number" id="rows" name="rows" min="1" value="3"
            onfocus="showHint('rows-hint')">
        <div id="rows-hint" class="hint">Indicating the number of Best Practices that we adhere to</div>
        <label for="cols">Number of Columns:</label>
        <input type="number" id="cols" name="cols" min="1" value="3"
            onfocus="showHint('cols-hint')">
        <div id="cols-hint" class="hint">Indicating the number of current assets that we have</div>
        <br><br>
        <button type="submit">Generate Matrix</button>
    </form>

    <form id="matrix-form" style="display: none;">
        <div id="matrix-container"></div>
        <button type="submit">Compute SVD</button>
        <button type="button" id="reset-button">Reset</button>
    </form>
    <div class="result" id="result" style="display: none;">
        <h3>Complexity Results</h3>
        <ul>
            <li><span>Singular Values:</span> <span id="singular-values"></span></li>
            <li><span>Component:</span> <span id="component"></span></li>
            <li><span>Interface:</span> <span id="interface"></span></li>
            <li><span>Architecture:</span> <span id="architecture"></span></li>
        </ul>
    </div>
    <!-- Title for System Complexity -->
    <div class="title-container">
        <h2>Reduced Complexity
            <span class="question-mark" onclick="toggleHoverBoxComplexity()">?</span>
        </h2>
        <div id="hover-box-complexity">
            <p>
                Aim to Generate the Reduced Complexity Information by leveraging Complexity Aspects and Priority Aspects
                from Multi-criteria Decision Making.
                <br><br>
                多基準意思決定から複雑性の側面と優先順位の側面を活用することで、複雑性の低減された情報を生成することを目指す。
            </p>
        </div>
    </div>

    <form id="complexity-form" onsubmit="return computeComplexity();">
        <div class="input-group">
            <label for="availability">Availability</label>
            <input type="number" id="availability" min="0" max="1" step="0.000001" value="0"
                oninput="calculateTotalComplexity()">
        </div>
        <div class="input-group">
            <label for="non_repudiation">Non-Repudiation</label>
            <input type="number" id="non_repudiation" min="0" max="1" step="0.000001" value="0"
                oninput="calculateTotalComplexity()">
        </div>
        <div class="input-group">
            <label for="integrity">Integrity</label>
            <input type="number" id="integrity" min="0" max="1" step="0.000001" value="0"
                oninput="calculateTotalComplexity()">
        </div>
        <div class="input-group">
            <label for="authentication">Authentication</label>
            <input type="number" id="authentication" min="0" max="1" step="0.000001" value="0"
                oninput="calculateTotalComplexity()">
        </div>
        <div class="input-group">
            <label for="authorization">Authorization</label>
            <input type="number" id="authorization" min="0" max="1" step="0.000001" value="0"
                oninput="calculateTotalComplexity()">
        </div>
        <div class="input-group">
            <label for="confidentiality">Confidentiality</label>
            <input type="number" id="confidentiality" min="0" max="1" step="0.000001" value="0"
                oninput="calculateTotalComplexity()">
        </div>

        <div class="input-group">
            <label for="total_complexity">Total Complexity</label>
            <input type="number" id="total_complexity" disabled value="0">
        </div>
        <div class="error" id="input-error">The sum of all inputs must be 1.</div>

        <button type="submit" id="compute-complexity">Compute Complexity</button>
        <button type="button" id="reset-complexity" onclick="resetComplexityInputs()">Reset</button>
    </form>




    <div class="result" id="complexity-result" style="display: none;">
        <h3>Complexity Calculation</h3>
        <ul>
            <li><span>Component Complexity:</span> <span id="component_complexity"></span></li>
            <li><span>Interface Complexity:</span> <span id="interface_complexity"></span></li>
            <li><span>Architecture Complexity:</span> <span id="architecture_complexity"></span></li>
            <li><span>Total System Complexity:</span> <span id="total_system_complexity"></span></li>
            <li><span>The Reduced Complexity Information Level:</span> <span id="complexity_level"></span></li>
        </ul>
        <div class="bar-container">
            <div id="complexity-bar" class="bar"></div>
        </div>
        <div class="scale">
            <div>0</div>
            <div>
                <div class="minor-scale">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>20
            </div>
            <div>
                <div class="minor-scale">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>40
            </div>
            <div>
                <div class="minor-scale">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>60
            </div>
            <div>
                <div class="minor-scale">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>80
            </div>
            <div>100</div>
        </div>
    </div>

    <script src="{{ asset('js/svd2.js') }}"></script>
    <script src="{{ asset('js/complexity.js') }}"></script>
    <script>
        function showHint(hintId) {
            const hintElement = document.getElementById(hintId);
            hintElement.style.display = 'inline';
            setTimeout(() => {
                hintElement.style.display = 'none';
            }, 3000);
        }

        function showHoverBox() {
            const hoverBox = document.getElementById('hover-box');
            hoverBox.style.display = 'block';
        }

        function hideHoverBox() {
            const hoverBox = document.getElementById('hover-box');
            hoverBox.style.display = 'none';
        }

        function showHoverBoxComplexity() {
            const hoverBox = document.getElementById('hover-box-complexity');
            hoverBox.style.display = 'block';
        }

        function hideHoverBoxComplexity() {
            const hoverBox = document.getElementById('hover-box-complexity');
            hoverBox.style.display = 'none';
        }

        // Calculate total complexity score
        function calculateTotalComplexity() {
            const availability = parseFloat(document.getElementById('availability').value) || 0;
            const nonRepudiation = parseFloat(document.getElementById('non_repudiation').value) || 0;
            const integrity = parseFloat(document.getElementById('integrity').value) || 0;
            const authentication = parseFloat(document.getElementById('authentication').value) || 0;
            const authorization = parseFloat(document.getElementById('authorization').value) || 0;
            const confidentiality = parseFloat(document.getElementById('confidentiality').value) || 0;

            const total = availability + nonRepudiation + integrity + authentication + authorization + confidentiality;
            document.getElementById('total_complexity').value = total.toFixed(4);

            if (total !== 1) {
                document.getElementById('compute-complexity').disabled = true;
                document.getElementById('input-error').style.display = 'block';
            } else {
                document.getElementById('compute-complexity').disabled = false;
                document.getElementById('input-error').style.display = 'none';
            }
        }

        // Reset input fields for complexity
        function resetComplexityInputs() {
            document.getElementById('availability').value = 0;
            document.getElementById('non_repudiation').value = 0;
            document.getElementById('integrity').value = 0;
            document.getElementById('authentication').value = 0;
            document.getElementById('authorization').value = 0;
            document.getElementById('confidentiality').value = 0;
            document.getElementById('total_complexity').value = 0;
            document.getElementById('input-error').style.display = 'none';
            document.getElementById('compute-complexity').disabled = true;
        }
    </script>
    <script>
        function toggleHoverBox() {
            const hoverBox = document.getElementById('hover-box');
            if (hoverBox.classList.contains('active')) {
                hoverBox.classList.remove('active');
            } else {
                hoverBox.classList.add('active');
            }
        }

        function toggleHoverBoxComplexity() {
            const hoverBox = document.getElementById('hover-box-complexity');
            if (hoverBox.classList.contains('active')) {
                hoverBox.classList.remove('active');
            } else {
                hoverBox.classList.add('active');
            }
        }
    </script>
</body>

</html>

@include('frontend.dashboard.footer')
