// Team Data for Centrova
const teamData = {
    'sultan-rahmatulloh': {
        name: 'Sultan Rahmatulloh',
        position: 'System & Software Developer',
        email: 'sultan@centrova.com',
        linkedin: 'https://linkedin.com/in/tanbopp',
        photo: '/assets/image/team/sultan_image_small.jpg',
        heroImage: '/assets/image/team/sultan_image_large.jpg',
        bio: {
            intro: 'Sultan Rahmatulloh adalah seorang pengusaha dan programmer yang mencetuskan ide lahirnya Centrova, sebuah platform teknologi untuk solusi digitalisasi bisnis di Indonesia.',
            content: [
                'Berawal dari keresahan melihat keterbatasan sistem digital untuk bisnis skala kecil hingga menengah, Sultan merancang konsep Centrova yang fokus pada solusi POS dan manajemen usaha yang mudah, aman, dan terjangkau.',
                'Selain aktif sebagai programmer, Sultan juga berperan dalam merancang arsitektur sistem, mengembangkan produk, serta membangun relasi strategis dengan berbagai pelaku usaha.',
                'Visinya sederhana: membuat teknologi bisnis lebih mudah diakses, dan membantu pelaku usaha Indonesia bertransformasi ke digital.'
            ]
        },
        education: [
            {
                degree: 'S1 Teknik Informatika',
                institution: 'Universitas Indonesia',
                period: '2010 - 2014',
                description: 'Fokus pada software engineering, database systems, dan human-computer interaction. Thesis tentang optimisasi sistem POS untuk UMKM Indonesia.',
                grade: 'Cumma Cum Laude'
            },
            {
                degree: 'MBA Executive Program',
                institution: 'INSEAD Business School',
                period: '2018 - 2019',
                description: 'Program eksekutif dengan fokus pada entrepreneurship, strategic management, dan digital transformation untuk Asia Pacific region.'
            }
        ],
        certifications: [
            { name: 'AWS Solutions Architect Professional', issuer: 'Amazon Web Services', year: '2023', status: 'Active' },
            { name: 'Certified Scrum Master (CSM)', issuer: 'Scrum Alliance', year: '2022', status: 'Active' },
            { name: 'PMP (Project Management Professional)', issuer: 'PMI', year: '2021', status: 'Active' },
            { name: 'Digital Marketing Certified Professional', issuer: 'Google', year: '2020', status: 'Active' }
        ],
        testimonials: [
            {
                name: 'Budi Santoso',
                position: 'CTO, TechCorp Indonesia',
                photo: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=100&h=100&fit=crop&crop=face',
                quote: 'Sultan adalah pemimpin visioner yang mampu menggabungkan inovasi teknologi dengan pemahaman mendalam tentang kebutuhan pasar Indonesia. Kolaborasi dengan Centrova sangat menguntungkan.',
                rating: 5
            },
            {
                name: 'Sarah Wijaya',
                position: 'Head of Product, Centrova',
                photo: 'https://images.unsplash.com/photo-1494790108755-2616b69a8e2c?q=80&w=100&h=100&fit=crop&crop=face',
                quote: 'Bekerja dengan Sultan sebagai mentor dan leader sangat menginspirasi. Beliau selalu mendorong tim untuk berinovasi dan tidak takut untuk mencoba hal-hal baru dalam mengembangkan produk.',
                rating: 5
            },
            {
                name: 'Ahmad Rahman',
                position: 'CEO, Digital Nusantara',
                photo: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=100&h=100&fit=crop&crop=face',
                quote: 'Sultan memiliki visi yang jelas tentang masa depan teknologi di Indonesia. Partnership strategis dengan Centrova membawa dampak positif signifikan untuk transformasi digital bisnis kami.',
                rating: 5
            }
        ],
        gallery: [
            {
                thumbnail: 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?q=80&w=300',
                fullsize: 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?q=80&w=1200',
                caption: 'Presentasi di Tech Conference 2024',
                description: 'Berbagi visi tentang masa depan teknologi di Indonesia',
                date: 'Januari 2024'
            },
            {
                thumbnail: 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=300',
                fullsize: 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=1200',
                caption: 'Workshop Digital Transformation',
                description: 'Memfasilitasi workshop untuk para entrepreneur muda',
                date: 'Februari 2024'
            },
            {
                thumbnail: 'https://images.unsplash.com/photo-1559223607-a43c990c692c?q=80&w=300',
                fullsize: 'https://images.unsplash.com/photo-1559223607-a43c990c692c?q=80&w=1200',
                caption: 'Tim Meeting Centrova',
                description: 'Diskusi strategis dengan tim leadership Centrova',
                date: 'Maret 2024'
            },
            {
                thumbnail: 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=300',
                fullsize: 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=1200',
                caption: 'Business Partnership Meeting',
                description: 'Membangun kemitraan strategis dengan perusahaan teknologi',
                date: 'April 2024'
            },
            {
                thumbnail: 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=300',
                fullsize: 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=1200',
                caption: 'Product Launch Event',
                description: 'Peluncuran fitur terbaru platform Centrova',
                date: 'Mei 2024'
            },
            {
                thumbnail: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=300',
                fullsize: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=1200',
                caption: 'Startup Mentoring Session',
                description: 'Memberikan mentoring kepada startup teknologi',
                date: 'Juni 2024'
            },
            {
                thumbnail: 'https://images.unsplash.com/photo-1556761175-4b46a572b786?q=80&w=300',
                fullsize: 'https://images.unsplash.com/photo-1556761175-4b46a572b786?q=80&w=1200',
                caption: 'Innovation Lab Visit',
                description: 'Kunjungan ke innovation lab untuk riset teknologi terbaru',
                date: 'Juli 2024'
            },
            {
                thumbnail: 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=300',
                fullsize: 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=1200',
                caption: 'Awards Ceremony',
                description: 'Menerima penghargaan Entrepreneur of the Year',
                date: 'Agustus 2024'
            }
        ]
    },
    'syahied-ramadhan': {
        name: 'Syahied Ramadhan',
        position: 'Marketing & Relations',
        email: 'syahied@centrova.com',
        linkedin: 'https://linkedin.com/in/tanbopp',
        photo: '/assets/image/team/syahied_image_small.jpg',
        heroImage: '/assets/image/team/syahied_image_large.jpg',
        bio: {
            intro: 'Syahied Ramadhan adalah Co-Founder dan Chief Marketing Officer di Centrova. Ia memimpin strategi pemasaran, brand, dan pertumbuhan pelanggan untuk memperluas adopsi solusi digital Centrova di seluruh Indonesia.',
            content: [
                'Berfokus pada strategi go-to-market dan brand building, Syahied merancang kampanye untuk menjangkau pelaku usaha mikro, kecil, dan menengah serta mengedukasi pasar tentang manfaat digitalisasi bisnis.',
                'Ia memimpin tim pemasaran, partnerships, dan customer growth dengan pendekatan data-driven, memanfaatkan analytics untuk meningkatkan retensi dan akuisisi pelanggan.',
                'Syahied aktif membina hubungan dengan komunitas pengusaha, mitra distribusi, dan channel sales untuk memperluas jangkauan produk serta memastikan solusi Centrova memenuhi kebutuhan pasar.'
            ]
        },
        gallery: [
            {
                thumbnail: 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?q=80&w=300',
                fullsize: 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?q=80&w=1200',
                caption: 'Presentasi di Tech Conference 2024',
                description: 'Berbagi visi tentang masa depan teknologi di Indonesia',
                date: 'Januari 2024'
            },
            {
                thumbnail: 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=300',
                fullsize: 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=1200',
                caption: 'Workshop Digital Transformation',
                description: 'Memfasilitasi workshop untuk para entrepreneur muda',
                date: 'Februari 2024'
            },
            {
                thumbnail: 'https://images.unsplash.com/photo-1559223607-a43c990c692c?q=80&w=300',
                fullsize: 'https://images.unsplash.com/photo-1559223607-a43c990c692c?q=80&w=1200',
                caption: 'Tim Meeting Centrova',
                description: 'Diskusi strategis dengan tim leadership Centrova',
                date: 'Maret 2024'
            },
            {
                thumbnail: 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=300',
                fullsize: 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=1200',
                caption: 'Business Partnership Meeting',
                description: 'Membangun kemitraan strategis dengan perusahaan teknologi',
                date: 'April 2024'
            },
            {
                thumbnail: 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=300',
                fullsize: 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=1200',
                caption: 'Product Launch Event',
                description: 'Peluncuran fitur terbaru platform Centrova',
                date: 'Mei 2024'
            },
            {
                thumbnail: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=300',
                fullsize: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=1200',
                caption: 'Startup Mentoring Session',
                description: 'Memberikan mentoring kepada startup teknologi',
                date: 'Juni 2024'
            },
            {
                thumbnail: 'https://images.unsplash.com/photo-1556761175-4b46a572b786?q=80&w=300',
                fullsize: 'https://images.unsplash.com/photo-1556761175-4b46a572b786?q=80&w=1200',
                caption: 'Innovation Lab Visit',
                description: 'Kunjungan ke innovation lab untuk riset teknologi terbaru',
                date: 'Juli 2024'
            },
            {
                thumbnail: 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=300',
                fullsize: 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=1200',
                caption: 'Awards Ceremony',
                description: 'Menerima penghargaan Entrepreneur of the Year',
                date: 'Agustus 2024'
            }
        ]
    },
    'muhammad-fadli': {
        name: 'Muhammad Fadli',
        position: 'Technical Support',
        email: 'muhammad.fadli@centrova.com',
        linkedin: 'https://linkedin.com/in/muhammad-fadli',
        photo: '/assets/image/team/muhammad-fadli/muhammad-fadli.png',
        heroImage: '/assets/image/team/muhammad-fadli/muhammad-fadli.png',
        bio: {
            intro: 'Muhammad Fadli adalah Co-Founder dan Chief Technology Officer di Centrova. Ia bertanggung jawab atas arsitektur teknis, infrastruktur cloud, dan pengembangan platform untuk memastikan skalabilitas, keamanan, dan ketersediaan layanan.',
            content: [
                'Sebagai CTO, Muhammad memimpin tim engineering dalam merancang sistem microservices yang scalable dan resilient, serta mengarahkan roadmap teknis untuk mendukung pertumbuhan pengguna dan volume transaksi.',
                'Ia fokus pada praktik terbaik rekayasa perangkat lunak, otomasi CI/CD, observability, dan optimisasi performa untuk menjaga latency rendah dan uptime tinggi.',
                'Muhammad juga mendorong inovasi teknis, termasuk adopsi cloud-native patterns, arsitektur berbasis event, dan inisiatif keamanan untuk melindungi data merchant dan pelanggan.'
            ]
        },
        education: [
            {
                degree: 'S1 Teknik Informatika',
                institution: 'Universitas Indonesia',
                period: '2010 - 2014',
                description: 'Fokus pada software engineering, database systems, dan human-computer interaction. Thesis tentang optimisasi sistem POS untuk UMKM Indonesia.',
                grade: 'Cumma Cum Laude'
            },
            {
                degree: 'MBA Executive Program',
                institution: 'INSEAD Business School',
                period: '2018 - 2019',
                description: 'Program eksekutif dengan fokus pada entrepreneurship, strategic management, dan digital transformation untuk Asia Pacific region.'
            }
        ],
        certifications: [
            { name: 'AWS Solutions Architect Professional', issuer: 'Amazon Web Services', year: '2023', status: 'Active' },
            { name: 'Certified Scrum Master (CSM)', issuer: 'Scrum Alliance', year: '2022', status: 'Active' },
            { name: 'PMP (Project Management Professional)', issuer: 'PMI', year: '2021', status: 'Active' },
            { name: 'Digital Marketing Certified Professional', issuer: 'Google', year: '2020', status: 'Active' }
        ],
        testimonials: [
            {
                name: 'Budi Santoso',
                position: 'CTO, TechCorp Indonesia',
                photo: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=100&h=100&fit=crop&crop=face',
                quote: 'Sultan adalah pemimpin visioner yang mampu menggabungkan inovasi teknologi dengan pemahaman mendalam tentang kebutuhan pasar Indonesia. Kolaborasi dengan Centrova sangat menguntungkan.',
                rating: 5
            },
            {
                name: 'Sarah Wijaya',
                position: 'Head of Product, Centrova',
                photo: 'https://images.unsplash.com/photo-1494790108755-2616b69a8e2c?q=80&w=100&h=100&fit=crop&crop=face',
                quote: 'Bekerja dengan Sultan sebagai mentor dan leader sangat menginspirasi. Beliau selalu mendorong tim untuk berinovasi dan tidak takut untuk mencoba hal-hal baru dalam mengembangkan produk.',
                rating: 5
            },
            {
                name: 'Ahmad Rahman',
                position: 'CEO, Digital Nusantara',
                photo: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=100&h=100&fit=crop&crop=face',
                quote: 'Sultan memiliki visi yang jelas tentang masa depan teknologi di Indonesia. Partnership strategis dengan Centrova membawa dampak positif signifikan untuk transformasi digital bisnis kami.',
                rating: 5
            }
        ],
        gallery: [
            {
                thumbnail: 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?q=80&w=300',
                fullsize: 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?q=80&w=1200',
                caption: 'Presentasi di Tech Conference 2024',
                description: 'Berbagi visi tentang masa depan teknologi di Indonesia',
                date: 'Januari 2024'
            },
            {
                thumbnail: 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=300',
                fullsize: 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=1200',
                caption: 'Workshop Digital Transformation',
                description: 'Memfasilitasi workshop untuk para entrepreneur muda',
                date: 'Februari 2024'
            },
            {
                thumbnail: 'https://images.unsplash.com/photo-1559223607-a43c990c692c?q=80&w=300',
                fullsize: 'https://images.unsplash.com/photo-1559223607-a43c990c692c?q=80&w=1200',
                caption: 'Tim Meeting Centrova',
                description: 'Diskusi strategis dengan tim leadership Centrova',
                date: 'Maret 2024'
            },
            {
                thumbnail: 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=300',
                fullsize: 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=1200',
                caption: 'Business Partnership Meeting',
                description: 'Membangun kemitraan strategis dengan perusahaan teknologi',
                date: 'April 2024'
            },
            {
                thumbnail: 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=300',
                fullsize: 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=1200',
                caption: 'Product Launch Event',
                description: 'Peluncuran fitur terbaru platform Centrova',
                date: 'Mei 2024'
            },
            {
                thumbnail: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=300',
                fullsize: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=1200',
                caption: 'Startup Mentoring Session',
                description: 'Memberikan mentoring kepada startup teknologi',
                date: 'Juni 2024'
            },
            {
                thumbnail: 'https://images.unsplash.com/photo-1556761175-4b46a572b786?q=80&w=300',
                fullsize: 'https://images.unsplash.com/photo-1556761175-4b46a572b786?q=80&w=1200',
                caption: 'Innovation Lab Visit',
                description: 'Kunjungan ke innovation lab untuk riset teknologi terbaru',
                date: 'Juli 2024'
            },
            {
                thumbnail: 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=300',
                fullsize: 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=1200',
                caption: 'Awards Ceremony',
                description: 'Menerima penghargaan Entrepreneur of the Year',
                date: 'Agustus 2024'
            }
        ]
    },
    // 'daffa-utomo': {
    //     name: 'Daffa Utomo',
    //     position: 'Services Developer',
    //     email: 'daffa@centrova.id',
    //     phone: '+62 821 3456 7890',
    //     linkedin: 'https://linkedin.com/in/daffautomo',
    //     whatsapp: 'https://wa.me/6282134567890',
    //     photo: '/assets/image/team/daffa/daffa.png',
    //     heroImage: '/assets/image/team/daffa/daffa.png',
    //     bio: {
    //         intro: 'Daffa Utomo adalah Chief Technology Officer Centrova yang bertanggung jawab atas pengembangan teknologi dan inovasi produk untuk solusi POS terdepan di Indonesia.',
    //         content: [
    //             'Dengan pengalaman lebih dari 8 tahun dalam pengembangan software, Daffa memimpin tim engineering dalam membangun arsitektur sistem yang scalable dan reliable untuk melayani ribuan merchant di seluruh Indonesia.',
    //             'Daffa memiliki keahlian mendalam dalam cloud computing, microservices architecture, dan modern web technologies. Dia juga aktif dalam komunitas developer dan sering berbagi knowledge melalui tech talks dan workshop.',
    //             'Di bawah kepemimpinannya, tim technical Centrova berhasil mengembangkan platform yang dapat menangani jutaan transaksi per hari dengan uptime 99.9% dan response time yang optimal.'
    //         ]
    //     },
    //     highlights: [
    //         {
    //             icon: 'code',
    //             title: 'Technical Excellence',
    //             description: 'Memimpin pengembangan arsitektur sistem yang dapat menangani jutaan transaksi dengan performa optimal.'
    //         },
    //         {
    //             icon: 'team',
    //             title: 'Engineering Leadership',
    //             description: 'Mengelola tim engineering 25+ developer dengan metodologi agile dan best practices modern.'
    //         },
    //         {
    //             icon: 'innovation',
    //             title: 'Product Innovation',
    //             description: 'Mengembangkan fitur-fitur inovatif seperti AI analytics dan real-time reporting untuk merchant.'
    //         }
    //     ],
    //     skills: {
    //         technical: [
    //             { name: 'System Architecture', level: 5 },
    //             { name: 'Cloud Computing (AWS)', level: 5 },
    //             { name: 'Microservices', level: 5 },
    //             { name: 'Database Design', level: 4 },
    //             { name: 'DevOps & CI/CD', level: 4 }
    //         ],
    //         leadership: [
    //             { name: 'Engineering Management', level: 5 },
    //             { name: 'Technical Strategy', level: 4 },
    //             { name: 'Product Development', level: 5 },
    //             { name: 'Team Mentoring', level: 5 },
    //             { name: 'Agile Methodology', level: 4 }
    //         ]
    //     },
    //     career: [
    //         {
    //             period: '2021 - Sekarang',
    //             title: 'Chief Technology Officer - Centrova',
    //             description: 'Memimpin strategi teknologi dan mengawasi seluruh aspek pengembangan produk. Mengelola tim engineering 25+ orang dan bertanggung jawab atas infrastruktur teknologi perusahaan.',
    //             skills: ['Technical Leadership', 'System Architecture', 'Team Management'],
    //             color: '#128AEB'
    //         },
    //         {
    //             period: '2019 - 2021',
    //             title: 'Senior Full Stack Developer - Centrova',
    //             description: 'Mengembangkan core features platform POS dan membangun fondasi arsitektur sistem. Terlibat dalam migrasi dari monolith ke microservices architecture.',
    //             skills: ['Full Stack Development', 'System Design', 'API Development'],
    //             color: '#0F76C6'
    //         },
    //         {
    //             period: '2017 - 2019',
    //             title: 'Software Engineer - TechStart Indonesia',
    //             description: 'Mengembangkan aplikasi web dan mobile untuk berbagai klien enterprise. Fokus pada performance optimization dan user experience.',
    //             skills: ['Web Development', 'Mobile Development', 'Performance Optimization'],
    //             color: '#128AEB'
    //         }
    //     ],
    //     achievements: [
    //         {
    //             title: 'Best Technical Innovation 2024',
    //             description: 'Penghargaan untuk pengembangan AI-powered analytics yang meningkatkan insights bisnis merchant.',
    //             organization: 'Indonesia Tech Awards',
    //             color: '#128AEB'
    //         },
    //         {
    //             title: 'Rising Tech Leader 2023',
    //             description: 'Diakui sebagai emerging technology leader under 35 yang berkontribusi pada digital transformation.',
    //             organization: 'Tech Leaders Indonesia',
    //             color: '#0F76C6'
    //         }
    //     ],
    //     education: [
    //         {
    //             degree: 'S1 Ilmu Komputer',
    //             institution: 'Institut Teknologi Bandung',
    //             period: '2013 - 2017',
    //             description: 'Fokus pada software engineering dan artificial intelligence. Final project tentang machine learning untuk business intelligence.',
    //             grade: 'Magna Cum Laude'
    //         }
    //     ],
    //     certifications: [
    //         { name: 'AWS Solutions Architect Associate', issuer: 'Amazon Web Services', year: '2023', status: 'Active' },
    //         { name: 'Google Cloud Professional Developer', issuer: 'Google Cloud', year: '2022', status: 'Active' },
    //         { name: 'Certified Kubernetes Administrator', issuer: 'CNCF', year: '2022', status: 'Active' }
    //     ],
    //     testimonials: [
    //         {
    //             name: 'Sultan Rahmatulloh',
    //             position: 'CEO, Centrova',
    //             photo: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=100&h=100&fit=crop&crop=face',
    //             quote: 'Daffa adalah technical leader yang luar biasa. Kemampuannya dalam merancang sistem yang scalable dan memimpin tim engineering sangat menginspirasi.',
    //             rating: 5
    //         },
    //         {
    //             name: 'Rina Sari',
    //             position: 'Senior Developer, Centrova',
    //             photo: 'https://images.unsplash.com/photo-1494790108755-2616b69a8e2c?q=80&w=100&h=100&fit=crop&crop=face',
    //             quote: 'Daffa selalu memberikan guidance yang clear dan memastikan tim dapat grow secara technical. Best CTO I\'ve worked with!',
    //             rating: 5
    //         }
    //     ],
    //     gallery: [
    //         {
    //             thumbnail: 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=300',
    //             fullsize: 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=1200',
    //             caption: 'Tech Talk - Microservices Architecture',
    //             description: 'Sharing knowledge tentang best practices microservices',
    //             date: 'Maret 2024'
    //         },
    //         {
    //             thumbnail: 'https://images.unsplash.com/photo-1559223607-a43c990c692c?q=80&w=300',
    //             fullsize: 'https://images.unsplash.com/photo-1559223607-a43c990c692c?q=80&w=1200',
    //             caption: 'Engineering Team Meeting',
    //             description: 'Sprint planning dan technical discussion',
    //             date: 'April 2024'
    //         },
    //         {
    //             thumbnail: 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=300',
    //             fullsize: 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=1200',
    //             caption: 'Code Review Session',
    //             description: 'Mentoring junior developers dalam code review',
    //             date: 'Mei 2024'
    //         }
    //     ]
    // },
};

// Function to get team member data
function getTeamMember(slug) {
    return teamData[slug] || null;
}

// Function to get all team members
function getAllTeamMembers() {
    return Object.keys(teamData).map(slug => ({
        slug,
        ...teamData[slug]
    }));
}

// Export for use in other files
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { teamData, getTeamMember, getAllTeamMembers };
}
