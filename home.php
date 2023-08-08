<?php
session_start();

// Vérifier si l'utilisateur est connecté en vérifiant la session
if (!isset($_SESSION['user'])) {
    header("Location: signin.php"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

$user = $_SESSION['user']; // Récupérer les informations de l'utilisateur depuis la session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Store Website</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    
    <section>

        <nav>

            <div class="logo">
                <img src="image/logo.png">
            </div>

            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="bookpage.php">Books</a></li>
                <li><a href="reglement.html">Règles</a></li>
                <li><a href="myaccount.php">My account</a></li>
                <li><a href="settings.php">Setting</a></li>
                <li><a href="signin.php">Se déconnecter <i class='fas fa-sign-out-alt'></i> </li>
                <li><a href="#"></a></li>
            
            </ul>

            <div class="search">
    <form action="search.php" method="GET">
        <input type="text" name="search_query" placeholder="Search...">
        <button type="submit"><i class="fa-solid fa-search"></i></button>
    </form></div>
    <div class="search_results">
    <?php include 'search.php'; ?>
</div>

        </nav>

        <div class="main">


            <div class="main_tag">
                <h1>WELCOME <?php echo $user['Nom']; ?> <?php echo $user['Prénom']; ?>!<br><span> TO BOOK STORE</span></h1>

                <!-- Votre contenu HTML ici -->



                <p>
                Notre site de books donne la possibilite de voir tous
                    ce qui 
                concerne les livres et les auteurs . nesitez pas 
                </p>
                <a href="#" class="main_btn">Learn More</a>

            </div>

            

        </div>

    </section><br/><br/><br/><br/>




    <!--Services-->

    <div class="services">

        <div class="services_box">

            

            <div class="services_card">
                <i class="fa-solid fa-headset"></i>
                <h3>24 x 7 Services</h3>
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                </p>
            </div>

            <div class="services_card">
                <i class="fa-solid fa-lock"></i>
                <h3>Secure Payment</h3>
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                </p>
            </div>

        </div>

    </div><br/><br/><br/>



    <!--authors-->

    <div class="featured_boks">

        <h1>Popular Authors</h1>

        <div class="featured_book_box">

            <div class="featured_book_card">

                <div class="featurde_book_img">
                    <img src="image/William Shakespeare.jpg">
                </div>

                <div class="featurde_book_tag">
                    <h2>William Shakespeare</h2>
                    <div class="categories">Love, power, destiny</div>
                    <br/><br/>
                    <a href="https://fr.wikipedia.org/wiki/William_Shakespeare" class="f_btn">Learn More</a>
                </div>               

            </div>

            <div class="featured_book_card">

                <div class="featurde_book_img">
                    <img src="image/George Orwell.jpg">
                </div>

                <div class="featurde_book_tag">
                    <h2>George Orwell</h2>
                    <div class="categories">Totalitarianism, truth, surveillance</div>
                    <br/><br/><br/>
                    <a href="https://fr.wikipedia.org/wiki/George_Orwell" class="f_btn">Learn More</a>
                </div>               

            </div>

            <div class="featured_book_card">

                <div class="featurde_book_img">
                    <img src="image/J.K. Rowling.jpeg">
                </div>

                <div class="featurde_book_tag">
                    <h2>J.K. Rowling</h2>
                    <div class="categories">Magic, friendship, identity</div>
                    <br/><br/><br/>
                    <a href="https://fr.wikipedia.org/wiki/J._K._Rowling" class="f_btn">Learn More</a>
                </div>               

            </div>

            <div class="featured_book_card">

                <div class="featurde_book_img">
                    <img src="image/Kurt Vonnegut.jpg">
                </div>

                <div class="featurde_book_tag"><br/>
                    <h2>Kurt Vonnegut</h2>
                    <div class="categories">Satire, humanism, absurdity</div>
                    <br/><br/><br/>
                    <a href="https://fr.wikipedia.org/wiki/kurt Vonnegut" class="f_btn">Learn More</a>
                </div>               

            </div>

            <div class="featured_book_card">

                <div class="featurde_book_img">
                    <img src="image/Virginia Woolf.jpg">
                </div>

                <div class="featurde_book_tag"><br/><br/>
                    <h2>Virginia Woolf</h2>
                    <div class="categories">Stream of consciousness, feminism, introspection</div>
                    <br/><br/>
                    <a href="https://fr.wikipedia.org/wiki/Virginia Woolf" class="f_btn">Learn More</a>
                </div>               

            </div>
            
            <div class="featured_book_card">

                <div class="featurde_book_img">
                    <img src="image/Ernest Hemingway.jpg">
                </div>

                <div class="featurde_book_tag">
                    <h2>Ernest Hemingway</h2>
                    <div class="categories">Simplicity, masculinity, existentialism</div>
                    <br/><br/>
                    <a href="https://fr.wikipedia.org/wiki/Ernest Hemingway" class="f_btn">Learn More</a>
                </div>               

            </div>

            <div class="featured_book_card">

                <div class="featurde_book_img">
                    <img src="image/William Faulkner.jpg">
                </div>

                <div class="featurde_book_tag"><br/>
                    <h2>William Faulkner</h2>
                    <div class="categories">Southern Gothic, history</div>
                    <br/><br/><br/>
                    <a href="https://fr.wikipedia.org/wiki/William Faulkner" class="f_btn">Learn More</a>
                </div>               

            </div>

            <div class="featured_book_card">

                <div class="featurde_book_img">
                    <img src="image/Ayn Rand.jpg">
                </div>

                <div class="featurde_book_tag">
                    <h2>Ayn Rand</h2>
                    <div class="categories">Objectivism, individualism</div>
                    <br/><br/><br/>
                    <a href="https://fr.wikipedia.org/wiki/Ayn Rand" class="f_btn">Learn More</a>
                </div>               

            </div>

            <div class="featured_book_card">

                <div class="featurde_book_img">
                    <img src="image/James Joyce.jpeg">
                </div>

                <div class="featurde_book_tag">
                    <h2>James Joyce</h2>
                    <div class="categories">Modernism, epiphany, Dublin</div>
                    <br/><br/><br/>
                    <a href="https://fr.wikipedia.org/wiki/James Joyce" class="f_btn">Learn More</a>
                </div>               

            </div>

            <div class="featured_book_card">

                <div class="featurde_book_img">
                    <img src="image/J.D. Salinger.jpeg">
                </div>

                <div class="featurde_book_tag"><br/><br/>
                    <h2>J.D. Salinger</h2>
                    <div class="categories">Coming-of-age, alienation</div>
                    <br/><br/><br/>
                    <a href="https://fr.wikipedia.org/wiki/J.D. Salinger" class="f_btn">Learn More</a>
                </div>               

            </div>


            <div class="featured_book_card">

                <div class="featurde_book_img">
                    <img src="image/Tahar Ben Jelloun.jpg">
                </div>

                <div class="featurde_book_tag">
                    <h2>Tahar Ben Jelloun</h2>
                    <div class="categories">Identity, migration, cultural</div>
                    <br/><br/><br/>
                    <a href="https://fr.wikipedia.org/wiki/Tahar Ben Jelloun" class="f_btn">Learn More</a>
                </div>               

            </div>

            <div class="featured_book_card">

                <div class="featurde_book_img">
                    <img src="image/Laila Lalami.jpg">
                </div>

                <div class="featurde_book_tag">
                    <h2>Laila Lalami</h2>
                    <div class="categories">Identity, displacement, social</div>
                    <br/><br/><br/>
                    <a href="https://fr.wikipedia.org/wiki/laila Lalami" class="f_btn">Learn More</a>
                </div>               

            </div>


            

        </div>

    </div><br/><br/><br/>



    
    <!--books-->

    <div class="arrivals">
        <h1>Our books</h1>

        <div class="arrivals_box">

            <div class="arrivals_card">
                <div class="arrivals_image">
                    <img src="image/moderncss.jpg">
                </div>
                <div class="arrivals_tag">
                    <p>Modern Css</p>
                    <div class="arrivals_icon">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>
                    <a href="#" class="arrivals_btn">Learn More</a>
                </div>
            </div>

            <div class="arrivals_card">
                <div class="arrivals_image">
                    <img src="image/arrival_2.jpg">
                </div>
                <div class="arrivals_tag">
                    <p>The wright brothers</p>
                    <div class="arrivals_icon">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>
                    <a href="#" class="arrivals_btn">Learn More</a>
                </div>
            </div>

            <div class="arrivals_card">
                <div class="arrivals_image">
                    <img src="image/html5.jpg">
                </div>
                <div class="arrivals_tag">
                    <p>HTML & HTML5</p>
                    <div class="arrivals_icon">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>
                    <a href="#" class="arrivals_btn">Learn More</a>
                </div>
            </div>

            <div class="arrivals_card">
                <div class="arrivals_image">
                    <img src="image/arrival_4.jpg">
                </div>
                <div class="arrivals_tag">
                    <p>Red queen</p>
                    <div class="arrivals_icon">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>
                    <a href="#" class="arrivals_btn">Learn More</a>
                </div>
            </div>

            <div class="arrivals_card">
                <div class="arrivals_image">
                    <img src="image/cssvocabulary.jpg">
                </div>
                <div class="arrivals_tag">
                    <p>Css vocabulary</p>
                    <div class="arrivals_icon">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>
                    <a href="#" class="arrivals_btn">Learn More</a>
                </div>
            </div>

            <div class="arrivals_card">
                <div class="arrivals_image">
                    <img src="image/arrival_6.jpg">
                </div>
                <div class="arrivals_tag">
                    <p>Harry Potter</p>
                    <div class="arrivals_icon">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>
                    <a href="#" class="arrivals_btn">Learn More</a>
                </div>
            </div>

            <div class="arrivals_card">
                <div class="arrivals_image">
                    <img src="image/java.jpg">
                </div>
                <div class="arrivals_tag">
                    <p>Java EE 6</p>
                    <div class="arrivals_icon">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>
                    <a href="#" class="arrivals_btn">Learn More</a>
                </div>
            </div>

            <div class="arrivals_card">
                <div class="arrivals_image">
                    <img src="image/arrival_10.jpg">
                </div>
                <div class="arrivals_tag">
                    <p>Percy jackson</p>
                    <div class="arrivals_icon">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>
                    <a href="#" class="arrivals_btn">Learn More</a>
                </div>
            </div>

            <div class="arrivals_card">
                <div class="arrivals_image">
                    <img src="image/python.jpg">
                </div>
                <div class="arrivals_tag">
                    <p>Python</p>
                    <div class="arrivals_icon">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>
                    <a href="#" class="arrivals_btn">Learn More</a>
                </div>
            </div>

            <div class="arrivals_card">
                <div class="arrivals_image">
                    <img src="image/sql.jpg">
                </div>
                <div class="arrivals_tag">
                    <p>Begining SQL</p>
                    <div class="arrivals_icon">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>
                    <a href="#" class="arrivals_btn">Learn More</a>
                </div>
            </div>

        </div>

    </div><br/><br/><br/><br/>





    <!--reviews-->

    <div class="reviews">
        <h1>Reviews</h1>

        <div class="review_box">

            <div class="review_card">
                <i class="fa-solid fa-quote-right"></i>
                <div class="card_top">
                    <img src="image/chaymae1.jpg">
                </div>
                <div class="card">
                    <h2>Chaymae Merhrioui</h2>
                    <p>je suis tres satisfait de ce site je peux emprunyter facilement
                    </p>
                    <div class="review_icon">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        
                    </div>
                </div>
            </div>

            <div class="review_card">
                <i class="fa-solid fa-quote-right"></i>
                <div class="card_top">
                    <img src="image/nada.png">
                </div>
                <div class="card">
                    <h2>Nada bentiba</h2>
                    <p>je suis tres satisfait de ce site je peux emprunyter facilement. mercii beaucoup
                    </p>
                    <div class="review_icon">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>
                </div>
            </div>

            <div class="review_card">
                <i class="fa-solid fa-quote-right"></i>
                <div class="card_top">
                    <img src="image/review_3.png">
                </div>
                <div class="card">
                    <h2>Mohammed ali</h2>
                    <p>trèss utile merciii 
                    </p>
                    <div class="review_icon">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>
                </div>
            </div>

            <div class="review_card">
                <i class="fa-solid fa-quote-right"></i>
                <div class="card_top">
                    <img src="image/blog_1.jpg">
                </div>
                <div class="card">
                    <h2>Yasmine kasmi</h2>
                    <p>je suis très satisfaite 
                    </p>
                    <div class="review_icon">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>
                </div>
            </div>

        </div>

    </div><br/><br/><br/><br/>


    <!--About-->

    <div class="about">

        <div class="about_image">
            <img src="image/rotest1.jpeg">
        </div>
        <div class="about_tag">
            <h1>About Us</h1>
            <p>
                Nous somme une site qui ser a menager les livres pour vous 
                Nesithez pas Mercii pour votre confiance Nous somme une site qui ser a menager les livres pour vous 
                Nesithez pas Mercii pour votre confiance. <br/>
                <h3>Adress : </h3><br/>
                Boulevard Mohammed VI Complexe Technologique SQLI 60000 Oujda Maroc <br/><br/>
                <h3>Téléphone : </h3><br/>
                +212(0) 5 36 68 29 07
            </p>
            <a href="https://www.google.com/maps/place/SQLI/@34.6512675,-1.898135,17z/data=!3m1!4b1!4m6!3m5!1s0xd787cbdcdf770d1:0x716c7fdff015cd!8m2!3d34.6512675!4d-1.8959463!16s%2Fg%2F11y7w30_v?entry=ttu" class="about_map" >Voir l'itinéraire</a>
            <a href="https://www.sqli.com/ma-fr/agences/oujda" class="about_btn">Learn More</a>
        </div>

    </div>

    
</body>
</html>