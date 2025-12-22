<?php 
    session_start();
    if(!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "guide"){
    header("Location: ../index.html");
    exit();
    }
?>

<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="refresh" content="15; url=../index.php" />
    <title>Guide Approval Pending - ASSAD Virtual Zoo</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&amp;family=Noto+Sans:wght@400;500;700&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
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
                        "primary": "#13ec13",
                        "background-light": "#f6f8f6",
                        "background-dark": "#102210",
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

<body class="overflow-hidden">

    <header class="sticky top-0 z-50 bg-white dark:bg-[#1a2e1a] border-b border-[#e5e7eb] dark:border-[#283928] px-4 py-3">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center gap-3">
            </div>
            
            <a href="../logout.php" 
               class="flex items-center gap-2 px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors">
                <span class="material-symbols-outlined !text-lg">logout</span>
                <span>Logout</span>
            </a>
        </div>
    </header>

    <div
        class="relative flex h-auto min-h-screen w-full flex-col bg-background-light dark:bg-background-dark group/design-root overflow-x-hidden font-display transition-colors duration-300">
        <div class="layout-container flex h-full grow flex-col">
            <!-- Main Content Area -->
            <div class="flex flex-1 justify-center py-10 px-4 md:px-40">
                <div class="layout-content-container flex flex-col w-full max-w-[960px] flex-1 justify-center">
                    <!-- Pending Status Card -->
                    <div class="flex flex-col items-center justify-center gap-8 py-10">
                        <div
                            class="w-full max-w-[580px] rounded-xl bg-white dark:bg-[#1a2e1a] border border-[#e5e7eb] dark:border-[#283928] shadow-lg p-8 md:p-12 relative overflow-hidden">
                            <!-- Decorative background accent -->
                            <div
                                class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full blur-3xl -mr-10 -mt-10 pointer-events-none">
                            </div>
                            <div
                                class="absolute bottom-0 left-0 w-24 h-24 bg-primary/5 rounded-full blur-2xl -ml-8 -mb-8 pointer-events-none">
                            </div>
                            <div class="flex flex-col items-center gap-6 relative z-10">
                                <!-- Status Icon -->
                                <div
                                    class="size-20 rounded-full bg-primary/10 flex items-center justify-center animate-pulse">
                                    <span class="material-symbols-outlined text-primary !text-5xl">hourglass_top</span>
                                </div>
                                <div class="flex flex-col items-center gap-4 text-center">
                                    <h1
                                        class="text-[#111811] dark:text-white text-2xl md:text-3xl font-bold leading-tight tracking-tight">
                                        Your Guide Account is Pending
                                    </h1>
                                    <div
                                        class="text-[#637563] dark:text-[#aab3aa] text-base font-normal leading-relaxed max-w-[480px]">
                                        <p class="mb-4">
                                            Thank you for registering as a Guide for the ASSAD Zoo. To ensure
                                            the quality of our tours, all Guide accounts require manual verification by
                                            an administrator.
                                        </p>
                                        <div
                                            class="flex items-center justify-center gap-2 text-sm font-medium text-[#111811] dark:text-white bg-primary/10 py-2 px-4 rounded-lg inline-flex">
                                            <span
                                                class="material-symbols-outlined !text-lg text-primary">schedule</span>
                                            <span>Typical review time: 24-48 hours</span>
                                        </div>
                                    </div>
                                </div>
            </div>            
        </div>
    </div>
</body>
</html>