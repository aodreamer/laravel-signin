<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Css file -->
  <link rel="stylesheet" href="style.css">

  <!-- Google font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

  <!-- Fontawesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>SIGNIN</title>
  <style>
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: "Montserrat", sans-serif;
  background-color: rgb(244, 247, 250);
  position: relative;
}

nav {
  padding: 0 20px;
  background-color: #fff;
  height: 50px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  position: sticky;
  top: 0;
  box-shadow: 0 5px 0 #ffffff, 5px 0 0 #f8f7f7;
}

#logo-text a {
  text-decoration: none;
  font-size: 1.5rem;
  color: #5445f5;
  font-weight: lighter;
}

#check {
  display: none;
}

.toggle {
  font-size: 1.5rem;
  color: gray;
  cursor: pointer;

  display: none;
}

nav ul {
  display: flex;
  justify-content: space-around;
}

nav ul li {
  list-style-type: none;
}

nav ul li a {
  text-decoration: none;
  padding: 0 10px;
  color: gray;
  font-weight: 300;
}

nav ul li a:hover {
  color: #5a4fdc;
}

.active {
  color: #7f73fd;
}

#account-container a {
  text-decoration: none;
  padding: 0 10px;
  color: gray;
  font-weight: 300;
}

#account-container a:nth-child(1) {
  background-color: #c1bbf5;
  color: #fff;
  font-weight: 900;
  padding: 5px 10px;
  border-radius: 10px;
}

/* header main page style start here */

#header-container {
  height: 85vh;
  padding: 20px 60px;
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  align-items: center;
  gap: 30px;
}

#header-page-title {
  width: 100%;
}

#header-page-title h1 {
  font-size: 2.5rem;
  font-weight: bolder;
  margin-bottom: 40px;
}

#header-page-title p {
  font-size: 1.1rem;
  color: rgb(167, 161, 161);
  margin-bottom: 40px;
}

#header-subscribe-form input {
  text-align: center;
  padding: 10px;
  background-color: #e8ebf8;
  border-radius: 5px;
  border: 0;
}

#header-subscribe-form input:nth-child(2) {
  background-color: rgb(115, 115, 243);
  color: white;
  font-weight: 900;
  border: none;
}

#header-page-image img {
  object-fit: contain;
  width: 100%;
  height: auto;
}

.awesome-feature {
  text-align: center;
  padding: 0 50px;
}

#feature-text h1 {
  font-size: 2.5rem;
  margin-bottom: 10px;
}

#feature-text p {
  font-size: 0.9rem;
  color: gray;
  margin-bottom: 30px;
}

#creativity-features {
  padding: 0 50px;
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 30px;

  margin-bottom: 100px;
}

#creativity-features-image img {
  width: 90%;
  height: 90%;
}

#creativity-features-text {
  width: 100%;
  height: 100%;
  padding-top: 80px;
}

#creativity-features-text h1 {
  font-size: xx-large;
  margin-bottom: 20px;
}

#creativity-features-text h3 {
  font-size: 1.7rem;
  margin-bottom: 20px;
}

#creativity-features-text p {
  font-size: 0.9rem;
  margin-bottom: 30px;
}

.creative-footer-text p {
  font-weight: bolder;
}

#creativity-btn a {
  display: inline-block;
  text-decoration: none;
  background-color: #5a4fdc;
  color: white;
  font-weight: 900;
  padding: 20px 60px;
  font-size: 20px;
  border-radius: 3px;
  margin-right: 60px;
}

#creativity-btn a:nth-child(2) {
  background-color: #dedbf8;
  color: #5a4fdc;
}

/* Choose your plan */

#plan-container {
  margin: 30px 70px 100px;
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 30px;
}

#plan-container .plan-item {
  text-align: center;
  background-color: #e8ebf8;
  padding: 10px 30px 20px;
  border-radius: 5px;
}

.plan-item p {
  line-height: 40px;
  color: gray;
}

