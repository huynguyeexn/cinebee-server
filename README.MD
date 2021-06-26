## Đọc kỹ hướng dẫn sử dụng trước khi dùng

#### 🚨 Thao tác sau khi Pull code lần đầu

---

💾 Tạo DB tên **cinebee** có charset là **utf8mb4_unicode_ci**.

---

**🚧 Chạy lệnh theo thứ tự như sau👇**
composer install
php artisan key:generate
php artisan cache:clear
php artisan cache:clear
php artisan migrate --seed
php artisan serve

---

**🐙 Git cơ bản **

**🆕 Tạo brach mới**
git branch ten_branch

**🏃 Nhảy tới branch**
git checkout ten_branch

**📎Commit code **
git commit -a -m 'Mô tả commit update'

**🆙 Push code lên github**
git push origin ten_branch

**🧩 Merge branch**
(Ví dụ: Merge branch_con vào branch_cha)

// Check out tới branch_cha
git checkout branch_cha

// Merge branch_con vào
git merge branch_con

---

**🐾 Trình tự tạo module**
=> Model
=> Migrate
=> Seed, Factory (nếu cần)
=> Route
=> Controller
=> Resources
=> Form Validation

---

**Tu bi không tình yêu....😏**
