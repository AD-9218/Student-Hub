PRACTICAL 12: EVENT MANAGEMENT CRUD WITH POSTER UPLOAD AND FILE VALIDATION

INSTALLATION
1. Copy the Practical-12 folder into:
   C:\xampp\htdocs\Student-Hub\Practical-12\
2. Start Apache and MySQL in XAMPP.
3. Make sure MySQL root password in db.php matches your XAMPP setup.
4. Open:
   http://localhost/Student-Hub/Practical-12/index.php

DATABASE
- db.php automatically creates the student_hub database and events table.
- It inserts three sample events the first time the table is empty.

FEATURES
- Add, view, edit and delete events.
- Search by title, venue or description.
- Filter events by Open/Closed status.
- Upload JPG, PNG, GIF or WEBP poster images.
- Server-side MIME type validation and maximum file size of 2 MB.
- Success/error messages and prepared SQL statements.

LINK FROM YOUR EXISTING EVENT PAGE
Keep this in your Practical-2/event.html sidebar:
<a href="../Practical-12/index.php">Event Management</a>

NOTE
This is a classroom practical demo. For a production system, add authentication and authorization before allowing event management.
