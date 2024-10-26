<!DOCTYPE html>
<html>
<head>
  <title>Beautiful Popup Form</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #f2f2f2;
    }

    #overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      display: none;
      z-index: 100;
    }

    #popup {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 500px;
      background-color: #fff;
      border: 1px solid #ccc;
      padding: 20px;
      z-index: 101;
      display: none; /* Initially hidden */
      animation: bounce 0.5s ease-in-out; /* Add bounce animation */
    }

    #close {
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 20px;
      cursor: pointer;
    }

    /* CSS for the form */
    #popup form {
      display: flex;
      flex-direction: column;
    }

    input {
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
    }

    button {
      background-color: #0099ff;
      color: #fff;
      padding: 10px;
      border: none;
      cursor: pointer;
    }

    #leftImage, #rightImage, #mobileImage {
      max-width: 100%;
      height: auto;
      display: none;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }

    @keyframes bounce {
      0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
      }
      40% {
        transform: translateY(-10px);
      }
      60% {
        transform: translateY(-5px);
      }
    }

    @media (min-width: 768px) {
      /* Desktop view: Show left and right images */
      #leftImage, #rightImage {
        display: block;
        float: left;
        width: 48%;
        margin-right: 2%;
      }
    }

    @media (max-width: 767px) {
      /* Mobile view: Show form image */
      #mobileImage {
        display: block;
      }

      #popup {
        width: auto; /* Adjust the width for mobile */
      }
    }
  </style>
</head>
<body>

<div id="overlay"></div>
<div id="popup">
  <span id="close" onclick="closePopup()">&times;</span>
  <h1>Beautiful Popup Form</h1>
  <div id="leftImage">
    <img src="https://yosshitaneha.com/Admin/Images/1580733807.jpg" alt="Left Image">
  </div>
  <div id="rightImage">
    <img src="https://yosshitaneha.com/Admin/Images/1581329274.jpg" alt="Right Image">
  </div>
  <div id="mobileImage">
    <img src="https://yosshitaneha.com/Admin/Images/1580733807.jpg" alt="Mobile Image">
  </div>
  <form action="/action_page.php">
    <input type="text" name="name" placeholder="Enter your name">
    <input type="email" name="email" placeholder="Enter your email">
    <input type="tel" name="contact" placeholder="Enter your contact number">
    <button type="submit">Submit</button>
  </form>
</div>

<script>
  function openPopup() {
    var overlay = document.getElementById("overlay");
    var popup = document.getElementById("popup");
    popup.style.display = "block";
    overlay.style.display = "block";
    
    // Add smooth animation
    popup.style.animation = "fadeIn 0.5s ease-in-out";
  }

  function closePopup() {
    var overlay = document.getElementById("overlay");
    var popup = document.getElementById("popup");
    popup.style.display = "none";
    overlay.style.display = "none";
  }

  setTimeout(openPopup, 5000); // Show popup after 5 seconds
</script>
</body>
</html>
