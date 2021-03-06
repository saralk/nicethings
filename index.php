<!doctype html>
<html lang="en">
<head>

	<!-- Meta stuff -->
	<meta charset="utf-8">
	<title>Nice Things</title>
	<meta name="description" content="A collection of the most beautiful things on the planet.">

	<!-- Styles & scripts -->
	<link rel="stylesheet" href="styles/css/main.css">
	<script src="scripts/min/jquery.min.js"></script>
	<script src="http://nicethings.me/scripts/min/view.min.js"></script>
	<script src="http://use.typekit.com/feu7nwp.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>
	<script>
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-6426998-22']);
		_gaq.push(['_trackPageview']);
		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
        
        $(document).ready(function(e) {
            v = new View($('.view-image'));
            
            showExtension = function(a) {
                var img = $('li.current > div > span > img').attr('src').replace(/.*\/(.*)/, "$1");
                if (history && history.pushState) {
                    history.pushState({}, "nice things", img);
                }
            };

            closeExtension = function() {
                if (history && history.pushState) {
                    history.pushState({}, "nice things", "/");
                }
            };

            showBaseFn = v.show;
            v.show = function(e) {
                showBaseFn.call(v, e);
                showExtension(e);
            }

            closeBaseFn = v.close;
            v.close = function(e) {
                closeBaseFn.call(v);
                closeExtension();
            }

            $('.view-image').click(function(e) {
                v.show($(this).attr('href'));
                return false;
            });

        });

        
	</script>

</head>
<body>

	<header id="masthead">
		<h1>Nice Things<a href="http://www.lukejones.me/" title="Created by Luke Jones">.</a></h1>
	</header><!-- /#masthead -->

	<ul>
<?php
	$files = array();
	$dir = opendir("./things");
	while (false !== ($file = readdir($dir))) { /* opendir/readdir */
        if($file != "." && $file != "..") {
	    	$files[] = $file;
	    }
	}
    krsort($files);
?>
<?php foreach ($files as $file) : ?>
		<li>
            <a class="view-image" rel="nice-things" data-name="<? echo $file; ?>" href="things/<?php echo $file; ?>">
				<img src="createThumb.php?src=things/<?php echo $file; ?>&w=128&h=128" width="128" height="128" />
			</a>
		</li>
<?php endforeach; ?>
	</ul>

</body>
</html>
