# Laravel Admin Panel UI

A modern, responsive Laravel admin panel built with Tailwind CSS featuring a custom red color theme.

## Features

- **Responsive Design**: Works perfectly on desktop, tablet, and mobile devices
- **Custom Color Theme**: Red-based color scheme with proper contrast
- **Modern UI Components**: Cards, buttons, forms, alerts, and tables
- **Collapsible Sidebar**: Mobile-friendly navigation with overlay
- **Search Functionality**: Built-in search bars and filters
- **User Management**: Complete user management interface
- **Product Management**: Product catalog with inventory tracking
- **Order Management**: Order tracking and status management
- **Settings Panel**: Comprehensive application settings

## Color Theme

- **Primary Color**: #ff2d20 (Red)
- **Sidebar Background**: #ff2d201a (Light red with transparency)
- **Sidebar Text**: #333333 (Dark gray)
- **Hover Effects**: Red with transparency
- **Active States**: Full red (#ff2d20)
- **Button Hover**: #e62b1d (Darker red)

## Components

### Layout Components
- `layouts/admin.blade.php` - Main admin layout with sidebar and navbar
- Responsive sidebar with mobile overlay
- Top navigation with search and user menu

### Reusable Components
- `components/admin/alert.blade.php` - Alert messages with different types
- `components/admin/button.blade.php` - Styled buttons with variants
- `components/admin/card.blade.php` - Card containers with header/footer
- `components/admin/input.blade.php` - Form input fields
- `components/admin/select.blade.php` - Dropdown select fields
- `components/admin/textarea.blade.php` - Textarea fields

### Page Views
- `admin/dashboard.blade.php` - Main dashboard with stats and recent orders
- `admin/users/index.blade.php` - User management with filters and table
- `admin/users/create.blade.php` - User creation form
- `admin/products/index.blade.php` - Product management with inventory
- `admin/orders/index.blade.php` - Order management and tracking
- `admin/settings.blade.php` - Application settings panel

## Installation

1. Copy the view files to your Laravel project's `resources/views` directory
2. Update your routes in `routes/web.php` to include the admin routes
3. Ensure Tailwind CSS is properly configured in your Laravel project
4. The layout uses CDN for Tailwind CSS and Heroicons for icons

## Usage

### Accessing the Admin Panel

Visit `/admin/dashboard` to access the main dashboard.

### Navigation

- **Dashboard**: Overview with statistics and recent activity
- **Users**: Manage users, roles, and permissions
- **Products**: Product catalog and inventory management
- **Orders**: Order tracking and status management
- **Settings**: Application configuration

### Responsive Behavior

- **Desktop**: Full sidebar always visible
- **Tablet/Mobile**: Collapsible sidebar with overlay
- **Mobile Menu**: Hamburger menu button toggles sidebar

## Customization

### Colors
The color theme is defined in the main layout file using CSS custom properties. You can easily modify the colors by updating the CSS variables.

### Components
All components are built with Tailwind CSS classes and can be easily customized by modifying the class names or adding additional styling.

### Layout
The layout is fully responsive and can be customized by modifying the grid classes and breakpoints in the Blade templates.

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Dependencies

- Laravel 8+
- Tailwind CSS 3+
- Heroicons (for icons)
- Modern browsers with CSS Grid and Flexbox support

## License

This admin panel UI is open-sourced software licensed under the MIT license.