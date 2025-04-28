// Mobile menu functionality
const mobileMenuButton = document.querySelector('.mobile-menu-button');
const sidebar = document.querySelector('.sidebar');
const overlay = document.querySelector('.sidebar-overlay');

if (mobileMenuButton) {
  mobileMenuButton.addEventListener('click', () => {
    sidebar.classList.toggle('active');
    
    // Create/remove overlay
    if (sidebar.classList.contains('active')) {
      const overlay = document.createElement('div');
      overlay.className = 'sidebar-overlay';
      overlay.style.position = 'fixed';
      overlay.style.inset = '0';
      overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
      overlay.style.zIndex = '20';
      document.body.appendChild(overlay);
      
      overlay.addEventListener('click', () => {
        sidebar.classList.remove('active');
        overlay.remove();
      });
    } else {
      document.querySelector('.sidebar-overlay')?.remove();
    }
  });
}

// User menu dropdown
const userButton = document.querySelector('.user-button');
const userDropdown = document.querySelector('.user-dropdown');

if (userButton && userDropdown) {
  userButton.addEventListener('click', (e) => {
    e.stopPropagation();
    userDropdown.classList.toggle('active');
  });
  
  document.addEventListener('click', (e) => {
    if (!userDropdown.contains(e.target)) {
      userDropdown.classList.remove('active');
    }
  });
}

// Sidebar menu toggles
const menuToggles = document.querySelectorAll('.menu-toggle');

menuToggles.forEach(toggle => {
  toggle.addEventListener('click', () => {
    const submenu = toggle.nextElementSibling;
    const icon = toggle.querySelector('.menu-icon');
    
    submenu.style.display = submenu.style.display === 'none' ? 'block' : 'none';
    icon.setAttribute('data-lucide', 
      submenu.style.display === 'none' ? 'chevron-right' : 'chevron-down'
    );
    lucide.createIcons();
  });
});

// Initialize Lucide icons
lucide.createIcons();

// Table search functionality
const tableSearchInputs = document.querySelectorAll('.table-search');

tableSearchInputs.forEach(input => {
  input.addEventListener('input', (e) => {
    const searchTerm = e.target.value.toLowerCase();
    const table = input.closest('.card').querySelector('table');
    const rows = table.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
  });
});

// Format currency values
function formatCurrency(value) {
  return new Intl.NumberFormat('pt-BR', {
    style: 'currency',
    currency: 'BRL'
  }).format(value);
}

// Format dates
function formatDate(dateString) {
  return new Date(dateString).toLocaleDateString('pt-BR');
}

// Handle form submissions
const forms = document.querySelectorAll('form');

forms.forEach(form => {
  form.addEventListener('submit', (e) => {
    e.preventDefault();
    
    // Here you would typically:
    // 1. Collect form data
    // 2. Validate the data
    // 3. Send to server via AJAX
    // 4. Handle the response
    
    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());
    
    console.log('Form submitted with data:', data);
    // Add your AJAX submission logic here
  });
});

// Dynamic content loading
function loadContent(page) {
  fetch(`pages/${page}.php`)
    .then(response => response.text())
    .then(html => {
      document.querySelector('.content').innerHTML = html;
      // Reinitialize any necessary components
      lucide.createIcons();
    })
    .catch(error => {
      console.error('Error loading content:', error);
    });
}

// Handle navigation without page reload
document.querySelectorAll('.nav-link').forEach(link => {
  link.addEventListener('click', (e) => {
    e.preventDefault();
    const page = link.getAttribute('href').substring(1);
    history.pushState(null, '', `?page=${page}`);
    loadContent(page);
  });
});

// Handle browser back/forward
window.addEventListener('popstate', () => {
  const page = new URLSearchParams(window.location.search).get('page') || 'dashboard';
  loadContent(page);
});