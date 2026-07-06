import './bootstrap';
import Alpine from 'alpinejs';
import persist from '@alpinejs/persist';
import collapse from '@alpinejs/collapse';

// Import Cropper.js
import Cropper from 'cropperjs';

// Import profile picture cropper functionality
import './profile-picture-cropper';

// Import TinyMCE
import tinymce from 'tinymce';

// TinyMCE icons, theme, and plugins
import 'tinymce/icons/default';
import 'tinymce/themes/silver';
import 'tinymce/skins/ui/oxide/skin.min.css';
import 'tinymce/skins/ui/oxide/content.min.css';
import 'tinymce/skins/content/default/content.min.css';

// TinyMCE plugins
import 'tinymce/plugins/advlist';
import 'tinymce/plugins/autolink';
import 'tinymce/plugins/lists';
import 'tinymce/plugins/link';
import 'tinymce/plugins/image';
import 'tinymce/plugins/charmap';
import 'tinymce/plugins/preview';
import 'tinymce/plugins/anchor';
import 'tinymce/plugins/searchreplace';
import 'tinymce/plugins/visualblocks';
import 'tinymce/plugins/code';
import 'tinymce/plugins/fullscreen';
import 'tinymce/plugins/insertdatetime';
import 'tinymce/plugins/media';
import 'tinymce/plugins/table';
import 'tinymce/plugins/help';
import 'tinymce/plugins/wordcount';

window.tinymce = tinymce;

// Initialize AOS (Animate On Scroll)
import AOS from 'aos';
import 'aos/dist/aos.css';

// Initialize AOS immediately (module scripts run after DOM parsing)
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => AOS.init({
        duration: 700,
        once: true,
        offset: 50
    }));
} else {
    AOS.init({
        duration: 700,
        once: true,
        offset: 50
    });
}

Alpine.plugin(persist);
Alpine.plugin(collapse);
window.Alpine = Alpine;
window.Cropper = Cropper;
Alpine.start();

// Initialize AOS after DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    AOS.init({
        duration: 700,
        once: true,
        offset: 50
    });
});
