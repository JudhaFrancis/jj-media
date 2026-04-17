# AI Agent Instructions: PHP + Tailwind Starter

This project is a clean boilerplate for a PHP-based web application.

## 🏗️ Architecture
- **Routing**: Handled dynamically in `index.php`. Any file added to `pages/*.php` is accessible via its filename (e.g., `/contact` loads `pages/contact.php`).
- **Styling**: Tailwind CSS. Edit `src/input.css` and run `npm run dev`.
- **Layout**: Shared layouts are in `include/header.php` and `include/footer.php`.

## 🤖 Guidelines for AI Agents
1. **Adding Pages**: Simply create a new `.php` file in the `pages/` directory. No need to modify routing tables.
2. **Metadata**: Each page can override `$pageTitle` and `$pageDescription` if defined before `include("include/header.php")`.
3. **Responsive Design**: Use Tailwind's `md:`, `lg:` prefixes consistently.
4. **Clean Slate**: This project has no JJ Media specific branding. Keep it generic unless the user specifies otherwise.
