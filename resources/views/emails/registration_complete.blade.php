<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Welcome to {{ config('app.name') }}</title>
</head>
<body style="margin:0; padding:0; background-color:#f2f2f2; font-family: Helvetica, Arial, sans-serif; color: #0C3A30;">

  <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#f2f2f2">
    <tr>
      <td align="center" style="padding: 30px 10px;">
        
        <table width="600" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="border-radius:8px; overflow:hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">

          <!-- Header with Brand Color -->
          <tr>
            <td style="background-color: #8BC905; padding: 30px 20px; text-align: center;">
              <img src="https://res.cloudinary.com/dswwq3xks/image/upload/v1777936379/dumbmoneylogo_ivtjer.png" alt="{{ config('app.name') }}" style="height: 80px; width: auto; display: block; margin: 0 auto;">
            </td>
          </tr>

          <!-- Body -->
          <tr>
            <td style="padding: 40px 30px; font-size: 16px; line-height: 1.6; color: #0C3A30;">
              
             

              <h1 style="text-align: center; color: #0C3A30; margin-bottom: 20px; font-size: 28px;">Welcome to Dumb Money, {{ $userName }}!</h1>

              <p style="margin-top: 0;">Dear {{ $userName }},</p>

              <p>Congratulations! Your registration is now complete. You have successfully created your account and provided all necessary information.</p>

              <!-- Account Details Box -->
              <div style="background-color: #f8f9fa; border-left: 4px solid #8BC905; padding: 20px; margin: 25px 0; border-radius: 4px;">
                <h3 style="color: #0C3A30; margin-top: 0; margin-bottom: 15px; font-size: 18px;">Your Account Details:</h3>
                
                <table style="width: 100%; font-size: 14px;">
                  <tr>
                    <td style="padding: 8px 0; color: #4A5C5A; width: 120px;"><strong>Name:</strong></td>
                    <td style="padding: 8px 0; color: #0C3A30;">{{ $userName }}</td>
                  </tr>
                  <tr>
                    <td style="padding: 8px 0; color: #4A5C5A;"><strong>Email:</strong></td>
                    <td style="padding: 8px 0; color: #0C3A30;">{{ $userEmail }}</td>
                  </tr>
                  <tr>
                    <td style="padding: 8px 0; color: #4A5C5A;"><strong>Account Type:</strong></td>
                    <td style="padding: 8px 0; color: #0C3A30;">{{ ucfirst($accountType) }}</td>
                  </tr>
                  @if($accountType == 'corporate' && $adminName)
                  <tr>
                    <td style="padding: 8px 0; color: #4A5C5A;"><strong>Copying Admin:</strong></td>
                    <td style="padding: 8px 0; color: #0C3A30;">{{ $adminName }}</td>
                  </tr>
                  @endif
                </table>
              </div>

              <!-- Next Steps -->
              <h3 style="color: #0C3A30; margin-top: 30px; margin-bottom: 15px; font-size: 18px;">Next Steps:</h3>
              
              <table style="width: 100%;">
                <tr>
                  <td style="padding: 5px 0; color: #4A5C5A; vertical-align: top; width: 30px;">1.</td>
                  <td style="padding: 5px 0; color: #4A5C5A;">Login to your account using your credentials</td>
                </tr>
                <tr>
                  <td style="padding: 5px 0; color: #4A5C5A;">2.</td>
                  <td style="padding: 5px 0; color: #4A5C5A;">Explore your dashboard and trading features</td>
                </tr>
                <tr>
                  <td style="padding: 5px 0; color: #4A5C5A;">3.</td>
                  <td style="padding: 5px 0; color: #4A5C5A;">Make your first deposit to start trading</td>
                </tr>
              </table>

              <!-- Login Button -->
              <div style="text-align: center; margin: 35px 0 20px;">
                <a href="{{ route('login') }}" style="background-color: #8BC905; color: white; padding: 14px 40px; border-radius: 50px; text-decoration: none; font-weight: bold; display: inline-block; font-size: 16px;">Login to Your Account →</a>
              </div>

              <p style="font-size: 14px; margin-top: 30px; color: #6c757d;">
                If you didn't create this account, please contact our support team immediately.
              </p>

              <p style="margin-top: 40px; font-size: 16px;">
                Happy Trading!<br>
                <strong>The Dumb Money Team</strong>
              </p>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td bgcolor="#f2f2f2" style="padding: 20px; text-align: center; font-size: 12px; color: #0C3A30;">
              <p style="margin: 0 0 10px;">
                <a href="{{ route('terms.privacy') }}" style="color: #8BC905; text-decoration: none; margin: 0 10px;">Privacy Policy</a> |
                <a href="{{ route('contact.us') }}" style="color: #8BC905; text-decoration: none; margin: 0 10px;">Contact Support</a>
              </p>
              <p style="margin: 0;">© {{ date('Y') }} Dumb Money. All rights reserved.</p>
            </td>
          </tr>

        </table>

      </td>
    </tr>
  </table>

</body>
</html>