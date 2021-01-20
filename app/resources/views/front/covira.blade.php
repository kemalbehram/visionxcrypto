<!doctype html>
<html lang="en">



<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Template meta tags -->
    <meta name="description" content="coronavirus prevention and awareness template">
    <meta name="keywords" content="Coronavirus,COVID-19,Medical,Prevention,Awareness,Live Report">
    <meta name="author" content="Marvel Theme">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="covidasset/img/logo/favicon.png">

    <!-- Title -->
    <title>Covid-19 Care | Vision-X Crypto</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="covidasset/css/bootstrap.min.css">

    <!-- Icon Font -->
    <link rel="stylesheet" href="covidasset/css/line-awesome.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,400;0,500;0,600;0,700;1,400&amp;display=swap"
          rel="stylesheet">

    <!-- AOS -->
    <link rel="stylesheet" href="covidasset/css/aos.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="covidasset/css/style.css">

    <!-- Custom CSS for end users -->
    <link rel="stylesheet" href="covidasset/css/custom.css">
</head>

<body>

<!-- Preloader -->
<div id="preloader-wrapper">
    <div class="preloader-wave-effect"></div>
    <div class="preloader-text">Loading</div>
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{url('/')}}">
            <img src="covidasset/img/logo/logo.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="las la-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"
                       aria-expanded="false">Home</a>

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about" data-scroll>What is COVID?</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#transmission" data-scroll>How it Spreads</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#symptoms" data-scroll>Symptoms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#prevention" data-scroll>Prevention</a>
                </li>
            </ul>
            <div class="navbar-cta d-none d-lg-block">
                <a href="#contact" class="btn btn-primary" data-scroll>
                    <i class="las la-headset"></i>
                    <span>Online Help</span>
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- Hero -->
<section class="hero-section s-bg-light" id="home">
    <div class="container">
        <div class="row flex-column">
            <div class="col-xl-10 mx-auto">
                <div class="hero-content text-center">
                    <div class="section-header">
                        <p class="subheading">CORONAVIRUS PREVENTION</p>
                    </div>
                    <h1>
                        Keep yourself safe at all times <br>
                        <span class="text-primary">Stay Home, Stay Safe.</span>
                    </h1>
                    <div class="buttons">
                        <a href="#prevention" class="btn btn-lg btn-primary" data-scroll>COVID-19 Prevention</a>
                        <a href="#symptoms" class="btn btn-lg btn-pink" data-scroll>COVID-19 Symtoms</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-10 mx-auto">
                <div class="hero-img">
                    <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_wdXBRc.json"
                                   background="transparent.html" speed="1" loop autoplay>
                    </lottie-player>
                </div>
            </div>
        </div>
        <div class="hero-graphics">
            <div class="graphic graphic-1" data-aos="fade-up" data-aos-delay="1000">
                <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_0r0csU.json"
                               background="transparent.html" speed=".7" style="width: 90px; height: 90px;" loop autoplay>
                </lottie-player>
            </div>
            <div class="graphic graphic-2" data-aos="fade-up" data-aos-delay="1050">
                <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_wpGbRj.json"
                               background="transparent.html" speed=".7" style="width: 120px; height: 120px;" loop autoplay>
                </lottie-player>
            </div>
            <div class="graphic graphic-3" data-aos="fade-up" data-aos-delay="1100">
                <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_wpGbRj.json"
                               background="transparent.html" speed=".7" style="width: 120px; height: 120px;" loop autoplay>
                </lottie-player>
            </div>
            <div class="graphic graphic-4" data-aos="fade-up" data-aos-delay="1150">
                <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_0r0csU.json"
                               background="transparent.html" speed=".7" style="width: 90px; height: 90px;" loop autoplay>
                </lottie-player>
            </div>
        </div>
    </div>
</section>

