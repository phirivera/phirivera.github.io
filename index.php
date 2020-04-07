<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title> 寺岡 | Teraoka Farms </title>
        <meta name="description" content="Teraoka farms - soft ui v1">
        <meta name="author" content="Sophia Therese Rivera">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Muli|Rubik&display=swap" rel="stylesheet"> 
    </head>

    <body>
        <div id="topbar">
            <!-- <img src="images/logo.png" alt="" id="logo"> -->
            <a href="#splash">
                    <img src="images/logo.png" alt="" id="logo">
                    <img src="images/chicken_waving.png" alt id="chicken">
            </a>
            <a href="https://forms.gle/sj6SRLJ9EkHBzM8XA">
                    <button class="element order-button" type="button">🛒 Order</button>
            </a>
        </div>
        <br>
        
        <p id="jap-banner">こんにちは~</p>

        <div id="popper">
            
            <p id="close">
                X
            </p>
            <br>
            <p id="pop-text">
                In cooperation with social distancing, we only allow payments via online bank transfer through BPI and BDO. Orders via this website <b>will be prioritized. </b> We're running on a skeletal workforce, so please bear with us. We’ll try our very best to reply as soon as possible.
            </p>
        </div>

        <div class="section" id="splash">
            
            <h1>Need veggies?</h1>
            <h1 id="gotcha">We gotcha!</h1>
            <p id="main-desc">A family-owned farm in Pangasinan, Philippines, offering quality 100% organic produce.
                <b>1st and only Certified Organic farm in Region 1.</b> </p>
            <a href="#about">
                <button class="element" id="howto-button" type="button" style="margin-top: 1em;">About Us</button>
            </a>
            <a href="#howto">
                <button class="element" id="howto-button" type="button" style="margin-top: 1em;">How do I order?</button>
            </a>
            <a href="#produce">
                <button class="element" id="howto-button" type="button" style="margin-top: 1em;">Product List</button>
            </a>
            <a href="https://forms.gle/sj6SRLJ9EkHBzM8XA">
                <button class="element" type="button" style="font-size: 1.2em; margin-top: 1em;">Order</button>
            </a>
            <br>
            <br>
            <br>

            <a href="https://facebook.com/Teraokafamilyfarm/">
                <img src="images/fb-icon.png" alt="" class="socmed">
            </a>

            <a href="https://www.instagram.com/teraokafamilyfarm/">
                <img src="images/ig-icon.png" alt="" class="socmed">
            </a>
        </div>

        <!-- <div class="parallax" id="farm"></div> -->

        <div class="section" id="produce">
            <h2>Take a look at our produce</h2>
            <p>(Prices are subjected to change without prior notice)</p>
            <div class="element bulge outer-button">
                <button id="all" class="element tab" type="button">🥗 All</button>
            </div>
            
            <?php

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "teraokaf_main";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = 'SELECT * FROM categories';

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $name = $row["name"]; // "Leafy Greens"
                    $nameForClass = str_replace(' ', '-', strtolower($name)); // "leafy-greens"
                    $emoji = $row["emoji"];

                    echo '<div class="element bulge outer-button"> <button id="' . $nameForClass . '" class="element tab" type="button">' . $emoji . ' ' . $name . '</button></div>' ;
                }
            } else {
                echo "0 results";
            }
            $conn->close();

            ?>

            <script src="script.js"></script>

            <br>
            <div class="element bulge" id="stage-cards">

            <?php

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "teraokaf_main";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = 'SELECT p.name AS name, u.name AS uom, c.name AS category, p.price FROM products p INNER JOIN categories c ON c.id=p.category_id INNER JOIN uom u ON u.id=p.uom_id';

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $name = $row["name"]; // "Alugbati"
                    $uom = $row["uom"]; // "pack"
                    $category = $row["category"]; // "Leafy Greens"
                    $price = $row["price"]; // 50

                    $nameForClass = str_replace(' ', '-', strtolower($category)); // "leafy-greens"

                    echo '<div class="card depress ' . $nameForClass . '"><p class="prod-name">' . $name . '</p><p class="prod-price">P' . $price . '/' . $uom . '</p></div>' ;
                }
            } else {
                echo "0 results";
            }
            $conn->close();

            ?>

            </div>

        </div>
        
        <div class="section" id="howto">
            <h2> How do I order?</h2>
            <div class="depress guide">
                <p>
                    1. Click the button and fill out the form:
                </p>
                <a href="https://forms.gle/sj6SRLJ9EkHBzM8XA">
                    <button class="element" type="button" style="font-size: 1.2em; margin-top: 1em;">Order</button>
                </a>
                <br>
                <br>
                <p>
                    2. A text will be sent by our team to finalize your order and amount due. (Please give us 1 day lead time ➡️)
                    <br><br>
                    3. Pay via online bank transfer through: <br> 
                    <b>BPI</b> (Ray Raphael Teraoka Dacones; SA# 2259053911) 
                    <br>
                    or<br>
                    <b>BDO</b> (Ray Raphael Teraoka Dacones; SA # 006870130417)
                    <br><br>
                    4. For payment made by 12pm on the day, we will dispatch your order on the next day
                </p>
            </div>
        </div>

        <div class="section" id="about">

            <h2>About Us</h2>

            <div class="about-card">
                <div class="element bulge" id="outer-pic">
                    <div class="element depress" id="inner-pic">
                        <img src="images/farm.jpg" alt="" class="pic">
                    </div>
                </div>
                <div class="depress guide about-content">
                    <p>
                        In 1991, trenches of land were acquired in Mangaterem, Pangasinan. The land includes a hill which overlooks the the great plains that surround it. The family built a vacation house to enjoy life's simple pleasures - a laid back life with a scenic provincial view different to that of Baguio City, where they are from.
    
                        A plantation of 4000 mango trees were lined which added beautiful greenery and poultry livestock came about.
                    </p>
                    
                </div>

            </div>

            <div class="about-card">
                <div class="element bulge" id="outer-pic">
                    <div class="element depress" id="inner-pic">
                        <img src="images/grow.jpg" alt="" class="pic">
                    </div>
                </div>
            <div class="depress guide about-content">
                    <p>
                        In late 2014, plans to venture into the 'green scene' has become a priority for operation expansion. The technology and research invested into producing 100% chemical free products evolved from the idea of the food that we eat together on our table to be fresh and healthy.
            
                    We love our farm, so we like to take care of the land that we share with the animals and plants. We feel like stewards of nature and protectors of our land. This is our healthy farm lifecycle.
                    
                    The most rewarding feeling is that we are able to share this beautiful farm experience with the entire family- keeping our roots to the ground and intertwined with one another, to build a green and healthy world for tomorrow.
                    
                    </p>
                    
                </div>

            </div>
         

            <div class="about-card">
                <div class="element bulge" id="outer-pic">
                    <div class="element depress" id="inner-pic">
                        <img src="images/hill.jpg" alt="" class="pic">
                    </div>
                </div>
            <div class="depress guide about-content">
                    <p>
                        Being a Filipino-Japanese family, we have a heavy influence from both cultures. The resourcefulness of Filipinos and the detail-oriented Japanese which we apply to our business practices.
            
                    'Teraoka' literally translated into English is 'Temple on a Hill'. Like our name, this hill has become iconic to us and as we continue to grow our sacred garden of love, we extend our welcome to enjoy our sanctuary!        

                    </p>
                    
                </div>

            </div>     
           
        </div>
    </body>
</html>