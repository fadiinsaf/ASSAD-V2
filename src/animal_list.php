<?php 
    session_start();
    if(!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "visiter"){
        header("Location: ../index.html");
        exit();
    }
    require_once __DIR__ . "/../database/database.php";
    $stmt = $db->query("SELECT * ,a.id AS animal_id ,h.name AS habitat_name FROM animals a INNER JOIN habitats h ON a.id_habitat = h.id", PDO::FETCH_ASSOC);
    $animals = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>ASSAD Animals</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&amp;family=Noto+Sans:wght@400;500;700&amp;display=swap"
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
                        "primary-dark": "#0fb854",
                        "background-dark": "#102218",
                        "surface-dark": "#1A2820",
                        "forest": {
                            50: '#EBF7F1',
                            100: '#D6EFE3',
                            200: '#AEE0C7',
                            300: '#85D0AA',
                            400: '#5DB18E',
                            500: '#3D8C6D',
                            600: '#2E6952',
                            700: '#23503E',
                            800: '#1A2820',
                            900: '#102218',
                            950: '#08110C',
                        },
                        "sand": {
                            50: '#FBF9F6',
                            100: '#F5EFE6',
                            200: '#EBDCC6',
                            300: '#D6C0A0',
                        }
                    },
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"],
                        "body": ["Noto Sans", "sans-serif"],
                    },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                },
            },
        }
    </script>

