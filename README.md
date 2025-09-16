# Recipe-Finder Local Host Version
A simple web application to search recipes based on ingredients, save favorites, and explore meals. Built with PHP, MySQL, HTML/CSS, and JavaScript.

for Hosted one check my other repo : https://github.com/Yash-36-p/Hosted-Recipe-Finder.git
Features

Search recipes by ingredients.

Filter by cuisine and diet (client-side).

Save favorite recipes.

Dark mode toggle with local storage.

User registration and login system.

Technologies Used

Frontend: HTML5, CSS3, JavaScript

Backend: PHP

Database: MySQL

APIs: Spoonacular

Localhost Setup

Follow these steps to run the project locally:

Install XAMPP/WAMP/LAMP (with Apache and MySQL).

Clone the repository:

git clone https://github.com/yourusername/recipe-finder.git


Copy files to your web server directory:

XAMPP: C:\xampp\htdocs\recipe-finder

WAMP: C:\wamp\www\recipe-finder

Create MySQL database:

Database name: recipefinder

Tables: users and favorites (will be auto-created on first run if not exists)

Update db.php if needed:

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recipefinder";

Run the project: Open http://localhost/recipe-finder in your browser.
