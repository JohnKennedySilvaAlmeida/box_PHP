<!--  Scripts-->

<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

<script src="js/materialize.js"></script>

<script src="js/init.js"></script>

<script>

    $(document).ready(function() {

        $('.materialboxed').materialbox();

        $('.button-collapse').sideNav();



    });

</script>

<script>

    $('.head-link').click(function(e) {

        e.preventDefault();



        var goto = $(this).attr('href');



        $('html, body').animate({

            scrollTop: $(goto).offset().top

        }, 800);

    });

</script>



<script>

    (function(i, s, o, g, r, a, m) {

        i['GoogleAnalyticsObject'] = r;

        i[r] = i[r] || function() {

            (i[r].q = i[r].q || []).push(arguments)

        }, i[r].l = 1 * new Date();

        a = s.createElement(o),

            m = s.getElementsByTagName(o)[0];

        a.async = 1;

        a.src = g;

        m.parentNode.insertBefore(a, m)

    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-60673008-2', 'auto');

    ga('send', 'pageview');

</script>



<script>

    function functionIndex() {

        window.open('index.php');

    }

</script>



<script>

    function functionProducts() {

        window.open('products.php');

    }

</script>



<script>

    function functionSobre() {

        window.open('sobre.php');

    }

</script>



<script>

    function functionContato() {

        window.open('contato.php');

    }

</script>



<script>

    function functionLogin() {

        window.open('login.php');

    }

</script>