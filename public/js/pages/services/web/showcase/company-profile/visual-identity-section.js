/**
 * Visual Identity Section Component
 * Displays design principles and visual identity information
 * @author Centrova Development Team
 * @version 1.0.0
 */

document.addEventListener('alpine:init', () => {
    Alpine.data('visualIdentitySection', () => ({
        designPrinciples: [
            {
                initial: "S",
                title: "Sederhana",
                description: "Clean dan mudah dipahami"
            },
            {
                initial: "M",
                title: "Modern",
                description: "Mengikuti tren desain terkini"
            },
            {
                initial: "P",
                title: "Profesional",
                description: "Mencerminkan kredibilitas bisnis"
            },
            {
                initial: "B",
                title: "Berkelas",
                description: "Elegan dan berkesan premium"
            }
        ]
    }));
});
