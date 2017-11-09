# Pivotal Tracker Changelogs

Do you like copy-pasting? No? Me neither. Summarizing a bunch of user stories from Pivotal Tracker into a changelog is a **lot** of copy-pasting.

Let's get those changelogs generated automatically! This method for generating changelogs out of Pivotal Tracker projects is based on the workflow used at [Nimbl3](https://nimbl3.com/).

## Installation

### Prerequisite

You need a functional PHP environment. No database is required at this point. You also need Composer to be installed on your machine.

### Setup

1. Clone the Github repository in your PHP environment's root directory
2. Run `composer install` to fetch all dependencies

## Configuration

There is very little configuration to be done for the project to work. The only thing that you need to configure is your Pivotal Tracker API token. You will find it [in your profile page](https://www.pivotaltracker.com/profile).

Copy your API token and paste it in a file that you'll name `.token` and save in the project's root directory.