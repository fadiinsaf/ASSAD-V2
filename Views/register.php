<?php 
session_start();
?>

<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>ASSAD - User Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Spline+Sans:wght@300;400;500;600;700&amp;display=swap"
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
                        "background-light": "#f6f8f7",
                        "background-dark": "#102218",
                        "surface-dark": "#1a2c22",
                    },
                    fontFamily: {
                        "display": ["Spline Sans", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "1rem",
                        "lg": "2rem",
                        "xl": "3rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        .moroccan-pattern {
            background-image: radial-gradient(#13ec6d 0.5px, transparent 0.5px), radial-gradient(#13ec6d 0.5px, #102218 0.5px);
            background-size: 20px 20px;
            background-position: 0 0, 10px 10px;
            opacity: 0.03;
        }
    </style>
</head>

<body
    class="bg-background-light dark:bg-background-dark font-display min-h-screen flex flex-col text-slate-900 dark:text-white transition-colors duration-200">
    <main class="flex-grow flex flex-col lg:flex-row h-full">
        <div class="hidden lg:flex w-1/2 relative bg-surface-dark overflow-hidden flex-col justify-end p-12">
            <div class="absolute inset-0 bg-cover bg-center opacity-80 mix-blend-overlay"
                data-alt="Majestic lion face in dark moody lighting"
                style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAEDOAhYgIXdUXjhR7RXw063faBxnAdkDeUNMR1JF_T6chxM0_pArabwfAfQtRbfhb09eDZW1KDx5G9Fmdgrw7Y_Dhz3RawiZQhOudgz474tL6TxcZBeVmD25qdbAu0JyBCEE6nf4Dx8ACPwrYrstK5IPSkKNifbwO6bqzlFKMxOe49dqj6QHNxFPTY75uvJOi8Dbras-2rTGJ2vVhxCoJSxr4Ou7wznX8XcXNxzZTp16D8o4x3v1FUcgfFGdHbHVygVE-JW_k-S__9');">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-background-dark via-background-dark/50 to-transparent">
            </div>
            <div class="relative z-10 max-w-lg">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/20 border border-primary/30 text-primary text-xs font-bold uppercase tracking-wider mb-6">
                    <span class="material-symbols-outlined text-sm">stadium</span>
                    Official Wildlife Partner
                </div>
                <h1 class="text-4xl lg:text-5xl font-bold text-white leading-tight mb-4">
                    Protect the Legacy. <br /> <span class="text-primary">Join the Pride.</span>
                </h1>
                <p class="text-gray-300 text-lg mb-8">
                    Discover the roar of the Atlas Lion. Experience exclusive virtual tours, support conservation, and
                    connect with nature from your home.
                </p>
                <div class="flex items-center gap-4 p-4 rounded-xl bg-white/5 backdrop-blur-sm border border-white/10">
                    <div class="flex -space-x-3">
                        <img alt="User avatar"
                            class="w-10 h-10 rounded-full border-2 border-background-dark object-cover"
                            data-alt="Portrait of a smiling young man"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuA6CvjBJKKOZ-9w7Z8H5QnWswKOiw3FsysQh6MH8p6-Qyo_8dotPHAyFA87fFdI4bYLZXZuNL6S1r1bnEEHWVK9iZOFACOGCgCb8a7hRPFhxUuscgLbbuHAEH6CScvMIEMIsCJhYl8fiQJ0nOXMwh0VbN8LTG-264YG6MqWtuo3ApkkI1PH1yctm9UsZjh5Jv8yurGb4VBbqMcF14YX0eYvcuZIUm2ecKJDPY2hgXZosL5068zA7lv_y_kJNTZMj84bpb0yYY3vNKa1" />
                        <img alt="User avatar"
                            class="w-10 h-10 rounded-full border-2 border-background-dark object-cover"
                            data-alt="Portrait of a smiling young woman"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuC2bhfHbIbZFVpUS-Mtg9rThWZyzvRR_MjP2yCGjJ_DlpMZOBV5PzOzlubUBD7iz8-7n3ujJSiz8qNp8xZ_6pm8AdsNClS0PP6NoBVl25XMTC1zcYq3s-NDRrWbDMMkgvtSMGOidSH03yWRGt99FtTFTG5tClPafjKq0C5nvBaPVehavWHoEWV-bJMw2vcLFnU_uznS4yVS2hS_pLkclt51b-1eh5DhZw3v-gANqy5Iwy5ZzfkDG3eINog4TFDZRYcBETzvhysxDuoi" />
                        <img alt="User avatar"
                            class="w-10 h-10 rounded-full border-2 border-background-dark object-cover"
                            data-alt="Portrait of a man with glasses"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAsTOzAFN-OVMrYNfuO8ZQQDcqwmukUzuKRf048Res2PyCpvxjX81NvDDHuFM87cuYEw87dNfEWxPyM2aG4ZMYaLPYAEcTcD-ZC7iSlsOYkShb-_oeJyIX6BfoalykbkQfO_vBL0icE_3Um6rA0wLxElpnxkFD47EbxXO2CBbSXNVgjoaO7p8YG89i1ttM90-gtT-fp7p-H5mHO7oZS_AH6T2M7-vsCHElLBflVQrqsX7MnBKow8SIesrhCn_vTX4CgJk1dh8CPYSxt" />
                    </div>
                    <div class="text-sm">
                        <p class="text-white font-medium">Join 12,000+ Football &amp; Nature Fans</p>
                        <p class="text-primary text-xs">Supporting Moroccan Wildlife</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full lg:w-1/2 relative flex items-center justify-center p-6 sm:p-12 lg:p-20">
            <div class="absolute inset-0 moroccan-pattern pointer-events-none"></div>
            <div class="w-full max-w-md relative z-10">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-2">Create Account</h2>
                    <p class="text-slate-500 dark:text-gray-400">Choose your path below to begin your expedition.</p>
                </div>

                <form action="../Controllers/add_user.php" method="post" class="space-y-6">

                    <div class="grid grid-cols-2 gap-4">

                        <label class="relative cursor-pointer group">
                            <input checked  class="peer sr-only" name="role" type="radio" value="visiter" />
                            <div
                                class="p-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-surface-dark peer-checked:border-primary peer-checked:bg-primary/10 transition-all hover:border-primary/50">
                                <div
                                    class="mb-2 w-8 h-8 rounded-full bg-gray-100 dark:bg-white/10 flex items-center justify-center text-slate-900 dark:text-white peer-checked:bg-primary peer-checked:text-background-dark">
                                    <span class="material-symbols-outlined">visibility</span>
                                </div>
                                <h3 class="font-bold text-sm text-slate-900 dark:text-white">Visiter</h3>
                                <p class="text-xs text-slate-500 dark:text-gray-400 mt-1">Explore tours &amp; content
                                </p>
                            </div>
                        </label>

                        <label class="relative cursor-pointer group">
                            <input class="peer sr-only" name="role" type="radio" value="guide" />
                            <div
                                class="p-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-surface-dark peer-checked:border-primary peer-checked:bg-primary/10 transition-all hover:border-primary/50">
                                <div
                                    class="mb-2 w-8 h-8 rounded-full bg-gray-100 dark:bg-white/10 flex items-center justify-center text-slate-900 dark:text-white peer-checked:bg-primary peer-checked:text-background-dark">
                                    <span class="material-symbols-outlined">explore</span>
                                </div>
                                <h3 class="font-bold text-sm text-slate-900 dark:text-white">Guide</h3>
                                <p class="text-xs text-slate-500 dark:text-gray-400 mt-1">Host &amp; share expertise</p>
                            </div>
                        </label>

                    </div>

                    <div class="space-y-4">

                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-gray-300 mb-1.5"
                                for="fullname">Full Name</label>
                            <div class="relative">
                                <span
                                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">person</span>
                                <input
                                    class="w-full pl-11 pr-4 py-3 bg-gray-50 dark:bg-surface-dark border border-gray-200 dark:border-gray-700 rounded-full focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all text-slate-900 dark:text-white placeholder-gray-400"
                                    id="fullname" name="name" placeholder="e.g. Youssef Amrani" type="text" />

                            </div>
                            <?php if(isset($_SESSION['errors']['fields'])): ?>
                                    <div class="text-red-500 text-sm mt-1">
                                        <?php echo htmlspecialchars($_SESSION['errors']['fields']); ?>
                                    </div>
                            <?php elseif(isset($_SESSION['errors']['name'])): ?>
                                    <div class="text-red-500 text-sm mt-1">
                                        <?php echo htmlspecialchars($_SESSION['errors']['name']); ?>
                                    </div>
                            <?php else: ?>
                                    <?=""?>
                            <?php endif; ?>

                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-gray-300 mb-1.5"
                                for="email">Email Address</label>
                            <div class="relative">
                                <span
                                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">mail</span>
                                <input
                                    class="w-full pl-11 pr-4 py-3 bg-gray-50 dark:bg-surface-dark border border-gray-200 dark:border-gray-700 rounded-full focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all text-slate-900 dark:text-white placeholder-gray-400"
                                    id="email" placeholder="name@example.com" name="email" type="email" />
                            </div>
                            <?php if(isset($_SESSION['errors']['fields'])): ?>
                                    <div class="text-red-500 text-sm mt-1">
                                        <?php echo htmlspecialchars($_SESSION['errors']['fields']); ?>
                                    </div>
                            <?php elseif(isset($_SESSION['errors']['email'])): ?>

                                    <div class="text-red-500 text-sm mt-1">
                                        <?php echo htmlspecialchars($_SESSION['errors']['email']); ?>
                                    </div>

                            <?php elseif(isset($_SESSION['errors']['email_exists'])): ?>

                                    <div class="text-red-500 text-sm mt-1">
                                        <?php echo htmlspecialchars($_SESSION['errors']['email_exists']); ?>
                                    </div>

                            <?php else: ?>

                                    <?=""?>

                            <?php endif; ?>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-gray-300 mb-1.5"
                                    for="password">Password</label>
                                <div class="relative">
                                    <span
                                        class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">lock</span>
                                    <input
                                        class="w-full pl-11 pr-4 py-3 bg-gray-50 dark:bg-surface-dark border border-gray-200 dark:border-gray-700 rounded-full focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all text-slate-900 dark:text-white placeholder-gray-400"
                                        id="password" name="password" placeholder="••••••••" type="password" />
                                </div>

                                <?php if(isset($_SESSION['errors']['password_length'])): ?>

                                        <div class="text-red-500 text-sm mt-1">
                                            <?php echo htmlspecialchars($_SESSION['errors']['password_length']); ?>
                                        </div>
                                <?php elseif(isset($_SESSION['errors']['fields'])): ?>
                                        <div class="text-red-500 text-sm mt-1">
                                            <?php echo htmlspecialchars($_SESSION['errors']['fields']); ?>
                                        </div>
                                <?php elseif(isset($_SESSION['errors']['passwords_match'])): ?>

                                        <div class="text-red-500 text-sm mt-1">
                                            <?php echo htmlspecialchars($_SESSION['errors']['passwords_match']); ?>
                                        </div>


                                <?php elseif(isset($_SESSION['errors']['password'])): ?>

                                        <div class="text-red-500 text-sm mt-1">
                                            <?php echo htmlspecialchars($_SESSION['errors']['password']); ?>
                                        </div>
                                <?php elseif(isset($_SESSION['errors']['fields'])): ?>
                                        <div class="text-red-500 text-sm mt-1">
                                            <?php echo htmlspecialchars($_SESSION['errors']['fields']); ?>
                                        </div>
                                <?php else: ?>

                                        <?=""?>

                                <?php endif; ?>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-gray-300 mb-1.5"
                                    for="confirm_password">Confirm Password</label>
                                <div class="relative">
                                    <span
                                        class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">lock_reset</span>
                                    <input
                                        class="w-full pl-11 pr-4 py-3 bg-gray-50 dark:bg-surface-dark border border-gray-200 dark:border-gray-700 rounded-full focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all text-slate-900 dark:text-white placeholder-gray-400"
                                        id="confirm_password" name="confirm_password" placeholder="••••••••" type="password" />
                                </div>

                                <?php if(isset($_SESSION['errors']['password_length'])): ?>

                                        <div class="text-red-500 text-sm mt-1">
                                            <?php echo htmlspecialchars($_SESSION['errors']['password_length']); ?>
                                        </div>

                                <?php elseif(isset($_SESSION['errors']['passwords_match'])): ?>

                                        <div class="text-red-500 text-sm mt-1">
                                            <?php echo htmlspecialchars($_SESSION['errors']['passwords_match']); ?>
                                        </div>
                                <?php elseif(isset($_SESSION['errors']['fields'])): ?>
                                        <div class="text-red-500 text-sm mt-1">
                                            <?php echo htmlspecialchars($_SESSION['errors']['fields']); ?>
                                        </div>

                                <?php elseif(isset($_SESSION['errors']['password'])): ?>

                                        <div class="text-red-500 text-sm mt-1">
                                            <?php echo htmlspecialchars($_SESSION['errors']['password']); ?>
                                        </div>

                                <?php else: ?>

                                        <?=""?>

                                <?php endif; ?>

                            </div>

                        </div>

                    </div>

                    <div class="flex items-center gap-3 py-1">
                        <input
                            class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-primary focus:ring-primary bg-gray-50 dark:bg-surface-dark"
                            id="terms" value="1" name="accept_terms" type="checkbox" />
                        <label class="text-sm text-slate-600 dark:text-gray-400" for="terms">
                            I agree to the <a class="text-primary hover:underline" href="#">Terms of Service</a> and <a
                                class="text-primary hover:underline" href="#">Privacy Policy</a>.
                        </label>
                        <?php if(isset($_SESSION['errors']['accept_terms'])): ?>
                                    <div class="text-red-500 text-sm mt-1">
                                        <?php echo htmlspecialchars($_SESSION['errors']['accept_terms']); ?>
                                    </div>
                            <?php elseif(isset($_SESSION['errors']['database'])): ?>
                                <div class="text-red-500 text-sm mt-1">
                                    <?php echo htmlspecialchars($_SESSION['errors']['database']); ?>
                                </div>
                            <?php else: ?>
                                    <?=""?>
                            <?php endif; ?>
                    </div>

                    <button
                        class="w-full flex items-center justify-center gap-2 bg-primary hover:bg-[#0fd660] text-background-dark font-bold py-3.5 px-6 rounded-full transition-transform transform hover:scale-[1.01] active:scale-[0.98]"
                        type="submit">
                        <span>Join the Pride</span>
                        <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                    </button>

                    <div class="text-center pt-2">
                        <p class="text-sm text-slate-600 dark:text-gray-400">Are you a member? <a
                                class="text-primary font-bold hover:underline" href="/../index.php">Login</a></p>
                    </div>

                </form>

            </div>
        </div>
    </main>

</body>

</html>

<?php
unset($_SESSION['errors']);
?>