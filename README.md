# MyMenu - Monthly Meal Planner 🍽️

A modern, responsive web application for generating random monthly meal plans with smart meal distribution and dietary preference support.

![Version](https://img.shields.io/badge/version-2.0.0-blue)
![PHP](https://img.shields.io/badge/PHP-8.3-purple)
![License](https://img.shields.io/badge/license-MIT-green)

## Features ✨

- **91+ Meal Options** - Extensive database of meals including:
  - 32 Vegetarian options
  - 59 Meat-based dishes
  - International cuisine (Thai, Greek, Italian, Indian, etc.)
  - Weekend specials and treats
  
- **Smart Meal Distribution**
  - Weeknight meals (quick and easy)
  - Weekend specials (more elaborate)
  - Sunday roasts and takeaway options
  
- **Dietary Restrictions**
  - Vegetarian-only mode
  - Clear dietary badges
  - Visual category icons
  
- **Modern Design**
  - Dark theme with blue gradient accents
  - Fully responsive (mobile, tablet, desktop)
  - Font Awesome icons for meal categories
  - Color-coded badges
  
- **Individual Meal Regeneration**
  - Swap individual meals you don't like
  - Keep the rest of your menu intact
  - Quick refresh without reloading
  
- **Mobile-Optimized**
  - Card-based layout on small screens
  - Touch-friendly interface
  - Optimized for viewing on phones

## Quick Start 🚀

### Local Development

```bash
# Navigate to the menu directory
cd /var/www/html/menu

# Start PHP development server
php -S localhost:8080

# Open in browser
http://localhost:8080
```

### Docker Deployment

```bash
# Build the container
podman build -t mymenu:latest .

# Run the container
podman run -d -p 8080:8080 --name mymenu mymenu:latest

# Access the application
http://localhost:8080
```

## Usage 📖

1. **Select Month** - Choose the month you want to plan
2. **Choose Restrictions** - Select "No Restrictions" or "Vegetarian Only"
3. **Generate Menu** - Click "Generate Menu" to create your monthly plan
4. **Regenerate Meals** - Click the refresh icon on individual days to swap meals
5. **Print** - Use the print button for a fridge-friendly version

## Meal Categories 🍳

The application uses Font Awesome icons to represent different meal types:

- 🍗 **Chicken** - Poultry dishes
- 🍔 **Beef** - Beef and burgers
- 🥓 **Pork** - Pork, bacon, sausages
- 🐟 **Fish** - Fish and seafood
- 🥕 **Vegetarian** - Meat-free options
- 🥚 **Eggs** - Egg-based meals
- 🍕 **Treats** - Weekend takeaways and special meals

## Configuration ⚙️

### Adding New Meals

Edit `meals.json` to add new meal options:

```json
{
  "description": "Your Meal Name",
  "day": "0",
  "recipeBook": null,
  "page": null,
  "notes": null,
  "mainComponent": "Chicken",
  "image": null,
  "vegetarian": "N"
}
```

**Day values:**
- `"0"` - Any weekday
- `"1"` - Sunday (roasts)
- `"6"` - Saturday (special meals)
- `"7"` - Sunday (alternative)

**Main Components:**
- `Chicken`, `Beef`, `Minced Beef`, `Pork`, `Lamb`, `Fish`, `Prawn`, `Duck`, `Turkey`, `Vegetables`, `Eggs`, `Naughty`

**Vegetarian:**
- `"Y"` - Vegetarian
- `"N"` - Contains meat

## Technical Stack 💻

- **Backend:** PHP 8.3
- **Frontend:** HTML5, CSS3, JavaScript
- **Styling:** Custom CSS with gradient themes
- **Icons:** Font Awesome 6.4.0
- **Fonts:** Google Fonts (Poppins)
- **Container:** Red Hat UBI 9 with PHP 8.3

## File Structure 📁

```
menu/
├── index.php           # Main application
├── meals.json          # Meal database (91 meals)
├── images/             # Legacy images (deprecated)
├── Dockerfile          # Container build file
└── README.md           # This file
```

## Browser Support 🌐

- Chrome/Edge (latest)
- Firefox (latest)
- Safari (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Contributing 🤝

Contributions are welcome! To add more meals:

1. Fork the repository
2. Add meals to `meals.json`
3. Test with both dietary modes
4. Submit a pull request

## Roadmap 🗺️

- [ ] Save/load favorite menus
- [ ] Meal variety algorithm (avoid same protein 3+ days)
- [ ] Meal notes and ratings
- [ ] Shopping list generation
- [ ] Recipe integration

## Credits 👏

- Original concept by [boogiespook](https://github.com/boogiespook)
- Modernized by ChrisJ
- Icons by [Font Awesome](https://fontawesome.com)
- Fonts by [Google Fonts](https://fonts.google.com)

## License 📄

MIT License - feel free to use and modify for your own meal planning needs!

## Support 💬

For issues or suggestions:
- Create an issue on [GitHub](https://github.com/boogiespook/myMenu)
- Contact: [chrisj.co.uk](https://www.chrisj.co.uk)

---

Made with ❤️ and 🍕 by ChrisJ | &copy; 2026
