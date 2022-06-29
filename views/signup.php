<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/signup.css">
    <title>Registrarse</title>
</head>

<body>
    <div class="login-container">
        <div class="image-container">
            <h1 class="title">Registrarse</h1>
            <img src="icons/registro.svg" width="450" height="500px">
        </div>
        <div class="login-info-container">
            <form class="inputs-container" method="post" action="./controllers/Users.php">
                <label for="fname" >Nombre:</label>
                <input class="input" name="usersName" type="text" placeholder="Ingresar nombre completo" required>
                <label for="fname">Correo Institucional:</label>
                <input class="input" name="usersEmail" type="email" placeholder="Ingresar correo institucional" required> 
                <label for="fname">CUI:</label>
                <input class="input" name="usersCUI" type="text" placeholder="Ingresar CUI" required>
                <label for="fname">Año:</label>
                <select class="select" name="usersAño">
                        <option value="primero">1ro</option>
                        <option value="segundo">2do</option>
                        <option value="tercero">3ro</option>
                        <option value="cuarto">4to</option>
                        <option value="quinto">5to</option>
                </select>
                <label for="fname">Contraseña:</label>
                <input class="input" name="usersPwd" type="password" placeholder="Ingresar contraseña" required>
                <label for="fname">Repetir contraseña:</label>
                <input class="input" name="usersPwd-repeat" type="password" placeholder="Ingresar contraseña" required>
                <button class="btn">Registrarse</button>
                <p>¿Ya tienes cuenta?<a class="a" href="login.php">Iniciar Sesión</a></p>
            </form>
        </div>
    </div>

</body>

</html>
