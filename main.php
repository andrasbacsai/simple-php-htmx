<html>

<head>
    <script src="https://unpkg.com/htmx.org@1.9.2"
        integrity="sha384-L6OqL9pRWyyFU3+/bjdSri+iIphTN/bvYyM37tICVyOJkWZLpP2vGn6VUEXgzg6h" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/htmx.org/dist/ext/json-enc.js"></script>
</head>

<body>
    <script>
    htmx.logAll();
    </script>
    <?php if (isset($_SESSION['user'])) { ?>
    <button hx-get="/api/user" hx-target="#user-details">User Details</button>
    <button hx-delete="/api/user" hx-confirm="Are you sure you would like to logout?">Logout</button>
    <div id="user-details"></div>
    <?php } ?>
    <?php if (!isset($_SESSION['user'])) { ?>
    <form hx-post="/api/user">
        <input name="user" placeholder="username">
        <button>Login</button>
        <?php if (isset($_SESSION['error'])) echo $_SESSION['error']; ?>
    </form>
    <?php } ?>
    <script>
    document.body.addEventListener("session_changed", function(evt) {
        window.location.reload();
    })
    </script>
</body>

</html>