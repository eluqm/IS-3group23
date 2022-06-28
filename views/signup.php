<h1 class="header">Please Signup</h1>

<form method="post" action="./controllers/Users.php">
    <input type="hidden" name="type" value="register">
    <input type="text" name="usersName" 
    placeholder="Full name...">
    <input type="text" name="usersEmail" 
    placeholder="Email...">
    <input type="text" name="usersUid" 
    placeholder="Username...">
    <input type="password" name="usersPwd" 
    placeholder="Password...">
    <button type="submit" name="submit">Sign Up</button>
</form>