<!-- Corona news -->
<section class="corona-updates-section">
    <div class="container">
        <div class="corona-updates-inner">
            <div class="section-header text-center mb-4 mb-md-5">
                <h4 class="heading">COVID-19 GLOBAL LIVE UPDATE</h4>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-3 statistics-card card-info" data-aos="fade-up">
                    <div class="statistics-card-inner">
                        <h3 class="data-header" id="totalCases"></h3>
                        <p>Total cases</p>
                        <img src="covidasset/img/shapes/1.png" alt="" class="img-fluid shape">
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 statistics-card card-danger" data-aos="fade-up" data-aos-delay="50">
                    <div class="statistics-card-inner">
                        <h3 class="data-header" id="totalDeaths"></h3>
                        <p>Total deaths</p>
                        <img src="covidasset/img/shapes/1.png" alt="" class="img-fluid shape">
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 statistics-card card-success" data-aos="fade-up" data-aos-delay="100">
                    <div class="statistics-card-inner">
                        <h3 class="data-header" id="totalRecovered"></h3>
                        <p>Total recovered</p>
                        <img src="covidasset/img/shapes/1.png" alt="" class="img-fluid shape">
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 statistics-card card-warning" data-aos="fade-up" data-aos-delay="150">
                    <div class="statistics-card-inner">
                        <h3 class="data-header" id="newCases"></h3>
                        <p>New cases</p>
                        <img src="covidasset/img/shapes/1.png" alt="" class="img-fluid shape">
                    </div>
                </div>
            </div>

            <div class="text-center mx-auto mt-4 mt-md-5">
                <a href="https://www.worldometers.info/coronavirus/" target="_blank" class="text-link">Check Live
                    Situation Dashboard</a>
            </div>
        </div>
    </div>
</section>

<!-- About -->
<section class="about-covid-section pt-lg" id="about">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-xl-6">
                <div class="about-covid">
                    <div class="section-header">
                        <p class="subheading">About Covid-19</p>
                        <h2 class="heading">Coronavirus disease (COVID-19)</h2>
                    </div>

                    <p>
                        Coronavirus disease (COVID-19) is an infectious disease caused by a newly
                        discovered coronavirus. Most people infected with the COVID-19 will experience mild to
                        moderate respiratory illness and recover without requiring special
                        treatment. Older people, and those with underlying medical problems like cardiovascular
                        disease, diabetes, chronic respiratory disease, and cancer are more likely to develop
                        serious illness.
                    </p>

                    <p>
                        The best way to prevent and slow down transmission is be well informed about the COVID-19
                        virus, the disease it causes and how it spreads. Protect yourself & others from infection by
                        washing your hands or using an alcohol based rub frequently and not touching your face.
                    </p>
                    <a href="#prevention" class="btn btn-lg btn-primary mt-3" data-scroll>
                        <i class="las la-shield-alt"></i>
                        How we Protect?
                    </a>
                </div>
            </div>
            <div class="col-md-5 offset-xl-1">
                <div class="about-img">
                    <img src="covidasset/img/about/1.png" alt="" class="img-fluid">
                    <div class="about-graphics">
                        <div class="graphic graphic-1">
                            <lottie-player src="https://covidasset6.lottiefiles.com/packages/lf20_wpGbRj.json"
                                           background="transparent.html" speed=".7" style="width: 60px; height: 60px;" loop
                                           autoplay>
                            </lottie-player>
                        </div>
                        <div class="graphic graphic-2">
                            <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_wpGbRj.json"
                                           background="transparent.html" speed=".7" style="width: 100px; height: 100px;" loop
                                           autoplay>
                            </lottie-player>
                        </div>
                        <div class="graphic graphic-3">
                            <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_wpGbRj.json"
                                           background="transparent.html" speed=".7" style="width: 80px; height: 80px;" loop
                                           autoplay>
                            </lottie-player>
                        </div>
                        <div class="graphic graphic-4">
                            <lottie-player src="https://assets9.lottiefiles.com/packages/lf20_Iz3ReK.json"
                                           background="transparent.html" speed="1" style="width: 80px; height: 80px;" loop autoplay>
                            </lottie-player>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Transmission -->
