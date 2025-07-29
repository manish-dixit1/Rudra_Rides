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
The project uses Vercel's version 2 configuration format with explicit builds for each PHP file:

```json
{
  "version": 2,
  "builds": [
    { "src": "api/auth/login.php", "use": "vercel-php@0.7.0" },
    { "src": "api/auth/logout.php", "use": "vercel-php@0.7.0" },
    { "src": "api/auth/register.php", "use": "vercel-php@0.7.0" },
    { "src": "api/booking/procees_booking_activities.php", "use": "vercel-php@0.7.0" },
    { "src": "api/booking/process_booking.php", "use": "vercel-php@0.7.0" },
    { "src": "api/contact/process_contact.php", "use": "vercel-php@0.7.0" },
    { "src": "api/get_items.php", "use": "vercel-php@0.7.0" },
    { "src": "api/process_activity_booking.php", "use": "vercel-php@0.7.0" },
    { "src": "api/process_contact.php", "use": "vercel-php@0.7.0" },
    { "src": "*.html", "use": "@vercel/static" },
    { "src": "*.css", "use": "@vercel/static" },
    { "src": "*.js", "use": "@vercel/static" },
    { "src": "images/*", "use": "@vercel/static" }
  ],
  "routes": [
    { "src": "/api/auth/(.*)", "dest": "/api/auth/$1" },
    { "src": "/api/booking/(.*)", "dest": "/api/booking/$1" },
    { "src": "/api/contact/(.*)", "dest": "/api/contact/$1" },
    { "src": "/api/(.*)", "dest": "/api/$1" },
    { "src": "/(.*)", "dest": "/$1" }
  ]
}
```

## Troubleshooting Deployment
If you encounter the "invalid runtime" error during deployment:
1. Use Vercel's version 2 configuration format with explicit `builds` array
2. Specify each PHP file individually with `"use": "vercel-php@0.7.0"`
3. Define static assets with `"use": "@vercel/static"`
4. Create proper routing rules for each API endpoint
5. Create a `.vercelignore` file to exclude unnecessary files
6. Create a `.gitattributes` file to ensure proper line endings for PHP files
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