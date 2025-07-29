# Vercel Deployment Guide for Rudra Rides

## ✅ Current Status
Your project has been configured for Vercel deployment with the following changes:

### Fixed Issues:
1. ✅ **Updated vercel.json** - Fixed PHP runtime and routing configuration
2. ✅ **Restructured PHP files** - Moved all PHP files to `/api` directory
3. ✅ **Updated file paths** - Fixed all require_once statements to use absolute paths
4. ✅ **Environment variables** - Database configuration now uses environment variables
5. ✅ **Updated HTML forms** - Form actions now point to correct API endpoints

## 🚀 Deployment Steps

### 1. Set up a Cloud Database
Since Vercel doesn't support traditional MySQL, you need a cloud database:

**Recommended Options:**
- **PlanetScale** (MySQL-compatible, free tier available)
- **Railway** (MySQL/PostgreSQL, free tier available)
- **Supabase** (PostgreSQL, free tier available)

### 2. Import Your Database
Upload your `database.sql` file to your chosen cloud database provider.

### 3. Configure Environment Variables in Vercel
In your Vercel dashboard, add these environment variables:
```
DB_HOST=your-database-host
DB_USER=your-database-username  
DB_PASSWORD=your-database-password
DB_NAME=rudra_rides
```

### 4. Deploy to Vercel
```bash
# Install Vercel CLI (if not already installed)
npm i -g vercel

# Deploy
vercel

# Follow the prompts to link your project
```

## 📁 New File Structure
```
/
├── api/                    # All PHP files (serverless functions)
│   ├── auth/
│   │   ├── login.php
│   │   ├── logout.php
│   │   └── register.php
│   ├── booking/
│   │   ├── process_booking.php
│   │   └── procees_booking_activities.php
│   ├── contact/
│   │   └── process_contact.php
│   ├── config/
│   │   └── db.php
│   ├── get_items.php
│   ├── process_activity_booking.php
│   └── process_contact.php
├── images/                 # Static assets
├── *.html                  # Frontend files
├── style.css              # Styles
├── vercel.json            # Vercel configuration
└── database.sql           # Database schema
```

## 🔧 What Was Changed

### vercel.json
- Updated PHP runtime to `vercel-php@0.7.0`
- Fixed function patterns to handle subdirectories
- Added proper routing for different API endpoints

### Database Configuration
- Added environment variable support
- Maintained localhost fallback for local development
- Uses both `$_ENV` and `getenv()` for compatibility

### File Paths
- All `require_once` statements now use `__DIR__` for absolute paths
- HTML form actions updated to point to `/api/` endpoints
- Redirect URLs updated to use absolute paths

## 🧪 Testing Locally
1. Make sure your local MySQL server is running
2. Import `database.sql` to your local database
3. Test the application locally before deploying

## 📝 Notes
- The original PHP files in `/auth`, `/booking`, `/contact` directories are still there as backups
- You can remove them after successful deployment
- Make sure to test all functionality after deployment