# Quy ước dự án hệ thống bán hàng

Tài liệu này ghi lại các quy tắc bắt buộc khi phát triển dự án để đảm bảo toàn bộ code thống nhất, dễ bảo trì và phù hợp với định hướng kỹ thuật của hệ thống.

## 1. Stack chốt

- Laravel 12
- Blade Template
- MySQL qua XAMPP
- Bootstrap 5
- Alpine.js
- Laravel Reverb
- Laravel Echo
- Laravel Queue dùng `database`
- Laravel Notification dùng `database` + `broadcast`
- Icon: Bootstrap Icons hoặc Tabler Icons

## 2. Quy ước đặt tên

### Không dùng
- `product`
- `category`
- `order`
- `customer`
- `notification`
- `setting`
- `report`

### Nên dùng
- `sanpham`
- `danhmuc`
- `donhang`
- `khachhang`
- `thongbao`
- `baocao`
- `caidat`
- `doanhthu`
- `phieunhap`
- `nhacungcap`

## 3. Quy tắc tổ chức code

- `Controller` chỉ nhận request, gọi `Service`, trả view hoặc redirect.
- `Service` xử lý nghiệp vụ.
- `Repository` xử lý truy vấn.
- Mọi tên file, class, route, biến cần thống nhất theo tiếng Việt không dấu.
- Tách rõ khu vực `Quantri` và `Website`.

## 4. Database

- Giá tiền lưu dạng số trong database.
- Dùng helper `dinh_dang_tien()` để hiển thị tiền Việt Nam.
- Validation phải dùng thông báo tiếng Việt rõ ràng.

## 5. Realtime

- Ưu tiên realtime cho đơn hàng và thông báo.
- Dùng event + notification + broadcast theo chuẩn Laravel.
- Phát thông báo realtime nên đi qua queue.

## 6. UI/UX

- Giao diện admin phải sạch, dễ đọc, ít màu mè.
- Ưu tiên nền sáng, card trắng, border mảnh, badge trạng thái rõ.
- Sidebar, header, modal, table, button cần đồng nhất kích thước và spacing.

## 7. Trình tự làm việc cho mỗi module

1. Migration
2. Model
3. Seeder nếu cần
4. Repository
5. Service
6. Request Validation
7. Controller
8. Route
9. Blade View
10. Component dùng lại
11. JavaScript xử lý UI
12. Toast / Loading / Empty state
13. Realtime nếu cần
14. Test thủ công

## 8. Lưu ý khi phát triển

- Luôn đối chiếu với tài liệu này trước khi tạo hoặc sửa file.
- Nếu có yêu cầu mới mâu thuẫn với quy ước, cần thông báo và thống nhất lại trước khi làm.
- Mục tiêu là giữ dự án đồng bộ, dễ mở rộng và dễ bàn giao.
