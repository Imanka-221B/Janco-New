
let totalBalance = 0; // Initial total balance 
        
    function updateTotalDisplay() 
    { 
        document.getElementById('totalAmount').textContent = totalBalance.toFixed(2);
    } 
    function openModal() 
    {
         document.getElementById('add-expenses-modal').style.display = 'flex'; // Display the modal 
    } 
    function closeModal() 
    { 
        document.getElementById('add-expenses-modal').style.display = 'none'; // Hide the modal 
    } 
    
    function addExpense(event) 
    {
         event.preventDefault(); // Stop the form from submitting normally 
         
    const date = document.getElementById('date').value; 
    const description = document.getElementById('description').value; 
    const type = document.querySelector('input[name="type"]:checked').value; 
    const amount = parseFloat(document.getElementById('amount').value); 

    let income = type === 'income' ? amount : ''; 
    let outcome = type === 'outcome' ? amount : '';

    totalBalance += (type === 'income' ? amount : -amount); // Update the total balance const 
    row = document.createElement('tr');
    row.innerHTML = ` <td>${date}</td> 
    <td>${description}</td> <td class="income">${income ? '+' + income.toFixed(2) : ''}</td> 
    <td class="outcome">${outcome ? '-' + outcome.toFixed(2) : ''}</td> 
    <td>${totalBalance.toFixed(2)}</td> <td><button class="delete-expense" onclick="deleteExpense(this)">Delete</button></td> `;
    document.querySelector('#financeTable tbody').appendChild(row);
    updateTotalDisplay(); // Update the displayed total balance
    document.getElementById('expensesForm').reset(); // Reset the form 
    closeModal(); // Close the modal 
    } 
    
    function deleteExpense(button)
    {   
        const row = button.parentNode.parentNode;
        const outcomeCell = row.querySelector('.outcome'); 
        const incomeCell = row.querySelector('.income'); 
        const amount = parseFloat(outcomeCell.textContent.replace(/[^0-9.-]+/g, "")) || parseFloat(incomeCell.textContent.replace(/[^0-9.-]+/g, "")); 
        totalBalance -= (amount || 0); row.remove(); // Remove the row from the table 
        updateTotalDisplay(); // Update the displayed total
    }
     // Initialize the total amount display on page load 
    updateTotalDisplay();