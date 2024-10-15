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

        // Calculate the total expected value
        return initialInvestment + lowRiskValue + mediumRiskValue + highRiskValue + catastrophicRiskValue;
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

        // Calculate the expected value of the initial investment
        const expectedValue = calculateExpectedValue(initialInvestment);
        expectedValueDisplay.innerText = `$${expectedValue.toFixed(2)}`;

        // Generate cost and benefit tables dynamically
        if (isNaN(years) || years <= 0) return;

        // Clear previous table rows
        costTableBody.innerHTML = '';
        benefitTableBody.innerHTML = '';

        // Full list of operational cost and benefit types
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

        // Generate cost and benefit rows
        generateRows(costTableBody, costTypes, years, 'cost');
        generateRows(benefitTableBody, benefitTypes, years, 'benefit');
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

        // Add rows for cumulative values and present values
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

    // Event listener for calculating results
    computeButton.addEventListener('click', calculateResults);

    function calculateResults() {
        const years = parseInt(yearsInput.value);
        const discountRate = parseFloat(discountRateInput.value) / 100 || 0;
        const initialInvestment = parseFloat(expectedValueDisplay.innerText.replace('$', '')) || 0;

        // Total cost and benefit accumulations
        let totalCost = 0;
        let totalBenefit = 0;

        // Calculating cost and benefit columns dynamically
        for (let i = 1; i <= years; i++) {
            // Cost calculation
            const costPerColumn = calculatePerColumn('cost', i);
            const costPresentValue = calculatePresentValue(costPerColumn, discountRate, i);
            document.getElementById(`cost-cumulative-${i}`).innerText = costPerColumn.toFixed(2);
            document.getElementById(`cost-pv-${i}`).innerText = costPresentValue.toFixed(2);

            // Benefit calculation
            const benefitPerColumn = calculatePerColumn('benefit', i);
            const benefitPresentValue = calculatePresentValue(benefitPerColumn, discountRate, i);
            document.getElementById(`benefit-cumulative-${i}`).innerText = benefitPerColumn.toFixed(2);
            document.getElementById(`benefit-pv-${i}`).innerText = benefitPresentValue.toFixed(2);

            // Sum for total cost and benefit
            totalCost += costPresentValue;
            totalBenefit += benefitPresentValue;
        }

        // Adding expected value to total cost
        totalCost += initialInvestment;

        // Update the total rows
        document.getElementById('cost-total-1').innerText = totalCost.toFixed(2);
        document.getElementById('benefit-total-1').innerText = totalBenefit.toFixed(2);

        // Calculate NPV, BCR, and IRR
        const npv = totalBenefit - totalCost;
        const bcr = totalBenefit / totalCost;
        const irr = "Calculated via financial tools"; // Placeholder for IRR

        // Display results
        npvDisplay.innerText = `$${npv.toFixed(2)}`;
        bcrDisplay.innerText = bcr.toFixed(2);
        irrDisplay.innerText = irr;

        // Generate the graph (convex/concave)
        generateNetBenefitChart(totalCost, totalBenefit);
    }

    // Helper functions to calculate per column and present value
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

    // Graph generation
    function generateNetBenefitChart(totalCost, totalBenefit) {
        const ctx = document.getElementById('netBenefitChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: Array.from({ length: yearsInput.value }, (_, i) => `Year ${i + 1}`),
                datasets: [
                    {
                        label: 'Cumulative Cost',
                        data: Array.from({ length: yearsInput.value }, (_, i) => parseFloat(document.getElementById(`cost-cumulative-${i + 1}`).innerText) || 0),
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        fill: false
                    },
                    {
                        label: 'Cumulative Benefit',
                        data: Array.from({ length: yearsInput.value }, (_, i) => parseFloat(document.getElementById(`benefit-cumulative-${i + 1}`).innerText) || 0),
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        fill: false
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
});
