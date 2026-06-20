import './bootstrap';
import Alpine from 'alpinejs';
import persist from '@alpinejs/persist';
import collapse from '@alpinejs/collapse';

// Import Cropper.js
import Cropper from 'cropperjs';

// Import profile picture cropper functionality
import './profile-picture-cropper';

Alpine.plugin(persist);
Alpine.plugin(collapse);
window.Alpine = Alpine;
window.Cropper = Cropper;
Alpine.start();
