# 🦁 ASSAD - Virtual Zoo for AFCON 2025 (Version 2)

## 📋 Project Description
ASSAD V2 is the enhanced version of our virtual zoo platform for the 2025 Africa Cup of Nations (AFCON) in Morocco. This version introduces OOP architecture while maintaining all V1 features with improved performance and security.

## 🔄 What's New in V2
- **OOP Architecture**: Rewritten with proper classes and methods
- **Better Security**: Added CSRF protection and improved validation
- **Enhanced Performance**: Optimized database queries and caching
- **Cleaner Code**: Organized structure with separation of concerns

## 🎯 Main Objectives
- Promote African wildlife, especially the Atlas lions
- Provide interactive educational experience for visitors
- Facilitate management of virtual guided tours
- Provide statistics on animal conservation

## ✨ Key Features

### 🔐 Security & Authentication (Enhanced)
- Role-based access control (Visitor, Guide, Administrator)
- Secure password hashing with bcrypt
- Server-side validation with Regex patterns
- CSRF protection on all forms

### 🦁 Animal Exploration
- Comprehensive animal database with images
- Special featured profile "Asaad – Atlas Lion"
- Filter animals by habitat and African country
- Interactive gallery showcasing African wildlife

### 🧭 Virtual Tour System
- Guided tour creation and management
- Tour booking system with capacity checking
- Multi-step tour itineraries
- Tour search and filtering

### 📊 Administration
- Complete CRUD for animals and habitats
- User management with approval system
- Statistics and analytics dashboard
- Content management system

## 👥 User Roles

### 👤 Visitor
- Browse animal profiles
- Search and book guided tours
- View "Asaad – Atlas Lion" profile
- Leave reviews and ratings

### 🧭 Guide
- Create, edit, and cancel guided tours
- Manage tour steps and itineraries
- View tour reservations
- Wait for admin approval

### 🧑‍💻 Administrator
- Manage users (activate/deactivate)
- Approve guide accounts
- Full CRUD for animals and habitats
- View system statistics

## 🗄️ Database Structure

### Main Tables

### **👥 users**
| Column | Type | Description |
|--------|------|-------------|
| `id` | INT AUTO_INCREMENT PRIMARY KEY | Unique user identifier |
| `name` | VARCHAR(30) NOT NULL | User's full name |
| `email` | VARCHAR(255) UNIQUE NOT NULL | Email address (unique) |
| `role` | ENUM('admin','visiter','guide') NOT NULL | User role |
| `password` | VARCHAR(255) NOT NULL | Hashed password |
| `is_active` | BOOL DEFAULT FALSE | Account activation status |
| `is_approved` | BOOL DEFAULT FALSE | Guide approval status |
| `created_at` | DATETIME DEFAULT CURRENT_TIMESTAMP | Account creation timestamp |

### **🦁 animals**
| Column | Type | Description |
|--------|------|-------------|
| `id` | INT AUTO_INCREMENT PRIMARY KEY | Unique animal identifier |
| `name` | VARCHAR(30) NOT NULL | Animal name |
| `species` | VARCHAR(100) NOT NULL | Scientific species name |
| `diet_type` | ENUM('CARNIVORE','HERBIVORE','OMNIVORE') | Dietary classification |
| `image` | TEXT NOT NULL | Image file path |
| `short_description` | VARCHAR(255) | Brief description |
| `id_habitat` | INT | Foreign key to habitats |

### **🏞️ habitats**
| Column | Type | Description |
|--------|------|-------------|
| `id` | INT AUTO_INCREMENT PRIMARY KEY | Unique habitat identifier |
| `name` | VARCHAR(100) NOT NULL | Habitat name |
| `description` | TEXT | Detailed description |
| `zoo_zone` | ENUM('AFRICAN_ZONE','SAVANNA_AREA','BIG_CATS_ZONE','REPTILE_HOUSE','BIRDS_ZONE','AQUATIC_ZONE') | Zoo zone classification |

### **🗺️ guided_tours**
| Column | Type | Description |
|--------|------|-------------|
| `id` | INT AUTO_INCREMENT PRIMARY KEY | Unique tour identifier |
| `title` | VARCHAR(100) NOT NULL | Tour title |
| `description` | TEXT | Detailed description |
| `start_datetime` | DATETIME NOT NULL | Tour start date/time |
| `duration` | INT NOT NULL | Duration in minutes |
| `price` | FLOAT NOT NULL | Price per person |
| `language` | VARCHAR(20) NOT NULL | Tour language |
| `capacity_max` | INT NOT NULL | Maximum participants |
| `status` | ENUM("available", "not available") DEFAULT "available" | Availability status |
| `id_guide` | INT | Foreign key to users (guide) |

### **📝 tour_steps**
| Column | Type | Description |
|--------|------|-------------|
| `id` | INT AUTO_INCREMENT PRIMARY KEY | Unique step identifier |
| `title` | VARCHAR(100) NOT NULL | Step title |
| `description` | TEXT | Step description |
| `step_order` | INT NOT NULL | Sequential order |
| `id_visit` | INT | Foreign key to guided_tours |

### **📅 reservations**
| Column | Type | Description |
|--------|------|-------------|
| `id` | INT AUTO_INCREMENT PRIMARY KEY | Unique reservation identifier |
| `number_of_people` | INT NOT NULL | Number of participants |
| `id_visiter` | INT | Foreign key to users (visitor) |
| `id_visit` | INT | Foreign key to guided_tours |

### **💬 comments**
| Column | Type | Description |
|--------|------|-------------|
| `id` | INT AUTO_INCREMENT PRIMARY KEY | Unique comment identifier |
| `comment_text` | TEXT | Comment content |
| `comment_date` | DATETIME DEFAULT CURRENT_TIMESTAMP | Comment timestamp |
| `rating` | INT NOT NULL CHECK(rating BETWEEN 1 and 5) | Rating (1-5 stars) |
| `id_visiter` | INT | Foreign key to users (visitor) |
| `id_visit` | INT | Foreign key to guided_tours |

## 🛠️ Technical Requirements (V2)

### Backend Implementation
- Object-Oriented PHP with PDO
- Repository pattern for database access
- Service classes for business logic
- Middleware for authentication
- Proper error handling and logging

### Frontend Implementation
- Responsive Tailwind CSS design
- Interactive JavaScript components
- Form validation and feedback
- Image gallery and carousels

## 📅 Project Timeline
- **Version**: 2.0
- **Status**: Complete
- **Last Updated**: December 2024

## 🚀 Getting Started
1. Clone the repository
2. Import `database/schema.sql`
3. Configure database connection
4. Access via web server

## 👍 Author
**Fadi Insaf** – [GitHub](https://github.com/fadiinsaf) | [Email](mailto:fadiinafff@gmail.com)

---
*ASSAD V2 - Enhanced zoo experience for AFCON 2025* 🦁