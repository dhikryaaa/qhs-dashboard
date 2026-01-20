# UBS QHSE Dashboard - Coding Standards

## Project Overview

Laravel 10.x web application for Quality, Health, Safety, and Environment reporting with giant kiosk UI design.

## Code Style & Standards

### 1. DRY (Don't Repeat Yourself)

✅ **Implemented:**

- Centralized CSS variables in `/public/css/variables.css`
- All layout files import shared variables
- Reusable utility classes for colors, spacing, typography

❌ **Avoid:**

- Duplicating color hex codes across files
- Repeating the same CSS rules in multiple stylesheets
- Copying entire code blocks when inheritance is possible

### 2. CSS Architecture

#### File Structure

```
public/
└── css/
    └── variables.css    # Global CSS variables & utilities
resources/
└── views/
    ├── layouts/
    │   ├── app.blade.php        # Home page layout (with background)
    │   └── dashboard.blade.php  # Dashboard layout (sidebar)
    └── auth/
        └── login.blade.php      # Login page
```

#### CSS Variable Naming Convention

```css
/* Pattern: --[namespace]-[category]-[name] */
--ubs-blue: #124477; /* Brand colors */
--ubs-font-family: "Poppins"; /* Typography */
--color-success: var(--ubs-green); /* Semantic colors */
```

#### Utility Class Naming

```css
/* Pattern: .[prefix]-[property]-[value] */
.bg-ubs-blue     /* Background color */
.text-ubs-dark   /* Text color */
.border-ubs-blue /* Border color */
```

### 3. Laravel Best Practices

#### Blade Templates

✅ **Do:**

- Use `@extends` and `@section` for layout inheritance
- Always use `{{ }}` for escaping output (XSS protection)
- Use `{{ asset('path') }}` for static assets
- Use `{{ route('name') }}` instead of hardcoded URLs

❌ **Don't:**

- Use `{!! !!}` unless absolutely necessary (unescaped)
- Hardcode URLs like `href="/login"`
- Put business logic in views

#### Asset Management

✅ **Current Structure:**

```
public/
├── css/
│   └── variables.css
└── img/
    ├── hse-logo-yellow.png
    ├── login-bg-smoke.jpg
    └── ubs-logo.png
```

### 4. Responsive Design Standards

#### Breakpoints

```css
/* Mobile First Approach */
@media (max-width: 991px) /* Tablet */ @media (max-width: 1500px); /* Small desktop */
/* Default styles for desktop 1920px+ */
```

#### Standard Dimensions (100% Zoom)

- **Dashboard Sidebar:** 260px fixed width
- **Login Card:** 381px × 465px
- **Header Height:** 90px (HRIS), 34px (Secondary Nav)
- **Logo Height:** 60px (sidebar), 42px (header), 80px (login)
- **Font Sizes:** 12px (labels), 14px (body), 16px (nav), 20px (headings)

### 5. Color Palette

#### Primary Colors

- **UBS Blue:** `#124477` - Main brand color
- **Dark Blue:** `#08205F` - Secondary brand
- **Bright Blue:** `#2090E0` - Accents & CTAs

#### Neutral Colors

- **Dark Grey:** `#344054` - Text & borders
- **Light Grey:** `#EAECF0` - Borders
- **Lighter Grey:** `#F2F4F7` - Backgrounds
- **Background Grey:** `#F9FAFB` - Page backgrounds

#### Semantic Colors

- **Success:** `#90BE6D` (Green)
- **Warning:** `#F9C74F` (Yellow)
- **Danger:** `#F94144` (Red)
- **Info:** `#2090E0` (Bright Blue)

### 6. Typography

#### Font Families

- **Primary:** Poppins (body text, headings)
- **Secondary:** Public Sans (sidebar navigation)

#### Font Weights

- **Regular:** 400 (body text)
- **Medium:** 500 (labels)
- **Semi-Bold:** 600 (emphasis)
- **Bold:** 700 (headings, buttons)

