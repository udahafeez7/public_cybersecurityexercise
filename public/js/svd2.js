document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('dimension-form').addEventListener('submit', function(event) {
      event.preventDefault();
      const rows = parseInt(document.getElementById('rows').value);
      const cols = parseInt(document.getElementById('cols').value);
      generateMatrixInputs(rows, cols);
    });

    document.getElementById('matrix-form').addEventListener('submit', function(event) {
      event.preventDefault();
      const rows = parseInt(document.getElementById('rows').value);
      const cols = parseInt(document.getElementById('cols').value);
      const matrix = [];

      let sumMatrixValues = 0;

      for (let i = 0; i < rows; i++) {
        const row = [];
        for (let j = 0; j < cols; j++) {
          const value = parseFloat(document.getElementById(`r${i}c${j}`).value) || 0;
          row.push(value);
          sumMatrixValues += value;
        }
        matrix.push(row);
      }

      // Perform SVD
      try {
        const svdResult = numeric.svd(matrix);
        const singularValues = svdResult.S.map(value => Math.abs(value));
        const component = singularValues.reduce((acc, val) => acc + val, 0);
        const interfaceComplexity = sumMatrixValues;
        const architecture = component / Math.min(rows, cols);

        document.getElementById('singular-values').textContent = singularValues.map(val => val.toFixed(4)).join(', ');
        document.getElementById('component').textContent = component.toFixed(4);
        document.getElementById('interface').textContent = interfaceComplexity.toFixed(4);
        document.getElementById('architecture').textContent = architecture.toFixed(4);

        document.getElementById('result').style.display = 'block';
      } catch (error) {
        console.error("Error computing SVD:", error);
        document.getElementById('singular-values').textContent = 'Error computing SVD: ' + error.message;
        document.getElementById('result').style.display = 'block';
      }
    });

    document.getElementById('reset-button').addEventListener('click', function() {
      document.getElementById('matrix-form').style.display = 'none';
      document.getElementById('dimension-form').reset();
      document.getElementById('result').style.display = 'none';
    });

    function generateMatrixInputs(rows, cols) {
      const matrixContainer = document.getElementById('matrix-container');
      matrixContainer.innerHTML = '';

      const table = document.createElement('table');
      const thead = document.createElement('thead');
      const tbody = document.createElement('tbody');

      const headerRow = document.createElement('tr');
      headerRow.innerHTML = '<th>Row\\Col</th>' + Array.from({ length: cols }, (_, i) => `<th>${i + 1}</th>`).join('');
      thead.appendChild(headerRow);

      for (let i = 0; i < rows; i++) {
        const row = document.createElement('tr');
        row.innerHTML = `<th>${i + 1}</th>` + Array.from({ length: cols }, (_, j) => `<td><input type="number" id="r${i}c${j}" step="0.0001" value="0" onchange="updateSums(${i}, ${j})"></td>`).join('');
        tbody.appendChild(row);
      }

      const sumRow = document.createElement('tr');
      sumRow.innerHTML = `<th>Sum</th>` + Array.from({ length: cols }, (_, j) => `<td id="sum-col-${j}">0</td>`).join('');
      tbody.appendChild(sumRow);

      const totalSumRow = document.createElement('tr');
      totalSumRow.innerHTML = `<th>Total Sum</th><td id="sum-total" colspan="${cols}">0</td>`;
      tbody.appendChild(totalSumRow);

      table.appendChild(thead);
      table.appendChild(tbody);
      matrixContainer.appendChild(table);

      document.getElementById('matrix-form').style.display = 'block';
    }

    window.updateSums = function(row, col) {
      const rows = parseInt(document.getElementById('rows').value);
      const cols = parseInt(document.getElementById('cols').value);

      let colSum = 0;
      for (let i = 0; i < rows; i++) {
        const value = parseFloat(document.getElementById(`r${i}c${col}`).value) || 0;
        colSum += value;
      }
      document.getElementById(`sum-col-${col}`).textContent = colSum.toFixed(4);

      let totalSum = 0;
      for (let i = 0; i < rows; i++) {
        for (let j = 0; j < cols; j++) {
          const value = parseFloat(document.getElementById(`r${i}c${j}`).value) || 0;
          totalSum += value;
        }
      }
      document.getElementById('sum-total').textContent = totalSum.toFixed(4);
    }
  });