.plan-money i {
  padding: 15px;
  /* font-size: 2rem; */
  background-color: #5a4fdc;
  color: white;
  border-radius: 10px 10px 0 10px;
  margin-bottom: 10px;
}

.plan-money i:nth-child(2) {
  border-radius: 0 10px 10px 10px;
}

.plan-money h2 {
  font-size: 2rem;
  margin-bottom: 10px;
}

.plan-money h1 {
  font-size: 3rem;
}

.plan-money h1 span {
  font-size: 1rem;
}

.plan-money p {
  font-weight: bold;
  color: gray;
}

.plan-benifit a {
  text-decoration: none;
  border: 2px solid #5a4fdc;
  border-radius: 5px;
  color: #5a4fdc;
  padding: 5px 15px;
}

#letest-news-container {
  margin: 30px 70px;
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 30px;
}

.letest-image img {
  width: 100%;
  border-radius: 3px;
}

.admin-and-calender {
  display: flex;
  justify-content: space-between;
  margin-bottom: 30px;
}

.calender {
  display: flex;
  gap: 20px;
}

.admin {
  display: flex;
  gap: 20px;
}

.letest-text h1 {
  line-height: 60px;
}

.learn-more-btn {
  margin-top: 50px;
  display: flex;
  align-items: center;
  gap: 20px;
  color: #5a4fdc;
}

.learn-more-btn a {
  text-decoration: none;
}

#contact-us {
  margin: 30px 70px 100px;

  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 50px;
}

#contact-form-item {
  display: flex;
  justify-content: space-between;
  gap: 30px;
  margin-bottom: 30px;
  color: gray;
}

#contact-form-item input {
  padding: 10px 15px;
  border: 1px solid gray;
  border-radius: 3px;
  transition: outline 1s;
}

#contact-form-item input:focus {
  outline: 2px solid #5a4fdc;
}

textarea {
  padding: 5px;
  border-radius: 3px;
  margin-bottom: 30px;
  width: 100%;
  height: 150px;
}

textarea:focus {
  outline: 1px solid #5a4fdc;
}

#send-message-btn {
  background-color: #5a4fdc;
  padding: 10px 20px;
  border-radius: 3px;
  color: white;
}

#send-message-btn input {
  background-color: transparent;
  color: white;
  border: 0;
  font-weight: 900;
}

.contact-info {
  display: flex;
  align-items: center;
  gap: 10px;
  line-height: 50px;
  color: gray;
}

.contact-info i {
  font-size: 1.5rem;
}

footer {
  background-color: #212529;
  color: gray;
  padding: 30px 60px;
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
}

#footer-name h2 {
  color: #5445f5;
  margin-bottom: 10px;
}

#footer-social-icon {
  margin: 20px 0;
}

#footer-social-icon i {
  font-size: 1.3rem;
  padding: 0 10px;
}

.footer-link h4 {
  color: white;
  margin-bottom: 20px;
}

.footer-link a {
  display: block;
  text-decoration: none;
  line-height: 30px;
  color: rgb(156, 148, 148);
}

