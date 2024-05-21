<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa đơn</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
           
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border: 4px solid #05bebe;
           
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-details {
            margin-bottom: 10px;
        }
        .invoice-details h3,
        .invoice-details h5 {
            margin: 0;
        }
      
        .invoice-details p {
            margin: 10px 0;
        }
        .success-message {
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
            padding: 15px;
            margin-top: 20px;
            border-radius: 5px;
        }
        .background-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://www.transparenttextures.com/patterns/absurdidad.png');
            opacity: 0.1;
            pointer-events: none;
            z-index: -1;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="background-pattern"></div>
        <div class="header">
            <h1>HÓA ĐƠN THANH TOÁN</h1>
        </div>
        <div class="invoice-details">
           
        </div>
        <div class="success-message">
            <p>Cảm ơn bạn đã thanh toán thành công. Chúng tôi sẽ sắp xếp đơn hàng giao đến bạn sớm nhất</p>
        </div>
    </div>
</body>
</html>
