# Project Setup Guide

This guide will help Linux and macOS users set up and run the project using Docker. Follow the steps below to ensure a smooth installation and execution process.

## Prerequisites

Before proceeding, ensure the following software is installed on your system:

1. **Docker**

    - Installation guide: [Docker Installation](https://docs.docker.com/get-docker/)

2. **Docker Compose** (usually bundled with Docker Desktop)

    - Installation guide: [Docker Compose Installation](https://docs.docker.com/compose/install/)

3. **Git**

    - Installation guide for Linux: Run `sudo apt update && sudo apt install git` (Debian-based systems) or use your package manager.
    - Installation guide for macOS: Install via [Homebrew](https://brew.sh/) using `brew install git`.

4. **Composer** (optional but recommended for faster setup)

    - Installation guide: [Composer Installation](https://getcomposer.org/doc/00-intro.md)

## Steps to Run the Project

1. **Clone the Repository**

    - Open your terminal and run:
      ```bash
      git clone git@github.com:jhonnykhadra/docupet_test.git
      cd docupet_test
      ```

2. **Install Dependencies Locally (Optional)**

    - To speed up the first `docker-compose up`, install dependencies locally using Composer:
      ```bash
      composer install
      ```

3. **Ensure Ports Are Available**

    - The project uses the following ports:
        - `8081` for the web application
        - `3307` for the database
    - Make sure these ports are not being used by any other services. You can check running services on these ports by executing:
      ```bash
      sudo lsof -i -P -n | grep LISTEN
      ```
      If a port is in use, stop the conflicting service or change its port.

4. **Build and Run the Project with Docker**

    - Execute the following command to build and start the Docker containers:
      ```bash
      docker-compose up --build
      ```
    - This command will download the necessary Docker images and start the containers.

5. **Access the Web Application**

    - Once the containers are up and running, open your browser and navigate to:
      ```
      http://localhost:8081/
      ```

## Stopping the Containers

- To stop the running containers, press `Ctrl+C` in the terminal where `docker-compose up` is running. Alternatively, run:
  ```bash
  docker-compose down
  ```

## Additional Notes

- If you encounter issues during setup, ensure that Docker and Docker Compose are running correctly.
- For troubleshooting, refer to the Docker logs using:
  ```bash
  docker-compose logs
  ```

## License

This project is licensed under the [MIT License](./LICENSE).

---

For further assistance, please refer to the project's documentation or contact the maintainer.