### 7. Code Organization

#### Component Structure

```php
<!-- 1. External CSS/JS -->
<link rel="stylesheet" href="...">

<!-- 2. Shared Variables -->
<link rel="stylesheet" href="{{ asset('css/variables.css') }}">

<!-- 3. Component-specific styles -->
<style>
  /* Only styles unique to this component */
</style>

<!-- 4. HTML Structure -->
<div class="component">...</div>

<!-- 5. Scripts -->
<script>...</script>
```

### 8. Git Commit Standards

#### Commit Message Format

```
<type>: <subject>

<body>
```

#### Types

- `feat:` New feature
- `fix:` Bug fix
- `refactor:` Code refactoring
- `style:` CSS/UI changes
- `docs:` Documentation
- `chore:` Maintenance tasks

#### Examples

```bash
git commit -m "refactor: centralize CSS variables for DRY principle"
git commit -m "fix: remove white margin on login page"
git commit -m "style: scale down dashboard to standard 100% zoom"
```

### 9. Security Best Practices

✅ **Implemented:**

- CSRF protection on all forms (`@csrf`)
- Laravel Sanctum for API authentication
- XSS protection via Blade escaping `{{ }}`
- Environment variables for sensitive data (`.env`)

❌ **Never:**

- Commit `.env` file to git
- Store passwords in plain text
- Trust user input without validation
- Use `{!! !!}` for user-generated content

### 10. Performance Considerations

✅ **Optimizations:**

- Use CDN for external libraries (Bootstrap, Icons)
- Minimal inline styles (only component-specific)
- `overflow: hidden` to prevent layout shifts
- Fixed dimensions for predictable rendering

❌ **Avoid:**

- Importing entire icon libraries when only using few icons
- Large unoptimized background images
- Deep nesting (> 4 levels) in CSS selectors
- `!important` flags (use sparingly)

## File Naming Conventions

### Blade Templates

- **Layouts:** `kebab-case.blade.php` (e.g., `dashboard.blade.php`)
- **Partials:** `_kebab-case.blade.php` (e.g., `_sidebar.blade.php`)
- **Components:** `kebab-case.blade.php` in `components/` folder

### CSS Files

- **Global:** `variables.css`, `utilities.css`
- **Component:** `component-name.css`

### Images

- **Format:** `descriptive-name.jpg/png/svg`
- **Examples:** `login-bg-smoke.jpg`, `hse-logo-yellow.png`

## Testing Standards

### Browser Compatibility

- Chrome 90+ ✅
- Firefox 88+ ✅
- Edge 90+ ✅
- Safari 14+ ⚠️ (Test required)

### Resolution Testing

- **Primary:** 1920×1080 (100% zoom)
- **Secondary:** 1366×768, 2560×1440
- **Mobile:** 375×667 (responsive fallback)

## Maintenance Checklist

### Before Committing

- [ ] Remove console.log() statements
- [ ] Check for duplicate code (DRY violation)
- [ ] Test on 100% browser zoom
- [ ] Validate all form inputs work
- [ ] Check responsive breakpoints
- [ ] Run `php artisan serve` successfully

### Code Review Focus

- [ ] No hardcoded values (use CSS variables)
- [ ] Consistent naming conventions
- [ ] Proper indentation (4 spaces)
- [ ] Comments for complex logic
- [ ] No sensitive data exposed

## Resources

### Documentation

- [Laravel 10.x Docs](https://laravel.com/docs/10.x)
- [Bootstrap 5.3 Docs](https://getbootstrap.com/docs/5.3)
- [Bootstrap Icons](https://icons.getbootstrap.com/)

### Design System

- Figma File: [Ask team lead for access]
- Color Palette: See `/public/css/variables.css`
- Typography Scale: Poppins 12/14/16/20px

---

**Last Updated:** January 21, 2026  
**Maintainer:** Development Team  
**Version:** 1.0.0
