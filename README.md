

# **LibraryPlus - CodeIgniter PHP Project**

A library management system built with **CodeIgniter 3** and MySQL.

## **Prerequisites**
- **XAMPP** (Apache, MySQL, PHP)
- **CodeIgniter 3** (included in the project)
- Web browser (Chrome, Firefox, etc.)

---

## **Setup Instructions**

### **1. Clone the Repository**
```bash
git clone https://github.com/Dev-Bulama/libraryplus.git
cd libraryplus
```

### **2. Database Setup**
#### **Option A: Use Provided SQL File**
1. Import the database:
   - Open **phpMyAdmin** (`http://localhost/phpmyadmin`).
   - Create a new database: `libraryplus`.
   - Click **Import** and upload `u168376570_LibraryPlus(1).sql`.

#### **Option B: Use Default Credentials**
If you don't want to use the provided SQL, update `application/config/database.php` with:
```php
$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'root';    // Default XAMPP MySQL username
$db['default']['password'] = '';       // Default XAMPP MySQL password (empty)
$db['default']['database'] = 'libraryplus';
```

### **3. Configure XAMPP**
1. Place the project folder in:
   ```
   C:\xampp\htdocs\libraryplus
   ```
   (Or `/opt/lampp/htdocs/libraryplus` on Linux.)

2. Start **Apache** and **MySQL** in XAMPP.

### **4. Run the Application**
- Open your browser and visit:
  ```
  http://localhost/libraryplus
  ```

---

## **Default Login (If Using Provided SQL)**
- **Admin Login:**  
  - Username: `admin`  
  - Password: `admin123` *(Change this in production!)*

- **User Login:**  
  - Username: `user`  
  - Password: `user123`

---

## **Troubleshooting**
- **403 Forbidden?**  
  - Check if `.htaccess` is properly configured.
- **Database Connection Error?**  
  - Verify credentials in `database.php`.
  - Ensure MySQL is running in XAMPP.

---

## **Contributing**
1. Fork the repo.
2. Create a new branch (`git checkout -b feature/your-feature`).
3. Commit changes (`git commit -m "Add feature"`).
4. Push to the branch (`git push origin feature/your-feature`).
5. Open a **Pull Request**.

---

**Happy Coding!** 🚀  

*(Note: Always change default passwords in production!)*  

---

