document.addEventListener('input', function (event) {
    if (event.target.type === 'range' || event.target.type === 'number') {
        const rangeId = event.target.id.replace('_input', '');
        const spanId = rangeId + '_value';
        document.getElementById(spanId).textContent = event.target.value;
        flashLabel(rangeId);
    }
});

function flashLabel(id) {
    const label = document.getElementById('label_' + id);
    label.style.backgroundColor = 'yellow';
    setTimeout(() => {
        label.style.backgroundColor = '';
    }, 500);
}

// Add function for showing tooltip on click
function showTooltip(id) {
    const tooltipId = 'tooltip_' + id;
    let tooltip = document.getElementById(tooltipId);

    if (!tooltip) {
        tooltip = document.createElement('div');
        tooltip.id = tooltipId;
        tooltip.classList.add('flash-message');
        document.getElementById(id).parentNode.appendChild(tooltip);
    }

    switch(id) {
        case 'system_complexity':
            tooltip.textContent = `Reduced Complexity Information: Accumulated from Domain Mapping Matrix.`;
            break;
        case 'impact':
            tooltip.textContent = `Impact: Accumulated adversarial impact.`;
            break;
        case 'base_score':
            tooltip.textContent = `Base Score: Accumulated adversarial base score.`;
            break;
        case 'exploitability':
            tooltip.textContent = `Exploitability: Accumulated exploitability score.`;
            break;
    }

    tooltip.style.display = 'block';
    setTimeout(() => {
        tooltip.style.display = 'none';
    }, 5000); // Auto-hide after 5 seconds
}

function hideTooltip(id) {
    const tooltipId = 'tooltip_' + id;
    const tooltip = document.getElementById(tooltipId);
    if (tooltip) {
        tooltip.style.display = 'none';
    }
}

function trapezoidalMembership(x, a, b, c, d) {
    if (x <= a || x >= d) return 0;
    else if (x >= b && x <= c) return 1;
    else if (x > a && x < b) return (x - a) / (b - a);
    else return (d - x) / (d - c);
}

function syncInput(id) {
    const range = document.getElementById(id);
    const input = document.getElementById(id + '_input');
    input.value = range.value;
    document.getElementById(id + '_value').textContent = range.value;
    flashLabel(id);
}

function syncRange(id) {
    const range = document.getElementById(id);
    const input = document.getElementById(id + '_input');
    range.value = input.value;
    document.getElementById(id + '_value').textContent = input.value;
    flashLabel(id);
}

function computeRisk() {
    const system_complexity = parseFloat(document.getElementById('system_complexity').value);
    const impact = parseFloat(document.getElementById('impact').value);
    const base_score = parseFloat(document.getElementById('base_score').value);
    const exploitability = parseFloat(document.getElementById('exploitability').value);

    // Membership functions for reduced complexity information
    const systemComplexityLow = trapezoidalMembership(system_complexity, 1, 1, 8, 15);
    const systemComplexityMedium = trapezoidalMembership(system_complexity, 10, 15, 18, 25);
    const systemComplexityHigh = trapezoidalMembership(system_complexity, 20, 25, 45, 55);
    const systemComplexityVeryHigh = trapezoidalMembership(system_complexity, 50, 55, 100, 100);

    // Membership functions for impact
    const impactLow = trapezoidalMembership(impact, 0, 0, 2.5, 2.5);
    const impactMedium = trapezoidalMembership(impact, 3, 4, 6, 7);
    const impactHigh = trapezoidalMembership(impact, 6.5, 7.5, 8.5, 9.5);
    const impactCritical = trapezoidalMembership(impact, 9, 9.5, 10, 10);

    // Membership functions for base score
    const baseScoreLow = trapezoidalMembership(base_score, 0, 0, 2.5, 2.5);
    const baseScoreMedium = trapezoidalMembership(base_score, 3, 4, 6, 7);
    const baseScoreHigh = trapezoidalMembership(base_score, 6.5, 7.5, 8.5, 9.5);
    const baseScoreCritical = trapezoidalMembership(base_score, 9, 9.5, 10, 10);

    // Membership functions for exploitability
    const exploitabilityLow = trapezoidalMembership(exploitability, 0, 0, 2.5, 2.5);
    const exploitabilityMedium = trapezoidalMembership(exploitability, 3, 4, 6, 7);
    const exploitabilityHigh = trapezoidalMembership(exploitability, 6.5, 7.5, 8.5, 9.5);
    const exploitabilityCritical = trapezoidalMembership(exploitability, 9, 9.5, 10, 10);

    // Apply fuzzy rules (including additional rules)
    const rule1 = Math.min(systemComplexityLow, impactLow, baseScoreLow, exploitabilityLow);
    const rule2 = Math.min(systemComplexityMedium, impactMedium, baseScoreMedium, exploitabilityMedium);
    const rule3 = Math.min(systemComplexityHigh, impactHigh, baseScoreHigh, exploitabilityHigh);
    const rule4 = Math.min(systemComplexityVeryHigh, impactCritical, baseScoreCritical, exploitabilityCritical);
    const rule5 = Math.min(systemComplexityHigh, impactMedium, baseScoreLow, exploitabilityHigh);
    const rule6 = Math.min(systemComplexityHigh, impactMedium, baseScoreLow, exploitabilityMedium);
    const rule7 = Math.min(systemComplexityMedium, impactCritical, baseScoreMedium, exploitabilityMedium);
    const rule8 = Math.min(systemComplexityLow, impactHigh, baseScoreLow, exploitabilityHigh);

    // Aggregating risk values (Defuzzification using weighted average)
    const riskValue = (rule1 * 20 + rule2 * 55 + rule3 * 80 + rule4 * 100 + rule5 * 80 + rule6 * 55 + rule7 * 75 + rule8 * 30) /
        (rule1 + rule2 + rule3 + rule4 + rule5 + rule6 + rule7 + rule8);

    // Determine the risk level
    let riskLevel = '';
    if (riskValue >= 90) {
        riskLevel = 'Catastrophic Risk';
    } else if (riskValue >= 70) {
        riskLevel = 'High Risk';
    } else if (riskValue >= 40) {
        riskLevel = 'Medium Risk';
    } else {
        riskLevel = 'Low Risk';
    }

    document.getElementById("risk_value").textContent = isNaN(riskValue) ? '-' : riskValue.toFixed(2);
    document.getElementById("risk_level").textContent = isNaN(riskValue) ? '-' : riskLevel;

    // Update chart
    updateChart(riskValue);
}

// Chart.js configuration
const ctx = document.getElementById('riskChart').getContext('2d');
const riskChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Low', 'Medium', 'High', 'Catastrophic'],
        datasets: [{
            label: 'Risk Level',
            data: [0, 0, 0, 0],
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        indexAxis: 'y',
        scales: {
            x: {
                beginAtZero: true,
                max: 100
            }
        }
    }
});

function updateChart(riskValue) {
    if (riskValue !== null) {
        const data = [0, 0, 0, 0];
        if (riskValue <= 39) data[0] = riskValue;
        else if (riskValue <= 69) data[1] = riskValue;
        else if (riskValue <= 89) data[2] = riskValue;
        else data[3] = riskValue;
        riskChart.data.datasets[0].data = data;
    } else {
        riskChart.data.datasets[0].data = [0, 0, 0, 0];
    }
    riskChart.update();
}

