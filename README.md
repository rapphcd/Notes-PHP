# Notes-PHP

A simple PHP website to create and view notes.
## Overview
Notes-PHP is a basic web-based note-taking application designed as a learning project for PHP development. It provides a clean interface for users to manage their personal notes, featuring a secure authentication system and persistent storage.

## Features 
*   **User Authentication**: Secure registration and login system with password hashing.
*   **Note Management**: Create, view, edit, and delete notes.
*   **Persistence**: All data is stored in a MySQL database.
*   **Responsive Interface**: Simple and effective layout for managing notes.
*   **Real-time Saving**: Ability to update notes title and description.

## Installation
1.  **Clone the repository**:
    ```bash
    git clone https://github.com/rapphcd/Notes-PHP.git
    ```
2.  **Database Setup**:
    *   Import the `notesphp.sql` file into your MySQL database (e.g., using phpMyAdmin or CLI).
3.  **Configuration**:
    *   Rename `.env.example` to `.env`.
    *   Fill in your database credentials (`HOST`, `DB_NAME`, `USER`, `PASSWORD`).
4.  **Web Server**:
    *   Place the project in your web server's root directory (e.g., `www/` or `public_html/`).
    *   Ensure PHP 7.4+ or 8.x is installed.

## How to use ?
*   **Register**: Create a new account from the registration page.
*   **Login**: Access your dashboard using your credentials.
*   **Add a Note**: Click the **ADD** button to create a new blank note.
*   **Select a Note**: Click on a note in the list to view its content in the preview area.
*   **Edit**: Modify the title or description; changes are handled by the application logic.
*   **Delete**: Click the **DEL** button on any note to remove it permanently.

## Tech Stack
*   **Backend**: PHP
*   **Database**: MySQL
*   **Frontend**: HTML, CSS, JavaScript

---
[@rapphcd](https://github.com/rapphcd)
