# Environment setup

This assessment environment set up is based on Docker-Symfony-Stack credit to [thomasd.codes](https://gitlab.com/thomasd.codes/docker-symfony-stack) aiming to provide a quick local symfony setup. However, it is a reference only, you may want to setup it your own way.

## Environment setup instruction
Copy the .env.example file and edit the entries to your needs:
```
cp .env.example .env
```

Only start docker-compose to start your environment:
```
make up
```

After booting the container, you can use composer and the symfony cli insight the php-apache container:
```
docker exec -it symfony-assessment-apache-php bash
composer create-project symfony/skeleton ./
```

## Installed Packages
You have three container running: Apache-PHP, MariaDB and Adminer.
- [Web-App](http://0.0.0.0)
- [Adminer](http://localhost:8080)

# 🔮 Beyond PHP Symfony Backend Assessment

## 📚 Background

Imagine a fictional client "Global Books Inc" has asked us to build an API,
which can be used to manage their book inventory. 

- **GBI-001** Build model **publisher** which has the publisher name
- **GBI-002** Build model **author** which has the author name
- **GBI-003** Build model **book** which has the name, publisher, description 
  ISBN and author
- **GBI-004** Create an endpoint which allow to create / update books in the 
  book inventory
- **GBI-005** Create an endpoint which allow searching for books by their name

> **TIP** Don't forget to include these ticket numbers in your commit(s).
  Demostrate the usage of Unit Test and Dependency Injection will be apprecated.

## 🧭 Getting Started

Follow our [quickstart] guide to get this project setup on your machine 
for local development. With your machine setup, you can proceed with 
completing the tasks below.

[contributing]: docs/CONTRIBUTING.md
[quickstart]: docs/quickstart.md

## 📋 Tasks

As described above, you've been assigned five tasks for a fictional project.
This is a great opportunity to understand how we work and see the process we
follow to build and deliver high-quality work at Beyond.

Below is a detailed description of the tasks, once your tasks are complete you
may proceed to the section below.

- 🔲 Add a check when creating or updating a **book** to ensure that the
  provided `author_id` and/or `publisher_id` exists and return a `404` error if they
  don't. Remember to adjust the unit test suite as necessary.
- 🔲 Add a `/search` endpoint to `/api/v1/books` so that a search can be
  performed for books based on their `name`.

> **TIP** We'll be looking at the following when reviewing your submission;
> test coverage, code standards, complexity, documentation and Git usage. If
> you're called for an interview, we'll reserve some time to discuss your
> submission. Think about the challenges you faced, your approach and
> improvements you'd make to this project.

## 📬 Submitting Your Work

**This project took time to create, please do not publish this work!**

To get your contributions over to us, please use one of the following options:

1. Create a **private** repo on Github and share access with a member of our
   team.
2. Send a `.zip` file containing this project, your contributions and the Git
   history.
3. Send a Git `.patch` file of your changes.

We'll assess your work and share feedback through the recruitment channels.

Thank you for taking the time to complete this technical assessment, we wish
you the best of luck and will be in touch.

## ⚖️ Copyright

Copyright © 2023 Beyond. All Rights Reserved.

This software cannot be copied and/or redistributed via any medium without the
express written permission of Beyond. See the accompanying [LICENSE] for
details.

**Proprietary and confidential.**

[license]: LICENSE


