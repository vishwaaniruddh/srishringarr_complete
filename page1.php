<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Welcome Popup</title>
    
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f2f2f2;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

.popup-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1;
    display: flex;
    justify-content: center;
    align-items: center;
}

.popup {
    background: #fff;
    padding: 20px;
    border-radius: 5px;
    text-align: center;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

h2 {
    font-size: 24px;
}

label {
    display: block;
    margin-top: 10px;
    font-weight: bold;
}

input {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    background: #007BFF;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    margin-top: 10px;
    cursor: pointer;
}

button:hover {
    background: #0056b3;
}

    </style>
</head>
<body>
    <div class="popup-overlay" id="popup">
        <div class="popup">
            <h2>Welcome to Our Website!</h2>
            <p>Please provide some information:</p>
            <form id="popup-form">
                <label for="name">Name:</label>
                <input type="text" id="name" required>
                <label for="email">Email:</label>
                <input type="email" id="email" required>
                <label for="contact">Contact:</label>
                <input type="tel" id="contact" required>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const popup = document.getElementById('popup');
    const popupForm = document.getElementById('popup-form');

    if (localStorage.getItem('popupClosed') !== 'true') {
        popup.style.display = 'block';
    }

    popupForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const contact = document.getElementById('contact').value;

        // You can handle the form data here, e.g., submit it to a server

        // Close the popup
        popup.style.display = 'none';
        localStorage.setItem('popupClosed', 'true');
    });
});

</script>
</body>
</html>
