<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>Sign Up</title>
        <style>
            .hidden_01{
                display: none;
            }
            .hidden_02{
                display: none;
            }
        </style>
    </head>
    <body>
    <form method="post">
        <h3>Sign Up</h3><br>
        Username: <input type="text" name="user"><br>
        Password: <input type="password" name="pass"><br>
        Name: <input type="text" name="name"><br>
        E-mail: <input type="email" name="email"><br>
        <div id="container">
            <div class="council">
                County council: <select id="council-select">
                    <option value="" disabled selected style="..."></option>
                    </select>
            </div>
            <div class="provinces hidden_01">
                Province: <select id="provinces-select">
                    <option value="" disabled selected style="..."></option>
                </select>
            </div>
            <div class="municipalities hidden_02">
                Municipality: <select id="municipality-select">
                    <option value="" disabled selected style="..."></option>
                </select>
            </div>
        </div>
        Image: <input type="file" name="image" accept="image/*"><br>
        <input type="submit" name="submit" value="Send">
    </form>
    <script src="../js/comunidades.js" type="text/javascript"></script>
    </body>
</html>