@media screen and (max-width: 600px) and (min-width: 200px) {
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: "Montserrat", sans-serif;
    background-color: rgb(244, 247, 250);
    position: relative;
    overflow-x: hidden;
  }

  nav {
    padding: 0 20px;
    background-color: #fff;
    height: auto;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: sticky;
    top: 0;
    box-shadow: 0 5px 0 #ffffff, 5px 0 0 #f8f7f7;
  }

  #logo-text a {
    text-decoration: none;
    font-size: 1.1rem;
    color: #5445f5;
    font-weight: lighter;
  }

  #check {
    display: none;
  }

  .toggle {
    font-size: 1.5rem;
    color: gray;
    cursor: pointer;

    display: block;
  }

  nav ul {
    width: 100%;
    height: 100vh;
    padding: 50% 0 0 0;
    text-align: center;
    background-color: #fbfbff;
    display: block;
    justify-content: space-around;
    position: absolute;
    top: 50px;
    left: -100%;
    transition: all 1s;
  }

  nav ul li {
    list-style-type: none;
  }

  nav ul li a {
    text-decoration: none;
    padding: 0 10px;
    color: gray;
    font-weight: 300;
    line-height: 2em;
    font-size: 1.5rem;
  }

  nav ul li a:hover {
    color: #5a4fdc;
  }

  .active {
    color: #7f73fd;
  }

  #account-container a {
    display: block;
    text-decoration: none;
    padding: 0 10px;
    color: gray;
    font-weight: 300;
  }

  #account-container a:nth-child(1) {
    background-color: #c1bbf5;
    color: #fff;
    font-weight: 300;
    padding: 5px;
    border-radius: 5px;
  }

  #check:checked ~ ul {
    /* top: 50px; */
    left: 0;
  }

  /* Header container */
  #header-container {
    height: 100vh;
    padding: 20px 60px;
    display: grid;
    grid-template-columns: 1fr;
    align-items: center;
    gap: 30px;
  }

  #header-page-title {
    width: 100%;
  }

  #header-page-title h1 {
    font-size: 1.5rem;
    font-weight: bolder;
    margin-bottom: 40px;
  }

  #header-page-title p {
    font-size: 1.1rem;
    color: rgb(167, 161, 161);
    margin-bottom: 40px;
  }

  #header-subscribe-form input {
    text-align: center;
    padding: 10px;
    margin: 0 0 10px 0;
    background-color: #e8ebf8;
    border-radius: 5px;
    border: 0;
    width: 100%;
  }

  #header-subscribe-form input:nth-child(2) {
    background-color: rgb(115, 115, 243);
    color: white;
    font-weight: 900;
    border: none;
  }

  #header-page-image img {
    object-fit: contain;
    width: 100%;
    height: auto;
  }

  .awesome-feature {
    text-align: center;
    padding: 0 50px;
    margin: 0 0 50px 0;
  }

  #feature-text h1 {
    font-size: 1.5rem;
    margin-bottom: 20px;
  }

  #feature-text p {
    font-size: 0.9rem;
    color: gray;
  }

  #creativity-features {
    padding: 0 20px;
    display: grid;
    grid-template-columns: 1fr;
    gap: 10px;

    margin-bottom: 100px;
  }

  #creativity-features-image img {
    width: 100%;
    height: auto;
  }

  #creativity-features-text {
    width: 100%;
    /* height: 100%; */
    padding-top: 20px;
  }

  #creativity-features-text h1 {
    font-size: xx-large;
    margin-bottom: 10px;
  }

  #creativity-features-text h3 {
    font-size: 1.2rem;
    margin-bottom: 10px;
  }

  #creativity-features-text p {
    font-size: 0.9rem;
    margin-bottom: 15px;
  }

  .creative-footer-text p {
    font-weight: bolder;
  }

  #creativity-btn a {
    text-decoration: none;
    background-color: #5a4fdc;
    color: white;
    font-weight: 900;
    padding: 10px 20px;
    border-radius: 3px;
    font-size: 0.8rem;
  }

  #creativity-btn a:nth-child(2) {
    background-color: #dedbf8;
    color: #5a4fdc;
  }

  #plan-container {
    margin: 15px 20px 40px;
    display: grid;
    grid-template-columns: 1fr;
    gap: 30px;
  }

  #plan-container .plan-item {
    text-align: center;
    background-color: #e8ebf8;
    padding: 10px 30px 20px;
    border-radius: 5px;
  }

  .plan-item p {
    line-height: 40px;
    color: gray;
  }

  .plan-money i {
    padding: 15px;
    /* font-size: 2rem; */
    background-color: #5a4fdc;
    color: white;
    border-radius: 10px 10px 0 10px;
    margin-bottom: 10px;
  }

  .plan-money h2 {
    font-size: 1.5rem;
    margin-bottom: 10px;
  }

  .plan-money h1 {
    font-size: 2rem;
  }

  .plan-money h1 span {
    font-size: 1rem;
  }

  .plan-money p {
    font-weight: bold;
    color: gray;
  }

  .plan-benifit a {
    text-decoration: none;
    border: 2px solid #5a4fdc;
    border-radius: 5px;
    color: #5a4fdc;
    padding: 5px 15px;
  }

  #letest-news-container {
    margin: 10px 20px 50px;
    display: grid;
    grid-template-columns: 1fr;
    gap: 30px;
  }

  .letest-image img {
    width: 100%;
    border-radius: 3px;
  }

  .admin-and-calender {
    display: flex;
    justify-content: space-between;
    margin-bottom: 30px;
  }

  .calender {
    display: flex;
    gap: 20px;
  }

  .admin {
    display: flex;
    gap: 20px;
  }

  .letest-text h1 {
    line-height: 60px;
  }

  .learn-more-btn {
    margin-top: 20px;
    display: flex;
    align-items: center;
    gap: 20px;
    color: #5a4fdc;
  }

  .learn-more-btn a {
    text-decoration: none;
  }

  #contact-us {
    margin: 10px 5px;

    display: grid;
    grid-template-columns: 1fr;
    gap: 50px;
    max-width: 600px;
  }

  #contact-form-item {
    margin: 5px;
    display: flex;
    /* justify-content: space-between; */
    flex-direction: column;
    gap: 10px;
    margin-bottom: 30px;
    color: gray;
  }

  #contact-form-item input {
    padding: 10px 15px;
    border: 1px solid gray;
    border-radius: 3px;
    width: 100%;
    transition: outline 1s;
  }

  #contact-form-item input:focus {
    outline: 2px solid #5a4fdc;
  }

  textarea {
    padding: 5px;
    border-radius: 3px;
    margin-bottom: 30px;
    height: 150px;
    width: 100%;
  }

  textarea:focus {
    outline: 1px solid #5a4fdc;
  }

  #send-message-btn {
    background-color: #5a4fdc;
    padding: 5px 10px;
    border-radius: 3px;
    color: white;
  }

  #send-message-btn input {
    background-color: transparent;
    color: white;
    border: 0;
    font-weight: 900;
  }

  .contact-info {
    display: flex;
    align-items: center;
    gap: 10px;
    line-height: 30px;
    color: gray;
  }

  .contact-info i {
    font-size: 1.2rem;
  }

  footer {
    background-color: #212529;
    color: gray;
    padding: 30px 10px;
    display: grid;
    grid-template-columns: 1fr;
    /* gap: 20px; */
    width: 100%;
  }

  #footer-name h2 {
    color: #5445f5;
    margin-bottom: 10px;
  }

  #footer-social-icon {
    margin: 20px 0;
  }

  #footer-social-icon i {
    font-size: 1.3rem;
    padding: 0 10px;
  }

  .footer-link h4 {
    color: white;
    margin-bottom: 20px;
  }

  .footer-link a {
    display: block;
    text-decoration: none;
    line-height: 30px;
    color: rgb(156, 148, 148);
  }
}

  </style>
