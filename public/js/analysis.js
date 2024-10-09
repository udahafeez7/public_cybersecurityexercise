// Select DOM elements
const yearsInput = document.getElementById('years');
const riskLevelSelect = document.getElementById('risk-level');
const riskScaleSelect = document.getElementById('risk-scale');
const generateButton = document.getElementById('generate-tables');
const costSection = document.getElementById('cost-section');
const benefitSection = document.getElementById('benefit-section');
const actionButtons = document.getElementById('action-buttons');
const resultSection = document.getElementById('result-section');
const proceedButton = document.getElementById('proceed-benefits');

// Risk Scale Mapping
const riskScaleMap = {
    low: [0, 5],
    medium: [6, 15],
    high: [16, 30],
    catastrophic: [31, 50]
};

// Update Risk Scale Based on Risk Level
riskLevelSelect.addEventListener('change', function () {
    let selectedLevel = riskLevelSelect.value;
    let scaleOptions = riskScaleMap[selectedLevel];
    riskScaleSelect.innerHTML = ''; // Clear previous options

    for (let i = scaleOptions[0]; i <= scaleOptions[1]; i++) {
        const option = document.createElement('option');
        option.value = i;
        option.textContent = `${i}%`;
        riskScaleSelect.appendChild(option);
    }
});

// Generate Cost and Benefit Tables
generateButton.addEventListener('click', function () {
    const years = parseInt(yearsInput.value);
    if (isNaN(years) || years <= 0) {
        alert("Please enter a valid number of years.");
        return;
    }

    // Generate Cost Table Headers
    const costHeaders = ['<th>Cost Types</th>'];
    for (let i = 1; i <= years; i++) {
        costHeaders.push(`<th>Year ${i}</th>`);
    }

    // Generate Benefit Table Headers
    const benefitHeaders = ['<th>Benefit Types</th>'];
    for (let i = 1; i <= years; i++) {
        benefitHeaders.push(`<th>Year ${i}</th>`);
    }

    document.getElementById('dynamic-cost-headers').innerHTML = costHeaders.join('');
    document.getElementById('dynamic-benefit-headers').innerHTML = benefitHeaders.join('');

    // Show the cost section after generating headers
    costSection.classList.remove('hidden');

    // Populate the cost table body
    const costTableBody = document.getElementById('cost-table-body');
    costTableBody.innerHTML = ''; // Clear previous rows

    // Populate the cost types
    const costTypes = [
        "Secure Coding Standard",
        "Secure Coding Training",
        "Impact on DevOps",
        "Effect on Review and Deployment Cycles",
        "Cloud Operational Cost",
        "Cloud Security Tools",
        "Maintenance and Support",
        "Incident Response, Disaster Recovery, and Business Continuity"
    ];

    costTypes.forEach(type => {
        const row = document.createElement('tr');
        row.innerHTML = `<td>${type}</td>`;
        for (let i = 0; i < years; i++) {
            row.innerHTML += `<td><input type="number" class="cost-input p-2 border" placeholder="0.00" /></td>`;
        }
        costTableBody.appendChild(row);
    });

    // Show benefit section only after clicking "Proceed to Benefits"
    proceedButton.addEventListener('click', function () {
        benefitSection.classList.remove('hidden');
        actionButtons.classList.remove('hidden'); // Show action buttons
    });

    // Populate the benefit table body
    const benefitTableBody = document.getElementById('benefit-table-body');
    benefitTableBody.innerHTML = ''; // Clear previous rows

    const benefitTypes = [
        "Reduction in Rework",
        "Risk Reduction from CIA-AAN",
        "Performance Improvement",
        "Customer Trust, Retention, Reputation Management",
        "Innovation and Market Competitiveness",
        "Cost Avoidance and Risk Mitigation",
        "Environmental, Social, and Governance Compliance",
        "Quantifiable Aspects"
    ];

    benefitTypes.forEach(type => {
        const row = document.createElement('tr');
        row.innerHTML = `<td>${type}</td>`;
        for (let i = 0; i < years; i++) {
            row.innerHTML += `<td><input type="number" class="benefit-input p-2 border" placeholder="0.00" /></td>`;
        }
        benefitTableBody.appendChild(row);
    });
});

