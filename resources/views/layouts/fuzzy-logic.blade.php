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
            text-align: center;
            position: relative;
        }

        h1 {
            color: #ff9900;
            font-weight: bold;
            position: relative;
            display: inline-block;
            cursor: pointer;
            transition: color 0.3s ease, text-shadow 0.3s ease;
            font-size: 2.5rem;
            margin-bottom: 30px;
        }

        h1:hover {
            color: gold;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.8), 0 0 20px rgba(255, 215, 0, 0.6), 0 0 30px rgba(255, 215, 0, 0.4);
        }

        /* Superscript question mark styling */
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

        /* Hover box styling */
        #hover-box {
            display: none;
            font-size: 1.2rem;
            color: #fff;
            text-align: center;
            margin: 20px auto;
            max-width: 800px;
            background-color: rgba(0, 0, 0, 0.85);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
            opacity: 0;
            transition: opacity 0.5s ease-in-out, text-shadow 0.3s ease-in-out;
        }

        /* White text with glowing gold effect when hovered */
        #hover-box p {
            color: #ffffff;
            text-shadow: 0 0 8px rgba(255, 255, 255, 1), 0 0 16px rgba(255, 255, 255, 1);
            transition: font-size 0.3s ease, text-shadow 0.3s ease;
        }

        /* When hovered, text enlarges and glows gold */
        #hover-box p:hover {
            color: #ffd700;
            text-shadow: 0 0 16px rgba(255, 215, 0, 1), 0 0 32px rgba(255, 215, 0, 1);
            font-size: 1.4rem;
        }

        #hover-box.active {
            opacity: 1;
            display: block;
        }

        #hover-box p:hover {
            color: #ffd700;
            text-shadow: 0 0 16px rgba(255, 215, 0, 1), 0 0 32px rgba(255, 215, 0, 1);
            font-size: 1.4rem;
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
        <!-- Fuzzy Logic Risk Assessment Title with Superscript Question Mark -->
        <h1>Fuzzy Logic Risk Assessment
            <span class="question-mark" onclick="toggleHoverBox()">❓</span>
        </h1>

        <!-- Description box -->
        <div id="hover-box">
            <p>
                The risk level is estimated by combining the system complexity and three aspects: impact, base score,
                and exploitability using Common Vulnerability Enumeration.
                <br><br>
                リスクレベルは、共通脆弱性列挙法を用いて、システムの複雑さと、影響度、基本スコア、悪用可能性の3つの側面を組み合わせて推定される。
            </p>
        </div>

        <!-- Reduced Complexity Information Slider -->
        <div class="input-group">
            <label for="system_complexity">Reduced Complexity Information</label>
            <div class="slider-container">
                <input type="range" id="system_complexity" min="0" max="100" value="0"
                    oninput="syncInput('system_complexity')">
                <input type="number" id="system_complexity_input" min="0" max="100" value="0"
                    oninput="syncRange('system_complexity')">
                <span class="tooltip-icon" onclick="showTooltip('system_complexity')">❓</span>
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
                <span class="tooltip-icon" onclick="showTooltip('impact')">❓</span>
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
                <span class="tooltip-icon" onclick="showTooltip('base_score')">❓</span>
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
                <span class="tooltip-icon" onclick="showTooltip('exploitability')">❓</span>
            </div>
        </div>

        <div class="buttons">
            <button class="compute" onclick="computeRisk()">Compute Risk</button>
            <button class="reset" onclick="resetInputs()">Reset</button> <!-- Reset Button -->
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
        function toggleHoverBox() {
            const hoverBox = document.getElementById('hover-box');
            hoverBox.classList.toggle('active');
        }
    </script>
</body>

</html>

@include('frontend.dashboard.footer')
