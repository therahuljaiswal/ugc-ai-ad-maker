# UGC AI Ad Maker

A modern, high-converting UGC (User Generated Content) ad making platform built with Laravel, MySQL, and Gemini AI.

## Features

- **AI Video Ad Scripting**: Generate professional video scripts with scene descriptions using Gemini AI.
- **Product Image Generation**: Create high-quality product images from simple prompts.
- **Multimodal Support**: Upload reference images of your products for the AI to analyze and incorporate into the scripts.
- **Modern UI**: Dark-themed, professional aesthetic using Tailwind CSS and Blade.
- **Credit System**: Integrated credit management for ad and image generation.
- **Razorpay Integration**: Buy credits seamlessly through Razorpay.
- **Admin Dashboard**: Manage users, block/unblock accounts, set API keys, and manage prompt presets.
- **User Dashboard**: Track your creations, manage credits, and download your scripts.

## Setup Instructions

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL
- Gemini API Key

### Local Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd <repository-directory>
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install and build frontend assets**
   ```bash
   npm install
   npm run build
   ```

4. **Environment Configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Edit the `.env` file and configure your database, mail, and Razorpay credentials.*

5. **Run Migrations & Seeders**
   ```bash
   php artisan migrate --seed
   ```
   *The seeder creates a default admin account and preset prompts.*

6. **Link Storage**
   ```bash
   php artisan storage:link
   ```

7. **Configure Gemini API Key**
   - Log in as admin (Default: admin@example.com / password)
   - Go to **Admin Dashboard > Settings**
   - Save your Gemini API Key.

8. **Start the Development Server**
   ```bash
   php artisan serve
   ```

## Usage

1. **Register** a new account (you'll get free starter credits).
2. **UGC Ad Tool**: Choose a size (9:16, 16:9, 1:1), select a preset or custom prompt, and optionally upload product images.
3. **Image Generator**: Describe your product or upload a photo to generate a professional studio shot.
4. **Gallery**: View and manage all your generated ads and images.

## License

This project is licensed under the MIT License.
