<!-- PHP SECTION -->
<style>
    blockquote {
        padding: .5rem 1rem;
        border-left: .25rem solid #eceeef;
        margin-bottom:1rem;
        font-size:1.25rem;
        margin:0 0 1rem;
        color:#888888;
    }
</style>
<div class="mx-auto py-5">
<?php
        
include 'sql.php';
$pdo = new PDO("mysql:dbname=$dbname;host=$dbhost;charset=utf8", $dbuser, $dbpass);
$sql = "SELECT * FROM blog WHERE id > 0 ORDER BY id DESC LIMIT 10";
        
        
foreach ($pdo->query($sql) as $news) {
    echo    '<div class="container">
                <div class="card m-auto my-3">
                    <div class="card-body">
                        <h4 class="card-title">'.$news['title'].'</h4>
                        <h6 class="card-subtitle font-weight-light mb-2 text-muted">von '.$news['isFrom'].'</h6><br>
                        <p class="card-text">'.$news['text'].'</p>
                    </div>
                </div>
            </div><br>';
}
        
        
?>
<!-- PHP SECTION END -->
</div>