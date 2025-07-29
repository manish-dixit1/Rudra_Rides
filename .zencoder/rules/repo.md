---
description: Repository Information Overview
alwaysApply: true
---

# Rudra Rides Information

## Summary
Rudra Rides is a travel booking platform for Himachal Pradesh tourism, offering hotel bookings, activity reservations, and destination information. The application is built with PHP and MySQL, designed for deployment on Vercel's serverless platform.

## Structure
- `/api/` - PHP serverless functions for backend logic
- `/auth/` - Authentication functionality (legacy)
- `/booking/` - Booking processing (legacy)
- `/config/` - Database configuration (legacy)
- `/contact/` - Contact form processing (legacy)
- `/images/` - Static image assets
- `/includes/` - Shared PHP components
- `*.html` - Frontend pages
- `style.css` - Main stylesheet
- `database.sql` - Database schema
- `vercel.json` - Vercel deployment configuration
- `.vercelignore` - Excludes files from Vercel deployment
- `.gitattributes` - Ensures proper line endings for files
- `vercel.php` - Helper file for Vercel PHP identification

## Language & Runtime
**Language**: PHP
**Version**: Compatible with Vercel PHP runtime 0.7.0
**Database**: MySQL
**Frontend**: HTML, CSS, JavaScript

## Dependencies
**Server Requirements**:
- PHP 7.4+ (Vercel PHP runtime 0.7.0)
- MySQL-compatible database

**External Services**:
- Cloud database (PlanetScale, Railway, or Supabase recommended)

## Database Schema
**Main Tables**:
- `users` - User account information
- `destinations` - Tourism destinations
- `hotels` - Accommodation options
- `activities` - Available activities
- `bookings` - User reservations
- `contact_messages` - Customer inquiries

## Build & Installation
**Local Development**:
```bash
# Import database schema
mysql -u root -p < database.sql

# Configure environment variables
cp .env.example .env.local
# Edit .env.local with your database credentials

# Run with PHP's built-in server
php -S localhost:8000
```

## Deployment
**Vercel Deployment**:
```bash
# Install Vercel CLI
npm i -g vercel

# Deploy to Vercel
vercel

# Configure environment variables in Vercel dashboard
# DB_HOST, DB_USER, DB_PASSWORD, DB_NAME
```

## Configuration
**Environment Variables**:
- `DB_HOST` - Database hostname
- `DB_USER` - Database username
- `DB_PASSWORD` - Database password
- `DB_NAME` - Database name (default: rudra_rides)

**Vercel Configuration**:
The project uses a specific Vercel configuration for PHP serverless functions:

```json
{
  "buildCommand": "echo 'No build step'",
  "outputDirectory": ".",
  "framework": null,
  "functions": {
    "api/**/*.php": {
      "runtime": "vercel-php@0.7.0"
    }
  },
  "routes": [
    { "src": "/api/(.*)\\.php", "dest": "/api/$1.php" },
    { "src": "/(.*)\\.html", "dest": "/$1.html" },
    { "src": "/(.*)\\.css", "dest": "/$1.css" },
    { "src": "/(.*)\\.js", "dest": "/$1.js" },
    { "src": "/images/(.*)", "dest": "/images/$1" },
    { "src": "/(.*)", "dest": "/index.html" }
  ]
}
```

## Troubleshooting Deployment
If you encounter the "invalid runtime" error during deployment:
1. Ensure your vercel.json uses the pattern `api/**/*.php` to catch all PHP files
2. Add `"buildCommand": "echo 'No build step'"` and `"outputDirectory": "."` to prevent build issues
3. Set `"framework": null` to ensure Vercel doesn't try to auto-detect the framework
4. Create a `.vercelignore` file to exclude unnecessary files
5. Create a `.gitattributes` file to ensure proper line endings for PHP files
6. Add a `vercel.php` file in the root directory to help identify the project as PHP
7. Verify all PHP files start with `<?php` tag
8. Check that environment variables are properly configured in Vercel dashboard

## Architecture
**Frontend**: Static HTML pages with CSS styling
**Backend**: PHP serverless functions
**Database**: MySQL-compatible cloud database
**Authentication**: Custom PHP authentication system
**API Endpoints**:
- `/api/auth/` - User registration and authentication
- `/api/booking/` - Booking processing
- `/api/contact/` - Contact form submission
- `/api/get_items.php` - Data retrieval