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
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
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
            /* Adjust label width to ensure alignment */
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
        <h1>Fuzzy Logic Risk Assessment</h1>

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
</body>

</html>

@include('frontend.dashboard.footer')
