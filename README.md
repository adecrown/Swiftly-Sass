# Swiftly-Sass
Some form of social media

####Installation Manual

This product was only tested on chrome web browser and partially tested on Safari


If the university VM is been used use **php -S 0:8080 -t Swiftly-Sass** to start the php server.

4 Steps to get the site up and running

1. Step 1:
  + Upload the site to your server.
2. Step 2:
  + visit the index.php page (your-web-site.com/index.php)
3. Step 3:
  + After you’ve visited the index.php page, everything you need to use the site would have been created (such as the database and tables).

If the installation was successful you would be redirected to the login page.

You can login as a user with any of the credentials below or you can register a new user.
Login Credentials.

| Username  | Password    |
| ----------|-----------: |
| David     | adecrown678 |
| Liam      | ade         |
| ade       | password    |

(Note: make sure you are in this project folder before starting the step below)

Step 4:
 + The private messaging system uses websockets,ws and node.js, this need to be installed.
 + To install them type npm install into your terminal.
 
 + server.js also needs to be started before a message can be sent.
 + To start server.js type npm start into your terminal
 server.js can be located in the lib/js folder
 it can also be started by typing:  node server.js just make sure you point node to the correct location for server.js
