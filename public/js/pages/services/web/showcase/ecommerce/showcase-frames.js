// E-Commerce Showcase Frames Component
document.addEventListener('alpine:init', () => {
    Alpine.data('showcaseFrames', () => ({
        scrollOffset: 0,
        frame2Offset: 20,
        frame4Offset: -20,
        animationId: null,
        
        init() {
            this.startAnimation();
        },
        
        startAnimation() {
            const animate = () => {
                const time = Date.now() * 0.0005;
                
                // Horizontal scroll animation
                this.scrollOffset = Math.sin(time) * 50;
                
                // Vertical floating animation for mobile frames
                this.frame2Offset = 20 + Math.sin(time * 1.2) * 15;
                this.frame4Offset = -20 + Math.cos(time * 0.8) * 15;
                
                this.animationId = requestAnimationFrame(animate);
            };
            
            animate();
        },
        
        destroy() {
            if (this.animationId) {
                cancelAnimationFrame(this.animationId);
            }
        }
    }));
});
