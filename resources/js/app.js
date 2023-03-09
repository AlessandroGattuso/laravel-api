import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

//modal delete project

const deleteButtons = document.querySelectorAll('.confirm-delete-button[type="submit"]');

deleteButtons.forEach((button) => {
    button.addEventListener('click', function (event) {

        event.preventDefault();

        const message = button.getAttribute('message');
        const modal = document.getElementById('delete-modal-project');

        const bootstrapModal = new bootstrap.Modal(modal);

        bootstrapModal.show();

        const modalContent = modal.querySelector('#modal-item-content');
        modalContent.textContent = message;

        const deleteButton = modal.querySelector('#confirm-delete');

        deleteButton.addEventListener('click', () => {
            button.parentElement.submit();
        })
    })
})