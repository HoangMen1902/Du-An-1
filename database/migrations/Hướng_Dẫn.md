Hướng dẫn tạo - sửa - viết migrate

Bước 1: Chạy lệnh "composer phinx-create <Tên Migration VD: TestTable>"

* Lưu ý: Tên migration cần phải viết chữ in hoa chứ không phải là: testTable hay là testtable, Testtable
 (Để dễ đọc vào tránh lỗi cú pháp)


Bước 2:Vào file migration vừa tạo và viết theo cú pháp có sẵn ở các bản trước

Bước 3: Sau khi đã viết xong, chạy lệnh "composer phinx-migrate"

Bước 4: Nếu viết sai gì đó mà đã lỡ chạy lênh migrate thì có thể dùng lệnh để rollback
"composer phinx-rollback -t 0"

* Lưu ý: Thay số "0" thành số ở đầu tên file migration, ví dụ tên file là "20241104174304_districts_table.php" thì lệnh sẽ ghi "20241104174304" thay vào.

* 0 là giá trị mặc định, nếu muốn reset lại thì dùng số 0