<section class="covid-transmission-section py-lg" id="transmission">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 mx-auto">
                <div class="section-header text-center">
                    <p class="subheading">COVID-19 Tramsmission</p>
                    <h2 class="heading">How Coronavirus COVID-19 Spread</h2>
                    <p>People can catch COVID-19 from others who have the virus. The disease can spread from person
                        to person through small droplets from the nose or mouth which are spread when a person with
                        COVID-19 coughs or exhales.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="transmission-card">
                    <img src="covidasset/img/transmission/1.png" alt="" class="img-fluid">
                    <h4>Coughs from Infected Person</h4>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="transmission-card">
                    <img src="covidasset/img/transmission/2.png" alt="" class="img-fluid">
                    <h4>Sneezes from Infected Person</h4>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="transmission-card">
                    <img src="covidasset/img/transmission/3.png" alt="" class="img-fluid">
                    <h4>Touching Contaminated Object or Surfaces</h4>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="transmission-card">
                    <img src="covidasset/img/transmission/4.png" alt="" class="img-fluid">
                    <h4>Close Contact with Infected Person</h4>
                </div>
            </div>
        </div>

        <div class="text-center mx-auto mt-5">
            <a href="#symptoms" class="text-link" data-scroll>Check COVID-19 Symptoms</a>
        </div>
    </div>
</section>

