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
    echo '<br />';

### Display the encoded string
    echo $encoded;
    // Hsst hbboeeBp alxanI l. bi torsu.aiadrtftrotwoeu?c ina ata reoysh atkwancdost r au i 'twie nsr t ah
    //  m idrfyesi vo d sneetr etp ey aeeednas fhtI eeMachhdnaowls er n l s hs nctdamea dnCihosderaoo
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

#### What if the pin does't match?
    echo $rot1->decode(124);
    // Hh ertoaen d uvaoyc mwscfrhi r eisoan eoittfsamlsr eh ed ae dr d lwha e rhoda keosyhaes repsttCi ?oBt
    // bndsaaao arinsxu p fbcntteoyed tentd ah o bnatc rw.ihnie teos wu l edI Ma es ris.antts n 'al
    exit;

    ?>

I do not guarantee this to be secure, though. Use at your own risk!
