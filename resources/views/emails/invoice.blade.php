<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hóa Đơn Thanh Toán - 22fotoholicstudio</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f5; padding: 20px; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; background: #ffffff; padding: 30px; border-radius: 16px; border: 1px solid #e4e4e7;">
        <h2 style="text-align: center; color: #6b21a8; text-transform: uppercase; margin-bottom: 5px;">22FOTOHOLICSTUDIO</h2>
        <p style="text-align: center; color: #71717a; font-size: 13px; margin-top: 0;">XÁC NHẬN THANH TOÁN & HÓA ĐƠN DỊCH VỤ</p>

        <hr style="border: none; border-top: 1px solid #e4e4e7; margin: 20px 0;">

        <p>Xin chào <strong>{{ $datLich->HoTenKhach }}</strong>,</p>
        <p>Cảm ơn bạn đã tin tưởng lựa chọn dịch vụ chụp ảnh tại <strong>22fotoholicstudio</strong>. Chúng tôi xin gửi chi tiết hóa đơn thanh toán của bạn dưới đây:</p>

        <table style="width: 100%; border-collapse: collapse; margin-top: 15px; font-size: 13px;">
            <tr>
                <td style="padding: 8px 0; color: #71717a;">Mã đơn đặt lịch:</td>
                <td style="padding: 8px 0; font-weight: bold; text-align: right;">#{{ $datLich->MaDatLich }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; color: #71717a;">Mã hóa đơn:</td>
                <td style="padding: 8px 0; font-weight: bold; text-align: right;">#{{ $hoaDon->MaHoaDon }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; color: #71717a;">Gói dịch vụ:</td>
                <td style="padding: 8px 0; font-weight: bold; text-align: right;">{{ $dichVu->TenDichVu }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; color: #71717a;">Concept phong cách:</td>
                <td style="padding: 8px 0; font-weight: bold; text-align: right;">{{ $concept->TenConcept }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; color: #71717a;">Loại thanh toán:</td>
                <td style="padding: 8px 0; font-weight: bold; text-align: right; color: #6b21a8;">{{ $thanhToan->LoaiThanhToan }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; color: #71717a;">Phương thức:</td>
                <td style="padding: 8px 0; font-weight: bold; text-align: right;">{{ $thanhToan->PhuongThuc }}</td>
            </tr>
            <tr style="border-top: 1px dashed #e4e4e7;">
                <td style="padding: 12px 0; font-weight: bold;">Số tiền đã thanh toán:</td>
                <td style="padding: 12px 0; font-weight: bold; text-align: right; color: #16a34a; font-size: 16px;">
                    {{ number_format($thanhToan->SoTien, 0, ',', '.') }} VNĐ
                </td>
            </tr>
        </table>

        <div style="background-color: #faf5ff; border: 1px solid #e9d5ff; padding: 15px; border-radius: 12px; margin-top: 20px; font-size: 12px; color: #581c87;">
            <strong>Lưu ý:</strong> Vui lòng có mặt trước 15 phút so với khung giờ chụp để chuẩn bị trang phục & trang điểm tốt nhất.
        </div>

        <p style="text-align: center; margin-top: 25px; font-size: 12px; color: #a1a1aa;">
            22fotoholicstudio • Trân trọng cảm ơn quý khách!
        </p>
    </div>
</body>
</html>