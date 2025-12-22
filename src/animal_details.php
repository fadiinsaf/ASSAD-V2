<?php
    session_start();
    if(!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "visiter"){
        header("Location: ../index.html");
        exit();
    }
    require_once __DIR__ . "/../database/database.php";

    if(isset($_GET["id"])){
        $id = (int) $_GET["id"];

        $stmt = $db->prepare("SELECT *, a.name AS animal_name ,h.name AS habitat_name FROM animals a INNER JOIN habitats h ON a.id_habitat = h.id WHERE a.id = ?");
        $stmt->execute([$id]);

        $animal = $stmt -> fetch();
    }
    else{
        header("Location: animal_list.php");
    }
?>

<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Asaad Home</title>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&amp;family=Noto+Sans:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#13ec6d",
                        "background-dark": "#102218",
                        "surface-dark": "#1A2820",
                        "surface-border": "#28392f",
                        "forest": "#0b1a12",
                        "sand": "#e3d5c0",
                        "sand-dark": "#c2b092"
                    },
                    fontFamily: {
                        "sans": ["Noto Sans", "sans-serif"],
                        "display": ["Manrope", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "1rem",
                        "xl": "1.5rem",
                        "2xl": "2rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        body {
            font-family: "Noto Sans", sans-serif;
            background-color: #102218;
            color: #ffffff;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .font-display {
            font-family: "Manrope", sans-serif;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
        <style>
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-background-dark text-sand font-sans min-h-screen flex flex-col">

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

    <main class="flex-grow">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-4">
            
            <div class="flex flex-wrap gap-2 items-center text-sm text-text-muted mb-4">
                <a class="hover:text-primary transition-colors flex items-center gap-1" href="home.php">
                    <span class="material-symbols-outlined text-[16px]">home</span> Home
                </a>
                <span>/</span>
                <a class="hover:text-primary transition-colors" href="animal_list.php">Animals</a>
                <span>/</span>
                <span class="text-primary font-medium"><?= $animal["animal_name"] ?></span>
            </div>
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-6 border-b border-white/5">
                <div>
                    <div class="flex flex-wrap items-center gap-4 mb-2">
                        <h1 class="font-display text-4xl md:text-5xl font-black text-white tracking-tight"><?= $animal["animal_name"] ?>
                        </h1>
                    </div>
                    <p class="text-text-muted text-lg font-medium flex items-center gap-2">
                        <span class="italic"><?= $animal["species"] ?></span>
                        <span class="w-1 h-1 rounded-full bg-primary"></span>
                    </p>
                </div>

                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">

            <div class="flex overflow-x-auto hide-scrollbar gap-6 pb-4 snap-x snap-mandatory">

                <div class="snap-center shrink-0 w-[90%] md:w-[60%] lg:w-[45%] group cursor-pointer">

                    <div class="relative h-[400px] rounded-2xl overflow-hidden border border-white/5">

                        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
                            style="background-image: url('/../assets/images/<?= $animal["image"] ?>');">
                        </div>

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-background-dark/90 via-transparent to-transparent opacity-80 group-hover:opacity-100 transition-opacity">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">

            <div
                class="bg-surface-dark border border-white/5 rounded-2xl p-8 grid grid-cols-2 md:grid-cols-4 gap-8 relative overflow-hidden">

                <div class="text-center relative z-10 group">
                    <div
                        class="w-14 h-14 mx-auto rounded-full bg-background-dark border border-white/10 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-background-dark transition-colors mb-3">
                        <span class="material-symbols-outlined text-2xl">lunch_dining</span>
                    </div>
                    <p class="text-xs text-text-muted uppercase tracking-wider font-bold mb-1">Diet</p>
                    <p class="text-lg font-bold text-white"><?= $animal["diet_type"] ?></p>
                </div>
                <div class="text-center relative z-10 group">
                    <div
                        class="w-14 h-14 mx-auto rounded-full bg-background-dark border border-white/10 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-background-dark transition-colors mb-3">
                        <span class="material-symbols-outlined text-2xl">asterisk</span>
                    </div>
                    <p class="text-xs text-text-muted uppercase tracking-wider font-bold mb-1">Spcies</p>
                    <p class="text-lg font-bold text-white"><?=  $animal["species"] ?></p>
                </div>
                <div class="text-center relative z-10 group">
                    <div
                        class="w-14 h-14 mx-auto rounded-full bg-background-dark border border-white/10 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-background-dark transition-colors mb-3">
                        <span class="material-symbols-outlined text-2xl">place</span>
                    </div>
                    <p class="text-xs text-text-muted uppercase tracking-wider font-bold mb-1">Habitat</p>
                    <p class="text-lg font-bold text-white"><?=  $animal["habitat_name"] ?></p>
                </div>
                <div class="text-center relative z-10 group">
                    <div
                        class="w-14 h-14 mx-auto rounded-full bg-background-dark border border-white/10 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-background-dark transition-colors mb-3">
                        <span class="material-symbols-outlined text-2xl">activity_zone</span>
                    </div>
                    <p class="text-xs text-text-muted uppercase tracking-wider font-bold mb-1">Zoo Zone</p>
                    <p class="text-lg font-bold text-white"><?=  $animal["zoo_zone"] ?></p>
                </div>
            </div>

        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-10">
                    <section>
                        <h3
                            class="text-2xl font-display font-bold text-white mb-6 flex items-center gap-3 border-l-4 border-primary pl-4">
                            <span class="material-symbols-outlined text-primary text-3xl">info</span>
                            About the <?= $animal["animal_name"] ?>
                        </h3>
                        <div class="prose max-w-none text-text-muted leading-relaxed text-lg">
                            <p class="mb-6"><?= $animal["short_description"] ?></p>
                            
                        </div>
                    </section>
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

</body>

</html>