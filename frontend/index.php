<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Book Form</title>
</head>
<body>
  <h2>Add Book</h2>
  <form id="bookForm">
    <input type="text" name="title" placeholder="Title" required><br>
    <input type="text" name="author" placeholder="Author" required><br>
    <textarea name="description" placeholder="Description" required></textarea><br>
    <button type="submit">Submit</button>
  </form>
  <div id="response"></div>

  <script src="./js/index.js"></script>
</body>
</html>
