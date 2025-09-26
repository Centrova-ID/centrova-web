// Invoice JavaScript functionality for Centrova Retail

document.addEventListener('DOMContentLoaded', function() {
    // Initialize invoice functionality
    initializeInvoice();
});

function initializeInvoice() {
    // Add fade-in animation to invoice container
    const invoiceContainer = document.querySelector('.invoice-container');
    if (invoiceContainer) {
        invoiceContainer.classList.add('fade-in');
    }
    
    // Add hover effects to table rows
    const tableRows = document.querySelectorAll('.items-table tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.01)';
            this.style.transition = 'transform 0.2s ease';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
}

// Print functionality
function printInvoice() {
    // Hide elements that shouldn't be printed
    const noPrintElements = document.querySelectorAll('.no-print');
    noPrintElements.forEach(element => {
        element.style.display = 'none';
    });
    
    // Print the page
    window.print();
    
    // Show elements again after printing
    noPrintElements.forEach(element => {
        element.style.display = '';
    });
}

// Generate PDF functionality (placeholder)
function generatePDF() {
    showNotification('PDF generation feature will be implemented soon!', 'info');
}

// Send email functionality (placeholder)
function sendEmail() {
    showNotification('Email sending feature will be implemented soon!', 'info');
}

// Show notification
function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${getNotificationClass(type)}`;
    notification.innerHTML = `
        <div class="flex items-center gap-3">
            <i class="${getNotificationIcon(type)}"></i>
            <span>${message}</span>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-2 text-white hover:text-gray-200">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    // Add to body
    document.body.appendChild(notification);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (notification.parentElement) {
            notification.remove();
        }
    }, 5000);
}

function getNotificationClass(type) {
    switch (type) {
        case 'success':
            return 'bg-green-500 text-white';
        case 'error':
            return 'bg-red-500 text-white';
        case 'warning':
            return 'bg-yellow-500 text-white';
        default:
            return 'bg-blue-500 text-white';
    }
}

function getNotificationIcon(type) {
    switch (type) {
        case 'success':
            return 'fas fa-check-circle';
        case 'error':
            return 'fas fa-exclamation-circle';
        case 'warning':
            return 'fas fa-exclamation-triangle';
        default:
            return 'fas fa-info-circle';
    }
}

// Copy bank details to clipboard
function copyBankDetails() {
    const bankDetails = document.querySelector('.bank-details');
    if (bankDetails) {
        const text = bankDetails.innerText;
        navigator.clipboard.writeText(text).then(() => {
            showNotification('Bank details copied to clipboard!', 'success');
        }).catch(() => {
            showNotification('Failed to copy bank details', 'error');
        });
    }
}

// Format currency input
function formatCurrency(input) {
    let value = input.value.replace(/[^\d]/g, '');
    value = parseInt(value, 10);
    
    if (!isNaN(value)) {
        input.value = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(value);
    }
}

// Calculate total from items
function calculateTotal() {
    const itemRows = document.querySelectorAll('.item-row');
    let subtotal = 0;
    
    itemRows.forEach(row => {
        const quantity = parseFloat(row.querySelector('.quantity').value) || 0;
        const unitPrice = parseFloat(row.querySelector('.unit-price').value.replace(/[^\d]/g, '')) || 0;
        const amount = quantity * unitPrice;
        
        row.querySelector('.amount').textContent = formatIDR(amount);
        subtotal += amount;
    });
    
    const taxRate = parseFloat(document.querySelector('.tax-rate').value) || 0;
    const taxAmount = subtotal * (taxRate / 100);
    const total = subtotal + taxAmount;
    
    document.querySelector('.subtotal-amount').textContent = formatIDR(subtotal);
    document.querySelector('.tax-amount').textContent = formatIDR(taxAmount);
    document.querySelector('.total-amount').textContent = formatIDR(total);
}

// Format Indonesian Rupiah
function formatIDR(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(amount);
}

// Add new item row (for future invoice creation form)
function addItemRow() {
    const itemsContainer = document.querySelector('.items-container');
    if (itemsContainer) {
        const newRow = document.createElement('tr');
        newRow.className = 'item-row border-b border-gray-200';
        newRow.innerHTML = `
            <td class="p-4">
                <input type="text" class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Item description">
            </td>
            <td class="p-4">
                <input type="number" class="quantity w-full border border-gray-300 rounded px-3 py-2 text-center" value="1" onchange="calculateTotal()">
            </td>
            <td class="p-4">
                <input type="text" class="unit-price w-full border border-gray-300 rounded px-3 py-2 text-right" placeholder="0" onchange="calculateTotal()">
            </td>
            <td class="p-4 text-right">
                <span class="amount font-medium">Rp 0</span>
                <button type="button" onclick="removeItemRow(this)" class="ml-2 text-red-500 hover:text-red-700">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        `;
        itemsContainer.appendChild(newRow);
    }
}

// Remove item row
function removeItemRow(button) {
    const row = button.closest('.item-row');
    if (row) {
        row.remove();
        calculateTotal();
    }
}

// Export to different formats (placeholder functions)
function exportToExcel() {
    showNotification('Excel export feature will be implemented soon!', 'info');
}

function exportToCSV() {
    showNotification('CSV export feature will be implemented soon!', 'info');
}

// Save as draft (placeholder)
function saveAsDraft() {
    showNotification('Draft saved successfully!', 'success');
}

// Send reminder (placeholder)
function sendReminder() {
    showNotification('Reminder sent successfully!', 'success');
}

// Mark as paid (placeholder)
function markAsPaid() {
    showNotification('Invoice marked as paid!', 'success');
}
