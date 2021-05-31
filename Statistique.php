<?php
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Statistique</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.js"></script>
    <link rel="stylesheet" href="StyleStatistique.css">
</head>
<body>
<header>
    <div class="main">
        <div class="logo">
            <a href="index.html">
                <img src="logo.png">
            </a>
        </div>
        <ul>
            <li><a href="index.html">Accueil</a></li>
            <li ><a href="#">À propos de nous</a></li>
            <li><a href="FAQ.html">FAQ</a></li>
            <li class="active" ><a href="#">Statistiques</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li class="account"><a href="login.html">S'inscrire</a></li>
            <li class="flag"><a href="#" title="Français">
                    <img alt="drapeau français" src="https://cdn1.iconfinder.com/data/icons/flags-of-the-world-2/128/france-circle-512.png" width="30" height="30" />
                </a></li>
        </ul>
    </div>

</header>
<section class="info-display">
    <div class="legend-container">
        <p>Résultats aux tests:<br/>
        Bpm Moy : 120 bpm <br/>
        Temps reaction audio : 328 ms <br/>
        Temps reatcion Visuel : 298 ms <br/>
        Température : 37,2 °C</p>
    </div>
    <div class="chart-container">
        <canvas id="radarChart"></canvas>

    </div>
</section>
    <script>
        let myChart = document.getElementById('radarChart').getContext('2d');

        let radar = new Chart(myChart,{
            type:'radar',
            data:{
                labels:['reaction visuel','bpm','température','reaction auditive'],
                datasets:[{
                    label:'utilisateur',
                    data:[
                        12,18,17,10
                    ],
                    backgroundColor: 'rgba(65,125,222,0.3)',

                },{
                    label:'moyenne',
                    data: [
                        12,8,15,7],
                    backgroundColor: 'rgba(56,69,90,0.5)'
                }
                ],
            },
            options:{},
        });

    </script>
</body>
</html>
