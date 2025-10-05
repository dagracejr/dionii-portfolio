<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dionisio Grace Jr - Fullstack Web Developer</title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Share Tech Mono', monospace;
            background: #000;
            color: #0f0;
            overflow: hidden;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #matrix-canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            opacity: 0.3;
        }

        .container {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 2rem;
            max-width: 800px;
        }

        h1 {
            font-size: clamp(2rem, 5vw, 3.5rem);
            margin-bottom: 0.5rem;
            text-shadow: 0 0 10px #0f0, 0 0 20px #0f0, 0 0 30px #0f0;
            animation: glow 2s ease-in-out infinite alternate;
        }

        .title {
            font-size: clamp(1rem, 3vw, 1.5rem);
            margin-bottom: 3rem;
            opacity: 0.8;
        }

        .projects {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            align-items: center;
        }

        .project-link {
            display: inline-block;
            padding: 1rem 2rem;
            background: rgba(0, 255, 0, 0.05);
            border: 2px solid #0f0;
            color: #0f0;
            text-decoration: none;
            font-size: clamp(1rem, 2.5vw, 1.25rem);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            width: 100%;
            max-width: 400px;
        }

        .project-link::before {
            content: '> ';
            margin-right: 0.5rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .project-link:hover {
            background: rgba(0, 255, 0, 0.1);
            box-shadow: 0 0 20px #0f0, inset 0 0 20px rgba(0, 255, 0, 0.1);
            transform: translateX(10px);
            text-shadow: 0 0 10px #0f0;
        }

        .project-link:hover::before {
            opacity: 1;
        }

        @keyframes glow {
            from {
                text-shadow: 0 0 10px #0f0, 0 0 20px #0f0, 0 0 30px #0f0;
            }
            to {
                text-shadow: 0 0 20px #0f0, 0 0 30px #0f0, 0 0 40px #0f0, 0 0 50px #0f0;
            }
        }

        .divider {
            width: 60%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #0f0, transparent);
            margin: 2rem auto;
            opacity: 0.5;
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }
            
            .project-link {
                padding: 0.75rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    <canvas id="matrix-canvas"></canvas>
    
    <div class="container">
        <h1>Dionisio Grace Jr</h1>
        <p class="title">Fullstack Web Developer</p>
        
        <div class="divider"></div>
        
        <div class="projects">
            <a href="https://og-pos.dionii.dev" target="_blank" class="project-link">og-pos.dionii.dev</a>
            <a href="https://siomai-station-pos.dionii.dev" target="_blank" class="project-link">siomai-station-pos.dionii.dev</a>
        </div>
    </div>

    <script>
        // Matrix rain effect
        const canvas = document.getElementById('matrix-canvas');
        const ctx = canvas.getContext('2d');

        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        const fontSize = 16;
        const columns = canvas.width / fontSize;
        const drops = [];

        // Initialize drops
        for (let i = 0; i < columns; i++) {
            drops[i] = Math.random() * -100;
        }

        // Matrix characters (mix of katakana, numbers, and symbols)
        const matrixChars = 'ｱｲｳｴｵｶｷｸｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝ0123456789';

        function draw() {
            // Create fade effect
            ctx.fillStyle = 'rgba(0, 0, 0, 0.05)';
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            ctx.fillStyle = '#0f0';
            ctx.font = fontSize + 'px monospace';

            for (let i = 0; i < drops.length; i++) {
                const text = matrixChars[Math.floor(Math.random() * matrixChars.length)];
                ctx.fillText(text, i * fontSize, drops[i] * fontSize);

                if (drops[i] * fontSize > canvas.height && Math.random() > 0.975) {
                    drops[i] = 0;
                }
                drops[i]++;
            }
        }

        setInterval(draw, 33);

        // Handle window resize
        window.addEventListener('resize', () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
            
            const newColumns = canvas.width / fontSize;
            drops.length = newColumns;
            
            for (let i = 0; i < newColumns; i++) {
                if (drops[i] === undefined) {
                    drops[i] = Math.random() * -100;
                }
            }
        });
    </script>
</body>
</html>