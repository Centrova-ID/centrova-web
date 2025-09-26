/**
 * Technology Section Component
 * Displays technology stack and tools used in development
 * @author Centrova Development Team
 * @version 1.0.0
 */

document.addEventListener('alpine:init', () => {
    Alpine.data('technologySection', () => ({
        frontendTech: [
            { name: "HTML5", description: "Markup modern", logo: "https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg" },
            { name: "CSS3", description: "Styling advanced", logo: "https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg" },
            { name: "JavaScript", description: "Interactive features", logo: "https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" },
            { name: "React", description: "UI components", logo: "https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg" },
            { name: "Vue.js", description: "Progressive framework", logo: "https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vuejs/vuejs-original.svg" },
            { name: "Alpine.js", description: "Lightweight JS", logo: "https://pcbowers.gallerycdn.vsassets.io/extensions/pcbowers/alpine-intellisense/1.0.2/1655321215983/Microsoft.VisualStudio.Services.Icons.Default" }
        ],
        backendTech: [
            { name: "Laravel", description: "PHP framework", logo: "https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/1200px-Laravel.svg.png" },
            { name: "Node.js", description: "Server runtime", logo: "https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nodejs/nodejs-original.svg" },
            { name: "MySQL", description: "Database system", logo: "https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg" },
            { name: "PostgreSQL", description: "Advanced database", logo: "https://cdn.jsdelivr.net/gh/devicons/devicon/icons/postgresql/postgresql-original.svg" },
            { name: "MongoDB", description: "NoSQL database", logo: "https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mongodb/mongodb-original.svg" }
        ],
        tools: [
            { name: "Docker", description: "Containerization", logo: "https://cdn.jsdelivr.net/gh/devicons/devicon/icons/docker/docker-original.svg" },
            { name: "Git", description: "Version control", logo: "https://cdn.jsdelivr.net/gh/devicons/devicon/icons/git/git-original.svg" },
            { name: "AWS", description: "Cloud platform", logo: "https://upload.wikimedia.org/wikipedia/commons/thumb/9/93/Amazon_Web_Services_Logo.svg/2560px-Amazon_Web_Services_Logo.svg.png" },
            { name: "Figma", description: "Design tool", logo: "https://cdn.jsdelivr.net/gh/devicons/devicon/icons/figma/figma-original.svg" },
            { name: "Tailwind", description: "CSS framework", logo: "https://upload.wikimedia.org/wikipedia/commons/thumb/d/d5/Tailwind_CSS_Logo.svg/2560px-Tailwind_CSS_Logo.svg.png" },
            { name: "Webpack", description: "Module bundler", logo: "https://cdn.jsdelivr.net/gh/devicons/devicon/icons/webpack/webpack-original.svg" }
        ],
        techBenefits: [
            {
                title: "Performance Optimal",
                description: "Loading time super cepat dengan optimasi code dan caching yang efisien",
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>'
            },
            {
                title: "Scalability Tinggi",
                description: "Arsitektur yang dapat menangani traffic tinggi dan pertumbuhan bisnis",
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-6m0 0l5 6m-5-6v12"/>'
            },
            {
                title: "Security Terjamin",
                description: "Implementasi best practices keamanan untuk melindungi data dan sistem",
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>'
            }
        ]
    }));
});
