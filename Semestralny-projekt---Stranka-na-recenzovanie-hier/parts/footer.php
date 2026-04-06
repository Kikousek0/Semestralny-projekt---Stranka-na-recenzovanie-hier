<script src="https://cdnjs.cloudflare.com/ajax/libs/parallax/3.1.0/parallax.min.js"></script>
<script>
    const scene = document.querySelector('.hero-bg');
    if (scene) {
        new Parallax(scene, {
            relativeInput: true,
            hoverOnly: false,
            scalarX: 10,
            scalarY: 10
        });
    }
</script>
</body>
</html>