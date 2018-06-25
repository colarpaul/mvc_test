<html>
<head>
    <title>MVC App</title>
</head>
<body>
    <form action="index.php" method="GET">
        Name: <input type="text" placeholder="Author name" name="name"><button type="submit">Add</button>
    </form>
    <table border="1">
        <?php if(isset($authors) && !empty($authors)) { ?>
            <?php foreach($authors as $author): ?>
                <tr>
                    <td>
                        <?php echo $author; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php } else { ?>
            <tr>
                <td>No records found!</td>
            </tr>
        <?php } ?>
    </table>
</body>
<footer></footer>
</html>