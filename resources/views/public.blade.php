<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Accueil du site</title>
    <style>
        body {
            background: #f0f0f0;
            font-family: Arial;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .box {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        a {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 20px;
            background: #facc15;
            color: black;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="box">
        <h1>Bienvenue sur le site</h1>
        <p>Ceci est la page d’accueil publique.</p>
        <a href="{{ route('admin.login') }}">Accéder à l’espace admin</a>
    </div>
</body>

</html>