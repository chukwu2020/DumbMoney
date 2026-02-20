<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>{{ $subject }} - {{ config('app.name') }}</title>

<style>
@media only screen and (max-width: 600px) {
  .email-container { width: 100% !important; }
  .mobile-padding { padding: 25px !important; }
  .stack-column { display: block !important; width: 100% !important; text-align: left !important; }
}
</style>
</head>

<body style="margin:0; padding:0; background-color:#f4f8f5; font-family: Arial, Helvetica, sans-serif; color:#0C3A30;">

<!-- Hidden Preview Text -->
<div style="display:none; max-height:0; overflow:hidden;">
  {{ $previewText ?? 'You have a new update from MarketMind.' }}
</div>

<table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#f4f8f5">
<tr>
<td align="center" style="padding:40px 15px;">

<!-- Email Card -->
<table class="email-container" width="600" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="border-radius:14px; overflow:hidden; box-shadow:0 6px 20px rgba(0,0,0,0.06);">

<!-- Header -->
<tr>
<td style="background:#8bc905; padding:30px 20px; text-align:center;">

<img src="https://res.cloudinary.com/dswwq3xks/image/upload/v1752508147/mymarketmindmainlogo_qonmlk.png"
     alt="MarketMind Logo"
     style="height:55px; margin-bottom:12px; display:block; margin-left:auto; margin-right:auto;">


</td>
</tr>

<!-- Body -->
<tr>
<td class="mobile-padding" style="padding:40px 45px; font-size:15px; line-height:1.7;">
<h2 style="margin:0 0 25px 0; font-size:18px; color:#0C3A30; font-weight:500; letter-spacing:1px; text-transform:uppercase;">
  {{ $subject }}
</h2>

<p style="margin-top:0; font-size:16px;">
  Hello {{ $userName ?? 'Valued Investor' }},
</p>

<p style="margin:20px 0; font-weight:500; letter-spacing:0.4px;">
  This is an official update from the MarketMind trading desk regarding your account activity:
</p>
<!-- Highlighted Message Box -->
<table width="100%" cellpadding="0" cellspacing="0" style="margin:25px 0;">
<tr>
<td style="background:#f0fdf4; border-left:4px solid #8bc905; padding:20px; border-radius:6px;">
  <p style="margin:0; font-size:15px; line-height:1.7;">
    {{ $messageBody }}
  </p>
</td>
</tr>
</table>

<!-- CTA Button -->
@if(!empty($actionUrl))
<table width="100%" cellpadding="0" cellspacing="0" style="margin:35px 0;">
<tr>
<td align="center">

<a href="{{ $actionUrl }}"
   style="background:#8bc905; color:#ffffff; text-decoration:none; padding:14px 28px; border-radius:6px; font-weight:bold; display:inline-block;">
   {{ $actionText ?? 'View My Account' }}
</a>

</td>
</tr>
</table>
@endif

<p style="margin-top:30px; font-size:14px; color:#4a5f55;">
If you have any questions, simply reply to this email our trading team is here to help.
</p>

<!-- Signature -->
<table width="100%" cellpadding="0" cellspacing="0" style="margin-top:35px; border-top:1px solid #e5efe9; padding-top:20px;">
<tr>
<td>

<p style="margin:0; font-size:14px;">
Warm regards,
</p>

<p style="margin:5px 0 0; font-size:16px; font-weight:600; color:#8bc905;">
The MarketMind Team
</p>

</td>
</tr>
</table>

</td>
</tr>

<!-- Footer -->
<tr>
<td bgcolor="#f0fdf4" style="padding:25px; text-align:center; font-size:12px; color:#5a6d5a;">

<p style="margin:0 0 10px;">
  © {{ date('Y') }} MarketMind. All rights reserved.
</p>

<p style="margin:0;">
  You are receiving this email because you have an active MarketMind account.
</p>

<p style="margin:15px 0 0;">
  <a href="#" style="color:#8bc905; text-decoration:none;">Help Center</a>
  &nbsp;•&nbsp;
  <a href="#" style="color:#8bc905; text-decoration:none;">Privacy Policy</a>
  &nbsp;•&nbsp;
  <a href="#" style="color:#8bc905; text-decoration:none;">Unsubscribe</a>
</p>

</td>
</tr>

</table>

</td>
</tr>
</table>

</body>
</html>