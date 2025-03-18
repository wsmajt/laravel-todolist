# laravel-todolist

![App Screenshot](https://github.com/user-attachments/assets/f1506d30-1b8e-450a-9939-2e6c4cc11cd5)


## About

This is a Todo application built with Laravel 12 for the backend and Vue.js for the frontend. The application uses TailwindCSS for styling, and was built using ![my skeleton project](https://github.com/wsmajt/laravel-vue-skeleton/)

## Features

- User authentication
- Create and delete tasks
- Mark tasks as complete
- Responsive design with TailwindCSS

## Technologies Used

- **Backend**: Laravel
- **Frontend**: Vue.js
- **Styling**: TailwindCSS

## Installation

1. Clone the repository:

```bash
git clone https://github.com/wsmajt/laravel-todolist.git
cd laravel-todolist
```

2. Install backend dependencies:

```bash
composer install
```

3. Install frontend dependencies:

```bash
npm install
```

4.  .env file:

```
change name of CHANGE_ME_TO_.env to .env
in .env file, generate base64:Encryption Key
```

5.  Migrate Database:

```bash
php artisan migrate
```

6. Run application:

```bash
composer run dev
```

## Usage

1. Open your browser and go to `http://127.0.0.1:8000/`
2. Register a new user or log in with your credentials.
3. Create and manage your tasks!


## Acknowledgements

- [Laravel](https://laravel.com/)
- [Vue.js](https://vuejs.org/)
- [Tailwind CSS](https://tailwindcss.com/)
