<style>
    html,body,p{
        margin: 0;
        padding: 0;
    }

    header{
        width: 100%;
        height: 80px;
        display: flex;
        flex-direction: row;
        align-items: center;
        align-content: center;
        justify-content: space-between;
        box-sizing: border-box;
        margin-top: 20px;
        padding: 10px;
    }

    .logo{
        height: 100%;
        display: flex;
        flex-direction: row;
        align-content: center;
    }

    .logo span{
        font-size: 35pt;
        color: #171717;
    }

    .logo h1{
        margin: 0;
        padding: 0;
        margin-left: 35px;
        font-size: 25pt;
        color: #4a4a4a;
    }

    .right{
        display: flex;
        flex-direction: row;
        padding: 40px 0px;
        align-items: center;
    }

    a.btnConfig{
        background-color: #e53935;
        color: #fafafa;
        font-family: 'Montserrat';
        text-decoration: none;
        padding: 10px;
        font-size: 12pt;
        border-radius: 5px;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: 15px;
        min-height: 30px;
        min-width: 150px;
    }

    .filter{
        background-color: #e53935;
        color: #fafafa;
        font-family: 'Montserrat';
        text-decoration: none;
        padding: none;     
    }

    .dropdown {
        width: 100%;
        min-width: 180px;
        padding: 10px 20px;
        box-sizing: border-box;
        background-color: #e53935;
        border-radius: 5px;
        font-family: 'Montserrat';
        color: white;
        position: relative;
        margin-left: 15px;
        display: flex;
        justify-content: center;
    }

    .my-selected{
        z-index: 100;
        position: relative;        
    }

    .my-dropdown-content {
        position: absolute;
        top: 0px;
        left: 0;
        background-color: #e53935;
        overflow: hidden;

        width: 100%;
        padding: 3em 0 0 0;
        box-sizing: border-box;
        border-radius: 5px;

        z-index: 10;
        max-height: 0px;
        transition: .5s all;
    }

    .showed{
        max-height: 500px;
    }

    .dropdown-itens {
        color: inherit;
        text-transform: capitalize;
        text-decoration: none;
        display: block;
        text-align: left;
        text-align: center;
        margin: 1em 0;
    }

    .my-selected{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }

    .searchBtn{
        margin: 0px;
        width: 200px;
    }

    .selectItem{
        display: none;
    }

    .select-wrapper{
        width: 350px;
        margin: 0 20px;
    }

    .btnHeader{
        width: 100%;
        box-shadow: none;
        color: black;
    }

    .btnHeader:hover{
        box-shadow: none;
        color: black;
    }

    #wpfooter{
        position: relative;
    }

    .btn input:focus + label {
        color: #F44336 !important;
    }
    /* label underline focus color */
    .row .btn input:focus {
        border-bottom: 1px solid #F44336 !important;
        box-shadow: 0 1px 0 0 #F44336 !important
    }
</style>
<header>
    <a href="admin.php?page=ajust3-plugin" class="logo">
        <span class="dashicons dashicons-admin-generic"></span>
        <h1>Ajust3</h1>
    </a>    
    <div class="right">          
        <?php if(!isset($_GET['config'])): ?>
            <form action="poster.php" id="ytApiForm" method="post" class="right">
                <input type="search" id="searchBtn" class="searchBtn" placeholder="Buscar">
                <select class="select-wrapper filter" id="filterDate">
                    <option id="nofiltrar" selected onclick="selectFilter(this)">No Filtrar</option>
                    <option id="hora" onclick="selectFilter(this)">Ultima Hora</option>
                    <option id="hoy" onclick="selectFilter(this)">Hoy</option>
                    <option id="seamana" onclick="selectFilter(this)">Esta Seamana</option>
                    <option id="mes" onclick="selectFilter(this)">Este Mes</option>
                    <option id="año" onclick="selectFilter(this)">Este Año</option>
                </select>
                <select class="select-wrapper filter" id="filterOrder">
                    <option id="nofiltrar" selected onclick="selectFilter(this)">No Filtrar</option>
                    <option id="relevance" onclick="selectFilter(this)">Relevancia</option>
                    <option id="uploadDate" onclick="selectFilter(this)">Fecha de Subida</option>
                    <option id="viewsNumber" onclick="selectFilter(this)">Número de visualizaciones</option>
                    <option id="rating" onclick="selectFilter(this)">Puntuación</option>
                </select>
            </form>            
            <a href="admin.php?page=ajust3-plugin&config" class="waves-effect waves transparent btn btnHeader red">CONFIGURACIÓN</a>        
        <?php else: ?>    
            <a href="admin.php?page=ajust3-plugin" class="waves-effect waves transparent btn btnHeader red">INICIO</a>   
        <?php endif; ?>
    </div>    
</header>
<script>
    
</script>