<!-- Symptoms -->
<section class="covid-symptoms-section py-lg s-bg-light" id="symptoms">
    <div class="graphics">
        <div class="graphic graphic-1">
            <img src="covidasset/img/shapes/1.png" alt="">
        </div>
        <div class="graphic graphic-2">
            <img src="covidasset/img/shapes/1.png" alt="">
        </div>
        <div class="graphic graphic-3">
            <img src="covidasset/img/shapes/1.png" alt="">
        </div>
        <div class="graphic graphic-4">
            <img src="covidasset/img/shapes/1.png" alt="">
        </div>
        <div class="graphic graphic-5">
            <img src="covidasset/img/shapes/1.png" alt="">
        </div>
        <div class="graphic graphic-6">
            <img src="covidasset/img/shapes/1.png" alt="">
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="section-header text-center">
                    <p class="subheading">COVID-19 symptoms</p>
                    <h2 class="heading">Coronavirus COVID-19 Symptoms</h2>
                    <p>
                        The most common symptoms of COVID-19 are fever, tiredness, and dry cough. Some patients may
                        have aches and pains, nasal congestion, runny nose, sore throat or diarrhea.
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-4 symptom-card style-2 text-center" data-aos="fade-up">
                <div class="symptom-card-inner h-100">
                    <div class="card-img">
                        <img src="covidasset/img/symptoms/1.png" alt="" class="img-fluid rounded-circle">
                    </div>
                    <h4>High Fever</h4>
                    <p>
                        According to the WHO, the most common symptoms of Covid-19 are fever. Fever is a key
                        symptom, experts say.
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 symptom-card style-2 text-center" data-aos="fade-up" data-aos-delay="50">
                <div class="symptom-card-inner h-100">
                    <div class="card-img">
                        <img src="covidasset/img/symptoms/2.png" alt="" class="img-fluid rounded-circle">
                    </div>
                    <h4>Sore Throat</h4>
                    <p>
                        A scratchy sensation in the throat, pain in the throat area that becomes worse when
                        swallowing or talking.
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 symptom-card style-2 text-center" data-aos="fade-up" data-aos-delay="100">
                <div class="symptom-card-inner h-100">
                    <div class="card-img">
                        <img src="covidasset/img/symptoms/3.png" alt="" class="img-fluid rounded-circle">
                    </div>
                    <h4>Dry Cough</h4>
                    <p>
                        Basically, a dry cough is "one where no mucus or phlegm is produced with the cough, A cough
                        that doesn’t go away.
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 symptom-card style-2 text-center" data-aos="fade-up">
                <div class="symptom-card-inner h-100">
                    <div class="card-img">
                        <img src="covidasset/img/symptoms/4.png" alt="" class="img-fluid rounded-circle">
                    </div>
                    <h4>Sneezing</h4>
                    <p>
                        Sneezing is very common symptom in Coronavirus patient. Sneezing (sternutation) is the act
                        of expelling a sudden
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 symptom-card style-2 text-center" data-aos="fade-up" data-aos-delay="50">
                <div class="symptom-card-inner h-100">
                    <div class="card-img">
                        <img src="covidasset/img/symptoms/5.png" alt="" class="img-fluid rounded-circle">
                    </div>
                    <h4>Shortness of Breath</h4>
                    <p>
                        Commonly known as tightening in the chest, air hunger, difficulty breathing, feeling of
                        suffocation. These symptoms.
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 symptom-card style-2 text-center" data-aos="fade-up" data-aos-delay="100">
                <div class="symptom-card-inner h-100">
                    <div class="card-img">
                        <img src="covidasset/img/symptoms/6.png" alt="" class="img-fluid rounded-circle">
                    </div>
                    <h4>Vomiting</h4>
                    <p>
                        It’s not a regular symptoms of coronavirus patients Symptoms that occur with nausea and
                        vomiting include: abdominal pain
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Prevention -->
<section class="covid-prevention-section py-lg" id="prevention">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="section-header text-center">
                    <p class="subheading">COVID-19 Prevention</p>
                    <h2 class="heading">Coronavirus COVID-19 Prevention</h2>
                    <p>You can protect yourself and help prevent spreading the coronavirus (COVID-19) to others if
                        you do all the step shown as this infographics. You can safe from coronavirus and safe other
                        if you are affected</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-4 text-center prevention-card">
                <div class="prevention-card-inner">
                    <div class="icon">
                        <lottie-player class="mx-auto"
                                       src="https://assets1.lottiefiles.com/private_files/lf30_Rq4Htd.json"
                                       background="transparent.html" speed="1" style="width: 180px; height: 180px;" loop autoplay>
                        </lottie-player>
                    </div>
                    <h4>Wash Your Hands</h4>
                    <p>
                        Wash your hands frequently and regularly with an alcohol based hand rub or wash them with
                        soap and water.
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 text-center prevention-card">
                <div class="prevention-card-inner">
                    <div class="icon">
                        <lottie-player class="mx-auto"
                                       src="https://assets1.lottiefiles.com/private_files/lf30_oGbdoA.json"
                                       background="transparent.html" speed="1" style="width: 180px; height: 180px;" loop autoplay>
                        </lottie-player>
                    </div>
                    <h4>Wear Face Mask</h4>
                    <p>
                        Wear sergical mask and avoid touching face. Hands touch many surfaces and can pick up
                        viruses once contaminated.
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 text-center prevention-card">
                <div class="prevention-card-inner">
                    <div class="icon">
                        <lottie-player class="mx-auto"
                                       src="https://assets1.lottiefiles.com/private_files/lf30_QLsD8M.json"
                                       background="transparent.html" speed="1" style="width: 180px; height: 180px;" loop autoplay>
                        </lottie-player>
                    </div>
                    <h4>Avoid Close Contact</h4>
                    <p>
                        Please maintain at least 1 metre (3 feet) distance between yourself and anyone who is
                        coughing or sneezing.
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 text-center prevention-card">
                <div class="prevention-card-inner">
                    <div class="icon">
                        <lottie-player class="mx-auto"
                                       src="https://assets9.lottiefiles.com/packages/lf20_qFttfS.json" background="transparent.html"
                                       speed="1" style="width: 180px; height: 180px;" loop autoplay>
                        </lottie-player>
                    </div>
                    <h4>Stay at Home</h4>
                    <p>
                        Stay home, stay safe. if you feel unwell. If you have a fever, cough and difficulty
                        breathing, seek medical attention.
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 text-center prevention-card">
                <div class="prevention-card-inner">
                    <div class="icon">
                        <lottie-player class="mx-auto"
                                       src="https://assets1.lottiefiles.com/private_files/lf30_yQtj4O.json"
                                       background="transparent.html" speed="1" style="width: 180px; height: 180px;" loop autoplay>
                        </lottie-player>
                    </div>
                    <h4>Use Soap or Sanitizer</h4>
                    <p>
                        Use alcohol based hand sanitizer or soap when you wash your hands. Keep wash yor hands at
                        least 20 minute during handwash.
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 text-center prevention-card">
                <div class="prevention-card-inner">
                    <div class="icon">
                        <lottie-player class="mx-auto" src="https://assets9.lottiefiles.com/temp/lf20_qCBn5k.json"
                                       background="transparent.html" speed="1" style="width: 180px; height: 180px;" loop autoplay>
                        </lottie-player>
                    </div>
                    <h4>Keep Inform Doctors</h4>
                    <p>
                        If you are think you are suffering with this above symptoms. Please call a doctor as soon as
                        posible for your medical advice.
                    </p>
                </div>
            </div>
        </div>

        <div class="text-center mx-auto mt-5">
            <a href="https://covid.amcharts.com/" target="_blank" class="text-link">
                Check out Coronavirus Live Situation Dashboard</a>
        </div>
    </div>
