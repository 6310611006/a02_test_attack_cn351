# test_attack_cn351

## setup
1.  Download XAMPP [https://www.apachefriends.org/download.html]
2.  สร้างโฟเดอใหม่ใน ที่เราติดตั้น XAMPP ใน window อยู่ที่ C:\xampp\htdocs\ สร้างโฟเดอใหม่ใน htdocs เเล้ว git clone
3.  เปิด XAMPP คลิก start Apache, MySQL
4.  คลิป admin ของ MySQL
5.  สร้าง Data Base ใหม่ชื่อ demo2
6.  สร้างตารางใหม่ด้วยคำสั่ง SQL

'''
CREATE TABLE users (
  id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL
);
'''
6.สร้างอีกตารางนึงสำหรับเก็บข้อความ
'''
CREATE TABLE messages (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
'''
7.เมื่่อสร้างเสร็จสามารถเข้าเว็ปไซต์เเละพัฒนาต่อได้ [http://localhost/(ชื่อไฟล์่ที่สร้างในC:\xampp\htdocs\ชื่อโฟเดอที่เก็บโค้ด)/login.php]
