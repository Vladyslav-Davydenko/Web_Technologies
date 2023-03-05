# SPECIFICATION FOR A WEBSITE

## Overview

The idea of this projects is to create a website that will help people to share their memories with others about their travel experience

Our website is aim for all audience. 

## Team

### Vladyslav Davydenko (vldavy)
Team Leader. Responsible for whole project, but mainly for main pages (index, profile) and their optimisation for different devices

### Mariia Boiko (marboi)
Main designer. Responsible for design for whole project, also for (login, form and register) pages and optimisation of navbar for mobile devices

### Kiril Boiko (kiboik)
Rsponsible for detailed pages(about and single post) and their optimisation for different devices
## Goals, Objectives and Phases

### Objective

The website supposed to achive the simplest interface for different users, nice design and solid frontend part

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
  +--SONGLE POST
  |    +--DETAILED INFO
  |    +--COMMENTS
  |    +--LIKES
```

### Content Types

Describe what kind of data types each page contains:

* description
* images
* people
* comments
* date
* likes


### Page Templates

HOME - index.html
PROFILE - profile.html
LOGIN - login.html
ABOUT - about.html
SINGLE POST - single_post.html
REGISTARTION - registartion.html

NavBar is including in HOME, PROFILE, SINGLE POST, ABOUT
## Design

CSS
    +--hamburger-menu.css (Menu for mobile devices; index.html, profile.html, about.html, single_post.html)
    +--login.css (login-post.html)
    +--make-post.css (make-post.html)
    +--reg.css (reg.css)
    +--single_post.css (single_post.html)
    +--style.css (index.html, profile.html)


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