</head>

<body>

  <nav>

    <label for="name" id="logo-text">
      <a href="#">SIGNIN</a>
    </label>

    <input type="checkbox" id="check">
    <label for="check" class="toggle">
      <i class="fa-solid fa-bars-staggered"></i>
    </label>

    <!-- <ul>
      <li><a href="#" class="active">Home</a></li>
      <li><a href="#">Features</a></li>
      <li><a href="#">Pricing</a></li>
      <li><a href="#">Contact US</a></li>
      <li><a href="#">About</a></li>
    </ul> -->

    <div id="account-container">
      <a href="{{ route('register-user') }}">Register</a>
      <a href="{{ route('login') }}">Login</a>
    </div>
  </nav>

  <header>
  <div id="header-container" style="background: linear-gradient(#141e30, #1b2840);">
    <div id="header-page-title">
      <a href="https://postimg.cc/rRdfbJVP">
        <img src="https://i.postimg.cc/rRdfbJVP/CSeng.png" alt="CSEng" border="0">
      </a>
      <p style="color: white;">
        <br> Aplikasi ini memiliki fitur untuk melakukan tanda tangan digital pada dokumen PDF pada perangkat Anda
      </p>
      <!-- <div id="header-subscribe-form">
        <input type="email" name="" id="" placeholder="Enter your email">
        <input type="submit" value="Subscribe">
      </div> -->
      <!-- <div id="creativity-btn">
        <a href="#" id="verify">Verify</a>
        <a href="#" id="jdih">JDIH</a>
      </div> -->
    </div>
    <div id="header-page-image">
      <a><img src="https://i.ibb.co/V9xnGNT/Landing-Page.png" alt="Landing-Page" border="0" /></a>
    </div>
  </div>
