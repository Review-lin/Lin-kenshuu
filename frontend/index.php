<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Re:view Book Store</title>
  <link rel="shortcut icon" href="./assets/logo.png" type="image/x-icon" />
  <meta name="theme-color" content="#ffffff" />
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

  <style>
    @keyframes fadeInDown {
      0% { opacity: 0; transform: translateY(-20px); }
      100% { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeIn {
      0% { opacity: 0; }
      100% { opacity: 1; }
    }
    .animate-header { animation: fadeInDown 0.6s ease-out; }
    .animate-nav { animation: fadeIn 0.9s ease-out 0.25s forwards; opacity: 0; }
  </style>
</head>

<body class="bg-gray-50 text-gray-900 antialiased">

  <!-- Header -->
  <header class="bg-white border-b border-gray-200 animate-header">
    <nav class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <img src="./assets/logo.png" alt="logo" class="w-10 h-10 object-contain rounded" />
        <div>
          <h1 class="text-lg font-semibold">Re:view Book Store</h1>
          <p class="text-xs text-gray-500 -mt-0.5">Curated reads, beautifully presented</p>
        </div>
      </div>
      <div class="hidden md:flex items-center gap-6 text-sm font-medium animate-nav">
        <a href="#" class="text-gray-700 hover:text-gray-900 transition">Library</a>
      </div>
    </nav>
  </header>

  <!-- Main -->
  <main class="max-w-6xl mx-auto px-6 py-10">

    <!-- Hero -->
    <section id="heroSection" class="text-center py-16 bg-gradient-to-b from-white to-gray-50 rounded-lg shadow-sm mb-8">
      <h2 class="text-4xl md:text-5xl font-extrabold mb-4">Discover Your Next Book</h2>
      <p class="text-gray-600 max-w-2xl mx-auto text-lg">
        Search, explore, and enjoy a curated collection of timeless and modern literature.
      </p>
    </section>

    <!-- Controls -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
      <div class="flex items-center gap-3">
        <input id="searchInput" type="search" placeholder="Search by title or author..."
          class="w-full md:w-80 border border-gray-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-200" />
        <select id="sortSelect" class="border border-gray-200 rounded-lg px-3 py-2 text-sm">
          <option value="newest">Newest</option>
          <option value="oldest">Oldest</option>
          <option value="title-asc">Title ↑</option>
          <option value="title-desc">Title ↓</option>
        </select>
      </div>
      <div class="text-sm text-gray-600">Double-click a card to edit it</div>
    </div>

    <!-- Book Grid -->
    <div id="bookGridContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"></div>

  </main>

  <!-- Floating Add Button -->
  <button
    id="floatingButton"
    aria-label="Add new book"
    class="fixed bottom-6 right-6 w-14 h-14 rounded-full bg-gradient-to-br from-gray-800 to-gray-700 text-white text-3xl flex items-center justify-center shadow-2xl hover:scale-105 transform transition"
  >+</button>

  <!-- JS -->
  <script type="module" src="./js/index.js"></script>

</body>
</html>
