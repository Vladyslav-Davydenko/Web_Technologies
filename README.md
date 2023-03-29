# SPECIFICATION FOR A WEBSITE

## Overview

The idea of this projects is to create a website that will allow people to share their memories with others about their travel experience

Our website is aim for all audience. 

## Team

### Vladyslav Davydenko (vldavy)
Team Leader. Responsible for whole project, but mainly for main pages (index, profile, about, edit-profile), their optimisation, styling and logic

### Mariia Boiko (marboi)
Main designer. Responsible for design for whole project, for pages with forms (login, register, add-post), their optimisation and validation logic

### Kiril Boiko (kiboik)
Rsponsible for single post and comments there, its optimisation, logic and styling
## Goals, Objectives and Phases

### Objective

The website supposed to achive the simplest interface for different users, nice and uderstandable design and solid backend part

### Goals

Make it:
* simple
* understandable
* accessible
* popular
* unique

### Phases

Web technologies `ISC0008` milestone #1.

## Content Structure

### Site map


```text
HOME
  +--POSTS
  |    +--POST'S INFO
  +--ABOUT
  |    +--HISTORY
  |    +--TEAM
  |    +--Contacts
  +--LOGIN(LOGUT)
  |    +--REGISTRATION
  +--Profile
  |    +--USER'S INFO
  |    +--USER'S POSTS
  |    +--POST'S FORM
  |    +--EDIT PROFILE
  |    +--ADD POSTS
  +--SINGLE POST
  |    +--DETAILED INFO
  |    +--COMMENTS
  |    +--LIKES
```

### Content Types

Each page contains:

* description
* images
* people
* comments
* date
* likes


### Page Templates
```text

Web_Technologies
  +--BASE
  |    +--POSTCLASS.CSS
  |    +--POSTCOMMENTSCLASS.CSS
  |    +--USERCLASS.PHP
  +--CSS
  |    +--STYLE.CSS
  |    +--HAMBURGER-MENU.CSS
  +--DATA
  |    +--COMMENTS.CSV
  |    +--POSTS.CSV
  |    +--REGISTRATION_INFO.CSV
  |    +--USERS.CSV
  +--FONTS
  +--IMG
  +--INCLUDES
  |    +--FOOTER.HTML
  |    +--HEAD.HTML
  |    +--NAVIGATION.HTML
  +--LIB
  |    +--TPL.CLASS.PHP
  +--TEMPLATES
  |    +--ABOUT_TPL.PHP
  |    +--INDEX_TPL.PHP
  |    +--PROFILE_TPL.PHP
  |    +--SINGLE_POST_TPL.PHP
  +--INDEX.PHP
  +--ABOUT.PHP
  +--PROFILE.PHP 
  +--EDIT_FORM.PHP
  +--LOGIN.PHP
  +--MAKE-POST-COMMENTS.PHP
  +--MAKE-POST.PHP
  +--REGISTRATION.PHP
  +--SINGLE_POST.PHP


NAVIGATION, FOOTER, HEAD are including in INDEX, PROFILE, SINGLE_POST, ABOUT
```
## Design

```text
CSS
    +--hamburger-menu.css (Menu for mobile devices; index.php, profile.php, about.php, single_post.php)
    +--style.css (style for every page)
```

## Functionality

* For sign-in users are required email, username and password
* Users have ability to post, leave comments, like posts
* Users use this website to chare their travel memories
* Users do not need well performed devices

## Browser Support

* Chrome/Chromium
* Firefox
* mobile browsers (Chrome, Firefox, Safari)

## Hosting

ENOS.