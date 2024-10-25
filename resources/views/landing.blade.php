<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home || BEAUTY NOW</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style1.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <!--Header Site-->
    <header>

        <div class="logo header-top">
            <i>
                <img src="img/lipstick.svg">
            </i><span>BEAUTINOW</span>
        </div>

        <div class="header-bot">
            <ul class="navlist">
                <li><a href="#home" style="--i:1;">Home</a></li>
                <li><a href="#profil" style="--i:2">Features</a></li>
                {{-- <li><a href="#visimisi" style="--i:3">Visi&Misi</a></li> --}}
                <li><a href="#galery" style="--i:4">Galery</a></li>
                {{-- <li><a href="#info" style="--i:5">Info<i class='bx bx-chevron-down'></i></a>
                        <ul class="dropdown-item">
                            <li><a href="#">Info Guru</a></li>
                            <li><a href="#">Info Alumni</a></li>
                            <li><a href="#">Berita</a></li>
                            <li><a href="#">Artikel</a></li>

                        </ul>
                    </li> --}}
                    <li><a href="#contact" style="--i:6">Contact</a></li>
                    {{-- <li><a href="#about" style="--i:7">About</a></li> --}}
            </ul>
        </div>

        <div id="menu-icon"><i class='bx bx-menu'></i></div>
    </header>


    <!--Home section-->

    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="5000">
                <section id="home" class="home">
                    <div class="home-content scroll-scale">
                        <div class="change-text">
                            <h3>Get</h3>
                            <h3>
                                <span class="word">Glam!</span>
                                <span class="word">Beauty! </span>
                                <span class="word">Gorgeous!</span>
                                {{-- <span class="word">The&nbsp;Best</span>
                                    <span class="word">Future&nbsp;Ever</span> --}}
                            </h3>
                        </div>
                        <h1>Welcome to <span style="color: #D76F6F;">BeautiNow</span>!</h1>



                        <p>Discover Your Perfect Look With Beauty Now! Booking Top-Rated Makeup Artists Near You With
                            You Just A Few
                            Taps, Anywhere, Anytime.</p>

                        {{-- <div class="info-box">
                                <div class="email-info">
                                    <h5>Email</h5>
                                    <span>yowes@gmail.com</span>
                                </div>
                                <div class="behance-info">
                                    <h5>Behance :</h5>
                                    <span>behance.net/yowes</span>
                                </div>
                            </div> --}}

                        <div class="btn-box">
                            {{-- <a href="#" class="btn">Download Info</a> --}}
                            <a href="/logout" class="btn">Get Started!</a>
                        </div>

                        {{-- <div class="social-icons">
                                <a href="#"><i class='bx bxl-facebook' ></i></a>
                                <a href="#"><i class='bx bxl-instagram' ></i></a>
                                <a href="#"><i class='bx bxl-twitter' ></i></i></a>
                                <a href="#"><i class='bx bxl-dribbble' ></i></a>
                            </div> --}}
                    </div>
                    <div class="image-content">
                        <img src="img/bg.png" alt="Makeup Image">
                    </div>
                </section>
            </div>
            <div class="carousel-item slide-two" data-bs-interval="3000">
                <img src="img/bg3.jpg" class="d-block" alt="Slide 2">
                <div class="carousel-caption centered-caption d-none d-md-block">
                    <h2><span>Making Your</span> Outer Beauty</h2>
                    <h2><span>Match Your</span> Inner Beauty</h2>
                  </div>
            </div>
            <div class="carousel-item slide-3">
                <img src="img/bg2.jpg" class="d-block" alt="Slide 2">
                <div class="carousel-caption centered-caption d-none d-md-block">
                    <h2><span>Making Your</span> Outer Beauty</h2>
                    <h2><span>Match Your</span> Inner Beauty</h2>
                  </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>



    <!--Profil section-->
    <section id="profil" class="profil">
        <div class="main-text scroll-scale">
            <span></span> <br>
            <span></span>
            <h2>Product Features</h2>
            <span>Booking online memudahkan Anda memesan layanan, melihat portofolio, dan berkonsultasi langsung dengan
                make up artist profesional dalam satu platform.</span>
        </div>

        <div class="section-profil scroll-bottom">
            <div class="profil-box">
                <i class='bx bx-calendar-plus profil-icon'></i>
                <h5>Booking Online</h5>
                <p>Pesan Layanan Make Up secara Instan Dan Mudah </p>
                {{-- <div class="btn-box profil-btn">
                    <a href="#" class="btn">Read More</a>
                </div> --}}
            </div>

            <div class="profil-box">
                <i class='bx bx-photo-album profil-icon'></i>
                <h5>Galeri Portofolio</h5>
                <p>Jelajahi Kayra Terbaik Kami Untuk Inspirasi Riasan Anda</p>
                {{-- <div class="btn-box profil-btn">
                    <a href="#" class="btn">Read More</a>
                </div> --}}
            </div>

            <div class="profil-box">
                <i class='bx bx-gift profil-icon'></i>
                <h5>Promo & Paket Ekslusif</h5>
                <p>Penawaran Khusus Untuk Berbagai Kebutuhan Riasan Anda</p>
                {{-- <div class="btn-box profil-btn">
                    <a href="#" class="btn">Read More</a>
                </div> --}}
            </div>

            <div class="profil-box">
                <i class='bx bx-comment-detail profil-icon'></i>
                <h5>Testimonial Pelanggan</h5>
                <p>Tinjau Ulasan Langsung Dari Klien Yang Puas </p>
                {{-- <div class="btn-box profil-btn">
                    <a href="#" class="btn">Read More</a>
                </div> --}}
            </div>
        </div>
    </section>

    <!--visi&misi section-->
    {{-- <section id="visimisi" class="visimisi">
        <div class="main-text scroll-scale">
            <span>Pencapaian yang Diinginkan</span>
            <h2>Visi & Misi Kami</h2>
        </div>

        <div class="visimisi-main">
            <div class="visimisi-left scroll-scale">
                <h3>Misi Kami</h3>
                <div class="visimisi-bar">
                    <div class="info">
                        <p>Meningkatkan keimanan dan penghayatan<br>serta pengalaman terhadap agama</p>
                        <p>72%</p>
                    </div>
                    <div class="bar">
                        <span class="html"></span>
                    </div>
                </div>

                <div class="visimisi-bar">
                    <div class="info">
                        <p>Membentuk capaian 90% lulusan<br>yang memiliki Akhlaqul Karimah. </p>
                        <p>90%</p>
                    </div>
                    <div class="bar">
                        <span class="figma"></span>
                    </div>
                </div>

                <div class="visimisi-bar ">
                    <div class="info">
                        <p>Menciptakan kondisi pembelajaran<br>yang choice, creativity, critical thinking</p>
                        <p>80%</p>
                    </div>
                    <div class="bar">
                        <span class="javascript"></span>
                    </div>
                </div>

                <div class="visimisi-bar">
                    <div class="info">
                        <p>Meningkatkan capaian 50% lulusan ke PTN,<br>meningkatkan capaian 60% lulusan menguasai IPTEK
                        </p>
                        <p>62%</p>
                    </div>
                    <div class="bar">
                        <span class="css"></span>
                    </div>
                </div>

            </div>
            <div class="visimisi-right scroll-scale">
                <h3>Visi Kami</h3>
                <div class="misi">
                    <div class="box">
                        <div class="circle" data-dots="80" data-percent="90"></div>
                        <div class="text">
                            <big>90%</big>
                            <small>Bertaqwa</small>
                        </div>
                    </div>

                    <div class="box">
                        <div class="circle" data-dots="80" data-percent="80"></div>
                        <div class="text">
                            <big>80%</big>
                            <small>Berkualitas</small>
                        </div>
                    </div>

                    <div class="box">
                        <div class="circle" data-dots="80" data-percent="55"></div>
                        <div class="text">
                            <big>55%</big>
                            <small>Kompetitif</small>
                        </div>
                    </div>

                    <div class="box">
                        <div class="circle" data-dots="80" data-percent="70"></div>
                        <div class="text">
                            <big>70%</big>
                            <small>Menguasai IPTEK</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!--Galery section-->
    <section id="galery" class="galery">
        <div class="main-text scroll-scale">
            <span>Kamu Bisa Melihat Beberapa</span>
            <h2>Gallery Favorit</h2>
        </div>

        <div class="fillter-buttons scroll-scale">
            <button class="button" data-filter="all">All</button>
            <button class="button" data-filter=".osis">MUA</button>
            <button class="button" data-filter=".pramuka">Make Up</button>
            <button class="button" data-filter=".paskibra">Artist</button>
        </div>

        <div class="ekstrakurikuler-gallery scroll-bottom">
            <div class="ekskul-box mix osis">
                <div class="ekskul-image">
                    <img src="img/galery1.jpg" alt="">
                </div>
                <div class="ekskul-content">
                    <h3>ALL BEAUTY</h3>
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. A recusandae, libero et possimus hic
                        animi eius sequi neque illum amet, vel natus eveniet aut! Porro doloremque sapiente aliquam
                        ducimus cumque!
                    </p>
                    <a href="#"><i class='bx bx-link-external'></i></a>
                </div>
            </div>

            <div class="ekskul-box mix osis">
                <div class="ekskul-image">
                    <img src="/img/galery2.jpg" alt="">
                </div>
                <div class="ekskul-content">
                    <h3>Beauty</h3>
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. A recusandae, libero et possimus hic
                        animi eius sequi neque illum amet, vel natus eveniet aut! Porro doloremque sapiente aliquam
                        ducimus cumque!
                    </p>
                    <a href="#"><i class='bx bx-link-external'></i></a>
                </div>
            </div>

            <div class="ekskul-box pramuka">
                <div class="ekskul-image">
                    <img src="img/galery3.jpg" alt="">
                </div>
                <div class="ekskul-content">
                    <h3>Make Up</h3>
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. A recusandae, libero et possimus hic
                        animi eius sequi neque illum amet, vel natus eveniet aut! Porro doloremque sapiente aliquam
                        ducimus cumque!
                    </p>
                    <a href="#"><i class='bx bx-link-external'></i></a>
                </div>
            </div>

            <div class="ekskul-box mix paskibra">
                <div class="ekskul-image">
                    <img src="img/galery4.jpg" alt="">
                </div>
                <div class="ekskul-content">
                    <h3>Atist</h3>
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. A recusandae, libero et possimus hic
                        animi eius sequi neque illum amet, vel natus eveniet aut! Porro doloremque sapiente aliquam
                        ducimus cumque!
                    </p>
                    <a href="#"><i class='bx bx-link-external'></i></a>
                </div>
            </div>

        </div>
        </div>
    </section>

    <!--Info section-->
    <section id="info" class="info">
        <div class="main-text scroll-scale">
            <span>You Can Read</span>
            <h2>The Info</h2>
        </div>

        <div class="fillter-buttons scroll-scale">
            <button class="button" data-filter="all">All</button>
            <button class="button" data-filter=".teacher">MUA</button>
            <button class="button" data-filter=".alumni">Beauty</button>
            <button class="button" data-filter=".berita">Make Up</button>
            <button class="button" data-filter=".artikel">Atist</button>
        </div>

        <div class="info-g scroll-bottom">
            <div class="infu-box mix teacher">
                <div class="infu-image">
                    <img src="img/galery1.jpg" alt="">
                </div>
                <div class="infu-content">
                    <h3>Info MUA</h3>
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. A recusandae, libero et possimus hic
                        animi eius sequi neque illum amet, vel natus eveniet aut! Porro doloremque sapiente aliquam
                        ducimus cumque!
                    </p>
                    <a href="#"><i class='bx bx-link-external'></i></a>
                </div>
            </div>

            <div class="infu-box mix alumni">
                <div class="infu-image">
                    <img src="img/galery2.jpg" alt="">
                </div>
                <div class="infu-content">
                    <h3>Info Beauty</h3>
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. A recusandae, libero et possimus hic
                        animi eius sequi neque illum amet, vel natus eveniet aut! Porro doloremque sapiente aliquam
                        ducimus cumque!
                    </p>
                    <a href="#"><i class='bx bx-link-external'></i></a>
                </div>
            </div>

            <div class="infu-box mix berita">
                <div class="infu-image">
                    <img src="img/galery3.jpg" alt="">
                </div>
                <div class="infu-content">
                    <h3>Make UP</h3>
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. A recusandae, libero et possimus hic
                        animi eius sequi neque illum amet, vel natus eveniet aut! Porro doloremque sapiente aliquam
                        ducimus cumque!
                    </p>
                    <a href="#"><i class='bx bx-link-external'></i></a>
                </div>
            </div>

            <div class="infu-box mix artikel">
                <div class="infu-image">
                    <img src="img/galery4.jpg" alt="">
                </div>
                <div class="infu-content">
                    <h3>Arttist</h3>
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. A recusandae, libero et possimus hic
                        animi eius sequi neque illum amet, vel natus eveniet aut! Porro doloremque sapiente aliquam
                        ducimus cumque!
                    </p>
                    <a href="#"><i class='bx bx-link-external'></i></a>
                </div>
            </div>

        </div>
        </div>
    </section>

    <!--Contact section-->
    <section id="contact" class="contact">
        <div class="main-text scroll-scale">
            <span>Ask For Question</span>
            <h2>Contact Us</h2>
        </div>

        <form action="#" class="scroll-bottom">
            <input type="text" placeholder="Your Name">
            <input type="text" placeholder="Your Email">
            <input type="text" placeholder="Your Address">
            <input type="number" placeholder="Phone Number">
            <textarea name="" id="" cols="30" rows="10" placeholder="Your Message"></textarea>
            <div class="btn-box formBtn">
                <button type="submit" class="btn">Send Message</button>
            </div>
        </form>
    </section>

    <!--About section-->
    {{-- <section id="about" class="about">
            <div class="img-about scroll-scale">
                <img src="img/nani.png" alt="">
                <div class="info-about1">
                    <span>10+</span>
                    <p>Years of Experience</p>
                </div>

                <div class="info-about2">
                    <span>150+</span>
                    <p>Project Complete</p>
                </div>

                <div class="info-about3">
                    <span>200+</span>
                    <p>Happy Birthday</p>
                </div>
            </div>

            <div class="about-content scroll-scale">
                <span>Let me introduce myself</span>
                <h2>About Me</h2>
                <h3>A story of good</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum commodi ab maxime perspiciatis beatae impedit doloremque explicabo cum, officiis eveniet sequi quae iusto nostrum, dicta non aut? Deleniti, consequatur asperiores.</p>

                <div class="btn-box">
                    <a href="#" class="btn">Read More!</a>
                </div>

                <div class="liquid-shape">
                    <svg viewBox="0 0 500 500"
                    xmlns="http://www.w3.org/ 2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" id="blobSvg">
                        <path fill="#12f7ff">
                            <animate attributeName="d"
                                dur="20000ms"
                                repeatCount="indefinite"
                                values="
                                M467,310.5Q438,371,395,422.5Q352,474,286.5,462Q221,450,173.5,422Q126,394,90,350.5Q54,307,60,251.5Q66,196,91,145.5Q116,95,169.5,79.5Q223,64,284,53Q345,42,376,95.5Q407,149,451.5,199.5Q496,250,467,310.5Z;

                                M435,293Q383,336,350.5,367Q318,398,269.5,423.5Q221,449,182.5,410.5Q144,372,90.5,342.5Q37,313,64.5,258.5Q92,204,121.5,169.5Q151,135,189.5,115.5Q228,96,282.5,77.5Q337,59,367,107.5Q397,156,442,203Q487,250,435,293Z;

                                M410.5,305Q421,360,381,404Q341,448,278,471.5Q215,495,181.5,431Q148,367,89.5,340.5Q31,314,24,247.5Q17,181,65,136.5Q113,92,170,90.5Q227,89,283.5,71Q340,53,392.5,88.5Q445,124,422.5,187Q400,250,410.5,305Z;

                                M440.5,305.5Q423,361,387,416Q351,471,288,447.5Q225,424,179,404.5Q133,385,101.5,344Q70,303,51,244.5Q32,186,64.5,130Q97,74,156,39.5Q215,5,282.5,18Q350,31,367,97.5Q384,164,421,207Q458,250,440.5,305.5Z;

                                M433,298Q400,346,357,367.5Q314,389,267.5,419.5Q221,450,166,430Q111,410,89,357Q67,304,80,254Q93,204,116.5,164Q140,124,177.5,65Q215,6,267.5,52Q320,98,348,133.5Q376,169,421,209.5Q466,250,433,298Z;

                                M431.5,300Q405,350,372,398Q339,446,278,464Q217,482,181.5,426Q146,370,92,341Q38,312,47,252.5Q56,193,79.5,136.5Q103,80,160,50.5Q217,21,269,57.5Q321,94,359,125Q397,156,427.5,203Q458,250,431.5,300Z;

                                M407.27781,297.87525Q398.20079,345.75049,372.8499,405.22416Q347.49901,464.69783,284.79921,454.65109Q222.09941,444.60434,173.42594,419.62574Q124.75247,394.64714,87.75049,351.62377Q50.74852,308.60039,71.64714,256.32456Q92.54575,204.04872,95.64812,139.89961Q98.75049,75.75049,157.4503,44.12574Q216.1501,12.50099,273.67446,42.62673Q331.19882,72.75247,375.99803,106.30217Q420.79724,139.85188,418.57604,194.92594Q416.35484,250,407.27781,297.87525Z;

                                M467,310.5Q438,371,395,422.5Q352,474,286.5,462Q221,450,173.5,422Q126,394,90,350.5Q54,307,60,251.5Q66,196,91,145.5Q116,95,169.5,79.5Q223,64,284,53Q345,42,376,95.5Q407,149,451.5,199.5Q496,250,467,310.5Z;

                                "
                            ></animate>
                        </path>
                    </svg>
                </div>
            </div>
        </section> --}}

    <!--Footer section-->
    <footer>
        <p class="scroll-scale">Copyright &copy; 2023  || All Right Reserved</p>
        <a href="#home"><i class='bx bx-up-arrow-alt'></i></a>
    </footer>

    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/mixitup.min.js"></script>
    <script src="/js/scriptlanding.js"></script>
</body>

</html>
