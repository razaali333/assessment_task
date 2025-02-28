# Laravel API with Passport Authentication

This is a **RESTful API** built with **Laravel 11** and **Laravel Passport** for authentication.

## 🚀 Setup Instructions

### 1️⃣ Clone the Repository
```bash
git clone https://github.com/your-username/your-repository.git
cd your-repository
```

### 2️⃣ Install Dependencies
```bash
composer install
```

### 3️⃣ Configure Environment
- Copy the `.env.example` file and rename it to `.env`:
  ```bash
  cp .env.example .env
  ```
- Open `.env` and set your database details:
  ```ini
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=your_database_name
  DB_USERNAME=root
  DB_PASSWORD=your_password
  ```

### 4️⃣ Generate Application Key
```bash
php artisan key:generate
```

### 5️⃣ Run Database Migrations & Seeding
```bash
php artisan migrate --seed
```

### 6️⃣ Install Laravel Passport
```bash
php artisan passport:install
```

### 7️⃣ Start the Development Server
```bash
php artisan serve
```
The API is now available at:
```
http://127.0.0.1:8000/api/
```

---

## 🛠 API Documentation

### 📌 Authentication Routes
| Method | Endpoint          | Description           | Auth Required |
|--------|------------------|----------------------|--------------|
| `POST` | `/api/register`  | Register a new user  | ❌ No        |
| `POST` | `/api/login`     | Login user           | ❌ No        |
| `POST` | `/api/logout`    | Logout user          | ✅ Yes       |
| `GET`  | `/api/user`      | Get authenticated user | ✅ Yes       |

### 📌 Users
| Method | Endpoint        | Description      | Auth Required |
|--------|----------------|------------------|--------------|
| `GET`  | `/api/users`   | List all users   | ✅ Yes       |
| `GET`  | `/api/users/{id}` | Get user details | ✅ Yes       |
| `POST` | `/api/users`   | Create a user    | ✅ Yes       |
| `PUT`  | `/api/users/{id}` | Update user  | ✅ Yes       |
| `DELETE` | `/api/users/{id}` | Delete user | ✅ Yes       |

### 📌 Projects
| Method | Endpoint          | Description            | Auth Required |
|--------|------------------|------------------------|--------------|
| `GET`  | `/api/projects`  | Get all projects      | ✅ Yes       |
| `GET`  | `/api/projects/{id}` | Get project details | ✅ Yes       |
| `POST` | `/api/projects`  | Create a project      | ✅ Yes       |
| `PUT`  | `/api/projects/{id}` | Update project     | ✅ Yes       |
| `DELETE` | `/api/projects/{id}` | Delete project | ✅ Yes       |

### 📌 Timesheets
| Method | Endpoint           | Description                | Auth Required |
|--------|-------------------|----------------------------|--------------|
| `GET`  | `/api/timesheets`  | Get all timesheets        | ✅ Yes       |
| `GET`  | `/api/timesheets/{id}` | Get timesheet details  | ✅ Yes       |
| `POST` | `/api/timesheets`  | Create a timesheet entry  | ✅ Yes       |
| `PUT`  | `/api/timesheets/{id}` | Update timesheet       | ✅ Yes       |
| `DELETE` | `/api/timesheets/{id}` | Delete timesheet  | ✅ Yes       |

### 📌 Dynamic Attributes (EAV)
| Method | Endpoint                  | Description                        | Auth Required |
|--------|---------------------------|------------------------------------|--------------|
| `GET`  | `/api/attributes`         | Get all attributes                 | ✅ Yes       |
| `POST` | `/api/attributes`         | Create a new attribute             | ✅ Yes       |
| `POST` | `/api/attribute-values`   | Assign attribute value to project  | ✅ Yes       |

---

## 📌 Example API Requests & Responses

### 1️⃣ Register User
#### 📌 Request
```http
POST /api/register
```
#### 📌 Body (JSON)
```json
{
    "first_name": "John",
    "last_name": "Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```
#### 📌 Response (201 Created)
```json
{
    "status": true,
    "message": "User registered successfully",
    "user": {
        "id": 1,
        "first_name": "John",
        "last_name": "Doe",
        "email": "john@example.com"
    },
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOi..."
}
```

---

### 2️⃣ Login User
#### 📌 Request
```http
POST /api/login
```
#### 📌 Body (JSON)
```json
{
    "email": "john@example.com",
    "password": "password123"
}
```
#### 📌 Response (200 OK)
```json
{
    "status": true,
    "message": "Login successful",
    "user": {
        "id": 1,
        "first_name": "John",
        "last_name": "Doe",
        "email": "john@example.com"
    },
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOi..."
}
```

---

## 🧑‍💻 Test Credentials

For testing API authentication, use the following credentials:

```
Email: test@example.com
Password: password123
```

Or create a new user using the **register API**.

---

## 💡 Additional Notes
- All **protected API endpoints** require a **Bearer Token** in the request headers.
- Use **Postman** or **cURL** to test API endpoints.
- This project follows **PSR standards and Laravel best practices**.

