<?php 
require_once __DIR__ . "/../database/database.php";
require_once __DIR__ . "/../Models/GuideVisit.php";
require_once __DIR__ . "/../Models/Visitor.php";
require_once __DIR__ . "/../Middlewares/IsAuthed.php";
require_once __DIR__ . "/../Middlewares/IsVisitor.php";
session_start();

IsAuthed::handle();
IsVisitor::handle();

$visits = GuideVisit::getAll();
?>

<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Visitor: Guided Tours - ASSAD</title>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&amp;family=Noto+Sans:wght@100..900&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#13ec6d",
                        "primary-dark": "#0ea84d",
                        "background-dark": "#102218",
                        "surface-dark": "#1A2820",
                        "surface-dark-hover": "#223328",
                        "accent-gold": "#eab308",
                        "accent-sand": "#d6cbb6",
                        "border-color": "#28392a",
                    },
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"],
                        "body": ["Noto Sans", "sans-serif"]
                    },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "2xl": "1rem", "full": "9999px" },
                    backgroundImage: {
                        'pattern-overlay': "url(\"data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%2328392a' fill-opacity='0.08'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E\")",
                    }
                },
            },
        }
    </script>
    <style type="text/tailwindcss">
        @layer utilities {
            .no-scrollbar::-webkit-scrollbar {
                display: none;
            }
            .no-scrollbar {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
        }
        body {
            font-family: 'Noto Sans', sans-serif;
            @apply bg-background-dark text-white;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Manrope', sans-serif;
        }
    </style>
</head>

<body
    class="flex flex-col min-h-screen bg-background-dark selection:bg-primary selection:text-background-dark overflow-x-hidden">
   
    <header class="w-full bg-background-dark/90 backdrop-blur-md border-b border-surface-border sticky top-0 z-50">
        <div class="px-4 md:px-10 lg:px-20 py-4 w-full max-w-7xl mx-auto">
            <div class="flex items-center justify-between relative">
                <div class="flex items-center gap-3 cursor-pointer shrink-0 z-10">
                    <div
                        class="size-10 flex items-center justify-center text-primary bg-surface-dark rounded-full border border-surface-border">
                        <span class="material-symbols-outlined text-2xl">pets</span>
                    </div>
                    <h2 class="text-xl font-bold font-display tracking-tight text-white">ASSAD</h2>
                </div>
                <nav
                    class="hidden md:flex items-center gap-8 absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
                    <a class="text-sm font-semibold text-white hover:text-primary transition-colors"
                        href="home.php">Home</a>
                    <a class="text-sm font-medium text-gray-300 hover:text-primary transition-colors"
                        href="animal_list.php">Animals</a>
                    <a class="text-sm font-medium text-gray-300 hover:text-primary transition-colors"
                        href="visit_list.php">Tours</a>
                </nav>
                <div class="hidden md:flex items-center shrink-0 z-10">
                    <a href="../Controllers/logout.php"
                        class="flex items-center justify-center rounded-full h-11 px-6 bg-primary hover:bg-[#0fd660] transition-all text-background-dark text-sm font-bold font-display shadow-[0_0_15px_rgba(19,236,109,0.2)] hover:shadow-[0_0_20px_rgba(19,236,109,0.4)]">
                       Log out
                    </a>
                </div>
                <div class="md:hidden text-white flex items-center">
                    <span class="material-symbols-outlined text-3xl">menu</span>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow flex flex-col items-center w-full bg-pattern-overlay bg-fixed">



        <div class="w-full max-w-7xl px-4 md:px-10 lg:px-20 pb-20">
            <div class="flex justify-between items-end mb-8">
                <h3 class="text-white text-2xl font-bold font-display mt-10">Available Tours <span
                        class="text-gray-500 font-normal ml-2 text-lg">(<?=  count($visits) ?>)</span></h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <?php

                foreach($visits as $visit){
                $date_time = explode(" ",$visit["start_datetime"]);
                echo "
                        <div class='group flex flex-col bg-surface-dark hover:bg-surface-dark-hover rounded-2xl overflow-hidden border border-white/5 hover:border-primary/50 transition-all duration-300 shadow-lg hover:shadow-2xl hover:shadow-primary/5'>

                            <div class='relative h-56 w-full overflow-hidden'>
                                
                                <img alt='image'
                                    class='w-full h-full object-cover transition-transform duration-500 group-hover:scale-110' src='/../assets/images/channels4_profile.jpg' />
                                <div
                                    class='absolute inset-0 bg-gradient-to-t from-surface-dark via-transparent to-transparent opacity-60'>
                                </div>
                            </div>
                            <div class='flex flex-col flex-1 p-6'>
                                <div class='flex justify-between items-start mb-3'>
                                    <h4
                                        class='text-white text-xl font-bold leading-tight group-hover:text-primary transition-colors font-display'>{$visit['title']}</h4>
                                </div>
                                <p class='text-accent-sand/70 text-sm mb-5 line-clamp-2'>{$visit['description']}</p>
                                <div class='grid grid-cols-2 gap-y-3 gap-x-2 mb-6 text-sm text-gray-300'>
                                    <div class='flex items-center gap-2'>
                                        <span class='material-symbols-outlined text-primary text-[18px]'>calendar_month</span>
                                        {$date_time[0]}
                                    </div>
                                    <div class='flex items-center gap-2'>
                                        <span class='material-symbols-outlined text-primary text-[18px]'>schedule</span>
                                        {$date_time[1]}
                                    </div>
                                    <div class='flex items-center gap-2'>
                                        <span class='material-symbols-outlined text-primary text-[18px]'>translate</span>
                                        {$visit['language']}
                                    </div>
                                    <div class='flex items-center gap-2'>
                                        <span class='material-symbols-outlined text-primary text-[18px]'>timer</span>
                                        {$visit['duration']} min
                                    </div>
                                </div>
                                <div class='mt-auto pt-4 border-t border-white/5'>
                                    <div class='flex items-center justify-between gap-4'>
                                        <div class='flex flex-col'>
                                            <span class='text-xs text-gray-400 mb-0.5'>Per Person</span>
                                            <span class='text-2xl font-bold text-accent-gold'>\${$visit['price']}</span>
                                        </div>
                                        <a href='visit_details.php?id={$visit['id']}'
                                            class='flex-1 bg-white hover:bg-gray-100 text-background-dark font-bold py-3 px-4 rounded-xl transition-colors text-center text-sm'>
                                            Book Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ";

                }
            ?>


                

            </div>
        </div>
    </main>
    <footer class="w-full bg-background-dark border-t border-surface-border relative overflow-hidden">
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
            style="background-image: radial-gradient(#13ec6d 1px, transparent 1px); background-size: 24px 24px;"></div>
        <div class="flex justify-center w-full relative z-10">
            <div class="px-4 md:px-10 lg:px-20 py-16 w-full max-w-7xl">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                    <div class="col-span-1">
                        <div class="flex items-center gap-3 mb-6 text-white">
                            <div
                                class="size-8 flex items-center justify-center text-primary bg-surface-dark rounded-full border border-surface-border">
                                <span class="material-symbols-outlined text-xl">pets</span>
                            </div>
                            <h3 class="text-2xl font-bold font-display">ASSAD</h3>
                        </div>
                        <p class="text-gray-400 text-sm mb-8 leading-relaxed font-light">
                            Bringing the wild to your world. We are dedicated to the conservation of North African
                            wildlife and educational outreach.
                        </p>
                        <div
                            class="inline-flex items-center gap-4 p-4 rounded-xl bg-surface-dark border border-surface-border/50 hover:border-surface-border transition-colors cursor-default">
                            <div
                                class="size-10 rounded-full bg-red-700 flex items-center justify-center text-white font-bold shadow-lg ring-2 ring-red-900">
                                <span class="material-symbols-outlined text-xl">sports_soccer</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-[10px] text-sand font-bold uppercase tracking-widest mb-0.5">Proud
                                    Host</span>
                                <span class="text-sm font-bold text-white">CAN 2025 Morocco</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-white font-bold mb-6 font-display text-lg">Discover</h4>
                        <ul class="flex flex-col gap-4 text-sm text-gray-400 font-light">
                            <li><a class="hover:text-primary transition-colors flex items-center gap-2 group"
                                    href="#"><span
                                        class="w-1 h-1 rounded-full bg-primary opacity-0 group-hover:opacity-100 transition-opacity"></span>
                                    Animals A-Z</a></li>
                            <li><a class="hover:text-primary transition-colors flex items-center gap-2 group"
                                    href="#"><span
                                        class="w-1 h-1 rounded-full bg-primary opacity-0 group-hover:opacity-100 transition-opacity"></span>
                                    Live Cams</a></li>
                            <li><a class="hover:text-primary transition-colors flex items-center gap-2 group"
                                    href="#"><span
                                        class="w-1 h-1 rounded-full bg-primary opacity-0 group-hover:opacity-100 transition-opacity"></span>
                                    Virtual Tours</a></li>
                            <li><a class="hover:text-primary transition-colors flex items-center gap-2 group"
                                    href="#"><span
                                        class="w-1 h-1 rounded-full bg-primary opacity-0 group-hover:opacity-100 transition-opacity"></span>
                                    Interactive Map</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-bold mb-6 font-display text-lg">Support</h4>
                        <ul class="flex flex-col gap-4 text-sm text-gray-400 font-light">
                            <li><a class="hover:text-primary transition-colors flex items-center gap-2 group"
                                    href="#"><span
                                        class="w-1 h-1 rounded-full bg-primary opacity-0 group-hover:opacity-100 transition-opacity"></span>
                                    Donate</a></li>
                            <li><a class="hover:text-primary transition-colors flex items-center gap-2 group"
                                    href="#"><span
                                        class="w-1 h-1 rounded-full bg-primary opacity-0 group-hover:opacity-100 transition-opacity"></span>
                                    Adopt an Animal</a></li>
                            <li><a class="hover:text-primary transition-colors flex items-center gap-2 group"
                                    href="#"><span
                                        class="w-1 h-1 rounded-full bg-primary opacity-0 group-hover:opacity-100 transition-opacity"></span>
                                    Membership</a></li>
                            <li><a class="hover:text-primary transition-colors flex items-center gap-2 group"
                                    href="#"><span
                                        class="w-1 h-1 rounded-full bg-primary opacity-0 group-hover:opacity-100 transition-opacity"></span>
                                    Volunteer</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-bold mb-6 font-display text-lg">Stay Connected</h4>
                        <p class="text-gray-400 text-sm mb-4 font-light">Subscribe to our newsletter for updates and
                            exclusive content.</p>
                        <div class="flex gap-2 mb-6">
                            <input
                                class="bg-surface-dark border border-surface-border rounded-lg px-4 py-2.5 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary w-full transition-all"
                                placeholder="Email address" type="email" />
                            <button
                                class="bg-primary text-background-dark p-2.5 rounded-lg flex items-center justify-center hover:bg-opacity-90 hover:scale-105 transition-transform">
                                <span class="material-symbols-outlined text-xl">arrow_forward</span>
                            </button>
                        </div>
                        <div class="flex gap-4">
                            <a class="size-10 rounded-full bg-surface-dark flex items-center justify-center text-gray-400 hover:text-white hover:bg-surface-border transition-colors border border-surface-border"
                                href="#">
                                <span class="material-symbols-outlined text-lg">thumb_up</span>
                            </a>
                            <a class="size-10 rounded-full bg-surface-dark flex items-center justify-center text-gray-400 hover:text-white hover:bg-surface-border transition-colors border border-surface-border"
                                href="#">
                                <span class="material-symbols-outlined text-lg">photo_camera</span>
                            </a>
                            <a class="size-10 rounded-full bg-surface-dark flex items-center justify-center text-gray-400 hover:text-white hover:bg-surface-border transition-colors border border-surface-border"
                                href="#">
                                <span class="material-symbols-outlined text-lg">smart_display</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div
                    class="border-t border-surface-border pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-gray-500 font-medium">
                    <p>© 2024 ASSAD Virtual Zoo. All rights reserved.</p>
                    <div class="flex gap-8">
                        <a class="hover:text-primary transition-colors" href="#">Privacy Policy</a>
                        <a class="hover:text-primary transition-colors" href="#">Terms of Service</a>
                        <a class="hover:text-primary transition-colors" href="#">Cookie Settings</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>