<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Conferma Iscrizione a Holistic Remedies</h2>

        <div>
            Grazie per essersi iscritto al nostro sito.
            Per confermare la Sua iscrizione la preghiamo di fare click sul link sottostante<br/>
            <a href="{!! URL::to('auth/verify/' . $codice) !!}">{!! URL::to('auth/verify/' . $codice) !!}<a><br/>
        </div>

    </body>
</html>