</section>

<!-- Callout -->
<section class="callout-section pt-md pb-lg s-bg-primary" id="contact">
    <img src="covidasset/img/bg/1.jpg" alt="" class="parallax-bg">
    <div class="container">
        <div class="row">
            <div class="col-xl-11 mx-auto text-center">
                <div class="callout">
                    <lottie-player class="mx-auto" src="https://assets9.lottiefiles.com/packages/lf20_nKCnOy.json"
                                   background="transparent.html" speed="1" style="width: 200px; height: 200px;" loop autoplay>
                    </lottie-player>
                    <h2 class="text-light">If you think you are suffering with Coronavirus Symptoms please chat with
                        online doctors or make an appoinment </h2>
                    <div class="buttons">
                        <a href="https://covid19.ncdc.gov.ng/contact/" class="btn btn-lg btn-white">
                            <i class="lab la-facebook-messenger"></i>
                            Call NCDC Health Line
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Hand washing steps -->
<section class="hand-washing-steps-section style-2 py-lg">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <div class="section-header text-center">
                    <p class="subheading">Hand wash process</p>
                    <h2 class="heading">Wash your hands very often</h2>
                    <p>
                        You can protect yourself and help prevent spreading the coronavirus (COVID-19) to others if
                        you do all the step shown as this infographics. You can safe from coronavirus and safe other
                        if you are affected
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-10 mx-auto">
                <div class="hand-washing-steps style-2">
                    <div class="step">
                        <div class="img-box">
                            <img src="covidasset/img/hand-wash/1.png" alt="" class="img-fluid">
                        </div>
                        <h5>Wet Hands</h5>
                    </div>
                    <div class="step">
                        <div class="img-box">
                            <img src="covidasset/img/hand-wash/2.png" alt="" class="img-fluid">
                        </div>
                        <h5>Apply Soap</h5>
                    </div>
                    <div class="step">
                        <div class="img-box">
                            <img src="covidasset/img/hand-wash/3.png" alt="" class="img-fluid">
                        </div>
                        <h5>Rub Hands Palm to Palm</h5>
                    </div>
                    <div class="step">
                        <div class="img-box">
                            <img src="covidasset/img/hand-wash/4.png" alt="" class="img-fluid">
                        </div>
                        <h5>Wash Between Fingers</h5>
                    </div>
                    <div class="step">
                        <div class="img-box">
                            <img src="covidasset/img/hand-wash/5.png" alt="" class="img-fluid">
                        </div>
                        <h5>Rub Wrists</h5>
                    </div>
                    <div class="step">
                        <div class="img-box">
                            <img src="covidasset/img/hand-wash/6.png" alt="" class="img-fluid">
                        </div>
                        <h5>Dry with a Single use Towel</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="hand-wash-img">
            <lottie-player class="anim-img" src="https://assets4.lottiefiles.com/private_files/lf30_kLBIzB.json"
                           background="transparent.html" speed="1" loop autoplay>
            </lottie-player>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="faq-section py-lg s-bg-light" id="faq">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <div class="section-header text-center">
                    <p class="subheading">COVID-19 FAQ</p>
                    <h2 class="heading">Frequently Asked Questions</h2>
                    <p>
                        Coronavirus disease (COVID-19) is an infectious disease caused by a newly discovered
                        coronavirus. Most people infected with the COVID-19 virus will experience
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="nav flex-row flex-md-column nav-pills faq-tab" id="faq-tab" role="tablist"
                     aria-orientation="vertical">
                    <a class="nav-link active" id="general-tab" data-toggle="pill" href="#general-tab-pane"
                       role="tab">General</a>
                    <a class="nav-link" id="covid-19-tab" data-toggle="pill" href="#covid-19-tab-pane"
                       role="tab">COVID-19</a>
                    <a class="nav-link" id="prevention-tab" data-toggle="pill" href="#prevention-tab-pane"
                       role="tab">Prevention</a>
                    <a class="nav-link" id="symptoms-tab" data-toggle="pill" href="#symptoms-tab-pane"
                       role="tab">Symtoms</a>

                </div>
            </div>
            <div class="col-md-9 col-xl-8 ml-auto">
                <div class="tab-content faq-tab-content" id="faq-tab-content">

                    <!-- General tab content-->
                    <div class="tab-pane fade show active" id="general-tab-pane" role="tabpanel">
                        <div class="accordion faq-accordion" id="general-accordion">
                            <div class="accordion-card">
                                <div class="card-header">
                                    <button class="btn btn-link" type="button" data-toggle="collapse"
                                            data-target="#g-collapseOne" aria-expanded="true">
                                        <span>1. What is Coronavirus (COVID -19) ?</span>
                                        <span class="icon"></span>
                                    </button>
                                </div>

                                <div id="g-collapseOne" class="collapse show" data-parent="#general-accordion">
                                    <div class="card-body">
                                        Coronaviruses are a large family of viruses which may cause illness in
                                        animals or humans. In humans, several coronaviruses are known to cause
                                        respiratory infections ranging from the common cold to more severe diseases
                                        such as Middle East Respiratory Syndrome (MERS) and Severe Acute Respiratory
                                        Syndrome (SARS). The most recently discovered coronavirus causes coronavirus
                                        disease COVID-19.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-card">
                                <div class="card-header">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#g-collapseTwo" aria-expanded="false">
                                        <span>2. What are the Symptoms of COVID-19?</span>
                                        <span class="icon"></span>
                                    </button>
                                </div>
                                <div id="g-collapseTwo" class="collapse" data-parent="#general-accordion">
                                    <div class="card-body">
                                        The most common symptoms of COVID-19 are fever, tiredness, and dry cough.
                                        Some patients may have aches and pains, nasal congestion, runny nose, sore throat or diarrhea.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-card">
                                <div class="card-header">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#g-collapseThree" aria-expanded="false">
                                        <span>3. How Does COVID -19 Spread?</span>
                                        <span class="icon"></span>
                                    </button>
                                </div>
                                <div id="g-collapseThree" class="collapse" data-parent="#general-accordion">
                                    <div class="card-body">
                                        People can contact COVID-19 from others who have the virus.
                                        The disease can spread from person to person through small droplets from
                                        the nose or mouth which are spread when a person with COVID-19 coughs or exhales.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-card">
                                <div class="card-header">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#g-collapsefour" aria-expanded="false">
                                            <span>4. What Can I do to protect myself and prevent the spread of
                                                disease?</span>
                                        <span class="icon"></span>
                                    </button>
                                </div>
                                <div id="g-collapsefour" class="collapse" data-parent="#general-accordion">
                                    <div class="card-body">
                                        Wash your hands frequently and regularly with an alcohol based hand rub
                                        or wash them with soap and water.
                                        Wear sergical mask and avoid touching face.
                                        Hands touch many surfaces and can pick up viruses once contaminated.
                                        Use alcohol based hand sanitizer or soap when you wash your hands.
                                        Keep wash yor hands at least 20 minute during handwash.
                                        Stay home, stay safe. if you feel unwell. If you have a fever,
                                        cough and difficulty breathing, seek medical attention.
                                        If you are think you are suffering with this above symptoms.
                                        Please call a doctor as soon as posible for your medical advice.
                                        Please maintain at least 1 metre (3 feet) distance between yourself and anyone who is coughing or sneezing.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- COVID-19 tab content-->
                    <div class="tab-pane fade" id="covid-19-tab-pane" role="tabpanel">
                        <div class="accordion faq-accordion" id="covid-19-accordion">
                            <div class="accordion-card">
                                <div class="card-header">
                                    <button class="btn btn-link" type="button" data-toggle="collapse"
                                            data-target="#c-collapseOne" aria-expanded="true">
                                        <span>1. What is Coronavirus (COVID -19) ?</span>
                                        <span class="icon"></span>
                                    </button>
                                </div>

                                <div id="c-collapseOne" class="collapse show" data-parent="#covid-19-accordion">
                                    <div class="card-body">
                                        Coronaviruses are a large family of viruses which may cause illness in
                                        animals or humans. In humans, several coronaviruses are known to cause
                                        respiratory infections ranging from the common cold to more severe diseases
                                        such as Middle East Respiratory Syndrome (MERS) and Severe Acute Respiratory
                                        Syndrome (SARS). The most recently discovered coronavirus causes coronavirus
                                        disease COVID-19.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-card">
                                <div class="card-header">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#c-collapseTwo" aria-expanded="false">
                                        <span>2. What are the Symptoms of COVID-19?</span>
                                        <span class="icon"></span>
                                    </button>
                                </div>
                                <div id="c-collapseTwo" class="collapse" data-parent="#covid-19-accordion">
                                    <div class="card-body">
                                        The most common symptoms of COVID-19 are fever, tiredness, and dry cough.
                                        Some patients may have aches and pains, nasal congestion, runny nose, sore throat or diarrhea.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Prevention tab content -->
                    <div class="tab-pane fade" id="prevention-tab-pane" role="tabpanel">
                        <div class="accordion faq-accordion" id="prevention-accordion">
                            <div class="accordion-card">
                                <div class="card-header">
                                    <button class="btn btn-link" type="button" data-toggle="collapse"
                                            data-target="#p-collapseOne" aria-expanded="true">
                                            <span>4. What Can I do to protect myself and prevent the spread of
                                                disease?</span>
                                        <span class="icon"></span>
                                    </button>
                                </div>

                                <div id="p-collapseOne" class="collapse show" data-parent="#prevention-accordion">
                                    <div class="card-body">
                                        Wash your hands frequently and regularly with an alcohol based hand rub
                                        or wash them with soap and water.
                                        Wear sergical mask and avoid touching face.
                                        Hands touch many surfaces and can pick up viruses once contaminated.
                                        Use alcohol based hand sanitizer or soap when you wash your hands.
                                        Keep wash yor hands at least 20 minute during handwash.
                                        Stay home, stay safe. if you feel unwell. If you have a fever,
                                        cough and difficulty breathing, seek medical attention.
                                        If you are think you are suffering with this above symptoms.
                                        Please call a doctor as soon as posible for your medical advice.
                                        Please maintain at least 1 metre (3 feet) distance between yourself and anyone who is coughing or sneezing.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Prevention tab content -->
                    <div class="tab-pane fade" id="symptoms-tab-pane" role="tabpanel">
                        <div class="accordion faq-accordion" id="prevention-accordion">
                            <div class="accordion-card">
                                <div class="card-header">
                                    <button class="btn btn-link" type="button" data-toggle="collapse"
                                            data-target="#p-collapseOne" aria-expanded="true">
                                        <span>1. What are the Symptoms of COVID-19?</span>
                                        <span class="icon"></span>
                                    </button>
                                </div>

                                <div id="p-collapseOne" class="collapse show" data-parent="#symptoms-tab-pane">
                                    <div class="card-body">
                                        The most common symptoms of COVID-19 are fever, tiredness, and dry cough.
                                        Some patients may have aches and pains, nasal congestion, runny nose, sore throat or diarrhea.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Footer -->
