<?php
require_once __DIR__ . "/../database/database.php";
require_once __DIR__ . "/../Models/GuideVisit.php";
require_once __DIR__ . "/../Models/VisitStep.php";
require_once __DIR__ . "/../Models/Comment.php";
require_once __DIR__ . "/../Models/Visitor.php";
require_once __DIR__ . "/../Middlewares/IsAuthed.php";
require_once __DIR__ . "/../Middlewares/IsVisitor.php";
session_start();

IsAuthed::handle();
IsVisitor::handle();

if (isset($_GET["id"])) {
    $id = (int) $_GET["id"];

    $visit = GuideVisit::getVisit($id);

    $steps = VisitStep::getStepsOfVisit($id) ;

    $comments_user = Comment::getUsersComments($id);
} else {
    echo "error";
    header("Location: visit_list.php");
}
?>

<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Visitor: Tour Details / Book Now - ASSAD</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&amp;display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#13ec6d", // Bright Green Accent
                        "primary-hover": "#0fb352",
                        "background": "#001a14", // Deepened significantly (almost black-green)
                        "surface": "#022c22", // Deepened (previous background color)
                        "surface-highlight": "#064e3b", // Deepened (previous surface color)
                        "text-main": "#ecfdf5", // Mint Cream / White
                        "text-muted": "#6ee7b7", // Muted Mint Green
                        "border-color": "#065f46", // Deepened Border
                    },
                    fontFamily: {
                        "display": ["Plus Jakarta Sans", "sans-serif"]
                    },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                },
            },
        }
    </script>

</head>
<style>
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }

    .material-symbols-outlined.fill {
        font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }

    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #001a14;
    }

    ::-webkit-scrollbar-thumb {
        background: #022c22;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #064e3b;
    }
</style>

