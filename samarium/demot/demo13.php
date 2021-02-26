<?php
    // uusi DOMDocument
    $dom = new DOMDocument();
    $dom->encoding = 'utf-8';
    $dom->xmlVersion = '1.0';
    $dom->formatOutput = true;
    $xml_file_name = 'menu.xml';

    // luodaan juurielementti	
    $root = $dom->createElement('menu');

    // luodaan ruoka-elementti
    $ruoka = $dom->createElement('ruoka');
    $attr_ruoka_id = new DOMAttr('id', '1');
    $ruoka->setAttributeNode($attr_ruoka_id);

    // ruoka-elementin lapset
    $lapsi1 = $dom->createElement('nimi', 'Maa-artisokkakeitto');
    $ruoka->appendChild($lapsi1);

    $lapsi2 = $dom->createElement('hinta', 50);
    $ruoka->appendChild($lapsi2);

    $lapsi3 = $dom->createElement('laktoositon', 'kyllä');
    $ruoka->appendChild($lapsi3);

    $ruoka2 = $dom->createElement('ruoka');
    $attr_ruoka_id = new DOMAttr('id', '2');
    $ruoka2->setAttributeNode($attr_ruoka_id);

    $lapsi1 = $dom->createElement('nimi', 'Nakkikeitto');
    $ruoka2->appendChild($lapsi1);

    $lapsi2 = $dom->createElement('hinta', 30);
    $ruoka2->appendChild($lapsi2);

    $lapsi3 = $dom->createElement('laktoositon', 'kyllä');
    $ruoka2->appendChild($lapsi3);

    $ruoka3 = $dom->createElement('ruoka');
    $attr_ruoka_id = new DOMAttr('id', '3');
    $ruoka3->setAttributeNode($attr_ruoka_id);

    $lapsi1 = $dom->createElement('nimi', 'Hernekeitto');
    $ruoka3->appendChild($lapsi1);

    $lapsi2 = $dom->createElement('hinta', 20);
    $ruoka3->appendChild($lapsi2);

    $lapsi3 = $dom->createElement('laktoositon', 'kyllä');
    $ruoka3->appendChild($lapsi3);

    // ruoka juurielementille
    $root->appendChild($ruoka);
    $root->appendChild($ruoka2);
    $root->appendChild($ruoka3
);

    // juurielementti dom-dokumentille
    $dom->appendChild($root);

    $dom->save($xml_file_name);

    echo "$xml_file_name -tiedosto kirjoitettu <br>";

    $xml=simplexml_load_file("menu.xml") or die("Error: tiedosto!");

    foreach($xml->children() as $ruoka) {
        echo "nimi: " . $ruoka->nimi . ", ";
        echo "hinta: " . $ruoka->hinta . ", ";
        echo "laktoositon: " . $ruoka->laktoositon;
        echo "<br>";
    }
?> 