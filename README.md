# Community Platform

A robust and feature-rich community platform built with Laravel, designed to foster user engagement and content sharing. This platform combines blogging, forum discussions, video sharing, and group management capabilities with a powerful admin panel.

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Features

### Content Management
- **Blog System**: Create, edit, and manage blog posts with rich text editing
- **Forum**: Engage in discussions with threaded conversations and topic management
- **Video Sharing**: Upload and share videos within the community
- **Group System**: Create and manage user groups with specific permissions

### Administrative Tools
- Comprehensive admin dashboard
- Category management for blogs and forums
- User role and permission management
- Content moderation tools
- Analytics and reporting features

### User Features
- User profiles and achievements
- Point-based reward system
- Comment and interaction capabilities
- Group membership and management

## Technology Stack

- **Framework**: Laravel
- **Database**: MySQL
- **Frontend**: Blade templates with Tailwind CSS
- **Authentication**: Laravel Breeze

## Installation

1. Clone the repository
```bash
git clone [repository-url]
cd [project-directory]
```

2. Install dependencies
```bash
composer install
npm install
```

3. Configure environment
```bash
cp .env.example .env
php artisan key:generate
```

4. Set up database
```bash
php artisan migrate
php artisan db:seed
```

5. Start development server
```bash
php artisan serve
npm run dev
```

## Development Status

The platform is currently in active development with core features implemented and functioning. It's built with scalability in mind and is ready for further enhancements and customizations.

### Implemented Features
- ✅ User Authentication
- ✅ Blog System
- ✅ Forum System
- ✅ Video Sharing
- ✅ Group Management
- ✅ Admin Panel
- ✅ Category Management

### Roadmap
- 🔄 Enhanced User Notifications
- 🔄 Real-time Chat
- 🔄 API Integration
- 🔄 Mobile Responsiveness Improvements

## Contributing

Contributions are welcome! Please feel free to submit pull requests.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Support

If you encounter any issues or have questions, please file an issue on the GitHub repository.
