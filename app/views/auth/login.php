<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');

    body {
      background-image: url('app/styles/picture/wallpaper.jpg');
      background-size: cover;
    }
    p,
    h1 {
      margin: 0px;
    }
    .container {
      background-color: rgb(0, 192, 239);
      width: 500px;
      height: 350px;
      font-family: Rubik, Arial;
      border-radius: 10px;
      box-shadow: 0px 0px 2px rgba(0, 0, 0, .75);
    }
    .wrapper {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 90vh;
    }
    .header {
      text-align: center;
      padding-top: 15px;
    }
    .header p {
      margin-top: 10px;
    }
    .input-email {
      padding-top: 10px;
    }
    input:focus {
      outline: none;
    }
    .input-email {
      margin-top: 15px;
    }
    .input-email input {
      width: 100%;
      
      box-sizing: border-box;
      padding: 10px;
      padding-left: 25px;
      border: none;
      background-color: rgb(217, 217, 217);
    }
    .input-password {
      padding-top: 10px;
      padding-bottom: 10px;
    }
    .input-password input {
      width: 100%;
      margin-top: 6px;
      box-sizing: border-box;
      padding: 10px;
      padding-left: 25px;
      border: none;
      background-color: rgb(217, 217, 217);
    }
    label {
      margin-left: 15px;
    }
    .register-btn {
      box-sizing: border-box;
      background-color: rgb(0, 179, 89);
      border: none;
      width: 100%;
      padding: 12px;
      font-size: 20px;
      font-weight: bold;
      margin-top: 10px;
    }
    .register-btn:hover {
      cursor: pointer;
      filter: brightness(90%);
    }
    p.error {
      color: red;
      margin-left: 25px;
      margin-top: 10px;
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <div class="auth-form">
      <form method="POST" action="/<?= APP_BASE_PATH ?>/auth/authentication">
        <div class="container">
          <div class="header">
            <h1>Register</h1>
            <p>Please fill in this form to log in to the application.</p>
          </div>

          <div class="input-email">
            <hr>
            <input type="text" placeholder="Enter Email" id="email" name="email" required>
          </div>

          <div class="input-password">
            <input type="password" placeholder="Enter Password" id="password" name="password" required>
              <?php if(!empty($_SESSION['validation']['errors'])): ?>
                <p class="error"><?= $_SESSION['validation']['errors'] ?></p>
              <?php endif; ?>
            <hr>
          </div>

          <button type="submit" class="register-btn">Log In</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>