# 🛸 Quickstart

> Follow this guide to get your machine setup and configured correctly to
> contribute to this project.

## 🔍 Prerequisites

Before you get started, please be sure you've met the following:

- Install [docker] and ensure `docker compose` is available from your terminal.
- You will need the `make` command to access this projects tooling.

> This project has been built and tested on [Linux], [macOS] and [Windows WSL].
> Unfortunately we cannot support other operating systems.

[docker]: https://docker.com/
[linux]: https://www.redhat.com/en/topics/linux/what-is-linux
[macos]: https://www.apple.com/macos/
[windows wsl]: https://learn.microsoft.com/en-us/windows/wsl/about

## 🚧 Initial Setup

Before you start, it's a good idea to have a directory on your machine where
software projects can be placed. If you already have a location, please skip
this step, adjusting the each command as necessary. Otherwise, run the
following from your terminal to create a local project directory.

```bash
mkdir ~/Projects
```

Next, clone this software project onto your machine and into your project
directory.

```bash
git clone git@bitbucket.org:byndops/bynd-backend-php-assessment.git \
    ~/Projects/bynd-backend-assessment
```

Finally, change into the projects directory.

```bash
cd ~/Projects/bynd-backend-php-assessment
```

## 🚀 Running Locally

Before running this project, you'll need to have a database running. For
convenience we've included a `docker-compose.yaml` to make this easy. 

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

With the project running, you can visit <http://0.0.0.0> to view the
symfony basic skeleton page