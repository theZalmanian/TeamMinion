# TeamMinion - Spa On
Final project for SDEV 328 - a spa reservation site.

## Authors
### This project was created and worked on by:
- **Toby Goetz** - [tobyDevOp](https://github.com/tobyDevOp)
- **Zalman Izak** - [theZalmanian](https://github.com/theZalmanian/)
- **LeeRoy Hegwood** - [CombustableLem0n](https://github.com/CombustableLem0n)

# Requirements
### Separates all database/business logic using the MVC pattern.
- Model, Views, Controller, and Scripts directory's in app directory
- All HTML files are in the `views/` directory
- All Scripts are located in `scripts/`
- All project routes are defined in index.php
- Classified controller object in `controllers/controller.php` is called by `index.php` to render views
- Implemented inheritance class structure to accurately query and update the database
- Database logic and functions are located in `model/`

### Routes all URLs and leverages a templating language using the Fat-Free framework.
- Conditionally define routes and render pages using Fat-Free Framework using index.php
- and app/controller/controllers as well as controllers/controller
- Utilized templating to dynamically display reservation confirmation and display session variables

### Has a clearly defined database layer using PDO and prepared statements.
- All database functions are located within a `ValidateAvailability` class and utilize PDO for secure database interactions
- DB script inside 'scripts/', config.ini located in config directory

### Data can be added and viewed.
- Available time slots are dynamically generated depending on existing reservations stored in database
- Database is updated with each reservation
- A confirmation is displayed once a reservation is completed by querying database for reservation data
- Accounts can be created, join events, leave events, create events, view events and more

### Has a history of commits from both team members to a Git repository. Commits are clearly commented.
- Continuous integration was achieved through pair programming and implementation of version control
- Weekly team meetings facilitated project management and increased productivity

### Uses OOP, and utilizes multiple classes, including at least one inheritance relationship.
- `Reservation` class is inherited by `MassageReservation` and allows for expansion of various event types
- 'User' class is inherited by 'Admin' and is used to save user information to session, being stored in session
-  and having values sent to user table in SQL after account creation

### Contains full DocBlocks for all PHP files and follows PEAR standards.
- Through continuous code reviews and inspection all PHP files contain DocBlocks and follow PEAR standards
- Made DocBlocks for each route in app/controllers/controller.php

### Has full validation on the server side through PHP.
- PHP scripts validate AJAX calls and dynamically render HTML elements

### All code is clean, clear, and well-commented. DRY (Don't Repeat Yourself) is practiced.
- Variable declaration is descriptive and consistent
- Additional comments added for procedural code
- Functional programming was implemented to reduce redundancy
- navigation.html used to cut repetitiveness from navbar
- database.class.php used to csut repetitivenes from controller database calls

### Your submission shows adequate effort for a final project in a full-stack web development course.
- Ideas and best practices were adopted from curriculum
- Features implemented beyond scope of class to add extra challenge to project
- Site is functional, meets requirements, and has taken a large amount of hours, learning, and effort to complete

### BONUS:  Incorporates Ajax that access data from a JSON file, PHP script, or API. If you implement Ajax, be sure to include how you did so in your readme file.
- Availability forms utilize AJAX to enhance usability and functionality of the site and
- Form logic was kept to one page without reloading

# UML Diagrams
![MassageReservation](https://github.com/theZalmanian/TeamMinion/assets/103011701/ede79dd6-d2b6-44cf-968c-a615f71a4ea8)
![ControllerUML](https://github.com/theZalmanian/TeamMinion/assets/103011701/fd5504f3-ca39-475f-b830-a6822ea0817d)
![ValidateAvailability](https://github.com/theZalmanian/TeamMinion/assets/103011701/11e1ac46-bea9-4db3-81e3-6a6d3119b434)
![UMLDiagram.png](https://github.com/theZalmanian/TeamMinion/blob/main/uml/UMLDiagram.PNG?raw=true)


# ER Diagrams
![image](https://github.com/theZalmanian/TeamMinion/assets/103011701/5c911406-c781-4d63-95c9-a7381abed7a9)
![ERDiagram.png](https://github.com/theZalmanian/TeamMinion/blob/main/er/ERDiagram.PNG?raw=true)