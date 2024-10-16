document.addEventListener('DOMContentLoaded', () => {
    const initialInvestmentInput = document.getElementById('initial-investment');
    const discountRateInput = document.getElementById('discount-rate');
    const expectedValueDisplay = document.getElementById('expected-value');
    const yearsInput = document.getElementById('years');

    const costTableBody = document.getElementById('cost-table-body');
    const benefitTableBody = document.getElementById('benefit-table-body');

    const computeButton = document.getElementById('calculate');
    const npvDisplay = document.getElementById('npv-result');
    const bcrDisplay = document.getElementById('bcr-result');
    const irrDisplay = document.getElementById('irr-result');
    const bcrSummaryDisplay = document.getElementById('bcr-summary-result');
    const decisionDisplay = document.getElementById('notification');
    const overallSummaryText = document.getElementById('overall-summary-text');

    const ctx = document.getElementById('netBenefitChart').getContext('2d');

    // Probabilities and impacts for risk levels
    const probabilities = {
        low: 0.40,
        medium: 0.30,
        high: 0.20,
        catastrophic: 0.10
    };

    const impacts = {
        low: 0.05,
        medium: 0.15,
        high: 0.25,
        catastrophic: 0.45
    };

    // Function to calculate expected value of initial investment based on risk levels
    function calculateExpectedValue(initialInvestment) {
        const lowRiskValue = probabilities.low * impacts.low * initialInvestment;
        const mediumRiskValue = probabilities.medium * impacts.medium * initialInvestment;
        const highRiskValue = probabilities.high * impacts.high * initialInvestment;
        const catastrophicRiskValue = probabilities.catastrophic * impacts.catastrophic * initialInvestment;

        const expectedValue = initialInvestment + lowRiskValue + mediumRiskValue + highRiskValue + catastrophicRiskValue;
        expectedValueDisplay.innerText = `$${expectedValue.toFixed(2)}`; // Display the expected value
        return expectedValue; // Return the calculated expected value
    }

    // Function to generate discount factor
    function calculateDiscountFactor(rate, year) {
        return 1 / Math.pow((1 + rate), year);
    }

    // Event listener to generate tables when the user inputs values
    [initialInvestmentInput, yearsInput, discountRateInput].forEach(input => {
        input.addEventListener('input', generateTables);
    });

    function generateTables() {
        const years = parseInt(yearsInput.value);
        const initialInvestment = parseFloat(initialInvestmentInput.value) || 0;
        const discountRate = parseFloat(discountRateInput.value) / 100 || 0;

        const expectedValue = calculateExpectedValue(initialInvestment); // Calculate expected value

        if (isNaN(years) || years <= 0) return;

        costTableBody.innerHTML = '';
        benefitTableBody.innerHTML = '';

        generateTableHeaders(costTableBody, years, 'Operational Cost Types');
        generateTableHeaders(benefitTableBody, years, 'Operational Benefit Types');

        const costTypes = [
            "Secure Coding Standard", "Secure Coding Training", "Impact on DevOps",
            "Effect on Review and Deployment Cycles", "Cloud Operational Cost",
            "Cloud Security Tools", "Maintenance and Support",
            "Incident Response, Disaster Recovery, and Business Continuity"
        ];
        const benefitTypes = [
            "Reduction in Rework", "Risk Reduction from CIA-AAN", "Performance Improvement",
            "Customer Trust, Retention, Reputation Management",
            "Innovation and Market Competitiveness", "Cost Avoidance and Risk Mitigation",
            "Environmental, Social, and Governance Compliance", "Quantifiable Aspects"
        ];

        generateRows(costTableBody, costTypes, years, 'cost');
        generateRows(benefitTableBody, benefitTypes, years, 'benefit');
    }

    function generateTableHeaders(tableBody, years, title) {
        let headersHTML = `<tr><th>${title}</th>`;
        for (let i = 1; i <= years; i++) {
            headersHTML += `<th>Year ${i}</th>`;
        }
        headersHTML += '</tr>';
        tableBody.innerHTML += headersHTML;
    }

    function generateRows(tableBody, types, years, typePrefix) {
        types.forEach(type => {
            let rowHTML = `<tr><td>${type}</td>`;
            for (let i = 1; i <= years; i++) {
                rowHTML += `<td><input type="number" class="${typePrefix}-input p-2 border rounded" placeholder="0.00" data-year="${i}" /></td>`;
            }
            rowHTML += '</tr>';
            tableBody.innerHTML += rowHTML;
        });

        let cumulativeRow = `<tr><td><strong>${typePrefix === 'cost' ? 'Cost Per Column' : 'Benefit Per Column'}</strong></td>`;
        let presentValueRow = `<tr><td><strong>Present Value of ${typePrefix === 'cost' ? 'Cost' : 'Benefit'}</strong></td>`;
        let totalRow = `<tr><td><strong>Total ${typePrefix === 'cost' ? 'Cost' : 'Benefit'}</strong></td>`;

        for (let i = 1; i <= years; i++) {
            cumulativeRow += `<td id="${typePrefix}-cumulative-${i}">0.00</td>`;
            presentValueRow += `<td id="${typePrefix}-pv-${i}">0.00</td>`;
            totalRow += `<td id="${typePrefix}-total-${i}">0.00</td>`;
        }
        cumulativeRow += '</tr>';
        presentValueRow += '</tr>';
        totalRow += '</tr>';

        tableBody.innerHTML += cumulativeRow + presentValueRow + totalRow;
    }

    computeButton.addEventListener('click', calculateResults);

    function calculateResults() {
        const years = parseInt(yearsInput.value);
        const discountRate = parseFloat(discountRateInput.value) / 100 || 0;
        const initialInvestment = parseFloat(expectedValueDisplay.innerText.replace('$', '')) || 0;
        const expectedValue = calculateExpectedValue(initialInvestment); // Use expected value

        let cumulativeCost = expectedValue; // Start cumulative cost with expected value
        let cumulativeBenefit = 0;

        let totalCostPerYear = [expectedValue]; // Initialize with expected value for Year 0
        let totalBenefitPerYear = [0]; // Initialize benefit for Year 0 as 0

        for (let i = 1; i <= years; i++) {
            const costPerColumn = calculatePerColumn('cost', i);
            const costPresentValue = calculatePresentValue(costPerColumn, discountRate, i);
            document.getElementById(`cost-cumulative-${i}`).innerText = costPerColumn.toFixed(2);
            document.getElementById(`cost-pv-${i}`).innerText = costPresentValue.toFixed(2);

            cumulativeCost += costPresentValue;
            totalCostPerYear[i] = cumulativeCost;

            document.getElementById(`cost-total-${i}`).innerText = cumulativeCost.toFixed(2);

            const benefitPerColumn = calculatePerColumn('benefit', i);
            const benefitPresentValue = calculatePresentValue(benefitPerColumn, discountRate, i);
            document.getElementById(`benefit-cumulative-${i}`).innerText = benefitPerColumn.toFixed(2);
            document.getElementById(`benefit-pv-${i}`).innerText = benefitPresentValue.toFixed(2);

            cumulativeBenefit += benefitPresentValue;
            totalBenefitPerYear[i] = cumulativeBenefit;

            document.getElementById(`benefit-total-${i}`).innerText = cumulativeBenefit.toFixed(2);
        }

        const npv = cumulativeBenefit - cumulativeCost;
        const bcr = cumulativeBenefit / cumulativeCost;
        const irr = "Calculated via financial tools"; // Placeholder for IRR

        npvDisplay.innerText = `$${npv.toFixed(2)}`;
        bcrDisplay.innerText = bcr.toFixed(2);
        irrDisplay.innerText = irr;

        // Display BCR, NPV, IRR, and Benefit-Cost Ratio summary
        bcrSummaryDisplay.innerText = bcr.toFixed(2);

        // Display Overall Summary based on NPV and BCR
        if (npv > 0 && bcr > 1) {
            overallSummaryText.innerText = "The project is profitable with a positive NPV and a BCR greater than 1.";
            overallSummaryText.style.color = "green";
        } else {
            overallSummaryText.innerText = "The project is not profitable with a negative NPV or a BCR less than 1.";
            overallSummaryText.style.color = "red";
        }

        // Show the overall summary section
        document.getElementById('overall-summary').classList.remove('hidden');

        // Generate the updated graph with Total Cost and Total Benefit
        generateNetBenefitChart(totalCostPerYear, totalBenefitPerYear);
    }

    function calculatePerColumn(typePrefix, year) {
        let sum = 0;
        document.querySelectorAll(`.${typePrefix}-input[data-year="${year}"]`).forEach(input => {
            sum += parseFloat(input.value) || 0;
        });
        return sum;
    }

    function calculatePresentValue(value, discountRate, year) {
        const discountFactor = calculateDiscountFactor(discountRate, year);
        return value * discountFactor;
    }

    // Graph generation for total cost vs total benefit
    function generateNetBenefitChart(totalCostPerYear, totalBenefitPerYear) {
        const ctx = document.getElementById('netBenefitChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: Array.from({ length: yearsInput.value }, (_, i) => `Year ${i + 1}`),
                datasets: [
                    {
                        label: 'Total Cost',
                        data: totalCostPerYear,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        fill: false, // Don't fill under the line
                        pointBackgroundColor: 'rgba(255, 99, 132, 1)', // Red points
                        pointRadius: 5 // Bigger point size
                    },
                    {
                        label: 'Total Benefit',
                        data: totalBenefitPerYear,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        fill: false, // Don't fill under the line
                        pointBackgroundColor: 'rgba(54, 162, 235, 1)', // Blue points
                        pointRadius: 5 // Bigger point size
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true // Ensure the Y-axis starts at zero
                    }
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            const label = data.datasets[tooltipItem.datasetIndex].label || '';
                            return `${label}: $${tooltipItem.yLabel.toFixed(2)}`; // Display tooltip with formatted value
                        }
                    }
                }
            }
        });
    }
});

