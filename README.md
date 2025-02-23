# Laravel Community Platform

A feature-rich community platform built with Laravel. This platform provides functionalities such as blogs, forums, video sharing, and group creation. It includes a powerful admin panel for managing categories and other administrative tasks. The core structure is functional and open for further development.

![Laravel Blog- Community Platform](./project-image/image1.png)

## Features

- **Blog System**: Create, edit, and manage blog posts.
- **Forum**: Discussion forums for users to engage in conversations.
- **Video Sharing**: Upload and share videos.
- **Groups**: Users can create and manage groups.
- **Admin Panel**: Manage categories, content, and users with an intuitive interface.

## Installation

### Requirements
- PHP 8.0+
- Laravel 11+
- MySQL or PostgreSQL database
- Composer
- Node.js & NPM (for frontend assets)

### Steps

1. Clone the repository:
   ```sh
   git clone https://github.com/RecLast/LaravelBlog-Community.git
   cd LaravelBlog-Community
   ```
2. Install dependencies:
   ```sh
   composer install
   npm install && npm run dev
   ```
3. Set up the environment file:
   ```sh
   cp .env.example .env
   ```
   Configure database and other environment variables in the `.env` file.

4. Generate application key:
   ```sh
   php artisan key:generate
   ```
5. Run migrations and seed database:
   ```sh
   php artisan migrate --seed
   ```
6. Start the development server:
   ```sh
   php artisan serve
   ```

## Usage

Once the server is running, visit `http://127.0.0.1:8000` in your browser to access the platform.

## Contribution

Contributions are welcome! Feel free to fork the repository and submit a pull request.

## License

This project is licensed under the MIT License. See the LICENSE file for details.

## Contact

For inquiries or feature requests, open an issue or contact me at [your email].
