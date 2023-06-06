<!DOCTYPE html>
<html>
<head>
  <title>Hotel Booking System</title>
  <style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background: white;
      background-image: url("qwerty.jfif");
      background-size: cover;
      background-repeat: no-repeat;
    }
    
    header {
      background-color: rgba(0, 0, 0, 0.5); 
      color: #fff;
      padding: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4); 
    }
    
    nav {
      display: flex;
      align-items: center;
    }
    
    nav ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      display: flex;
    }
    
    nav ul li {
      margin-right: 10px;
    }
    
    nav ul li a {
      text-decoration: none;
      color: white;
      padding: 5px;
    }
    
    .logo {
      width: 100px;
      height: 100px;
      margin-right: 10px;
      background: none;
    }
    
    .content {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .book-now {
      height: 500px;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: #fff;
      font-size: 24px;
    }
    
    .book-now-button {
      background-color: #333;
      color: #fff;
      border: none;
      padding: 10px 20px;
      font-size: 18px;
      cursor: pointer;
      border-radius: 10%; 
    }
    
    .book-now-button:hover {
      background-color: #45a049; 
    }
    
    footer {
      background-color: rgba(0, 0, 0, 0.5); 
      color: white;
      padding: 20px;
      text-align: center;
      box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.4); 
    }
    
    nav ul {
      justify-content: flex-start;
    }
  </style>
</head>
<body>
  <header>
    <nav>
    <img class="logo" src="/logoo.png" alt="Logo"> 
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="login.php">Admin</a></li>
      </ul>
    </nav>
  </header>
  
  <div class="content">
    <div class="book-now">
      <form action="booking.php" method="post">
        <button class="book-now-button" type="submit">Book Now</button>
      </form>
    </div>
  </div>
  
  <footer>
    <p>Contact us</p>
    <p>123456789</p>
    <p>vermshotel@gmail.com</p>
  </footer>
  
</body>
</html>
