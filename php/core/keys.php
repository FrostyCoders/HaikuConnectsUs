<?php
    // DESCRIPTION
    // This file cointains keys to encrypt sensitive data from database eg. password, e-mail etc.
    // Every key has to consist of 94 unique characters, if key won't meet requirements or will be empty, data won't be encrypted and decrypted, there will be an errors in aplication
    // Changing keys during aplication works is not recommended, because old users won't have access to aplication

    // DEFAULT KEYS
    // This keys are defualt and it is recommended to change it
    //$key1 = 'jNTSd7k}=LA%ntx_^M6.]1KP{gh[a$(><*2UZzB9#3"&5Ds@-q0JRVOY\upo|l:X;~y' . "'" . '/FCW?Q!f4rGHi+we,mv8I`)cb';

    // PROPER KEYS
    // To edit your key paste generated key like that $key1 = 'your_generated_key';
    $ckey1 = '<[!m]_XW(N\|@c>ET4l-GKO/Sj~}1D?Y'."'".'Ufit.g#aqp&^L"bvwCxH0k7JM2$hR%+Z)AVo93{8,Q:e*Ps;d`nz6IB=yru5F';
    $ckey2 = '%-\&RAk}?frljv/oy46#u@NQ=C2Wx~|hYesdXSbw."m5+V]$M`>(F!DG)_UIc[P^<z,'."'".'*9a8H;O:0JnTpt1BZ{iK3gE7Lq';
    $ckey3 = '#1M*_HzPq:0]WZ?w(RvpOsm)JL=[r4yDk\%t-^Xx3KN{eVi|h&f92g<+.",lauGY$SUdoT>}E!@5ncIFCB/8j;'."'".'b`~6AQ7';
    $ckey4 = 'jNTSd7k}=LA%ntx_^M6.]1KP{gh[a$(><*2UZzB9#3"&5Ds@-q0JRVOY\upo|l:X;~y'."'".'/FCW?Q!f4rGHi+we,mv8I`)cb';
?>