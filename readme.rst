###################
BetDANGER! :D
###################

This is one of my practice project for improving my skills in web development.
Based on codeIgniter php framework. Besides this i use php, js, jQuery, ajax, npm, gulp, sass, bootstrap.
This repo contains development code.

About my blog, yeah it's a blog. :D

The frontend is not perfect & not responsive everywhere. It's not purpose for me to make perfect frontend in the project.

Test user:
email: testuser@gmail.com
pass: admin123

###################
Installation
###################

The main branch is the 'developer' branch

- pull or download the project
- set the db (the sql file in the assets)
- run npm install
- run gulp (to the developer mode run gulp --dev)

###################
Features
###################

************
Admin
************
There are 3 types of user. (user, administrator, moderator).
User can't enter to the admin page.
Administrator can handle categories and posts or contents.
Only the Moderator can handle the users.

- Users: So the moderator can change the user type of the members or tilt the member but of course can see information about the users.

- CMS settings: There are featured cards on the main page & category & tags & search pages. On this menu the admin & moderator can change the card settings, set the status of the image, author, short description and tags, depends on which would like to see or not.

- CMS categories: On this page the admin & moderator can handle the categories (CRUD) except the first one (uncategorised).A category belongs to posts or contents and if a category will be deleted then the posts will be re-categorised to the first one (uncategorised).

- CMS contents: On this page there are information about the posts (id, name, public status, category, created at). Of course the admins & moderators can handle the posts (CRUD). On link 'Add content' can set the post title, content, tags, image, etc. There is an ajax, js based async search field too.

- Newsletter: Here the admin & moderator can send newsletters to the subscribed users. The user can subscribe on sign up or later on the profile.

************
Page profile:
************
The users can see their data on this page. (username, email)
Can subscribe or unsubscribe from the newsletter.
Change their password or remove the profile.

************
Comments:
************
The users can write comments on the reading page if logged in. Of course can edit & delete their own comments.
Moderator can tilt or delete the comments.
If a post will be deleted then the comments that belongs to the post will be deleted too.

************
Search:
************
Async ajax based search feature.
There is a search result page if the user wants more option or can choose one of post by click on it.

************
More features:
************
Tag choice, login, registration, password recovery, contact us on the footer

###################
Server Requirements
###################

PHP version 5.6 or newer is recommended.

###################
Resources
###################
-  `User Guide <https://codeigniter.com/docs>`_
