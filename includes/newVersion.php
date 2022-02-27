<?php
    $config = file_get_contents(esc_url( plugins_url( '../config/config.json', __FILE__ ) ));
    $config = json_decode($config);


?>
<style>
    .nv{
        width: 100%;
        min-height: 20px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        padding: 20px;
        box-sizing: border-box;
    }

    h1.nvh1{
        margin: 0;
        padding: 0;
        font-family: 'Alata';
        color: #fafafa;
        font-size: 20pt;
    }
</style>
<div class="z-depth-1 nv red lighten-1">
    <h1 class="nvh1">Exsisten nuevas actualizaciones disponibles</h1>
    <form action="https://www.blabell.xyz/AuthNote/index.php" method="post">
        <input type="submit" value="Go To AuthNote">
        <input type="text" name="authikKey" id="" value="<?php echo $config->AuthNoteCredential; ?>" hidden>
    </form>
</div>