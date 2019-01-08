<!-- <?php /* -->
# PHP Rot Encoding
**Tip:** Rename this `md` file to `php` to test it on your web server.
<!-- */ ?> -->

    <?php

    require 'src/Rot.php';

    $str = "Have you not heard the stories? Captain Barbossa and his crew of miscreants sail from the dreaded
            Isla de Muerta. It's an island that cannot be found except by those who already know where it is.";

    $rot = new Nggit\PHPRotEncoding\Rot($str);

### Encode the string using pin 2154
    $encoded = $rot->encode(2154);
    // Or separate by commas:
    // $encoded = $rot->encode(2, 1, 5, 4);
    echo '<br />';

### Display the encoded string
    echo $encoded;
    // Hsto tn te pe ke sde rns aetewos. sa deon l uor .aa  rsnthhacbtatapCdl xs edr a s rhscdMermdn oawyaeiyd
    //  avih'id o ienayrthtta mtc?ff i but tohe u b deoBfra iwsIa cnlaisssrItaiae enhn hworoeeleno
    echo '<br />';

### Decode the encoded string
    echo $rot->decode();
    // Have you not heard the stories? Captain Barbossa and his crew of miscreants sail from the dreaded
    // Isla de Muerta. It's an island that cannot be found except by those who already know where it is.
    echo '<br />';

### Decode the encoded string using another instance
    $rot1 = new Nggit\PHPRotEncoding\Rot($encoded);
    echo $rot1->decode(2154);
    // Have you not heard the stories? Captain Barbossa and his crew of miscreants sail from the dreaded
    // Isla de Muerta. It's an island that cannot be found except by those who already know where it is.
    echo '<br />';

### What if the pin doesn't match?
    echo $rot1->decode(124);
    // Hnauloetoeace alri e nicde corbsepa hb anrwc' syan d o C s Ias e tdt on sey awmloinh fhexi yp aMkwa
    //  snvs nf rens traeaeo tefi.ettoe unsIro sr sad d? hi oodddt rsiah m trer ba eBslh.hiaatt tahu de
    exit;

    ?>

I do not guarantee this to be secure, though. Use it at your own risk!
