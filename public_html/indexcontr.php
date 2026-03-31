<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="robots" content="noindex, nofollow" />
  <title>Estamos en construcción</title>
  <meta name="description" content="Sitio en construcción. Estamos trabajando para traerte una mejor experiencia." />
  <link rel="icon" href="/favicon.ico" />
  <style>
    :root {
      --azul: #2C5483;
      --azuloscuro: #143c69;
      --naranja: #FD8126;
      --naranjaoscuro: #d35800;
      --gris: #8A8A8A;
      --grisclaro: #E3E3E3;
      --rojo: #DE5C5D;
      --grisoscuro: #212529;
    }

    * {
      box-sizing: border-box;
    }

    html,
    body {
      height: 100%;
    }

    body {
      margin: 0;
      font-family: system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, Cantarell, 'Noto Sans', sans-serif;
      background: radial-gradient(1200px 800px at 10% 10%, rgba(44, 84, 131, 0.12), transparent 60%),
        radial-gradient(1200px 800px at 90% 90%, rgba(253, 129, 38, 0.12), transparent 60%),
        var(--grisclaro);
      color: var(--grisclaro);
      display: grid;
      place-items: center;
      padding: 24px;
    }

    .wrap {
      width: min(720px, 100%);
      text-align: center;
    }

    .card {
      background: linear-gradient(180deg, rgba(255, 255, 255, .04), rgba(255, 255, 255, .02));
      border: 1px solid rgba(255, 255, 255, .08);
      border-radius: 24px;
      padding: 32px;
      backdrop-filter: blur(8px);
      box-shadow: 0 20px 60px rgba(0, 0, 0, .4);
    }

    .brand {
      display: flex;
      align-items: center;
      gap: 12px;
      justify-content: center;
      margin-bottom: 16px;
    }

    .logo {
      width: 40px;
      height: 40px;
    }

    h1 {
      margin: 0 0 8px;
      font-size: clamp(24px, 3.5vw, 36px);
      letter-spacing: .2px;
    }

    p {
      margin: 0;
      color: var(--grisoscuro);
    }

    .progress {
      --size: 8px;
      margin: 28px auto 12px;
      width: 240px;
      height: var(--size);
      background: rgba(255, 255, 255, .08);
      border-radius: 999px;
      position: relative;
      overflow: hidden;
    }

    .bar {
      position: absolute;
      inset: 0;
      transform: translateX(-100%);
      background: linear-gradient(90deg, var(--azul), var(--naranja));
      border-radius: 999px;
      animation: load 2.2s cubic-bezier(.4, 0, .2, 1) infinite;
    }

    @keyframes load {
      0% {
        transform: translateX(-100%);
        width: 20%;
      }

      50% {
        transform: translateX(30%);
        width: 60%;
      }

      100% {
        transform: translateX(120%);
        width: 20%;
      }
    }

    .tag {
      display: inline-flex;
      gap: 8px;
      align-items: center;
      padding: 6px 12px;
      border-radius: 999px;
      background: rgba(253, 129, 38, 0.12);
      color: var(--naranja);
      font-size: 14px;
      margin-bottom: 16px;
      border: 1px solid rgba(253, 129, 38, 0.25);
    }

    .links {
      display: flex;
      justify-content: center;
      gap: 16px;
      margin-top: 18px;
      flex-wrap: wrap;
    }

    .links a {
      color: var(--grisclaro);
      text-decoration: none;
      opacity: .9;
      border: 1px solid rgba(255, 255, 255, .12);
      padding: 10px 14px;
      border-radius: 12px;
      transition: 0.3s;
    }

    .links a:hover {
      border-color: var(--naranja);
      color: var(--naranja);
    }

    footer {
      margin-top: 22px;
      font-size: 13px;
      color: var(--gris);
    }

    strong {
      font-weight: 600;
      color: var(--grisoscuro);
    }
    h1{
      color: var(--grisoscuro);
    }
  </style>
</head>

<body>
  <main class="wrap">
    <div class="card">
      <div class="brand" aria-label="Marca">
        <img class="logo" src="/logo.png" alt="Logo Club el nogal">
        <strong>Nogal en casa </strong>
      </div>

      <span class="tag">🚧 En construcción</span>
      <h1>Estamos preparando una nueva versión</h1>
      <p>Gracias por tu paciencia. Pronto volveremos con mejoras y nuevas funciones.</p>

      <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-label="Progreso de actualización">
        <div class="bar"></div>
      </div>



      <footer>
        &copy; <span id="year"></span> Corporación Club El Nogal. Todos los derechos reservados.
      </footer>
    </div>
  </main>

  <script>
    document.getElementById('year').textContent = new Date().getFullYear();
  </script>
</body>

</html>