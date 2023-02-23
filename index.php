<!DOCTYPE html>
<html>
  <head>
    <title>AddressBook Homepage</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background: linear-gradient(135deg, #000000, #000000);
        background-size: cover;
        color: #fff;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
      }
      header {
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
        padding: 20px;
        text-align: center;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
      }
      h1 {
        margin: 0;
        font-size: 4rem;
        letter-spacing: 10px;
        text-transform: uppercase;
        font-weight: 900;
        text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.5);
      }
      .button-container {
        display: flex;
        justify-content: center;
        margin-top: 50px;
      }
      .button {
        background-color: transparent;
        border: 2px solid #fff;
        border-radius: 50px;
        color: #fff;
        cursor: pointer;
        font-size: 20px;
        margin: 0 10px;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        text-transform: uppercase;
        transition: background-color 0.3s ease, color 0.3s ease;
        position: relative;
        overflow: hidden;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
      }
      .button:before {
        content: "";
        position: absolute;
        top: 0;
        left: -50%;
        width: 50%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.2);
        transform: skewX(-15deg);
        transition: transform 0.3s ease;
      }
      .button:hover:before {
        left: 0;
        transform: skewX(0deg);
      }
      .button:hover {
        background-color: #fff;
        color: #333;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
      }
      .button:focus {
        outline: none;
        box-shadow: 0 0 0 2px #fff, 0 0 0 4px #333;
      }
      .glow {
        position: relative;
        display: inline-block;
        animation: glow 2s ease-in-out infinite;
      }
      @keyframes glow {
        0% {
          box-shadow: 0 0 5px #fff, 0 0 10px #fff, 0 0 20px #fff;
        }
        50% {
          box-shadow: 0 0    5px #fff, 0 0 10px #fff, 0 0 40px #fff, 0 0 80px #fff, 0 0 90px #fff, 0 0 100px #fff, 0 0 150px #fff;
    }
    100% {
      box-shadow: 0 0 5px #fff, 0 0 10px #fff, 0 0 20px #fff, 0 0 40px #fff, 0 0 50px #fff, 0 0 60px #fff, 0 0 80px #fff;
    }
  }
</style>
</head>
  <body>
    <header>
      <h1 class="glow">AddressBook</h1>
    </header>
    <div class="button-container">
      <a href="register.php" class="button">Register</a>
      <a href="login.php" class="button">Login</a>
    </div>
  </body>
</html>