</header>


  <section class="awesome-feature"style="background: linear-gradient(#1b2840, #243b55);">
  <div id="feature-text">
    <h1 style="color: white;">Digital Signature in action</h1>
    <p style="color: white;">Nikmati kemudahan dari tanda-tangan elektronik dimanapun dan kapanpun</p>
    <div id="creativity-btn">
      <a href="{{route('verify.cert.form')}}" id="verify">Verify</a>
      <a href="{{route('jdih.index')}}" id="jdih">JDIH</a>
    </div>
  </div>
</section>

  <section id="creativity-features"style="background: linear-gradient(#243b55, #2b4563);">

    <div id="creativity-features-image">
    <a href="https://ibb.co/LQxg15H"><img src="https://i.ibb.co/q0Ngp5V/2210-i201-027-S-m004-c13-contract-agreement-isometric-Converted.png" alt="2210-i201-027-S-m004-c13-contract-agreement-isometric-Converted" border="0" /></a>
    </div>

    <div id="creativity-features-text">
      <!-- <h1>Manfaat digital signature</h1> -->
      <h3 style="color: white;">Integritas data</h3>
      <p style="color: white;">Digital signature memastikan bahwa data atau informasi yang ditandatangani tidak mengalami perubahan atau manipulasi selama proses transmisi atau penyimpanan.</p>
      <h3 style="color: white;">Otentikasi </h3>
      <p style="color: white;">Digital signature menggunakan konsep kunci publik dan pribadi, di mana kunci pribadi hanya dikenal oleh pemiliknya, sehingga dapat membuktikan bahwa pesan berasal dari sumber yang sah.</p>
      <h3 style="color: white;">Non-Repudiasi </h3>
      <p style="color: white;">Digital signature mencegah pihak yang telah mengirim pesan atau dokumen untuk kemudian menyangkal tindakan tersebut.</p>

      <!-- <div class="creative-footer-text">
        <p>Donec pede justo fringilla vel nec. <br>
          cras ultricies li eu turpis hendrerit fringilla.</p>
      </div>
      <div id="creativity-btn">
        <a href="#">Read More</a>
        <a href="#">Buy Now</a>
      </div> -->
    </div>

  </section>

  <section class="awesome-feature">
    <div id="feature-text">
      <h1>Visi</h1>
      <o>Melakukan rancang bangun aplikasi yang bisa menandatangani dokumen secara digital dengan aman,      praktis dan terpercaya
      </p>
    </div>
  </section>

  <!-- <section id="plan-container">
    <div class="plan-item">
      <div class="plan-money">
        <i class="fa-solid fa-user"></i>
        <h2>Simple</h2>
        <h1><span>$</span>19</h1>
        <p>user / month</p>
      </div>

      <div class="plan-benifit">
        <p>Bandwith: 1GB</p>
        <p>OnlineSpace: 512MB</p>
        <p>Support: <strong>Yes</strong></p>
        <a href="#">Buy Now</a>
      </div>
    </div>
    <div class="plan-item">
      <div class="plan-money">
        <i class="fa-solid fa-user"></i>
        <h2>Basic</h2>
        <h1><span>$</span>49</h1>
        <p>user / month</p>
      </div>

      <div class="plan-benifit">
        <p>Bandwith: 3GB</p>
        <p>OnlineSpace: 2GB</p>
        <p>Support: <strong>Yes</strong></p>
        <a href="#">Buy Now</a>
      </div>
    </div>
    <div class="plan-item">
      <div class="plan-money">
        <i class="fa-solid fa-user"></i>
        <h2>Pro</h2>
        <h1><span>$</span>89</h1>
        <p>user / month</p>
      </div>

      <div class="plan-benifit">
        <p>Bandwith: 5GB</p>
        <p>OnlineSpace: 4GB</p>
        <p>Support: <strong>Yes</strong></p>
        <a href="#">Buy Now</a>
      </div>
    </div>
  </section> -->

  <!-- <section class="awesome-feature">
    <div id="feature-text">
      <h1>Letest News</h1>
      <p>Lorem ipsum dolor sit amet consectetur <br> adipisicing elit. Fugiat reprehenderit nesciunt magnam
        dolorem voluptate earum nihil, <br> enim similique libero labore nulla natus repellat esse assumenda.
      </p>
    </div>
  </section> -->

  <section class="awesome-feature">
    <div id="feature-text">
      <h1>Misi</h1>
      </p>
    </div>
  </section>

  <section id="letest-news-container">
    <div class="letest-news-item">
    <div class="letest-image">
      <img src="https://i.postimg.cc/QNRJGkPy/image-2023-07-27-12-18-02.png" alt="Image Description">
    </div>
      <!-- <div class="admin-and-calender">
        <div class="calender">
          <i class="fa-solid fa-calendar"></i>
          <p>April 11 2020</p>
        </div>
        <div class="admin">
          <i class="fa-solid fa-user"></i>
          <p>admin</p>
        </div>
      </div> -->
      <div class="letest-text">
        <h1>Platform</h1>
        <p>Menyediakan platform tanda tangan elektronik yang mengutamakan keamanan dan keotentikan transaksi, sehingga setiap dokumen yang ditandatangani melalui aplikasi kami dijamin integritasnya.</p>
      </div>
      <!-- <div class="learn-more-btn">
        <a href="#">Learn more</a>
        <i class="fa-solid fa-arrow-right"></i>
      </div> -->
    </div>

    <div class="letest-news-item">
    <div class="letest-image">
      <img src="https://i.postimg.cc/Kjw2Qs8F/image-2023-07-27-12-22-12.png" alt="Image Description">
    </div>
      <!-- <div class="admin-and-calender">
        <div class="calender">
          <i class="fa-solid fa-calendar"></i>
          <p>April 11 2020</p>
        </div>
        <div class="admin">
          <i class="fa-solid fa-user"></i>
          <p>admin</p>
        </div>
      </div> -->
      <div class="letest-text">
        <h1>Akses Aplikasi</h1>
        <p>Mempermudah pengguna dalam mengakses dan menggunakan aplikasi dengan antarmuka yang intuitif dan ramah pengguna, sehingga pengguna dari berbagai latar belakang dapat dengan mudah mengadopsi teknologi tanda tangan elektronik.</p>
      </div>
      <!-- <div class="learn-more-btn">
        <a href="#">Learn more</a>
        <i class="fa-solid fa-arrow-right"></i>
      </div> -->
    </div>

    <div class="letest-news-item">
    <div class="letest-image">
      <img src="https://i.postimg.cc/X7vqLpn7/image-2023-07-27-12-22-30.png" alt="Image Description">
    </div>
      <!-- <div class="admin-and-calender">
        <div class="calender">
          <i class="fa-solid fa-calendar"></i>
          <p>April 11 2020</p>
        </div>
        <div class="admin">
          <i class="fa-solid fa-user"></i>
          <p>admin</p>
        </div>
      </div> -->
      <div class="letest-text">
        <h1>Ramah Lingkungan</h1>
        <p>Mengurangi penggunaan kertas dan jejak karbon dengan menggalakkan penggunaan tanda tangan elektronik sebagai pengganti tanda tangan konvensional, serta mendukung inisiatif ramah lingkungan dalam setiap aspek pengembangan dan operasional aplikasi.</p>
      </div>
      <!-- <div class="learn-more-btn">
        <a href="#">Learn more</a>
        <i class="fa-solid fa-arrow-right"></i>
      </div> -->
    </div>

  </section>

  <section class="awesome-feature">
    <div id="feature-text">
      <h1>Contact US</h1>
      <!-- <p>Lorem ipsum dolor sit amet consectetur <br> adipisicing elit. -->
      </p>
    </div>
  </section>

  <section id="contact-us">
    <div>
      <div id="contact-form-item">
        <div>
          <label for="name">Name</label> <br>
          <input type="text" placeholder="Your Name"> <br>
        </div>
        <div>
          <label for="email">Email</label> <br>
          <input type="email" placeholder="Your Email"> <br>
        </div>
      </div>

      <label for="message">Messages</label> <br>
      <textarea name="" id="" placeholder="Details your message"></textarea>

      <span id="send-message-btn">
        <input type="submit" value="Send Message">
        <i class="fa-solid fa-rocket"></i>
      </span>

    </div>

    <div>
      <div class="contact-info">
        <i class="fa-solid fa-envelope"></i> &#58;
        <p>contactus@cseeng.com</p>
      </div>
      <div class="contact-info">
        <i class="fa-solid fa-link"></i> &#58;
        <p>http://www.cseeng.com</p>
      </div>
      <div class="contact-info">
        <i class="fa-solid fa-phone"></i> &#58;
        <p>0812423523523</p>
      </div>
      <div class="contact-info">
        <i class="fa-solid fa-clock"></i> &#58;
        <p>9.00 AM - 5.00 PM</p>
      </div>
      <div class="contact-info">
        <i class="fa-solid fa-magnifying-glass-location"></i> &#58;
        <p>Putat Nutug Street, Ciseeng, Bogor 16513</p>
      </div>
    </div>
  </section>

  <footer>
    <div id="footer-name">
      <h2>Creative Learner</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
      <div id="footer-social-icon">
        <i class="fa-brands fa-instagram"></i>
        <i class="fa-brands fa-twitter"></i>
        <i class="fa-brands fa-linkedin"></i>
        <i class="fa-brands fa-facebook"></i>
      </div>
    </div>
    <div class="footer-link">
      <h4>ABOUT US</h4>
      <div>
        <a href="#">Works</a>
        <a href="#">Strotragy</a>
        <a href="#">Release</a>
        <a href="#">Press</a>
        <a href="#">mission</a>
      </div>
    </div>
    <div class="footer-link">
      <h4>CUSTOMERS</h4>
      <div>
        <a href="#">Tranding</a>
        <a href="#">Popular</a>
        <a href="#">Customers</a>
        <a href="#">Features</a>
      </div>
    </div>
    <div class="footer-link">
      <h4>SUPPORT</h4>
      <div>
        <a href="#">Developer</a>
        <a href="#">Support</a>
        <a href="#">Customer Service</a>
        <a href="#">Get started</a>
        <a href="#">Guide</a>
      </div>
    </div>
  </footer>

</body>

</html>

<script>
  document.getElementById("verify").addEventListener("click", function(event) {
    event.preventDefault(); // Prevent the default link behavior (prevents page reload)
    window.location.href = "http://127.0.0.1:8000/verify";
  });
  document.getElementById("jdih").addEventListener("click", function(event) {
    event.preventDefault(); // Prevent the default link behavior (prevents page reload)
    window.location.href = "http://127.0.0.1:8000/jdih";
  });
</script>

<style>
  #letest-news-container {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .letest-news-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
  }

  .letest-image img {
    width: 200px;
    height: 200px;
    /* Optional: If you want to add some space between the images, you can use margin */
    margin: 10px;
  }
</style><style>
  #letest-news-container {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .letest-news-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
  }

  .letest-image img {
    width: 200px;
    height: 200px;
    /* Optional: If you want to add some space between the images, you can use margin */
    margin: 10px;
  }
</style>
