document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('complexity-form').addEventListener('submit', function (event) {
        event.preventDefault();
        computeComplexity();
    });
});

function computeComplexity() {
    const availability = parseFloat(document.getElementById('availability').value);
    const nonRepudiation = parseFloat(document.getElementById('non_repudiation').value);
    const integrity = parseFloat(document.getElementById('integrity').value);
    const authentication = parseFloat(document.getElementById('authentication').value);
    const authorization = parseFloat(document.getElementById('authorization').value);
    const confidentiality = parseFloat(document.getElementById('confidentiality').value);

    const sumInputs = availability + nonRepudiation + integrity + authentication + authorization + confidentiality;

    // Ensure sum of inputs is exactly 1.00000
    if (sumInputs.toFixed(5) !== '1.00000') {
        document.getElementById('input-error').style.display = 'block';
        return false;
    } else {
        document.getElementById('input-error').style.display = 'none';
    }

    const component = parseFloat(document.getElementById('component').textContent);
    const interfaceValue = parseFloat(document.getElementById('interface').textContent);
    const architecture = parseFloat(document.getElementById('architecture').textContent);

    // Calculate complexities with five decimal places
    const componentComplexity = component * (availability + nonRepudiation / 2);
    const interfaceComplexity = interfaceValue * ((integrity + authentication + authorization) / 3);
    const architectureComplexity = architecture * confidentiality;

    const totalComplexity = componentComplexity + interfaceComplexity + architectureComplexity;

    // Display results with five decimal places
    document.getElementById('component_complexity').textContent = componentComplexity.toFixed(5);
    document.getElementById('interface_complexity').textContent = interfaceComplexity.toFixed(5);
    document.getElementById('architecture_complexity').textContent = architectureComplexity.toFixed(5);
    document.getElementById('total_system_complexity').textContent = totalComplexity.toFixed(5);

    // Determine complexity level
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

    // Update the progress bar
    const bar = document.getElementById('complexity-bar');
    bar.className = 'bar ' + barClass;
    bar.style.width = totalComplexity + '%'; // Adjust width for better visualization
    bar.textContent = complexityLevel; // Display the complexity level inside the bar

    // Display the result
    document.getElementById('complexity-result').style.display = 'block';

    return false;
}
