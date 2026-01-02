<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toyota Test Drive - Booking Confirmation</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #c9a96e 0%, #b8860b 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }
        .content {
            padding: 30px;
        }
        .booking-info {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #c9a96e;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 5px 0;
            border-bottom: 1px solid #eee;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: bold;
            color: #555;
        }
        .value {
            color: #333;
        }
        .status {
            background-color: #fff3cd;
            color: #856404;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: bold;
            display: inline-block;
            margin: 10px 0;
        }
        .footer {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 14px;
        }
        .footer a {
            color: #c9a96e;
            text-decoration: none;
        }
        .next-steps {
            background-color: #e8f4f8;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #17a2b8;
        }
        .next-steps h3 {
            color: #17a2b8;
            margin-top: 0;
        }
        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #c9a96e 0%, #b8860b 100%);
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🚗 Toyota Test Drive</h1>
            <p>Booking Confirmation</p>
        </div>
        
        <div class="content">
            <h2>Dear {{ $customer['name'] }},</h2>
            
            <p>Thank you for booking a test drive with Toyota! We're excited to help you experience the exceptional performance and quality of our vehicles.</p>
            
            <div class="booking-info">
                <h3>Booking Details:</h3>
                <div class="info-row">
                    <span class="label">Customer Name:</span>
                    <span class="value">{{ $customer['name'] }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Email:</span>
                    <span class="value">{{ $customer['email'] }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Phone:</span>
                    <span class="value">{{ $customer['phone'] }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Vehicle:</span>
                    <span class="value">{{ $booking['car'] }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Booking Date:</span>
                    <span class="value">{{ $booking['date'] }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Status:</span>
                    <span class="status">{{ $booking['status'] }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Assigned SPV:</span>
                    <span class="value">{{ $customer['assignedSPV'] }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Assigned Security:</span>
                    <span class="value">{{ $customer['assignedSecurity'] }}</span>
                </div>
            </div>
            
            <div class="next-steps">
                <h3>What Happens Next?</h3>
                <ul>
                    <li>Our team will review your booking request</li>
                    <li>You'll receive a confirmation call within 24 hours</li>
                    <li>We'll schedule your test drive at a convenient time</li>
                    <li>Please bring a valid driver's license and ID</li>
                </ul>
            </div>
            
            <p>If you need to make any changes to your booking or have questions, please contact us:</p>
            <ul>
                <li><strong>Phone:</strong> (0741) 123-456</li>
                <li><strong>Email:</strong> testdrive@toyota-jambi.co.id</li>
                <li><strong>Address:</strong> Toyota Paal 10, Jambi, Indonesia</li>
            </ul>
            
            <div style="text-align: center; margin: 30px 0;">
                <a href="#" class="btn">Track Your Booking Status</a>
            </div>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Toyota Test Drive Experience. All rights reserved.</p>
            <p>Toyota Paal 10, Jambi, Indonesia</p>
            <p>
                <a href="#">Privacy Policy</a> | 
                <a href="#">Terms of Service</a> | 
                <a href="#">Contact Us</a>
            </p>
        </div>
    </div>
</body>
</html>