</head>
    <style>
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
<body
    class="bg-background-dark text-sand-50 font-display antialiased selection:bg-primary selection:text-background-dark">
    <div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">

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
                    <a href="../controllers/logout.php"
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

        <main class="flex-grow flex flex-col items-center w-full">

            <div class="w-full bg-background-dark">
                
                <div class="max-w-[1440px] mx-auto px-4 md:px-10 py-6 md:py-10">
                    <div class="relative overflow-hidden rounded-3xl min-h-[400px] md:min-h-[480px] flex flex-col justify-end items-start p-8 md:p-12 bg-cover bg-center shadow-2xl border border-forest-800 group"
                        style='background-image: linear-gradient(180deg, rgba(16,34,24,0) 0%, rgba(16,34,24,0.6) 50%, rgba(16,34,24,0.95) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuASsI6noNlFSU-rA4IHh-XOh3_Ve8rbOgEF3VY70DwcX9QlIGZox2Iw6YyF5NdmMkRszgeUrD4EEjQuFdRSJMiD0P279Ho6RkHesetgqdZZE_nBLXjUAOpTgDrS_nLWjyb7uvKnHwdgkRBpAZfK0JJYtLPZZY8vzukfylKlECT5kL_Ff7HlVeHl8FOBWBjUdnclusFbK6SmhS9GMnlnalU-NO2eWUCqzIQENhAEIxRhaeAohb-1UkfMmQHhuvI-bOQRSQWcHL-NOJ2s");'>
                        <div class="relative z-10 flex flex-col gap-4 max-w-3xl">
                            <div
                                class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/20 border border-primary/30 backdrop-blur-sm w-fit">
                                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                                <span class="text-primary text-xs font-bold uppercase tracking-wider">Live
                                    Exhibits</span>
                            </div>
                            <h1
                                class="text-white text-4xl md:text-5xl lg:text-7xl font-black leading-tight tracking-tight drop-shadow-lg">
                                Kingdom of the <span class="text-primary">Atlas</span>
                            </h1>
                            <p
                                class="text-sand-100 text-base md:text-lg font-medium leading-relaxed max-w-2xl drop-shadow-md opacity-90">
                                Discover the vibrant wildlife of Africa, from the legendary Atlas Lion to the hidden
                                wonders of the deep jungle.
                            </p>
                        </div>
                    </div>

                    <div class="w-full relative -mt-8 z-20 px-2 md:px-0">
                        <div
                            class="bg-surface-dark border border-forest-700 rounded-2xl shadow-xl p-4 md:p-6 flex flex-col gap-6">
                            <div class="w-full">
                                <label class="flex flex-col h-14 w-full group">
                                    <div
                                        class="flex w-full flex-1 items-stretch rounded-xl h-full bg-background-dark border border-forest-700 focus-within:border-primary transition-colors overflow-hidden">
                                        <div
                                            class="text-forest-400 group-focus-within:text-primary flex items-center justify-center pl-4 pr-2 transition-colors">
                                            <span class="material-symbols-outlined text-2xl">search</span>
                                        </div>
                                        <input
                                            class="flex w-full flex-1 resize-none bg-transparent border-none focus:ring-0 text-white placeholder:text-forest-400 px-2 text-base font-normal leading-normal h-full"
                                            placeholder="Find your favorite animal..." value="" />
                                    </div>
                                </label>
                            </div>
                            <div
                                class="flex flex-col lg:flex-row gap-6 justify-between items-start lg:items-center border-t border-forest-800 pt-6">
                                <div
                                    class="flex flex-col sm:flex-row items-start sm:items-center gap-3 w-full lg:w-auto overflow-x-auto pb-2 sm:pb-0 hide-scrollbar">
                                    <span
                                        class="text-xs font-bold text-forest-400 uppercase tracking-wider whitespace-nowrap">Habitat:</span>
                                    <div class="flex gap-2">
                                        <button
                                            class="flex h-9 items-center justify-center gap-x-2 rounded-full bg-primary px-4 transition-transform hover:scale-105 active:scale-95">
                                            <p class="text-background-dark text-sm font-bold whitespace-nowrap">All
                                                Habitats</p>
                                        </button>
                                        <button
                                            class="flex h-9 items-center justify-center gap-x-2 rounded-full bg-background-dark border border-forest-700 px-4 hover:bg-forest-800 hover:border-primary/50 transition-colors">
                                            <p class="text-sand-200 text-sm font-medium whitespace-nowrap">Savannah</p>
                                        </button>
                                        <button
                                            class="flex h-9 items-center justify-center gap-x-2 rounded-full bg-background-dark border border-forest-700 px-4 hover:bg-forest-800 hover:border-primary/50 transition-colors">
                                            <p class="text-sand-200 text-sm font-medium whitespace-nowrap">Rainforest
                                            </p>
                                        </button>
                                        <button
                                            class="flex h-9 items-center justify-center gap-x-2 rounded-full bg-background-dark border border-forest-700 px-4 hover:bg-forest-800 hover:border-primary/50 transition-colors">
                                            <p class="text-sand-200 text-sm font-medium whitespace-nowrap">Desert</p>
                                        </button>
                                    </div>
                                </div>
                                <div
                                    class="flex flex-col sm:flex-row items-start sm:items-center gap-3 w-full lg:w-auto overflow-x-auto pb-2 sm:pb-0 hide-scrollbar">
                                    <span
                                        class="text-xs font-bold text-forest-400 uppercase tracking-wider whitespace-nowrap">Region:</span>
                                    <div class="flex gap-2">
                                        <button
                                            class="flex h-8 items-center justify-center gap-x-2 rounded-lg bg-white/5 border border-white/10 px-3 hover:bg-white/10 transition-colors text-primary">
                                            <p class="text-sm font-medium whitespace-nowrap">All Regions</p>
                                        </button>
                                        <button
                                            class="flex h-8 items-center justify-center gap-x-2 rounded-lg bg-transparent px-3 hover:bg-forest-800 transition-colors text-forest-300 hover:text-white">
                                            <p class="text-sm font-medium whitespace-nowrap">North Africa</p>
                                        </button>
                                        <button
                                            class="flex h-8 items-center justify-center gap-x-2 rounded-lg bg-transparent px-3 hover:bg-forest-800 transition-colors text-forest-300 hover:text-white">
                                            <p class="text-sm font-medium whitespace-nowrap">Sub-Saharan</p>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full py-12 pb-20">

                        <div class="flex justify-between items-end mb-8 border-b border-forest-800 pb-4">
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-1">Featured Wildlife</h3>
                                <p class="text-forest-400 text-sm">Explore our diverse collection of African species.
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                            <?php 
                                foreach($animals as $animal){
                                    echo "
                                    
                                            <div
                                                class='flex flex-col overflow-hidden rounded-2xl bg-surface-dark shadow-lg border border-forest-800 hover:border-primary/50 hover:shadow-[0_0_20px_rgba(19,236,109,0.15)] hover:-translate-y-1 transition-all duration-300 group'>
                                                <div class='relative h-64 w-full overflow-hidden'>
                                                    <div class='absolute top-3 left-3 z-10'>
                                                    </div>
                                                    <div class='h-full w-full bg-cover bg-center transition-transform duration-700 group-hover:scale-110'
                                                        style=\"background-image: url('/../assets/images/{$animal['image']}');\">
                                                    </div>
                                                    <div
                                                        class='absolute inset-0 bg-gradient-to-t from-surface-dark via-transparent to-transparent opacity-80'>
                                                    </div>
                                                </div>
                                                <div class='flex flex-1 flex-col p-5 -mt-12 relative z-10'>
                                                    <div class='flex justify-between items-start mb-2'>
                                                        <div>
                                                            <h3
                                                                class='text-xl font-bold text-white group-hover:text-primary transition-colors'>
                                                                {$animal['name']}</h3>
                                                            <p class='text-xs font-medium text-forest-400 uppercase tracking-wide'>
                                                                {$animal['species']}</p>
                                                        </div>
                                                    </div>
                                                    <div class='mt-2 flex items-center gap-2 text-sm text-sand-200/80 mb-6'>
                                                        <span
                                                            class='material-symbols-outlined text-primary text-[18px]'>location_on</span>
                                                        <span>{$animal['habitat_name']}</span>
                                                    </div>
                                                    <div class='mt-auto'>
                                                        <a href='animal_details.php?id={$animal['animal_id']}'
                                                            class='w-full rounded-xl bg-forest-800 border border-forest-700/50 py-3 text-sm font-bold text-white hover:bg-primary hover:text-background-dark hover:border-transparent transition-all flex items-center justify-center gap-2 group/btn'>
                                                            <span>Learn More</span>
                                                            <span
                                                            class='material-symbols-outlined text-[18px] group-hover/btn:translate-x-1 transition-transform'>arrow_forward</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                    
                                    ";
                                }
                            ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </main>

        <footer class="w-full bg-background-dark border-t border-surface-border relative overflow-hidden">
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
                style="background-image: radial-gradient(#13ec6d 1px, transparent 1px); background-size: 24px 24px;">
            </div>
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

    </div>

</body>

</html>