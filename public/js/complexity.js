document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('complexity-form').addEventListener('submit', function (event) {
        event.preventDefault();
        computeComplexity();
    });

    // Add styles for the graphic bar dynamically
    const style = document.createElement('style');
    style.innerHTML = `
        .bar-container {
            position: relative;
            background-color: #e0e0e0;
            border-radius: 15px;
            height: 30px;
            width: 80%;
            margin: 20px auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .bar {
            position: absolute;
            height: 100%;
            border-radius: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            font-size: 1.1em;
            color: #fff;
            transition: width 0.4s ease-in-out, background-color 0.4s ease-in-out;
        }

        .bar.low {
            background: linear-gradient(90deg, #4caf50, #8bc34a);
        }

        .bar.medium {
            background: linear-gradient(90deg, #ffeb3b, #ffc107);
            color: #333;
        }

        .bar.high {
            background: linear-gradient(90deg, #ff9800, #f44336);
        }

        .bar.very-high {
            background: linear-gradient(90deg, #9c27b0, #673ab7);
        }

        .bar-container::before {
            content: "Complexity Level";
            position: absolute;
            top: -25px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 14px;
            color: #555;
            font-weight: bold;
        }
    `;
    document.head.appendChild(style);
});

function computeComplexity() {
    const availability = parseFloat(document.getElementById('availability').value);
    const nonRepudiation = parseFloat(document.getElementById('non_repudiation').value);
    const integrity = parseFloat(document.getElementById('integrity').value);
    const authentication = parseFloat(document.getElementById('authentication').value);
    const authorization = parseFloat(document.getElementById('authorization').value);
    const confidentiality = parseFloat(document.getElementById('confidentiality').value);

    // Validate inputs for up to 6 decimal places
    const inputValues = [availability, nonRepudiation, integrity, authentication, authorization, confidentiality];
    const isValidInput = inputValues.every((value) => /^[0-9]+(\.[0-9]{1,6})?$/.test(value));

    if (!isValidInput) {
        document.getElementById('input-error').style.display = 'block';
        document.getElementById('input-error').textContent = 'Inputs must have a maximum of 6 digits after the decimal.';
        return false;
    } else {
        document.getElementById('input-error').style.display = 'none';
    }

    const sumInputs = availability + nonRepudiation + integrity + authentication + authorization + confidentiality;

    // Ensure the sum is exactly 1.000000
    if (sumInputs.toFixed(6) !== '1.000000') {
        document.getElementById('input-error').style.display = 'block';
        document.getElementById('input-error').textContent = 'The sum of the inputs must be exactly 1.000000.';
        return false;
    } else {
        document.getElementById('input-error').style.display = 'none';
    }

    const component = parseFloat(document.getElementById('component').textContent);
    const interfaceValue = parseFloat(document.getElementById('interface').textContent);
    const architecture = parseFloat(document.getElementById('architecture').textContent);

    const componentComplexity = component * (availability + nonRepudiation / 2);
    const interfaceComplexity = interfaceValue * ((integrity + authentication + authorization) / 3);
    const architectureComplexity = architecture * confidentiality;

    const totalComplexity = componentComplexity + interfaceComplexity + architectureComplexity;

    document.getElementById('component_complexity').textContent = componentComplexity.toFixed(6);
    document.getElementById('interface_complexity').textContent = interfaceComplexity.toFixed(6);
    document.getElementById('architecture_complexity').textContent = architectureComplexity.toFixed(6);
    document.getElementById('total_system_complexity').textContent = totalComplexity.toFixed(6);

    let complexityLevel = '';
    let barClass = '';
    if (totalComplexity <= 10) {
        complexityLevel = 'Low System Complexity';
        barClass = 'low';
    } else if (totalComplexity <= 20) {
        complexityLevel = 'Medium System Complexity';
        barClass = 'medium';
    } else if (totalComplexity <= 50) {
        complexityLevel = 'High System Complexity';
        barClass = 'high';
    } else {
        complexityLevel = 'Very High System Complexity';
        barClass = 'very-high';
    }

    document.getElementById('complexity_level').textContent = complexityLevel;

    const bar = document.getElementById('complexity-bar');
    bar.className = 'bar ' + barClass;
    bar.style.width = Math.min(totalComplexity, 100) + '%';
    bar.textContent = `${complexityLevel} (${totalComplexity.toFixed(2)}%)`;

    document.getElementById('complexity-result').style.display = 'block';

    return false;
}

// Calculate total complexity score dynamically
function calculateTotalComplexity() {
    const availability = parseFloat(document.getElementById('availability').value) || 0;
    const nonRepudiation = parseFloat(document.getElementById('non_repudiation').value) || 0;
    const integrity = parseFloat(document.getElementById('integrity').value) || 0;
    const authentication = parseFloat(document.getElementById('authentication').value) || 0;
    const authorization = parseFloat(document.getElementById('authorization').value) || 0;
    const confidentiality = parseFloat(document.getElementById('confidentiality').value) || 0;

    const total = availability + nonRepudiation + integrity + authentication + authorization + confidentiality;
    document.getElementById('total_complexity').value = total.toFixed(6);

    if (total.toFixed(6) !== '1.000000') {
        document.getElementById('compute-complexity').disabled = true;
        document.getElementById('input-error').style.display = 'block';
        document.getElementById('input-error').textContent = 'The total must be exactly 1.000000.';
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
