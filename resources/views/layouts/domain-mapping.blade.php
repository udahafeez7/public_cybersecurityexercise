<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Singular Value Decomposition & System Complexity</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
      background-color: #f4f4f9;
    }
    h2 {
      color: #333;
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
    table, th, td {
      border: 1px solid #ddd;
    }
    th, td {
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
  <h2>Singular Value Decomposition</h2>
  <form id="dimension-form">
    <label for="rows">Number of Rows:</label>
    <input type="number" id="rows" name="rows" min="1" value="3" onfocus="showHint('rows-hint')">
    <div id="rows-hint" class="hint">Indicating the number of Best Practices that we adhere</div>
    <label for="cols">Number of Columns:</label>
    <input type="number" id="cols" name="cols" min="1" value="3" onfocus="showHint('cols-hint')">
    <div id="cols-hint" class="hint">Indicating the number of current assets that we have</div>
    <button type="submit">Generate Matrix</button>
  </form>

  <form id="matrix-form" style="display: none;">
    <div id="matrix-container"></div>
    <button type="submit">Compute SVD</button>
    <button type="button" id="reset-button">Reset</button>
  </form>

  <h2>System Complexity</h2>
  <form id="complexity-form" onsubmit="return computeComplexity();">
    <div class="input-group">
      <label for="availability">Availability</label>
      <input type="number" id="availability" min="0" max="1" step="0.0001" value="0" onfocus="showHint('availability-hint')">
      <div id="availability-hint" class="hint">Indicating the scores of Availability from Fuzzy AHP</div>
    </div>
    <div class="input-group">
      <label for="non_repudiation">Non-Repudiation</label>
      <input type="number" id="non_repudiation" min="0" max="1" step="0.0001" value="0" onfocus="showHint('non-repudiation-hint')">
      <div id="non-repudiation-hint" class="hint">Indicating the scores of Non-Repudiation from Fuzzy AHP</div>
    </div>
    <div class="input-group">
      <label for="integrity">Integrity</label>
      <input type="number" id="integrity" min="0" max="1" step="0.0001" value="0" onfocus="showHint('integrity-hint')">
      <div id="integrity-hint" class="hint">Indicating the scores of Integrity from Fuzzy AHP</div>
    </div>
    <div class="input-group">
      <label for="authentication">Authentication</label>
      <input type="number" id="authentication" min="0" max="1" step="0.0001" value="0" onfocus="showHint('authentication-hint')">
      <div id="authentication-hint" class="hint">Indicating the scores of Authentication from Fuzzy AHP</div>
    </div>
    <div class="input-group">
      <label for="authorization">Authorization</label>
      <input type="number" id="authorization" min="0" max="1" step="0.0001" value="0" onfocus="showHint('authorization-hint')">
      <div id="authorization-hint" class="hint">Indicating the scores of Authorization from Fuzzy AHP</div>
    </div>
    <div class="input-group">
      <label for="confidentiality">Confidentiality</label>
      <input type="number" id="confidentiality" min="0" max="1" step="0.0001" value="0" onfocus="showHint('confidentiality-hint')">
      <div id="confidentiality-hint" class="hint">Indicating the scores of Confidentiality from Fuzzy AHP</div>
    </div>
    <div class="error" id="input-error">The sum of all inputs must be 1.</div>
    <button type="submit">Compute Complexity</button>
  </form>

  <div class="result" id="result" style="display: none;">
    <h3>Results</h3>
    <ul>
      <li><span>Singular Values:</span> <span id="singular-values"></span></li>
      <li><span>Component:</span> <span id="component"></span></li>
      <li><span>Interface:</span> <span id="interface"></span></li>
      <li><span>Architecture:</span> <span id="architecture"></span></li>
      <li><span>System Complexity:</span> <span id="system-complexity"></span></li>
    </ul>
  </div>

  <div class="result" id="complexity-result" style="display: none;">
    <h3>Complexity Calculation</h3>
    <ul>
      <li><span>Component Complexity:</span> <span id="component_complexity"></span></li>
      <li><span>Interface Complexity:</span> <span id="interface_complexity"></span></li>
      <li><span>Architecture Complexity:</span> <span id="architecture_complexity"></span></li>
      <li><span>Total System Complexity:</span> <span id="total_system_complexity"></span></li>
      <li><span>Complexity Level:</span> <span id="complexity_level"></span></li>
    </ul>
    <div class="bar-container">
      <div id="complexity-bar" class="bar"></div>
    </div>
    <div class="scale">
      <div>0</div>
      <div><div class="minor-scale"><div></div><div></div><div></div><div></div></div>20</div>
      <div><div class="minor-scale"><div></div><div></div><div></div><div></div></div>40</div>
      <div><div class="minor-scale"><div></div><div></div><div></div><div></div></div>60</div>
      <div><div class="minor-scale"><div></div><div></div><div></div><div></div></div>80</div>
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
  </script>
</body>
</html>
