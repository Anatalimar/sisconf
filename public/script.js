document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('rsvpForm');
    const typeSelect = document.getElementById('type');
    const childAgeGroup = document.getElementById('childAgeGroup');
    const childAgeInput = document.getElementById('childAge');
    const modal = document.getElementById('confirmationModal');
    const closeButtons = modal.querySelectorAll('.modal-close, .close-button');
    const scrollTopButton = document.getElementById('scrollToTop');

    // Handle participant type change
    typeSelect.addEventListener('change', function() {
        const isChild = this.value === 'child';
        childAgeGroup.style.display = isChild ? 'block' : 'none';
        childAgeInput.required = isChild;
    });

    // Handle form submission
    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        const formData = new FormData(form);
        
        try {
            const response = await fetch('index.php', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const data = await response.json();

            if (data.success) {
                showConfirmation(data.attendee, data.price);
                form.reset();
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Ocorreu um erro ao processar sua inscrição. Por favor, tente novamente.');
        }
    });

    // Show confirmation modal
    function showConfirmation(attendee, price) {
        // Update modal content
        document.getElementById('confirmName').textContent = attendee.name;
        document.getElementById('confirmEmail').textContent = attendee.email;
        document.getElementById('confirmDepartment').textContent = attendee.department;
        document.getElementById('confirmType').textContent = getTypeInPortuguese(attendee.type, attendee.childAge);
        document.getElementById('confirmPrice').textContent = `R$ ${price}`;

        // Show modal
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
    }

    // Convert attendee type to Portuguese
    function getTypeInPortuguese(type, childAge) {
        switch (type) {
            case 'server':
                return 'Servidor';
            case 'intern':
                return 'Estagiário';
            case 'companion':
                return 'Acompanhante';
            case 'child':
                return `Criança (${childAge} anos)`;
            default:
                return '';
        }
    }

    // Handle modal close
    closeButtons.forEach(button => {
        button.addEventListener('click', function() {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    });

    // Close modal when clicking outside
    window.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    });

    // Scroll to top functionality
    scrollTopButton.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Show/hide scroll to top button
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            scrollTopButton.style.opacity = '1';
        } else {
            scrollTopButton.style.opacity = '0';
        }
    });
});