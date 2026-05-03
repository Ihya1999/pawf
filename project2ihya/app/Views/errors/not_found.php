<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>404 - Page Not Found</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            color: white;
            overflow: hidden;
        }

        .container {
            text-align: center;
            animation: fadeIn 1.5s ease-in-out;
        }

        h1 {
            font-size: 120px;
            font-weight: 700;
            letter-spacing: 5px;
            background: linear-gradient(45deg, #00c6ff, #0072ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: float 3s ease-in-out infinite;
        }

        h2 {
            font-weight: 500;
            margin-bottom: 10px;
        }

        p {
            opacity: 0.7;
            margin-bottom: 30px;
        }

        a {
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 30px;
            background: linear-gradient(45deg, #00c6ff, #0072ff);
            color: white;
            font-weight: 500;
            transition: 0.3s;
            box-shadow: 0 5px 20px rgba(0,0,0,0.3);
        }

        a:hover {
            transform: scale(1.1);
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        /* Floating animation */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        /* Fade animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        /* Background glow circles */
        .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            animation: move 10s infinite alternate;
        }

        .circle:nth-child(1) {
            width: 200px;
            height: 200px;
            top: 10%;
            left: 10%;
        }

        .circle:nth-child(2) {
            width: 300px;
            height: 300px;
            bottom: 10%;
            right: 10%;
        }

        @keyframes move {
            from { transform: translateY(0); }
            to { transform: translateY(50px); }
        }
    </style>
</head>

<body>

    <!-- Background effects -->
    <div class="circle"></div>
    <div class="circle"></div>

    <div class="container">
        <h1>404</h1>
        <h2>Oops! Halaman Tidak Ditemukan</h2>
        <p>Sepertinya halaman yang kamu cari tidak tersedia atau sudah dipindahkan.</p>

        <a href="<?= base_url('/'); ?>">Kembali ke Home</a>
    </div>

</body>
</html>
