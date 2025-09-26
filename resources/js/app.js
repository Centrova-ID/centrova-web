import './bootstrap';
import Alpine from 'alpinejs';
import persist from '@alpinejs/persist';

// Import Cropper.js
import Cropper from 'cropperjs';

// Import profile picture cropper functionality
import './profile-picture-cropper';

Alpine.plugin(persist);
window.Alpine = Alpine;
window.Cropper = Cropper; // Make Cropper available globally
Alpine.start();
