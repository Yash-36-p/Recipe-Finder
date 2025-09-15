

function saveFavorite(title, url, image){
    fetch('favorites.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `title=${encodeURIComponent(title)}&url=${encodeURIComponent(url)}&image=${encodeURIComponent(image)}`
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            alert("Recipe saved to favorites!");
        } else {
            alert("Error saving recipe.");
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
  const body = document.body;
  const toggleBtn = document.getElementById('darkModeToggle');

  if (!toggleBtn) return; // safety

  // apply saved theme
  const saved = localStorage.getItem('theme'); // 'dark' | 'light' | null
  if (saved === 'dark') body.classList.add('dark-mode');
  toggleBtn.textContent = body.classList.contains('dark-mode') ? '☀️ Light Mode' : '🌙 Dark Mode';

  // toggle on click
  toggleBtn.addEventListener('click', () => {
    body.classList.toggle('dark-mode');
    const now = body.classList.contains('dark-mode') ? 'dark' : 'light';
    localStorage.setItem('theme', now);
    toggleBtn.textContent = now === 'dark' ? '☀️ Light Mode' : '🌙 Dark Mode';
  });
});


document.getElementById('searchBtn').addEventListener('click', function() {
  let ingredients = document.getElementById('ingredients').value;
  let cuisine = document.getElementById('cuisine').value;
  let diet = document.getElementById('diet').value;

  if (ingredients === "") {
      alert("Please enter some ingredients!");
      return;
  }

  // Show loading spinner
  document.getElementById('loading_spinner').style.display = 'flex';

  let query = `ingredients=${encodeURIComponent(ingredients)}&cuisine=${encodeURIComponent(cuisine)}&diet=${encodeURIComponent(diet)}`;

  fetch(`search.php?${query}`)
      .then(response => response.json())
      .then(data => {
          let recipesDiv = document.getElementById('recipes');
          recipesDiv.innerHTML = "";

          if (data.results.length === 0) {
              recipesDiv.innerHTML = "<p>No recipes found.</p>";
          } else {
              data.results.forEach(recipe => {
                  let recipeCard = `<div class="recipe-card">
                      <img src="${recipe.image}" alt="${recipe.title}">
                      <h3>${recipe.title}</h3>
                      <a href="${recipe.sourceUrl}" target="_blank">View Recipe</a>
                      <button onclick="saveFavorite('${recipe.title}', '${recipe.sourceUrl}', '${recipe.image}')">Save</button>
                  </div>`;
                  recipesDiv.innerHTML += recipeCard;
              });
          }

          // Hide loading spinner
          document.getElementById('loading_spinner').style.display = 'none';
      })
      .catch(() => {
          // Hide loading spinner
          document.getElementById('loading_spinner').style.display = 'none';
          alert('Error fetching data');
      });
});