<footer class="footer">
    <div class="footer-bottom s-bg-dark py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mx-auto text-center">
                    <div class="f-bottom-info">
                        <h6 class="text-white">Copyright &copy; 2021 <a href="#">Vision-X Limited</a>. All rights
                            reserved.</h6>
                        <p class="mb-0">All informations are collected from the World Health Organaization (WHO).
                            <br>
                            If you have any concerns please visit the respective website.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


<!-- jQuery first, then Bootstrap bundle JS, then others -->
<script src="covidasset/js/jquery-3.5.1.min.js"></script>
<script src="covidasset/js/bootstrap.bundle.min.js"></script>

<!-- Plugins -->
<script src="covidasset/js/jquery-ui.min.js"></script>
<script src="../../../../../unpkg.com/%40lottiefiles/lottie-player%400.5.1/dist/lottie-player.js"></script>
<script src="covidasset/js/corona-script.js"></script>
<script src="covidasset/js/aos.js"></script>
<script src="covidasset/js/simpleParallax.min.js"></script>
<script src="covidasset/js/parallax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAhrdEzlfpnsnfq4MgU1e1CCsrvVx2d59s"></script>
<script src="covidasset/js/gmaps.js"></script>
<script src="covidasset/js/ajax-mail.js"></script>
<script src="covidasset/js/ajax-subscribe.js"></script>

<!-- Template JS -->
<script src="covidasset/js/scripts.js"></script>
</body>



</html>
