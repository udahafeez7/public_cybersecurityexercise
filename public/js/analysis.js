document.addEventListener('DOMContentLoaded', function () {
    const calculateBtn = document.getElementById('calculate');
    const resetBtn = document.getElementById('reset');
    const notification = document.getElementById('notification');
    const ctx = document.getElementById('costBenefitChart').getContext('2d');
    let chart;

    // Get user inputs for costs and benefits
    const getCostInputs = () => ({
        secureCoding: parseFloat(document.getElementById('cost-secure-coding').value) || 0,
        secureTraining: parseFloat(document.getElementById('cost-secure-training').value) || 0,
        impactCoding: parseFloat(document.getElementById('cost-impact-coding').value) || 0,
        reviewCycle: parseFloat(document.getElementById('cost-review-cycle').value) || 0,
        operational: parseFloat(document.getElementById('cost-operational').value) || 0,
        cloudSecurity: parseFloat(document.getElementById('cost-cloud-security').value) || 0,
        maintenance: parseFloat(document.getElementById('cost-maintenance').value) || 0,
    });

    const getBenefitInputs = () => ({
        rework: parseFloat(document.getElementById('benefit-rework').value) || 0,
        confidentiality: parseFloat(document.getElementById('benefit-confidentiality').value) || 0,
        integrity: parseFloat(document.getElementById('benefit-integrity').value) || 0,
        availability: parseFloat(document.getElementById('benefit-availability').value) || 0,
        authentication: parseFloat(document.getElementById('benefit-authentication').value) || 0,
        authorization: parseFloat(document.getElementById('benefit-authorization').value) || 0,
        nonRepudiation: parseFloat(document.getElementById('benefit-non-repudiation').value) || 0,
        quantifiable: parseFloat(document.getElementById('benefit-quantifiable').value) || 0,
    });

    const getDiscountRate = () => parseFloat(document.getElementById('discount-rate').value) / 100;
    const getYears = () => parseInt(document.getElementById('years').value, 10);

    // Function to compute Present Value (PV)
    const computePresentValue = (amount, rate, year) => amount / Math.pow(1 + rate, year);

    // Function to compute NPV, BCR, and IRR
    const computeNPV = (costs, benefits, rate, years) => {
        let npv = 0, totalCost = 0, totalBenefit = 0;
        for (let i = 1; i <= years; i++) {
            const yearlyCost = Object.values(costs).reduce((acc, cost) => acc + computePresentValue(cost, rate, i), 0);
            const yearlyBenefit = Object.values(benefits).reduce((acc, benefit) => acc + computePresentValue(benefit, rate, i), 0);
            totalCost += yearlyCost;
            totalBenefit += yearlyBenefit;
            npv += yearlyBenefit - yearlyCost;
            appendToResultsTable(i, yearlyCost, yearlyBenefit); // Update Table
        }
        return { npv, totalCost, totalBenefit };
    };

    const appendToResultsTable = (year, cost, benefit) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="border px-4 py-2">${year}</td>
            <td class="border px-4 py-2">${cost.toFixed(2)}</td>
            <td class="border px-4 py-2">${benefit.toFixed(2)}</td>
        `;
        document.getElementById('results-table').appendChild(row);
    };

    // Generate the graph
    const generateChart = (costs, benefits, years) => {
        const labels = Array.from({ length: years }, (_, i) => `Year ${i + 1}`);
        const costData = Array.from({ length: years }, (_, i) => {
            return Object.values(costs).reduce((acc, cost) => acc + computePresentValue(cost, getDiscountRate(), i + 1), 0);
        });

        const benefitData = Array.from({ length: years }, (_, i) => {
            return Object.values(benefits).reduce((acc, benefit) => acc + computePresentValue(benefit, getDiscountRate(), i + 1), 0);
        });

        if (chart) {
            chart.destroy();
        }

        chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels,
                datasets: [
                    {
                        label: 'Cost',
                        data: costData,
                        borderColor: 'red',
                        fill: false,
                    },
                    {
                        label: 'Benefit',
                        data: benefitData,
                        borderColor: 'green',
                        fill: false,
                    },
                ],
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Years',
                        },
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Value',
                        },
                        beginAtZero: true,
                    },
                },
            },
        });
    };

    // Display notification
    const displayNotification = (npv, bcr, irr) => {
        let message = '';
        if (npv > 0 && bcr > 1 && irr > getDiscountRate()) {
            message = 'A positive NPV, a BCR greater than 1, and a high IRR all suggest that the project is beneficial.';
        } else {
            message = 'If NPV is negative, BCR is less than 1, or IRR is lower than your required return, the project is probably not beneficial.';
        }
        notification.textContent = message;
        notification.classList.remove('hidden');
    };

    // Calculate button functionality
    calculateBtn.addEventListener('click', () => {
        const costs = getCostInputs();
        const benefits = getBenefitInputs();
        const rate = getDiscountRate();
        const years = getYears();

        // Clear previous results from the table
        document.getElementById('results-table').innerHTML = '';

        // Ensure years and discount rate are entered
        if (years === 0 || rate === 0) {
            showHoverMessage(); // Display the hovering message under input fields
            return;
        }

        // Compute NPV, BCR, and IRR
        const { npv, totalCost, totalBenefit } = computeNPV(costs, benefits, rate, years);
        const bcr = totalBenefit / totalCost;
        const irr = rate;  // Placeholder for IRR calculation (needs full implementation)

        // Display the summary values
        document.getElementById('npv-result').textContent = `$${npv.toFixed(2)}`;
        document.getElementById('bcr-result').textContent = bcr.toFixed(2);
        document.getElementById('irr-result').textContent = `${(irr * 100).toFixed(2)}%`;

        // Generate the cost vs benefit graph
        generateChart(costs, benefits, years);

        // Display a conclusion notification based on the results
        displayNotification(npv, bcr, irr);
    });

    // Reset button functionality
    resetBtn.addEventListener('click', () => {
        if (chart) {
            chart.destroy();
        }
        notification.classList.add('hidden');
        document.getElementById('results-table').innerHTML = ''; // Clear table
    });

    // Show hover message when years or discount rate is not entered
    function showHoverMessage() {
        const yearInput = document.getElementById('years');
        const discountInput = document.getElementById('discount-rate');

        // Add the hover message below the year and discount rate inputs
        yearInput.classList.add('border-red-500');
        discountInput.classList.add('border-red-500');

        const tooltipYear = document.createElement('div');
        tooltipYear.classList.add('tooltiptext');
        tooltipYear.textContent = 'Ensure to input the year';
        yearInput.parentElement.appendChild(tooltipYear);

        const tooltipDiscount = document.createElement('div');
        tooltipDiscount.classList.add('tooltiptext');
        tooltipDiscount.textContent = 'Ensure to input the discount rate';
        discountInput.parentElement.appendChild(tooltipDiscount);

        setTimeout(() => {
            yearInput.classList.remove('border-red-500');
            discountInput.classList.remove('border-red-500');
            tooltipYear.remove();
            tooltipDiscount.remove();
        }, 3000);
    }
});
