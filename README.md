# ✨ Femzykentltd Wears Landing Theme

A premium, conversion-focused **WordPress landing-page theme** built for **Femzykentltd Wears**, designed to showcase luxury men’s footwear with a clean sales funnel, editable product catalog, and built-in order capture.

![WordPress](https://img.shields.io/badge/Platform-WordPress-21759B?style=for-the-badge&logo=wordpress&logoColor=white)
![Theme Type](https://img.shields.io/badge/Theme-Landing%20Page%20Theme-111827?style=for-the-badge)
![Status](https://img.shields.io/badge/Status-Launch%20Ready-success?style=for-the-badge)
![Design](https://img.shields.io/badge/Style-Premium%20%26%20Minimal-D4AF37?style=for-the-badge)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

---

## 📸 Preview

Theme preview image:

- `screenshot.png`

Bundled shoe image mapping and planning docs:

- `docs/SHOE-MAP.md`
- `docs/REBUILD-PLAN.md`

---

## 🎯 About The Project

**Femzykentltd Wears Landing Theme** was built as a premium WordPress theme for a footwear sales funnel that needs to feel:

- simple
- luxurious
- mobile-friendly
- conversion-focused
- easy to edit without a page builder

The theme keeps the structure of a strong direct-response landing page while making every major section editable inside WordPress.

It is ideal for:

- pay-on-delivery offers
- Facebook / Instagram ad traffic
- WhatsApp-assisted order confirmation
- premium footwear campaigns
- future migration into a full WooCommerce store

---

## ✨ Features

### Landing Page Experience

- ✅ Premium text-first header design
- ✅ Luxury hero section with real bundled product visuals
- ✅ High-converting CTA structure
- ✅ Clean premium product grid
- ✅ Special offer section
- ✅ Guarantee and trust sections
- ✅ Premium order form
- ✅ Mobile sticky CTA bar

### Product Management

- 👞 Custom **Shoes** post type
- 🧾 Editable shoe code, title, price, sizes, badge, and description
- 🖼️ Bundled demo shoe images included in theme
- 🔁 Featured image can override bundled fallback image anytime
- 🔢 Shoe codes use plain numbers like `1`, `2`, `26`, `38`

### Order Flow

- 📥 Built-in front-end order form
- 📋 Custom **Orders** post type in WordPress admin
- 📝 Editable order details inside WordPress admin, including delivery address
- 📧 Orders emailed to support email
- ☎️ Phone and WhatsApp-friendly sales flow
- ✅ Thank-you page after submission

### Extra Pages Included

- 🎉 Thank You Page
- 🔒 Privacy Policy
- 📜 Terms & Conditions
- 🚚 Delivery & Returns
- 📞 Contact Page

### Editing & Customization

- ⚙️ Theme settings under **Appearance → Femzykentltd Wears Settings**
- 📝 Editable support phone, support email, WhatsApp links, CTA text, and page copy
- 🎨 Premium styling without needing a logo upload

---

## 🛠️ Tech Stack

### Core

- **WordPress Theme Development**
- **PHP**
- **HTML5**
- **CSS3**
- **Vanilla JavaScript**

### Applications Used

- **Visual Studio Code** — code editing and project management
- **PowerShell** — local terminal / Git commands
- **LocalWP (Local WordPress)** — local WordPress development and preview environment
- **Git** — version control and GitHub publishing

### Architecture

- Custom Post Types
- Theme Options / Editable Content
- Fallback Asset Loading
- Landing-Page-First Structure
- Manual Order Capture Flow

---

## 📁 Project Structure

```text
trend-wears-landing/
│
├── style.css                       # Theme header and registration
├── functions.php                   # Theme logic, CPTs, options, order handling
├── header.php                      # Premium header
├── footer.php                      # Premium footer + final CTA + mobile CTA
├── front-page.php                  # Front page loader
├── index.php                       # Default fallback template
├── page.php                        # Standard page template
├── single.php                      # Single shoe fallback display
├── template-landing.php            # Landing page template
├── template-thank-you.php          # Thank-you page template
├── template-info-page.php          # Privacy / Terms / Delivery template
├── template-contact-page.php       # Contact page template
├── README.md                       # GitHub-ready project documentation
├── README.txt                      # Quick theme usage notes
├── screenshot.png                  # Theme preview image
│
├── assets/
│   ├── css/
│   │   └── main.css                # Main design system and responsive styling
│   ├── js/
│   │   └── main.js                 # Front-end interactivity
│   └── demo-shoes/
│       ├── shoe-01.jpeg
│       ├── shoe-02.jpeg
│       └── ...                     # Bundled fallback product images
│
└── template-parts/
    └── landing.php                 # Landing page sections
```

---

## 🚀 Getting Started

### Prerequisites

- WordPress installed on your server or local environment
- Admin access to the WordPress dashboard

## 📦 Download Theme ZIP

Installable WordPress theme package:

- [Download `trend-wears-landing-theme.zip`](./downloads/trend-wears-landing-theme.zip)

### How to use
1. Download the ZIP file
2. Go to **WordPress Admin → Appearance → Themes**
3. Click **Add New**
4. Click **Upload Theme**
5. Upload `trend-wears-landing-theme.zip`
6. Activate the theme

### Installation

1. Upload the theme ZIP in WordPress:

   **Appearance → Themes → Add New → Upload Theme**

2. Upload:

   `trend-wears-landing-theme.zip`

3. Activate the theme.

4. Go to:

   **Appearance → Femzykentltd Wears Settings**

5. Update your editable theme details.

---

## ⚙️ What Becomes Editable After Activation

### In Theme Settings

You can edit:

- Brand name
- Support phone
- Support email
- WhatsApp URL
- Thank-you WhatsApp URL
- Hero text
- CTA text
- Hero featured shoe codes
- Hero support copy and product section copy
- Quantity help text
- Final CTA text
- Footer text
- Disclaimers

### In Shoes

Go to **WordPress Admin → Shoes** and edit:

- Shoe title
- Shoe code
- Price
- Old price
- Badge
- Sizes
- Short description
- Featured image

### In Orders

Go to **WordPress Admin → Orders** and edit:

- customer name
- phone number
- shoe code
- size
- quantity
- email
- delivery address
- source URL

### In Pages

You can also edit content on:

- Thank You
- Privacy Policy
- Terms & Conditions
- Delivery & Returns
- Contact

---

## 📦 Bundled Shoe Image System

This theme includes bundled fallback shoe images inside:

```text
assets/demo-shoes/
```

How it works:

- If a shoe post has no featured image, the theme loads its matching bundled image.
- If you set a featured image manually, that featured image takes priority.

This makes first launch faster while keeping everything editable later.

---

## 📲 Order Flow

1. Customer visits landing page
2. Customer clicks **ORDER NOW** on a shoe
3. Shoe code is inserted into the premium order form
4. Customer submits details
5. Submission is stored in **Orders**
6. Support email receives the order
7. Customer is redirected to the **Thank You Page**

---

## 🎨 Design Direction

This theme was styled to feel:

- premium but uncluttered
- dark and luxurious in hero / footer sections
- clean and bright in product and form sections
- high-converting on mobile
- strong enough for paid traffic landing pages

---

## 🗺️ Roadmap

- [ ] WooCommerce product mapping
- [ ] Direct checkout integration
- [ ] WhatsApp prefilled order messages
- [ ] Product filtering / search
- [ ] Campaign-specific landing variants
- [ ] Dynamic review/testimonial management
- [ ] Analytics event optimization

---

## 🤝 GitHub / Deployment Notes

This project is structured so it can be pushed directly to GitHub as a standalone WordPress theme repository.

Recommended repository contents:

- the `trend-wears-landing` theme folder
- `README.md`
- `LICENSE`
- `.gitignore`
- optional planning docs and screenshots

---

## 📝 License

This project is licensed under the **MIT License** — see the `LICENSE` file for details.

---

## 👨‍💻 Prepared For

**Femzykentltd Wears**

Premium footwear landing-page system for WordPress.

---

## ⭐ Show Your Support

If this theme helps your project, give the repository a ⭐ on GitHub.

<div align="center">

**Built for premium product conversion on WordPress**

</div>
