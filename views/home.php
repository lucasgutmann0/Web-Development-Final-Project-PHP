<!DOCTYPE html>
<html lang="en">

<head>
  <?php require(dirname(__DIR__) . '/utils/header.php'); ?>
  <title>Home - CAR FX</title>
</head>

<body style="background: #27272a;">
  <?php include(dirname(__DIR__) . "/components/navbar.php") ?>
  <div class="hero">
    <div class="content">
      <div class="text" style="padding-left: 10rem;">
        <h1 class="nav-logo" style="font-size: 9rem; letter-spacing: 10px; margin: 0; height: 70px;">CAR <span
            style="color: #b91c1c; padding-left: 15px;">FX</span></h1>
        <h2 style="padding-block: 20px">Estamos para servirte</h2>
        <p style="padding-bottom: 15px; width: 30rem;">Anim pariatur ex sit excepteur proident ad. Aliqua Lorem commodo
          laboris occaecat ut eu do cupidatat. Ipsum
          voluptate nostrud excepteur eu excepteur do consectetur cillum tempor non aute ad magna. Exercitation mollit
          est laborum magna veniam.</p>
        <button>Accede</button>
      </div>
      <img style="width: 55rem;"
        src="https://img.sm360.ca/ir/w640h390c/images/newcar/ca/2021/audi/tt-rs-coupe/base-tt-rs-coupe/coupe/exteriorColors/12098_cc0640_032_y1y1.png"
        alt="">
      <!-- <img style="height: 25rem; width: 30rem; overflow: hidden;" src="https://forums.audipassion.com/uploads/monthly_2019_05/audi_tts.png.79dbaa781e77383562fac1ba3f2ec658.png" alt=""> -->
      <!-- <img style="width: 40rem;" src="https://th.bing.com/th/id/R.66c3cb142c4341ec2bcca46453e5ee27?rik=h1BX4whIG6jUwQ&pid=ImgRaw&r=0" alt=""> -->
    </div>
    <div class="overlay"></div>
    <img style="width: 100%; height: 100%; object-fit: cover; object-position: 0px 0%;"
      src="https://project1320.com/wp-content/uploads/2018/07/Important-Tips-on-Choosing-the-Right-Auto-Repair-Shop.jpg"
      alt="">
  </div>
  <script>
    let elem = document.querySelector("#navbar");
    elem.style.background = "none";
    elem.style.backdropFilter = "none";
    console.log(elem);
  </script>
</body>

</html>