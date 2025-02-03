<body style="margin: 0; padding: 0;">

    <script type='text/javascript' src='{{ $url }}'></script>
    <script>
    jwplayer().on('ready', function(event){
        jwplayer().seek(parseInt(<?= $time ?>));
    });
    </script>
</body>
