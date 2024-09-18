@include('frontend.dashboard.header')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fuzzy Logic Risk Assessment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
        }

        h1 {
            color: red;
            font-weight: bold;
            position: relative;
            display: inline-block;
            cursor: pointer;
            transition: color 0.3s ease, text-shadow 0.3s ease;
            font-size: 2.5em;
            margin-bottom: 30px;
        }

        h1:hover {
            color: gold;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.8), 0 0 20px rgba(255, 215, 0, 0.6), 0 0 30px rgba(255, 215, 0, 0.4);
        }

        /* Hover box styling */
        #hover-box {
            display: none;
            position: absolute;
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 10px;
            border-radius: 5px;
            z-index: 1000;
            top: 60px;
            left: 0;
            width: 100%;
            /* Make the hover box as wide as the container */
            box-sizing: border-box;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-size: 0.8em;
            /* Slightly smaller text size */
            transition: font-size 0.2s ease;
        }

        /* Magnify the hover box text when hovering within */
        #hover-box:hover {
            font-size: 1em;
        }

        h1:hover #hover-box {
            display: block;
        }

        .input-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            width: 100%;
        }

        label {
            font-weight: bold;
            width: 200px;
        }

        .slider-container {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-grow: 1;
        }

        input[type="range"] {
            flex-grow: 1;
            max-width: 100%;
        }

        input[type="number"] {
            width: 80px;
        }

        .buttons {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .output {
            text-align: center;
            margin-top: 30px;
        }

        .output h2 {
            font-size: 24px;
            color: #333;
        }

        .output p {
            font-size: 18px;
            color: #555;
        }

        canvas {
            margin-top: 20px;
            max-width: 100%;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <div class="container">
        <h1 onmouseover="showHoverBox()" onmouseout="hideHoverBox()">Fuzzy Logic Risk Assessment
            <div id="hover-box">
                The risk level is estimated by combining the system complexity and three aspect namely impact, base
                score and
                exploitability using Common Vulnerability Enumeration.
                <br><br>
                リスクレベルは、共通脆弱性列挙法を用いて、システムの複雑さと、影響度、基本スコア、悪用可能性の3つの側面を組み合わせて推定される。
            </div>
        </h1>

        <!-- System Complexity Slider -->
        <div class="input-group">
            <label for="system_complexity">System Complexity</label>
            <div class="slider-container">
                <input type="range" id="system_complexity" min="0" max="100" value="0"
                    oninput="syncInput('system_complexity')">
                <input type="number" id="system_complexity_input" min="0" max="100" value="0"
                    oninput="syncRange('system_complexity')">
            </div>
        </div>

        <!-- Impact Slider -->
        <div class="input-group">
            <label for="impact">Impact</label>
            <div class="slider-container">
                <input type="range" id="impact" min="0" max="10" step="0.1" value="0"
                    oninput="syncInput('impact')">
                <input type="number" id="impact_input" min="0" max="10" step="0.1" value="0"
                    oninput="syncRange('impact')">
            </div>
        </div>

        <!-- Base Score Slider -->
        <div class="input-group">
            <label for="base_score">Base Score</label>
            <div class="slider-container">
                <input type="range" id="base_score" min="0" max="10" step="0.1" value="0"
                    oninput="syncInput('base_score')">
                <input type="number" id="base_score_input" min="0" max="10" step="0.1" value="0"
                    oninput="syncRange('base_score')">
            </div>
        </div>

        <!-- Exploitability Slider -->
        <div class="input-group">
            <label for="exploitability">Exploitability</label>
            <div class="slider-container">
                <input type="range" id="exploitability" min="0" max="10" step="0.1" value="0"
                    oninput="syncInput('exploitability')">
                <input type="number" id="exploitability_input" min="0" max="10" step="0.1"
                    value="0" oninput="syncRange('exploitability')">
            </div>
        </div>

        <!-- Compute Risk Button -->
        <div class="buttons">
            <button class="compute" onclick="computeRisk()">Compute Risk</button>
        </div>

        <!-- Output -->
        <div class="output">
            <h2>Output</h2>
            <p id="risk_output">Risk Level: <span id="risk_value">-</span> (<span id="risk_level">-</span>)</p>
        </div>

        <!-- Risk Graph -->
        <canvas id="riskChart"></canvas>
    </div>

    <script src="{{ asset('js/scripts2.js') }}"></script>
    <script>
        function showHoverBox() {
            document.getElementById('hover-box').style.display = 'block';
        }

        function hideHoverBox() {
            document.getElementById('hover-box').style.display = 'none';
        }
    </script>
</body>

</html>

@include('frontend.dashboard.footer')
