const API_BASE = "../backend";
const grid = document.getElementById("bookGridContainer");
const heroSection = document.getElementById("heroSection");

let start = 0;
const limit = 20;
let loading = false;
let allLoaded = false;

async function loadBooks(initial = false) {
  if (loading || allLoaded) return;
  loading = true;

  const res = await fetch(`${API_BASE}/read.php?start=${start}&limit=${limit}`);
  const data = await res.json();

  if (initial && data.length === 0) heroSection.style.display = "block";
  else heroSection.style.display = "none";

  if (data.length < limit) allLoaded = true; // reached end
  renderBooks(data, initial ? false : true); // append if not initial

  start += limit;
  loading = false;
}

function renderBooks(books, append = false) {
  if (!append) grid.innerHTML = ""; // clear only for initial load

  if (!books || books.length === 0) {
    if (!append)
      grid.innerHTML = `<p class="col-span-full text-center text-gray-500">No books found.</p>`;
    return;
  }

  books.forEach((b) => {
    const card = document.createElement("div");
    card.className =
      "bg-white rounded-xl shadow hover:shadow-md p-5 transition relative cursor-pointer fade-in";
    card.innerHTML = `
      <h3 class="text-lg font-bold">${b.title}</h3>
      <p class="text-sm text-gray-600">by ${b.author}</p>
      <p class="text-gray-700 mt-2 text-sm">${b.description || ""}</p>
      <p class="text-xs text-gray-400 mt-3">Published: ${b.year}</p>
      <button data-id="${b.id}" class="delete-btn absolute top-3 right-3 text-red-500 hover:text-red-700 text-sm">✕</button>
    `;

    card.addEventListener("dblclick", () => editBookPrompt(b));
    grid.appendChild(card);
  });

  // handle delete buttons
  grid.querySelectorAll(".delete-btn").forEach((btn) => {
    btn.addEventListener("click", async (e) => {
      e.stopPropagation();
      const id = e.target.dataset.id;
      if (confirm("Delete this book?")) {
        await fetch(`${API_BASE}/delete.php`, {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ id }),
        });
        // reload from start
        start = 0;
        allLoaded = false;
        loadBooks(true);
      }
    });
  });
}


loadBooks(true); // initial load

// infinite scroll event
window.addEventListener("scroll", () => {
  if (window.innerHeight + window.scrollY >= document.documentElement.scrollHeight - 100) {
    loadBooks(); // load next batch
    console.log('ji');
  }
});
