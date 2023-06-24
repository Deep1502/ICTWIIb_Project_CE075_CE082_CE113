# ICTWIIb_Project_CE075_CE082_CE113
## To-do List using PHP
To-do list is about list of tasks a user needs to do or complete. It is often arranged based on some priority. It helps us in remembering tasks which we need to do.

In this project we have created a simple to-do list using PHP as backend, HTML and CSS for frontend and XAMPP MySQL for database. This project was created as a part of 2nd semester ICTW-II (b) project with my friends Het Patel and Vishal Sindhal.
## Requirements
  - Apache server started in XAMPP for running PHP
  - MySQL server started in XAMPP for accessing database
### Database
Database name: todo

Tables:
  - users (id, username, password, email)
  - tasks (id, userid, subject, task, days_remaining)

### Features included in the project
  - User management
    - Register user
    - Login
    - Logout
    - Delete user
    - Reset password
  - Task management
    - Create task
    - View task
    - Update task
    - Delete task

We have used sessions to manage user activities from login to logout.
## Use project
To use this project:
  - download xampp and start Apache and MySQL servers
  - create database in phpmyadmin
  - download files and paste them in a folder in htdocs folder of xampp
  - run localhost in browser and navigate to the login.php file
