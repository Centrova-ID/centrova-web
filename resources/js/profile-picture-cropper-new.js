// Profile Picture Cropper functionality
// This file is automatically loaded by Vite and bundled with the main application

let cropper = null;

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    initializeFileInput();
});

function initializeFileInput() {
    const fileInput = document.getElementById('profile_picture_modal');
    
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    showCropStep(e.target.result);
                };
                reader.readAsDataURL(file);
            }
        });
    }
}

// Modal Functions
window.openUploadModal = function() {
    const modal = document.getElementById('uploadModal');
    modal.style.display = 'flex';
    setTimeout(() => {
        modal.style.opacity = '1';
    }, 10);
    showPreviewStep();
    document.body.style.overflow = 'hidden';
};

window.closeUploadModal = function() {
    const modal = document.getElementById('uploadModal');
    modal.style.opacity = '0';
    setTimeout(() => {
        modal.style.display = 'none';
    }, 200);
    document.body.style.overflow = 'auto';
    clearUploadPreview();
    clearIllustrationSelection();
    destroyCropper();
};

window.showPreviewStep = function() {
    document.getElementById('previewStep').classList.remove('hidden');
    document.getElementById('uploadOptionsStep').classList.add('hidden');
    document.getElementById('cropStep').classList.add('hidden');
};

window.showUploadOptions = function() {
    document.getElementById('previewStep').classList.add('hidden');
    document.getElementById('uploadOptionsStep').classList.remove('hidden');
    document.getElementById('cropStep').classList.add('hidden');
    showIllustrationTab();
};

function showCropStep(imageSrc) {
    document.getElementById('previewStep').classList.add('hidden');
    document.getElementById('uploadOptionsStep').classList.add('hidden');
    document.getElementById('cropStep').classList.remove('hidden');
    
    const image = document.getElementById('cropperImage');
    image.src = imageSrc;
    image.style.display = 'block';
    
    setTimeout(() => {
        initializeCropper();
    }, 100);
}

// Tab Functions
window.showIllustrationTab = function() {
    document.getElementById('illustrationTab').className = 'flex-1 py-2 px-4 rounded-md text-sm font-medium transition bg-white text-[#128AEB] shadow-sm';
    document.getElementById('uploadTab').className = 'flex-1 py-2 px-4 rounded-md text-sm font-medium transition text-gray-600 hover:text-gray-900';
    
    document.getElementById('illustrationContent').classList.remove('hidden');
    document.getElementById('uploadContent').classList.add('hidden');
};

window.showUploadTab = function() {
    document.getElementById('uploadTab').className = 'flex-1 py-2 px-4 rounded-md text-sm font-medium transition bg-white text-[#128AEB] shadow-sm';
    document.getElementById('illustrationTab').className = 'flex-1 py-2 px-4 rounded-md text-sm font-medium transition text-gray-600 hover:text-gray-900';
    
    document.getElementById('uploadContent').classList.remove('hidden');
    document.getElementById('illustrationContent').classList.add('hidden');
};

// Illustration Functions
window.selectIllustration = function(illustrationId) {
    document.querySelectorAll('.illustration-option').forEach(option => {
        option.classList.remove('border-[#128AEB]');
        option.classList.add('border-transparent');
    });
    
    const selectedOption = event.target.closest('.illustration-option');
    selectedOption.classList.remove('border-transparent');
    selectedOption.classList.add('border-[#128AEB]');
    
    document.getElementById('selectedIllustration').value = illustrationId;
    
    if (confirm('Apakah Anda yakin ingin menggunakan ilustrasi ini sebagai foto profil?')) {
        document.getElementById('illustrationForm').submit();
    } else {
        selectedOption.classList.add('border-transparent');
        selectedOption.classList.remove('border-[#128AEB]');
        document.getElementById('selectedIllustration').value = '';
    }
};

function clearIllustrationSelection() {
    document.querySelectorAll('.illustration-option').forEach(option => {
        option.classList.remove('border-[#128AEB]');
        option.classList.add('border-transparent');
    });
    document.getElementById('selectedIllustration').value = '';
}

function clearUploadPreview() {
    const fileInput = document.getElementById('profile_picture_modal');
    if (fileInput) fileInput.value = '';
    destroyCropper();
}

// Cropper Functions
function initializeCropper() {
    const image = document.getElementById('cropperImage');
    
    if (cropper) {
        cropper.destroy();
    }
    
    cropper = new window.Cropper(image, {
        aspectRatio: 1,
        viewMode: 1,
        autoCropArea: 0.8,
        responsive: true,
        background: false,
        movable: true,
        scalable: true,
        zoomable: true,
        rotatable: true,
        crop: function(event) {
            updateCropPreview();
        }
    });
}

function destroyCropper() {
    if (cropper) {
        cropper.destroy();
        cropper = null;
    }
}

function updateCropPreview() {
    if (!cropper) return;
    
    const canvas = cropper.getCroppedCanvas({
        width: 200,
        height: 200,
        fillColor: '#fff'
    });
    
    if (canvas) {
        const previewImage = document.getElementById('cropPreview');
        previewImage.src = canvas.toDataURL();
    }
}

window.rotateImage = function(degree) {
    if (cropper) {
        cropper.rotate(degree);
    }
};

window.flipImage = function(direction) {
    if (!cropper) return;
    
    const imageData = cropper.getImageData();
    
    if (direction === 'horizontal') {
        cropper.scaleX(imageData.scaleX === 1 ? -1 : 1);
    } else if (direction === 'vertical') {
        cropper.scaleY(imageData.scaleY === 1 ? -1 : 1);
    }
};

window.resetCropper = function() {
    if (cropper) {
        cropper.reset();
    }
};

window.applyCropAndUpload = function() {
    if (!cropper) return;
    
    const btn = document.getElementById('cropUploadBtn');
    const text = document.getElementById('cropUploadText');
    const spinner = document.getElementById('cropUploadSpinner');
    
    btn.disabled = true;
    text.textContent = 'Mengupload...';
    spinner.classList.remove('hidden');
    
    const canvas = cropper.getCroppedCanvas({
        width: 400,
        height: 400,
        fillColor: '#fff'
    });
    
    if (canvas) {
        canvas.toBlob(function(blob) {
            const formData = new FormData();
            formData.append('profile_picture', blob, 'cropped-profile.jpg');
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            
            const form = document.getElementById('uploadForm');
            const actionUrl = form.action;
            
            fetch(actionUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (response.ok) {
                    window.location.reload();
                } else {
                    throw new Error('Upload failed');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengupload foto. Silakan coba lagi.');
                
                btn.disabled = false;
                text.textContent = 'Gunakan Foto Ini';
                spinner.classList.add('hidden');
            });
        }, 'image/jpeg', 0.9);
    } else {
        btn.disabled = false;
        text.textContent = 'Gunakan Foto Ini';
        spinner.classList.add('hidden');
    }
};

// Close modal when clicking outside
document.addEventListener('click', function(e) {
    const modal = document.getElementById('uploadModal');
    if (e.target === modal) {
        closeUploadModal();
    }
});
