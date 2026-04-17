<?php
/**
 * JJ Media House - Premium Landing Page
 * Single-file PHP/Tailwind Solution
 */

// Form Handling
$formMessage = "";
$formStatus = ""; // "success" or "error"

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS);

    if ($name && $email && $message) {
        // In a real scenario, use PHPMailer here. For this demo, we'll simulate success.
        $formStatus = "success";
        $formMessage = "Thank you, $name. Your message has been sent successfully.";
    } else {
        $formStatus = "error";
        $formMessage = "Please fill in all required fields.";
    }

    // If it's an AJAX request, return JSON
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        echo json_encode(['status' => $formStatus, 'message' => $formMessage]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JJ Media House | Your Brand. Unmissable. Everywhere.</title>
    <meta name="description" content="Premium outdoor advertising across Bengaluru's most strategic corridors. Bold, beautiful, impossible to ignore.">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            bg: '#0a0a0a',
                            card: '#1e1e1e',
                            text: '#f5f0e8',
                            gold: '#3e83f4',
                            muted: '#888888',
                        }
                    },
                    fontFamily: {
                        heading: ['"Playfair Display"', 'serif'],
                        body: ['"DM Sans"', 'sans-serif'],
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.8s ease-out forwards',
                        'marquee': 'marquee 25s linear infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        marquee: {
                            '0%': { transform: 'translateX(0%)' },
                            '100%': { transform: 'translateX(-50%)' },
                        }
                    }
                }
            }
        }
    </script>
    
    <style type="text/css">
        :root {
            --brand-gold: #3e83f4;
            --brand-bg: #0a0a0a;
        }

        body {
            background-color: var(--brand-bg);
            color: #f5f0e8;
            font-family: 'DM Sans', sans-serif;
            overflow-x: hidden;
        }

        .noise-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none;
            opacity: 0.05;
            z-index: 9999;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
        }

        .text-outline {
            -webkit-text-stroke: 1px var(--brand-gold);
            color: transparent;
        }

        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease-out;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0a0a0a; }
        ::-webkit-scrollbar-thumb { background: #3e83f4; }
    </style>
</head>
<body class="selection:bg-brand-gold selection:text-brand-bg">

    <div class="noise-overlay"></div>

    <!-- Navigation -->
    <nav id="navbar" class="fixed top-0 w-full z-[120] transition-all duration-500 px-6 md:px-12 py-6 flex justify-between items-center bg-transparent">
        <a href="#" class="text-3xl font-heading font-black text-brand-gold tracking-tighter">JJ.</a>
        
        <div class="hidden md:flex space-x-10 items-center">
            <a href="#services" class="hover:text-brand-gold transition-colors text-sm uppercase tracking-widest font-medium">Services</a>
            <a href="#about" class="hover:text-brand-gold transition-colors text-sm uppercase tracking-widest font-medium">About</a>
            <a href="#locations" class="hover:text-brand-gold transition-colors text-sm uppercase tracking-widest font-medium">Locations</a>
            <a href="#contact" class="hover:text-brand-gold transition-colors text-sm uppercase tracking-widest font-medium">Contact</a>
            <a href="#contact" class="border border-brand-gold px-6 py-2 text-brand-gold text-xs uppercase tracking-widest font-bold hover:bg-brand-gold hover:text-brand-bg transition-all active:scale-95">Book a Site</a>
        </div>

        <button id="menu-btn" class="md:hidden text-brand-gold z-[110]">
            <svg id="menu-icon" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path></svg>
        </button>
    </nav>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu" class="fixed inset-0 bg-brand-bg z-[105] translate-x-full transition-transform duration-500 flex flex-col justify-center items-center space-y-8 p-12">
        <a href="#services" class="mobile-link text-4xl font-heading hover:text-brand-gold">Services</a>
        <a href="#about" class="mobile-link text-4xl font-heading hover:text-brand-gold">About</a>
        <a href="#locations" class="mobile-link text-4xl font-heading hover:text-brand-gold">Locations</a>
        <a href="#contact" class="mobile-link text-4xl font-heading hover:text-brand-gold">Contact</a>
        <a href="#contact" class="mobile-link bg-brand-gold text-brand-bg px-10 py-4 font-bold uppercase tracking-widest">Book a Site</a>
    </div>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex flex-col justify-between overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="assets/img/hero.png" alt="Bengaluru Night Skyline" class="w-full h-full object-cover opacity-30 grayscale hover:grayscale-0 transition-all duration-1000 scale-105">
            <div class="absolute inset-0 bg-gradient-to-r from-brand-bg via-brand-bg/80 to-transparent"></div>
        </div>

        <!-- Main Hero Content -->
        <div class="relative z-10 flex-grow flex flex-col justify-center px-6 md:px-24 pt-32 pb-12">
            <div class="max-w-4xl">
                <div class="space-y-1 overflow-hidden">
                    <h1 class="text-5xl md:text-8xl lg:text-[95px] font-heading font-black leading-[0.9] translate-y-full animate-fade-in-up" style="animation-delay: 0.1s;">Your Brand.</h1>
                    <h1 class="text-5xl md:text-8xl lg:text-[95px] font-heading font-black italic text-brand-gold leading-[0.9] translate-y-full animate-fade-in-up" style="animation-delay: 0.3s;">Unmissable.</h1>
                    <h1 class="text-5xl md:text-8xl lg:text-[95px] font-heading font-black leading-[0.9] translate-y-full animate-fade-in-up" style="animation-delay: 0.5s;">Everywhere.</h1>
                </div>
                
                <p class="mt-8 text-lg md:text-xl text-brand-muted max-w-xl leading-relaxed reveal" style="transition-delay: 0.7s;">
                    Premium outdoor advertising across Bengaluru's most strategic corridors. <span class="text-brand-text">Bold, beautiful, impossible to ignore.</span>
                </p>

                <div class="mt-12 flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6 reveal" style="transition-delay: 0.9s;">
                    <a href="#locations" class="bg-brand-gold text-brand-bg px-10 py-4 font-bold uppercase tracking-widest hover:bg-opacity-90 transition-all active:scale-95 text-center">Explore Locations</a>
                    <a href="#services" class="border border-white/20 hover:border-brand-gold px-10 py-4 font-bold uppercase tracking-widest hover:text-brand-gold transition-all active:scale-95 text-center">Our Services</a>
                </div>
            </div>
        </div>

        <!-- Global Stats Row (Relative to bottom of flex container) -->
        <div class="relative z-10 w-full grid grid-cols-2 md:grid-cols-4 border-t border-white/10 bg-brand-bg/50 backdrop-blur-md">
            <div class="p-6 md:p-8 border-r border-white/10 text-center">
                <span class="block text-brand-gold font-heading text-2xl font-bold">2019</span>
                <span class="text-[10px] uppercase tracking-widest text-brand-muted">Established</span>
            </div>
            <div class="p-6 md:p-8 md:border-r border-white/10 text-center">
                <span class="block text-brand-gold font-heading text-2xl font-bold">Bengaluru</span>
                <span class="text-[10px] uppercase tracking-widest text-brand-muted">HQ</span>
            </div>
            <div class="p-6 md:p-8 border-r border-white/10 text-center">
                <span class="block text-brand-gold font-heading text-2xl font-bold">6+</span>
                <span class="text-[10px] uppercase tracking-widest text-brand-muted">Active Sites</span>
            </div>
            <div class="p-6 md:p-8 text-center">
                <span class="block text-brand-gold font-heading text-2xl font-bold">50+</span>
                <span class="text-[10px] uppercase tracking-widest text-brand-muted">Brand Partners</span>
            </div>
        </div>
    </section>

    <!-- Marquee Ticker -->
    <div class="bg-brand-gold py-6 overflow-hidden select-none border-y border-brand-gold/20">
        <div class="flex whitespace-nowrap animate-marquee">
            <?php for($i=0; $i<2; $i++): ?>
                <div class="flex space-x-12 items-center mx-6">
                    <span class="text-brand-bg text-xl font-black uppercase tracking-tighter">Billboard Advertising</span>
                    <span class="text-brand-bg/40 text-xl font-black">•</span>
                    <span class="text-brand-bg text-xl font-black uppercase tracking-tighter">Creative Production</span>
                    <span class="text-brand-bg/40 text-xl font-black">•</span>
                    <span class="text-brand-bg text-xl font-black uppercase tracking-tighter">Brand Films</span>
                    <span class="text-brand-bg/40 text-xl font-black">•</span>
                    <span class="text-brand-bg text-xl font-black uppercase tracking-tighter">Media Planning</span>
                    <span class="text-brand-bg/40 text-xl font-black">•</span>
                    <span class="text-brand-bg text-xl font-black uppercase tracking-tighter">Transit Media</span>
                    <span class="text-brand-bg/40 text-xl font-black">•</span>
                    <span class="text-brand-bg text-xl font-black uppercase tracking-tighter">Photography</span>
                    <span class="text-brand-bg/40 text-xl font-black">•</span>
                    <span class="text-brand-bg text-xl font-black uppercase tracking-tighter">Digital OOH</span>
                    <span class="text-brand-bg/40 text-xl font-black">•</span>
                </div>
            <?php endfor; ?>
        </div>
    </div>

    <!-- Expertise Section -->
    <section id="services" class="py-24 md:py-32 px-6 md:px-24">
        <div class="mb-20 text-center md:text-left">
            <span class="text-brand-gold uppercase tracking-[0.3em] text-xs font-bold px-4 py-1 border border-brand-gold/30">Expertise</span>
            <h2 class="mt-6 text-5xl md:text-7xl font-heading font-black leading-tight">Full-Spectrum<br><span class="italic text-brand-gold selection:text-brand-text">Media Solutions</span></h2>
            <p class="mt-6 text-brand-muted max-w-xl text-lg">From architectural concept to precision installation, we turn strategic locations into cinematic brand statements.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Service Cards -->
            <?php
            $services = [
                ['tag' => 'Core', 'title' => 'Billboard Advertising', 'desc' => 'Static and digital placements. Formats from 40×20 to super-sized spectaculars.'],
                ['tag' => 'Design', 'title' => 'Creative Production', 'desc' => 'In-house digital design, wide-format printing, and professional installation teams.'],
                ['tag' => 'Cinematic', 'title' => 'Brand Films', 'desc' => 'High-end TVCs and brand storytelling films captured for high-impact viewing.'],
                ['tag' => 'Data', 'title' => 'Media Planning', 'desc' => 'Data-driven site selection utilizing traffic density and demographic insights.'],
                ['tag' => 'Urban', 'title' => 'Transit Media', 'desc' => 'Bus shelters, metro panels, and auto branding across Bengaluru\'s major hubs.'],
                ['tag' => 'Visual', 'title' => 'Photography', 'desc' => 'Professional editorial, commercial, and corporate portraiture for leading brands.'],
            ];

            foreach($services as $idx => $s): ?>
                <div class="reveal bg-brand-card p-10 border border-white/5 hover:border-brand-gold group transition-all duration-500 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-[1px] bg-brand-gold scale-x-0 group-hover:scale-x-100 transition-transform duration-700 origin-left"></div>
                    <span class="text-[10px] uppercase tracking-widest text-brand-gold font-bold mb-4 block"><?php echo $s['tag']; ?></span>
                    <h3 class="text-2xl font-heading font-bold mb-4 group-hover:text-brand-gold transition-colors"><?php echo $s['title']; ?></h3>
                    <p class="text-brand-muted group-hover:text-brand-text transition-colors leading-relaxed"><?php echo $s['desc']; ?></p>
                    <div class="mt-8 opacity-20 group-hover:opacity-100 transition-opacity">
                        <svg class="w-6 h-6 transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 md:py-32 bg-brand-card/30 relative">
        <div class="container mx-auto px-6 md:px-24">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div class="reveal">
                    <span class="text-brand-gold uppercase tracking-[0.3em] text-xs font-bold mb-6 block">Who We Are</span>
                    <h2 class="text-5xl md:text-7xl font-heading font-black mb-10 leading-tight">Crafted for <span class="italic text-brand-gold">Impact.</span></h2>
                    <p class="text-xl text-brand-muted leading-relaxed mb-8">
                        JJ Media House bridges creative excellence with India's fastest-growing markets. We are architects of visibility, specializing in high-frequency outdoor assets that command attention in an age of distraction.
                    </p>
                    <p class="text-brand-muted leading-relaxed">
                        With over 5 years of experience in the Bengaluru market, we have evolved from traditional billboards to a multi-platform media powerhouse, serving some of the biggest names in tech, retail, and real estate.
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-6 reveal" style="transition-delay: 0.3s;">
                    <div class="p-10 border border-white/10 bg-brand-bg rounded-none text-center">
                        <div class="text-4xl md:text-5xl font-heading font-black text-brand-gold mb-2 stat-number" data-target="120">0</div>
                        <div class="text-[10px] uppercase tracking-widest text-brand-muted">Projects Done</div>
                    </div>
                    <div class="p-10 border border-white/10 bg-brand-bg rounded-none text-center">
                        <div class="text-4xl md:text-5xl font-heading font-black text-brand-gold mb-2 stat-number" data-target="6">0</div>
                        <div class="text-[10px] uppercase tracking-widest text-brand-muted">Active Sites</div>
                    </div>
                    <div class="p-10 border border-white/10 bg-brand-bg rounded-none text-center">
                        <div class="text-4xl md:text-5xl font-heading font-black text-brand-gold mb-2 stat-number" data-target="50">0</div>
                        <div class="text-[10px] uppercase tracking-widest text-brand-muted">Brand Partners</div>
                    </div>
                    <div class="p-10 border border-white/10 bg-brand-bg rounded-none text-center">
                        <div class="text-4xl md:text-5xl font-heading font-black text-brand-gold mb-2 stat-number" data-target="5">0</div>
                        <div class="text-[10px] uppercase tracking-widest text-brand-muted">Years Exp</div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mt-24 reveal" style="transition-delay: 0.5s;">
                <div class="flex space-x-6">
                    <span class="text-brand-gold font-heading text-4xl font-bold opacity-30">01</span>
                    <div>
                        <h4 class="font-bold uppercase tracking-widest text-sm mb-3">Origin</h4>
                        <p class="text-brand-muted text-sm leading-relaxed">From Lagos to Bengaluru — a global aesthetic meets local market mastery.</p>
                    </div>
                </div>
                <div class="flex space-x-6">
                    <span class="text-brand-gold font-heading text-4xl font-bold opacity-30">02</span>
                    <div>
                        <h4 class="font-bold uppercase tracking-widest text-sm mb-3">Method</h4>
                        <p class="text-brand-muted text-sm leading-relaxed">Data-driven placement focusing on traffic density and sight-line optimization.</p>
                    </div>
                </div>
                <div class="flex space-x-6">
                    <span class="text-brand-gold font-heading text-4xl font-bold opacity-30">03</span>
                    <div>
                        <h4 class="font-bold uppercase tracking-widest text-sm mb-3">Future</h4>
                        <p class="text-brand-muted text-sm leading-relaxed">Pioneering programmatic DOOH assets that adapt in real-time to traffic flow.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Locations Section -->
    <section id="locations" class="py-24 md:py-32 px-6 md:px-24">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 space-y-8 md:space-y-0 text-center md:text-left">
            <div>
                <span class="text-brand-gold uppercase tracking-[0.3em] text-xs font-bold block mb-4">Inventory</span>
                <h2 class="text-5xl md:text-7xl font-heading font-black">Prime <span class="italic text-brand-gold">Inventory</span></h2>
                <p class="text-brand-muted mt-4 max-w-sm">Strategic sites across Bengaluru's highest-density corridors.</p>
            </div>
            <a href="#contact" class="hidden md:block border-b border-brand-gold pb-2 text-brand-gold uppercase tracking-widest text-sm font-bold hover:scale-105 transition-transform">Inquire about availability</a>
        </div>

        <div class="flex overflow-x-auto md:grid md:grid-cols-5 gap-6 no-scrollbar snap-x">
            <?php
            $locations = [
                ['name' => 'Kamanahalli', 'traffic' => '45K+/day', 'id' => '01'],
                ['name' => 'Manyata Tech Park', 'traffic' => '80K+/day', 'id' => '02'],
                ['name' => 'Hebbal Flyover', 'traffic' => '120K+/day', 'id' => '03'],
                ['name' => 'Hennur Main Road', 'traffic' => '60K+/day', 'id' => '04'],
                ['name' => 'Devanahalli', 'traffic' => '35K+/day', 'id' => '05'],
            ];
            foreach($locations as $l): ?>
                <div class="reveal snap-center min-w-[280px] bg-brand-card p-8 border border-white/5 hover:border-brand-gold group transition-all duration-500 flex flex-col justify-between h-[400px]">
                    <div>
                        <span class="text-4xl font-heading font-black text-brand-gold/10 group-hover:text-brand-gold/20 transition-colors block mb-4"><?php echo $l['id']; ?></span>
                        <h3 class="text-2xl font-heading font-black mb-4"><?php echo $l['name']; ?></h3>
                    </div>
                    <div class="space-y-4">
                        <span class="inline-block bg-brand-gold/10 text-brand-gold text-[10px] font-bold uppercase tracking-widest px-3 py-1"><?php echo $l['traffic']; ?></span>
                        <p class="text-xs text-brand-muted uppercase tracking-widest">Active Site</p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-24 md:py-32 px-6 md:px-24 bg-brand-bg relative overflow-hidden">
        <div class="absolute top-0 right-0 w-1/2 h-full bg-brand-gold/5 -skew-x-12 translate-x-1/2 pointer-events-none"></div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 relative z-10">
            <div class="reveal">
                <h2 class="text-5xl md:text-8xl font-heading font-black leading-tight mb-8">Let's Build<br>Something <span class="text-brand-gold italic">Bold.</span></h2>
                <p class="text-xl text-brand-muted mb-12">Ready to make your brand unmissable? Our media planners are ready to draft your visibility strategy.</p>
                
                <div class="space-y-10">
                    <div class="flex items-start space-x-6">
                        <div class="w-12 h-12 flex items-center justify-center border border-brand-gold/30 text-brand-gold">
                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase tracking-[0.3em] text-brand-muted mb-1">Call Our Office</p>
                            <p class="text-xl font-bold">+91 99999 99999</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-6">
                        <div class="w-12 h-12 flex items-center justify-center border border-brand-gold/30 text-brand-gold">
                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase tracking-[0.3em] text-brand-muted mb-1">Email Inquiry</p>
                            <p class="text-xl font-bold">hello@jjmedia.in</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-6">
                        <div class="w-12 h-12 flex items-center justify-center border border-brand-gold/30 text-brand-gold">
                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase tracking-[0.3em] text-brand-muted mb-1">Headquarters</p>
                            <p class="text-xl font-bold">Bengaluru, India</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="reveal" style="transition-delay: 0.3s;">
                <form id="contactForm" class="bg-brand-card p-10 md:p-14 border border-white/10 shadow-2xl space-y-8">
                    <div id="statusMessage" class="hidden mb-6 p-4 border text-center font-bold uppercase tracking-widest text-sm"></div>
                    
                    <div class="space-y-2">
                        <label class="text-[10px] uppercase tracking-widest font-bold text-brand-muted">Name</label>
                        <input type="text" name="name" required class="w-full bg-brand-bg border-b border-white/10 focus:border-brand-gold py-4 px-0 outline-none transition-all text-brand-text">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="text-[10px] uppercase tracking-widest font-bold text-brand-muted">Email</label>
                            <input type="email" name="email" required class="w-full bg-brand-bg border-b border-white/10 focus:border-brand-gold py-4 px-0 outline-none transition-all text-brand-text">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] uppercase tracking-widest font-bold text-brand-muted">Phone</label>
                            <input type="tel" name="phone" class="w-full bg-brand-bg border-b border-white/10 focus:border-brand-gold py-4 px-0 outline-none transition-all text-brand-text">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] uppercase tracking-widest font-bold text-brand-muted">Message</label>
                        <textarea name="message" required rows="4" class="w-full bg-brand-bg border-b border-white/10 focus:border-brand-gold py-4 px-0 outline-none transition-all text-brand-text resize-none"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-brand-gold text-brand-bg py-5 font-bold uppercase tracking-[0.3em] hover:bg-opacity-90 transition-all active:scale-[0.98]">Send Message</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-brand-bg py-20 px-6 md:px-24 border-t border-white/5">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end space-y-12 md:space-y-0">
            <div>
                <a href="#" class="text-4xl font-heading font-black text-brand-gold tracking-tighter mb-6 block">JJ.</a>
                <p class="text-brand-muted max-w-sm mb-8">Premium outdoor advertising across Bengaluru's most strategic corridors. Bold, beautiful, impossible to ignore.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-brand-muted hover:text-brand-gold transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <a href="#" class="text-brand-muted hover:text-brand-gold transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.238 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                    </a>
                </div>
            </div>

            <div class="flex flex-col md:flex-row space-y-8 md:space-y-0 md:space-x-16 items-start md:items-end">
                <div class="flex flex-col space-y-4">
                    <a href="#services" class="text-sm uppercase tracking-widest font-bold hover:text-brand-gold">Services</a>
                    <a href="#about" class="text-sm uppercase tracking-widest font-bold hover:text-brand-gold">About</a>
                    <a href="#locations" class="text-sm uppercase tracking-widest font-bold hover:text-brand-gold">Locations</a>
                    <a href="#contact" class="text-sm uppercase tracking-widest font-bold hover:text-brand-gold">Contact</a>
                </div>
                <div class="text-brand-muted text-[10px] uppercase tracking-widest leading-loose">
                    &copy; 2026 JJ Media House. <br>
                    All rights reserved. <br>
                    Bengaluru, India
                </div>
            </div>
        </div>
    </footer>

    <script type="text/javascript">
        // Sticky Navbar
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('bg-brand-bg/90', 'backdrop-blur-xl', 'py-4', 'border-b', 'border-white/5');
                navbar.classList.remove('py-6', 'bg-transparent');
            } else {
                navbar.classList.remove('bg-brand-bg/90', 'backdrop-blur-xl', 'py-4', 'border-b', 'border-white/5');
                navbar.classList.add('py-6', 'bg-transparent');
            }
        });

        // Mobile Menu
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');
        const mobileLinks = document.querySelectorAll('.mobile-link');

        menuBtn.addEventListener('click', () => {
            const isOpen = mobileMenu.classList.contains('translate-x-0');
            if (isOpen) {
                mobileMenu.classList.remove('translate-x-0');
                mobileMenu.classList.add('translate-x-full');
                menuIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>';
                document.body.style.overflow = 'auto';
            } else {
                mobileMenu.classList.add('translate-x-0');
                mobileMenu.classList.remove('translate-x-full');
                menuIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
                document.body.style.overflow = 'hidden';
            }
        });

        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.remove('translate-x-0');
                mobileMenu.classList.add('translate-x-full');
                menuIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>';
                document.body.style.overflow = 'auto';
            });
        });

        // Reveal on Scroll (Intersection Observer)
        const observerOptions = { threshold: 0.1 };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // Stat Counter Animation
        const statObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const target = parseInt(el.getAttribute('data-target'));
                    let current = 0;
                    const increment = target / 50;
                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= target) {
                            el.innerText = target + (target > 5 ? '+' : '');
                            clearInterval(timer);
                        } else {
                            el.innerText = Math.floor(current);
                        }
                    }, 30);
                    statObserver.unobserve(el);
                }
            });
        });

        document.querySelectorAll('.stat-number').forEach(el => statObserver.observe(el));

        // Form Submission (AJAX simulation with Fetch)
        const contactForm = document.getElementById('contactForm');
        const statusMessage = document.getElementById('statusMessage');

        contactForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(contactForm);
            
            statusMessage.classList.remove('hidden', 'border-red-500/50', 'bg-red-500/10', 'text-red-500', 'border-emerald-500/50', 'bg-emerald-500/10', 'text-emerald-500');
            statusMessage.innerText = "Sending...";
            statusMessage.classList.add('block');

            try {
                const response = await fetch('index.php', {
                    method: 'POST',
                    body: formData,
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                const result = await response.json();

                if (result.status === 'success') {
                    statusMessage.classList.add('border-emerald-500/50', 'bg-emerald-500/10', 'text-emerald-500');
                    statusMessage.innerText = result.message;
                    contactForm.reset();
                } else {
                    statusMessage.classList.add('border-red-500/50', 'bg-red-500/10', 'text-red-500');
                    statusMessage.innerText = result.message;
                }
            } catch (error) {
                statusMessage.classList.add('border-red-500/50', 'bg-red-500/10', 'text-red-500');
                statusMessage.innerText = "An error occurred. Please try again.";
            }
        });
    </script>
</body>
</html>
