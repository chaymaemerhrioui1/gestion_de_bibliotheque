<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign up</title>
    <link rel="stylesheet" href="css/signupstyle.css">
</head>
<body>

    <div class="main">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">SQLI</h2>
            </div>

            <div class="menu">
                <ul>
                    <li><a href="#">HOME</a></li>
                    <li><a href="#">ABOUT</a></li>
                    <li><a href="#">CONTACT</a></li>
                </ul>
            </div>

        

        </div> 
        <div class="content">
            <h1>Site Web Du <br><span>Bibliothèque</span> <br> SQLI</h1>
            <p class="par">Notre Bibliothèque sert à ménager nos livres pour avoir  la pation de <br>les lires </p>

                <button class="cn"><a href="#">JOIN US</a></button>

                <div class="form">
                    <h2>Sign up</h2>
                    <form action="process_signup.php" method="POST">
                    <input type="text" name="Firstname"  id="firstname" placeholder="Firstname" required>
                    <input type="text" name="Lastname" id="lastname" placeholder="Lastname" required>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required><br>
                <label class="trem"><a href="#" class="tremsconditins">Terms & conditions</a></label>
                <div class="chek">
                    <input type="checkbox" id="register-check" required>
                    <label for="register-check">j'ai lu et j'accepte les conditions</label>
                </div>
                <button class="btnn" id="btn-create" type="submit">create</button>
                <div class="icons">
                        
                        <a href="https://www.google.com/" target="_blank"><ion-icon name="logo-google"></ion-icon></a>
                        <a href="https://www.facebook.com/login/" target="_blank"><ion-icon name="logo-facebook"></ion-icon></a>
                        <a href="https://www.instagram.com/" target="_blank"><ion-icon name="logo-instagram"></ion-icon></a>
                        <a href="https://www.twitter.com/" target="_blank"><ion-icon name="logo-twitter"></ion-icon></a>
                        
                    </div>

                </div>
                    </div>
                </div>
        </div>
    </div>
    <script>
        document.getElementById("signup-form").addEventListener("submit", function(event) {
            // Prevent the form from submitting immediately
            event.preventDefault();

            // Get the form input values
            const firstname = document.getElementById("firstname").value.trim();
            const lastname = document.getElementById("lastname").value.trim();
            const email = document.getElementById("email").value.trim();
            const checkbox = document.getElementById("register-check").checked;

            // Check if any of the required fields are empty
            if (firstname === '' || lastname === '' || email === '') {
                alert("All fields are required. Please fill in the necessary information.");
                return; // Stop form submission
            }

            // Check if the checkbox is checked
            if (!checkbox) {
                alert("Please accept the terms and conditions.");
                return; // Stop form submission
            }

            // If all fields are filled and checkbox is checked, submit the form
            event.target.submit();
        });
    </script>
</body>
</html>