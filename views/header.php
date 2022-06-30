<nav>
    <ul>
        <a href="template.php"><li>Home</li></a>
        <?php if(!isset($_SESSION['usersEmail'])) : ?>
            <a href="signup.php"><li>Sign Up</li></a>
            <a href="login.php"><li>Login</li></a>
        <?php else: ?>
            <a href="../controllers/usuario.php?q=logout"><li>Logout</li></a>
        <?php endif; ?>
    </ul>
</nav>