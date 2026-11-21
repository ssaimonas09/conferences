import 'bootstrap/dist/js/bootstrap.bundle';
import Swal from 'sweetalert2';

for (const form of document.querySelectorAll('[data-confirm-delete]')) {
    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const result = await Swal.fire({
            title: form.dataset.confirmTitle,
            text: form.dataset.confirmText,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: form.dataset.confirmYes,
            cancelButtonText: form.dataset.confirmCancel,
            confirmButtonColor: '#ad493e',
        });

        if (result.isConfirmed) {
            form.submit();
        }
    });
}