// Function to calculate costs
function calculateCosts() {
    const riskScalePercentage = parseInt(riskScaleSelect.value);
    const costInputs = document.querySelectorAll('#cost-table-body .cost-input');
    let totalCost = 0;
    let costPerColumn = Array(parseInt(yearsInput.value)).fill(0); // Initialize array for each year

    const years = parseInt(yearsInput.value);

    for (let i = 0; i < costInputs.length; i++) {
        const value = parseFloat(costInputs[i].value) || 0;
        const column = i % years;

        if (column === 0) { // Apply risk scale to the first year only
            costPerColumn[column] += value + (value * (riskScalePercentage / 100));
        } else {
            costPerColumn[column] += value;
        }
    }

    // Update cost per column and total cost
    document.getElementById('cost-per-column').innerHTML = `<td>Cost Per Column</td>${costPerColumn.map(c => `<td>${c.toFixed(2)}</td>`).join('')}`;
    totalCost = costPerColumn.reduce((a, b) => a + b, 0);
    document.getElementById('total-cost').innerText = totalCost.toFixed(2);
}

// Function to calculate benefits
function calculateBenefits() {
    const benefitInputs = document.querySelectorAll('#benefit-table-body .benefit-input');
    let totalBenefit = 0;
    let benefitPerColumn = Array(parseInt(yearsInput.value)).fill(0);

    const years = parseInt(yearsInput.value);

    for (let i = 0; i < benefitInputs.length; i++) {
        const value = parseFloat(benefitInputs[i].value) || 0;
        const column = i % years;

        benefitPerColumn[column] += value;
    }

    // Update benefit per column and total benefit
    document.getElementById('benefit-per-column').innerHTML = `<td>Benefit Per Column</td>${benefitPerColumn.map(b => `<td>${b.toFixed(2)}</td>`).join('')}`;
    totalBenefit = benefitPerColumn.reduce((a, b) => a + b, 0);
    document.getElementById('total-benefit').innerText = totalBenefit.toFixed(2);

    // Calculate net benefit
    const totalCost = parseFloat(document.getElementById('total-cost').innerText) || 0;
    const netBenefit = totalBenefit - totalCost;
    document.getElementById('net-benefit').innerText = netBenefit.toFixed(2);
}

// Action buttons for calculating and resetting
document.getElementById('calculate').addEventListener('click', function () {
    calculateCosts();
    calculateBenefits();
    generateChart();
});

// Reset button functionality
document.getElementById('reset').addEventListener('click', function () {
    document.querySelectorAll('.cost-input').forEach(input => input.value = '');
    document.querySelectorAll('.benefit-input').forEach(input => input.value = '');
    document.getElementById('cost-per-column').innerHTML = '<td>Cost Per Column</td>';
    document.getElementById('total-cost').innerText = '0.00';
    document.getElementById('benefit-per-column').innerHTML = '<td>Benefit Per Column</td>';
    document.getElementById('total-benefit').innerText = '0.00';
    document.getElementById('net-benefit').innerText = '0.00';
    resultSection.classList.add('hidden');
});

// Function to generate the chart
function generateChart() {
    const ctx = document.getElementById('costBenefitChart').getContext('2d');
    const totalCost = parseFloat(document.getElementById('total-cost').innerText) || 0;
    const totalBenefit = parseFloat(document.getElementById('total-benefit').innerText) || 0;

    new Chart(ctx, {
        type: 'line', // Changed to line chart for curves
        data: {
            labels: Array.from({length: parseInt(yearsInput.value)}, (_, i) => `Year ${i + 1}`),
            datasets: [{
                label: 'Cost',
                data: Array(parseInt(yearsInput.value)).fill(totalCost),
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                fill: false
            },
            {
                label: 'Benefit',
                data: Array(parseInt(yearsInput.value)).fill(totalBenefit),
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                fill: false
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    displayConclusion(totalCost, totalBenefit);
}

// Function to display conclusion based on NPV, BCR, and IRR
function displayConclusion(totalCost, totalBenefit) {
    const notification = document.getElementById('notification');
    const npv = totalBenefit - totalCost; // Simplified for demonstration
    const bcr = totalBenefit / totalCost;
    const irr = ((bcr - 1) * 100).toFixed(2); // Simplified IRR calculation

    document.getElementById('npv-result').innerText = `$${npv.toFixed(2)}`;
    document.getElementById('bcr-result').innerText = bcr.toFixed(2);
    document.getElementById('irr-result').innerText = `${irr}%`;

    if (npv > 0 && bcr > 1) {
        notification.textContent = "Good Investment: Positive NPV and BCR greater than 1 indicate a profit.";
    } else {
        notification.textContent = "Bad Investment: Negative NPV or BCR less than 1 indicates a loss.";
    }

    resultSection.classList.remove('hidden'); // Show the results section
}
