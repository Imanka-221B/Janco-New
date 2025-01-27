const popupForm = document.getElementById('popupForm');
const closeButton = document.getElementById('closeButton');


document.getElementById("addCustomer").addEventListener('click',
    function openForm() {
  popupForm.style.display = 'flex';
}
);



// Close the modal
closeButton.addEventListener('click', () => {
  popupForm.style.display = 'none';
});

// Close the modal when clicking outside the content
window.addEventListener('click', (e) => {
  if (e.target === popupForm) {
    popupForm.style.display = 'none';
  }
});

  