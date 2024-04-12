<!DOCTYPE html>
<html>
<head>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
  }
  .email-container {
    max-width: 600px;
    margin: 20px auto;
    background-color: #ffffff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  .email-header {
    background-color: #007bff;
    color: #ffffff;
    padding: 10px;
    border-radius: 5px 5px 0 0;
  }
  .email-content {
    padding: 20px;
    text-align: left;
  }
  .email-footer {
    background-color: #eeeeee;
    color: #333333;
    padding: 10px;
    font-size: 12px;
    text-align: center;
    border-radius: 0 0 5px 5px;
  }
</style>
</head>
<body>
  <div class="email-container">
    <div class="email-header">
      <h1>{{ $emailSubject }}</h1>
    </div>
    <div class="email-content">
      <p><strong>{{env('APP_NAME')}}</strong></p>
      <p><strong>{{ $emailDescription }}</strong> 

      </div>
    <div class="email-footer">
      <p>© {{current_school_year()['year']}} {{env('APP_NAME')}}. All rights reserved.</p>
    </div>
  </div>
</body>
</html>
