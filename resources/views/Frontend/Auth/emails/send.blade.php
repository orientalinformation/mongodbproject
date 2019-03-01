<html>
    <head></head>
    <body>
        <div class='container' text-align="center">
            <h2 class="panel-title navbar-brand"> {{ $title }} </h3>
            <h3> {{ $content }}</h3>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="center">
                        <div>
                            <a href="{{ $url }}" style="background-color:#2a3e68;border:1px solid #2a3e68;border-radius:3px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:16px;line-height:44px;text-align:center;text-decoration:none;width:300px;-webkit-text-size-adjust:none;mso-hide:all;" target="_blank">
                                Réinitialiser le mot de passe
                            </a>
                        </div>
                    </td>
                </tr>
            </table>
            <h3> {{ $contentEnd }} </h3>
        </div>        
    </body>
</html>