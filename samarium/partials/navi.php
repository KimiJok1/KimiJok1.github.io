<div id="sivut">
    <h2>Demot</h2>
    <ul id="demot">
        <?php
            $files = scandir('../demot/');
            sort($files,SORT_NATURAL | SORT_FLAG_CASE);
            foreach($files as $file) {
                if (substr($file, 0, 4) == "demo") {
                    echo '<li><a href="./index.php?sivu=' . substr($file, 0, -4) . '&kansio=demot">Demo ' . substr(substr($file, 4, strlen($file)), 0, -4) . ' </a></li>';
                }
            }
        ?>
    </ul>
    <h2>XML</h2>
    <ul id="xml">
        <?php
            $files2 = scandir('../harjoitukset/xml/');
            sort($files2,SORT_NATURAL | SORT_FLAG_CASE);
            foreach($files2 as $file) {
                if (substr($file, 0, 4) == "demo") {
                    echo '<li><a href="./index.php?xmlsivu=' . substr($file, 0, -4) . '&kansio=harjoitukset/xml">XML Demo ' . substr(substr($file, 4, strlen($file)), 0, -4) . ' </a></li>';
                }
            }
        ?>
    </ul>
    <h2>Harjoitukset</h2>
    <ul id="harj">
        <?php
            $files = scandir('../harjoitukset/');
            sort($files,SORT_NATURAL | SORT_FLAG_CASE);
            foreach($files as $file) {
                if (substr($file, 0, 4) == "harj") {
                    echo '<li><a href="./index.php?sivu=' . substr($file, 0, -4) . '&kansio=harjoitukset">Harjoitus ' . substr(substr($file, 4, strlen($file)), 0, -4) . ' </a></li>';
                }
            }
            $files2 = scandir('../harjoitukset/xml/');
            sort($files2,SORT_NATURAL | SORT_FLAG_CASE);
            foreach($files2 as $file) {
                if (substr($file, 0, 4) == "harj") {
                    echo '<li><a href="./index.php?sivu=' . substr($file, 0, -4) . '&kansio=harjoitukset/xml">XML Harjoitus ' . substr(substr($file, 4, strlen($file)), 0, -4) . ' </a></li>';
                }
            }
        ?>
    </ul>
</div>
<hr>