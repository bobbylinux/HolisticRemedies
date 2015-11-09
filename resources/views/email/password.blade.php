<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>CONFERMA CAMBIO PASSWORD</h2>

<div>
    Gentile cliente,
    Le confermiamo la sua richiesta di cambio della password da Lei richiesto.
    Per confermare la preghiamo di fare click sul link sottostante<br/>
    {!! URL::to('auth/verify/' . $codice) !!}<br/>
</div>

</body>
</html>