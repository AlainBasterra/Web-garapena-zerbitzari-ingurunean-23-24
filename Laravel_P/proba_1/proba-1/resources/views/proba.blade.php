<!DOCTYPE html>
<html>

<head>
  <title>Proba View</title>
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"></script>
</head>

<body>
  <style>
    :root {
      --glow-rgb: 239 42 201;
    }

    body {
      background: linear-gradient(145deg, rgb(119, 46, 195), rgb(58, 18, 153));
      height: 100vh;
      overflow: hidden;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .glow-point {
      position: absolute;
      box-shadow: 0rem 0rem 1.2rem 0.6rem rgb(var(--glow-rgb));
      pointer-events: none;
    }

    .star {
      position: absolute;
      z-index: 2;
      color: white;
      font-size: 1rem;
      animation-duration: 1500ms;
      animation-fill-mode: forwards;
      pointer-events: none;
    }

    @keyframes fall-1 {
      0% {
        transform: translate(0px, 0px) rotateX(45deg) rotateY(30deg) rotateZ(0deg) scale(0.25);
        opacity: 0;
      }

      5% {
        transform: translate(10px, -10px) rotateX(45deg) rotateY(30deg) rotateZ(0deg) scale(1);
        opacity: 1;
      }

      100% {
        transform: translate(25px, 200px) rotateX(180deg) rotateY(270deg) rotateZ(90deg) scale(1);
        opacity: 0;
      }
    }

    @keyframes fall-2 {
      0% {
        transform: translate(0px, 0px) rotateX(-20deg) rotateY(10deg) scale(0.25);
        opacity: 0;
      }

      10% {
        transform: translate(-10px, -5px) rotateX(-20deg) rotateY(10deg) scale(1);
        opacity: 1;
      }

      100% {
        transform: translate(-10px, 160px) rotateX(-90deg) rotateY(45deg) scale(0.25);
        opacity: 0;
      }
    }

    @keyframes fall-3 {
      0% {
        transform: translate(0px, 0px) rotateX(0deg) rotateY(45deg) scale(0.5);
        opacity: 0;
      }

      15% {
        transform: translate(7px, 5px) rotateX(0deg) rotateY(45deg) scale(1);
        opacity: 1;
      }

      100% {
        transform: translate(20px, 120px) rotateX(-180deg) rotateY(-90deg) scale(0.5);
        opacity: 0;
      }
    }
  </style>


  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand ms-3" href="/">Index</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
      aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-item nav-link" href="/atasak">Atasak</a>
        <a class="nav-item nav-link" href="/erabiltzaileak">Erabiltzaileak</a>
      </div>
    </div>
  </nav>
  <script>
    let start = new Date().getTime();

    const originPosition = { x: 0, y: 0 };

    const last = {
      starTimestamp: start,
      starPosition: originPosition,
      mousePosition: originPosition
    }

    const config = {
      starAnimationDuration: 1500,
      minimumTimeBetweenStars: 250,
      minimumDistanceBetweenStars: 75,
      glowDuration: 75,
      maximumGlowPointSpacing: 10,
      colors: ["249 146 253", "252 254 255"],
      sizes: ["1.4rem", "1rem", "0.6rem"],
      animations: ["fall-1", "fall-2", "fall-3"]
    }

    let count = 0;

    const rand = (min, max) => Math.floor(Math.random() * (max - min + 1)) + min,
      selectRandom = items => items[rand(0, items.length - 1)];

    const withUnit = (value, unit) => `${value}${unit}`,
      px = value => withUnit(value, "px"),
      ms = value => withUnit(value, "ms");

    const calcDistance = (a, b) => {
      const diffX = b.x - a.x,
        diffY = b.y - a.y;

      return Math.sqrt(Math.pow(diffX, 2) + Math.pow(diffY, 2));
    }

    const calcElapsedTime = (start, end) => end - start;

    const appendElement = element => document.body.appendChild(element),
      removeElement = (element, delay) => setTimeout(() => document.body.removeChild(element), delay);

    const createStar = position => {
      const star = document.createElement("span"),
        color = selectRandom(config.colors);

      star.className = "star bi bi-star-fill";

      star.style.left = px(position.x);
      star.style.top = px(position.y);
      star.style.fontSize = selectRandom(config.sizes);
      star.style.color = `rgb(${color})`;
      star.style.textShadow = `0px 0px 1.5rem rgb(${color} / 0.5)`;
      star.style.animationName = config.animations[count++ % 3];
      star.style.starAnimationDuration = ms(config.starAnimationDuration);

      appendElement(star);

      removeElement(star, config.starAnimationDuration);
    }

    const createGlowPoint = position => {
      const glow = document.createElement("div");

      glow.className = "glow-point";

      glow.style.left = px(position.x);
      glow.style.top = px(position.y);

      appendElement(glow)

      removeElement(glow, config.glowDuration);
    }

    const determinePointQuantity = distance => Math.max(
      Math.floor(distance / config.maximumGlowPointSpacing),
      1
    );

    const createGlow = (last, current) => {
      const distance = calcDistance(last, current),
        quantity = determinePointQuantity(distance);

      const dx = (current.x - last.x) / quantity,
        dy = (current.y - last.y) / quantity;

      Array.from(Array(quantity)).forEach((_, index) => {
        const x = last.x + dx * index,
          y = last.y + dy * index;

        createGlowPoint({ x, y });
      });
    }

    const updateLastStar = position => {
      last.starTimestamp = new Date().getTime();

      last.starPosition = position;
    }

    const updateLastMousePosition = position => last.mousePosition = position;

    const adjustLastMousePosition = position => {
      if (last.mousePosition.x === 0 && last.mousePosition.y === 0) {
        last.mousePosition = position;
      }
    };

    window.onpointermove = e => {
      const mousePosition = { x: e.clientX, y: e.clientY }

      adjustLastMousePosition(mousePosition);

      const now = new Date().getTime(),
        hasMovedFarEnough = calcDistance(last.starPosition, mousePosition) >= config.minimumDistanceBetweenStars,
        hasBeenLongEnough = calcElapsedTime(last.starTimestamp, now) > config.minimumTimeBetweenStars;

      if (hasMovedFarEnough || hasBeenLongEnough) {
        createStar(mousePosition);

        updateLastStar(mousePosition);
      }

      createGlow(last.mousePosition, mousePosition);

      updateLastMousePosition(mousePosition);
    }

    document.body.onmouseleave = () => updateLastMousePosition(originPosition);
  </script>
  @yield('content')

</body>

</html>