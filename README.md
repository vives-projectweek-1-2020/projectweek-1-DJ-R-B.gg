![GitHub issues](https://img.shields.io/github/issues/vives-projectweek-1-2020/projectweek-1-DJ-R-B.gg)
![GitHub pull requests](https://img.shields.io/github/issues-pr/vives-projectweek-1-2020/projectweek-1-DJ-R-B.gg)

# Grademe 

## Tools

* MariaDB
* PHP
* Laravel

## Problem

Wij hebben vernomen dat tijdens deze Corona crisis de werkdruk op leerkrachten
van het basisonderwijs serieus verhoogt was. Daarom willen we met dit project
een manier voorleggen waarbij het mogelijk is dat studenten van het middelbaar onderwijs
de taken verbeteren van leerlingen van het basisonderwijs.

## Project

Ons project is een platform genaamd Grademe dat ervoor zorgt dat leerlingen taken kunnen uploaden
en dat leerlingen van het middelbaar deze taken kunnen gaan verbeteren.

## Project Members

* [Dieter Dewachter](https://github.com/dieterdewachter)
* [Jens Cocquyt](https://github.com/Jens-C)
* [Reinder Vis](https://github.com/rvis15)
* [Brent Schaepdrijver](https://github.com/)

## Mentors

* [Piet Cordemans](https://github.com/pcordemans)
* [Sille van Landschoot](https://github.com/sillevl)

# Setup Guide

## System requirements

* [Composer](https://getcomposer.org/download/)
* [xampp](https://www.apachefriends.org/download.html)

## How to run.

Firstly you will have to set up your database. The database will have to be set up through phpmyadmin.
When you have created an empty database you will have to name the database `grademe`.
After having done that you need to run the below commands to fully install the project.

### Commands needed to fully install project.

* `composer i`
* `php artisan migrate`

After having run the above commands the project should be fully installed.
In the `public/upload` folder there are several test images. these images can be used when wanting to put data in the system.

After having executed the steps listed above, you should be good to go.