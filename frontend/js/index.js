const API_BASE = "../backend";
const grid = document.getElementById("bookGridContainer");
const floatBtn = document.getElementById("floatingButton");
const searchInput = document.getElementById("searchInput");
const sortSelect = document.getElementById("sortSelect");
const heroSection = document.getElementById("heroSection");

async function loadBooks() {
  const res = await fetch(`${API_BASE}/read.php`);
  const data = await res.json();

  if (data.length > 0) heroSection.style.display = "none";
  else heroSection.style.display = "block";

  renderBooks(data);
}

function renderBooks(books) {
  grid.innerHTML = "";

  if (!books || books.length === 0) {
    grid.innerHTML = `<p class="col-span-full text-center text-gray-500">No books found.</p>`;
    return;
  }

  books.forEach((b) => {
    const card = document.createElement("div");
    card.className =
      "bg-white rounded-xl shadow hover:shadow-md p-5 transition relative cursor-pointer";
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

  document.querySelectorAll(".delete-btn").forEach((btn) => {
    btn.addEventListener("click", async (e) => {
      e.stopPropagation();
      const id = e.target.dataset.id;
      if (confirm("Delete this book?")) {
        await fetch(`${API_BASE}/delete.php`, {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ id }),
        });
        loadBooks();
      }
    });
  });
}

// Add book
floatBtn.addEventListener("click", async () => {
  const title = prompt("Book title:");
  if (!title) return;
  const author = prompt("Author:");
  const description = prompt("Description:");
  const year = parseInt(prompt("Year:")) || new Date().getFullYear();

  await fetch(`${API_BASE}/create.php`, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ title, author, description, year }),
  });

  loadBooks();
});

// Edit book
async function editBookPrompt(b) {
  const title = prompt("Edit title:", b.title);
  const author = prompt("Edit author:", b.author);
  const description = prompt("Edit description:", b.description);
  const year = parseInt(prompt("Edit year:", b.year)) || b.year;

  await fetch(`${API_BASE}/update.php`, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ id: b.id, title, author, description, year }),
  });

  loadBooks();
}

// Search
searchInput.addEventListener("input", async (e) => {
  const query = e.target.value.toLowerCase();
  const res = await fetch(`${API_BASE}/read.php`);
  const data = await res.json();

  const filtered = data.filter(
    (b) =>
      b.title.toLowerCase().includes(query) ||
      b.author.toLowerCase().includes(query)
  );

  renderBooks(filtered);
});

// Sort
sortSelect.addEventListener("change", async (e) => {
  const res = await fetch(`${API_BASE}/read.php`);
  let data = await res.json();

  switch (e.target.value) {
    case "oldest":
      data.sort((a, b) => a.year - b.year);
      break;
    case "title-asc":
      data.sort((a, b) => a.title.localeCompare(b.title));
      break;
    case "title-desc":
      data.sort((a, b) => b.title.localeCompare(a.title));
      break;
    default: // newest
      data.sort((a, b) => b.year - a.year);
  }

  renderBooks(data);
});

loadBooks();
