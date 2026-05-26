<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manchester United Store</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #fafafa;
            color: #111;
        }
        .hero {
            background: linear-gradient(135deg, #cb0815 0%, #000000 100%);
            color: #fff;
            padding: 80px 20px;
            text-align: center;
        }
        .hero h1 {
            margin: 0 0 15px;
            font-size: 3rem;
            letter-spacing: 1px;
        }
        .hero p {
            max-width: 720px;
            margin: 0 auto;
            font-size: 1.05rem;
            line-height: 1.6;
        }
        .btn-primary {
            display: inline-block;
            margin-top: 25px;
            padding: 14px 28px;
            background: #f2b900;
            color: #000;
            text-decoration: none;
            font-weight: bold;
            border-radius: 999px;
            transition: transform .2s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
        }
        .section {
            padding: 60px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .section h2 {
            font-size: 2rem;
            margin-bottom: 24px;
            text-align: center;
            color: #cb0815;
        }
        .products {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 24px;
        }
        .card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 18px 50px rgba(0,0,0,.12);
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 26px 70px rgba(0,0,0,.18);
        }
        .card img {
            width: 100%;
            display: block;
        }
        .card-content {
            padding: 20px;
        }
        .card-content h3 {
            margin: 0 0 10px;
            font-size: 1.25rem;
        }
        .card-content p {
            margin: 0 0 16px;
            color: #444;
            line-height: 1.5;
        }
        .price {
            font-weight: bold;
            color: #000;
            font-size: 1.1rem;
        }
        .footer {
            text-align: center;
            padding: 30px 20px;
            color: #666;
            background: #111;
            color: #fff;
        }
        .logo {
            max-width: 88px;
            margin: 0 auto 20px;
        }
    </style>
</head>
<body>
    <section class="hero">
        <img class="logo" src="https://upload.wikimedia.org/wikipedia/en/7/7a/Manchester_United_FC_crest.svg" alt="Manchester United Logo">
        <h1>Manchester United Store</h1>
        <p>Temukan jersey resmi, merchandise eksklusif, dan koleksi terbaru untuk semua fans The Red Devils. Belanja sekarang dan tunjukkan dukunganmu dengan penuh gaya.</p>
        <a href="#products" class="btn-primary">Lihat Koleksi</a>
    </section>

    <section id="products" class="section">
        <h2>Produk Unggulan</h2>
        <div class="products">
            <article class="card">
                <img src="https://images.pexels.com/photos/3617696/pexels-photo-3617696.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Jersey Home 2025">
                <div class="card-content">
                    <h3>Jersey Home 2025</h3>
                    <p>Desain klasik merah dengan detail modern, bahan breathable untuk kenyamanan sepanjang hari.</p>
                    <div class="price">Rp 899.000</div>
                </div>
            </article>
            <article class="card">
                <img src="https://images.pexels.com/photos/1243510/pexels-photo-1243510.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Kemeja Away 2025">
                <div class="card-content">
                    <h3>Jersey Away 2025</h3>
                    <p>Warna netral dengan aksen merah, cocok untuk gaya santai sekaligus menunjukkan identitas MU.</p>
                    <div class="price">Rp 849.000</div>
                </div>
            </article>
            <article class="card">
                <img src="https://images.pexels.com/photos/838643/pexels-photo-838643.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Merchandise MU">
                <div class="card-content">
                    <h3>Topi & Aksesori</h3>
                    <p>Topi, syal, dan koleksi aksesori resmi untuk dukungan setiap hari.</p>
                    <div class="price">Mulai dari Rp 199.000</div>
                </div>
            </article>
        </div>
    </section>

    <section class="section" style="background: #111; color: #fff;">
        <h2>Kenapa Pilih Manchester United Store</h2>
        <p style="max-width: 760px; margin: 0 auto; text-align: center;">Belanja aman dengan produk resmi, pengiriman cepat, dan dukungan pelanggan yang siap membantu. Bawa pulang semangat Old Trafford ke rumahmu.</p>
    </section>

    <footer class="footer">
        <p>&copy; 2026 Manchester United Store. Hak cipta dilindungi.</p>
    </footer>
</body>
</html>
