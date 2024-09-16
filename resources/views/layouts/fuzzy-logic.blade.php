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
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            box-sizing: border-box;
        }
        .container {
            width: 100%;
            max-width: 800px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .input-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            transition: background-color 0.3s ease;
            position: relative;
        }
        .slider-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        input[type="range"] {
            flex-grow: 1;
        }
        input[type="number"] {
            width: 80px;
        }
        .buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button.compute {
            background-color: #4CAF50;
            color: white;
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
        .tooltip {
            position: absolute;
            background: rgba(0, 0, 0, 0.75);
            color: #fff;
            padding: 5px;
            border-radius: 5px;
            top: -35px;
            left: 0;
            opacity: 0;
            transition: opacity 0.3s;
            z-index: 10;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h1>Fuzzy Logic Risk Assessment</h1>

        <div class="input-group">
            <label for="system_complexity" id="label_system_complexity">
                System Complexity
                <span class="tooltip" id="tooltip_system_complexity">0</span>
            </label>
            <div class="slider-container">
                <input type="range" id="system_complexity" min="0" max="100" value="0" oninput="syncInput('system_complexity')">
                <input type="number" id="system_complexity_input" min="0" max="100" value="0" oninput="syncRange('system_complexity')">
            </div>
        </div>

        <div class="input-group">
            <label for="impact" id="label_impact">
                Impact
                <span class="tooltip" id="tooltip_impact">0</span>
            </label>
            <div class="slider-container">
                <input type="range" id="impact" min="0" max="10" value="0" step="0.1" oninput="syncInput('impact')">
                <input type="number" id="impact_input" min="0" max="10" value="0" step="0.1" oninput="syncRange('impact')">
            </div>
        </div>

        <div class="input-group">
            <label for="base_score" id="label_base_score">
                Base Score
                <span class="tooltip" id="tooltip_base_score">0</span>
            </label>
            <div class="slider-container">
                <input type="range" id="base_score" min="0" max="10" value="0" step="0.1" oninput="syncInput('base_score')">
                <input type="number" id="base_score_input" min="0" max="10" value="0" step="0.1" oninput="syncRange('base_score')">
            </div>
        </div>

        <div class="input-group">
            <label for="exploitability" id="label_exploitability">
                Exploitability
                <span class="tooltip" id="tooltip_exploitability">0</span>
            </label>
            <div class="slider-container">
                <input type="range" id="exploitability" min="0" max="10" value="0" step="0.1" oninput="syncInput('exploitability')">
                <input type="number" id="exploitability_input" min="0" max="10" value="0" step="0.1" oninput="syncRange('exploitability')">
            </div>
        </div>

        <div class="buttons">
            <button class="compute" onclick="computeRisk()">Compute Risk</button>
        </div>

        <div class="output">
            <h2>Output</h2>
            <p id="risk_output">Risk Level: <span id="risk_value">-</span> (<span id="risk_level">-</span>)</p>
        </div>

        <canvas id="riskChart"></canvas>
    </div>

    <script src="{{ asset('js/scripts2.js') }}"></script>
</body>
</html>
