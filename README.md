# Jobber Marketplace Application

This project is a **marketplace application** similar to NeedHelp.com. It connects individuals seeking help for small jobs (Customers) with service providers (Jobbers). The backend is built with Symfony and managed through Docker for easy deployment. The frontend, developed with React, interfaces with the backend to provide an intuitive user experience.

---

## Features

- **Jobs**: Represents tasks to be completed. A job has a title, description, creation date, and status (Pending, In Progress, or Done).
- **Customer**: Represents a client who posts jobs.
- **Jobber**: Represents a service provider who applies to jobs.
- **Offer**: Represents an offer made by a Jobber for a specific Job. It includes an amount and can be accepted or rejected by the Customer.

---

## Prerequisites

Ensure that the following tools are installed on your system:

- **Docker & Docker Compose**: Used to build and deploy the backend in containers.
- **Node.js and npm**: Required for running and building the frontend application.

---

## Installation Guide

### 1. Clone the Repository

```bash
git clone git@github.com:mickaellambert/octorenov.git
cd octorenov
```

### 2. Backend Setup

Navigate to the backend directory:

```bash
cd backend
```

#### Environment Configuration

Customize the `.env` file with your local MySQL credentials.

Replace the following variables:

- `MYSQL_USER` – your MySQL username.
- `MYSQL_PASSWORD` – your MySQL password.
- `MYSQL_DATABASE` – the database name.

Ensure `DATABASE_URL` is correctly set with the variables above.

#### Docker Setup for Backend

To start the backend in Docker, stay in the `backend` folder of the app, and then : 

1. Build and start the containers:

   ```bash
   docker-compose up -d --build
   ```

2. Run database creation:

   ```bash
   docker-compose exec app php bin/console doctrine:database:create
   ```

3. Run database migrations:

   ```bash
   docker-compose exec app php bin/console doctrine:migrations:migrate
   ```

4. Load data fixtures:

   ```bash
   docker-compose exec app php bin/console doctrine:fixtures:load
   ```

### 3. Frontend Setup

Navigate to the frontend directory:

```bash
cd ../frontend
```

#### Install Dependencies

```bash
npm install
```

#### Start the Development Server

To run the frontend locally, use:

```bash
npm run dev
```

The frontend should now be available at `http://localhost:5173`.

### 4. API Documentation

The API documentation can be accessed via Postman. You can view the [Postman Documentation here](https://documenter.getpostman.com/view/4737023/2sAY4xBNEt).

Alternatively, to import the API collection into your Postman workspace:

1. Go to `backend/api_octorenov.postman_collection.json` in this repository.
2. Import the file into Postman for easy access to all endpoints.

---

## Available Scripts

### Backend Scripts

In the `backend` directory, you can use:

- `docker-compose exec app php bin/console doctrine:migrations:migrate`: Run database migrations.
- `docker-compose exec app php bin/console doctrine:fixtures:load`: Load fixtures data into the database.

### Frontend Scripts

In the `frontend` directory, you can use:

- `npm run dev`: Starts the development server.
- `npm run build`: Builds the app for production.
- `npm run preview`: Previews the production build locally.

---

## Axes of Improvement

While this application achieves a functional marketplace, several improvements could enhance its quality, maintainability, and user experience.

### 1. Role-Based Access and Authentication

Currently, this project does not include any **authentication or role-based access**. In a full-featured application, a role management system would ensure that only Customers can create jobs, while only Jobbers can submit offers. API calls could also be restricted based on these roles to enhance security and user segmentation. 

In this prototype, a constant is used in the frontend to define the Jobber ID when creating offers.

### 2. Improved Offer Management in the Frontend

Currently, users can see offers but cannot accept or reject them directly. Implementing full **offer acceptance and rejection features** would bring the application closer to real-world usability, providing a complete experience for customers to manage offers in-app.

### 3. Improve Error Handling

Error handling is currently limited, with errors primarily logged to the console. A more **robust error management system** could include:

- **User-friendly error messages**: Display clear and actionable messages to end users for issues like failed requests or server errors.
- **Logging and tracking**: Integrate logging tools to track errors and provide diagnostics, which would allow developers to monitor the health and performance of the application.

### 4. Separate API Resources from Entities

Using **API Platform's newer features**, it’s possible to separate `ApiResource` annotations from the actual entities. By creating dedicated resource classes, we could better isolate API-specific logic from domain logic, resulting in cleaner and more maintainable code. I, unfortunately, did not succeed to implement it

### 5. Frontend Structure and Component Refinement

Given my experience level, I believe there’s room to **optimize the global structure of React components**. Refactoring some components for reusability, modularity, and readability could improve maintainability. For example, creating smaller, reusable components and organizing files in a way that enhances the development flow.

I'm proud of what I’ve accomplished with this application, and I’m eager to continue learning. 
