<?php 
require_once __DIR__ . "/../database/database.php";
require_once __DIR__ . "/../Models/GuideVisit.php";
require_once __DIR__ . "/../Models/Guide.php";
require_once __DIR__ . "/../Middlewares/IsAuthed.php";
require_once __DIR__ . "/../Middlewares/IsGuide.php";
session_start();

IsAuthed::handle();
IsGuide::handle();

$visits = GuideVisit::getGuideVisits($_SESSION["user"]->getUserId());
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ASSAD – Tour Builder</title>

  <!-- Fonts & Icons -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&family=Noto+Sans:wght@400;500;700&display=swap"
    rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#1f7a5a',      /* green – same spirit as other pages */
            page: '#f3f7f5',
            card: '#ffffff',
            border: '#d1e3dc',
            input: '#eef5f2',
            textMain: '#1f2933',
            textBody: '#4b5563'
          },
          fontFamily: {
            display: ['Plus Jakarta Sans', 'sans-serif'],
            body: ['Noto Sans', 'sans-serif']
          }
        }
      }
    }
  </script>
</head>

<body class="bg-page font-display text-textMain min-h-screen">

  <!-- TOP BAR -->
  <div class="w-full bg-card border-b border-border">
    <div class="container mx-auto px-4 lg:px-10 xl:px-32 py-4 flex justify-between items-center">
      <h2 class="text-lg font-bold">ASSAD – Guide Dashboard</h2>
      <a href="../Controllers/logout.php" class="flex items-center gap-2 text-sm font-bold text-red-600 hover:text-red-800">
        <span class="material-symbols-outlined text-base">logout</span>
        Logout
      </a>
    </div>
  </div>

  <main class="container mx-auto px-4 lg:px-10 xl:px-32 py-10">

    <!-- TITLE -->
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10">
      <div>
        <h1 class="text-3xl md:text-4xl font-extrabold">Create / Show Tours</h1>
        <p class="text-textBody mt-2 max-w-2xl">
          Build your guided tour and manage steps dynamically.
        </p>
      </div>
    </div>

    <!-- MY TOURS SECTION -->
    <section class="bg-card border border-border rounded-xl p-6 shadow-sm mb-10">
      <h2 class="text-xl font-bold mb-4">My Tours</h2>

      <?php

        foreach($visits as $visit){
          echo "
                <div class='space-y-3'>
                  <div class='flex items-center justify-between p-4 rounded-lg bg-input border border-border'>
                    <div>
                      <h3 class='font-bold'>{$visit['title']}</h3>
                      <p class='text-sm text-textBody'>{$visit['start_datetime']}.{$visit['language']}.$ {$visit['price']}</p>
                    </div>
                    <div class='flex gap-2'>
                      <button class='px-3 py-1 text-sm rounded-lg bg-primary text-white'>Show Information</button>
                    </div> 
                  </div>
          ";
        }

        ?>
    </section>

    <!-- TOUR FORM -->
    <form action="../Controllers/add_tour.php" method="POST" class="bg-card border border-border rounded-xl p-6 shadow-sm">
      <h2 class="text-xl font-bold mb-4">Create Tours</h2>
      <!-- BASIC INFO -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="md:col-span-2">
          <label class="block text-sm font-medium text-textBody mb-2">Tour title</label>
          <input name="tour_title" type="text" placeholder="Atlas Lion Feeding Session"
            class="w-full bg-input border border-border rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary outline-none" />
        </div>

        <div>
          <label class="block text-sm font-medium text-textBody mb-2">Date</label>
          <input name="tour_date" type="date"
            class="w-full bg-input border border-border rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary outline-none" />
        </div>

        <div>
          <label class="block text-sm font-medium text-textBody mb-2">Language</label>
          <select name="tour_lang" class="w-full bg-input border border-border rounded-lg px-4 py-3">
            <option>English</option>
            <option>Arabic</option>
            <option>French</option>
          </select>
        </div>

        <div>
          <label class="block text-sm font-medium text-textBody mb-2">Max capacity</label>
          <input name="tour_cap" type="number" placeholder="20"
            class="w-full bg-input border border-border rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary outline-none" />
        </div>

        <div>
          <label class="block text-sm font-medium text-textBody mb-2">Price ($)</label>
          <input name="tour_price" type="number" placeholder="15"
            class="w-full bg-input border border-border rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary outline-none" />
        </div>

        <div class="md:col-span-2">
          <label class="block text-sm font-medium text-textBody mb-2">Tour Duration</label>
          <input name="tour_duration" type="number" placeholder="Atlas Lion Feeding Session"
            class="w-full bg-input border border-border rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary outline-none" />
        </div>

        <div class="md:col-span-2">
          <label class="block text-sm font-medium text-textBody mb-2">Description</label>
          <textarea name="tour_desc" rows="3"
            class="w-full bg-input border border-border rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary outline-none resize-none"
            placeholder="Describe the tour experience..."></textarea>
        </div>
      </div>

      <hr class="border-border mb-8" />

      <!-- TOUR STEPS -->
      <div class="mb-4 flex items-center justify-between">
        <h2 class="text-xl font-bold">Tour Steps</h2>
        <button type="button" id="addStepBtn"
          class="flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg text-sm font-bold hover:opacity-90">
          <span class="material-symbols-outlined">add</span>
          Add step
        </button>
      </div>

      <div id="stepsContainer" class="space-y-4"></div>

      <!-- ACTIONS -->
      <div class="mt-10 flex justify-end gap-4">
        <button type="button" class="px-6 py-3 rounded-lg bg-input text-sm font-bold hover:bg-border">
          Preview
        </button>
        <button type="submit" class="px-6 py-3 rounded-lg bg-primary text-white text-sm font-bold hover:opacity-90">
          Save Tour
        </button>
      </div>

    </form>

  </main>

  <!-- JS: DYNAMIC STEPS -->
  <script>
    const stepsContainer = document.getElementById('stepsContainer');
    const addStepBtn = document.getElementById('addStepBtn');
    let stepIndex = 0;

    function createStep() {
      stepIndex++;

      const step = document.createElement('div');
      step.className = 'border border-border rounded-lg p-4 bg-input';

      step.innerHTML = `
        <div class="flex justify-between items-center mb-4">
          <h3 class="font-bold">Step</h3>
          <button type="button" class="deleteStep text-red-600 hover:text-red-800">
            <span class="material-symbols-outlined">delete</span>
          </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-textBody mb-1">Title</label>
            <input type="text" name="step_title[]" placeholder="Welcome & introduction"
              class="w-full bg-white border border-border rounded-lg px-3 py-2" />
          </div>

          <div>
            <label class="block text-sm font-medium text-textBody mb-1">Order</label>
            <input name="step_order[]" type="number" placeholder="1"
              class="w-full bg-white border border-border rounded-lg px-3 py-2" />
          </div>

          <div class="md:col-span-3">
            <label class="block text-sm font-medium text-textBody mb-1">Description</label>
            <textarea name="step_desc[]" rows="2"
              class="w-full bg-white border border-border rounded-lg px-3 py-2 resize-none"
              placeholder="Explain what happens in this step..."></textarea>
          </div>
        </div>
      `;

      step.querySelector('.deleteStep').addEventListener('click', () => {
        step.remove();
      });

      stepsContainer.appendChild(step);
    }

    addStepBtn.addEventListener('click', createStep);

    // start with one step
    createStep();
  </script>

</body>

</html>