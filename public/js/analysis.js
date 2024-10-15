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
    const decisionDisplay = document.getElementById('decision-result');

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

        const expectedValue = calculateExpectedValue(initialInvestment);
        expectedValueDisplay.innerText = `$${expectedValue.toFixed(2)}`;

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

        let cumulativeCost = 0;
        let cumulativeBenefit = 0;

        let totalCostPerYear = [];
        let totalBenefitPerYear = [];

        for (let i = 1; i <= years; i++) {
            const costPerColumn = calculatePerColumn('cost', i);
            const costPresentValue = calculatePresentValue(costPerColumn, discountRate, i);
            document.getElementById(`cost-cumulative-${i}`).innerText = costPerColumn.toFixed(2);
            document.getElementById(`cost-pv-${i}`).innerText = costPresentValue.toFixed(2);

            cumulativeCost += costPresentValue;
            totalCostPerYear[i - 1] = cumulativeCost; // Corrected index

            if (i === years) {
                cumulativeCost += initialInvestment;
            }

            document.getElementById(`cost-total-${i}`).innerText = cumulativeCost.toFixed(2);

            const benefitPerColumn = calculatePerColumn('benefit', i);
            const benefitPresentValue = calculatePresentValue(benefitPerColumn, discountRate, i);
            document.getElementById(`benefit-cumulative-${i}`).innerText = benefitPerColumn.toFixed(2);
            document.getElementById(`benefit-pv-${i}`).innerText = benefitPresentValue.toFixed(2);

            cumulativeBenefit += benefitPresentValue;
            totalBenefitPerYear[i - 1] = cumulativeBenefit; // Corrected index

            document.getElementById(`benefit-total-${i}`).innerText = cumulativeBenefit.toFixed(2);
        }

        const npv = cumulativeBenefit - cumulativeCost;
        const bcr = cumulativeBenefit / cumulativeCost;
        const irr = "Calculated via financial tools";

        npvDisplay.innerText = `$${npv.toFixed(2)}`;
        bcrDisplay.innerText = bcr.toFixed(2);
        irrDisplay.innerText = irr;

        // // Uncomment decision block
        // if (npv > 0 && bcr > 1) {
        //     decisionDisplay.innerText = "Profitable: The project has a positive NPV and a BCR greater than 1.";
        //     decisionDisplay.style.color = "green";
        // } else {
        //     decisionDisplay.innerText = "Not Profitable: The project has a negative NPV or a BCR less than 1.";
        //     decisionDisplay.style.color = "red";
        // }

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
                        fill: false
                    },
                    {
                        label: 'Total Benefit',
                        data: totalBenefitPerYear,
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