<body class="bg-background font-display text-text-main antialiased selection:bg-primary selection:text-surface">
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

        <main class="layout-container flex h-full grow flex-col">

            <div class="px-4 md:px-10 lg:px-20 py-8 w-full max-w-7xl mx-auto">

                <div class="flex items-center gap-2 text-sm text-text-muted mb-8">
                    <a class="hover:underline hover:text-primary transition-colors" href="home.php">Home</a>
                    <span class="material-symbols-outlined text-sm">chevron_right</span>
                    <a class="hover:underline hover:text-primary transition-colors" href="visit_list.php">Tours</a>
                    <span class="material-symbols-outlined text-sm">chevron_right</span>
                    <span class="font-bold text-primary"><?= $visit["title"] ?></span>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <div class="lg:col-span-2 flex flex-col gap-8">

                        <div class="group relative rounded-2xl overflow-hidden shadow-2xl border border-border-color">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-background via-surface/40 to-transparent z-10">
                            </div>
                            <div class="bg-cover bg-center h-[450px] w-full transition-transform duration-700 group-hover:scale-105"
                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAc9iNo3AWUO6p1UdAO1YoiYumYyKhl97nWnj6uFUPQaTAef-1z_cGD04HYCz9AQVdgQbcDX7EnMGqj4FB8pRXXdLIiPy-Rl-cSoAM-D0lNQRzAnhxqEIQWJFs1hJH63PI-CrxqM8kItWcTUxXMN35H8fc1M8-Ivm67GKlGaPrQNX4SyrIcAAqj-QVi6E6d2qW-NJ1bAsfedizxLTCXIU3GmJm10z7d1r1b1fzBfE8gGVIgfWPSq00CQwMTb6hEeL7OBkWHsIHcUInU");'>
                            </div>
                            <div class="absolute bottom-0 left-0 w-full p-6 md:p-8 z-20 flex flex-col gap-2">
                                <div class="flex items-center gap-3 mb-1">
                                </div>
                                <h1 class="text-3xl md:text-5xl font-black text-white leading-tight">
                                    <?= $visit["title"] ?> <br /><span class="text-primary">Tour</span>
                                </h1>
                                <p class="text-white/90 text-sm md:text-base max-w-xl font-medium">
                                    <?= $visit["visit_description"] ?>
                                </p>
                                <div class="flex flex-wrap items-center gap-4 mt-2 text-white/90 text-sm font-semibold">
                                    <div class="flex items-center gap-1.5">
                                        <span class="material-symbols-outlined text-primary">schedule</span>
                                        <span><?= $visit["duration"] . " " . "min" ?></span>
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <span class="material-symbols-outlined text-primary">translate</span>
                                        <span><?= $visit["language"] ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- steps -->
                        <div class="bg-surface/30 rounded-2xl p-6 md:p-8 border border-border-color">

                            <h2 class="text-2xl font-bold text-text-main mb-8">Tour Steps</h2>
                            <div class="relative pl-2 md:pl-4 space-y-8">

                                <div class="absolute left-[17px] md:left-[25px] top-3 bottom-8 w-0.5 bg-border-color">
                                </div>

                                <?php

                                foreach ($steps as $step) {
                                    echo "
                                            <div class='relative flex gap-4 md:gap-6 group'>
                                                <div
                                                    class='relative z-10 flex-none size-8 md:size-10 rounded-full bg-surface border-2 border-border-color flex items-center justify-center'>
                                                    <span
                                                        class='material-symbols-outlined text-text-muted text-sm md:text-base'>flag</span>
                                                </div>

                                                <div class='flex flex-col pt-0.5'>
                                                    <h3 class='text-lg md:text-xl font-bold text-text-main'>{$step['title']}
                                                    </h3>
                                                    <p class='text-sm text-text-muted mt-1 leading-relaxed'> {$step['description']} </p>
                                                </div>
                                                
                                            </div>

                                        ";
                                }

                                ?>

                            </div>
                        </div>

                        <!-- rivew -->
                        <div id="reviews">

                            <div class="bg-surface/30 rounded-2xl p-6 border border-border-color">
                                <h3 class="text-xl font-bold mb-4">Add Your Review</h3>

                                <form action="../Controllers/add_comment.php" method="post">
                                    <input type="hidden" name="visit_id" value="<?= $visit['id'] ?>">

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-text-main mb-2">Rating</label>
                                        <select name="rating"
                                            class="w-full px-3 py-2 bg-surface-highlight border border-border-color rounded-lg text-text-main">
                                            <option value="5">★★★★★ (5)</option>
                                            <option value="4">★★★★☆ (4)</option>
                                            <option value="3">★★★☆☆ (3)</option>
                                            <option value="2">★★☆☆☆ (2)</option>
                                            <option value="1">★☆☆☆☆ (1)</option>
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-text-main mb-2">Comment</label>
                                        <textarea name="comment_text" rows="3"
                                            class="w-full px-3 py-2 bg-surface-highlight border border-border-color rounded-lg text-text-main"
                                            required placeholder="Share your experience..."></textarea>
                                    </div>

                                    <button type="submit"
                                        class="w-full bg-primary hover:bg-primary-hover text-surface font-bold py-3 rounded-lg transition-colors">
                                        Submit Review
                                    </button>
                                </form>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">

                                <?php foreach($comments_user as $c) : ?>
                                <?php echo "
                                    <div
                                    class='bg-surface/50 p-6 rounded-2xl border border-border-color hover:bg-surface-highlight/50 transition-colors'>
                                    <div class='flex flex-col justify-between items-start mb-4'>
                                        <div class='flex gap-3'>
                                            <div class='flex justify-between gap-8 items-center'>
                                                <h4 class='font-bold text-text-main text-sm'>{$c['name']}</h4>
                                                        <p
                                                        class='text-[10px] text-text-muted uppercase font-bold tracking-wide'>ON {$c['comment_date']}</p>
                                            </div>
                                        </div>
                                        <div class='flex text-primary text-sm'>
                                ";?>    

                                <?php for($i = 0; $i < (int)$c["rating"];$i++){
                                    echo "
                                        <span class='material-symbols-outlined fill text-[18px]'>star</span>
                                    ";
                                } ?>

                                <?php echo "
                                        </div>
                                    <p class='text-sm text-text-main leading-relaxed'>{$c['comment_text']}</p>
                                </div>
                                ";?>      
                                <?php endforeach; ?> 

                            </div>
                        </div>
                    </div>
                </div>

                    <div class="lg:col-span-1">

                        <div class="sticky top-28 space-y-4">
                            <div class="bg-surface rounded-2xl border border-border-color shadow-2xl overflow-hidden">
                                <div class="p-6 border-b border-border-color bg-surface-highlight/30">
                                    <div class="flex justify-between items-end">
                                        <div>
                                            <p class="text-xs text-text-muted font-bold uppercase tracking-wide mb-1">
                                                Price per connection</p>
                                            <div class="flex items-baseline gap-1">
                                                <span class="text-3xl font-black text-text-main">$15.00</span>
                                                <span class="text-sm text-text-muted font-medium">/ person</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <form action="../Controllers/add_reservation.php" method="post">

                                    <div class="p-6 flex flex-col gap-6">
                                        <div class="space-y-2">
                                            <label
                                                class="text-xs font-bold text-text-main uppercase tracking-wide">Select
                                                Date</label>
                                            <div class="relative">
                                                <div
                                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <span
                                                        class="material-symbols-outlined text-text-muted">calendar_today</span>
                                                </div>
                                                <select required name="start_datetime"
                                                    class="block w-full pl-10 pr-10 py-3 text-sm border border-border-color focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary rounded-xl text-text-main bg-surface-highlight appearance-none cursor-pointer hover:bg-surface-highlight/80 transition-colors">
                                                    <option><?= $visit["start_datetime"] ?></option>
                                                </select>
                                                <div
                                                    class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                    <span
                                                        class="material-symbols-outlined text-text-muted">expand_more</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="space-y-4">
                                            <label
                                                class="text-xs font-bold text-text-main uppercase tracking-wide">members</label>
                                            <input type="number" name="members" required placeholder="1" min="0"
                                                max="10"
                                                class="block w-full pl-10 pr-10 py-3 text-sm border border-border-color focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary rounded-xl text-text-main bg-surface-highlight appearance-none cursor-pointer hover:bg-surface-highlight/80 transition-colors">

                                        </div>
                                        <input type="hidden" name="visit_id" value="<?= $visit["id"]?>">
                                        <button type="submit"
                                            class="w-full bg-primary text-surface font-extrabold text-lg py-4 rounded-xl shadow-lg shadow-primary/20 hover:bg-primary-hover hover:shadow-primary/40 hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2 group">
                                            <span
                                                class="material-symbols-outlined font-bold group-hover:animate-bounce">confirmation_number</span>
                                            Book Now
                                        </button>
                                        <p
                                            class="text-xs text-center text-text-muted flex items-center justify-center gap-1">
                                            <span class="material-symbols-outlined text-sm">verified_user</span>
                                            Secure payment · Free cancellation 24h before
                                        </p>
                                    </div>
                                </form>

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