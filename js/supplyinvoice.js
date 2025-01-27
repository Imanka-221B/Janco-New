
// Edit Payment Amount button
document.getElementById("editPayment").addEventListener("click", () => {
    alert("Edit Payment Amount button clicked!");
});

// Mark as Paid button
document.getElementById("markAsPaid").addEventListener("click", () => {
    alert("Marked as Paid!");
});


document.getElementById("downloadInvoice").addEventListener("click", () => {
    alert("Download Invoice button clicked!");
});
document.addEventListener('DOMContentLoaded', () => {
    const addMaterialBtn = document.getElementById('addMaterial');
    const modal = document.getElementById('addMaterialModal');
    const closeBtn = document.querySelector('.close');
    const form = document.getElementById('addMaterialForm');

    // Open Modal
    addMaterialBtn.addEventListener('click', () => {
        modal.style.display = 'block';
    });

    // Close Modal
    closeBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    // Close Modal when clicking outside content
    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });

    // Handle Form Submission
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        
        const productName = document.getElementById('productName').value;
        const quantity = document.getElementById('quantity').value;
        const unitPrice = document.getElementById('unitPrice').value;

        // Add the new material to the product list (example logic)
        console.log({
            productName,
            quantity,
            unitPrice,
        });

        // Close the modal
        modal.style.display = 'none';
        form.reset(); // Reset the form
    });
});
document.addEventListener('DOMContentLoaded', () => {
    const editInvoiceBtn = document.getElementById('editInvoice');
    const editModal = document.getElementById('editInvoiceModal');
    const closeBtn = document.querySelector('.edit-close');
    const editForm = document.getElementById('editInvoiceForm');

    // Open Modal
    editInvoiceBtn.addEventListener('click', () => {
        editModal.style.display = 'block';
    });

    // Close Modal
    closeBtn.addEventListener('click', () => {
        editModal.style.display = 'none';
    });

    // Close Modal when clicking outside content
    window.addEventListener('click', (event) => {
        if (event.target === editModal) {
            editModal.style.display = 'none';
        }
    });

    // Handle Form Submission
    editForm.addEventListener('submit', (event) => {
        event.preventDefault();

        const billDate = document.getElementById('editBillDate').value;
        const deliveryDate = document.getElementById('editDeliveryDate').value;
        const billingAddress = document.getElementById('editBillingAddress').value;

        // Update the UI or perform further actions (example)
        console.log({
            billDate,
            deliveryDate,
            billingAddress,
        });

        // Close the modal
        editModal.style.display = 'none';
        editForm.reset(); // Reset the form
    });
});
